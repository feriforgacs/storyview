<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

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