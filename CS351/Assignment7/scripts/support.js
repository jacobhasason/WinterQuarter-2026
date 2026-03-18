/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

"use strict";
$(document).ready(function () {
   $("#accordion").accordion ({
       collapsible: true,
       active: false,
       icons: false     
   }); 
});




















/* Old JS */
/*
document.addEventListener("DOMContentLoaded", () => {
    const h3_elems = document.querySelectorAll("section h3");
    
    // Attach event handler for all h3 tags
    for(let h3_elem of h3_elems) {
        h3_elem.addEventListener("click", toggle);
    }
        
    //Focus on h3's first <a> tag
    h3_elems[0].firstChild.focus();
});


const toggle = evt => {
    const h3_elem = evt.currentTarget;
    const div_elem = h3_elem.nextElementSibling;
    
    const h3_elems = document.querySelectorAll("section h3");
    
    // Close all other sections
    for(let elem of h3_elems) {
        if (elem !== h3_elem) {
            elem.classList.remove("minus");
            elem.nextElementSibling.classList.remove("open");
        }
    }
    
    h3_elem.classList.toggle("minus");
    div_elem.classList.toggle("open");
    
    evt.preventDefault();
};
 */



