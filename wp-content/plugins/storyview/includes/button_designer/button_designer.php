<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

/**
 * Save custom button settings
 */
if(isset($_POST["ff_storyview_custom_button_save"])){
  global $wpdb;
  if (!current_user_can("manage_options")) {
      wp_die("Unauthorized user");
  }

  check_admin_referer("ff_storyview_button_designer_nonce");

  // check if table exists in database, create if not
  if ( !function_exists( 'maybe_create_table' ) ) { 
    require_once ABSPATH . '/wp-admin/install-helper.php'; 
  }
  $table_name = $wpdb->prefix . "ff_storyview_buttons";
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


  /**
   * Check button parameter
   */
  if(isset($_GET["btn"])){
    /**
     * Update current button data
     */
  } else {
    /**
     * Create new button with posted data
     */
  }
}

/**
 * Get button designs from the db
 */

/**
 * Get selected button design data from the db
 */
