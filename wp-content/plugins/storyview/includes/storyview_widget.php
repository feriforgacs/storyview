<?php
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class FF_Storyview_Widget extends WP_Widget {
  // constructor
  public function __construct(){
    $widget_options = array(
      "classname"   => "ff_storyview_widget",
      "description" => "Display your latest stories"
    );
    parent::__construct( "ff_storyview_widget", "⚡ Story View Widget", $widget_options );
  }

  // Dispaly the widget
  public function widget( $args, $instance ){
    echo $args['before_widget'];
    if ( ! empty( $instance['title'] ) ) {
      echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
    }

    /**
     * Get latest stories from the database
     */
    global $wpdb;
    $story_count = ! empty( $instance['story_count'] ) ? intval( $instance['story_count'] ) : 5;
    $latest_stories = $wpdb->get_results("SELECT post_id, meta_value FROM " . $wpdb->prefix . "postmeta WHERE `meta_key` LIKE 'ff_storyview_data' AND `meta_value` LIKE '%\"activ\":1%' ORDER BY post_id DESC LIMIT " . $story_count);

    $story_post_IDs = array();
    $stories = array();
    if( count( $latest_stories ) ){
      foreach( $latest_stories as $story ){
        $stories[$story->post_id]["story_data"] = json_decode($story->meta_value);
        $story_post_IDs[] = $story->post_id;
      }
    }

    /**
     * Get posts data for stories
     */
    if( count( $story_post_IDs ) > 0 ){
      $story_posts = get_posts( array( "post__in" => $story_post_IDs, "post_type" => array( "post", "page" ) ) );

      if( count( $story_posts ) > 0 ) {
        foreach( $story_posts as $story_post ){
          $stories[$story_post->ID]["story_id"] = $story_post->ID;
          $stories[$story_post->ID]["post_title"] = $story_post->post_title;
          $stories[$story_post->ID]["post_permalink"] = get_permalink( $story_post->ID );
        }
      }
    }

    /**
     * Display latest stories
     */
    if( count( $stories ) > 0 ){
      ?>
      <script type="text/javascript">
        var ffStoryviewAjaxURL = "<?php echo admin_url( "admin-ajax.php" ); ?>";
      </script>
      <?php
      foreach( $stories as $story ){
        // get thumbnail image
        $story_blocks = $story["story_data"]->story_blocks_data;
        $story_item_thubnail_image = "";
        foreach( $story_blocks as $story_block ){
          if( isset( $story_block->ff_storyview_block_image ) && $story_block->ff_storyview_block_image != "" ){
            $story_item_thubnail_image = urldecode( $story_block->ff_storyview_block_image );
            break;
          }
        }
        ?>
        <a
          href="<?php echo $story["post_permalink"] ?>#storyview"
          title="<?php echo $story["post_title"] ?>"
          data-story="<?php echo $story["story_id"]; ?>"
          class="ff_storyview_widget_story_item <?php
          if( $instance['hide_story_button_text'] && $instance['hide_story_button_text'] == 1 ){
            echo " ff_storyview_widget_story_item_title_hidden";
          }

          if( $instance['story_button_inverse'] && $instance['story_button_inverse'] == 1 ){
            echo " ff_storyview_widget_story_item_inverse";
          }
          ?>">

          <span
            style="background-image: url('<?php echo $story_item_thubnail_image; ?>');"
            class="ff_storyview_widget_story_item_thumbnail"
            data-story="<?php echo $story["story_id"]; ?>"
          >
          </span>

          <span
            class="ff_storyview_widget_story_item_title"
            >
            <?php echo mb_substr( $story["post_title"], 0, 25 ); ?>...
          </span>
        </a>
        <?php
      }
    }

    echo $args['after_widget'];
  }

  // widget form in admin widgets screen
  public function form( $instance ){
    $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Latest stories', 'text_domain' );
    $story_count = ! empty( $instance['story_count'] ) ? $instance['story_count'] : 5;
    ?>
    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( "title" ) ); ?>">
        <?php
        esc_attr_e( "Widget title:", "text_domain" );
        ?>
      </label>
      <input
        type="text"
        id="<?php echo esc_attr( $this->get_field_id( "title" ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( "title" ) ); ?>"
        value="<?php echo esc_attr( $title ); ?>"
        class="widefat"
      />
    </p>

    <p>
      <label for="<?php echo esc_attr( $this->get_field_id( "story_count" ) ); ?>">
        <?php
        esc_attr_e( "Number of stories to show", "text_domain" );
        ?>
      </label>
      <input
        type="number"
        id="<?php echo esc_attr( $this->get_field_id( "story_count" ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( "story_count" ) ); ?>"
        value="<?php echo esc_attr( $story_count ); ?>"
        step="1"
        min="1"
        max="10"
        size="3"
        class="tiny-text"
      />
    </p>

    <p>
      <input
        type="checkbox"
        id="<?php echo esc_attr( $this->get_field_id( "hide_story_button_text" ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( "hide_story_button_text" ) ); ?>"
        <?php 
        checked( ( $instance['hide_story_button_text'] == 1 ) ? 1 : '', 1 );
        ?>
        class="checkbox"
      />
      <label for="<?php echo esc_attr( $this->get_field_id( "hide_story_button_text" ) ); ?>">
        <?php
        esc_attr_e( "Hide story icon text", "text_domain" );
        ?>
        <br />
        <small>
        <?php
        esc_attr_e( "The text will be generated from the title of the post the story was added to", "text_domain" );
        ?>
        </small>
      </label>
    </p>

    <p>
      <input
        type="checkbox"
        id="<?php echo esc_attr( $this->get_field_id( "story_button_inverse" ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( "story_button_inverse" ) ); ?>"
        <?php 
        checked( ( $instance['story_button_inverse'] == 1 ) ? 1 : '', 1 );
        ?>
        class="checkbox"
      />
      <label for="<?php echo esc_attr( $this->get_field_id( "story_button_inverse" ) ); ?>">
        <?php
        esc_attr_e( "Display inverse story button", "text_domain" );
        ?>
        <br />
        <small>
        <?php
        esc_attr_e( "Dark background with white font, like Button Type 2 Inverse" );
        ?>
        </small>
      </label>
    </p>
    <?php
  }

  // save widget settings
  public function update( $new_instance, $old_instance ){
    $instance = $old_instance;
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['story_count'] = ( ! empty( $new_instance['story_count'] ) ) ? intval( $new_instance['story_count'] ) : '';
    $instance['hide_story_button_text'] = ( ! empty( $new_instance['hide_story_button_text'] ) ) ? 1 : 0;
    $instance['story_button_inverse'] = ( ! empty( $new_instance['story_button_inverse'] ) ) ? 1 : 0;

    return $instance;
  }
}