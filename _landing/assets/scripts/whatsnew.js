const FFWhatsnewSettings = {
	title: "What's new in Story View",
};

const FFWhatsnewItems = [
	{
		date: "2020.11.05.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		cta_url: "#",
		cta_label: "👉 Learn more",
	},
	{
		date: "2020.11.02.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
	},
	{
		date: "2020.10.05.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		cta_url: "#",
		cta_label: "👉 Learn more",
	},
	{
		date: "2020.09.04.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		cta_url: "#",
		cta_label: "👉 Learn more",
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
                                <a href="https://usewhatsnew.com?ref=widget-footer" target="_blank" rel="noopener noreferrer">Powered by ✨ What's New</a>
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
