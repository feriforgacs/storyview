<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

/**
 * Default values
 */

$default_button_text = "TL⚡DR";
if(isset($storyview_data->button_text) && strlen($storyview_data->button_text) > 0){
    $default_button_text = $storyview_data->button_text;
} else if(strlen(esc_attr(get_option("ff_storyview_default_button_text"))) > 0){
    $default_button_text = esc_attr(get_option("ff_storyview_default_button_text"));
}

$default_button_type = "1";
$default_button_type_other_code = "";
if(isset($storyview_data->button_type) && strlen($storyview_data->button_type) > 0){
    $default_button_type = $storyview_data->button_type;

    if($default_button_type == "other"){
        $default_button_type_other_code = esc_html($storyview_data->button_other_code);
    }
} else if(strlen(esc_attr(get_option("ff_storyview_default_button_type"))) > 0){
    $default_button_type = esc_attr(get_option("ff_storyview_default_button_type"));

    if($default_button_type == "other"){
        $default_button_type_other_code = esc_attr(get_option("ff_storyview_default_button_type_other_code"));
    }
}

?>
<div id="ff_storyview_container">
    <div class="ff_storyview_block">
        <div class="ff_storyview_block_content">
            <br />
            <input id="ff_storyview_activ" name="ff_storyview_activ" class="components-checkbox-control__input" type="checkbox" value="1" <?php
            if(isset($storyview_data->activ) && $storyview_data->activ == 1){
                $storyview_activ = true;
                ?>checked="checked"<?php
            }
            ?> />
            <label for="ff_storyview_activ">Enable Story View for this post</label>
        </div>
    </div>

    <div id="storyview-settings-wrapper" class="<?php if($storyview_activ){ ?>visible<?php } ?>">
        <div id="storyview-settings-wrapper__tabs">
            <div class="tab tab--active" data-tabcontent="button-settings">Button Settings</div>
            <div class="tab" data-tabcontent="story-blocks">Story Blocks</div>
            <div class="tab" data-tabcontent="amp-settings">AMP Story Settings</div>
            <div class="tab" data-tabcontent="end-screen-settings">End Screen Settings</div>
            <div class="tab" data-tabcontent="player-settings">Player Settings</div>
        </div>
        <div id="storyview-settings-wrapper__tab-contents">
            <div class="content content--active" id="content-button-settings">
                <?php
                // button settings
                include_once("admin_editor_button_settings.php");
                ?>
            </div><!-- end #content-button-settings -->

            <div class="content" id="content-story-blocks">
                <?php
                // story blocks settings
                include_once("admin_editor_storyview_blocks_settings.php");
                ?>
            </div><!-- end #content-story-blocks -->

            <div class="content" id="content-amp-settings">
                <?php
                // amp settings block
                include_once("admin_editor_amp_settings.php");
                ?>
            </div><!-- end #content-amp-settings -->

            <div class="content" id="content-end-screen-settings">
                <?php
                // end screen settings block
                include_once("admin_editor_end_screen_settings.php");
                ?>
            </div><!-- end #content-end-screen-settings -->

            <div class="content" id="content-player-settings">
                <?php
                // player settings block
                include_once("admin_editor_player_settings.php");
                ?>
            </div><!-- end #content-player-settings -->

        </div>
    </div>
</div><!-- end #ff_storyview_container -->

<?php
// classic story block template
include_once("story_block_classic_template.php");
include_once("story_block_custom_template.php");
?>

<input type="hidden" name="story_block_ids" id="story_block_ids" value="<?php echo $storyview_block_ids; ?>" />