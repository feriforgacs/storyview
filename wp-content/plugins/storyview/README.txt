=== Plugin Name ===
Tags: story storyview
Requires at least: 4.6
Tested up to: 5.2
Stable tag: 4.3
Requires PHP: 5.2.4
License: see LICENSE.txt

Create story like versions for your posts for more engagement

== Description ==

With the help of Story View plugin you can create a story like version from your WordPress post to highlight the most important informations for the readers who can't read the full article.
You can use images, and some text to deliver your message. With the help of the plugin you can change the following settings of a story:
- background image
- text
- text background color
- text color
- text position (top, middle, bottom)
- text alignment (left, center, right)
- font family of the text
You can easily change the order of the story blocks by dragging and dropping them to the right position.
Viewers can navigate across the items by clicking, or tapping to the right or the left side of a story.

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. After you activated the plugin, go to a post where you want to add a story view version.
4. Below the main editor section click on the "Enable Story View for this post" checkbox and start to edit the additional settings.
5. When you are ready, insert the [ff_storyview] shortcode to your post, where you want to display the selected button, then click update.

If you visit your post, you'll see the new version where Story View is available as well.

== Frequently Asked Questions ==

= I can't see the Story View button in my post, what's the problem? =

Make sure that you added the [ff_storyview] shortoce to your post and you saved the modifications.
If you see the [ff_storyview] instead of the normal button that means that the plugin doesn't work as it should. Try to reinstall it.

= I accidentally disabled / deleted the plugin. Does it mean that all my Story Views have been removed as well? =

No, the informations of your stories are stored in the postmeta datatable and disabling or removing the plugin doesn't affect them.

= My stories look different on the frontend than in the admin. Why? =

It is possible that there are some CSS rules in your theme that overwrite the ones that are defined for Story Views. Probably, you'll need the help of a developer to fix these problems.

== Changelog ==

= 1.5.1 = 
* AMP Story CSS updates
* Tested with latest WordPress version

= 1.5.0 =
* Social Share Functions
* Recommendations screen at the end of stories
* Button designer - Create your own buttons to embed your stories into your posts
* Admin UI enhancements

= 1.4.2 =
* Story View button image issue fix

= 1.4.1 =
* Multiple Story View button support

= 1.4.0 =
* Display / Hide story controllers - previous, next buttons
* Default AMP Story settings
* AMP Story Analytics tracking
* Default story block settings

= 1.3.1 =
* Frontend issue fix

= 1.3.0 =
* Custom color picker support

= 1.2.1 =
* AMP Story editor layout changes

= 1.2.0 =
* AMP Story support

= 1.1.3 =
* Custom block saving issue fixes
* Single quote error fixes

= 1.1.2 =
* Admin editor CSS fixes

= 1.1.1 =
* Background color support for custom story blocks

= 1.1.0 =
* Custom Story Block support

= 1.0.2 =
* Swipe gestures

= 1.0.1 =
* Mobile layout fixes

= 1.0 =
* Initial release