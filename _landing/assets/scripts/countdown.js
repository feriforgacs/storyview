const dayCounter = document.querySelector("#day__counter");
const hourCounter = document.querySelector("#hour__counter");
const minCounter = document.querySelector("#min__counter");
const secCounter = document.querySelector("#sec__counter");
const dealinfo = document.querySelector(".deal-info");
const endDate = new Date("September 14, 2020 23:59:59");

function countdownTimer() {
	const now = new Date();
	const remainingTime = Math.abs(endDate - now) / 1000;

	let remainingSeconds = Math.floor(remainingTime % 60);
	let remainingMinutes = Math.floor(remainingTime / 60) % 60;
	let remainingHours = Math.floor(remainingTime / 3600) % 24;
	let remainingDays = Math.floor(remainingTime / 86400);

	secCounter.textContent = addZero(remainingSeconds % 60);
	minCounter.textContent = addZero(remainingMinutes % 60);
	hourCounter.textContent = addZero(remainingHours);
	dayCounter.textContent = addZero(remainingDays);
}

function addZero(value) {
	return value < 10 ? `0${value}` : value;
}

setInterval(countdownTimer, 1000);

dealinfo.textContent = "🎒 Back To School Offer 👉 Save $10 (30%) ✨";
