jQuery(document).ready(function($){
  /**
   * Handle AMP Story Publisher logo select
   */
  let file_frame_amp_publisher_logo;
    $("#ff_storyview_amp_publisher_logo_upload").on("click", function( event ){
        event.preventDefault();
  
        // open the file frame if exists
        if (file_frame_amp_publisher_logo) {
            file_frame_amp_publisher_logo.open();
            return;
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
  
            // add image url value to the story view block hidden image field
            $("#ff_storyview_amp_publisher_logo").val(attachment.url);
  
            // set image for preview
            $("#ff_storyview_amp_publisher_logo_preview_image").attr({ "src": attachment.url });
            $("#ff_storyview_amp_publisher_logo_preview").show();
        });
        
        // open the file frame
        file_frame_amp_publisher_logo.open();
    });

    $("#ff_storyview_publisher_logo_delete_button").on("click", function(event){
      event.preventDefault();
      $("#ff_storyview_amp_publisher_logo_preview").hide();
      $("#ff_storyview_amp_publisher_logo").val("");
    });

    $(".ff_storyview_block_item_text_position_label").on("click", function(){
      $('.ff_storyview_block_item_text_position_label.activ').removeClass("activ");
      $(this).addClass("activ");
    });

    $(".ff_storyview_block_item_text_align_label").on("click", function(){
      $('.ff_storyview_block_item_text_align_label.activ').removeClass("activ");
      $(this).addClass("activ");
    });

    $(".custom-select").selectric({
      optionsItemBuilder: function(itemData) {
        return itemData.value.length ? '<span class="' + itemData.value +  '">' + itemData.text + '</span>' : itemData.text;
      }
    });

  $("#ff_storyview_default_text_background_color").spectrum({
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

  $("#ff_storyview_default_text_font_color").spectrum({
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

  $("#ff_storyview_default_custom_block_background_color").spectrum({
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

  $("input.ff_storyview_button_type").on("change", function(){
    if($("#ff_storyview_button_type_other").is(":checked")){
      $("#ff_storyview_button_types_other").show();
    } else {
      $("#ff_storyview_button_types_other").hide();
    }
  });

  $("#ff_storyview_default_button_text").on("keyup", function(){
    let buttonText = $(this).val();
    $(".ff_storyview_button .ff_storyview_button_text").each(function(){
        $(this).text(buttonText);
    });
  });

  /**
   * Button designer scripts
   */

  // display colorpickers based on select value
  $("#button_background_type").on("change", function(){
    if($(this).val() == "color"){
      // display colorpicker for solid color
      $("#color").removeClass("hidden");
      $("#gradient").addClass("hidden");
    } else {
      // display colorpickers for gradient
      $("#color").addClass("hidden");
      $("#gradient").removeClass("hidden");
    }
  });

  // colorpickers - button background color
  $("#button_background_color").spectrum({
    clickoutFiresChange: true,
    showInput: true,
    showInitial: true,
    allowEmpty: false,
    showAlpha: true,
    showPalette: true,
    preferredFormat: "rgb"
  });

  // colorpickers - button background gradient start
  $("#button_background_gradient_start").spectrum({
    clickoutFiresChange: true,
    showInput: true,
    showInitial: true,
    allowEmpty: false,
    showAlpha: true,
    showPalette: true,
    preferredFormat: "rgb"
  });

  // colorpickers - button background gradient end
  $("#button_background_gradient_end").spectrum({
    clickoutFiresChange: true,
    showInput: true,
    showInitial: true,
    allowEmpty: false,
    showAlpha: true,
    showPalette: true,
    preferredFormat: "rgb"
  });

  // colorpicker - font color
  $("#button_font_color").spectrum({
    clickoutFiresChange: true,
    showInput: true,
    showInitial: true,
    allowEmpty: false,
    showAlpha: true,
    showPalette: true,
    preferredFormat: "rgb"
  });

  // colorpicker - border color
  $("#button_border_color").spectrum({
    clickoutFiresChange: true,
    showInput: true,
    showInitial: true,
    allowEmpty: false,
    showAlpha: true,
    showPalette: true,
    preferredFormat: "rgb"
  });

  /**
   * Button layout change
   */
  $(".button_layout").on("change", function(e){
    const selectedLayout = $(this).val();
    $("#button").attr("class", `ff_storyview_button_layout_${selectedLayout}`);
  });

  /**
   * Update button preview on data change
   */
  function updateButtonPreview(){
    // background type
    const backgroundType = $("#button_background_type").val();
    let background = "";

    // background color or gradient
    if(backgroundType == "color"){
      const backgroundColor = $("#button_background_color").val();
      background = `background: ${backgroundColor};`;
    } else {
      // get gradient type
      const gradientType = (backgroundType == "linear_gradient") ? 'linear-gradient' : 'radial-gradient';
      const gradientColorStart = $("#button_background_gradient_start").val();
      const gradientColorEnd = $("#button_background_gradient_end").val();

      background = `background: ${gradientType}(${gradientColorStart}, ${gradientColorEnd});`;
    }

    // font family
    const fontFamily = "font-family: " + $("#button_font_family").val() + ";";

    // font color
    const fontColor = "color: " + $("#button_font_color").val() + ";";

    // font size
    const fontSizeTemp = $("#button_font_size").val();
    let fontSize = "font-size: " + $("#button_font_size").val() + "px;";
    if(fontSizeTemp.includes("p") || fontSizeTemp.includes("em") || fontSizeTemp.includes("%")){
      fontSize = "font-size: " + $("#button_font_size").val() + ";";
    }

    // text alignment
    const textAlignment = "text-align: " + $("#button_text_alignment").val() + ";";

    // border width
    const borderWidthTemp = $("#button_border_width").val();
    let borderWidth = "border-width: " + $("#button_border_width").val() + "px;";
    if(borderWidthTemp.includes("p") || borderWidthTemp.includes("em") || borderWidthTemp.includes("%")){
      borderWidth = "border-width: " + $("#button_border_width").val() + ";";
    }

    // border color
    const borderColor = "border-color: " + $("#button_border_color").val() + ";";

    // padding
    const paddingTemp = $("#button_padding").val();
    let padding = "padding: " + $("#button_padding").val() + "px;";
    if(paddingTemp.includes("p") || paddingTemp.includes("em") || paddingTemp.includes("%")){
      padding = "padding: " + $("#button_padding").val() + ";";
    }

    // custom css
    const customCSS = $("#button_custom_css").val().replace(/[\r\n\t]/g, "");

    const buttonCSS = `${background} ${fontFamily} ${fontColor} ${fontSize} ${textAlignment} ${borderWidth} ${borderColor} ${padding} ${customCSS}`;
    $("#button").attr("style", buttonCSS);
  }

  updateButtonPreview();

  $(".button_custom_value").on("change", updateButtonPreview);

});