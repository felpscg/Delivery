var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    var menuR = document.getElementById("menu").style;
    var menuIcon = document.getElementById("img-d").style;
    var menuIconM = document.getElementById("img-dm").style;
    var fundoDegrade = document.getElementById("fundo-psf").style;
    if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40 && prevScrollpos > currentScrollPos) {
        menuR.top = "35px";
        menuIcon.width = "32px";
        menuIcon.top = "-0.4em";
        menuIconM.width = "auto";
        menuIconM.height = "35px";
        menuIconM.top = "0.3em";
        menuIconM.left = "3.2em";
        fundoDegrade.background = "#fff";
        fundoDegrade.borderBottom = "solid 20px #000 !important";
        
        fundoDegrade.height = "40px";

    } else {

        menuR.top = "87px";
        menuIcon.width = "70px";
        menuIconM.height="auto";
        menuIconM.width="520px";
        menuIconM.top="2em";
        menuIconM.left = "7em";
        fundoDegrade.background = "linear-gradient(rgba(20,0,0,.5), rgba(255,255,255,.1))";
        fundoDegrade.height = "90px";
    }
    prevScrollpos = currentScrollPos;


};
