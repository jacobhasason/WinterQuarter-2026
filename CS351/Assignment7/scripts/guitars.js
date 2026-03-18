/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/ClientSide/javascript.js to edit this template
 */

"use strict";
$(document).ready( () => {
    $("#images").bxSlider({ 
           // One picture at a time
           minSlides: 1,
           maxSlides: 1,
           moveSlides: 1,
           
           captions: true,
           
           // autoscroll
           auto: true,
           pause: 3000,
           
           // Start with random picture
           randomStart: true,
           
           pager: true,
           pagerType: "short",
           pageSelector: "#page",
           slideWidth: 200
    });
});