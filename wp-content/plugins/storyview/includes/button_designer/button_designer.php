<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

global $wpdb;
$table_name = FF_STORYVIEW_CUSTOM_BUTTONS_TABLE;

$button_layout_types = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
$button_layout_types_display_names = [
  "1" => "Layout 1",
  "2" => "Layout 2",
  "3" => "Layout 3",
  "4" => "Layout 4",
  "5" => "Layout 5",
  "6" => "Layout 6",
  "7" => "Layout 7",
  "8" => "Layout 8",
  "9" => "Layout 9",
  "10" => "Layout 10"
];

$button_background_types = ["color", "linear-gradient"];
$button_background_types_display_names = [
  "color" => "Solid color",
  "linear-gradient" => "Linear Gradient",
  "radial-gradient" => "Radial Gradient"
];

$button_text_alignments = ["left", "center", "right"];

$button_font_families = ["default", "arial", "courier", "roboto", "rounded", "lily", "montserrat"];
$button_font_families_display_names = [
  "default" => "Default (the font family of your posts)", 
  "arial" => "Arial", 
  "courier" => "Courier", 
  "roboto" => "Roboto", 
  "rounded" => "Rounded", 
  "lily" => "Lily", 
  "montserrat" => "Montserrat"
];

/**
 * Default button data
 */
$button_data_default = [
  "button_name" => "",
  "button_layout" => 1,
  "button_background_type" => "color",
  "button_background_color" => "#21a1fd",
  "button_background_gradient_start" => "#b721ff",
  "button_background_gradient_end" => "#21a1fd",
  "button_font_family" => "default",
  "button_font_color" => "#333333",
  "button_font_size" => "14px",
  "button_text_alignment" => "left",
  "button_border_width" => 1,
  "button_border_color" => "#ad11a6",
  "button_padding" => "2px",
  "button_custom_css" => ""
];

$button_data = json_decode(json_encode($button_data_default));

/**
 * Save custom button settings
 */
if(isset($_POST["ff_storyview_custom_button_save"])){
  if (!current_user_can("manage_options")) {
      wp_die("Unauthorized user");
  }

  check_admin_referer("ff_storyview_button_designer_nonce");

  // check if table exists in database, create if not
  if ( !function_exists( 'maybe_create_table' ) ) { 
    require_once ABSPATH . '/wp-admin/install-helper.php'; 
  }

  $table_ddl = "CREATE TABLE " . $table_name . " ( `storyview_button_id` INT(11) NOT NULL AUTO_INCREMENT , `storyview_button_name` VARCHAR(250) NOT NULL , `storyview_button_settings` TEXT NOT NULL , PRIMARY KEY (`storyview_button_id`));";
  maybe_create_table($table_name, $table_ddl);

  /**
   * Process posted parameters
   * - button name
   * - button layout
   * - background color
   * - font family
   * - font color
   * - font size
   * - text alignment
   * - border color
   * - border width
   * - padding
   * - margin
   * - custom css
   */

  $button_data = [];
  $button_data["button_name"] = $_POST["button_name"];
  
  $button_data["button_layout"] = intval($_POST["button_layout"]);
  if(!in_array($button_data["button_layout"], $button_layout_types)){
    $button_data["button_layout"] = 1;
  }

  $button_data["button_background_type"] = $_POST["button_background_type"];
  if(!in_array($button_data["button_background_type"], $button_background_types)){
    $button_data["button_background_type"] = "color";
  }

  $button_data["button_background_color"] = $_POST["button_background_color"];
  $button_data["button_background_gradient_start"] = $_POST["button_background_gradient_start"];
  $button_data["button_background_gradient_end"] = $_POST["button_background_gradient_end"];
  $button_data["button_font_family"] = $_POST["button_font_family"];
  $button_data["button_font_color"] = $_POST["button_font_color"];
  $button_data["button_font_size"] = $_POST["button_font_size"];

  if(strpos($button_data["button_font_size"], "p") === false && strpos($button_data["button_font_size"], "em") === false && strpos($button_data["button_font_size"], "%") === false){
    $button_data["button_font_size"] = $button_data["button_font_size"] . "px";
  }
  
  $button_data["button_text_alignment"] = $_POST["button_text_alignment"];
  if(!in_array($button_data["button_text_alignment"], $button_text_alignments)){
    $button_data["button_text_alignment"] = "left";
  }

  $button_data["button_border_width"] = $_POST["button_border_width"];
  if(strpos($button_data["button_border_width"], "p") === false && strpos($button_data["button_border_width"], "em") === false && strpos($button_data["button_border_width"], "%") === false){
    $button_data["button_border_width"] = $button_data["button_border_width"] . "px";
  }

  $button_data["button_border_color"] = $_POST["button_border_color"];
  $button_data["button_padding"] = $_POST["button_padding"];
  if(strpos($button_data["button_padding"], "p") === false && strpos($button_data["button_padding"], "em") === false && strpos($button_data["button_padding"], "%") === false){
    $button_data["button_padding"] = $button_data["button_padding"] . "px";
  }

  $button_data["button_custom_css"] = $_POST["button_custom_css"];

  $button_settings = json_encode($button_data, JSON_UNESCAPED_UNICODE|JSON_HEX_APOS|JSON_HEX_QUOT);

  /**
   * Check button parameter
   */
  if(isset($_GET["btn"])){
    /**
     * Update current button data
     */
    $current_btn = intval($_GET["btn"]);
    $db_result = $wpdb->update(
      $table_name,
      array(
        "storyview_button_name" => $button_data["button_name"],
        "storyview_button_settings" => $button_settings
      ),
      array(
        "storyview_button_id" => $current_btn
      )
    );
  } else {
    /**
     * Create new button with posted data
     */
    $db_result = $wpdb->insert(
      $table_name,
      array(
        "storyview_button_name" => $button_data["button_name"],
        "storyview_button_settings" => $button_settings
      )
    );

    if($db_result){
      $current_btn = $wpdb->insert_id;
    }
  }

  if(!$db_result){
    // db error, redirect
    wp_redirect("admin.php?page=storyview_settings&tab=button_designer&result=db_error");
    exit();
  } else {
    // button data saved
    wp_redirect("admin.php?page=storyview_settings&tab=button_designer&btn=" . $current_btn . "&result=success");
    exit();
  }
}

/**
 * Get button designs from the db
 */
$storyview_custom_buttons = $wpdb->get_results("SELECT storyview_button_id, storyview_button_name FROM " . $table_name . " ORDER BY storyview_button_id DESC");

/**
 * Get selected button design data from the db
 */
if(isset($_GET["btn"])){
  $current_btn = intval($_GET["btn"]);
  $button_data_temp = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE storyview_button_id = " . $current_btn);

  if($button_data_temp && property_exists($button_data_temp, "storyview_button_settings")){
    $button_data = [];
    $button_data = json_decode($button_data_temp->storyview_button_settings);
  }
}

/**
 * Delete button
 */
if(isset($_GET["action"]) && $_GET["action"] == "delete" && isset($_GET["btn"])){
  if (!current_user_can("manage_options")) {
    wp_die("Unauthorized user");
  }

  $current_btn = intval($_GET["btn"]);
  $db_result = $wpdb->delete($table_name, array("storyview_button_id" => $current_btn));

  if(!$db_result){
    // db error, redirect
    wp_redirect("admin.php?page=storyview_settings&tab=button_designer&result=db_error");
    exit();
  } else {
    // button data saved
    wp_redirect("admin.php?page=storyview_settings&tab=button_designer&result=success");
    exit();
  }
}