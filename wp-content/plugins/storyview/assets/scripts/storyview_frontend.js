/*
Story View WordPress plugin 1.0
by Ferenc Forgacs - @feriforgacs
2019.05.
*/

const ffStoryviewGap = 40;
let ffStoryviewCurrentStory = 0;

/**
 * Toggle storyview
 */
const ffStoryviewBody = document.querySelector("body");
const ffStoryviewDisplayButton = document.querySelector("#ff_storyview_button");
const ffStoryviewCloseButton = document.querySelector("#ff_storyview_close_button");

ffStoryviewDisplayButton.addEventListener("click", toggleStoryview);
ffStoryviewCloseButton.addEventListener("click", toggleStoryview);

function toggleStoryview(){
    if(ffStoryviewBody.classList.contains("ff_storyview_visible")){
        ffStoryviewBody.classList.remove("ff_storyview_visible");
        history.pushState("storyview", document.title, window.location.href.split('#')[0]);
    } else {
        ffStoryviewBody.classList.add("ff_storyview_visible");
        history.pushState("storyview", document.title + " Storyview", "#storyview");
    }

    setSizes();
}

/**
 * Storyview step forward, backward
 */
const ffStoryviewBlocks = document.querySelector("#ff_storyview_blocks");
ffStoryviewBlocks.addEventListener("click", stepStoryview);

const ffStoryviewBlocksContainer = document.querySelector("#ff_storyview_blocks_items_container");
const ffStoryviewBlockItems = document.querySelectorAll(".ff_storyview_block_item_content");
const ffStoryviewBlockItemsCount = ffStoryviewBlockItems.length;
let ffStoryviewBlockWidth = (window.innerWidth < 420) ? window.innerWidth : 420;
let ffStoryviewBlockHeight = (window.innerHeight < 746) ? window.innerHeight : 746;

function setSizes(){
    ffStoryviewBlockWidth = (window.innerWidth < 420) ? window.innerWidth : 420;
    ffStoryviewBlockHeight = (window.innerHeight < 746) ? window.innerHeight : 746;
    
    let width = ffStoryviewBlockWidth * ffStoryviewBlockItemsCount;
    ffStoryviewBlocksContainer.style.width = width + 'px';
    ffStoryviewBlocksContainer.style.transform = 'translateX(0px)';

    ffStoryviewBlockItems.forEach((ffStoryviewBlockItem)=>{
        ffStoryviewBlockItem.style.width = ffStoryviewBlockWidth + "px";

        let blockHeight = ffStoryviewBlockHeight - ffStoryviewGap;
        ffStoryviewBlockItem.style.height = blockHeight + "px";
    })
}

setSizes();

/**
 * Display previous or next story item
 * @param {obect} event event object
 */
function stepStoryview(event){
    let ffStoryviewBlocksPosition = ffStoryviewBlocks.getBoundingClientRect();
    let ffStoryviewBlocksLeftMax = ffStoryviewBlocksPosition.left + (ffStoryviewBlocksPosition.width / 2);

    if(event.clientX > ffStoryviewBlocksLeftMax){
        // go to next block
        if(ffStoryviewCurrentStory < ffStoryviewBlockItemsCount - 1){
            let left = (ffStoryviewCurrentStory + 1) * ffStoryviewBlockWidth;
            ffStoryviewBlocksContainer.style.transform = 'translateX(-' + left + 'px)';
            ffStoryviewCurrentStory++;
        }
        // update indicator
        updateIndicator("next");
    } else {
        // go to previous block
        if(ffStoryviewCurrentStory > 0){
            let left = ffStoryviewCurrentStory * ffStoryviewBlockWidth - ffStoryviewBlockWidth;
            ffStoryviewBlocksContainer.style.transform = 'translateX(-' + left + 'px)';
            ffStoryviewCurrentStory--;
        }
        // update indicator
        updateIndicator("previous");
    }
}

/**
 * Update the status of the indicator
 */
function updateIndicator(direction){
    if(direction == "next"){
        let previousStoryIndicator = ffStoryviewCurrentStory - 1;
        document.querySelector("#ff_storyview_block_indicator_item_" + previousStoryIndicator).classList.remove("activ");
        document.querySelector("#ff_storyview_block_indicator_item_" + ffStoryviewCurrentStory).classList.add("activ");
    } else if(direction == "previous"){
        let nextStoryIndicator = ffStoryviewCurrentStory + 1;
        document.querySelector("#ff_storyview_block_indicator_item_" + nextStoryIndicator).classList.remove("activ");
        document.querySelector("#ff_storyview_block_indicator_item_" + ffStoryviewCurrentStory).classList.add("activ");
    }
}

window.addEventListener("resize", setSizes);

window.addEventListener("keydown", e => {
	if (e.code === "Escape" || e.code === "escape") {
		if (ffStoryviewBody.classList.contains("ff_storyview_visible")) {
            ffStoryviewBody.classList.remove("ff_storyview_visible");
            history.pushState("storyview", document.title, window.location.href.split('#')[0]);
		}
	}
});

if (window.location.hash.includes("#storyview")) {
    ffStoryviewBody.classList.add("ff_storyview_visible");
    history.pushState("storyview", document.title + " Storyview", "#storyview");
}