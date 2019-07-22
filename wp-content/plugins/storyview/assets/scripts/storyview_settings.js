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

  });