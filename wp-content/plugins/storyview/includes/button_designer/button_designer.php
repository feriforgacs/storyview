<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

global $wpdb;
$table_name = $wpdb->prefix . "ff_storyview_buttons";

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
  $button_layout_types = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
  if(!in_array($button_data["button_layout"], $button_layout_types)){
    $button_data["button_layout"] = 1;
  }

  $button_data["button_background_type"] = $_POST["button_background_type"];
  $button_background_types = ["color", "linear_gradient", "radial_gradient"];
  if(!in_array($button_data["button_background_type"], $button_background_types)){
    $button_data["button_background_type"] = "color";
  }

  $button_data["button_background_color"] = $_POST["button_background_color"];
  $button_data["button_background_gradient_start"] = $_POST["button_background_gradient_start"];
  $button_data["button_background_gradient_end"] = $_POST["button_background_gradient_end"];
  $button_data["button_font_family"] = $_POST["button_font_family"];
  $button_data["button_font_color"] = $_POST["button_font_color"];
  $button_data["button_font_size"] = $_POST["button_font_size"];
  
  $button_data["button_text_alignment"] = $_POST["button_text_alignment"];
  $button_text_alignments = ["left", "center", "right"];
  if(!in_array($button_data["button_text_alignment"], $button_text_alignments)){
    $button_data["button_text_alignment"] = "left";
  }

  $button_data["button_border_width"] = $_POST["button_border_width"];
  $button_data["button_border_color"] = $_POST["button_border_color"];
  $button_data["button_padding"] = $_POST["button_padding"];
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
    header("Location: admin.php?page=storyview_settings&tab=button_designer&result=db_error");
    return;
  } else {
    // button data saved
    header("Location: admin.php?page=storyview_settings&tab=button_designer&btn=" . $current_btn . "&result=success");
    return;
  }
}

/**
 * Get button designs from the db
 */

/**
 * Get selected button design data from the db
 */
if(isset($_GET["btn"])){
  $current_btn = intval($_GET["btn"]);
  $button_data_temp = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE storyview_button_id = " . $current_btn);

  $button_data = [];
  if(property_exists($button_data_temp, "storyview_button_settings")){
    $button_data = json_decode($button_data_temp->storyview_button_settings);
  }

  echo "<pre>";
  print_r($button_data);
  echo "</pre>";
}