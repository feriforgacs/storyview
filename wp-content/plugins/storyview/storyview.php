<?php
ob_start();
ob_clean();
/**
 * @package StoryView
 */
/*
Plugin Name: ⚡ Story View Pro
Plugin URI: https://storyviewplugin.com
Description: Create story like versions for your posts for more engagement
Version: 1.7.0
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

global $wpdb;
define("FF_STORYVIEW_PLUGIN_VERSION", "1.7.0");
define("FF_STORYVIEW_META_KEY", "ff_storyview_data");
define("FF_STORYVIEW_SHORTCODE", "ff_storyview");
define("FF_STORYVIEW_CUSTOM_BUTTONS_TABLE", $wpdb->prefix . "ff_storyview_buttons");

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
        ['post', 'page'],
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

    // AMP Cover data
    $storyview_data["amp_settings"]["activ"] =                          intval($_POST["ff_storyview_amp_activ"]);
    $storyview_data["amp_settings"]["cover_image"] =                    urlencode($_POST["ff_storyview_amp_cover_image"]);

    // check for default settings
    if(intval($_POST["ff_storyview_amp_publisher_logo_default"]) != 1){
        $storyview_data["amp_settings"]["publisher_logo"] = urlencode($_POST["ff_storyview_amp_publisher_logo_image"]);
    } else {
        $storyview_data["amp_settings"]["publisher_logo"] = "";
    }

    $storyview_data["amp_settings"]["cover_title"] =                    sanitize_text_field($_POST["ff_storyview_amp_cover_text_title"]);

    // check for default settings
    if(intval($_POST["ff_storyview_amp_cover_author_name_default"]) != 1){
        $storyview_data["amp_settings"]["cover_author_name"] = sanitize_text_field($_POST["ff_storyview_amp_cover_text_author"]);
    } else {
        $storyview_data["amp_settings"]["cover_author_name"] = "";
    }
    
    $storyview_data["amp_settings"]["cover_text_position"] =            sanitize_text_field($_POST["ff_storyview_amp_cover_text_position"]);
    $storyview_data["amp_settings"]["cover_text_align"] =               sanitize_text_field($_POST["ff_storyview_amp_cover_text_align"]);
    $storyview_data["amp_settings"]["cover_text_font_family"] =         sanitize_text_field($_POST["ff_storyview_amp_cover_text_font_family"]);
    $storyview_data["amp_settings"]["cover_text_font_size"] =           sanitize_text_field($_POST["ff_storyview_amp_cover_text_font_size"]);
    $storyview_data["amp_settings"]["cover_text_background_color"] =    sanitize_text_field($_POST["ff_storyview_amp_cover_text_background_color"]);
    $storyview_data["amp_settings"]["cover_text_font_color"] =          sanitize_text_field($_POST["ff_storyview_amp_cover_text_font_color"]);

    // Story controllers data
    $storyview_data["display_controllers"] = intval($_POST["ff_storyview_display_controllers"]);

    // Story share options
    $storyview_data["story_share_enabled"] = intval($_POST["ff_storyview_enable_share"]);

    // Story End Screen settings - Recommended Article
    $storyview_data["end_screen_settings"]["recommended_article_enabled"] = intval($_POST["ff_storyview_end_screen_recommended_article_enabled"]);
    $storyview_data["end_screen_settings"]["recommended_section_title"] = sanitize_text_field($_POST["ff_storyview_recommended_section_title"]);
    $storyview_data["end_screen_settings"]["recommended_article_title"] = sanitize_text_field($_POST["ff_storyview_recommended_article_title"]);
    $storyview_data["end_screen_settings"]["recommended_article_url"] = sanitize_text_field($_POST["ff_storyview_recommended_article_url"]);

    // Story End Screen settings - Share
    $storyview_data["end_screen_settings"]["share_enabled"] = intval($_POST["ff_storyview_end_screen_share_enabled"]);
    $storyview_data["end_screen_settings"]["share_button_text"] = sanitize_text_field($_POST["ff_storyview_end_screen_share_button_text"]);

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
                    "ff_storyview_block_content"                    => base64_encode($_POST["ff_storyview_block_content_" . $current_block_id]),
                    "ff_storyview_block_item_block_background_color" => sanitize_text_field($_POST["ff_storyview_block_item_block_background_color_" . $current_block_id])
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
    $new_meta_value = json_encode($storyview_data, JSON_UNESCAPED_UNICODE|JSON_HEX_APOS|JSON_HEX_QUOT);
  
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

    if( WP_DEBUG && WP_DEBUG === true ){
        echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview.css?v=' . date( "YmdHis" ), __FILE__ ) ) . '" />';
    } else {
        echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview.min.css?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__ ) ) . '" />';
    }

    echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/selectric.min.css', __FILE__ ) ) . '" />';
    echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/spectrum.min.css', __FILE__ ) ) . '" />';
}

function ff_storyview_js(){
    echo '<script src="' . esc_url( plugins_url( 'assets/scripts/jquery.selectric.min.js', __FILE__ ) ) . '"></script>';
    echo '<script src="' . esc_url( plugins_url( 'assets/scripts/spectrum.min.js', __FILE__ ) ) . '"></script>';

    if( WP_DEBUG && WP_DEBUG === true ){
        echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview.js?v=' . date( "YmdHis" ), __FILE__ ) ) . '"></script>';
    } else {
        echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview.min.js?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__ ) ) . '"></script>';
    }
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
function ff_storyview_display( $post_id = 0 ){
    if( ! $post_id ){
        $post_id = get_the_ID();
    }

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

            $storyview_blocks = '<div class="ff_storyview_blocks_container"><div class="ff_storyview_blocks">';

            $storyview_blocks_indicator = '<div class="ff_storyview_blocks_indicator">';
            $storyview_button_icon_image = "";
            $button_image_set = false;
            if(isset($storyview_data->story_blocks_data)){
                $storyview_blocks .= '<div class="ff_storyview_blocks_items_container">';

                /**
                 * Check sharing settings
                 */
                $storyview_share_enabled = 0;
                $storyview_share_class = "";

                if(get_option('ff_storyview_default_share_enabled') == 1 || (isset($storyview_data->story_share_enabled) && $storyview_data->story_share_enabled == 1)){
                    $storyview_share_enabled = 1;
                    $storyview_share_class = "share_enabled";
                }

                $i = 0;
                $last_story_block_id = 0;
                foreach($storyview_data->story_blocks_data as $storyview_block){
                    $block_type = isset($storyview_block->ff_storyview_block_type) ? $storyview_block->ff_storyview_block_type : "";
                    switch($block_type) {
                        case("code"):
                            // display special stroyview block - shortcode, html code
                            // do_shortcode($content)
                            $storyview_blocks .= '<div class="ff_storyview_block_item_content_code item">';
                                $storyview_block_background_color = $storyview_block->ff_storyview_block_item_block_background_color;
                                switch($storyview_block_background_color){
                                    case "ff_storyview_block_background_black":
                                        $storyview_block_background_color = "rgba(0, 0, 0, .8)";
                                        break;

                                    case "ff_storyview_block_background_gray":
                                        $storyview_block_background_color = "rgba(51, 51, 51, .8)";
                                        break;

                                    case "ff_storyview_block_background_red":
                                        $storyview_block_background_color = "rgba(201, 44, 44, .8)";
                                        break;

                                    case "ff_storyview_block_background_white":
                                        $storyview_block_background_color = "rgba(255, 255, 255, .8)";
                                        break;

                                    case "ff_storyview_block_background_transparent":
                                        $storyview_block_background_color = "rgba(255, 255, 255, 0)";
                                        break;

                                    default:
                                        $storyview_block_background_color = $storyview_block->ff_storyview_block_item_block_background_color;
                                        break;
                                }

                                $storyview_blocks .= '<div class="ff_storyview_block_item_code" style="background-color: ' . $storyview_block_background_color . ';">' . do_shortcode(stripslashes(base64_decode($storyview_block->ff_storyview_block_content))) . '</div>';

                                // check default values for controller labels
                                $default_button_label_previous = "<span>&#10132;</span> Previous";
                                $default_button_label_next = "Next <span>&#10132;</span>";
                                
                                if(strlen(esc_attr(get_option('ff_storyview_default_previous_button_label'))) > 0) {
                                    $default_button_label_previous = esc_attr(get_option('ff_storyview_default_previous_button_label'));
                                }

                                if(strlen(esc_attr(get_option('ff_storyview_default_next_button_label'))) > 0) {
                                    $default_button_label_next = esc_attr(get_option('ff_storyview_default_next_button_label'));
                                }

                                $storyview_blocks .= '<div class="ff_storyview_block_item_code_navigation"><a class="code_block_previous">' . $default_button_label_previous . '</a><a class="code_block_next">' . $default_button_label_next . '</a></div>';

                            $storyview_blocks .= '</div>';
                            break;
                        default:
                            // display default storyview block - bgimage, text
                            // check controller display settings
                            $display_controllers = false;
                            $display_controllers_class = "";
                            if(isset($storyview_data->display_controllers) && $storyview_data->display_controllers == 1){
                                $display_controllers = true;
                                $display_controllers_class = "controllers_visible";
                            }

                            $storyview_blocks .= '<div class="ff_storyview_block_item_container item"><div class="ff_storyview_block_item_content ' . $display_controllers_class . ' ' . $storyview_block->ff_storyview_block_item_text_position . ' ' . $storyview_block->ff_storyview_block_item_text_align . ' ' . $storyview_share_class .'" style="background-image: url(\'' . urldecode($storyview_block->ff_storyview_block_image) . '\');">';

                                $storyview_block_background_color = $storyview_block->ff_storyview_block_item_text_background_color;
                                switch($storyview_block_background_color){
                                    case "ff_storyview_block_background_black":
                                        $storyview_block_background_color = "rgba(0, 0, 0, .8)";
                                        break;

                                    case "ff_storyview_block_background_gray":
                                        $storyview_block_background_color = "rgba(51, 51, 51, .8)";
                                        break;

                                    case "ff_storyview_block_background_red":
                                        $storyview_block_background_color = "rgba(201, 44, 44, .8)";
                                        break;

                                    case "ff_storyview_block_background_white":
                                        $storyview_block_background_color = "rgba(255, 255, 255, .8)";
                                        break;

                                    case "ff_storyview_block_background_transparent":
                                        $storyview_block_background_color = "rgba(255, 255, 255, 0)";
                                        break;

                                    default:
                                        $storyview_block_background_color = $storyview_block->ff_storyview_block_item_text_background_color;
                                        break;
                                }

                                $storyview_block_font_color = $storyview_block->ff_storyview_block_item_text_font_color;
                                switch($storyview_block_font_color){
                                    case "ff_storyview_block_color_black":
                                        $storyview_block_font_color = "rgb(0, 0, 0)";
                                        break;

                                    case "ff_storyview_block_color_gray":
                                        $storyview_block_font_color = "rgb(51, 51, 51)";
                                        break;

                                    case "ff_storyview_block_color_red":
                                        $storyview_block_font_color = "rgb(201, 44, 44)";
                                        break;

                                    case "ff_storyview_block_color_white":
                                        $storyview_block_font_color = "rgb(255, 255, 255)";
                                        break;
                                    
                                    default:
                                        $storyview_block_font_color = $storyview_block->ff_storyview_block_item_text_font_color;
                                        break;
                                }

                                $storyview_blocks .= '<p class="block_item_text ' . $storyview_block->ff_storyview_block_item_text_font_family . ' ' . $storyview_block->ff_storyview_block_item_text_font_size .'" style="background-color: ' . $storyview_block_background_color . '; color: ' . $storyview_block_font_color . ';">';
                                $storyview_blocks .= $storyview_block->ff_storyview_block_item_text;
                                $storyview_blocks .= '</p>';

                                /**
                                 * Share story view
                                 */
                                $storyview_share = "";
                                if($storyview_share_enabled){
                                    $storyview_share = '<div class="storyview_share_button storyview_share_section_item"><span class="storyview_share_button_text storyview_share_section_item">Share this story</span></div>';
                                }

                                $storyview_blocks .= $storyview_share;

                                // display controllers
                                $storyview_blocks_controllers = "";
                                if($display_controllers){
                                    // check default values for controller labels
                                    $default_button_label_previous = "<span>&#10132;</span> Previous";
                                    $default_button_label_next = "Next <span>&#10132;</span>";
                                    
                                    if(strlen(esc_attr(get_option('ff_storyview_default_previous_button_label'))) > 0) {
                                        $default_button_label_previous = esc_attr(get_option('ff_storyview_default_previous_button_label'));
                                    }

                                    if(strlen(esc_attr(get_option('ff_storyview_default_next_button_label'))) > 0) {
                                        $default_button_label_next = esc_attr(get_option('ff_storyview_default_next_button_label'));
                                    }

                                    $storyview_blocks_controllers = '<div class="ff_storyview_block_item_navigation"><a class="classic_block_previous">' . $default_button_label_previous . '</a><a class="classic_block_next">' . $default_button_label_next . '</a></div>';
                                }

                            $storyview_blocks .= '</div>' . $storyview_blocks_controllers . '</div>';
                            break;
                    }

                    $indicator_activ = "";

                    if(!$button_image_set && isset($storyview_block->ff_storyview_block_image)){
                        $storyview_button_icon_image = urldecode($storyview_block->ff_storyview_block_image);
                        $button_image_set = true;
                    }

                    if($i == 0){
                        $indicator_activ = "activ";
                    } else {
                        $indicator_activ = "";
                    }
                    $storyview_blocks_indicator .= '<div class="ff_storyview_block_indicator_item ' . $indicator_activ . ' ff_storyview_block_indicator_item_' . $storyview_block->ff_storyview_block_id . '" data-index=' . $storyview_block->ff_storyview_block_id . '></div>';

                    $last_story_block_id = $storyview_block->ff_storyview_block_id;

                    $i++;
                }

                /**
                 * Storyview end screen
                 */
                if(isset($storyview_data->end_screen_settings) && ($storyview_data->end_screen_settings->recommended_article_enabled == 1 || $storyview_data->end_screen_settings->share_enabled == 1)){
                    /**
                     * Add end screen to story
                     */
                    $storyview_blocks .= '<div class="ff_storyview_block_item_content_end_screen item end_screen">';

                        $storyview_blocks .= '<div class="ff_storyview_block_item_end_screen end_screen">';

                        /**
                         * End screen share
                         */
                        if(isset($storyview_data->end_screen_settings->share_enabled) && $storyview_data->end_screen_settings->share_enabled == 1){
                            $end_screen_share_button_text = "";
                            if(isset($storyview_data->end_screen_settings->share_button_text)){
                                $end_screen_share_button_text = $storyview_data->end_screen_settings->share_button_text;
                            }
                            
                            $storyview_blocks .= '<div class="ff_storyview_end_screen_share end_screen">';
                                
                                $storyview_blocks .= '<div class="ff_storyview_end_screen_share_button storyview_share_section_item end_screen"><span class="ff_storyview_end_screen_share_button_text end_screen">' . $end_screen_share_button_text . '</span><span class="ff_storyview_end_screen_share_button_icon end_screen"></span></div>';

                            $storyview_blocks .= '</div>';
                        }

                        /**
                         * End screen recommendations
                         */
                        if(isset($storyview_data->end_screen_settings->recommended_article_enabled) && $storyview_data->end_screen_settings->recommended_article_enabled == 1){
                            $end_screen_recommend_section_title = "";
                            $end_screen_recommend_article_title = "";
                            $end_screen_recommend_article_url = "";
                            if(isset($storyview_data->end_screen_settings->recommended_section_title)){
                                $end_screen_recommend_section_title = $storyview_data->end_screen_settings->recommended_section_title;
                            }

                            if(isset($storyview_data->end_screen_settings->recommended_article_title)){
                                $end_screen_recommend_article_title = $storyview_data->end_screen_settings->recommended_article_title;
                            }

                            if(isset($storyview_data->end_screen_settings->recommended_article_url)){
                                $end_screen_recommend_article_url = $storyview_data->end_screen_settings->recommended_article_url;
                            }
                            
                            $storyview_blocks .= '<div class="ff_storyview_end_screen_recommend end_screen">';

                                if(strlen($end_screen_recommend_section_title) >= 1) {
                                    $storyview_blocks .= '<h4 class="end_screen">' . $end_screen_recommend_section_title . '</h4>';
                                }
                                
                                $storyview_blocks .= '<div class="ff_storyview_end_screen_recommend_button end_screen"><a class="end_screen" href="' . $end_screen_recommend_article_url . '">' . $end_screen_recommend_article_title . '</a></div>';

                            $storyview_blocks .= '</div>';
                        }

                        $storyview_blocks .= '</div>';

                        // check default values for controller labels
                        $default_button_label_previous = "<span>&#10132;</span> Previous";
                        
                        if(strlen(esc_attr(get_option('ff_storyview_default_previous_button_label'))) > 0) {
                            $default_button_label_previous = esc_attr(get_option('ff_storyview_default_previous_button_label'));
                        }

                        $storyview_blocks .= '<div class="ff_storyview_block_item_end_screen_navigation end_screen"><a class="end_screen_previous">' . $default_button_label_previous . '</a><a class="code_block_next"></a></div>';

                    $storyview_blocks .= '</div>';

                    /**
                     * Add extra item to indicator
                     */
                    $last_story_block_id++;
                    $storyview_blocks_indicator .= '<div class="ff_storyview_block_indicator_item  ff_storyview_block_indicator_item_' . $last_story_block_id . '" data-index=' . $last_story_block_id . '></div>';
                }

                $storyview_blocks .= '</div>';

                /**
                 * Storyview Share Panel
                 */
                $storyview_share_panel = "";
                if($storyview_share_enabled || (isset($storyview_data->end_screen_settings->share_enabled) && $storyview_data->end_screen_settings->share_enabled == 1)){
                    $storyview_share_panel = '<div data-story="' . $post_id . '" id="storyview_share_panel_container_' . $post_id . '" class="storyview_share_section_item storyview_share_panel_container">';

                        $storyview_share_panel .= '<div data-story="' . $post_id . '" id="storyview_share_panel_' . $post_id . '" class="storyview_share_section_item storyview_share_panel">';

                            $storyview_share_panel .= '<div data-story="' . $post_id . '" id="storyview_share_panel_link_copied_' . $post_id . '" class="storyview_share_section_item storyview_share_panel_link_copied">Link copied to clipboard!</div>';

                            $storyview_share_panel .= '<a data-story="' . $post_id . '" class="storyview_share_option storyview_share_section_item storyview_share_option_link" id="storyview_share_option_link_' . $post_id . '" href="' . get_permalink( $post_id ) . '#storyview"><span class="icon storyview_share_section_item"></span><span class="storyview_share_section_item">Copy Link</span></a>';

                            $storyview_share_panel .= '<a data-story="' . $post_id . '" class="storyview_share_option storyview_share_section_item storyview_share_option_facebook" href="https://facebook.com/sharer.php?u=' . urlencode( get_permalink( $post_id ) . '#storyview' ) . '" target="_blank" id="storyview_share_option_facebook_' . $post_id . '"><span class="icon storyview_share_section_item"></span><span class="storyview_share_section_item">Facebook</span></a>';

                            $storyview_share_panel .= '<a data-story="' . $post_id . '" class="storyview_share_option storyview_share_section_item storyview_share_option_twitter" href="https://twitter.com/share?text=' . urlencode( get_the_title( $post_id ) ) . '&url=' . urlencode( get_permalink( $post_id ) . '#storyview' ) . '" target="_blank" id="storyview_share_option_twitter_' . $post_id . '"><span class="icon storyview_share_section_item"></span><span class="storyview_share_section_item">Twitter</span></a>';

                            $storyview_share_panel .= '<a data-story="' . $post_id . '" class="storyview_share_option storyview_share_section_item storyview_share_option_whatsapp" href="https://api.whatsapp.com/send?text=' . urlencode( get_the_title( $post_id ) . ' - ' . get_permalink( $post_id ) . '#storyview' ) . '" target="_blank" id="storyview_share_option_whatsapp_' . $post_id . '"><span class="icon storyview_share_section_item"></span><span class="storyview_share_section_item">WhatsApp</span></a>';

                            $storyview_share_panel .= '<a data-story="' . $post_id . '" class="storyview_share_option storyview_share_section_item storyview_share_option_email" target="_blank" href="mailto:?subject=' . get_the_title( $post_id ) . '&body=' . get_the_title( $post_id ) . ' - ' . get_permalink( $post_id ) . '#storyview" id="storyview_share_option_email_' . $post_id . '"><span class="icon storyview_share_section_item"></span><span class="storyview_share_section_item">Email</span></a>';

                        $storyview_share_panel .= '</div>';
                    $storyview_share_panel .= '</div>';
                }

                $storyview_blocks .= $storyview_share_panel;
            }
            
            $storyview_blocks_indicator .= '</div>';

            $storyview_blocks .= $storyview_blocks_indicator . '<button class="ff_storyview_close_button" data-story=' . $post_id . '>&times;</button></div></div>';

            // create AMP URL
            $post_url = parse_url( get_permalink( $post_id ) );
            $story_url = "";

            if(isset($storyview_data->amp_settings) && $storyview_data->amp_settings->activ == 1){
                if(array_key_exists("query", $post_url) && $post_url["query"] != ""){
                    // param already exists in the url
                    $story_url = get_permalink( $post_id ) . "&storyview_amp=1";
                } else {
                    $story_url = get_permalink( $post_id ) . "?storyview_amp=1";
                }
            } else {
                $story_url = get_permalink( $post_id ) . "#storyview";
            }

            if($storyview_data->button_type == "other"){
                // custom button code
                $button_custom_code = $storyview_data->button_other_code;
                // replace button text shortcode
                $button_custom_code = str_replace("{{button_text}}", $storyview_data->button_text, $button_custom_code);

                // replace button image shortcode
                $button_custom_code = str_replace("{{button_image}}", $storyview_button_icon_image, $button_custom_code);

                $storyview_button = '<a id="ff_storyview_button_' . $post_id . '" href="' . $story_url . '" class="ff_storyview_button ff_storyview_button_type_' . $storyview_data->button_type . '">';
                $storyview_button .= $button_custom_code;
                $storyview_button .= '</a>';
            } else if(strpos($storyview_data->button_type, "custom") !== false){
                // custom designed button
                // get custom code data from the database
                $ff_storyview_custom_button_id = intval(str_replace("custom_", "", $storyview_data->button_type));
                global $wpdb;
                $ff_storyview_custom_button_data = $wpdb->get_row("SELECT * FROM " . FF_STORYVIEW_CUSTOM_BUTTONS_TABLE . " WHERE storyview_button_id = " . $ff_storyview_custom_button_id);

                if($ff_storyview_custom_button_data && property_exists($ff_storyview_custom_button_data, "storyview_button_settings")){
                    $ff_storyview_button_data = json_decode($ff_storyview_custom_button_data->storyview_button_settings);
                    // create button css
                    $ff_storyview_custom_button_css = "";
                    // background color or gradient
                    if($ff_storyview_button_data->button_background_type == "color"){
                        $ff_storyview_custom_button_css .= "background: " . $ff_storyview_button_data->button_background_color . "; ";
                    } else {
                        $ff_storyview_custom_button_css .= "background: " . $ff_storyview_button_data->button_background_type . "(". $ff_storyview_button_data->button_background_gradient_start . ", " . $ff_storyview_button_data->button_background_gradient_end . "); ";
                    }

                    // font color
                    $ff_storyview_custom_button_css .= "color: " . $ff_storyview_button_data->button_font_color . "; ";

                    // font size
                    $ff_storyview_custom_button_css .= "font-size: " . $ff_storyview_button_data->button_font_size . "; ";

                    // text align
                    $ff_storyview_custom_button_css .= "text-align: " . $ff_storyview_button_data->button_text_alignment . "; ";

                    // border width
                    $ff_storyview_custom_button_css .= "border-width: " . $ff_storyview_button_data->button_border_width . "; ";

                    // border color
                    $ff_storyview_custom_button_css .= "border-color: " . $ff_storyview_button_data->button_border_color . "; ";

                    // padding
                    $ff_storyview_custom_button_css .= "padding: " . $ff_storyview_button_data->button_padding . "; ";

                    // custom css
                    $ff_storyview_custom_button_css .= preg_replace('/\s+/S', " ", $ff_storyview_button_data->button_custom_css);

                    // display custom button
                    $storyview_button = '<a id="ff_storyview_button_' . $post_id . '" style="' . $ff_storyview_custom_button_css . '" href="' . $story_url . '" class="ff_storyview_button ff_storyview_custom_button ff_storyview_button_type_custom_layout_' . $ff_storyview_button_data->button_layout . ' ' . $ff_storyview_button_data->button_font_family . '">';
                    $storyview_button .= '<i class="ff_storyview_button_icon" style="background-image: url(\'' . $storyview_button_icon_image . '\');"></i><span class="ff_storyview_button_text">' . $storyview_data->button_text . '</span>';
                    $storyview_button .= '</a>';
                } else {
                    // fallback to default button
                    $storyview_button = '<a id="ff_storyview_button_' . $post_id . '" href="' . $story_url . '" class="ff_storyview_button ff_storyview_button_type_1">';
                    $storyview_button .= '<i class="ff_storyview_button_icon" style="background-image: url(\'' . $storyview_button_icon_image . '\');"></i><span class="ff_storyview_button_text">' . $storyview_data->button_text . '</span>';
                    $storyview_button .= '</a>';
                }

            } else {
                // default button
                $storyview_button = '<a id="ff_storyview_button_' . $post_id . '" href="' . $story_url . '" class="ff_storyview_button ff_storyview_button_type_' . $storyview_data->button_type . '">';
                $storyview_button .= '<i class="ff_storyview_button_icon" style="background-image: url(\'' . $storyview_button_icon_image . '\');"></i><span class="ff_storyview_button_text">' . $storyview_data->button_text . '</span>';
                $storyview_button .= '</a>';
            }

            return $storyview_button . $storyview_blocks;

            return;
        }
    }

    return;
}

function ff_storyview_frontend_css(){
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Lily+Script+One&display=swap&subset=latin-ext" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=latin-ext" rel="stylesheet">';

    if( WP_DEBUG && WP_DEBUG === true ){
        // display normal CSS in dev mode
        echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview_frontend.css?v=' . date( "YmdHis" ), __FILE__ ) ) . '" />';
    } else {
        // display minified CSS in production
        echo '<link rel="stylesheet" href="' . esc_url( plugins_url( 'assets/css/storyview_frontend.min.css?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__ ) ) . '" />';
    }

}

function ff_storyview_frontend_js(){
    if( WP_DEBUG && WP_DEBUG === true ){
        echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview_frontend.js?v=' . date( "YmdHis" ), __FILE__ ) ) . '"></script>';
    } else {
        echo '<script src="' . esc_url( plugins_url( 'assets/scripts/storyview_frontend.min.js?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__ ) ) . '"></script>';
    }
}

// on activation
register_activation_hook(__FILE__ , "activate");

// on deactivation
register_deactivation_hook(__FILE__ , "deactivate");

add_action('load-post.php', 'ff_storyview_setup');
add_action('load-post-new.php', 'ff_storyview_setup');
add_shortcode(FF_STORYVIEW_SHORTCODE, 'ff_storyview_display');

/**
 * AMP Stories support
 */

function storyview_amp_query_vars($query_vars){
    $query_vars[] = "storyview_amp";
    return $query_vars;
}

function storyview_amp_template($template){
    global $wp;
    if(array_key_exists("storyview_amp", $wp->query_vars) && $wp->query_vars["storyview_amp"] == "1"){
        $template = dirname(__FILE__) . "/views/frontend_amp_view.php";
    }

    return $template;
}

add_filter("query_vars", "storyview_amp_query_vars");
add_filter("single_template", "storyview_amp_template");

/**
 * Story View custom settings
 * - AMP Story defaults:
 *  - Logo
 *  - Author name
 *  - Analytics ID
 * - General defaults
 *  - Default button text
 *  - Default button type
 *  - Default text block position
 *  - Default text alignment
 *  - Default font family
 *  - Default font size
 *  - Default text block background
 *  - Default font color
 *  - Default custom block background color
 *  - Previous button label
 *  - Next button label
 */

function storyview_top_level_menu(){
    // Top level menu
    add_menu_page(
		'⚡ Story View Settings',
		'Story View',
		'manage_options',
		'storyview_settings',
		'storyview_top_level_menu_display',
		'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTAiIHZpZXdCb3g9IjAgMCA1MCA1MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik00NSAyNUM0NSAzNi4wNDU3IDM2LjA0NTcgNDUgMjUgNDVDMTMuOTU0MyA0NSA1IDM2LjA0NTcgNSAyNUM1IDEzLjk1NDMgMTMuOTU0MyA1IDI1IDVDMzYuMDQ1NyA1IDQ1IDEzLjk1NDMgNDUgMjVaTTUwIDI1QzUwIDM4LjgwNzEgMzguODA3MSA1MCAyNSA1MEMxMS4xOTI5IDUwIDAgMzguODA3MSAwIDI1QzAgMTEuMTkyOSAxMS4xOTI5IDAgMjUgMEMzOC44MDcxIDAgNTAgMTEuMTkyOSA1MCAyNVpNMTIuNSAyNS42MzU2SDI0LjE1OTRMMjIuMjQ1OCAzNy41TDI5Ljg3MjkgMzAuOTMyMkwzNy41MDAxIDI0LjM2NDRIMjUuODQwNkwyNy43NTQyIDEyLjVMMjAuMTI3MSAxOS4wNjc4TDEyLjUgMjUuNjM1NloiIGZpbGw9IndoaXRlIi8+Cjwvc3ZnPgo=',
		100
    );
}

function storyview_top_level_menu_display(){
    include_once("includes/button_designer/button_designer.php");
    include_once("views/admin_story_view_settings.php");
}

function storyview_settings(){
    // Share settings
    register_setting("ff_storyview_share_options_group", "ff_storyview_default_share_enabled");

    // AMP settings
    register_setting("ff_storyview_amp_options_group", "ff_storyview_amp_publisher_logo");
    register_setting("ff_storyview_amp_options_group", "ff_storyview_amp_author_name");
    register_setting("ff_storyview_amp_options_group", "ff_storyview_amp_analytics_id");

    // General settings
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_button_text");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_button_type");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_button_type_other_code");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_text_position");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_text_alignment");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_font_family");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_font_size");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_text_background_color");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_text_font_color");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_custom_block_background_color");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_previous_button_label");
    register_setting("ff_storyview_general_options_group", "ff_storyview_default_next_button_label");
}

function storyview_settings_menu($links){
    $storyview_settings_link = '<a href="admin.php?page=storyview_settings&tab=general">Settings</a>';
    array_push($links, $storyview_settings_link);

    return $links;
}

/**
 * Display plugin settings menu in the WP sidebar
 */
add_action("admin_menu", "storyview_top_level_menu");
add_action("admin_init", "storyview_settings");
add_filter("plugin_action_links_" . plugin_basename(__FILE__), "storyview_settings_menu");

/**
 * Load custom CSS for plugin settings page
 */
function ff_storyview_load_settings_style($hook) {
    if($hook == "toplevel_page_storyview_settings") {
        wp_enqueue_style( 'ff_storyview_settings_css', plugins_url('assets/css/storyview_settings.min.css?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__) );
        wp_enqueue_script( 'ff_storyview_settings_js', plugins_url('assets/scripts/storyview_settings.min.js?v=' . FF_STORYVIEW_PLUGIN_VERSION, __FILE__) );

        wp_enqueue_style( 'ff_storyview_font_roboto', 'https://fonts.googleapis.com/css?family=Roboto:700&display=swap&subset=latin-ext', false );
        wp_enqueue_style( 'ff_storyview_font_rounded', 'https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700&display=swap&subset=latin-ext', false );
        wp_enqueue_style( 'ff_storyview_font_lily', 'https://fonts.googleapis.com/css?family=Lily+Script+One&display=swap&subset=latin-ext', false );
        wp_enqueue_style( 'ff_storyview_font_montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=latin-ext', false );

        wp_enqueue_style( 'ff_storyview_settings_selectric_css', plugins_url('assets/css/selectric.min.css', __FILE__) );
        wp_enqueue_script( 'ff_storyview_settings_selectric_js', plugins_url('assets/scripts/jquery.selectric.min.js', __FILE__) );

        wp_enqueue_style( 'ff_storyview_settings_spectrum_css', plugins_url('assets/css/spectrum.min.css', __FILE__) );
        wp_enqueue_script( 'ff_storyview_settings_spectrum_js', plugins_url('assets/scripts/spectrum.min.js', __FILE__) );
    }
}
add_action("admin_enqueue_scripts", "ff_storyview_load_settings_style");

/**
 * Widget
 */
include_once("includes/storyview_widget.php");
add_action("widgets_init", function(){
    register_widget("FF_Storyview_Widget");
});

/**
 * Process frontend ajax requests
 */
function storyview_ajax_action_frontend() {
    $storyview_action = $_POST["storyviewAction"];
  
    switch ( $storyview_action ) {
      case "display":
        // display story
        $storyview_content = ff_storyview_display( intval( $_POST["storyID"]) );
        wp_send_json( array("story" => $storyview_content ) );
        break;
  
      default:
        break;
    }
    
    wp_die();
  }

add_action( "wp_ajax_nopriv_storyview_ajax_frontend_action", "storyview_ajax_action_frontend" );
add_action( "wp_ajax_storyview_ajax_frontend_action", "storyview_ajax_action_frontend" );

require 'includes/updatechecker/plugin-update-checker.php';
$MyUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://demo.storyviewplugin.com/updater/?action=get_metadata&slug=storyview',
	__FILE__,
	'storyview'
);