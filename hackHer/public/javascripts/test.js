"use strict";

let event2 = JSON.parse(localStorage.getItem("foodEntry"));
console.log(event2);

document.querySelector(".location").textContent = event2.store;
document.querySelector("#item").textContent = event2.food;
document.querySelector("#price").textContent = event2.price;
if (event2.sale === "yes") {
  document.querySelector("#sale").textContent = "Sale ✅";
} else {
  document.querySelector("#sale").textContent = "No Sale 🚫";
}
