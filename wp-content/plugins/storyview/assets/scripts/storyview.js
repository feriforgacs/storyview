/*
Story View WordPress plugin 1.0
by Ferenc Forgacs - @feriforgacs
2019.05.
*/

jQuery(document).ready(function($){
    /**
     * Custom dropdown for font and font size
     */
    function customSelect(){
        $(".custom-select").selectric({
            optionsItemBuilder: function(itemData) {
                return itemData.value.length ? '<span class="' + itemData.value +  '">' + itemData.text + '</span>' : itemData.text;
            },
    
            onChange: function(element){
                let blockId = $(element).data("blockid");
                let selectedOption = $(element).val();
    
                if(element.classList.contains("font-family-select")){
                    // change font family in preview
                    setTextFontFamily(blockId, selectedOption);
                } else if(element.classList.contains("font-size-select")){
                    // change font size in preview
                    setTextFontSize(blockId, selectedOption);
                }
            }
        });
    }
    customSelect();

    /**
     * Sortable story view blocks
     */
    $("#ff_storyview_blocks_list").sortable({
        placeholder: "ui-state-highlight",
        axis: "y",
        update: function(event, ui){
            updateStoryBlockIDs();
        }
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
            $("#ff_storyview_block_image_" + blockId).val(attachment.url);

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

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_block_item_text_background_color_label", function(){
        let backgroundColorValue = $(this).children("input[type=radio]").val();
        let blockId = $(this).data("blockid");

        $('.ff_storyview_block_item_text_background_color_label[data-blockid="' + blockId + '"] .activ').removeClass("activ");
        $(this).children(".color-preview").addClass("activ");
        
        setTextBackgroundColor(blockId, backgroundColorValue);
    });

    /**
     * Set story view block text background for preview
     * @param {int} blockId selected block id
     * @param {string} backgroundColor selected background color css class
     */
    function setTextBackgroundColor(blockId, backgroundColor){
        // set text background
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").removeClass("ff_storyview_block_background_black ff_storyview_block_background_gray ff_storyview_block_background_red ff_storyview_block_background_white ff_storyview_block_background_transparent").addClass(backgroundColor);
    }

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_block_item_text_font_color_label", function(){
        let fontColorValue = $(this).children("input[type=radio]").val();
        let blockId = $(this).data("blockid");

        $('.ff_storyview_block_item_text_font_color_label[data-blockid="' + blockId + '"] .activ').removeClass("activ");
        $(this).children(".color-preview").addClass("activ");
        
        setTextColor(blockId, fontColorValue);
    });
    /**
     * Set story view block text color for preview
     * @param {int} blockId selected block id
     * @param {string} fontColor selected text color css class
     */
    function setTextColor(blockId, fontColor){
        // set text color
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").removeClass("ff_storyview_block_color_black ff_storyview_block_color_gray ff_storyview_block_color_red ff_storyview_block_color_white").addClass(fontColor);
    }

    /**
     * Set story view block text font family for preview
     * @param {int} blockId selected block id
     * @param {string} fontFamilyClass selected font family css class
     */
    function setTextFontFamily(blockId, fontFamilyClass){
        // set text font family
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").removeClass("arial courier roboto rounded montserrat lily").addClass(fontFamilyClass);
    }

    /**
     * Set story view block text font size for preview
     * @param {int} blockId selected block id
     * @param {string} fontSizeClass selected font size css class
     */
    function setTextFontSize(blockId, fontSizeClass){
        // set text font family
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").removeClass("f12 f14 f18 f24 f36").addClass(fontSizeClass);
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

        updateButtonImage();
    }

    $("#ff_storyview_blocks_list").on("click", ".ff_storyview_block_delete_button", function(){
        let blockId = $(this).data("blockid");
        if(confirm("Are you sure you want to remove the selected story block?")){
            deleteStoryBlock(blockId);
        }
    });

    /**
     * Remove selected story block from the list
     * @param {int} blockId selected block id
     */
    function deleteStoryBlock(blockId){
        $("#ff_storyview_block_item_" + blockId).remove();
        
        // update story block IDs
        updateStoryBlockIDs();
    }

    /**
     * Add new story block item to the list
     */
    $("#ff_storyview_add_block_button").on("click", addStoryBlockItem);
    function addStoryBlockItem(){
        let storyBlockItems = $(".ff_storyview_block_item").length;
        storyBlockItems += 1;
        let storyBlockTemplate = $("#storyview_block_template").html();
        let newStoryBlockItem = storyBlockTemplate.replace(/%BLOCKID%/gi, storyBlockItems);
        $(newStoryBlockItem).appendTo("#ff_storyview_blocks_list");

        customSelect();

        // update story block IDs
        updateStoryBlockIDs();
    }

    /**
     * Toggle story view settings on activation
     */
    const storyViewBasicSettings = $("#ff_storyview_basic_settings");
    const storyViewBlocks = $("#ff_storyview_blocks");
    const addBlockButton = $("#ff_storyview_add_block_button");
    $("#ff_storyview_activ").on("change", function(){
        if($(this).is(":checked")){
            // show story view settings
            storyViewBasicSettings.show();
            storyViewBlocks.show();
            addBlockButton.show();
        } else {
            // hide story view settings
            storyViewBasicSettings.hide();
            storyViewBlocks.hide();
            addBlockButton.hide();
        }
    });

    /**
     * Update story block ids after
     * - sort
     * - add
     * - remove
     */
    const storyBlockIDs = $("#story_block_ids");
    function updateStoryBlockIDs(){
        let storyBlockIds = "";
        $("#ff_storyview_blocks_list .ff_storyview_block_item").each(function(){
            storyBlockIds += $(this).data("blockid") + ",";
        });

        storyBlockIDs.val(storyBlockIds);
        updateButtonImage();
    }

    /**
     * Find the highest story block id
     */
    function getHighestStoryID(){
        let highestId = 1;
        $("#ff_storyview_blocks_list .ff_storyview_block_item").each(function(){
            if($(this).data("blockid") > highestId){
                highestId = $(this).data("blockid");
            }
        });
        return highestId;
    }

    /**
     * Update story view button text
     */
    $("#ff_storyview_button_text").on("keyup", function(){
        let buttonText = $(this).val();
        $(".ff_storyview_button .ff_storyview_button_text").each(function(){
            $(this).text(buttonText);
        });
    });

    /**
     * Display / Update button image
     */
    function updateButtonImage(){
        if($(".ff_storyview_block_item").length){
            let image = $(".ff_storyview_block_item:first-child .ff_storyview_block_item_content").css("background-image");

            $(".ff_storyview_button .ff_storyview_button_icon").each(function(){
                $(this).css({
                    "background-image": image
                });
            });
        } else {
            $(".ff_storyview_button .ff_storyview_button_icon").each(function(){
                $(this).css({
                    "background-image": "none"
                });
            });
        }
    }

    updateButtonImage();

    /**
     * Display / hide other button type code section
     */
    $("input.ff_storyview_button_type").on("change", function(){
        if($("#ff_storyview_button_type_other").is(":checked")){
            $("#ff_storyview_button_types_other").show();
        } else {
            $("#ff_storyview_button_types_other").hide();
        }
    });

});