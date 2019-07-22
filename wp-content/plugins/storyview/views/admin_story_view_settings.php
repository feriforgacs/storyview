<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

$active_tab = "general";

if($_GET["tab"]){
  $active_tab = $_GET["tab"];

  switch($active_tab){
    case "general":
      $active_tab = "general";
      break;

    case "amp_settings":
      $active_tab = "amp_settings";
      break;

    default:
      $active_tab = "general";
      break;
  }
}

?>
<div class="wrap">
  <h1>⚡ Story View Settings</h1>

  <div class="nav-tabs">
    <h2 class="nav-tab-wrapper">
      <a href="admin.php?page=storyview_settings&tab=general" class="nav-tab <?php echo ($active_tab == "general") ? 'nav-tab-active' : ''; ?>">General</a>
      <a href="admin.php?page=storyview_settings&tab=amp_settings" class="nav-tab <?php echo ($active_tab == "amp_settings") ? 'nav-tab-active' : ''; ?>">AMP Settings</a>
    </h2>
  </div>

  <?php
  settings_errors();
  ?>

  <form method="post" action="options.php">
    <?php
    switch($active_tab){
      case "amp_settings":
        /**
         * Display form to edit default AMP Settings
         */
        settings_fields("ff_storyview_amp_options_group");
        do_settings_sections("ff_storyview_amp_options_group");
        wp_enqueue_media();

        ?>
        <h3>AMP Story Default Settings</h3>
        <p>You can always <strong>overwrite</strong> the default settings by using different values at your posts.</p>
        <hr />
        <table class="form-table">
          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_amp_publisher_logo">Publisher logo</label><br />
              <div id="ff_storyview_amp_publisher_logo_preview" <?php
              if(esc_attr(get_option('ff_storyview_amp_publisher_logo'))){
                echo 'style="display: block;"';
              } else {
                echo 'style="display: none;"';
              }
              ?>>
                  <img id="ff_storyview_amp_publisher_logo_preview_image" style="width: 96px; height: 96px;" src="<?php echo esc_attr( get_option('ff_storyview_amp_publisher_logo') ); ?>" />
                  <button class="ff_storyview_publisher_logo_delete_button" id="ff_storyview_publisher_logo_delete_button">
                    <i><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></i>
                    <span>Remove Image</span>
                </button>
              </div>
            </th>
            <td>
              <input type="button" id="ff_storyview_amp_publisher_logo_upload" class="button ff_storyview_amp_publisher_logo_upload" value="Select AMP Story Publisher Logo">
              <input type="hidden" name="ff_storyview_amp_publisher_logo" id="ff_storyview_amp_publisher_logo" value="<?php echo esc_attr( get_option('ff_storyview_amp_publisher_logo') ); ?>" />
              <br />
              <small>The file should be a raster file, such as .jpg, .png, or .gif<br />The logo shape should be a square, not a rectangle.<br />The background color should not be transparent.<br />Use one logo per brand that is consistent across AMP stories.<br />The logo should be at least 96x96 pixels.</small>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_amp_author_name">Author name</label>
            </th>
            <td>
              <input type="text" name="ff_storyview_amp_author_name" id="ff_storyview_amp_author_name" value="<?php echo esc_attr( get_option('ff_storyview_amp_author_name') ); ?>" /><br />
              <small>This will be visible on the cover of your AMP Stories.</small>
            </td>
          </tr>
          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_amp_analytics_id">Google Analytics ID</label>
            </th>
            <td>
              <input type="text" name="ff_storyview_amp_analytics_id" id="ff_storyview_amp_analytics_id" value="<?php echo esc_attr( get_option('ff_storyview_amp_analytics_id') ); ?>" /><br />
              <small>You can track the visitors of your AMP Stories by providing a Google Analytics ID.<br />If you don't want to track your AMP Stories, leave this field blank.</small>
            </td>
          </tr>
        </table>
        <?php
        submit_button("Save AMP Story Default Settings");
        break;
      
      default:
        /**
         * Display form to edit general settings
         */
        break;
    }
    ?>
  </form>
</div>