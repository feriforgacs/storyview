<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

/**
 * Get default values
 */

$default_text_block_position = "ff_storyview_text_block_top";
$default_text_alignment = "ff_storyview_text_align_left";
$default_font_family = "arial";
$default_font_size = "f12";
$default_text_block_background_color = "rgba(0, 0, 0, .8)";
$default_text_font_color = "rgb(255, 255, 255)";

if(strlen(esc_attr(get_option('ff_storyview_default_text_position'))) > 1) {
    $default_text_block_position = esc_attr(get_option('ff_storyview_default_text_position'));
}

if(strlen(esc_attr(get_option('ff_storyview_default_text_alignment'))) > 1) {
    $default_text_alignment = esc_attr(get_option('ff_storyview_default_text_alignment'));
}

if(strlen(esc_attr(get_option('ff_storyview_default_font_family'))) > 1) {
    $default_font_family = esc_attr(get_option('ff_storyview_default_font_family'));
}

if(strlen(esc_attr(get_option('ff_storyview_default_font_size'))) > 1) {
    $default_font_size = esc_attr(get_option('ff_storyview_default_font_size'));
}

if(strlen(esc_attr(get_option('ff_storyview_default_text_background_color'))) > 1) {
    $default_text_block_background_color = esc_attr(get_option('ff_storyview_default_text_background_color'));
}

if(strlen(esc_attr(get_option('ff_storyview_default_text_font_color'))) > 1) {
    $default_text_font_color = esc_attr(get_option('ff_storyview_default_text_font_color'));
}

?>
<script type="text/template" id="storyview_block_template">
    <div class="ff_storyview_block_item ff_storyview_block_item_classic" id="ff_storyview_block_item_%BLOCKID%" data-blockid="%BLOCKID%">
        <div class="ff_storyview_block_item_move">
            <i>
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
            </i>
        </div>

        <div class="ff_storyview_block_item_preview">
            <p class="preview_text">preview</p>
            <div class="ff_storyview_block_item_content <?php echo $default_text_block_position . ' ' . $default_text_alignment; ?>">
                <p class="block_item_text <?php echo $default_font_family . ' ' . $default_font_size; ?>" style="background-color: <?php echo $default_text_block_background_color; ?>; color: <?php echo $default_text_font_color; ?>;"></p>
            </div>
        </div>

        <div class="ff_storyview_block_item_settings">
            <p class="block_type_label classic">Classic Block</p>
            <div class="ff_storyview_block_item_settings_block">
                <div class="ff_storyview_block_item_image_upload">
                    <input type="button" class="ff_storyview_image_upload button" data-blockid="%BLOCKID%" value="Select Story Block Image" />
                    <input type="hidden" name="ff_storyview_block_image_%BLOCKID%" id="ff_storyview_block_image_%BLOCKID%" value="" />
                    <br /><small>Ideal size 1080x1920px. For better performance, try to <a href="https://tinypng.com/" target="_blank">optimize</a> the size of the image.</small>
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
                            <label class="ff_storyview_block_item_text_position_label <?php echo ($default_text_block_position == "ff_storyview_text_block_top") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_top" <?php echo ($default_text_block_position == "ff_storyview_text_block_top") ? 'checked="checked"' : ''; ?> />
                                <span>Top</span>
                                <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="4" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_block_item_text_position_label <?php echo ($default_text_block_position == "ff_storyview_text_block_middle") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_middle" <?php echo ($default_text_block_position == "ff_storyview_text_block_middle") ? 'checked="checked"' : ''; ?> />
                                <span>Middle</span>
                                <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="9" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_block_item_text_position_label <?php echo ($default_text_block_position == "ff_storyview_text_block_bottom") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_position_%BLOCKID%" value="ff_storyview_text_block_bottom" <?php echo ($default_text_block_position == "ff_storyview_text_block_bottom") ? 'checked="checked"' : ''; ?> />
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
                            <label class="ff_storyview_block_item_text_align_label <?php echo ($default_text_alignment == "ff_storyview_text_align_left") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_left" <?php echo ($default_text_alignment == "ff_storyview_text_align_left") ? 'checked="checked"' : ''; ?> />
                                <span>Left</span>
                                <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_block_item_text_align_label <?php echo ($default_text_alignment == "ff_storyview_text_align_center") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_center" <?php echo ($default_text_alignment == "ff_storyview_text_align_center") ? 'checked="checked"' : ''; ?> />
                                <span>Center</span>
                                <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_block_item_text_align_label <?php echo ($default_text_alignment == "ff_storyview_text_align_right") ? 'activ' : ''; ?>" data-blockid="%BLOCKID%">
                                <input type="radio" name="ff_storyview_block_item_text_align_%BLOCKID%" value="ff_storyview_text_align_right" <?php echo ($default_text_alignment == "ff_storyview_text_align_right") ? 'checked="checked"' : ''; ?> />
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
                            <option value="arial" <?php echo ($default_font_family == "arial") ? 'selected="selected"' : ''; ?>>Arial</option>    
                            <option value="courier" <?php echo ($default_font_family == "courier") ? 'selected="selected"' : ''; ?>>Courier</option>
                            <option value="roboto" <?php echo ($default_font_family == "roboto") ? 'selected="selected"' : ''; ?>>Roboto</option>
                            <option value="rounded" <?php echo ($default_font_family == "rounded") ? 'selected="selected"' : ''; ?>>Rounded</option>
                            <option value="lily" <?php echo ($default_font_family == "lily") ? 'selected="selected"' : ''; ?>>Lily</option>
                            <option value="montserrat" <?php echo ($default_font_family == "montserrat") ? 'selected="selected"' : ''; ?>>Montserrat</option>
                        </select>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_block_item_text_font_size_%BLOCKID%">Font Size</label>
                        <select name="ff_storyview_block_item_text_font_size_%BLOCKID%" class="custom-select font-size-select" data-blockid="%BLOCKID%" id="ff_storyview_block_item_text_font_size_%BLOCKID%">
                            <option value="f12" <?php echo ($default_font_size == "f12") ? 'selected="selected"' : ''; ?>>12px</option>
                            <option value="f14" <?php echo ($default_font_size == "f14") ? 'selected="selected"' : ''; ?>>14px</option>
                            <option value="f18" <?php echo ($default_font_size == "f18") ? 'selected="selected"' : ''; ?>>18px</option>
                            <option value="f24" <?php echo ($default_font_size == "f24") ? 'selected="selected"' : ''; ?>>24px</option>
                            <option value="f36" <?php echo ($default_font_size == "f36") ? 'selected="selected"' : ''; ?>>36px</option>
                        </select>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Background</label>
                        <div class="ff_storyview_background_color_colorpicker">
                            <input data-blockid="%BLOCKID%" type="text" name="ff_storyview_block_item_text_background_color_%BLOCKID%" id="ff_storyview_block_item_text_background_color_%BLOCKID%" class="ff_storyview_background_color_colorpicker_input" value="<?php echo $default_text_block_background_color; ?>" />
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Font Color</label>
                        <div class="ff_storyview_font_color_colorpicker">
                            <input data-blockid="%BLOCKID%" type="text" name="ff_storyview_block_item_text_font_color_%BLOCKID%" id="ff_storyview_block_item_text_font_color_%BLOCKID%" class="ff_storyview_font_color_colorpicker_input" value="<?php echo $default_text_font_color; ?>" />
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