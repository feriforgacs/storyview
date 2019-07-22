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
              <small>Preview:</small>
              <div id="ff_storyview_amp_publisher_logo_preview" <?php
              if(esc_attr(get_option('ff_storyview_amp_publisher_logo'))){
                echo 'style="display: block;"';
              } else {
                echo 'style="display: none;"';
              }
              ?>>
                  <img id="ff_storyview_amp_publisher_logo_preview_image" style="width: 96px; height: 96px;" src="<?php echo esc_attr( get_option('ff_storyview_amp_publisher_logo') ); ?>" />
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

<script>
jQuery(document).ready(function($){
/**
 * Handle AMP Story Publisher logo select
 */
let file_frame_amp_publisher_logo;
  $("#ff_storyview_amp_publisher_logo_upload").on("click", function( event ){
      event.preventDefault();

      // open the file frame if exists
      if (file_frame_amp_publisher_logo) {
          file_frame_amp_publisher_logo.open();
          return;
      }
      
      // create the file frame
      file_frame_amp_publisher_logo = wp.media.frames.file_frame_amp_publisher_logo = wp.media({
          title: "Select image",
          button: {
              text: "Use this image",
          },
          multiple: false
      });
      
      // process data after the file was selected in the file frame
      file_frame_amp_publisher_logo.on("select", function() {
          attachment = file_frame_amp_publisher_logo.state().get("selection").first().toJSON();

          // add image url value to the story view block hidden image field
          $("#ff_storyview_amp_publisher_logo").val(attachment.url);

          // set image for preview
          $("#ff_storyview_amp_publisher_logo_preview_image").attr({ "src": attachment.url });
          $("#ff_storyview_amp_publisher_logo_preview").show();
      });
      
      // open the file frame
      file_frame_amp_publisher_logo.open();
  });
});
</script>