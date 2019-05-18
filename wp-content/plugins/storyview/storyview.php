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
        
    }

    /**
     * Plugin has been activated
     */
    function activate(){
        
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
}

$storyView = new StoryView();

// on activation
register_activation_hook(__FILE__ , array($storyView, "activate"));

// on deactivation
register_deactivation_hook(__FILE__ , array($storyView, "deactivate"));


/* Story view meta box setup function. */
function ff_storyview_setup() {
    /* Add meta boxes*/
    add_action('add_meta_boxes', 'ff_storyview_display_storyview_editor');

    /* Save data */
    add_action('save_post', 'ff_storyview_save_storyview_data', 10, 2);

    /* Add custom css */
    add_action('admin_head', 'ff_storyview_css');

    /* Add custom JS */
    add_action('admin_footer', 'ff_storyview_js');
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function ff_storyview_display_storyview_editor() {
    add_meta_box(
        'ff_storyview-post-class',
        esc_html__( 'Story View', 'example' ),
        'ff_storyview_post_class_meta_box',
        'post',
        'normal',
        'high'
    );
}

/* Display the post meta box. */
function ff_storyview_post_class_meta_box($post) {
    // get current story view data if exitst
    $storyview_data_temp = get_post_meta($post->ID, "ff_storyview_data", true);

    $storyview_data = [];
    $storyview_activ = false;
    if($storyview_data_temp){
        $storyview_data = json_decode($storyview_data_temp);
    }

    wp_nonce_field( basename( __FILE__ ), 'ff_storyview_post_class_nonce' );
    include_once("views/admin_editor.php");
}

/* Save the meta box's post metadata. */
function ff_storyview_save_storyview_data($post_id, $post) {
    // check nonce
    if(!isset($_POST['ff_storyview_post_class_nonce']) || !wp_verify_nonce($_POST['ff_storyview_post_class_nonce'], basename(__FILE__))){
        return $post_id;
    }

    // get post type
    $post_type = get_post_type_object($post->post_type);
  
    // check permissions
    if(!current_user_can($post_type->cap->edit_post, $post_id)){
        return $post_id;
    }
  
    // process posted data
    $storyview_data = [];
    $storyview_data["activ"] = intval($_POST["ff_storyview_activ"]);
    $storyview_data["button_text"] = sanitize_text_field($_POST["ff_storyview_button_text"]);
    $storyview_data["button_type"] = intval($_POST["ff_storyview_button_type"]);
    $storyview_data["button_other_code"] = $_POST["ff_storyview_button_type_other_code"];
    $storyview_data["story_blocks_data"] = "";

    // process story blocks data
    $story_blocks_data = [];
    // TODO

    /* Get the posted data and sanitize it for use as an HTML class. */
    //$new_meta_value = ( isset( $_POST['ff_storyview-post-class'] ) ? sanitize_html_class( $_POST['ff_storyview-post-class'] ) : '' );

    $new_meta_value = json_encode($storyview_data);


  
    /* Get the meta key. */
    $meta_key = 'ff_storyview_data';
  
    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta($post_id, $meta_key, true);
  
    /* If a new meta value was added and there was no previous value, add it. */
    if($new_meta_value && '' == $meta_value){
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } elseif ($new_meta_value && $new_meta_value != $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    }
}

add_action('load-post.php', 'ff_storyview_setup');
add_action('load-post-new.php', 'ff_storyview_setup');

function ff_storyview_css(){
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Lily+Script+One&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=latin-ext" rel="stylesheet">';

    echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview.min.css', __FILE__ ) ) . '" />';
    echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/selectric.min.css', __FILE__ ) ) . '" />';
}

function ff_storyview_js(){
    echo '<script src="' . esc_url( plugins_url( 'assets/scripts/jquery.selectric.min.js', __FILE__ ) ) . '"></script>';
    echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview.min.js', __FILE__ ) ) . '"></script>';
}

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