<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}
?>
<script type="text/template" id="storyview_block_code_template">
    <div class="ff_storyview_block_item ff_storyview_block_item_code" id="ff_storyview_block_item_%BLOCKID%" data-blockid="%BLOCKID%">
        <div class="ff_storyview_block_item_move">
            <i>
                <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" role="img" aria-hidden="true" focusable="false"><path d="M13,8c0.6,0,1-0.4,1-1s-0.4-1-1-1s-1,0.4-1,1S12.4,8,13,8z M5,6C4.4,6,4,6.4,4,7s0.4,1,1,1s1-0.4,1-1S5.6,6,5,6z M5,10 c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S5.6,10,5,10z M13,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S13.6,10,13,10z M9,6 C8.4,6,8,6.4,8,7s0.4,1,1,1s1-0.4,1-1S9.6,6,9,6z M9,10c-0.6,0-1,0.4-1,1s0.4,1,1,1s1-0.4,1-1S9.6,10,9,10z"></path></svg>
            </i>
        </div>

        <div class="ff_storyview_block_item_preview ff_storyview_block_item_preview_code">
            <p class="preview_text">preview</p>
            <div class="ff_storyview_block_item_content">
            </div>
        </div>

        <div class="ff_storyview_block_item_settings">
            <p class="block_type_label custom">Custom Block</p>
            <div class="ff_storyview_block_item_settings_block">
                <h3>Custom Block Content</h3>
                <p class="ff_storyview_info">
                    <i>i</i> The preview of shortcodes will be visible on the frontend.
                </p>
                <p class="ff_storyview_info">
                    <i>i</i> Custom Blocks are not visible in AMP Stories.
                </p>
                <label class="ff_storyview_label" for="ff_storyview_block_content_%BLOCKID%">Add your shortcode, or custom HTML code to the field below</label>
                <textarea data-blockid="%BLOCKID%" class="ff_storyview_block_content_editor" id="ff_storyview_block_content_%BLOCKID%" name="ff_storyview_block_content_%BLOCKID%"></textarea>
                <input type="hidden" name="ff_storyview_block_type_%BLOCKID%" value="code" />

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Custom Block Background</label>
                        <div class="ff_storyview_background_color_colorpicker">
                            <input data-blockid="%BLOCKID%" type="text" name="ff_storyview_block_item_block_background_color_%BLOCKID%" id="ff_storyview_block_item_block_background_color_%BLOCKID%" class="ff_storyview_custom_background_color_colorpicker_input" value="rgba(0, 0, 0, .8)" />
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
</script><!-- end #storyview_block_code_template -->