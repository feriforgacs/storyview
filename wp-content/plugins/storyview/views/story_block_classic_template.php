<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
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
            <div class="ff_storyview_block_item_content ff_storyview_text_block_top ff_storyview_text_align_left">
                <p class="block_item_text arial f12" style="background-color: rgba(0, 0, 0, .8); color: rgb(255, 255, 255);"></p>
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
                        <div class="ff_storyview_background_color_colorpicker">
                            <input data-blockid="%BLOCKID%" type="text" name="ff_storyview_block_item_text_background_color_%BLOCKID%" id="ff_storyview_block_item_text_background_color_%BLOCKID%" class="ff_storyview_background_color_colorpicker_input" value="rgba(0, 0, 0, .8)" />
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Font Color</label>
                        <div class="ff_storyview_font_color_colorpicker">
                            <input data-blockid="%BLOCKID%" type="text" name="ff_storyview_block_item_text_font_color_%BLOCKID%" id="ff_storyview_block_item_text_font_color_%BLOCKID%" class="ff_storyview_font_color_colorpicker_input" value="rgb(255, 255, 255)" />
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