const FFWhatsnewSettings = {
	title: "What's new in Story View",
};

const FFWhatsnewItems = [
	{
		date: "2020.12.16.",
		title: "Better Elementor support",
		content: "With the latest update of the plugin, the Story View Widget works better with Elementor",
	},
	{
		date: "2020.11.04.",
		title: "Tested Story View with the latest version of WordPress",
		content: "The plugin was tested with the latest version of WordPress. No changes were necessary, every function works fine with WordPress 5.5.3",
	},
	{
		date: "2020.10.05.",
		title: "Add stories to your pages",
		content: "The new release of Story View makes it possible to add stories not just to your posts, but also to your pages. You can add stories to your pages the same way you do with your posts.",
		cta_url: "/create-your-first-story.htmlh-the-story-view-widget.html",
		cta_label: "Create your first story width Classic story blocks",
	},
	{
		date: "2020.08.30.",
		title: "Updated Story View Widget",
		content: "Previously, when someone clicked on a story in the story widget, they got redirected to the post where the story was added to. With the new Story View Widget, visitors will stay on the same page. This makes their experience similar to the one that is available on Instagram or Facebook.",
	},
	{
		date: "2020.04.12.",
		title: "Layout changes and improvements",
		content: "To make sure Story View works seamlessly with the latest version of WordPress, we've made some layout changes both in the front-end and admin sections of the plugin.",
	},
	{
		date: "2020.01.16.",
		title: "Security enhancements",
		content: "The security of your website is a top priority for us. That's why we've made some security enhancements in the latest release of Story View.",
	},
	{
		date: "2019.11.05.",
		title: "Display your latest stories with the Story View widget",
		content: "When it comes to stories, most platforms are displaying them at the top of the screen. You can do something similar with the help of the Story View Widget.",
		cta_url: "/display-your-latest-stories-with-the-story-view-widget.html",
		cta_label: "Learn how to use the Story View widget",
	},
	{
		date: "2019.09.15.",
		title: "Social share functions, recommendations on the end screen and button designer",
		content: "Enabling your visitors to share your content on social platforms is a key factor to drive more traffic to your website. If you'd like to keep your visitors on your website, the recommended article at the end of your story can help you do that.",
		cta_url: "/enable-social-share-functions-and-recommended-article-on-the-end-screen-of-your-story.html",
		cta_label: "👉 Learn more about the features",
	},
	{
		date: "2019.08.10.",
		title: "Support to use multiple story buttons on the same page",
		content: "Previously, it was possible to add the story button to your posts only one time. The latest update makes it possible to embed the story button to your posts as many times as you want. This can help to drive more traffic to your stories.",
	},
	{
		date: "2019.08.01.",
		title: "⏰ Save some time with Story View 1.4.0",
		content: "You can now set the default settings for your story blocks, you can define your default AMP Story settings. Story controllers now also available in the plugin.",
		cta_url: "/enable-story-controllers-for-easier-navigation.html",
		cta_label: "Enable story controllers for easier navigation",
	},
	{
		date: "2019.07.08.",
		title: "Use custom colors 🎨 in your stories",
		content: "Instead of using one from the built-in color options, you can now use colorpicker to set any kind of color for the background of your story blocks and for the text as well.",
	},
	{
		date: "2019.06.20.",
		title: "AMP Story support in Story View",
		content: "With the help of the built-in AMP Story support, you can boost the position of your website in Google search.",
		cta_url: "/create-an-amp-story-from-your-story-view-story.html",
		cta_label: "⚡️ How to create an AMP Story with Story View",
	},
	{
		date: "2019.06.12.",
		title: "Custom Story Blocks",
		content: "Display ads, embed videos, forms or run a giveaway in your stories with the help of Custom Story Blocks.",
		cta_url: "/add-a-contact-form-to-your-story-with-the-help-of-custom-story-blocks.html",
		cta_label: "How to add a contact form to your stories with Custom Story Blocks",
	},
	{
		date: "2019.05.30.",
		title: "Released Story View to bring the story format to your WordPress website",
		content: "This new format can drive new visitors to your site and can help you to re-engage old ones.",
		cta_url: "https://gum.co/storyview?wanted=true",
		cta_label: "👉 Get the plugin now",
	},
];

/**
 * Toggle What's New Panel
 */
const FFWhatsnewToggle = () => {
	const ffWhatsnewBody = document.querySelector("body");
	if (ffWhatsnewBody && ffWhatsnewBody.classList.contains("ff-whatsnew-visible")) {
		// hide
		ffWhatsnewBody.classList.remove("ff-whatsnew-visible");
	} else {
		// show
		ffWhatsnewBody.classList.add("ff-whatsnew-visible");
		const FFWhatsnewButton = document.querySelector(`a[href*="FFWhatsnewToggle"]`);
		if (FFWhatsnewButton) {
			FFWhatsnewButton.classList.remove("undread-notification");
		}
		localStorage.setItem("FFWhatsnewPreviousVisit", Date.now());
	}
};

/**
 * Close What's New Panel
 */
document.addEventListener("click", (event) => {
	if (event.target.closest("#ff-whatsnew-close")) {
		FFWhatsnewToggle();
	}
});

/**
 * Init What's New Panel
 */
const FFWhatsnewInit = () => {
	const FFWhatsnewRoot = document.getElementById("ff-whatsnew-root");

	if (!FFWhatsnewRoot) {
		return;
	}

	/**
	 * Build What's New Panel - Items
	 */
	const FFWhatsnewPanelItems = FFWhatsnewItems.map((item) => {
		let FFWhatsnewItemCardCTA = "";

		if (item.cta_url) {
			FFWhatsnewItemCardCTA = `<div class="ff-whatsnew-card__cta">
      <a href="${item.cta_url}" target="_blank" rel="noopener noreferrer">${item.cta_label}</a>
    </div>`;
		}

		const FFWhatsnewItemCard = `<div class="ff-whatsnew-card">
                                  <p class="ff-whatsnew-card__date">${item.date}</p>
                                  <p class="ff-whatsnew-card__title">${item.title}</p>
                                  <p class="ff-whatsnew-card__content">${item.content}</p>
                                  ${FFWhatsnewItemCardCTA}
                                </div>`;
		return FFWhatsnewItemCard;
	}).join("");

	/**
	 * Build What's New Panel - Full panel
	 */
	const FFWhatsnewPanel = `<div class="ff-whatsnew-background">
                            <div class="ff-whatsnew-content">
                              <div class="ff-whatsnew-header">
                                <p>${FFWhatsnewSettings.title}</p>
                                <button id="ff-whatsnew-close">&times;</button>
                              </div>
                              <div class="ff-whatsnew-body">${FFWhatsnewPanelItems}</div>
                              <div class="ff-whatsnew-footer">
                                <a href="http://bit.ly/whatsnewlanding" target="_blank" rel="noopener noreferrer">Powered by ✨ What's New</a>
                              </div>
                            </div>
                          </div>`;

	/**
	 * Add panel to What's New root
	 */
	FFWhatsnewRoot.innerHTML = FFWhatsnewPanel;

	/**
	 * Check if there is anything new since the last visit of the user
	 * Display indicator, if there is
	 */
	const FFWhatsnewButton = document.querySelector(`a[href*="FFWhatsnewToggle"]`);

	if (!FFWhatsnewButton) {
		return;
	}

	let FFWhatsnewPreviousVisit = localStorage.getItem("FFWhatsnewPreviousVisit");
	let FFWhatsnewNewVisit = false;

	if (!FFWhatsnewPreviousVisit) {
		FFWhatsnewNewVisit = true;
		FFWhatsnewPreviousVisit = Date.now();
	}

	let FFWhatsnewLatestItemDate = 0;

	if (FFWhatsnewItems[0] && FFWhatsnewItems[0].date) {
		FFWhatsnewLatestItemDate = Date.parse(FFWhatsnewItems[0].date);
	}

	if (FFWhatsnewNewVisit || FFWhatsnewPreviousVisit < FFWhatsnewLatestItemDate) {
		// show indicator
		FFWhatsnewButton.classList.add("undread-notification");
	}
};

FFWhatsnewInit();
