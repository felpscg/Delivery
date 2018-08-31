var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    var menuR = document.getElementById("menu").style;
     if (prevScrollpos > currentScrollPos) {
 menuR.top = "87px";
 
 } else {
 menuR.top = "20px";
 }
 prevScrollpos = currentScrollPos;
 
    
};

/*
 * 
 * 
 * 
 
 window.onscroll = function() {
 var currentScrollPos = window.pageYOffset;
 if (prevScrollpos > currentScrollPos) {
 document.getElementById("navbar").style.top = "0";
 } else {
 document.getElementById("navbar").style.top = "-50px";
 }
 prevScrollpos = currentScrollPos;
 }
 */