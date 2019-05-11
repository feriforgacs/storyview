<?php
/**
 * @package StoryView
 */
/*
Plugin Name: StoryView
Plugin URI: https://storyviewplugin.com
Description: Create story like versions for your posts
Version: 1.0.0
Author: Ferenc Forgacs - @feriforgacs
Author URI: https://feriforgacs.me
License: GPLv2 or later
Text Domain: storyview
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class StoryView {

    function __construct(){
        add_action('init', array( $this, 'custom_post_type' ) );
    }

    /**
     * Plugin has been activated
     */
    function activate(){
        // generate cpt
        $this->custom_post_type();
        // flush rewrite rules
        flush_rewrite_rules();
    }

    /**
     * Plugin has been deactivated
     */
    function deactivate(){
        // flush rewrite rules
    }

    /**
     * Plugin has been uninstalled
     */
    function uninstall(){
        // delete cpt
        // delete data from the db
    }

    function custom_post_type(){
        register_post_type('book', ['public' => true, 'label' => 'Books']);
    }
}

if( class_exists( 'StoryView' ) ){
    $storyView = new StoryView();
}

// on activation
register_activation_hook( __FILE__ , array($storyView, "activate") );

// on deactivation
register_deactivation_hook( __FILE__ , array($storyView, "deactivate") );


/* Meta box setup function. */
function ff_storyview_setup() {
    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'ff_storyview_add_post_meta_boxes' );
    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'ff_storyview_save_post_class_meta', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function ff_storyview_add_post_meta_boxes() {
    add_meta_box(
        'ff_storyview-post-class',
        esc_html__( 'Post Class', 'example' ),
        'ff_storyview_post_class_meta_box',
        'post',
        'side',
        'default'
    );
}

/* Display the post meta box. */
function ff_storyview_post_class_meta_box( $post ) {
    ?>
    <?php wp_nonce_field( basename( __FILE__ ), 'ff_storyview_post_class_nonce' ); ?>
    <p>
        <label for="ff_storyview-post-class"><?php _e( "Add a custom CSS class, which will be applied to WordPress' post class.", 'example' ); ?></label>
        <br />
        <input class="widefat" type="text" name="ff_storyview-post-class" id="ff_storyview-post-class" value="<?php echo esc_attr( get_post_meta( $post->ID, 'ff_storyview_post_class', true ) ); ?>" size="30" />
    </p>
    <?php
}

/* Save the meta box's post metadata. */
function ff_storyview_save_post_class_meta( $post_id, $post ) {
    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['ff_storyview_post_class_nonce'] ) || !wp_verify_nonce( $_POST['ff_storyview_post_class_nonce'], basename( __FILE__ ) ) )
        return $post_id;
  
    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );
  
    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;
  
    /* Get the posted data and sanitize it for use as an HTML class. */
    $new_meta_value = ( isset( $_POST['ff_storyview-post-class'] ) ? sanitize_html_class( $_POST['ff_storyview-post-class'] ) : '' );
  
    /* Get the meta key. */
    $meta_key = 'ff_storyview_post_class';
  
    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );
  
    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );
  
    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );
  
    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'ff_storyview_setup' );
add_action( 'load-post-new.php', 'ff_storyview_setup' );

/* Filter the post class hook with our custom post class function. */
add_filter( 'post_class', 'ff_storyview_post_class' );

function ff_storyview_post_class( $classes ) {
    /* Get the current post ID. */
    $post_id = get_the_ID();
    /* If we have a post ID, proceed. */
    if ( !empty( $post_id ) ) {
        /* Get the custom post class. */
        $post_class = get_post_meta( $post_id, 'ff_storyview_post_class', true );

        /* If a post class was input, sanitize it and add it to the post class array. */
        if ( !empty( $post_class ) )
            $classes[] = sanitize_html_class( $post_class );
    }
    
    return $classes;
}