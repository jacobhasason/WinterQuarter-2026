/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

"use strict";

const $ = selector => document.querySelector(selector);

document.addEventListener("DOMContentLoaded", () => {
   $("#calculate").addEventListener("click", calculate);
   $("#product").focus();
});

// Determines if the prouct cost is valid
const calculate = () => {
    let product_cost = parseFloat($("#product").value);
    if(!isNaN(product_cost) && product_cost > 0) {
       //alert("valid value entered!");
       calculateShipping(product_cost);
    } else {
       alert("Inputted product cost value is invalid - Must be a positive number with no special characters!");
    }
    $("#product").focus();
};

// Calculate the total shipping cost based on the product cost
const calculateShipping = (product_cost) => {
   let ship_percent = 0.2;
   let total_cost = 0;
   
   if(product_cost > 50 && product_cost <= 200) {
       ship_percent = 0.18;
   } else if(product_cost > 200 && product_cost <= 500) {
       ship_percent = 0.15;
   } else if(product_cost > 500 && product_cost <= 1000) {
       ship_percent = 0.12;
   } else if (product_cost > 1000) {
       ship_percent = 0.08;
   }
    total_cost = product_cost + (product_cost * ship_percent);
    
    // Display value in the totalCost text box
    $("#totalCost").value = total_cost.toFixed(2);
};