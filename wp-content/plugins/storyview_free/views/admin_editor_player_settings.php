<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
?>
<p><strong>Enable story controllers (previous, next buttons) or social share functions for your stories.</strong></p>
<!-- Story View controller settings -->
<div class="ff_storyview_col_md_6">
  <div class="ff_storyview_player_settings">
    <div class="ff_storyview_player_settings_section">
      <input type="checkbox" id="ff_storyview_display_controllers" name="ff_storyview_display_controllers" value="1" <?php
      if(isset($storyview_data->display_controllers) && $storyview_data->display_controllers == 1){
        ?>
        checked="checked"
        <?php
      }
      ?> />
      <label for="ff_storyview_display_controllers">Enable Story View Controllers for all story blocks <br /><small>By default, "Previous" and "Next" buttons are only visible for Custom Story Blocks. If you enable this setting, they will be visible for Classic Blocks as well.<br />
      To change the label of the buttons, go to the following page: <a href="/wp-admin/admin.php?page=storyview_settings&tab=general" target="_blank">Story View General Settings</a>
      </small></label>
    </div>
    
    <div class="ff_storyview_player_settings_section">
      <input type="checkbox" disabled="disabled" />
      <label for="ff_storyview_enable_share"><strong>Enable social share for this Story View</strong><br /><small>If you turn this feature on, a small share icon will be visible at the bottom right corner of your stories and your visitors can share the story version of your post.<br />The sharing settings (image, title, description) will be the same as your normal posts, so make sure that those are correct.</small></label>
      <br /><br />
      <div class="premium-info">
        <p><span role="img" aria-label="Locket icon">🔒</span> This is a premium feature.</p>
        <p><a href="https://storyviewplugin.com/premium-features.html" target="_blank">Click here to learn more</a> about the premium features of the plugin or visit the following URL to purchase the plugin: <a href="https://gum.co/storyview" target="_blank">https://gum.co/storyview</a></p>
      </div>
    </div>
  </div>
</div>
<!-- end Story View controller settings -->