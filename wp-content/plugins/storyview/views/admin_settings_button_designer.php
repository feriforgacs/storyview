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
  <p>Create your own button layouts to embed your stories into your posts.</p>
  <p class="submit"><input type="submit" name="ff_storyview_custom_button_save" id="submit" class="button button-primary" value="Save Button Design"></p>
</form>