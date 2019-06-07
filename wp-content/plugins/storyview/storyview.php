<?php
/**
 * @package StoryView
 */
/*
Plugin Name: ⚡ Story View
Plugin URI: https://storyviewplugin.com
Description: Create story like versions for your posts for more engagement
Version: 1.0.3
Author: Ferenc Forgacs - @feriforgacs
Author URI: https://feriforgacs.me
License: see LINCESE.txt
Text Domain: storyview
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define("FF_STORYVIEW_META_KEY", "ff_storyview_data");
define("FF_STORYVIEW_SHORTCODE", "ff_storyview");

/**
 * Plugin has been activated
 */
function activate(){
}

/**
 * Plugin has been deactivated
 */
function deactivate(){
}

/**
 * Plugin has been uninstalled
 */
function uninstall(){
}

/**
 * Story view init setup
 */
function ff_storyview_setup() {
    /**
     * Add meta boxes
     */
    add_action('add_meta_boxes', 'ff_storyview_display_storyview_editor');

    /** 
     * Save data 
     */
    add_action('save_post', 'ff_storyview_save_storyview_data', 10, 2);

    /**
     * Add backend custom CSS
     */
    add_action('admin_head', 'ff_storyview_css');

    /**
     * Add backend custom JS
     */
    add_action('admin_footer', 'ff_storyview_js');
}

/**
 * Create story view meta box under the content editor
 */
function ff_storyview_display_storyview_editor() {
    add_meta_box(
        'ff_storyview-post-class',
        '⚡ Story View',
        'ff_storyview_post_class_meta_box',
        'post',
        'normal',
        'high'
    );
}

/**
 * Display the story view editor
 */
function ff_storyview_post_class_meta_box($post) {
    // get current story view data if exitst
    $storyview_data_temp = get_post_meta($post->ID, FF_STORYVIEW_META_KEY, true);

    $storyview_data = [];
    $storyview_activ = false;
    if($storyview_data_temp){
        $storyview_data = json_decode($storyview_data_temp);
    }

    wp_nonce_field( basename( __FILE__ ), 'ff_storyview_post_class_nonce' );
    include_once("views/admin_editor.php");
}

/**
 * Save story view data as postmeta
 */
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
    $storyview_data["button_type"] = strtolower($_POST["ff_storyview_button_type"]);
    $storyview_data["button_other_code"] = $_POST["ff_storyview_button_type_other_code"];
    $storyview_data["story_blocks_data"] = "";

    // process story blocks data
    $story_blocks_data = [];
    $story_block_ids = explode(",", $_POST["story_block_ids"]);
    for($i = 0; $i < count($story_block_ids) - 1; $i++) {
        $current_block_id = $story_block_ids[$i];

        // check block type
        $story_block_type = isset($_POST["ff_storyview_block_type_" . $current_block_id]) ? $_POST["ff_storyview_block_type_" . $current_block_id] : "";

        switch($story_block_type){
            case "code":
                $story_blocks_data[$i] = array(
                    "ff_storyview_block_id"                         => $i,
                    "ff_storyview_block_type"                       => "code",
                    "ff_storyview_block_content"                    => base64_encode($_POST["ff_storyview_block_content_" . $current_block_id])
                );
                break;
            default:
                $story_blocks_data[$i] = array(
                    "ff_storyview_block_id"                         => $i,
                    "ff_storyview_block_image"                      => urlencode($_POST["ff_storyview_block_image_" . $current_block_id]),
                    "ff_storyview_block_item_text"                  => sanitize_text_field($_POST["ff_storyview_block_item_text_" . $current_block_id]),
                    "ff_storyview_block_item_text_position"         => sanitize_text_field($_POST["ff_storyview_block_item_text_position_" . $current_block_id]),
                    "ff_storyview_block_item_text_align"            => sanitize_text_field($_POST["ff_storyview_block_item_text_align_" . $current_block_id]),
                    "ff_storyview_block_item_text_font_family"      => sanitize_text_field($_POST["ff_storyview_block_item_text_font_family_" . $current_block_id]),
                    "ff_storyview_block_item_text_font_size"        => sanitize_text_field($_POST["ff_storyview_block_item_text_font_size_" . $current_block_id]),
                    "ff_storyview_block_item_text_background_color" => sanitize_text_field($_POST["ff_storyview_block_item_text_background_color_" . $current_block_id]),
                    "ff_storyview_block_item_text_font_color"       => sanitize_text_field($_POST["ff_storyview_block_item_text_font_color_" . $current_block_id])
                );
                break;
        }
    }

    $storyview_data["story_blocks_data"] = $story_blocks_data;
    $new_meta_value = json_encode($storyview_data, JSON_UNESCAPED_UNICODE);
  
    $meta_key = FF_STORYVIEW_META_KEY;
    $meta_value = get_post_meta($post_id, $meta_key, true);

    if($new_meta_value && '' == $meta_value){
        add_post_meta($post_id, $meta_key, $new_meta_value, true);
    } elseif ($new_meta_value && $new_meta_value != $meta_value) {
        update_post_meta($post_id, $meta_key, $new_meta_value);
    }
}

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

/**
 * Add frontend custom CSS
 */
add_action('wp_head', 'ff_storyview_frontend_css');

/**
 * Add frontend custom JS
 */
add_action('wp_footer', 'ff_storyview_frontend_js');

/**
 * Display story view on the frontend
 */
function ff_storyview_display(){
    $post_id = get_the_ID();

    if (!empty($post_id)) {
        $storyview_data = get_post_meta($post_id, FF_STORYVIEW_META_KEY, true);

        if(!empty($storyview_data)){
            $storyview_data = json_decode($storyview_data);

            /**
             * Check if story view is activated for this post
             */
            if(!$storyview_data->activ){
                return;
            }

            $storyview_content = "";

            $storyview_blocks = '<div id="ff_storyview_blocks_container"><div id="ff_storyview_blocks">';

            $storyview_blocks_indicator = '<div id="ff_storyview_blocks_indicator">';
            $storyview_button_icon_image = "";
            if(isset($storyview_data->story_blocks_data)){
                $storyview_blocks .= '<div id="ff_storyview_blocks_items_container">';

                $i = 0;
                foreach($storyview_data->story_blocks_data as $storyview_block){
                    $block_type = isset($storyview_block->ff_storyview_block_type) ? $storyview_block->ff_storyview_block_type : "";
                    switch($block_type) {
                        case("code"):
                            // display special stroyview block - shortcode, html code
                            // do_shortcode($content)
                            $storyview_blocks .= '<div class="ff_storyview_block_item_content_code">';
                                $storyview_blocks .= '<div class="ff_storyview_block_item_code">' . do_shortcode(stripslashes(base64_decode($storyview_block->ff_storyview_block_content))) . '</div>';
                                $storyview_blocks .= '<div class="ff_storyview_block_item_code_navigation"><a class="code_block_previous"><span>&#10132;</span> Previous</a><a class="code_block_next">Next <span>&#10132;</span></a></div>';
                            $storyview_blocks .= '</div>';
                            break;
                        default:
                            // display default storyview block - bgimage, text
                            $storyview_blocks .= '<div class="ff_storyview_block_item_content ' . $storyview_block->ff_storyview_block_item_text_position . ' ' . $storyview_block->ff_storyview_block_item_text_align . '" style="background-image: url(\'' . urldecode($storyview_block->ff_storyview_block_image) . '\');">';

                                $storyview_blocks .= '<p class="block_item_text ' . $storyview_block->ff_storyview_block_item_text_font_family . ' ' . $storyview_block->ff_storyview_block_item_text_font_size . ' ' . $storyview_block->ff_storyview_block_item_text_background_color . ' ' . $storyview_block->ff_storyview_block_item_text_font_color .'">';
                                $storyview_blocks .= $storyview_block->ff_storyview_block_item_text;
                                $storyview_blocks .= '</p>';

                            $storyview_blocks .= '</div>';
                            break;
                    }

                    $indicator_activ = "";
                    $button_image_set = false;

                    if(!$button_image_set && isset($storyview_block->ff_storyview_block_image)){
                        $storyview_button_icon_image = urldecode($storyview_block->ff_storyview_block_image);
                        $button_image_set = true;
                    }

                    if($i == 0){
                        $indicator_activ = "activ";
                    } else {
                        $indicator_activ = "";
                    }
                    $storyview_blocks_indicator .= '<div class="ff_storyview_block_indicator_item ' . $indicator_activ . '" id="ff_storyview_block_indicator_item_' . $storyview_block->ff_storyview_block_id . '"></div>';

                    $i++;
                }

                $storyview_blocks .= '</div>';
            }
            $storyview_blocks_indicator .= '</div>';

            $storyview_blocks .= $storyview_blocks_indicator . '<button id="ff_storyview_close_button">&times;</button></div></div>';

            if($storyview_data->button_type == "other"){
                $button_custom_code = $storyview_data->button_other_code;
                // replace button text shortcode
                $button_custom_code = str_replace("{{button_text}}", $storyview_data->button_text, $button_custom_code);

                // replace button image shortcode
                $button_custom_code = str_replace("{{button_image}}", $storyview_button_icon_image, $button_custom_code);

                $storyview_button = '<button id="ff_storyview_button" class="ff_storyview_button ff_storyview_button_type_' . $storyview_data->button_type . '">';
                $storyview_button .= $button_custom_code;
                $storyview_button .= '</button>';
            } else {
                $storyview_button = '<button id="ff_storyview_button" class="ff_storyview_button ff_storyview_button_type_' . $storyview_data->button_type . '">';
                $storyview_button .= '<i class="ff_storyview_button_icon" style="background-image: url(\'' . $storyview_button_icon_image . '\');"></i><span class="ff_storyview_button_text">' . $storyview_data->button_text . '</span>';
                $storyview_button .= '</button>';
            }

            $storyview_content = $storyview_button . $storyview_blocks;

            return $storyview_content;
        }
    }

    return;
}

function ff_storyview_frontend_css(){
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Lily+Script+One&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=latin-ext" rel="stylesheet">';

    echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview_frontend.min.css', __FILE__ ) ) . '" />';
}

function ff_storyview_frontend_js(){
    echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview_frontend.min.js', __FILE__ ) ) . '"></script>';
}


// on activation
register_activation_hook(__FILE__ , "activate");

// on deactivation
register_deactivation_hook(__FILE__ , "deactivate");


add_action('load-post.php', 'ff_storyview_setup');
add_action('load-post-new.php', 'ff_storyview_setup');
add_shortcode(FF_STORYVIEW_SHORTCODE, 'ff_storyview_display');


// TEMP
/* Filter the post class hook with our custom post class function. */
//add_filter( 'post_class', 'ff_storyview_post_class' );

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

require 'includes/updatechecker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://demo.storyviewplugin.com/updater/?action=get_metadata&slug=storyview',
	__FILE__,
	'storyview'
);