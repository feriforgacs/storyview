<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
?>
<p><strong>Add story blocks to your story. You can use Classic Blocks for image and text stories, or you can use Custom Blocks to embed videos, forms, shortcodes or other kind of HTML.</strong></p>
<div id="ff_storyview_blocks_list">
  <?php
  $storyview_blocks_count = 0;
  $storyview_block_id = 0;
  if(isset($storyview_data->story_blocks_data) && count((array)$storyview_data->story_blocks_data) > 0){
    $storyview_blocks_count = count((array)$storyview_data->story_blocks_data);
  }

  $storyview_block_ids = "";

  $i = 0;
  $j = $storyview_blocks_count;
  if($storyview_blocks_count == 1){
    $i = 0;
    $j = 1;
  }

  for($i; $i < $j; $i++){
    $storyview_block_id = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_id) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_id : 0;

    $storyview_block_ids .= $storyview_block_id . ",";

    $storyview_block_image = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_image) ? urldecode($storyview_data->story_blocks_data[$i]->ff_storyview_block_image) : null;

    $storyview_block_item_text = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text : null;

    $storyview_block_item_text_position = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_position) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_position : "ff_storyview_text_block_top";

    $storyview_block_item_text_align = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_align) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_align : "ff_storyview_text_align_left";

    $storyview_block_item_text_font_family = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_family) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_family : "arial";

    $storyview_block_item_text_font_size = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_size) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_size : "f12";

    // set custom background color for classic story block text
    $storyview_block_item_text_background_color = "rgba(0, 0, 0, .8)";
    if(isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color)){
      switch($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color){
        case "ff_storyview_block_background_black":
          $storyview_block_item_text_background_color = "rgba(0, 0, 0, .8)";
          break;

        case "ff_storyview_block_background_gray":
          $storyview_block_item_text_background_color = "rgba(51, 51, 51, .8)";
          break;

        case "ff_storyview_block_background_red":
          $storyview_block_item_text_background_color = "rgba(201, 44, 44, .8)";
          break;

        case "ff_storyview_block_background_white":
          $storyview_block_item_text_background_color = "rgba(255, 255, 255, .8)";
          break;

        case "ff_storyview_block_background_transparent":
          $storyview_block_item_text_background_color = "rgba(255, 255, 255, 0)";
          break;

        default:
          if(strlen($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color) > 1){
            $storyview_block_item_text_background_color = $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color;
          }
          break;
      }
    }

    // set custom font color for classic story block text
    $storyview_block_item_text_font_color = "rgb(255, 255, 255)";
    if(isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color)){
      switch($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color){
        case "ff_storyview_block_color_black":
          $storyview_block_item_text_font_color = "rgb(0, 0, 0)";
          break;

        case "ff_storyview_block_color_gray":
          $storyview_block_item_text_font_color = "rgb(51, 51, 51)";
          break;

        case "ff_storyview_block_color_red":
          $storyview_block_item_text_font_color = "rgb(201, 44, 44)";
          break;

        case "ff_storyview_block_color_white":
          $storyview_block_item_text_font_color = "rgb(255, 255, 255)";
          break;
          
        default:
          if(strlen($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color) > 1){
            $storyview_block_item_text_font_color = $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color;
          }
          break;
      }
    }

    /**
      * Custom story block settings
      */
    $storyview_block_type = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_type) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_type : "";
    
    $storyview_block_content = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_content) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_content : "";

    // set custom background color for custom story block
    $storyview_block_item_block_background_color = "rgba(0, 0, 0, .8)";
    if(isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_block_background_color)){
      switch($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_block_background_color){
        case "ff_storyview_block_background_black":
          $storyview_block_item_block_background_color = "rgba(0, 0, 0, .8)";
          break;

        case "ff_storyview_block_background_gray":
          $storyview_block_item_block_background_color = "rgba(51, 51, 51, .8)";
          break;

        case "ff_storyview_block_background_red":
          $storyview_block_item_block_background_color = "rgba(201, 44, 44, .8)";
          break;

        case "ff_storyview_block_background_white":
          $storyview_block_item_block_background_color = "rgba(255, 255, 255, .8)";
          break;

        default:
          if(strlen($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_block_background_color) > 1){
            $storyview_block_item_block_background_color = $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_block_background_color;
          }
          break;
      }
    }

    switch($storyview_block_type){
      case("code"):
        // display code storyview block editor
        include("story_block_custom_editor.php");
        break;
      default:
        // display classic storyview block editor
        include("story_block_classic_editor.php");
        break;
    }
  }
  ?>

  </div>

  <div class="ff_storyview_add_actions">
    <div class="ff_sotryview_add_actions_button_block">
      <button class="button" id="ff_storyview_add_code_block_button" disabled="disabled"><strong>&plus;</strong> Add Custom Block</button>
      <p class="ff_storyview_info">
        <i>i</i> To <strong>embed forms, videos, custom HTML or shortcodes</strong>, use this block type.
      </p>

      <div class="premium-info">
        <p><span role="img" aria-label="Locket icon">🔒</span> This is a premium feature.</p>
        <p><a href="https://storyviewplugin.com/premium-features.html" target="_blank">Click here to learn more</a> about the premium features of the plugin or visit the following URL to purchase the plugin: <a href="https://gum.co/storyview" target="_blank">https://gum.co/storyview</a></p>
      </div>
    </div>

    <div class="ff_sotryview_add_actions_button_block">
      <button class="button" id="ff_storyview_add_block_button"><strong>&plus;</strong> Add Classic Block</button>
      <p class="ff_storyview_info">
        <i>i</i> To display the <strong>classic image-text story block</strong>, use this block type.
      </p>
    </div>
  </div>