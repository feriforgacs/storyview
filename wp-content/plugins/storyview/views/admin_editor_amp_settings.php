<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo "No direct access";
	exit;
}

if(isset($storyview_data->amp_settings)){
	$amp_activ =                        $storyview_data->amp_settings->activ;
	$amp_cover_image =                  urldecode($storyview_data->amp_settings->cover_image);
	$amp_publisher_logo =               urldecode($storyview_data->amp_settings->publisher_logo);
	$amp_cover_title =                  $storyview_data->amp_settings->cover_title;
	$amp_cover_author_name =            $storyview_data->amp_settings->cover_author_name;
	$amp_cover_text_position =          $storyview_data->amp_settings->cover_text_position;
	$amp_cover_text_align =             $storyview_data->amp_settings->cover_text_align;
	$amp_cover_text_font_family =       $storyview_data->amp_settings->cover_text_font_family;
	$amp_cover_text_font_size =         $storyview_data->amp_settings->cover_text_font_size;
	$amp_cover_text_background_color =  $storyview_data->amp_settings->cover_text_background_color;
	$amp_cover_text_font_color =        $storyview_data->amp_settings->cover_text_font_color;
} else {
	$amp_cover_text_position = "ff_storyview_text_block_top";
	$amp_cover_text_align = "ff_storyview_text_align_left";
	$amp_cover_text_font_family = "arial";
	$amp_cover_text_font_size = "f18";
	$amp_cover_text_background_color = "rgba(0, 0, 0, .8)";
	$amp_cover_text_font_color = "rgb(255, 255, 255)";
}

/**
 * Set default value for AMP cover background color
 */
$ff_storyview_amp_cover_background = "rgba(0, 0, 0, .8)";
if(isset($amp_cover_text_background_color)){
	switch($amp_cover_text_background_color){
		case "ff_storyview_block_background_black":
			$ff_storyview_amp_cover_background = "rgba(0, 0, 0, .8)";
			break;

		case "ff_storyview_block_background_gray":
			$ff_storyview_amp_cover_background = "rgba(51, 51, 51, .8)";
			break;

		case "ff_storyview_block_background_red":
			$ff_storyview_amp_cover_background = "rgba(201, 44, 44, .8)";
			break;

		case "ff_storyview_block_background_white":
			$ff_storyview_amp_cover_background = "rgba(255, 255, 255, .8)";
			break;

		case "ff_storyview_block_background_transparent":
			$ff_storyview_amp_cover_background = "rgba(255, 255, 255, 0)";
			break;

		default:
			if(strlen($amp_cover_text_background_color) > 1){
				$ff_storyview_amp_cover_background = $amp_cover_text_background_color;
			}
			break;
	}
}

/**
 * Set default value for AMP cover font color
 */
$ff_storyview_amp_cover_font_color = "rgb(255, 255, 255)";
if(isset($amp_cover_text_font_color)){
	switch($amp_cover_text_font_color){
		case "ff_storyview_block_color_black":
			$ff_storyview_amp_cover_font_color = "rgb(0, 0, 0)";
			break;

		case "ff_storyview_block_color_gray":
			$ff_storyview_amp_cover_font_color = "rgb(51, 51, 51)";
			break;

		case "ff_storyview_block_color_red":
			$ff_storyview_amp_cover_font_color = "rgb(201, 44, 44)";
			break;

		case "ff_storyview_block_color_white":
			$ff_storyview_amp_cover_font_color = "rgb(255, 255, 255)";
			break;

		default:
			if(strlen($amp_cover_text_font_color) > 1){
					$ff_storyview_amp_cover_font_color = $amp_cover_text_font_color;
			}
			break;
	}
}

/**
 * Check default AMP Story settings
 */
$amp_publisher_logo_default = false;
if(!isset($amp_publisher_logo) || strlen($amp_publisher_logo) < 1){
    if(esc_attr(get_option('ff_storyview_amp_publisher_logo'))){
        $amp_publisher_logo_default = true;
        $amp_publisher_logo = esc_attr(get_option('ff_storyview_amp_publisher_logo'));
    }
}

$amp_cover_author_name_default = false;
if(!isset($amp_cover_author_name) || strlen($amp_cover_author_name) < 1){
    if(esc_attr(get_option('ff_storyview_amp_author_name'))){
        $amp_cover_author_name_default = true;
        $amp_cover_author_name = esc_attr(get_option('ff_storyview_amp_author_name'));
    }
}
?>

<script>
const ampCoverAuthorName = '<?php echo $amp_cover_author_name; ?>';
</script>

<div id="ff_storyview_amp_story_settings" class="ff_storyview_block" <?php if($storyview_activ){ ?> style="display: block;" <?php } ?>>
    <input id="ff_storyview_amp_activ" name="ff_storyview_amp_activ" class="components-checkbox-control__input" type="checkbox" value="1" <?php
    if(isset($amp_activ) && $amp_activ == 1){
        ?>checked="checked"<?php
    }
    ?> />
    <label for="ff_storyview_amp_activ">Generate AMP Story for this Story View <small>| Learn more about AMP Stories <a href="https://amp.dev/about/stories" target="_blank">here</a></small></label>

    <div id="ff_storyview_amp_cover_settings_container" class="ff_storyview_amp_cover ff_storyview_amp_cover_classic" <?php if(isset($amp_activ) && $amp_activ == 1) { ?> style="display: flex;" <?php } ?>>
        <div class="ff_storyview_amp_cover_move"></div>
        <div class="ff_storyview_amp_cover_preview">
            <p <?php
            // check preview data, hide temp text if any available
            if((isset($amp_cover_image) && strlen($amp_cover_image) != 0) || (isset($amp_cover_title) && strlen($amp_cover_title) != 0) || (isset($amp_cover_author_name) && strlen($amp_cover_author_name) != 0)){
                ?> style="display: none;" <?php
                }
            ?> class="preview_text">preview</p>

            <div class="ff_storyview_amp_cover_content <?php
            if(isset($amp_cover_text_position) && strlen($amp_cover_text_position) != 0){
                echo " " . $amp_cover_text_position;
            } else {
                echo " ff_storyview_text_block_top";
            }

            if(isset($amp_cover_text_align) && strlen($amp_cover_text_align) != 0){
                echo " " . $amp_cover_text_align;
            } else {
                echo " ff_storyview_text_align_left";
            }
            ?>" style="<?php
            // check preview data, display if available
            if((isset($amp_cover_image) && strlen($amp_cover_image) != 0) || (isset($amp_cover_title) && strlen($amp_cover_title) != 0) || (isset($amp_cover_author_name) && strlen($amp_cover_author_name) != 0)){
                ?>display: flex;<?php
            }

            if(isset($amp_cover_image) && strlen($amp_cover_image) != 0){
                ?>
                background-image: url('<?php echo $amp_cover_image; ?>');
                <?php
            }
            ?>">
                <div class="block_item_text <?php
                if(isset($amp_cover_text_font_family) && strlen($amp_cover_text_font_family) != 0){
                    echo " " . $amp_cover_text_font_family;
                } else {
                    echo " arial";
                }

                if(isset($amp_cover_text_font_size) && strlen($amp_cover_text_font_size) != 0){
                    echo " " . $amp_cover_text_font_size;
                } else {
                    echo " f18";
                }
                ?>" style="<?php
                    // display selected background color
                    echo "background-color: " . $ff_storyview_amp_cover_background . ";";

                    // display selected font color
                    echo "color: " . $ff_storyview_amp_cover_font_color . ";";

                ?>" id="amp_cover_text_content">
                    <?php if(isset($amp_cover_title) && strlen($amp_cover_title) != 0){
                        echo $amp_cover_title;
                    } else {
                        the_title();
                    } ?><br />
                    <span class="amp_author"><?php if(isset($amp_cover_author_name) && strlen($amp_cover_author_name) != 0){
                        echo $amp_cover_author_name;
                    } else {
                        echo get_the_author_meta('display_name', $post->post_author);
                    }
                    ?></span>
                </div>
            </div>
        </div>

        <div class="ff_storyview_amp_cover_settings">
            <p class="block_type_label amp">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"><g fill="none" fill-rule="evenodd"><path fill="#005AF0" d="M0 15c0 8.284 6.716 15 15 15 8.285 0 15-6.716 15-15 0-8.284-6.715-15-15-15C6.716 0 0 6.716 0 15z"></path><path fill="#FFFFFF" fill-rule="nonzero" d="M13.85 24.098h-1.14l1.128-6.823-3.49.005h-.05a.57.57 0 0 1-.568-.569c0-.135.125-.363.125-.363l6.272-10.46 1.16.005-1.156 6.834 3.508-.004h.056c.314 0 .569.254.569.568 0 .128-.05.24-.121.335L13.85 24.098zM15 0C6.716 0 0 6.716 0 15c0 8.284 6.716 15 15 15 8.285 0 15-6.716 15-15 0-8.284-6.715-15-15-15z"></path></g></svg>
                AMP Story Cover
            </p>
            <div class="ff_storyview_amp_cover_settings_block">
                <div class="ff_storyview_amp_cover_image_upload">
                    <input type="button" class="ff_storyview_amp_cover_upload button" value="Select AMP Story Cover Image" /><span class="ff_storyview_required">required</span>
                    <input type="hidden" name="ff_storyview_amp_cover_image" id="ff_storyview_amp_cover_image" value="<?php if(isset($amp_cover_image) && strlen($amp_cover_image) != 0){
                        echo $amp_cover_image;
                    } ?>" />
                    <br /><small>Ideal size 1080x1920px. For better performance, try to <a href="https://tinypng.com/" target="_blank">optimize</a> the size of the image.</small>
                </div>
            </div>

            <div class="ff_storyview_amp_cover_settings_block">
                <div class="ff_storyview_amp_publisher_logo ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <div id="ff_storyview_amp_publisher_logo_preview">
                            <?php
                            if(isset($amp_publisher_logo) && strlen($amp_publisher_logo) != 0){
                                ?>
                                <img src="<?php echo $amp_publisher_logo; ?>" />
                                <?php
                            } else {
                                ?>
                                <p class="ff_storyview_amp_preview_text">Logo Preview</p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <input type="button" id="ff_storyview_amp_publisher_logo_upload" class="button ff_storyview_amp_publisher_logo_upload" value="Select AMP Story Publisher Logo" /><span class="ff_storyview_required">required</span><br />
                        <small>The file should be a raster file, such as .jpg, .png, or .gif<br />
                            The logo shape should be a square, not a rectangle.<br />
                            The background color should not be transparent.<br />
                            Use one logo per brand that is consistent across AMP stories.<br />
                            The logo should be at least 96x96 pixels.</small>
                        <input type="hidden" name="ff_storyview_amp_publisher_logo_image" id="ff_storyview_amp_publisher_logo_image" value="<?php if(isset($amp_publisher_logo) && strlen($amp_publisher_logo) != 0){
                            echo $amp_publisher_logo;
                        } ?>" />

                        <?php
                        /**
                         * Don't save default settings to the db
                         */
                        if($amp_publisher_logo_default){
                            ?>
                            <input type="hidden" name="ff_storyview_amp_publisher_logo_default" id="ff_storyview_amp_publisher_logo_default" value="1" />
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="ff_storyview_amp_publisher_logo_default" id="ff_storyview_amp_publisher_logo_default" value="0" />
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="ff_storyview_amp_cover_settings_block">
                <h3>Text Settings</h3>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_title">AMP Story Title <span class="ff_storyview_required">required</span></label>
                        <textarea name="ff_storyview_amp_cover_text_title" id="ff_storyview_amp_cover_text_title" class="components-textarea-control__input ff_storyview_amp_cover_text_textarea" cols="30" rows="3"><?php
                        if(isset($amp_cover_title) && strlen($amp_cover_title) != 0){
                            echo $amp_cover_title;
                        } else {
                            the_title();
                        }
                        ?></textarea><br />
                        <small>Try to keep it under 160 characters</small>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_author">AMP Story Author Name <span class="ff_storyview_required">required</span></label>
                        <input type="text" name="ff_storyview_amp_cover_text_author" id="ff_storyview_amp_cover_text_author" class="components-textarea-control__input ff_storyview_amp_cover_text_textarea" value="<?php
                        if(isset($amp_cover_author_name) && strlen($amp_cover_author_name) != 0){
                            echo $amp_cover_author_name;
                        } else {
                            echo get_the_author_meta('display_name', $post->post_author);
                        }
                        ?>" /><br />
                        <small>Try to keep it under 60 characters</small>

                        <?php
                        /**
                         * Don't save default settings to the db
                         */
                        if($amp_cover_author_name_default){
                            ?>
                            <input type="hidden" name="ff_storyview_amp_cover_author_name_default" id="ff_storyview_amp_cover_author_name_default" value="1" />
                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="ff_storyview_amp_cover_author_name_default" id="ff_storyview_amp_cover_author_name_default" value="0" />
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Position</label>
                        <div class="ff_storyview_button_group">
                            <label class="ff_storyview_amp_cover_text_position_label <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_top"){ ?>activ<?php } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_top" <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_top"){ ?>checked="checked"<?php } ?> />
                                <span>Top</span>
                                <i title="top"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="4" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_position_label <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_middle"){ ?>activ<?php } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_middle" <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_middle"){ ?>checked="checked"<?php } ?> />
                                <span>Middle</span>
                                <i title="middle"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="9" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_position_label <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_bottom"){ ?>activ<?php } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_position" value="ff_storyview_text_block_bottom" <?php if(isset($amp_cover_text_position) && $amp_cover_text_position == "ff_storyview_text_block_bottom"){ ?>checked="checked"<?php } ?> />
                                <span>Bottom</span>
                                <i title="bottom"><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="5.5" y="2.5" width="9" height="15" stroke="#444B54"/>
                                <rect x="7" y="13" width="6" height="3" fill="#444B54"/>
                                </svg>
                                </i>
                            </label>
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Alignment</label>
                        <div class="ff_storyview_button_group">
                            <label class="ff_storyview_amp_cover_text_align_label <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_left"){
                                    ?>
                                    activ
                                    <?php
                                } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_left" <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_left"){
                                    ?>
                                    checked="checked"
                                    <?php
                                } ?> />
                                <span>Left</span>
                                <i title="left"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignleft" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M12 5V3H3v2h9zm5 4V7H3v2h14zm-5 4v-2H3v2h9zm5 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_align_label <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_center"){
                                    ?>
                                    activ
                                    <?php
                                } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_center" <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_center"){
                                    ?>
                                    checked="checked"
                                    <?php
                                } ?> />
                                <span>Center</span>
                                <i title="center"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-aligncenter" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M14 5V3H6v2h8zm3 4V7H3v2h14zm-3 4v-2H6v2h8zm3 4v-2H3v2h14z"></path></svg></i>
                            </label>

                            <label class="ff_storyview_amp_cover_text_align_label <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_right"){
                                    ?>
                                    activ
                                    <?php
                                } ?>">
                                <input type="radio" name="ff_storyview_amp_cover_text_align" value="ff_storyview_text_align_right" <?php if(isset($amp_cover_text_align) && $amp_cover_text_align == "ff_storyview_text_align_right"){
                                    ?>
                                    checked="checked"
                                    <?php
                                } ?> />
                                <span>Right</span>
                                <i title="right"><svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-editor-alignright" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M17 5V3H8v2h9zm0 4V7H3v2h14zm0 4v-2H8v2h9zm0 4v-2H3v2h14z"></path></svg></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_font_family">Font Family</label>
                        <select data-blockid="ampcover" name="ff_storyview_amp_cover_text_font_family" class="custom-select font-family-select" id="ff_storyview_amp_cover_text_font_family">
                            <option value="arial" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "arial"){ ?> selected="selected" <?php } ?>>Arial</option>
                            <option value="courier" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "courier"){ ?> selected="selected" <?php } ?>>Courier</option>
                            <option value="roboto" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "roboto"){ ?> selected="selected" <?php } ?>>Roboto</option>
                            <option value="rounded" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "rounded"){ ?> selected="selected" <?php } ?>>Rounded</option>
                            <option value="lily" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "lily"){ ?> selected="selected" <?php } ?>>Lily</option>
                            <option value="montserrat" <?php if(isset($amp_cover_text_font_family) && $amp_cover_text_font_family == "montserrat"){ ?> selected="selected" <?php } ?>>Montserrat</option>
                        </select>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label" for="ff_storyview_amp_cover_text_font_size">Font Size</label>
                        <select data-blockid="ampcover" name="ff_storyview_amp_cover_text_font_size" class="custom-select font-size-select" id="ff_storyview_amp_cover_text_font_size">
                            <option value="f18" <?php if(isset($amp_cover_text_font_size) && $amp_cover_text_font_size == "f18"){ ?> selected="selected" <?php } ?>>18px</option>
                            <option value="f24" <?php if(isset($amp_cover_text_font_size) && $amp_cover_text_font_size == "f24"){ ?> selected="selected" <?php } ?>>24px</option>
                            <option value="f36" <?php if(isset($amp_cover_text_font_size) && $amp_cover_text_font_size == "f36"){ ?> selected="selected" <?php } ?>>36px</option>
                        </select>
                    </div>
                </div>

                <div class="ff_storyview_row">
                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Text Block Background</label>
                        <div class="ff_storyview_background_color_colorpicker">
                            <input type="text" name="ff_storyview_amp_cover_text_background_color" value="<?php echo $ff_storyview_amp_cover_background; ?>" id="ff_storyview_amp_cover_text_background_color" />
                        </div>
                    </div>

                    <div class="ff_storyview_col_md_6">
                        <label class="ff_storyview_label">Font Color</label>

                        <div class="ff_storyview_text_font_color_colorpicker">
                            <input type="text" name="ff_storyview_amp_cover_text_font_color" value="<?php echo $ff_storyview_amp_cover_font_color; ?>" id="ff_storyview_amp_cover_text_font_color" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="ff_storyview_amp_cover_settings_block">
                <p class="ff_storyview_info">
                    <i>i</i> Save your changes to preview the latest version of your AMP Story
                </p>
                <?php
                $post_url = parse_url(get_permalink());
                if(array_key_exists("query", $post_url) && $post_url["query"] != ""){
                    // param already exists in the url
                    $story_url = get_permalink() . "&storyview_amp=1";
                } else {
                    $story_url = get_permalink() . "?storyview_amp=1";
                }
                ?>
                <p><strong>AMP Story Preview URL:</strong> <a href="<?php echo $story_url; ?>" target="_blank"><?php echo $story_url; ?> <svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-external components-external-link__icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path d="M9 3h8v8l-2-1V6.92l-5.6 5.59-1.41-1.41L14.08 5H10zm3 12v-3l2-2v7H3V6h8L9 8H5v7h7z"></path></svg></a></p>
            </div>

        </div>
    </div><!-- end .ff_storyview_amp_cover -->
</div>