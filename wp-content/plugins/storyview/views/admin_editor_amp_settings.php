<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

?>

<div id="ff_storyview_amp_story_settings" class="ff_storyview_block">
    <h3 class="ff_storyview_block_header">AMP Story Settings</h3>
    <input id="ff_storyview_amp_activ" name="ff_storyview_amp_activ" class="components-checkbox-control__input" type="checkbox" value="1" <?php
    if(isset($storyview_data->amp_activ) && $storyview_data->amp_activ == 1){
        $storyview_amp_activ = true;
        ?>checked="checked"<?php
    }
    ?> />
    <label for="ff_storyview_amp_activ">Generate AMP Story for this Story View <small>| Learn more about AMP Stories <a href="https://amp.dev/about/stories" target="_blank">here</a></small></label>

    <div class="ff_storyview_amp_cover ff_storyview_amp_cover_classic">
        <div class="ff_storyview_amp_cover_move"></div>
        <div class="ff_storyview_amp_cover_preview">
            <p class="preview_text">preview</p>
            <div class="ff_storyview_amp_cover_content ff_storyview_text_block_top ff_storyview_text_align_left">
                <p class="block_item_text ff_storyview_block_background_black ff_storyview_block_color_white arial f12"></p>
            </div>
        </div>

        <div class="ff_storyview_amp_cover_settings">
            <p class="block_type_label amp">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><g fill="none" fill-rule="evenodd"><path fill="#005AF0" d="M0 15c0 8.284 6.716 15 15 15 8.285 0 15-6.716 15-15 0-8.284-6.715-15-15-15C6.716 0 0 6.716 0 15z"></path><path fill="#FFFFFF" fill-rule="nonzero" d="M13.85 24.098h-1.14l1.128-6.823-3.49.005h-.05a.57.57 0 0 1-.568-.569c0-.135.125-.363.125-.363l6.272-10.46 1.16.005-1.156 6.834 3.508-.004h.056c.314 0 .569.254.569.568 0 .128-.05.24-.121.335L13.85 24.098zM15 0C6.716 0 0 6.716 0 15c0 8.284 6.716 15 15 15 8.285 0 15-6.716 15-15 0-8.284-6.715-15-15-15z"></path></g></svg>
                AMP Story Cover
            </p>
            <div class="ff_storyview_amp_cover_settings_block">
                <div class="ff_storyview_amp_cover_image_upload">
                    <input type="button" class="ff_storyview_amp_cover_upload button" value="Select AMP Story Cover Image" />
                    <input type="hidden" name="ff_storyview_amp_cover_image" id="ff_storyview_amp_cover_image" value="" />
                    <br /><small>Ideal size 1080x1920px. For better performance, try to <a href="https://tinypng.com/" target="_blank">optimize</a> the size of the image.</small>
                </div>
            </div>

            <div class="ff_storyview_amp_cover_settings_block">
                <div class="ff_storyview_amp_publisher_logo ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <div id="ff_storyview_amp_publisher_logo_preview">
                            <p class="ff_storyview_amp_preview_text">Logo Preview</p>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <input type="button" id="ff_storyview_amp_publisher_logo_upload" class="button ff_storyview_amp_publisher_logo_upload" value="Select AMP Story Publisher Logo" /><br />
                        <small>The file should be a raster file, such as .jpg, .png, or .gif<br />
                            The logo shape should be a square, not a rectangle.<br />
                            The background color should not be transparent.<br />
                            Use one logo per brand that is consistent across AMP stories.<br />
                            The logo should be at least 96x96 pixels.</small>
                        <input type="hidden" name="ff_storyview_amp_publisher_logo_image" value="" />
                    </div>
                </div>
            </div>

            <div class="ff_storyview_amp_cover_settings_block">
                <h3>Text Settings</h3>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_title">AMP Story Title</label>
                        <textarea name="ff_storyview_amp_cover_text_title" id="ff_storyview_amp_cover_text_title" class="components-textarea-control__input ff_storyview_amp_cover_text_textarea" cols="30" rows="3"></textarea><br />
                        <small>Try to keep it under 160 characters</small>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_author">AMP Story Author Name</label>
                        <input type="text" name="ff_storyview_amp_cover_text_author" id="ff_storyview_amp_cover_text_author" class="components-textarea-control__input ff_storyview_amp_cover_text_textarea" /><br />
                        <small>Try to keep it under 60 characters</small>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Position</label>
                        <div class="ff_storyview_button_group">
                            <label class="ff_storyview_amp_cover_text_position_label activ">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_top" checked="checked" />
                                <span>Top</span>
                                <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="4" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_position_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_middle" />
                                <span>Middle</span>
                                <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="9" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_position_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_bottom" />
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
                            <label class="ff_storyview_amp_cover_text_align_label activ">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_left" checked="checked" />
                                <span>Left</span>
                                <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_align_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_center" />
                                <span>Center</span>
                                <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_align_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_right" />
                                <span>Right</span>
                                <i title="right"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_font_family">Font Family</label>
                        <select data-blockid="ampcover" name="ff_storyview_amp_cover_text_font_family" class="custom-select font-family-select" id="ff_storyview_amp_cover_text_font_family">
                            <option value="arial" selected="selected">Arial</option>    
                            <option value="courier">Courier</option>
                            <option value="roboto">Roboto</option>
                            <option value="rounded">Rounded</option>
                            <option value="lily">Lily</option>
                            <option value="montserrat">Montserrat</option>
                        </select>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_font_size">Font Size</label>
                        <select data-blockid="ampcover" name="ff_storyview_amp_cover_text_font_size" class="custom-select font-size-select" id="ff_storyview_amp_cover_text_font_size">
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
                            <label class="ff_storyview_amp_cover_text_background_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_background_color" value="ff_storyview_block_background_black" checked="checked" />
                                <span class="color-preview black activ" title="black">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_background_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_background_color" value="ff_storyview_block_background_gray" />
                                <span class="color-preview dark-gray" title="dark gray">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_background_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_background_color" value="ff_storyview_block_background_red" />
                                <span class="color-preview red" title="red">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_background_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_background_color" value="ff_storyview_block_background_white" />
                                <span class="color-preview white" title="white">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_background_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_background_color" value="ff_storyview_block_background_transparent" />
                                <span class="color-preview transparent" title="transparent, no background">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Font Color</label>
                        <div class="ff_storyview_color_group">
                            <label class="ff_storyview_amp_cover_text_font_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_font_color" value="ff_storyview_block_color_black" />
                                <span class="color-preview black">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_font_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_font_color" value="ff_storyview_block_color_gray" />
                                <span class="color-preview dark-gray">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_font_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_font_color" value="ff_storyview_block_color_red" />
                                <span class="color-preview red">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>

                            <label class="ff_storyview_amp_cover_text_font_color_label">
                                <input type="radio" name="ff_storyview_amp_cover_text_font_color" value="ff_storyview_block_color_white" checked="checked" />
                                <span class="color-preview white activ">
                                    <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-saved" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M15.3 5.3l-6.8 6.8-2.8-2.8-1.4 1.4 4.2 4.2 8.2-8.2"></path></svg>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div><!-- end .ff_storyview_amp_cover -->
</div>