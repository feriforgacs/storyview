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

    if( ! empty( $instance['selected_posts'] ) && is_array( $instance['selected_posts'] ) ){ 

      $selected_posts = get_posts( array( 'post__in' => $instance['selected_posts'] ) );
      ?>
      <ul>
      <?php foreach ( $selected_posts as $post ) { ?>
        <li><a href="<?php echo get_permalink( $post->ID ); ?>">
        <?php echo $post->post_title; ?>
        </a></li>		
      <?php } ?>
      </ul>
      <?php 
      
    }else{
      echo esc_html__( 'No posts selected!', 'text_domain' );	
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
    <?php
  }

  // save widget settings
  public function update( $new_instance, $old_instance ){
    $instance = $old_instance;
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['story_count'] = ( ! empty( $new_instance['story_count'] ) ) ? intval( $new_instance['story_count'] ) : '';
    $instance['hide_story_button_text'] = ( ! empty( $new_instance['hide_story_button_text'] ) ) ? 1 : 0;

    return $instance;
  }
}