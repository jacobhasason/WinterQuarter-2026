/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

"use strict";


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
    
    h3_elem.classList.toggle("minus");
    div_elem.classList.toggle("open");
    
    evt.preventDefault();
};


