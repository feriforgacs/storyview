<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
?>
<p><strong>Insert the following shortcode to your post to the place where you want to display the Story View button:</strong></p>
<input type="text" class="components-text-control__input" value="[<?php echo FF_STORYVIEW_SHORTCODE; ?>]" onfocus="this.select();" />

<div class="ff_storyview_row">
  <!-- Story View button settings -->
  <div class="ff_storyview_col_md_6">
    <label class="ff_storyview_label" for="ff_storyview_button_text"><strong>Button Text</strong></label>
    <small>This text will be visible next to the thumbnail of your story.<br />
    You can set up a default text on the following page: <a href="admin.php?page=storyview_settings&tab=general" target="_blank">General Settings</a>
    </small><br />
    <input class="components-text-control__input" type="text" id="ff_storyview_button_text" name="ff_storyview_button_text" value="<?php
    echo $default_button_text;
    ?>" />

    <div id="ff_storyview_button_types">
      <label class="ff_storyview_label"><strong>Button Type</strong></label>
      <small>Select a button from the options below.<br />
      You can set up a default button on the following page: <a href="admin.php?page=storyview_settings&tab=general" target="_blank">General Settings</a>. And you can also create your custom buttons: <a href="admin.php?page=storyview_settings&tab=button_designer" target="_blank">Button Designer</a><br />
      The image of the button will be generated from the image of the first (classic) story block</small>
      <p></p>
      <div id="ff_storyview_button_types_content">
        <h4>Your Custom Buttons</h4>
        <div id="ff_storyview_button_types_custom">
          <div class="premium-info">
            <p><span role="img" aria-label="Locket icon">🔒</span> This is a premium feature.</p>
            <p><a href="https://storyviewplugin.com/premium-features.html" target="_blank">Click here to learn more</a> about the premium features of the plugin or visit the following URL to purchase the plugin: <a href="https://gum.co/storyview" target="_blank">https://gum.co/storyview</a></p>
          </div>
        </div>

        <h4>Default Buttons</h4>
        <div id="ff_storyview_button_types_default">
          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1" <?php if($default_button_type == "1"){ ?>checked="checked"<?php } ?> />
              <i>Type 1</i>

              <!-- button #1 -->
              <button class="ff_storyview_button ff_storyview_button_type_1">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #1 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1_i" <?php if($default_button_type == "1_i"){ ?>checked="checked"<?php } ?> />
              <i>Type 1 Inverse</i>

              <!-- button #1_i -->
              <button class="ff_storyview_button ff_storyview_button_type_1_i">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #1_i -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2" <?php if($default_button_type == "2"){ ?>checked="checked"<?php } ?> />
              <i>Type 2</i>

              <!-- button #2 -->
              <button class="ff_storyview_button ff_storyview_button_type_2">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #2 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2_i" <?php if($default_button_type == "2_i"){ ?>checked="checked"<?php } ?> />
              <i>Type 2 Inverse</i>

              <!-- button #2_i -->
              <button class="ff_storyview_button ff_storyview_button_type_2_i">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #2_i -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3" <?php if($default_button_type == "3"){ ?>checked="checked"<?php } ?> />
              <i>Type 3</i>

              <!-- button #3 -->
              <button class="ff_storyview_button ff_storyview_button_type_3">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #3 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3_i" <?php if($default_button_type == "3_i"){ ?>checked="checked"<?php } ?> />
              <i>Type 3 Inverse</i>

              <!-- button #3_i -->
              <button class="ff_storyview_button ff_storyview_button_type_3_i">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #3_i -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4" <?php if($default_button_type == "4"){ ?>checked="checked"<?php } ?> />
              <i>Type 4</i>

              <!-- button #4 -->
              <button class="ff_storyview_button ff_storyview_button_type_4">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #4 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4_i" <?php if($default_button_type == "4_i"){ ?>checked="checked"<?php } ?> />
              <i>Type 4 Inverse</i>

              <!-- button #4_i -->
              <button class="ff_storyview_button ff_storyview_button_type_4_i">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #4_i -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5" <?php if($default_button_type == "5"){ ?>checked="checked"<?php } ?> />
              <i>Type 5</i>

              <!-- button #5 -->
              <button class="ff_storyview_button ff_storyview_button_type_5">
                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #5 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5_i" <?php if($default_button_type == "5_i"){ ?>checked="checked"<?php } ?> />
              <i>Type 5 Inverse</i>

              <!-- button #5_i -->
              <button class="ff_storyview_button ff_storyview_button_type_5_i">
                  <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                    echo $default_button_text;
                    ?></span>
              </button>
              <!-- end button #5_i -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="6" <?php if($default_button_type == "6"){ ?>checked="checked"<?php } ?> />
              <i>Type 6</i>

              <!-- button #6 -->
              <button class="ff_storyview_button ff_storyview_button_type_6">
                  <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                  echo $default_button_text;
                  ?></span>
              </button>
              <!-- end button #6 -->
            </label>
          </div>

          <div class="ff_storyview_button_types_button_block">
            <label class="ff_storyview_button_type_label">
              <input type="radio" id="ff_storyview_button_type_other" name="ff_storyview_button_type" class="ff_storyview_button_type" value="other" <?php if($default_button_type == "other"){ ?>checked="checked"<?php } ?> />
              <i>Other (own code)</i>
            </label>
          </div>
        </div>
      </div>
    </div>

    <div id="ff_storyview_button_types_other" <?php if($default_button_type == "other"){ ?>style="display: block;"<?php } ?>>
      <label class="ff_storyview_label" for="ff_storyview_button_type_other_code">Custom Button for Story View Button (You can add custom HTML code)</label>
      <input class="components-text-control__input" type="text" id="ff_storyview_button_type_other_code" name="ff_storyview_button_type_other_code" value="<?php echo $default_button_type_other_code; ?>" />
      <br /><small>Don't use "a" or "button" tags in your code. Use the following shortcodes to display the button text, and the button image:
        <pre>{{button_text}} {{button_image}}</pre>
        Eg.: &lt;span class="my_custom_button"&gt;&lt;img src="{{button_image}}" /&gt; {{button_text}}&lt;/span&gt;
      </small>
    </div>
  </div>
  <!-- end Story View button settings -->
</div>