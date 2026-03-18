/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

const $d = selector => document.querySelector(selector);

document.addEventListener("DOMContentLoaded", () => {
    console.log("date.js loaded");
    displayDate();
    
});

const displayDate = () => {
    const current_date = new Date();
    const footer_div = $d("footer div:last-child");
    footer_div.textContent = current_date.toLocaleDateString("en-US");
};