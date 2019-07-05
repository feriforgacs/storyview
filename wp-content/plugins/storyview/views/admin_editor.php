<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

?>
<div id="ff_storyview_container">
    <div class="ff_storyview_block">
        <div class="ff_storyview_block_content">
            <br />
            <input id="ff_storyview_activ" name="ff_storyview_activ" class="components-checkbox-control__input" type="checkbox" value="1" <?php
            if(isset($storyview_data->activ) && $storyview_data->activ == 1){
                $storyview_activ = true;
                ?>checked="checked"<?php
            }
            ?> />
            <label for="ff_storyview_activ">Enable Story View for this post</label>
        </div>

        <div class="ff_storyview_block_content" id="ff_storyview_basic_settings" <?php if($storyview_activ){ ?> style="display: block;" <?php } ?>>
            <div class="ff_storyview_button_settings">
                <h4>Shortcode</h4>
                <p>Insert the following shortcode to your post to the place where you want to display the Story View button:</p>
                <input type="text" class="components-text-control__input" value="[<?php echo FF_STORYVIEW_SHORTCODE; ?>]" onfocus="this.select();" />
                <hr />
                <h4>Story View Button</h4>

                <label class="ff_storyview_label" for="ff_storyview_button_text">Button Text</label>
                <input class="components-text-control__input" type="text" id="ff_storyview_button_text" name="ff_storyview_button_text" value="<?php
                if(isset($storyview_data->button_text)){
                    echo esc_html($storyview_data->button_text);
                }
                ?>" />

                <div id="ff_storyview_button_types">
                    <label class="ff_storyview_label">Button Type</label>
                    <small>The image of the button will be generated from the image of the first (classic) story block</small>
                    <div id="ff_storyview_button_types_content">
                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1" <?php if((isset($storyview_data->button_type) && $storyview_data->button_type == 1) || !isset($storyview_data->button_type)){ ?>checked="checked"<?php } ?> />
                                <i>Type 1</i>

                                <!-- button #1 -->
                                <button class="ff_storyview_button ff_storyview_button_type_1">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #1 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1_i" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "1_i"){ ?>checked="checked"<?php } ?> />
                                <i>Type 1 Inverse</i>

                                <!-- button #1_i -->
                                <button class="ff_storyview_button ff_storyview_button_type_1_i">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #1_i -->
                            </label>
                        </div>

                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == 2){ ?>checked="checked"<?php } ?> />
                                <i>Type 2</i>

                                <!-- button #2 -->
                                <button class="ff_storyview_button ff_storyview_button_type_2">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #2 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2_i" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "2_i"){ ?>checked="checked"<?php } ?> />
                                <i>Type 2 Inverse</i>

                                <!-- button #2_i -->
                                <button class="ff_storyview_button ff_storyview_button_type_2_i">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #2_i -->
                            </label>
                        </div>

                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == 3){ ?>checked="checked"<?php } ?> />
                                <i>Type 3</i>

                                <!-- button #3 -->
                                <button class="ff_storyview_button ff_storyview_button_type_3">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #3 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3_i" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "3_i"){ ?>checked="checked"<?php } ?> />
                                <i>Type 3 Inverse</i>

                                <!-- button #3_i -->
                                <button class="ff_storyview_button ff_storyview_button_type_3_i">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #3_i -->
                            </label>
                        </div>

                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == 4){ ?>checked="checked"<?php } ?> />
                                <i>Type 4</i>

                                <!-- button #4 -->
                                <button class="ff_storyview_button ff_storyview_button_type_4">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #4 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4_i" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "4_i"){ ?>checked="checked"<?php } ?> />
                                <i>Type 4 Inverse</i>

                                <!-- button #4_i -->
                                <button class="ff_storyview_button ff_storyview_button_type_4_i">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #4_i -->
                            </label>
                        </div>

                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == 5){ ?>checked="checked"<?php } ?> />
                                <i>Type 5</i>

                                <!-- button #5 -->
                                <button class="ff_storyview_button ff_storyview_button_type_5">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #5 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5_i" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "5_i"){ ?>checked="checked"<?php } ?> />
                                <i>Type 5 Inverse</i>

                                <!-- button #5_i -->
                                <button class="ff_storyview_button ff_storyview_button_type_5_i">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                        if(isset($storyview_data->button_text)){
                                            echo $storyview_data->button_text;
                                        }
                                        ?></span>
                                </button>
                                <!-- end button #5_i -->
                            </label>
                        </div>

                        <div class="ff_storyview_button_types_button_block">
                            <label class="ff_storyview_button_type_label">
                                <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="6" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == 6){ ?>checked="checked"<?php } ?> />
                                <i>Type 6</i>

                                <!-- button #6 -->
                                <button class="ff_storyview_button ff_storyview_button_type_6">
                                    <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text">TL⚡DR</span>
                                </button>
                                <!-- end button #6 -->
                            </label>

                            <label class="ff_storyview_button_type_label">
                                <input type="radio" id="ff_storyview_button_type_other" name="ff_storyview_button_type" class="ff_storyview_button_type" value="other" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "other"){ ?>checked="checked"<?php } ?> />
                                <i>Other (own code)</i>
                            </label>
                        </div>
                    </div>
                </div>

                <div id="ff_storyview_button_types_other" <?php if(isset($storyview_data->button_type) && $storyview_data->button_type == "other"){ ?>style="display: block;"<?php } ?>>
                    <label class="ff_storyview_label" for="ff_storyview_button_type_other_code">Custom Button for Story View Button (You can add custom HTML code)</label>
                    <input class="components-text-control__input" type="text" id="ff_storyview_button_type_other_code" name="ff_storyview_button_type_other_code" value="<?php if(isset($storyview_data->button_other_code)){
                        echo esc_html($storyview_data->button_other_code);
                    } ?>" />
                    <br /><small>Don't use "a" or "button" tags in your code. Use the following shortcodes to display the button text, and the button image:
                        <pre>{{button_text}} {{button_image}}</pre>
                        Eg.: &lt;span class="my_custom_button"&gt;&lt;img src="{{button_image}}" /&gt; {{button_text}}&lt;/span&gt;
                    </small>
                </div>
            </div>
        </div>
    </div>

    <?php
    // amp settings block
    include_once("admin_editor_amp_settings.php");
    ?>

    <div id="ff_storyview_blocks" <?php if($storyview_activ){ ?> style="display: block;" <?php } ?>>
        <h3 class="ff_storyview_block_header">Story View Blocks</h3>

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
    </div>
    <div class="ff_storyview_add_actions" <?php if($storyview_activ){ ?> style="display: flex;" <?php } ?>>
        <div class="ff_sotryview_add_actions_button_block">
            <button class="button" id="ff_storyview_add_code_block_button"><strong>&plus;</strong> Add Custom Block</button>
            <p class="ff_storyview_info">
                <i>i</i> To <strong>embed forms, videos, custom HTML or shortcodes</strong>, use this block type.
            </p>
        </div>

        <div class="ff_sotryview_add_actions_button_block">
            <button class="button" id="ff_storyview_add_block_button"><strong>&plus;</strong> Add Classic Block</button>
            <p class="ff_storyview_info">
                <i>i</i> To display the <strong>classic image-text story block</strong>, use this block type.
            </p>
        </div>
    </div>
</div><!-- end #ff_storyview_container -->

<?php
// classic story block template
include_once("story_block_classic_template.php");
include_once("story_block_custom_template.php");
?>

<input type="hidden" name="story_block_ids" id="story_block_ids" value="<?php echo $storyview_block_ids; ?>" />