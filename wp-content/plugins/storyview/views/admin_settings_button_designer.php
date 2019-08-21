<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
/**
 * Display form to create new button layout
 */
?>
<form method="POST">
  <?php wp_nonce_field( 'ff_storyview_button_designer_nonce' ); ?>
  <h3>Button Designer</h3>
  <p>Create your own button layouts for your stories.</p>

  <div id="ff_storyview_button_designer_container">
    <div id="ff_storyview_button_designer">
      <div id="ff_storyview_button_designer_editor">
        <h4>Button Editor</h4>

        <form action="">
          <label for="button_name">Button name</label>
          <input type="text" id="button_name" name="button_name" placeholder="eg.: My Custom Button" required="required" value="<?php echo stripslashes_deep(esc_html($button_data->button_name)); ?>" />

          <label for="button_layout">Button Layout</label>

          <div id="button_layout_options">
            <?php
            foreach($button_layout_types as $button_layout){
              ?>
              <div class="button_layout_option">
                <input type="radio" name="button_layout" required="required" value="<?php echo $button_layout; ?>" id="button_layout_<?php echo $button_layout; ?>" <?php
                if($button_layout == $button_data->button_layout){
                  ?>
                  checked="checked"
                  <?php
                }
                ?> />
                <label for="button_layout_<?php echo $button_layout; ?>">
                  <span class="button_layout_name"><?php echo $button_layout_types_display_names[$button_layout]; ?></span>
                  <span class="button_layout_image">
                    <img src="<?php echo esc_url( plugins_url( '../assets/images/custom_buttons/button_layout_' . $button_layout . '.svg', __FILE__ ) ) ?>" />
                  </span>
                </label>
              </div>
              <?php
            }
            ?>
          </div>

          <label for="button_background_type">Background Type</label>
          <select name="button_background_type" id="button_background_type">
            <?php
            foreach($button_background_types as $background_type){
              ?>
              <option value="<?php echo $background_type; ?>" <?php
              if($background_type == $button_data->button_background_type){
                ?>
                selected="selected"
                <?php
              }
              ?>>
                <?php
                echo $button_background_types_display_names[$background_type];
                ?>
              </option>
              <?php
            }
            ?>
          </select>

          <div id="background_colorpicker">
            <div id="color" <?php if($button_data->button_background_type != "color"){
              ?>
              class="hidden"
              <?php
            } ?> >
              <label for="button_background_color">Background Color</label>
              <input type="text" name="button_background_color" id="button_background_color" value="<?php echo stripslashes_deep(esc_html($button_data->button_background_color)); ?>" />
            </div>

            <div id="gradient" <?php if($button_data->button_background_type == "color"){
              ?>
              class="hidden"
              <?php
            } ?>>
              <label for="button_background_gradient_start">Background Gradient Start Color</label>
              <input type="text" name="button_background_gradient_start" id="button_background_gradient_start" value="<?php echo stripslashes_deep(esc_html($button_data->button_background_gradient_start)); ?>" />

              <label for="button_background_gradient_end">Background Gradient End Color</label>
              <input type="text" name="button_background_gradient_end" id="button_background_gradient_end" value="<?php echo stripslashes_deep(esc_html($button_data->button_background_gradient_end)); ?>" />
            </div>
          </div>

          <label for="button_font_family">Font Family</label>
          <select name="button_font_family" id="button_font_family">
            <?php
            foreach($button_font_families as $button_font_family){
              ?>
              <option value="<?php echo $button_font_family; ?>" <?php
              if($button_font_family == $button_data->button_font_family){
                ?>
                selected="selected"
                <?php
              }
              ?>>
                <?php echo $button_font_families_display_names[$button_font_family]; ?>
              </option>
              <?php
            }
            ?>
          </select>

          <label for="button_font_color">Font Color</label>
          <input type="text" name="button_font_color" id="button_font_color" value="<?php echo stripslashes_deep(esc_html($button_data->button_font_color)); ?>" />

          <label for="button_font_size">Font Size<br />
            <small>You can use numbers, or css values. Eg.: 10, 10px, 1rem, 10px 0 0 5px, etc</small>
          </label>
          <input type="text" name="button_font_size" id="button_font_size" placeholder="eg.: 14px, or 1rem, or .5rem" value="<?php echo stripslashes_deep(esc_html($button_data->button_font_size)); ?>" />

          <label for="button_text_alignment">Text Alignment</label>
          <select name="button_text_alignment" id="button_text_alignment">
            <?php
            foreach($button_text_alignments as $button_text_alignment){
              ?>
              <option value="<?php echo $button_text_alignment ?>" <?php
              if($button_text_alignment == $button_data->button_text_alignment){
                ?>
                selected="selected"
                <?php
              }
              ?>>
                <?php echo ucfirst($button_text_alignment); ?>
              </option>
              <?php
            }
            ?>
          </select>

          <label for="button_border_width">Border Width<br />
            <small>The number you define here will be used as pixel values. If you insert 10, it will be 10px.</small>
          </label>
          <input type="text" name="button_border_width" id="button_border_width" value="<?php echo stripslashes_deep(esc_html($button_data->button_border_width)); ?>" />

          <label for="button_border_color">Border Color</label>
          <input type="text" name="button_border_color" id="button_border_color" value="<?php echo stripslashes_deep(esc_html($button_data->button_border_color)); ?>" />

          <label for="button_padding">Padding<br />
            <small>You can use numbers, or css values. Eg.: 10, 10px, 1rem, 10px 0 0 5px, etc</small>
          </label>
          <input type="text" name="button_padding" id="button_padding" value="<?php echo stripslashes_deep(esc_html($button_data->button_padding)); ?>" />

          <label for="button_custom_css">Custom CSS<br />
            <small>This will be attached to your button as inline CSS</small>
          </label>
          <textarea name="button_custom_css" id="button_custom_css" cols="30" rows="5"><?php echo stripslashes_deep(esc_html($button_data->button_custom_css)); ?></textarea>

          <?php
          $button_label = "Save Button Design";
          if(isset($_GET["btn"])){
            $button_label = "Update Button Design";
          }
          ?>
          <p class="submit"><input type="submit" name="ff_storyview_custom_button_save" id="submit" class="button button-primary" value="<?php echo $button_label; ?>"></p>
        </form>
      </div> 

      <div id="ff_storyview_button_designer_preview">
        <h4>Button Preview</h4>

        <div id="button_container">
          <div id="button" class="ff_storyview_button_layout_1">
            <div class="button_image">Image</div>
            <div class="button_text">Button Text</div>
          </div>
        </div>

      </div>
    </div>

  </div>
</form>

<div id="ff_storyview_button_designer_buttons_list_container">
  <h2>Previously Created Buttons</h2>
  <p>In this list, you can see the buttons you created previously. Click on the Edit button to change their settings.</p>
  <div id="ff_storyview_button_designer_buttons_list">
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Button name</th>
          <th class="button_actions_header">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach($storyview_custom_buttons as $storyview_custom_button){
          ?>
          <tr>
            <td class="button_nr"><?php echo $i; ?>.</td>
            <td class="button_name"><?php echo stripslashes_deep($storyview_custom_button->storyview_button_name); ?></td>
            <td class="button_actions">
              <a href="admin.php?page=storyview_settings&tab=button_designer&btn=<?php echo $storyview_custom_button->storyview_button_id; ?>" class="ff_storyview_button_designer_edit_button">
                <span class="icon"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.1213 4.53553L15.4142 3.82843L6.22183 13.0208L6.92893 13.7279L16.1213 4.53553ZM16.8284 5.24264L7.63604 14.435L8.34315 15.1421L17.5355 5.94975L16.8284 5.24264ZM14 2.41421L14.7071 3.12132L5.51472 12.3137L4.80761 11.6066L14 2.41421ZM14.7071 1.70711L14 1L13.2929 1.70711L4.10051 10.8995L3.3934 11.6066L2.68629 12.3137L3.3934 13.0208L2.68629 13.7279L3.3934 14.435L2.68629 15.1421L3.3934 15.8492L2.68629 16.5563L3.3934 17.2635L4.10051 16.5563L4.80761 17.2635L5.51472 16.5563L6.22183 17.2635L6.92893 16.5563L7.63604 17.2635L8.34315 16.5563L9.05025 15.8492L18.2426 6.65685L18.9497 5.94975L18.2426 5.24264L14.7071 1.70711ZM6.22183 15.8492L6.92893 15.1421L4.80761 13.0208L4.10051 13.7279L4.80761 14.435L4.10051 15.1421L4.80761 15.8492L5.51472 15.1421L6.22183 15.8492Z" />
                  </svg></span>
                <span class="text">Edit</span>
              </a>
              
              <a href="admin.php?page=storyview_settings&tab=button_designer&action=delete&btn=<?php echo $storyview_custom_button->storyview_button_id; ?>" class="ff_storyview_button_designer_delete_button">
                <span class="icon"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></span>
                <span class="text">Delete</span>
              </a>
            </td>
          </tr>
          <?php
          $i++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>