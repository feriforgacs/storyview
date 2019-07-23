<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

$active_tab = "general";

if(isset($_GET["tab"])){
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
      case "general":
        /**
         * Display form to edit default settings
         */
        settings_fields("ff_storyview_general_options_group");
        do_settings_sections("ff_storyview_general_options_group");
        wp_enqueue_media();

        ?>
        <h3>General Settings</h3>
        <p>You can always <strong>override</strong> the default settings by using different values at your posts.</p>
        <hr />
        <table class="form-table">
          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_button_text">Default Button Text</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_button_text" id="ff_storyview_default_button_text" value="<?php echo esc_attr( get_option('ff_storyview_default_button_text') ); ?>" />
            </td>
            <td>
              <small>This will be the default text for your Story View button.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_button_type">Default Button Type</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_button_type" id="ff_storyview_default_button_type" value="<?php echo esc_attr( get_option('ff_storyview_default_button_type') ); ?>" />
            </td>
            <td>
              <small>This button will be selected by default when you turn on Story View for a post</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_text_position">Default Text Block Position</label><br />
            </th>
            <td>
              <div class="ff_storyview_button_group">
                <label class="ff_storyview_block_item_text_position_label <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_top") ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_position" value="ff_storyview_text_block_top" <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_top") ? 'checked="checked"' : ''; ?>>
                  <span>Top</span>
                  <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"></rect>
                  <rect x="7" y="4" width="6" height="3" fill="#444B54"></rect>
                  </svg>
                  </i>
                </label>

                <label class="ff_storyview_block_item_text_position_label <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_middle") ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_position" value="ff_storyview_text_block_middle" <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_middle") ? 'checked="checked"' : ''; ?>>
                  <span>Middle</span>
                  <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"></rect>
                  <rect x="7" y="9" width="6" height="3" fill="#444B54"></rect>
                  </svg>
                  </i>
                </label>

                <label class="ff_storyview_block_item_text_position_label <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_bottom") ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_position" value="ff_storyview_text_block_bottom" <?php echo (esc_attr(get_option('ff_storyview_default_text_position')) == "ff_storyview_text_block_bottom") ? 'checked="checked"' : ''; ?>>
                  <span>Bottom</span>
                  <i title="bottom"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"></rect>
                  <rect x="7" y="13" width="6" height="3" fill="#444B54"></rect>
                  </svg>
                  </i>
                </label>
              </div>
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the text position that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_text_alignment">Default text alignment</label><br />
            </th>
            <td>
              <div class="ff_storyview_button_group">
                <label class="ff_storyview_block_item_text_align_label <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_left') ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_alignment" value="ff_storyview_text_align_left" <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_left') ? 'checked="checked"' : ''; ?>>
                  <span>Left</span>
                  <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                </label>

                <label class="ff_storyview_block_item_text_align_label <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_center') ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_alignment" value="ff_storyview_text_align_center" <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_center') ? 'checked="checked"' : ''; ?>>
                  <span>Center</span>
                  <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                </label>

                <label class="ff_storyview_block_item_text_align_label <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_right') ? 'activ' : ''; ?>">
                  <input type="radio" name="ff_storyview_default_text_alignment" value="ff_storyview_text_align_right" <?php echo (esc_attr(get_option('ff_storyview_default_text_alignment')) == 'ff_storyview_text_align_right') ? 'checked="checked"' : ''; ?>>
                  <span>Right</span>
                  <i title="right"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg></i>
                </label>
              </div>
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the text alignment that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_font_family">Default Font Family</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_font_family" id="ff_storyview_default_font_family" value="<?php echo esc_attr( get_option('ff_storyview_default_font_family') ); ?>" />
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the font family that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_font_size">Default Font Size</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_font_size" id="ff_storyview_default_font_size" value="<?php echo esc_attr( get_option('ff_storyview_default_font_size') ); ?>" />
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the font size that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_text_background_color">Default Text Block Background</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_text_background_color" id="ff_storyview_default_text_background_color" value="<?php echo esc_attr( get_option('ff_storyview_default_text_background_color') ); ?>" />
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the background color that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_text_font_color">Default Font Color</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_text_font_color" id="ff_storyview_default_text_font_color" value="<?php echo esc_attr( get_option('ff_storyview_default_text_font_color') ); ?>" />
            </td>
            <td>
              <small>When you add a new Classic Block to your story, this is the font color that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_custom_block_background_color">Default Custom Block Bacground</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_custom_block_background_color" id="ff_storyview_default_custom_block_background_color" value="<?php echo esc_attr( get_option('ff_storyview_default_custom_block_background_color') ); ?>" />
            </td>
            <td>
              <small>When you add a new Custom Block to your story, this is the background color that will be selected by default.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_previous_button_label">Default Label For Previous Button</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_previous_button_label" id="ff_storyview_default_previous_button_label" value="<?php echo esc_attr( get_option('ff_storyview_default_previous_button_label') ); ?>" />
            </td>
            <td>
              <small>This is the text that will be visible for the "Previous" button under your story blocks.</small>
            </td>
          </tr>

          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_next_button_label">Default Label For Next Button</label><br />
            </th>
            <td>
              <input type="text" name="ff_storyview_default_next_button_label" id="ff_storyview_default_next_button_label" value="<?php echo esc_attr( get_option('ff_storyview_default_next_button_label') ); ?>" />
            </td>
            <td>
              <small>This is the text that will be visible for the "Next" button under your story blocks.</small>
            </td>
          </tr>

        </table>
        <?php
        submit_button("Save General Settings");
        break;
      
      case "amp_settings":
        /**
         * Display form to edit default AMP Settings
         */
        settings_fields("ff_storyview_amp_options_group");
        do_settings_sections("ff_storyview_amp_options_group");
        wp_enqueue_media();

        ?>
        <h3>AMP Story Default Settings</h3>
        <p>You can always <strong>override</strong> the default settings by using different values at your posts.</p>
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