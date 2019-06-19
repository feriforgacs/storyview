<?php
/**
 * StoryView AMP Story template
 */
if(have_posts()){
    $storyview_data = get_post_meta($post->ID, FF_STORYVIEW_META_KEY, true);
    if(!empty($storyview_data)){
        /**
         * Check used font families
         */
        $font_families = "";
        if(stristr($storyview_data, "roboto") !== FALSE){
            $font_families .= '<link href="https://fonts.googleapis.com/css?family=Roboto:700&display=swap&subset=latin-ext" rel="stylesheet">';
        }

        if(stristr($storyview_data, "rounded") !== FALSE){
            $font_families .= '<link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c:400,700&display=swap&subset=latin-ext" rel="stylesheet">';
        }

        if(stristr($storyview_data, "lily") !== FALSE){
            $font_families .= '<link href="https://fonts.googleapis.com/css?family=Lily+Script+One&display=swap&subset=latin-ext" rel="stylesheet">';
        }

        if(stristr($storyview_data, "montserrat") !== FALSE){
            $font_families .= '<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=latin-ext" rel="stylesheet">';
        }

        $storyview_data = json_decode($storyview_data);

        /**
         * Check if story view is activated for this post
         */
        if(!$storyview_data->activ){
            status_header( 404 );
            nocache_headers();

            require get_404_template();
            return;
        }

        /**
         * Check if AMP Story is enabled
         */
        if(!isset($storyview_data->amp_settings) || $storyview_data->amp_settings->activ != 1){
            status_header( 404 );
            nocache_headers();

            require get_404_template();
            return;
        }
    } else {
        status_header( 404 );
        nocache_headers();

        require get_404_template();
        return;
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
}
    ?>
<!doctype html>
<html ⚡>
    <head>
        <meta charset="utf-8">
        <title><?php the_title(); ?></title>
        <link rel="canonical" href="pets.html">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>
        
        <?php echo $font_families; ?>
        
        <style amp-custom>
            amp-story {
                color: #fff;
            }
            amp-story-page {
                background-color: #000;
            }
            h1 {
                font-weight: bold;
                font-size: 2.875em;
                line-height: 200%;
                padding: 1rem;
                margin: 10px;
                border-radius: 3px;
            }
            h1 span{
                font-size: 14px;
            }
            p {
                font-weight: normal;
                font-size: 1.3em;
                line-height: 1.5em;
                color: #fff;
            }
            q {
                font-weight: 300;
                font-size: 1.1em;
            }
            amp-story-grid-layer.ff_storyview_text_block_bottom {
                align-content:end;
            }
            amp-story-grid-layer.ff_storyview_text_block_top {
                align-content:start;
            }
            amp-story-grid-layer.ff_storyview_text_block_middle {
                align-content:center;
            }
            amp-story-grid-layer.ff_storyview_text_align_left{
                text-align:left;
            }
            amp-story-grid-layer.ff_storyview_text_align_center{
                text-align:center;
            }
            amp-story-grid-layer.ff_storyview_text_align_right{
                text-align:right;
            }
            
            amp-story-grid-layer.noedge {
                padding: 0px;
            }
            amp-story-grid-layer.center-text {
                align-content: center;
            }
            .wrapper {
                display: grid;
                grid-template-columns: 50% 50%;
                grid-template-rows: 50% 50%;
            }
            .banner-text {
                text-align: center;
                background-color: #000;
                line-height: 2em;
            }
            .ff_storyview_text_align_right{
                text-align: right;
            }

            .ff_storyview_block_background_black{
                background: rgba(0, 0, 0, .8);
            }

            .ff_storyview_block_background_gray{
                background: rgba(51, 51, 51, .8)
            }

            .ff_storyview_block_background_red{
                background: rgba(201, 44, 44, .8)
            }

            .ff_storyview_block_background_white{
                background: rgba(255, 255, 255, .8)
            }

            .ff_storyview_block_background_transparent{
                background: none;
            }

            .ff_storyview_block_color_black{
                color: #000;
            }

            .ff_storyview_block_color_gray{
                color: #333;
            }

            .ff_storyview_block_color_red{
                color: #c92c2c;
            }

            .ff_storyview_block_color_white{
                color: #fff;
            }

            .block_item_text{
                line-height: 200%;
                padding: .5rem;
                border-radius: 3px;
            }
            .courier{
                font-family: "Courier New", Courier, "Lucida Sans Typewriter", "Lucida Typewriter", monospace; 
                font-weight: bold;
            }

            .roboto{
                font-family: 'Roboto', sans-serif;
                font-weight: bold;
            }

            .rounded{
                font-family: 'M PLUS Rounded 1c', sans-serif;
                font-weight: bold;
            }

            .lily{
                font-family: 'Lily Script One', cursive;
                font-weight: bold;
            }

            .montserrat{
                font-family: 'Montserrat', sans-serif;
                font-weight: bold;
            }

            .arial{
                font-family: Arial, Helvetica, sans-serif;
                font-weight: bold;
            }

            .f12{
                font-size: 12px;
            }

            .f14{
                font-size: 14px;
            }

            .f18{
                font-size: 18px;
            }

            .f24{
                font-size: 24px;
            }

            .f36{
                font-size: 36px;
            }
        </style>
    </head>
    <body>
        <amp-story standalone
            title="<?php echo $amp_cover_title; ?>"
            publisher="<?php echo $amp_cover_author_name; ?>"
            publisher-logo-src="<?php echo $amp_publisher_logo; ?>"
            poster-portrait-src="<?php echo $amp_cover_image; ?>">
        
            <!-- #cover -->
            <amp-story-page id="cover">
                <amp-story-grid-layer template="fill">
                    <?php
                    $cover_image_folder_temp = explode("wp-content", $amp_cover_image);
                    $cover_image_path = "./wp-content" . $cover_image_folder_temp[1];
                    list($cover_image_width, $cover_image_height) = getimagesize($cover_image_path);
                    ?>
                    <amp-img src="<?php echo get_the_post_thumbnail_url(); ?>"
                        width="<?php echo $cover_image_width ?>" height="<?php echo $cover_image_height ?>"
                        layout="responsive">
                    </amp-img>
                </amp-story-grid-layer>

                <amp-story-grid-layer template="vertical" class="<?php echo $amp_cover_text_position . " " . $amp_cover_text_align; ?>">
                    <h1 class="<?php echo $amp_cover_text_font_family . " " . $amp_cover_text_font_size . " " . $amp_cover_text_background_color . " " . $amp_cover_text_font_color; ?>">
                        <?php echo $amp_cover_title; ?>
                        <br /><span>
                            <?php echo $amp_cover_author_name; ?>
                        </span>
                    </h1>
                </amp-story-grid-layer>
            </amp-story-page>
            <!-- end #cover -->

            <?php
            // display story blocks data
            if(isset($storyview_data->story_blocks_data)){
                $i = 1;
                foreach($storyview_data->story_blocks_data as $storyview_block){
                    $block_type = isset($storyview_block->ff_storyview_block_type) ? $storyview_block->ff_storyview_block_type : "";
                    switch($block_type) {
                        case("code"):
                            break;
                        default:
                            // image data
                            $image_path_temp = urldecode($storyview_block->ff_storyview_block_image);
                            $image_folder_temp = explode("wp-content", $image_path_temp);
                            $image_path = "./wp-content" . $image_folder_temp[1];
                            list($width, $height) = getimagesize($image_path);
                            ?>
                            <amp-story-page id="page<?php echo $i; ?>">
                                <!-- image -->
                                <amp-story-grid-layer template="fill">
                                    <amp-img animate-in="fade-in" src="<?php echo $image_path_temp; ?>"
                                        width="<?php echo $width; ?>" height="<?php echo $height; ?>"
                                        layout="responsive">
                                    </amp-img>
                                </amp-story-grid-layer>

                                <!-- text -->
                                <amp-story-grid-layer template="vertical" class="<?php echo $storyview_block->ff_storyview_block_item_text_position . ' ' . $storyview_block->ff_storyview_block_item_text_align; ?>">
                                    <p animate-in="fade-in" animate-in-delay="0.2s" animate-in-duration="0.5s" class="block_item_text <?php echo $storyview_block->ff_storyview_block_item_text_font_family . ' ' . $storyview_block->ff_storyview_block_item_text_font_size . ' ' . $storyview_block->ff_storyview_block_item_text_background_color . ' ' . $storyview_block->ff_storyview_block_item_text_font_color; ?>"><?php echo $storyview_block->ff_storyview_block_item_text; ?></p>
                                </amp-story-grid-layer>
                            </amp-story-page>
                            <?php
                            $i++;
                            break;
                    }
                }
            }
            ?>
            <amp-story-bookend layout="nodisplay">
                <script type="application/json">
                {
                    "bookendVersion": "v1.0",
                    "shareProviders": [
                        "system",
                        "whatsapp",
                        "facebook",
                        "twitter",
                        "email",
                        "pinterest",
                        "sms"
                    ],
                    "components": [
                        {
                            "type": "heading",
                            "text": "Read the full article"
                        },
                        {
                            "type": "small",
                            "title": "<?php echo $amp_cover_title; ?>",
                            "url": "<?php echo the_permalink(); ?>",
                            "image": "<?php echo $amp_cover_image; ?>"
                        },
                        {
                            "type": "cta-link",
                            "links": [
                                {
                                    "text": "Read the full article",
                                    "url": "<?php echo the_permalink(); ?>"
                                }
                            ]
                        }
                    ]
                }
                </script>
            </amp-story-bookend>
            
        </amp-story>
    </body>
</html>
    <?php
}