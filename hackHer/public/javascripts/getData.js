"use strict";

function changeText1(store) {
  document.querySelector(".dropbtn").textContent = `${store}`;
}

class userEntry {
  constructor(food, store, price, sale) {
    this.food = food;
    this.store = store;
    this.price = price;
    this.sale = sale;
  }
}
let entry;

//document.querySelector("#share")

const createInput = function () {
  //create new user entry object
  let food = document.querySelector("#username").value;
  let store = document.querySelector(".dropbtn").textContent;
  let price = document.querySelector("#password").value;
  let sale = document.querySelector("#sale").value;
  entry = new userEntry(food, store, price, sale, entry);
  console.log(entry);

  //local storage convert object to string
  localStorage.setItem("foodEntry", JSON.stringify(entry));
  console.log(localStorage);
};

let user;

class Users {
  constructor(username, email, password) {
    this.username = username;
    this.email = email;
    this.password = password;
  }
}

const newusername = function () {
  let username = document.querySelector("#username").value;
  let password = document.querySelector("#password").value;
  let email = document.querySelector("#email").value;
  user = new Users(username, email, password);
  alert("User account successfully created!");
};
