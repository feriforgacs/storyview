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
                    if(blockId == "ampcover"){
                        setAmpTextFontFamily(selectedOption);
                    } else {
                        setTextFontFamily(blockId, selectedOption);
                    }
                } else if(element.classList.contains("font-size-select")){
                    // change font size in preview
                    if(blockId == "ampcover"){
                        setAmpTextFontSize(selectedOption);
                    } else {
                        setTextFontSize(blockId, selectedOption);
                    }
                }
            }
        });
    }
    customSelect();

    /**
     * Sortable story view blocks
     */
    $("#ff_storyview_blocks_list").sortable({
        handle: ".ff_storyview_block_item_move",
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
     * Display storyview custom block preview
     */
    $("#ff_storyview_blocks_list").on("keyup", ".ff_storyview_block_content_editor", function(){
        let blockId = $(this).data("blockid");
        let codeBlockValue = $(this).val();
        // set preview content
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content").html(codeBlockValue).css({ "display": "flex" });
        // hide preview text
        $("#ff_storyview_block_item_" + blockId + " .preview_text").css({ "display": "none" });
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
     * @param {string} backgroundColor selected background rgba value
     */
    function setTextBackgroundColor(blockId, backgroundColor){
        // set text background
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").css({
            "background-color": backgroundColor
        });

        // set background color value for colorpicker input
        $("#ff_storyview_block_item_text_background_color_" + blockId).val(backgroundColor);
    }

    /**
     * Set story view block text color for preview
     * @param {int} blockId selected block id
     * @param {string} fontColor selected text color rgba value
     */
    function setTextColor(blockId, fontColor){
        // set text color
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_content .block_item_text").css({
            "color": fontColor
        });

        // set text color value for colorpicker input
        $("#ff_storyview_block_item_text_font_color_" + blockId).val(fontColor);
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
     * 
     * @param {int} blockId selected block id
     * @param {string} backgroundColor selected custom color rgba code
     */
    function setBlockBackgroundColor(blockId, backgroundColor){
        $("#ff_storyview_block_item_" + blockId + " .ff_storyview_block_item_preview_code .ff_storyview_block_item_content").css({
            "background-color": backgroundColor
        });

        $("#ff_storyview_block_item_block_background_color_" + blockId).val(backgroundColor);
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

        // display custom colorpicker
        customColorPicker();
    }

    /**
     * Add new custom story block item to the list
     */
    $("#ff_storyview_add_code_block_button").on("click", addStoryCodeBlockItem);
    function addStoryCodeBlockItem(){
        let storyBlockItems = $(".ff_storyview_block_item").length;
        storyBlockItems += 1;
        let storyBlockTemplate = $("#storyview_block_code_template").html();
        let newStoryBlockItem = storyBlockTemplate.replace(/%BLOCKID%/gi, storyBlockItems);
        $(newStoryBlockItem).appendTo("#ff_storyview_blocks_list");

        // update story block IDs
        updateStoryBlockIDs();

        // display custom colorpicker
        customColorPicker();
    }

    /**
     * Toggle story view settings on activation
     */
    const storyviewSettingsWrapper = $("#storyview-settings-wrapper");
    $("#ff_storyview_activ").on("change", function(){
        if($(this).is(":checked")){
            storyviewSettingsWrapper.addClass("visible");
        } else {
            storyviewSettingsWrapper.removeClass("visible");
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
            let blockId = $(this).data("blockid")
            storyBlockIds +=  blockId + ",";
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
            let image = $(".ff_storyview_block_item_classic:first").first().find(".ff_storyview_block_item_content").css("background-image");

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

    /**
     * AMP Story settings
     */

    /**
     * Set AMP Story cover text background color
     * @param {string} backgroundColor selected background color rgba value
     */
    function setAmpTextBackgroundColor(backgroundColor){
        // set text background
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content .block_item_text").css({
            "background-color": backgroundColor
        });

        $("#ff_storyview_amp_cover_text_background_color").val(backgroundColor);
    }

    /**
     * Set AMP Story cover text color
     * @param {string} fontColor selected background color rgba value
     */
    function setAmpTextColor(fontColor){
        // set text color
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content .block_item_text").css({
            "color": fontColor
        });

        $("#ff_storyview_amp_cover_text_font_color").val(fontColor);
    }

    /**
     * Set AMP Cover text position for preview
     * @param {string} position selected block position css class
     */
    function setAmpTextPosition(position){
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content").removeClass("ff_storyview_text_block_top ff_storyview_text_block_middle ff_storyview_text_block_bottom").addClass(position);
    }

    $("#ff_storyview_amp_story_settings").on("click", ".ff_storyview_amp_cover_text_position_label", function(){
        let positionValue = $(this).children("input[type=radio]").val();

        $('.ff_storyview_amp_cover_text_position_label.activ').removeClass("activ");
        $(this).addClass("activ");
        
        setAmpTextPosition(positionValue);
    });

    /**
     * Set AMP Cover text alignment for preview
     * @param {string} alignment selected text alignment css class
     */
    function setAmpTextAlignment(alignment){
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content").removeClass("ff_storyview_text_align_left ff_storyview_text_align_center ff_storyview_text_align_right").addClass(alignment);
    }

    $("#ff_storyview_amp_story_settings").on("click", ".ff_storyview_amp_cover_text_align_label", function(){
        let alignmentValue = $(this).children("input[type=radio]").val();

        $('.ff_storyview_amp_cover_text_align_label.activ').removeClass("activ");
        $(this).addClass("activ");
        
        setAmpTextAlignment(alignmentValue);
    });

    /**
     * Set AMP Cover text font family for preview
     * @param {string} fontFamilyClass selected font family css class
     */
    function setAmpTextFontFamily(fontFamilyClass){
        // set text font family
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content .block_item_text").removeClass("arial courier roboto rounded montserrat lily").addClass(fontFamilyClass);
    }

    /**
     * Set AMP Cover text font size for preview
     * @param {string} fontSizeClass selected font size css class
     */
    function setAmpTextFontSize(fontSizeClass){
        // set text font family
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_content .block_item_text").removeClass("f12 f14 f18 f24 f36").addClass(fontSizeClass);
    }

    /**
     * Handle AMP Story Cover image select
     */
    let file_frame_amp_cover;
    $("#ff_storyview_amp_story_settings").on("click", ".ff_storyview_amp_cover_upload", function( event ){
        event.preventDefault();

        // open the file frame if exists
        if (file_frame_amp_cover) {
            file_frame_amp_cover.uploader.uploader.param("post_id", set_to_post_id );
            file_frame_amp_cover.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }
        
        // create the file frame
        file_frame_amp_cover = wp.media.frames.file_frame_amp_cover = wp.media({
            title: "Select image",
            button: {
                text: "Use this image",
            },
            multiple: false
        });
        
        // process data after the file was selected in the file frame
        file_frame_amp_cover.on("select", function() {
            attachment = file_frame_amp_cover.state().get("selection").first().toJSON();
            
            wp.media.model.settings.post.id = wp_media_post_id;

            // add image url value to the story view block hidden image field
            $("#ff_storyview_amp_cover_image").val(attachment.url);

            // set image for preview
            setAmpCoverImage(attachment.url);
        });
        
        // open the file frame
        file_frame_amp_cover.open();
    });

    /**
     * Display AMP Story Cover preview with uploaded or selected image
     * @param {string} image_url uploaded or selected attachment url
     */
    function setAmpCoverImage(image_url){
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_preview .ff_storyview_amp_cover_content").css({
            "background-image": "url(" + image_url + ")"
        });

        displayAmpCoverPreview();
    }

    /**
     * Display AMP Story Cover preview
     */
    function displayAmpCoverPreview(){
        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_preview .preview_text").hide();

        $("#ff_storyview_amp_story_settings .ff_storyview_amp_cover_preview .ff_storyview_amp_cover_content").css({
            "display": "flex"
        });
    }

    /**
     * Handle AMP Story Publisher logo select
     */
    let file_frame_amp_publisher_logo;
    $("#ff_storyview_amp_publisher_logo_upload").on("click", function( event ){
        event.preventDefault();

        // open the file frame if exists
        if (file_frame_amp_publisher_logo) {
            file_frame_amp_publisher_logo.uploader.uploader.param("post_id", set_to_post_id );
            file_frame_amp_publisher_logo.open();
            return;
        } else {
            wp.media.model.settings.post.id = set_to_post_id;
        }
        
        // create the file frame
        file_frame_amp_publisher_logo = wp.media.frames.file_frame_amp_publisher_logo = wp.media({
            title: "Select image",
            button: {
                text: "Use this image",
            },
            multiple: false
        });
        
        // process data after the file was selected in the file frame
        file_frame_amp_publisher_logo.on("select", function() {
            attachment = file_frame_amp_publisher_logo.state().get("selection").first().toJSON();
            
            wp.media.model.settings.post.id = wp_media_post_id;

            // add image url value to the story view block hidden image field
            $("#ff_storyview_amp_publisher_logo_image").val(attachment.url);

            // set image for preview
            setAmpPublisherImage(attachment.url);
        });
        
        // open the file frame
        file_frame_amp_publisher_logo.open();
    });

    /**
     * Display AMP Story Cover preview with uploaded or selected image
     * @param {string} image_url uploaded or selected attachment url
     */
    function setAmpPublisherImage(image_url){
        $("#ff_storyview_amp_publisher_logo_preview").html(`<img src="${image_url}" />`);
        // change amp publisher image default value to zero
        $("#ff_storyview_amp_publisher_logo_default").val(0);
    }

    /**
     * Display AMP Story title and author name
     */
    $("#ff_storyview_amp_cover_text_title").on("keyup", function(){
        displayAmpTitleAuthor();
    });

    $("#ff_storyview_amp_cover_text_author").on("keyup", function(){
        displayAmpTitleAuthor();
    });

    function displayAmpTitleAuthor(){
        let title = $("#ff_storyview_amp_cover_text_title").val();
        let author = $("#ff_storyview_amp_cover_text_author").val();

        $("#amp_cover_text_content").html(`${title}<br /><span class="amp_author">${author}</span>`);
        displayAmpCoverPreview();

        /**
         * Check if author changed from default value
         */
        if(author !== ampCoverAuthorName){
            $("#ff_storyview_amp_cover_author_name_default").val(0);
        } else {
            $("#ff_storyview_amp_cover_author_name_default").val(1);
        }
    }

    /**
     * Toggle AMP cover settings panel
     */
    $("#ff_storyview_amp_activ").on("change", function(){
        if($(this).is(":checked")){
            // display AMP cover settings panel
            $("#ff_storyview_amp_cover_settings_container").css({"display": "flex"});
        } else {
            // hide AMP cover settings panel
            $("#ff_storyview_amp_cover_settings_container").css({"display": "none"});
        }
    });

    function customColorPicker(){
        /**
         * Custom color picker - Classic story block background color
         */
        $(".ff_storyview_background_color_colorpicker_input").spectrum({
            clickoutFiresChange: true,
            showInput: true,
            showInitial: true,
            allowEmpty: false,
            showAlpha: true,
            showPalette: true,
            preferredFormat: "rgb",
            palette: [[
                "rgba(0, 0, 0, .8)",
                "rgba(51, 51, 51, .8)",
                "rgba(201, 44, 44, .8)",
                "rgba(255, 255, 255, .8)",
                "rgba(255, 255, 255, 0)"
            ]]
        });

        /**
         * Custom color picker - Classic story block font color
         */
        $(".ff_storyview_font_color_colorpicker_input").spectrum({
            clickoutFiresChange: true,
            showInput: true,
            showInitial: true,
            allowEmpty: false,
            showAlpha: true,
            showPalette: true,
            preferredFormat: "rgb",
            palette: [[
                "rgb(0, 0, 0)",
                "rgb(51, 51, 51)",
                "rgb(201, 44, 44)",
                "rgb(255, 255, 255)"
            ]]
        });

        /**
         * Set preview text background color on change
         */
        $(".ff_storyview_background_color_colorpicker_input").on("change.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextBackgroundColor(blockId, color.toRgbString());
            } else {
                setTextBackgroundColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Set preview text background color on move
         */
        $(".ff_storyview_background_color_colorpicker_input").on("move.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextBackgroundColor(blockId, color.toRgbString());
            } else {
                setTextBackgroundColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Set preview text background color on cancel
         */
        $(".ff_storyview_background_color_colorpicker_input").on("hide.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextBackgroundColor(blockId, color.toRgbString());
            } else {
                setTextBackgroundColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Set preview text font color on change
         */
        $(".ff_storyview_font_color_colorpicker_input").on("change.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextColor(blockId, color.toRgbString());
            } else {
                setTextColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Set preview text font color on move
         */
        $(".ff_storyview_font_color_colorpicker_input").on("move.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextColor(blockId, color.toRgbString());
            } else {
                setTextColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Set preview text font color on move
         */
        $(".ff_storyview_font_color_colorpicker_input").on("hide.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setTextColor(blockId, color.toRgbString());
            } else {
                setTextColor(blockId, "rgba(0, 0, 0, 0)");
            }
        });

        /**
         * Display custom colorpicker for custom story blocks
         */
        $(".ff_storyview_custom_background_color_colorpicker_input").spectrum({
            clickoutFiresChange: true,
            showInput: true,
            showInitial: true,
            allowEmpty: false,
            showAlpha: true,
            showPalette: true,
            preferredFormat: "rgb",
            palette: [[
                "rgba(0, 0, 0, .8)",
                "rgba(51, 51, 51, .8)",
                "rgba(201, 44, 44, .8)",
                "rgba(255, 255, 255, .8)",
                "rgba(255, 255, 255, 0)"
            ]]
        });

        /**
         * Set custom block preview background color on change
         */
        $(".ff_storyview_custom_background_color_colorpicker_input").on("change.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setBlockBackgroundColor(blockId, color.toRgbString());
            } else {
                setBlockBackgroundColor(blockId, "rgba(0, 0, 0, .8)");
            }
        });

        /**
         * Set custom block preview background color on move
         */
        $(".ff_storyview_custom_background_color_colorpicker_input").on("move.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setBlockBackgroundColor(blockId, color.toRgbString());
            } else {
                setBlockBackgroundColor(blockId, "rgba(0, 0, 0, .8)");
            }
        });

        /**
         * Set custom block preview background color on hide
         */
        $(".ff_storyview_custom_background_color_colorpicker_input").on("hide.spectrum", function(event, color){
            let blockId = event.target.dataset.blockid;
            if(color){
                setBlockBackgroundColor(blockId, color.toRgbString());
            } else {
                setBlockBackgroundColor(blockId, "rgba(0, 0, 0, .8)");
            }
        });
    }

    customColorPicker();

    /**
     * Custom colorpicker - AMP Cover background color
     */
    $("#ff_storyview_amp_cover_text_background_color").spectrum({
        clickoutFiresChange: true,
        showInput: true,
        showInitial: true,
        allowEmpty: false,
        showAlpha: true,
        showPalette: true,
        preferredFormat: "rgb",
        palette: [[
            "rgba(0, 0, 0, .8)",
            "rgba(51, 51, 51, .8)",
            "rgba(201, 44, 44, .8)",
            "rgba(255, 255, 255, .8)",
            "rgba(255, 255, 255, 0)"
        ]],
        change: function(color){
            if(color){
                setAmpTextBackgroundColor(color.toRgbString());
            } else {
                setAmpTextBackgroundColor("rgba(0, 0, 0, 0)");
            }
            
        },
        move: function(color){
            if(color){
                setAmpTextBackgroundColor(color.toRgbString());
            } else {
                setAmpTextBackgroundColor("rgba(0, 0, 0, 0)");
            }
        },
        hide: function(color){
            if(color){
                setAmpTextBackgroundColor(color.toRgbString());
            } else {
                setAmpTextBackgroundColor("rgba(0, 0, 0, 0)");
            }
        }
    });

    /**
     * Custom colorpicker - AMP Cover font color
     */
    $("#ff_storyview_amp_cover_text_font_color").spectrum({
        clickoutFiresChange: true,
        showInput: true,
        showInitial: true,
        allowEmpty: false,
        showAlpha: true,
        showPalette: true,
        preferredFormat: "rgb",
        palette: [[
            "rgba(0, 0, 0, 1)",
            "rgba(51, 51, 51, 1)",
            "rgba(201, 44, 44, 1)",
            "rgba(255, 255, 255, 1)"
        ]],
        change: function(color){
            if(color){
                setAmpTextColor(color.toRgbString());
            } else {
                setAmpTextColor("rgba(0, 0, 0, 0)");
            }
            
        },
        move: function(color){
            if(color){
                setAmpTextColor(color.toRgbString());
            } else {
                setAmpTextColor("rgba(0, 0, 0, 0)");
            }
        },
        hide: function(color){
            if(color){
                setAmpTextColor(color.toRgbString());
            } else {
                setAmpTextColor("rgba(0, 0, 0, 0)");
            }
        }
    });

    /**
     * Toggle story editor tabs
     */
    $("#storyview-settings-wrapper__tabs .tab").on("click", function(){
        if($(this).hasClass("tab--active")){
            return;
        }
        const selectedTab = $(this).data("tabcontent");
        
        $("#storyview-settings-wrapper__tab-contents .content--active").removeClass("content--active");
        $("#storyview-settings-wrapper__tabs .tab--active").removeClass("tab--active");

        $(`#content-${selectedTab}`).addClass("content--active");
        $(this).addClass("tab--active");
    });

});