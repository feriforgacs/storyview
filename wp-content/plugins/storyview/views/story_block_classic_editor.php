<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
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
            <p class="block_item_text <?php echo $storyview_block_item_text_font_family . ' ' . $storyview_block_item_text_font_size; ?>" style="<?php 
            // display text background color
            echo "background-color: " . $storyview_block_item_text_background_color . ";";

            // display text font color
            echo "color: " . $storyview_block_item_text_font_color . ";";
            ?>"><?php echo $storyview_block_item_text; ?></p>
        </div>
    </div>

    <div class="ff_storyview_block_item_settings">
    <p class="block_type_label classic">Classic Block</p>
        <div class="ff_storyview_block_item_settings_block">
            <div class="ff_storyview_block_item_image_upload">
                <input type="button" class="ff_storyview_image_upload button" data-blockid="<?php echo $storyview_block_id; ?>" value="Select Story Block Image" />
                <input type="hidden" name="ff_storyview_block_image_<?php echo $storyview_block_id; ?>" id="ff_storyview_block_image_<?php echo $storyview_block_id; ?>" value="<?php echo $storyview_block_image; ?>" />
                <br /><small>Ideal size 1080x1920px. For better performance, try to <a href="https://tinypng.com/" target="_blank">optimize</a> the size of the image.</small>
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
                    <div class="ff_storyview_background_color_colorpicker">
                        <input data-blockid="<?php echo $storyview_block_id; ?>" type="text" name="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" id="ff_storyview_block_item_text_background_color_<?php echo $storyview_block_id; ?>" class="ff_storyview_background_color_colorpicker_input" value="<?php echo $storyview_block_item_text_background_color; ?>" />
                    </div>
                </div>

                <div class="ff_storyview_col_md_6">
                    <label class="ff_storyview_label">Font Color</label>
                    <div class="ff_storyview_font_color_colorpicker">
                        <input data-blockid="<?php echo $storyview_block_id; ?>" type="text" name="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" id="ff_storyview_block_item_text_font_color_<?php echo $storyview_block_id; ?>" class="ff_storyview_font_color_colorpicker_input" value="<?php echo $storyview_block_item_text_font_color; ?>" />
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