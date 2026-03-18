"use strict";


const $ = selector => document.querySelector(selector);

document.addEventListener("DOMContentLoaded", () => {
   $("#update_cust").addEventListener("click", (event) => validateCustomerInfo(event));
   $("#update_bill").addEventListener("click", (event) => validateBillingAddress(event));
   $("#update_ship").addEventListener("click", (event) => validateShippingAddress(event));
});

const validateCustomerInfo = (event) => {
    let fname = $("#fname").value;
    let lname = $("#lname").value;
    let email = $("#email").value;
    let password =  $("#password").value;
    let con_password =  $("#con_password").value;
    const email_regex = "/^(?!.*\.\.)[A-Za-z0-9](?:[A-Za-z0-9._%+-]{0,62}[A-Za-z0-9])?@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z]{2,})+$/;";
    const pass_regex = "/^(?:(?=.*[a-z])(?=.*[A-Z])(?=.*\d)|(?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])|(?=.*[a-z])(?=.*\d)(?=.*[^A-Za-z0-9])|(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9])).{8,}$/";
    
    if(fname === "") {
        alert("First name required!");
         event.preventDefault();
    }
    else if(lname === "") {
        alert("Last name required!");
        event.preventDefault();
    }
    // Validate email
    else if(!email_regex.test(email)) {
        alert("Email is invalid");
        event.preventDefault();  
    }
    // Confirm Passwords Match
    else if(password !== con_password) {
        alert("Password and Confirm Password do not match!");
        event.preventDeault();
    // Meet password requirements
    } else if (pass_regex.test(password)) {
        alert("Password have eight characters and have three of the following: lowercase letter, uppercase letter, special character, number");
        event.preventDeault();
    } else {
        alert("Customer Information Updated!");
    }
    
};



const validateBillingAddress = (event) => {
    let bill_1 = $("#bill_addr1").value;
    let bill_2 = $("#bill_addr2").value;
    let bill_city = $("#bill_city").value;
    let bill_state = $("#bill_state").value;
    let bill_zip = $("#bill_zip").value;
    let bill_phone = $("#bill_phone").value;

    const zip_regex = "/^\d{5}(-\d{4})?$/";
    const phone_regex = "/^(?:\+1\s?)?(?:\(\d{3}\)|\d{3})[\s.-]?\d{3}[\s.-]?\d{4}$/";
    
    if(bill_1 === "" || bill_2 === "") {
        alert("Billing Address required!");
        event.preventDefault();
    }
    
    else if(bill_city === "") {
        alert("City required!");
        event.preventDefault();
    }
    
    else if(bill_state === "") {
        alert("State required!");
        event.preventDefault();
    }
    else if(bill_zip === "") {
        alert("Zip Code required!");
        event.preventDefault();
    // Validate Zip Code
    } else if (!zip_regex.test(bill_zip)) {
        alert("Zip code is not valid!");
        event.preventDefault();
    } 
    
    else if(bill_phone === "") {
        alert("Phone number required!");
        event.preventDefault();
        
    // Validate Phone
    } else if (!zip_regex.test(bill_zip)) {
        alert("Phone number is not valid!");
        event.preventDefault();
    } else {
        alert("Billing Address Updated!");
    }
    
};

const validateShippingAddress = (event) => {
    let ship_1 = $("#bill_addr1").value;
    let ship_2 = $("#bill_addr2").value;
    let ship_city = $("#bill_city").value;
    let ship_state = $("#bill_state").value;
    let ship_zip = $("#bill_zip").value;
    let ship_phone = $("#bill_phone").value;

    const zip_regex = "/^\d{5}(-\d{4})?$/";
    const phone_regex = "^(?:\+1\s?)?(?:\(\d{3}\)|\d{3})[\s.-]?\d{3}[\s.-?\d{4}$";
    
    if(ship_1 === "" || ship_2 === "") {
        alert("Billing Address required!");
        event.preventDefault();
    }
    
    else if(ship_city === "") {
        alert("City required!");
        event.preventDefault();
    }
    
    else if(ship_state === "") {
        alert("State required!");
        event.preventDefault();
    }
    
    else if(ship_zip === "") {
        alert("Zip Code required!");
        event.preventDefault();
    } else if (!zip_regex.test(ship_zip)) {
        alert("Zip code is not valid!");
        preventDefault();
    } 
    
    else if(ship_phone === "") {
        alert("Phone number required!");
    // Validate Phone
    } else if (!phone_regex.test(ship_zip)) {
        alert("Phone number is not valid!");
        preventDefault();
    } else {
        alert("Shipping Address Updated!");
    }
    
};