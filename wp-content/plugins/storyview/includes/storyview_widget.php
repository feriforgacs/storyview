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
    $posts = get_posts( array( 
			'posts_per_page' => 20,
			'offset' => 0
		) );
    $selected_posts = ! empty( $instance['selected_posts'] ) ? $instance['selected_posts'] : array();
    ?>
    <div style="max-height: 120px; overflow: auto;">
    <ul>
    <?php foreach ( $posts as $post ) { ?>

      <li><input 
        type="checkbox" 
        name="<?php echo esc_attr( $this->get_field_name( 'selected_posts' ) ); ?>[]" 
        value="<?php echo $post->ID; ?>" 
        <?php checked( ( in_array( $post->ID, $selected_posts ) ) ? $post->ID : '', $post->ID ); ?> />
        <?php echo get_the_title( $post->ID ); ?></li>

    <?php } ?>
    </ul>
    </div>
    <?php
  }

  // save widget settings
  public function update( $new_instance, $old_instance ){
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      
    $selected_posts = ( ! empty ( $new_instance['selected_posts'] ) ) ? (array) $new_instance['selected_posts'] : array();
    $instance['selected_posts'] = array_map( 'sanitize_text_field', $selected_posts );

    return $instance;
  }
}