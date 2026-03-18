"use strict";

const $ = selector => document.querySelector(selector);

document.addEventListener("DOMContentLoaded", () => {
   $("#submit").addEventListener("click", (event) => processLogin(event));
});

const processLogin = (event) => {
    let email = $("#email").value.trim();
    const regex = "/^(?!.*\.\.)[A-Za-z0-9](?:[A-Za-z0-9._%+-]{0,62}[A-Za-z0-9])?@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z]{2,})+$/";
    
    if (email === "") {
       event.preventDefault();
       alert("Email is blank!");
    }
    else if(!regex.test(email)) {
       event.preventDefault();
       alert("Email is invalid!");
    }
};