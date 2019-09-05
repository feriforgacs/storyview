<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
?>
<div class="ff_storyview_block">
  <h4>Share Story View</h4>
  <p>By turning this on, a share button will be visible at the end of your story.</p>
  <div class="premium-info">
    <p><span role="img" aria-label="Locket icon">🔒</span> This is a premium feature.</p>
    <p><a href="https://storyviewplugin.com/premium-features.html" target="_blank">Click here to learn more</a> about the premium features of the plugin or visit the following URL to purchase the plugin: <a href="https://gum.co/storyview" target="_blank">https://gum.co/storyview</a></p>
  </div>

  <h4>Recommended article</h4>
  <p>By turning this on, a recommended article will be visible at the end of your story.</p>
  <div class="premium-info">
    <p><span role="img" aria-label="Locket icon">🔒</span> This is a premium feature.</p>
    <p><a href="https://storyviewplugin.com/premium-features.html" target="_blank">Click here to learn more</a> about the premium features of the plugin or visit the following URL to purchase the plugin: <a href="https://gum.co/storyview" target="_blank">https://gum.co/storyview</a></p>
  </div>
</div>