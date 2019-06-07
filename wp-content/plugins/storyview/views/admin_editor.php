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
            <h4>Shortcode</h4>
            <p>Insert the following shortcode to your post to the place where you want to display the Story View button:</p>
            <input type="text" class="components-text-control__input" value="[<?php echo FF_STORYVIEW_SHORTCODE; ?>]" onfocus="this.select();" />
            <hr />
            <h4>Story View Button</h4>

            <label class="ff_storyview_label" for="ff_storyview_button_text">Button Text</label>
            <input class="components-text-control__input" type="text" id="ff_storyview_button_text" name="ff_storyview_button_text" value="<?php
            if(isset($storyview_data->button_text)){
                echo $storyview_data->button_text;
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

                $storyview_block_item_text_background_color = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_background_color : "ff_storyview_block_background_black";

                $storyview_block_item_text_font_color = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_item_text_font_color : "ff_storyview_block_color_white";

                $storyview_block_type = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_type) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_type : "";
                $storyview_block_content = isset($storyview_data->story_blocks_data[$i]->ff_storyview_block_content) ? $storyview_data->story_blocks_data[$i]->ff_storyview_block_content : "";

                switch($storyview_block_type){
                    case("code"):
                        // display code storyview block editor
                        ?>
                        <div class="ff_storyview_block_item ff_storyview_block_item_code" id="ff_storyview_block_item_<?php echo $storyview_block_id; ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                            <div class="ff_storyview_block_item_move">
                                <i>
                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
                                </i>
                            </div>

                            <div class="ff_storyview_block_item_preview ff_storyview_block_item_preview_code">
                                <p class="preview_text" <?php if($storyview_block_content){ ?>style="display: none;" <?php } ?>>preview</p>
                                <div class="ff_storyview_block_item_content" <?php if($storyview_block_content){ ?>style="display: flex;" <?php } ?>>
                                    <?php
                                    if($storyview_block_content){
                                        echo $storyview_block_content;
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="ff_storyview_block_item_settings">
                                <p class="block_type_label custom">Custom Block</p>
                                <div class="ff_storyview_block_item_settings_block">
                                    <h3>Custom Block Content</h3>
                                    <label class="ff_storyview_label" for="ff_storyview_block_content_<?php echo $i; ?>">Add your shortcode, or custom HTML code to the field below</label>
                                    <textarea class="ff_storyview_block_content_editor" id="ff_storyview_block_content_<?php echo $i; ?>" name="ff_storyview_block_content_<?php echo $i; ?>"><?php echo $storyview_block_content; ?></textarea>
                                    <p class="ff_storyview_info">
                                        <i>i</i> The preview of shortcodes will be visible on the frontend.
                                    </p>
                                </div>

                                <div class="ff_storyview_block_item_settings_block delete_block">
                                    <button class="ff_storyview_block_delete_button" data-blockid="<?php echo $storyview_block_id; ?>">
                                        <i><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></i>
                                        <span>Remove Block</span>
                                    </button>
                                </div>

                            </div>
                        </div><!-- end .ff_storyview_block_item -->
                        <?php
                        break;
                    default:
                        // display classic storyview block editor
                        ?>
                        <div class="ff_storyview_block_item ff_storyview_block_item_classic" id="ff_storyview_block_item_<?php echo $storyview_block_id; ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                            <div class="ff_storyview_block_item_move">
                                <i>
                                    <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
                                </i>
                            </div>

                            <div class="ff_storyview_block_item_preview">
                                <p class="preview_text" <?php if($storyview_block_image || $storyview_block_item_text){ ?>style="display: none;" <?php } ?>>preview</p>
                                <div class="ff_storyview_block_item_content <?php echo $storyview_block_item_text_position . ' ' . $storyview_block_item_text_align; ?>" <?php
                                    if($storyview_block_image || $storyview_block_item_text){
                                        echo 'style="display: flex;';
                                        if($storyview_block_image){
                                            echo "background-image: url('" . $storyview_block_image . "');";
                                        }
                                        echo '"';
                                    } ?>>
                                    <p class="block_item_text <?php echo $storyview_block_item_text_background_color . ' ' . $storyview_block_item_text_font_color . ' ' . $storyview_block_item_text_font_family . ' ' . $storyview_block_item_text_font_size; ?>"><?php echo $storyview_block_item_text; ?></p>
                                </div>
                            </div>

                            <div class="ff_storyview_block_item_settings">
                            <p class="block_type_label classic">Classic Block</p>
                                <div class="ff_storyview_block_item_settings_block">
                                    <div class="ff_storyview_block_item_image_upload">
                                        <input type="button" class="ff_storyview_image_upload button" data-blockid="<?php echo $storyview_block_id; ?>" value="Select Story Block Image" />
                                        <input type="hidden" name="ff_storyview_block_image_<?php echo $storyview_block_id; ?>" id="ff_storyview_block_image_<?php echo $storyview_block_id; ?>" value="<?php echo $storyview_block_image; ?>" />
                                        <br /><small>Ideal size 1080x1920px. For better performance, try to optimize the size of the image.</small>
                                    </div>
                                </div>

                                <div class="ff_storyview_block_item_settings_block">
                                    <h3>Text Settings</h3>

                                    <label class="ff_storyview_label" for="ff_storyview_block_item_text_<?php echo $storyview_block_id; ?>">Story Block Text</label>
                                    <textarea name="ff_storyview_block_item_text_<?php echo $storyview_block_id; ?>" id="ff_storyview_block_item_text_<?php echo $storyview_block_id; ?>" class="components-textarea-control__input ff_storyview_block_item_text_textarea" data-blockid="<?php echo $storyview_block_id; ?>" cols="30" rows="3"><?php echo $storyview_block_item_text; ?></textarea><br />
                                    <small>Try to keep it under 160 characters</small>

                                    <div class="ff_storyview_row">
                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label">Text Block Position</label>
                                            <div class="ff_storyview_button_group">
                                                <label class="ff_storyview_block_item_text_position_label <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_top'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_position_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_block_top" <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_top'){ echo "checked='checked'"; } ?> />
                                                    <span>Top</span>
                                                    <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                                    <rect x="7" y="4" width="6" height="3" fill="#444B54"/>
                                                    </svg>
                                                    </i>
                                                </label>

                                                <label class="ff_storyview_block_item_text_position_label <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_middle'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_position_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_block_middle" <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_middle'){ echo "checked='checked'"; } ?> />
                                                    <span>Middle</span>
                                                    <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                                    <rect x="7" y="9" width="6" height="3" fill="#444B54"/>
                                                    </svg>
                                                    </i>
                                                </label>

                                                <label class="ff_storyview_block_item_text_position_label <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_bottom'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_position_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_block_bottom" <?php if($storyview_block_item_text_position == 'ff_storyview_text_block_bottom'){ echo "checked='checked'"; } ?> />
                                                    <span>Bottom</span>
                                                    <i title="bottom"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                                    <rect x="7" y="13" width="6" height="3" fill="#444B54"/>
                                                    </svg>
                                                    </i>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label">Text Alignment</label>
                                            <div class="ff_storyview_button_group">
                                                <label class="ff_storyview_block_item_text_align_label <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_left'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_align_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_align_left" <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_left'){ echo "checked='checked'"; } ?> />
                                                    <span>Left</span>
                                                    <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                                                </label>

                                                <label class="ff_storyview_block_item_text_align_label <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_center'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_align_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_align_center" <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_center'){ echo "checked='checked'"; } ?> />
                                                    <span>Center</span>
                                                    <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                                                </label>

                                                <label class="ff_storyview_block_item_text_align_label <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_right'){ echo 'activ'; } ?>" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_align_<?php echo $storyview_block_id; ?>" value="ff_storyview_text_align_right" <?php if($storyview_block_item_text_align == 'ff_storyview_text_align_right'){ echo "checked='checked'"; } ?> />
                                                    <span>Right</span>
                                                    <i title="right"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ff_storyview_row">
                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label" for="ff_storyview_block_item_text_font_family_<?php echo $storyview_block_id; ?>">Font Family</label>
                                            <select name="ff_storyview_block_item_text_font_family_<?php echo $storyview_block_id; ?>" class="custom-select font-family-select" data-blockid="<?php echo $storyview_block_id; ?>" id="ff_storyview_block_item_text_font_family_<?php echo $storyview_block_id; ?>">
                                                <option value="arial" <?php if($storyview_block_item_text_font_family == "arial"){ echo 'selected="selected"'; } ?>>Arial</option>    
                                                <option value="courier" <?php if($storyview_block_item_text_font_family == "courier"){ echo 'selected="selected"'; } ?>>Courier</option>
                                                <option value="roboto" <?php if($storyview_block_item_text_font_family == "robot"){ echo 'selected="selected"'; } ?>>Roboto</option>
                                                <option value="rounded" <?php if($storyview_block_item_text_font_family == "rounded"){ echo 'selected="selected"'; } ?>>Rounded</option>
                                                <option value="lily" <?php if($storyview_block_item_text_font_family == "lily"){ echo 'selected="selected"'; } ?>>Lily</option>
                                                <option value="montserrat" <?php if($storyview_block_item_text_font_family == "montserrat"){ echo 'selected="selected"'; } ?>>Montserrat</option>
                                            </select>
                                        </div>

                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label" for="ff_storyview_block_item_text_font_size_<?php echo $storyview_block_id; ?>">Font Size</label>
                                            <select name="ff_storyview_block_item_text_font_size_<?php echo $storyview_block_id; ?>" class="custom-select font-size-select" data-blockid="<?php echo $storyview_block_id; ?>" id="ff_storyview_block_item_text_font_size_<?php echo $storyview_block_id; ?>">
                                                <option value="f12" <?php if($storyview_block_item_text_font_size == "f12"){ echo 'selected="selected"'; } ?>>12px</option>
                                                <option value="f14" <?php if($storyview_block_item_text_font_size == "f14"){ echo 'selected="selected"'; } ?>>14px</option>
                                                <option value="f18" <?php if($storyview_block_item_text_font_size == "f18"){ echo 'selected="selected"'; } ?>>18px</option>
                                                <option value="f24" <?php if($storyview_block_item_text_font_size == "f24"){ echo 'selected="selected"'; } ?>>24px</option>
                                                <option value="f36" <?php if($storyview_block_item_text_font_size == "f36"){ echo 'selected="selected"'; } ?>>36px</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="ff_storyview_row">
                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label">Text Block Background</label>
                                            <div class="ff_storyview_color_group">
                                                <label class="ff_storyview_block_item_text_background_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_background_black" <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_black"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview black <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_black"){ echo 'activ';} ?>" title="black">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_background_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_background_gray" <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_gray"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview dark-gray <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_gray"){ echo 'activ';} ?>" title="dark gray">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_background_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_background_red" <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_red"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview red <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_red"){ echo 'activ';} ?>" title="red">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_background_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_background_white" <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_white"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview white <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_white"){ echo 'activ';} ?>" title="white">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_background_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_background_transparent" <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_transparent"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview transparent <?php if($storyview_block_item_text_background_color == "ff_storyview_block_background_transparent"){ echo 'activ';} ?>" title="transparent, no background">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="ff_storyview_col_md_6">
                                            <label class="ff_storyview_label">Font Color</label>
                                            <div class="ff_storyview_color_group">
                                                <label class="ff_storyview_block_item_text_font_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_color_black" <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_black"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview black <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_black"){ echo 'activ';} ?>">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_font_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_color_gray" <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_gray"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview dark-gray <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_black"){ echo 'activ';} ?>">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_font_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_color_red" <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_red"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview red <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_red"){ echo 'activ';} ?>">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>

                                                <label class="ff_storyview_block_item_text_font_color_label" data-blockid="<?php echo $storyview_block_id; ?>">
                                                    <input type="radio" name="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" value="ff_storyview_block_color_white" <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_white"){ echo 'checked="checked"';} ?> />
                                                    <span class="color-preview white <?php if($storyview_block_item_text_font_color == "ff_storyview_block_color_white"){ echo 'activ';} ?>">
                                                        <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="ff_storyview_block_item_settings_block delete_block">
                                    <button class="ff_storyview_block_delete_button" data-blockid="<?php echo $storyview_block_id; ?>">
                                        <i><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></i>
                                        <span>Remove Block</span>
                                    </button>
                                </div>

                            </div>

                        </div><!-- end .ff_storyview_block_item -->
                        <?php
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

<script type="text/template" id="storyview_block_template">
    <div class="ff_storyview_block_item ff_storyview_block_item_classic" id="ff_storyview_block_item_%BLOCKID%" data-blockid="%BLOCKID%">
        <div class="ff_storyview_block_item_move">
            <i>
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
            </i>
        </div>

        <div class="ff_storyview_block_item_preview">
            <p class="preview_text">preview</p>
            <div class="ff_storyview_block_item_content ff_storyview_text_block_top ff_storyview_text_align_left">
                <p class="block_item_text ff_storyview_block_background_black ff_storyview_block_color_white arial f12"></p>
            </div>
        </div>

        <div class="ff_storyview_block_item_settings">
            <p class="block_type_label classic">Classic Block</p>
            <div class="ff_storyview_block_item_settings_block">
                <div class="ff_storyview_block_item_image_upload">
                    <input type="button" class="ff_storyview_image_upload button" data-blockid="%BLOCKID%" value="Select Story Block Image" />
                    <input type="hidden" name="ff_storyview_block_image_%BLOCKID%" id="ff_storyview_block_image_%BLOCKID%" value="" />
                    <br /><small>Ideal size 1080x1920px. For better performance, try to optimize the size of the image.</small>
                </div>
            </div>

            <div class="ff_storyview_block_item_settings_block">
                <h3>Text Settings</h3>

                <label class="ff_storyview_label" for="ff_storyview_block_item_text_%BLOCKID%">Story Block Text</label>
                <textarea name="ff_storyview_block_item_text_%BLOCKID%" id="ff_storyview_block_item_text_%BLOCKID%" class="components-textarea-control__input ff_storyview_block_item_text_textarea" data-blockid="%BLOCKID%" cols="30" rows="3"></textarea><br />
                <small>Try to keep it under 160 characters</small>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Position</label>
                        <div class="ff_storyview_button_group">
                            <label class="ff_storyview_block_item_text_position_label activ" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_top" checked="checked" />
                                <span>Top</span>
                                <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="4" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_block_item_text_position_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_middle" />
                                <span>Middle</span>
                                <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="9" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_block_item_text_position_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_bottom" />
                                <span>Bottom</span>
                                <i title="bottom"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="13" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Alignment</label>
                        <div class="ff_storyview_button_group">
                            <label class="ff_storyview_block_item_text_align_label activ" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_left" checked="checked" />
                                <span>Left</span>
                                <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_block_item_text_align_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_center" />
                                <span>Center</span>
                                <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_block_item_text_align_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_right" />
                                <span>Right</span>
                                <i title="right"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_block_item_text_font_family_%BLOCKID%">Font Family</label>
                        <select name="ff_storyview_block_item_text_font_family_%BLOCKID%" class="custom-select font-family-select" data-blockid="%BLOCKID%" id="ff_storyview_block_item_text_font_family_%BLOCKID%">
                            <option value="arial" selected="selected">Arial</option>    
                            <option value="courier">Courier</option>
                            <option value="roboto">Roboto</option>
                            <option value="rounded">Rounded</option>
                            <option value="lily">Lily</option>
                            <option value="montserrat">Montserrat</option>
                        </select>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_block_item_text_font_size_%BLOCKID%">Font Size</label>
                        <select name="ff_storyview_block_item_text_font_size_%BLOCKID%" class="custom-select font-size-select" data-blockid="%BLOCKID%" id="ff_storyview_block_item_text_font_size_%BLOCKID%">
                            <option value="f12" selected="selected">12px</option>
                            <option value="f14">14px</option>
                            <option value="f18">18px</option>
                            <option value="f24">24px</option>
                            <option value="f36">36px</option>
                        </select>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Background</label>
                        <div class="ff_storyview_color_group">
                            <label class="ff_storyview_block_item_text_background_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_background_color_%BLOCKID%" value="ff_storyview_block_background_black" checked="checked" />
                                <span class="color-preview black activ" title="black">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_background_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_background_color_%BLOCKID%" value="ff_storyview_block_background_gray" />
                                <span class="color-preview dark-gray" title="dark gray">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_background_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_background_color_%BLOCKID%" value="ff_storyview_block_background_red" />
                                <span class="color-preview red" title="red">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_background_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_background_color_%BLOCKID%" value="ff_storyview_block_background_white" />
                                <span class="color-preview white" title="white">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_background_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_background_color_%BLOCKID%" value="ff_storyview_block_background_transparent" />
                                <span class="color-preview transparent" title="transparent, no background">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Font Color</label>
                        <div class="ff_storyview_color_group">
                            <label class="ff_storyview_block_item_text_font_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_font_color_%BLOCKID%" value="ff_storyview_block_color_black" />
                                <span class="color-preview black">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_font_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_font_color_%BLOCKID%" value="ff_storyview_block_color_gray" />
                                <span class="color-preview dark-gray">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_font_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_font_color_%BLOCKID%" value="ff_storyview_block_color_red" />
                                <span class="color-preview red">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_block_item_text_font_color_label" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_font_color_%BLOCKID%" value="ff_storyview_block_color_white" checked="checked" />
                                <span class="color-preview white activ">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <div class="ff_storyview_block_item_settings_block delete_block">
                <button class="ff_storyview_block_delete_button" data-blockid="%BLOCKID%">
                    <i><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></i>
                    <span>Remove Block</span>
                </button>
            </div>

        </div>
    </div><!-- end .ff_storyview_block_item -->
</script><!-- end #storyview_block_template -->

<script type="text/template" id="storyview_block_code_template">
    <div class="ff_storyview_block_item ff_storyview_block_item_code" id="ff_storyview_block_item_%BLOCKID%" data-blockid="%BLOCKID%">
        <div class="ff_storyview_block_item_move">
            <i>
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
            </i>
        </div>

        <div class="ff_storyview_block_item_preview">
            <p class="preview_text">preview</p>
            <div class="ff_storyview_block_item_content ff_storyview_text_block_top ff_storyview_text_align_left">
                <p class="block_item_text ff_storyview_block_background_black ff_storyview_block_color_white arial f12"></p>
            </div>
        </div>

        <div class="ff_storyview_block_item_settings">

            <div class="ff_storyview_block_item_settings_block">
                CODE EDITOR
            </div>

            <div class="ff_storyview_block_item_settings_block delete_block">
                <button class="ff_storyview_block_delete_button" data-blockid="%BLOCKID%">
                    <i><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-trash" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 4h3c.6 0 1 .4 1 1v1H3V5c0-.6.5-1 1-1h3c.2-1.1 1.3-2 2.5-2s2.3.9 2.5 2zM8 4h3c-.2-.6-.9-1-1.5-1S8.2 3.4 8 4zM4 7h11l-.9 10.1c0 .5-.5.9-1 .9H5.9c-.5 0-.9-.4-1-.9L4 7z"></path></svg></i>
                    <span>Remove Block</span>
                </button>
            </div>

        </div>
    </div><!-- end .ff_storyview_block_item -->
</script><!-- end #storyview_block_code_template -->

<input type="hidden" name="story_block_ids" id="story_block_ids" value="<?php echo $storyview_block_ids; ?>" />