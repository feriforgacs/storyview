<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

$end_screen_recommended_article_enabled = 0;
$end_screen_recommended_section_title = "";
$end_screen_recommended_article_title = "";
$end_screen_recommended_article_url = "";

$end_screen_share_enabled = 0;
$end_screen_share_button_text = "";

if(isset($storyview_data->end_screen_settings)){
  /**
   * Recommended article settings
   */
  $end_screen_recommended_article_enabled = $storyview_data->end_screen_settings->recommended_article_enabled;
  $end_screen_recommended_section_title = $storyview_data->end_screen_settings->recommended_section_title;
  $end_screen_recommended_article_title = $storyview_data->end_screen_settings->recommended_article_title;
  $end_screen_recommended_article_url = $storyview_data->end_screen_settings->recommended_article_url;

  /**
   * End screen share settings
   */
  $end_screen_share_enabled = $storyview_data->end_screen_settings->share_enabled;
  $end_screen_share_button_text = $storyview_data->end_screen_settings->share_button_text;
}
?>
<div class="ff_storyview_block">
  <h4>Share Story View</h4>
  
  <p class="tutorial-info"><span role="img" aria-label="Pointing finger">👉</span> <a href="https://storyviewplugin.com/enable-social-share-functions-and-recommended-article-on-the-end-screen-of-your-story.html" target="_blank">Learn more about these features</a></p>

  <p>By turning this on, a share button will be visible at the end of your story.</p>

  <div class="ff_storyview_block_content">
    <input type="checkbox" name="ff_storyview_end_screen_share_enabled" id="ff_storyview_end_screen_share_enabled" value="1" <?php if($end_screen_share_enabled == 1){ ?> checked="checked" <?php } ?> />
    <label for="ff_storyview_end_screen_share_enabled">Enable share button on the end screen</label>
    <p></p>
    <label class="ff_storyview_label" for="ff_storyview_end_screen_share_button_text">Share button text</label>
    <input type="text" name="ff_storyview_end_screen_share_button_text" id="ff_storyview_end_screen_share_button_text" class="components-textarea-control__input" value="<?php echo $end_screen_share_button_text; ?>" />

    <p class="ff_storyview_info">
        <i>i</i> The share settings will be the same as of your post so make sure those are ok. (<a href="https://developers.facebook.com/tools/debug/sharing/?q=<?php echo urlencode(get_permalink()); ?>" target="_blank">Click here to test with the Facebook debugger tool.</a>)
    </p>
  </div>

  <h4>Recommended article</h4>
  <p>By turning this on, a recommended article will be visible at the end of your story.</p>
  <div class="ff_storyview_block_content">
    <input type="checkbox" name="ff_storyview_end_screen_recommended_article_enabled" id="ff_storyview_end_screen_recommended_article_enabled" value="1" <?php if($end_screen_recommended_article_enabled == 1){ ?> checked="checked" <?php } ?> />
    <label for="ff_storyview_end_screen_recommended_article_enabled">Enable recommended article on the end screen</label>

    <p></p>
    <label class="ff_storyview_label" for="ff_storyview_recommended_section_title">Recommended section title (eg. Recommended for you)</label>
    <input type="text" name="ff_storyview_recommended_section_title" id="ff_storyview_recommended_section_title" class="components-textarea-control__input" value="<?php echo $end_screen_recommended_section_title; ?>" />

    <label class="ff_storyview_label" for="ff_storyview_recommended_article_title">Recommended article title</label>
    <input type="text" name="ff_storyview_recommended_article_title" id="ff_storyview_recommended_article_title" class="components-textarea-control__input" value="<?php echo $end_screen_recommended_article_title; ?>" />

    <label class="ff_storyview_label" for="ff_storyview_recommended_article_url">Recommended article URL</label>
    <input type="text" name="ff_storyview_recommended_article_url" id="ff_storyview_recommended_article_url" class="components-textarea-control__input" value="<?php echo $end_screen_recommended_article_url; ?>" />
  </div>
</div>