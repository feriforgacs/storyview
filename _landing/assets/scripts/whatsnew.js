const FFWhatsnewSettings = {
	title: "What's new in Story View",
};

const FFWhatsnewItems = [
	{
		date: "2020.11.05.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		url: "#",
		url_label: "👉 Learn more",
	},
	{
		date: "2020.11.02.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		url: "#",
		url_label: "👉 Learn more",
	},
	{
		date: "2020.10.05.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		url: "#",
		url_label: "👉 Learn more",
	},
	{
		date: "2020.09.04.",
		title: "Story View has been tested with the latest version of WordPress (5.5.3)",
		content: "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Reiciendis laboriosam voluptatum numquam impedit sit veniam dolorem sint vero vel deleniti.",
		url: "#",
		url_label: "👉 Learn more",
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
	}
};

const FFWhatsnewCloseButton = document.getElementById("ff-whatsnew-close");
if (FFWhatsnewCloseButton) {
	FFWhatsnewCloseButton.addEventListener("click", () => FFWhatsnewToggle());
}
