const dayCounter = document.querySelector("#day__counter");
const hourCounter = document.querySelector("#hour__counter");
const minCounter = document.querySelector("#min__counter");
const secCounter = document.querySelector("#sec__counter");
const dealinfo = document.querySelector(".deal-info");
const endDate = new Date("2020-04-12");

function countdownTimer(){
  const now = new Date();
  const remainingTime = new Date(endDate.getTime() - now.getTime());

  let remainingDays = remainingTime.getUTCDate() - 1;
  let remainingHours = remainingTime.getUTCHours();
  let remainingMinutes = remainingTime.getUTCMinutes();
  let remainingSeconds = remainingTime.getUTCSeconds();

  dayCounter.textContent = addZero(remainingDays);
  hourCounter.textContent = addZero(remainingHours);
  minCounter.textContent = addZero(remainingMinutes);
  secCounter.textContent = addZero(remainingSeconds);
}

function addZero(value){
  return value < 10 ? `0${value}` : value;
}

setInterval(countdownTimer, 1000);

dealinfo.textContent = "Save $15 (42%) with the 🐣 Easter Deal 🐰 until April 12.";