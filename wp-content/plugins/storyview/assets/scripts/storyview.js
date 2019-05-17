/*
Story View WordPress plugin 1.0
by Ferenc Forgacs - @feriforgacs
2019.05.
*/

jQuery(document).ready(function($){
    /**
     * Custom dropdown for font and font size
     */
    $(".custom-select").selectric({
        optionsItemBuilder: function(itemData) {
            return itemData.value.length ? '<span class="' + itemData.value +  '">' + itemData.text + '</span>' : itemData.text;
        }
    });

    /**
     * Sortable story view blocks
     */
    $("#ff_storyview_blocks_list").sortable({
        placeholder: "ui-state-highlight",
        axis: "y"
    });

    // file selector
    let file_frame;
    let wp_media_post_id = wp.media.model.settings.post.id;
    let set_to_post_id = wp_media_post_id;
    let blockId = 0;

    /**
     * Handle story view block image select
     */
    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_image_upload", function( event ){
        event.preventDefault();
        // get selected block id
        blockId = $(this).data("blockid");

        // open the file frame if exists
        if (file_frame) {
            file_frame.uploader.uploader.param("post_id", set_to_post_id );
            file_frame.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }
        
        // create the file frame
        file_frame = wp.media.frames.file_frame = wp.media({
            title: "Select image",
            button: {
                text: "Use this image",
            },
            multiple: false
        });
        
        // process data after the file was selected in the file frame
        file_frame.on("select", function() {
            attachment = file_frame.state().get("selection").first().toJSON();
            
            wp.media.model.settings.post.id = wp_media_post_id;

            // add image url value to the story view block hidden image field
            $("#ff_storyview_image_block_" + blockId).val(attachment.url);

            // set image for preview
            setImage(attachment.url, blockId);
        });
        
        // open the file frame
        file_frame.open();
    });

    
    $("a.add_media").on("click", function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });

    /**
     * Display story view block preview with uploaded or selected image
     * @param {string} image_url uploaded or selected attachment url
     * @param {int} blockId selected storyview block id
     */
    function setImage(image_url, blockId){
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").css({
            "background-image": "url(" + image_url + ")"
        });

        displayStoryPreview(blockId);
    }

    $("#ff_storyview_blocks_list").on("keyup", ".ff_storyview_block_item_text_textarea", function(){
        setTextContent($(this).data("blockid"));
    });

    /**
     * Display text in preview section
     * @param {int} blockId selected block id
     */
    function setTextContent(blockId){
        // get text content
        let text = $("#ff_storyview_block_item_text_" + blockId).val();
        // set text content
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").text(text);

        displayStoryPreview(blockId);
    }

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_block_item_text_position_label", function(){
        let positionValue = $(this).children("input[type=radio]").val();
        let blockId = $(this).data("blockid");

        $('.ff_storyview_block_item_text_position_label.activ[data-blockid="' + blockId + '"]').removeClass("activ");
        $(this).addClass("activ");
        
        setTextPosition(blockId, positionValue);
    });
    /**
     * Set story view block text position for preview
     * @param {int} blockId selected block id
     * @param {string} position selected block position css class
     */
    function setTextPosition(blockId, position){
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content").removeClass("ff_storyview_text_block_top ff_storyview_text_block_middle ff_storyview_text_block_bottom").addClass(position);
    }

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_block_item_text_align_label", function(){
        let alignmentValue = $(this).children("input[type=radio]").val();
        let blockId = $(this).data("blockid");

        $('.ff_storyview_block_item_text_align_label.activ[data-blockid="' + blockId + '"]').removeClass("activ");
        $(this).addClass("activ");
        
        setTextAlignment(blockId, alignmentValue);
    });
    /**
     * Set story block text alignment for preview
     * @param {int} blockId selected block id
     * @param {string} alignment selected text alignment css class
     */
    function setTextAlignment(blockId, alignment){
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content").removeClass("ff_storyview_text_align_left ff_storyview_text_align_center ff_storyview_text_align_right").addClass(alignment);
    }

    /**
     * Set story view block text background for preview
     * @param {int} blockId selected block id
     */
    function setTextBackground(blockId){
        // get text background
        // set text background
    }

    /**
     * Set story view block text color for preview
     * @param {int} blockId selected block id
     */
    function setTextColor(blockId){
        // get text color
        // set text color
    }

    /**
     * Set story view block text font family for preview
     * @param {int} blockId selected block id
     */
    function setTextFontFamily(blockId){
        // get text font family
        // set text font family
    }

    /**
     * Set story view block text font color for preview
     * @param {int} blockId selected block id
     */
    function setTextFontColor(blockId){
        // get text font color
        // set text font color
    }

    /**
     * Display story preview for selected block
     * @param {int} blockId selected block id
     */
    function displayStoryPreview(blockId){
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_preview .preview_text").hide();

        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").css({
            "display": "flex"
        });
    }

});