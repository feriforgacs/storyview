/*
Story View WordPress plugin 1.0
by Ferenc Forgacs - @feriforgacs
2019.05.
*/

jQuery(document).ready(function($){
    // file selector
    let file_frame;
    let wp_media_post_id = wp.media.model.settings.post.id;
    let set_to_post_id = wp_media_post_id;
    let block_id = 0;

    /**
     * Handle story view block image upload
     */
    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_image_upload", function( event ){
        event.preventDefault();
        // get selected block id
        block_id = $(this).data("blockid");

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
            $("#ff_storyview_image_block_" + block_id).val(attachment.url);

            // set image for preview
            setImage(attachment.url, block_id);
        });
        
        // open the file frame
        file_frame.open();
    });

    
    $("a.add_media").on("click", function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });

    /**
     * Display story vew block preview with uploaded or selected image
     * @param {string} image_url uploaded or selected attachment url
     * @param {int} block_id selected storyview block id
     */
    function setImage(image_url, block_id){
        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .preview_text").hide();
        
        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").css({
            "background-image": "url(" + image_url + ")"
        });

        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").show();
    }

});