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
                <p>Insert the following shortcode to your post to the place where you want to display the Story View button:</p>
                <input type="text" class="components-text-control__input" value="[<?php echo FF_STORYVIEW_SHORTCODE; ?>]" onfocus="this.select();" />

                <div class="ff_storyview_row">
                    <!-- Story View button settings -->
                    <div class="ff_storyview_col_md_6">
                        <h4>Story View Button Settings</h4>

                        <label class="ff_storyview_label" for="ff_storyview_button_text">Button Text</label>
                        <input class="components-text-control__input" type="text" id="ff_storyview_button_text" name="ff_storyview_button_text" value="<?php
                        echo $default_button_text;
                        ?>" />

                        <div id="ff_storyview_button_types">
                            <label class="ff_storyview_label">Button Type</label>
                            <small>The image of the button will be generated from the image of the first (classic) story block</small>
                            <div id="ff_storyview_button_types_content">
                                <h4>Your Custom Buttons</h4>
                                <div id="ff_storyview_button_types_custom">
                                    <?php
                                    // get custom storyview buttons from the database
                                    global $wpdb;
                                    $storyview_custom_buttons = $wpdb->get_results("SELECT * FROM " . FF_STORYVIEW_CUSTOM_BUTTONS_TABLE . " ORDER BY storyview_button_id DESC");

                                    if(count($storyview_custom_buttons)){
                                        foreach($storyview_custom_buttons as $storyview_custom_button){
                                            $button_data = json_decode($storyview_custom_button->storyview_button_settings);
                                            // create button css
                                            $custom_button_css = "";
                                            
                                            // background color or gradient
                                            if($button_data->button_background_type == "color"){
                                                $custom_button_css .= "background: " . $button_data->button_background_color . "; ";
                                            } else {
                                                $custom_button_css .= "background: " . $button_data->button_background_type . "(". $button_data->button_background_gradient_start . ", " . $button_data->button_background_gradient_end . "); ";
                                            }

                                            // font color
                                            $custom_button_css .= "color: " . $button_data->button_font_color . "; ";

                                            // font size
                                            $custom_button_css .= "font-size: " . $button_data->button_font_size . "; ";

                                            // text align
                                            $custom_button_css .= "text-align: " . $button_data->button_text_alignment . "; ";

                                            // border width
                                            $custom_button_css .= "border-width: " . $button_data->button_border_width . "; ";

                                            // border color
                                            $custom_button_css .= "border-color: " . $button_data->button_border_color . "; ";

                                            // padding
                                            $custom_button_css .= "padding: " . $button_data->button_padding . "; ";

                                            // custom css
                                            $custom_button_css .= preg_replace('/\s+/S', " ", $button_data->button_custom_css);
                                            ?>
                                            <div class="ff_storyview_button_types_button_block">
                                                <label class="ff_storyview_button_type_label">
                                                    <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="custom_<?php echo $storyview_custom_button->storyview_button_id; ?>" <?php if($default_button_type == "custom_" . $storyview_custom_button->storyview_button_id){ ?>checked="checked"<?php } ?> />
                                                    <i><?php echo stripslashes_deep($storyview_custom_button->storyview_button_name); ?></i>

                                                    <!-- button #1 -->
                                                    <button class="ff_storyview_button ff_storyview_button_type_custom_layout_<?php echo $button_data->button_layout; ?> <?php echo $button_data->button_font_family; ?>" style="<?php echo $custom_button_css; ?>">
                                                        <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                            echo $default_button_text;
                                                            ?></span>
                                                    </button>
                                                    <!-- end button #1 -->
                                                </label>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        // no custom buttons
                                        ?>
                                        <p>You don't have any custom buttons yet. You can create one <a href="admin.php?page=storyview_settings&tab=button_designer" target="_blank">here</a>.</p>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <h4>Default Buttons</h4>
                                <div id="ff_storyview_button_types_default">
                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1" <?php if($default_button_type == "1"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 1</i>

                                            <!-- button #1 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_1">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #1 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="1_i" <?php if($default_button_type == "1_i"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 1 Inverse</i>

                                            <!-- button #1_i -->
                                            <button class="ff_storyview_button ff_storyview_button_type_1_i">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #1_i -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2" <?php if($default_button_type == "2"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 2</i>

                                            <!-- button #2 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_2">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #2 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="2_i" <?php if($default_button_type == "2_i"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 2 Inverse</i>

                                            <!-- button #2_i -->
                                            <button class="ff_storyview_button ff_storyview_button_type_2_i">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #2_i -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3" <?php if($default_button_type == "3"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 3</i>

                                            <!-- button #3 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_3">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #3 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="3_i" <?php if($default_button_type == "3_i"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 3 Inverse</i>

                                            <!-- button #3_i -->
                                            <button class="ff_storyview_button ff_storyview_button_type_3_i">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #3_i -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4" <?php if($default_button_type == "4"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 4</i>

                                            <!-- button #4 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_4">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #4 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="4_i" <?php if($default_button_type == "4_i"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 4 Inverse</i>

                                            <!-- button #4_i -->
                                            <button class="ff_storyview_button ff_storyview_button_type_4_i">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #4_i -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5" <?php if($default_button_type == "5"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 5</i>

                                            <!-- button #5 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_5">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #5 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="5_i" <?php if($default_button_type == "5_i"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 5 Inverse</i>

                                            <!-- button #5_i -->
                                            <button class="ff_storyview_button ff_storyview_button_type_5_i">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                    echo $default_button_text;
                                                    ?></span>
                                            </button>
                                            <!-- end button #5_i -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" name="ff_storyview_button_type" class="ff_storyview_button_type" value="6" <?php if($default_button_type == "6"){ ?>checked="checked"<?php } ?> />
                                            <i>Type 6</i>

                                            <!-- button #6 -->
                                            <button class="ff_storyview_button ff_storyview_button_type_6">
                                                <i class="ff_storyview_button_icon"></i><span class="ff_storyview_button_text"><?php
                                                echo $default_button_text;
                                                ?></span>
                                            </button>
                                            <!-- end button #6 -->
                                        </label>
                                    </div>

                                    <div class="ff_storyview_button_types_button_block">
                                        <label class="ff_storyview_button_type_label">
                                            <input type="radio" id="ff_storyview_button_type_other" name="ff_storyview_button_type" class="ff_storyview_button_type" value="other" <?php if($default_button_type == "other"){ ?>checked="checked"<?php } ?> />
                                            <i>Other (own code)</i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="ff_storyview_button_types_other" <?php if($default_button_type == "other"){ ?>style="display: block;"<?php } ?>>
                            <label class="ff_storyview_label" for="ff_storyview_button_type_other_code">Custom Button for Story View Button (You can add custom HTML code)</label>
                            <input class="components-text-control__input" type="text" id="ff_storyview_button_type_other_code" name="ff_storyview_button_type_other_code" value="<?php echo $default_button_type_other_code; ?>" />
                            <br /><small>Don't use "a" or "button" tags in your code. Use the following shortcodes to display the button text, and the button image:
                                <pre>{{button_text}} {{button_image}}</pre>
                                Eg.: &lt;span class="my_custom_button"&gt;&lt;img src="{{button_image}}" /&gt; {{button_text}}&lt;/span&gt;
                            </small>
                        </div>
                    </div>
                    <!-- end Story View button settings -->
                </div>
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
                <!-- Story View controller settings -->
                <div class="ff_storyview_col_md_6">
                    <div class="ff_storyview_player_settings">
                        <div class="ff_storyview_player_settings_section">
                            <input type="checkbox" id="ff_storyview_display_controllers" name="ff_storyview_display_controllers" value="1" <?php
                            if(isset($storyview_data->display_controllers) && $storyview_data->display_controllers == 1){
                                ?>
                                checked="checked"
                                <?php
                            }
                            ?> />
                            <label for="ff_storyview_display_controllers">Enable Story View Controllers for all story blocks <br /><small>By default, "Previous" and "Next" buttons are only visible for Custom Story Blocks. If you enable this setting, they will be visible for Classic Blocks as well.<br />
                            To change the label of the buttons, go to the following page: <a href="/wp-admin/admin.php?page=storyview_settings&tab=general" target="_blank">Story View General Settings</a>
                            </small></label>
                        </div>
                        
                        <div class="ff_storyview_player_settings_section">
                            <input type="checkbox" id="ff_storyview_enable_share" name="ff_storyview_enable_share" value="1" <?php
                            if(isset($storyview_data->story_share_enabled) && $storyview_data->story_share_enabled == 1){
                                ?>
                                checked="checked"
                                <?php
                            }
                            ?> />
                            <label for="ff_storyview_enable_share">Enable social share for this Story View<br /><small>If you turn this feature on, a small share icon will be visible at the bottom right corner of your stories and your visitors can share the story version of your post.<br />The sharing settings (image, title, description) will be the same as your normal posts, so make sure that those are correct.</small></label>

                            <?php
                            if(esc_attr( get_option('ff_storyview_default_share_enabled') ) == 1 ) {
                                ?>
                                <p class="ff_storyview_info">
                                    <i>i</i> Share feature has been turned on already for all Story Views. To turn it off, go to the following page: <a href="/wp-admin/admin.php?page=storyview_settings&tab=share_settings" target="_blank">Share settings</a>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- end Story View controller settings -->
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