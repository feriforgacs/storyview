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

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_image_upload", function( event ){
        block_id = $(this).data("blockid");
        event.preventDefault();
        if ( file_frame ) {
            file_frame.uploader.uploader.param( "post_id", set_to_post_id );
            file_frame.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }
        
        file_frame = wp.media.frames.file_frame = wp.media({
            title: "Select image",
            button: {
                text: "Use this image",
            },
            multiple: false
        });
        
        file_frame.on("select", function() {
            attachment = file_frame.state().get("selection").first().toJSON();
            
            /* $("#image-preview").attr('src', attachment.url).css("width", "auto");
            $("#image_attachment_id").val(attachment.id); */
            
            wp.media.model.settings.post.id = wp_media_post_id;

            setImage(attachment.url, block_id);
        });
            
        file_frame.open();
    });

    
    $("a.add_media").on("click", function() {
        wp.media.model.settings.post.id = wp_media_post_id;
    });

    function setImage(image_url, block_id){
        console.log(block_id);

        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .preview_text").hide();
        
        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").css({
            "background-image": "url(" + image_url + ")"
        });

        $("#ff_storyview_block_item_" + block_id + " .ff_storyview_block_item_preview .ff_storyview_block_item_content").show();
    }

});