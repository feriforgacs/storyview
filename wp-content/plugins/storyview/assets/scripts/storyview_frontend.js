/*
Story View WordPress plugin 1.0
by Ferenc Forgacs - @feriforgacs
2019.05.
*/

const ffStoryviewGap = 40;
const ffStoryviewCodeBlockBottomGap = 60;
const ffStoryviewEndScreenBottomGap = 60;
const ffStoryviewControllerBlockBottomGap = 60;
let ffStoryviewCurrentStory = 0;

/**
 * Toggle storyview
 */
const ffStoryviewBody = document.querySelector("body");
const ffStoryviewDisplayButton = document.querySelectorAll(".ff_storyview_button");
const ffStoryviewCloseButton = document.querySelectorAll(".ff_storyview_close_button");

if (ffStoryviewDisplayButton) {
	ffStoryviewDisplayButton.forEach(storyViewButton => {
		storyViewButton.addEventListener("click", toggleStoryview);
	});

	ffStoryviewCloseButton.forEach(storyViewCloseButton => {
		storyViewCloseButton.addEventListener("click", toggleStoryview);
	});

	function toggleStoryview(e) {
		e.preventDefault();
		if (e.target.classList.contains("ff_storyview_close_button")) {
			// hide story view
			document.querySelectorAll(".ff_storyview_blocks_container").forEach(storyviewBlockContainer => {
				storyviewBlockContainer.classList.remove('visible');
			});
			ffStoryviewBody.classList.remove("ff_storyview_visible");
			history.pushState("storyview", document.title, window.location.href.split('#')[0]);
		} else {
			// display story view
			ffStoryviewBody.classList.add("ff_storyview_visible");
			let currentStoryviewBlock;
			if(this.nextSibling && this.nextSibling.classList.contains("ff_storyview_blocks_container")){
				currentStoryviewBlock = this.nextSibling;
			} else {
				currentStoryviewBlock = findClosestStoryviewBlock(this);
			}

			currentStoryviewBlock.classList.add("visible");

			ffStoryviewCurrentStory = currentStoryviewBlock.querySelector(".ff_storyview_block_indicator_item.activ").dataset.index;
			
			history.pushState("storyview", document.title + " Storyview", "#storyview");
		}

		setSizes();
	}

	function findClosestStoryviewBlock(elem){
		// Get the closest matching element
		for (; elem && elem !== document; elem = elem.parentNode) {
			if (elem.classList.contains("ff_storyview_blocks_container")) {
				return elem;
			} else if(elem.nextSibling && elem.nextSibling.classList.contains("ff_storyview_blocks_container")){
				return elem.nextSibling;
			} else if(elem.nextSibling && elem.nextSibling.hasChildNodes()){
				elem.childNodes.forEach(child => {
					if(child.classList.contains("ff_storyview_blocks_container")){
						return child;
					}
				});
			}
		}
		return null;
	}

	/**
	 * Storyview step forward, backward
	 */
	const ffStoryviewBlocks = document.querySelectorAll(".ff_storyview_blocks");
	ffStoryviewBlocks.forEach(storyviewBlock => {
		storyviewBlock.addEventListener("click", stepStoryview);
	});

	let ffStoryviewBlockWidth = (window.innerWidth < 420) ? window.innerWidth : 420;
	let ffStoryviewBlockHeight = (window.innerHeight < 746) ? window.innerHeight : 746;

	function setSizes() {
		const ffStoryviewBlocks = document.querySelectorAll(".ff_storyview_blocks");

		ffStoryviewBlocks.forEach(storyviewBlock => {
			let ffStoryviewBlocksContainer = storyviewBlock.querySelectorAll(".ff_storyview_blocks_items_container");
			let ffStoryviewBlockItems = storyviewBlock.querySelectorAll(".ff_storyview_block_item_content");
			let ffStoryviewBlockCodeItems = storyviewBlock.querySelectorAll(".ff_storyview_block_item_content_code");
			let ffStoryviewBlockEndScreen = storyviewBlock.querySelectorAll(".ff_storyview_block_item_content_end_screen");

			let ffStoryviewBlockItemsCount = ffStoryviewBlockItems.length + ffStoryviewBlockCodeItems.length + ffStoryviewBlockEndScreen.length;

			ffStoryviewBlockWidth = (window.innerWidth < 420) ? window.innerWidth : 420;
			ffStoryviewBlockHeight = (window.innerHeight < 746) ? window.innerHeight : 746;

			let width = ffStoryviewBlockWidth * ffStoryviewBlockItemsCount;
			ffStoryviewBlocksContainer.forEach(storyviewBlockContainer => {
				storyviewBlockContainer.style.width = width + 'px';
			});

			// set sizes for default blocks
			ffStoryviewBlockItems.forEach((ffStoryviewBlockItem) => {
				ffStoryviewBlockItem.style.width = ffStoryviewBlockWidth + "px";

				let blockHeight = ffStoryviewBlockHeight - ffStoryviewGap;
				if (ffStoryviewBlockItem.classList.contains("controllers_visible")) {
					blockHeight -= ffStoryviewControllerBlockBottomGap;
				}
				ffStoryviewBlockItem.style.height = blockHeight + "px";
			});

			// set sizes for code blocks
			ffStoryviewBlockCodeItems.forEach((ffStoryviewBlockItem) => {
				ffStoryviewBlockItem.style.width = ffStoryviewBlockWidth + "px";

				let blockHeight = ffStoryviewBlockHeight - ffStoryviewGap;
				ffStoryviewBlockItem.style.height = blockHeight + "px";

				let codeBlock = ffStoryviewBlockItem.querySelector(".ff_storyview_block_item_code");
				let codeBlockHeight = blockHeight - ffStoryviewCodeBlockBottomGap;
				codeBlock.style.height = codeBlockHeight + "px";
			});

			// set sizes for end screen
			ffStoryviewBlockEndScreen.forEach((ffStoryviewBlockItem) => {
				ffStoryviewBlockItem.style.width = ffStoryviewBlockWidth + "px";

				let blockHeight = ffStoryviewBlockHeight - ffStoryviewGap;
				ffStoryviewBlockItem.style.height = blockHeight + "px";

				let endScreen = ffStoryviewBlockItem.querySelector(".ff_storyview_block_item_end_screen");
				let endScreenHeight = blockHeight - ffStoryviewEndScreenBottomGap;
				endScreen.style.height = endScreenHeight + "px";
			});
		});
	}

	setSizes();

	/**
	 * Display previous or next story item
	 * @param {object} event event object
	 * @param {string} direction step direction
	 */
	function stepStoryview(event = null, direction = null) {
		if (event && event.target.closest(".ff_storyview_block_item_content_code") && !direction) {
			// code slide, don't go to next or previous slide on click
			return;
		}

		// close button
		if (event && event.target.classList.contains("ff_storyview_close_button")) {
			return;
		}

		// share button
		if (event && event.target.classList.contains("storyview_share_section_item")) {
			return;
		}

		// end screen
		if(event && event.target.classList.contains("end_screen")){
			return;
		}

		const currentStoryviewBlock = document.querySelector(".ff_storyview_blocks_container.visible");
		const currentStoryviewBlockContainer = currentStoryviewBlock.querySelector(".ff_storyview_blocks_items_container");
		const currentStoryviewBlockItemsCount = currentStoryviewBlockContainer.querySelectorAll(".item").length;

		let ffStoryviewBlocksPosition = currentStoryviewBlock.getBoundingClientRect();
		let ffStoryviewBlocksLeftMax = ffStoryviewBlocksPosition.left + (ffStoryviewBlocksPosition.width / 2);

		if ((event && event.clientX > ffStoryviewBlocksLeftMax) || direction == "next") {
			// go to next block
			if (ffStoryviewCurrentStory < currentStoryviewBlockItemsCount - 1) {
				let left = (ffStoryviewCurrentStory + 1) * ffStoryviewBlockWidth;
				currentStoryviewBlockContainer.style.transform = 'translateX(-' + left + 'px)';
				ffStoryviewCurrentStory++;
			}
			// update indicator
			updateIndicator("next", currentStoryviewBlock);
		} else {
			// go to previous block
			if (ffStoryviewCurrentStory > 0) {
				let left = ffStoryviewCurrentStory * ffStoryviewBlockWidth - ffStoryviewBlockWidth;
				currentStoryviewBlockContainer.style.transform = 'translateX(-' + left + 'px)';
				ffStoryviewCurrentStory--;
			}
			// update indicator
			updateIndicator("previous", currentStoryviewBlock);
		}
	}

	/**
	 * Handle step to previous or next slide on clode block
	 */
	const codeBlockPreviousButtons = document.querySelectorAll(".code_block_previous");
	const codeBlockNextButtons = document.querySelectorAll(".code_block_next");

	codeBlockPreviousButtons.forEach(codeBlockPreviousButton => {
		codeBlockPreviousButton.addEventListener("click", (event) => {
			stepStoryview(event, "previous");
		});
	});

	codeBlockNextButtons.forEach(codeBlockNextButton => {
		codeBlockNextButton.addEventListener("click", (event) => {
			stepStoryview(event, "next");
		})
	});

	/**
	 * Update the status of the indicator
	 */
	function updateIndicator(direction, storyviewBlock) {
		if (direction == "next") {
			let previousStoryIndicator = ffStoryviewCurrentStory - 1;
			if(storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + previousStoryIndicator)){
				storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + previousStoryIndicator).classList.remove("activ");
				storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + ffStoryviewCurrentStory).classList.add("activ");
			}
		} else if (direction == "previous") {
			let nextStoryIndicator = ffStoryviewCurrentStory + 1;
			if(storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + nextStoryIndicator)){
				storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + nextStoryIndicator).classList.remove("activ");
				storyviewBlock.querySelector(".ff_storyview_block_indicator_item_" + ffStoryviewCurrentStory).classList.add("activ");
			}
		}
	}

	window.addEventListener("resize", setSizes);

	window.addEventListener("keydown", e => {
		if (e.code === "Escape" || e.code === "escape") {
			if (ffStoryviewBody.classList.contains("ff_storyview_visible")) {
				ffStoryviewBody.classList.remove("ff_storyview_visible");
				document.querySelectorAll(".ff_storyview_blocks_container").forEach(storyviewBlockContainer => {
					storyviewBlockContainer.classList.remove('visible');
				});
				history.pushState("storyview", document.title, window.location.href.split('#')[0]);
			}
		} else if (e.code === "ArrowLeft" || e.code === "arowleft") {
			if (ffStoryviewBody.classList.contains("ff_storyview_visible")) {
				// goto previous story
				stepStoryview(null, "previous");
			}
		} else if (e.code === "ArrowRight" || e.code === "arowright") {
			if (ffStoryviewBody.classList.contains("ff_storyview_visible")) {
				// goto next story
				stepStoryview(null, "next");
			}
		}
	});

	if (window.location.hash.includes("#storyview")) {
		ffStoryviewBody.classList.add("ff_storyview_visible");
		history.pushState("storyview", document.title + " Storyview", "#storyview");
		let ffStoryViewButtons = document.querySelectorAll(".ff_storyview_button");
		ffStoryViewButtons[0].click();
	}

	class TinyGesture {
		constructor(element, options) {
			options = Object.assign({}, TinyGesture.defaults, options);
			this.element = element;
			this.opts = options;
			this.touchStartX = null;
			this.touchStartY = null;
			this.touchEndX = null;
			this.touchEndY = null;
			this.velocityX = null;
			this.velocityY = null;
			this.longPressTimer = null;
			this.doubleTapWaiting = false;
			this.handlers = {
				panstart: [],
				panmove: [],
				panend: [],
				swipeleft: [],
				swiperight: [],
				swipeup: [],
				swipedown: [],
				tap: [],
				doubletap: [],
				longpress: []
			};

			this._onTouchStart = this.onTouchStart.bind(this);
			this._onTouchMove = this.onTouchMove.bind(this);
			this._onTouchEnd = this.onTouchEnd.bind(this);

			this.element.addEventListener("touchstart", this._onTouchStart, passiveIfSupported);
			this.element.addEventListener("touchmove", this._onTouchMove, passiveIfSupported);
			this.element.addEventListener("touchend", this._onTouchEnd, passiveIfSupported);

			if (this.opts.mouseSupport && !("ontouchstart" in window)) {
				this.element.addEventListener("mousedown", this._onTouchStart, passiveIfSupported);
				document.addEventListener("mousemove", this._onTouchMove, passiveIfSupported);
				document.addEventListener("mouseup", this._onTouchEnd, passiveIfSupported);
			}
		}

		destroy() {
			this.element.removeEventListener("touchstart", this._onTouchStart);
			this.element.removeEventListener("touchmove", this._onTouchMove);
			this.element.removeEventListener("touchend", this._onTouchEnd);
			this.element.removeEventListener("mousedown", this._onTouchStart);
			document.removeEventListener("mousemove", this._onTouchMove);
			document.removeEventListener("mouseup", this._onTouchEnd);
			clearTimeout(this.longPressTimer);
			clearTimeout(this.doubleTapTimer);
		}

		on(type, fn) {
			if (this.handlers[type]) {
				this.handlers[type].push(fn);
				return {
					type,
					fn,
					cancel: () => this.off(type, fn)
				};
			}
		}

		off(type, fn) {
			if (this.handlers[type]) {
				const idx = this.handlers[type].indexOf(fn);
				if (idx !== -1) {
					this.handlers[type].splice(idx, 1);
				}
			}
		}

		fire(type, event) {
			for (let i = 0; i < this.handlers[type].length; i++) {
				this.handlers[type][i](event);
			}
		}

		onTouchStart(event) {
			this.thresholdX = this.opts.threshold("x", this);
			this.thresholdY = this.opts.threshold("y", this);
			this.disregardVelocityThresholdX = this.opts.disregardVelocityThreshold("x", this);
			this.disregardVelocityThresholdY = this.opts.disregardVelocityThreshold("y", this);
			this.touchStartX = event.type === "mousedown" ? event.screenX : event.changedTouches[0].screenX;
			this.touchStartY = event.type === "mousedown" ? event.screenY : event.changedTouches[0].screenY;
			this.touchMoveX = null;
			this.touchMoveY = null;
			this.touchEndX = null;
			this.touchEndY = null;
			// Long press.
			this.longPressTimer = setTimeout(() => this.fire("longpress", event), this.opts.longPressTime);
			this.fire("panstart", event);
		}

		onTouchMove(event) {
			if (event.type === "mousemove" && (!this.touchStartX || this.touchEndX !== null)) {
				return;
			}
			const touchMoveX = (event.type === "mousemove" ? event.screenX : event.changedTouches[0].screenX) - this.touchStartX;
			this.velocityX = touchMoveX - this.touchMoveX;
			this.touchMoveX = touchMoveX;
			const touchMoveY = (event.type === "mousemove" ? event.screenY : event.changedTouches[0].screenY) - this.touchStartY;
			this.velocityY = touchMoveY - this.touchMoveY;
			this.touchMoveY = touchMoveY;
			const absTouchMoveX = Math.abs(this.touchMoveX);
			const absTouchMoveY = Math.abs(this.touchMoveY);
			this.swipingHorizontal = absTouchMoveX > this.thresholdX;
			this.swipingVertical = absTouchMoveY > this.thresholdY;
			this.swipingDirection = absTouchMoveX > absTouchMoveY ? (this.swipingHorizontal ? "horizontal" : "pre-horizontal") : this.swipingVertical ? "vertical" : "pre-vertical";
			if (Math.max(absTouchMoveX, absTouchMoveY) > this.opts.pressThreshold) {
				clearTimeout(this.longPressTimer);
			}
			this.fire("panmove", event);
		}

		onTouchEnd(event) {
			if (event.type === "mouseup" && (!this.touchStartX || this.touchEndX !== null)) {
				return;
			}
			this.touchEndX = event.type === "mouseup" ? event.screenX : event.changedTouches[0].screenX;
			this.touchEndY = event.type === "mouseup" ? event.screenY : event.changedTouches[0].screenY;
			this.fire("panend", event);
			clearTimeout(this.longPressTimer);

			const x = this.touchEndX - this.touchStartX;
			const absX = Math.abs(x);
			const y = this.touchEndY - this.touchStartY;
			const absY = Math.abs(y);

			if (absX > this.thresholdX || absY > this.thresholdY) {
				this.swipedHorizontal = this.opts.diagonalSwipes ? Math.abs(x / y) <= this.opts.diagonalLimit : absX >= absY && absX > this.thresholdX;
				this.swipedVertical = this.opts.diagonalSwipes ? Math.abs(y / x) <= this.opts.diagonalLimit : absY > absX && absY > this.thresholdY;
				if (this.swipedHorizontal) {
					if (x < 0) {
						// Left swipe.
						if (this.velocityX < -this.opts.velocityThreshold || x < -this.disregardVelocityThresholdX) {
							this.fire("swipeleft", event);
						}
					} else {
						// Right swipe.
						if (this.velocityX > this.opts.velocityThreshold || x > this.disregardVelocityThresholdX) {
							this.fire("swiperight", event);
						}
					}
				}
			}
		}
	}

	TinyGesture.defaults = {
		threshold: (type, self) => Math.max(25, Math.floor(0.15 * (type === "x" ? window.innerWidth || document.body.clientWidth : window.innerHeight || document.body.clientHeight))),
		velocityThreshold: 10,
		disregardVelocityThreshold: (type, self) => Math.floor(0.5 * (type === "x" ? self.element.clientWidth : self.element.clientHeight)),
		pressThreshold: 8,
		diagonalSwipes: false,
		diagonalLimit: Math.tan(((45 * 1.5) / 180) * Math.PI),
		longPressTime: 500,
		doubleTapTime: 300,
		mouseSupport: true
	};

	// Passive feature detection.
	let passiveIfSupported = false;

	try {
		window.addEventListener(
			"test",
			null,
			Object.defineProperty({}, "passive", {
				get: function () {
					passiveIfSupported = { passive: true };
				}
			})
		);
	} catch (err) { }

	const touchOptions = {
		velocityThreshold: 5,
		mouseSupport: false,
		disregardVelocityThreshold: (type, self) => Math.floor(0.1 * (type === "x" ? self.element.clientWidth : self.element.clientHeight))
	};

	const touchTarget = document.querySelectorAll(".ff_storyview_blocks");
	let gestures = [];
	touchTarget.forEach(target => {
		gestures.push(new TinyGesture(target, touchOptions));
	});

	gestures.forEach(gesture => {
		if ("ontouchstart" in window || (window.DocumentTouch && window.document instanceof DocumentTouch) || window.navigator.maxTouchPoints || window.navigator.msMaxTouchPoints) {
			gesture.on("swiperight", event => {
				// goto previous story
				stepStoryview(null, "previous");
			});

			gesture.on("swipeleft", event => {
				// goto next story
				stepStoryview(null, "next");
			});
		}
	});

	function getClosest(elem, selector) {
		if (!Element.prototype.matches) {
			Element.prototype.matches =
				Element.prototype.matchesSelector ||
				Element.prototype.mozMatchesSelector ||
				Element.prototype.msMatchesSelector ||
				Element.prototype.oMatchesSelector ||
				Element.prototype.webkitMatchesSelector ||
				function (s) {
					var matches = (this.document || this.ownerDocument).querySelectorAll(s),
						i = matches.length;
					while (--i >= 0 && matches.item(i) !== this) { }
					return i > -1;
				};
		}

		// Get the closest matching element
		for (; elem && elem !== document; elem = elem.parentNode) {
			if (elem.matches(selector)) return elem;
		}
		return null;
	};

	/**
	 * Social share functions
	 */
	const ffStoryviewShareButtons = document.querySelectorAll(".storyview_share_button");
	if(ffStoryviewShareButtons){
		ffStoryviewShareButtons.forEach(shareButton => {
			shareButton.addEventListener("click", ffToggleSharePanel);
		});

		function ffToggleSharePanel(){
			if (ffStoryviewBody.classList.contains("ff_storyview_share_panel_visible")) {
				ffStoryviewBody.classList.remove("ff_storyview_share_panel_visible");
			} else {
				ffStoryviewBody.classList.add("ff_storyview_share_panel_visible");
			}
		}
	}

	const shareLinkButton = document.querySelector("#storyview_share_option_link");
	if(shareLinkButton){
		shareLinkButton.addEventListener("click", (e) => {
			e.preventDefault();
			const shareURL = e.target.closest("a").getAttribute("href")
			copyToClipboard(shareURL);
			const copyURLsuccessMessage = document.querySelector("#storyview_share_panel_link_copied");
			copyURLsuccessMessage.style.display = "block";
			setTimeout(() => {
				copyURLsuccessMessage.style.display = "none";
			}, 1000);
			
		});
	}

	function copyToClipboard(text) {
		const textarea = document.createElement("textarea");
		textarea.value = text;
		document.body.appendChild(textarea);
		textarea.select();
		document.execCommand("copy");
		document.body.removeChild(textarea);
	}

	const ffStoryViewSharePanel = document.querySelector("#storyview_share_panel");
	const ffStoryViewSharePanelContainer = document.querySelector("#storyview_share_panel_container");

	if(ffStoryViewSharePanelContainer){
		ffStoryViewSharePanelContainer.addEventListener("click", (e) => {
			if(!ffStoryViewSharePanel.contains(e.target)){
				ffStoryviewBody.classList.remove("ff_storyview_share_panel_visible");
			}
		});
	}

	/**
	 * End screen share
	 */
	const ffStoryviewEndScreenShareButtons = document.querySelectorAll(".ff_storyview_end_screen_share_button");
	if(ffStoryviewEndScreenShareButtons){
		ffStoryviewEndScreenShareButtons.forEach(shareButton => {
			shareButton.addEventListener("click", ffToggleSharePanel);
		});

		function ffToggleSharePanel(){
			if (ffStoryviewBody.classList.contains("ff_storyview_share_panel_visible")) {
				ffStoryviewBody.classList.remove("ff_storyview_share_panel_visible");
			} else {
				ffStoryviewBody.classList.add("ff_storyview_share_panel_visible");
			}
		}
	}
}

/**
 * Display stories without redirecting to post or page
 */
const ffStoryviewWidgetDisplayStory = (e) => {
  e.preventDefault();
  const ffStoryviewWidgetStoryID = e.target.dataset.story;

  let ffStoryviewButton = document.getElementById(`ff_storyview_button_${ffStoryviewWidgetStoryID}`);

  // story is already available in the source, display it
  if(ffStoryviewButton){
    ffStoryviewButton.click();
    return;
  }

  // story doesn't exists on the page, get source and display it
  fetch(ffStoryviewAjaxURL, {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded; charset=utf-8'
      },
      body: `action=storyview_ajax_frontend_action&storyviewAction=display&storyID=${ffStoryviewWidgetStoryID}`,
      credentials: 'same-origin'
  }).then(response => {
      return response.json();
  }).then(data => {
    if(data.story){
      // add story HTML to body
      let ffStoryviewStoryRoot = document.getElementById("ff_storyview_root");
      if(!ffStoryviewStoryRoot){
        ffStoryviewStoryRoot = document.createElement("div");
        ffStoryviewStoryRoot.id = "ff_storyview_root";
        document.getElementsByTagName('body')[0].appendChild(ffStoryviewStoryRoot);
      }
      ffStoryviewStoryRoot.innerHTML = data.story;
      ffStoryviewButton = document.getElementById(`ff_storyview_button_${ffStoryviewWidgetStoryID}`);

      ffStoryviewButton.click();
    }
  });
}

const ffStoryviewWidgetStories = document.querySelectorAll(".ff_storyview_widget_story_item");
if( ffStoryviewWidgetStories.length ){
  ffStoryviewWidgetStories.forEach(widgetStory => {
    widgetStory.addEventListener("click", ffStoryviewWidgetDisplayStory);
  });
}