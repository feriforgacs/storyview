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

    case "share_settings":
      $active_tab = "share_settings";
      break;

    case "button_designer":
      $active_tab = "button_designer";
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

      <a href="admin.php?page=storyview_settings&tab=share_settings" class="nav-tab <?php echo ($active_tab == "share_settings") ? 'nav-tab-active' : ''; ?>">Share Settings</a>

      <a href="admin.php?page=storyview_settings&tab=button_designer" class="nav-tab <?php echo ($active_tab == "button_designer") ? 'nav-tab-active' : ''; ?>">Button Designer</a>
    </h2>
  </div>

  <?php
  settings_errors();
  
  if($active_tab != "button_designer"){
    ?>
    <form method="post" action="options.php">
    <?php
  }
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
              <div id="ff_storyview_button_types_content">
                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="1" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "1") ? 'checked="checked"' : ''; ?>>
                    <i>Type 1</i>

                    <!-- button #1 -->
                    <button class="ff_storyview_button ff_storyview_button_type_1">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #1 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="1_i" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "1_i") ? 'checked="checked"' : ''; ?>>
                    <i>Type 1 Inverse</i>

                    <!-- button #1_i -->
                    <button class="ff_storyview_button ff_storyview_button_type_1_i">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #1_i -->
                  </label>
                </div>

                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="2" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "2") ? 'checked="checked"' : ''; ?>>
                    <i>Type 2</i>

                    <!-- button #2 -->
                    <button class="ff_storyview_button ff_storyview_button_type_2">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #2 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="2_i" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "2_i") ? 'checked="checked"' : ''; ?>>
                    <i>Type 2 Inverse</i>

                    <!-- button #2_i -->
                    <button class="ff_storyview_button ff_storyview_button_type_2_i">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #2_i -->
                  </label>
                </div>

                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="3" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "3") ? 'checked="checked"' : ''; ?>>
                    <i>Type 3</i>

                    <!-- button #3 -->
                    <button class="ff_storyview_button ff_storyview_button_type_3">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #3 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="3_i" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "3_i") ? 'checked="checked"' : ''; ?>>
                    <i>Type 3 Inverse</i>

                    <!-- button #3_i -->
                    <button class="ff_storyview_button ff_storyview_button_type_3_i">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #3_i -->
                  </label>
                </div>

                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="4" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "4") ? 'checked="checked"' : ''; ?>>
                    <i>Type 4</i>

                    <!-- button #4 -->
                    <button class="ff_storyview_button ff_storyview_button_type_4">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #4 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="4_i" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "4_i") ? 'checked="checked"' : ''; ?>>
                    <i>Type 4 Inverse</i>

                    <!-- button #4_i -->
                    <button class="ff_storyview_button ff_storyview_button_type_4_i">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #4_i -->
                  </label>
                </div>

                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="5" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "5") ? 'checked="checked"' : ''; ?>>
                    <i>Type 5</i>

                    <!-- button #5 -->
                    <button class="ff_storyview_button ff_storyview_button_type_5">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #5 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="5_i" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "5_i") ? 'checked="checked"' : ''; ?>>
                    <i>Type 5 Inverse</i>

                    <!-- button #5_i -->
                    <button class="ff_storyview_button ff_storyview_button_type_5_i">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #5_i -->
                  </label>
                </div>

                <div class="ff_storyview_button_types_button_block">
                  <label class="ff_storyview_button_type_label">
                    <input type="radio" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="6" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "6") ? 'checked="checked"' : ''; ?>>
                    <i>Type 6</i>

                    <!-- button #6 -->
                    <button class="ff_storyview_button ff_storyview_button_type_6">
                        <i class="ff_storyview_button_icon" style="background-image: none;"></i><span class="ff_storyview_button_text"><?php if(esc_attr(get_option('ff_storyview_default_button_text'))){
                          echo esc_attr(get_option('ff_storyview_default_button_text'));
                        } ?></span>
                    </button>
                    <!-- end button #6 -->
                  </label>

                  <label class="ff_storyview_button_type_label">
                    <input type="radio" id="ff_storyview_button_type_other" name="ff_storyview_default_button_type" class="ff_storyview_button_type" value="other" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "other") ? 'checked="checked"' : ''; ?>>
                    <i>Other (own code)</i>
                  </label>
                </div>
              </div>

              <div id="ff_storyview_button_types_other" <?php echo (esc_attr(get_option('ff_storyview_default_button_type')) == "other") ? 'style="display: block;"' : ''; ?>>
                <label class="ff_storyview_label" for="ff_storyview_button_type_other_code">Custom Button for Story View Button (You can add custom HTML code)</label>
                <input class="components-text-control__input" type="text" id="ff_storyview_button_type_other_code" name="ff_storyview_default_button_type_other_code" value="<?php if(esc_attr(get_option('ff_storyview_default_button_type_other_code'))){
                    echo esc_html(esc_attr(get_option('ff_storyview_default_button_type_other_code')));
                } ?>" />
                <br /><small>Don't use "a" or "button" tags in your code.<br />Use the following shortcodes to display the button text, and the button image:
                    <pre>{{button_text}} {{button_image}}</pre>
                    Eg.: &lt;span class="my_custom_button"&gt;&lt;img src="{{button_image}}" /&gt; {{button_text}}&lt;/span&gt;
                </small>
              </div>
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
              <select name="ff_storyview_default_font_family" class="custom-select font-family-select" id="ff_storyview_default_font_family">
                <option value="arial" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "arial") ? 'selected="selected"' : ''; ?>>Arial</option>    
                <option value="courier" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "courier") ? 'selected="selected"' : ''; ?>>Courier</option>
                <option value="roboto" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "roboto") ? 'selected="selected"' : ''; ?>>Roboto</option>
                <option value="rounded" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "rounded") ? 'selected="selected"' : ''; ?>>Rounded</option>
                <option value="lily" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "lily") ? 'selected="selected"' : ''; ?>>Lily</option>
                <option value="montserrat" <?php echo (esc_attr(get_option('ff_storyview_default_font_family')) == "montserrat") ? 'selected="selected"' : ''; ?>>Montserrat</option>
              </select>
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
              <select name="ff_storyview_default_font_size" class="custom-select font-size-select" id="ff_storyview_default_font_size">
                <option value="f12" <?php echo (esc_attr(get_option('ff_storyview_default_font_size')) == "f12") ? 'selected="selected"' : ''; ?>>12px</option>
                <option value="f14" <?php echo (esc_attr(get_option('ff_storyview_default_font_size')) == "f14") ? 'selected="selected"' : ''; ?>>14px</option>
                <option value="f18" <?php echo (esc_attr(get_option('ff_storyview_default_font_size')) == "f18") ? 'selected="selected"' : ''; ?>>18px</option>
                <option value="f24" <?php echo (esc_attr(get_option('ff_storyview_default_font_size')) == "f24") ? 'selected="selected"' : ''; ?>>24px</option>
                <option value="f36" <?php echo (esc_attr(get_option('ff_storyview_default_font_size')) == "f36") ? 'selected="selected"' : ''; ?>>36px</option>
              </select>
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
              <input type="text" name="ff_storyview_default_previous_button_label" id="ff_storyview_default_previous_button_label" value="<?php echo esc_attr( get_option('ff_storyview_default_previous_button_label') ); ?>" placeholder="Previous" />
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
              <input type="text" name="ff_storyview_default_next_button_label" id="ff_storyview_default_next_button_label" value="<?php echo esc_attr( get_option('ff_storyview_default_next_button_label') ); ?>" placeholder="Next" />
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
      
      case "share_settings":
        /**
         * Display form to edit default Share Settings
         */
        settings_fields("ff_storyview_share_options_group");
        do_settings_sections("ff_storyview_share_options_group");
        wp_enqueue_media();

        ?>
        <h3>Share Settings</h3>
        <p>If you turn this on, social share functions will be enabled for all your Story Views. If you want to control the share feature at every story you create, don't turn this on.</p>
        <hr />
        <table class="form-table">
          <tr valign="top">
            <th scope="row">
              <label for="ff_storyview_default_share_enabled">Enable Social Share for Story View</label>
            </th>
            <td>
              <input type="checkbox" name="ff_storyview_default_share_enabled" id="ff_storyview_default_share_enabled" value="1" <?php
              if(esc_attr( get_option('ff_storyview_default_share_enabled') ) == 1 ) {
                ?> checked="checked" <?php
              } ?>
              />
            </td>
          </tr>
          
        </table>
        <?php
        submit_button("Save Share Settings");
        break;
      

      case "button_designer":
        /**
         * Display form to create new button layout
         */
        ?>
        <form method="POST">
          <?php wp_nonce_field( 'ff_storyview_button_designer_nonce' ); ?>
          <h3>Button Designer</h3>
          <p>Create your own button layouts to embed your stories into your posts.</p>
          <p class="submit"><input type="submit" name="ff_storyview_custom_button_save" id="submit" class="button button-primary" value="Save Button Design"></p>
        </form>
        <?php
        break;
      
      default:
        /**
         * Display form to edit general settings
         */
        break;
    }
  
  if($active_tab != "button_designer"){
    ?>
    </form>
    <?php
  }
  ?>
</div>