"use strict";

let event2 = JSON.parse(localStorage.getItem("foodEntry"));
console.log(event2);

document.querySelector("#location").textContent = event2.store;
document.querySelector(".price").textContent = `$${event2.price}`;
if (event2.sale === "yes") {
  document.querySelector("#sale").textContent = "NEW SALE! ✅";
  document.querySelector(
    "#item"
  ).textContent = `${event2.food} are on sale at ${event2.store}!`;
} else {
  document.querySelector("#sale").textContent = "HIGH PRICE! 🚫";
  document.querySelector(
    "#item"
  ).textContent = `${event2.food} are a higer price this week at ${event2.store}!`;
}
