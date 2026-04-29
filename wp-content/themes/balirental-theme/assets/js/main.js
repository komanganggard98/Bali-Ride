import "../scss/main.scss";
import "./states/bike";
import "./api/bikeApi";
import "./modules/bike/bikeFilter";
import "./modules/bike/bikeInfiniteScroll";
import "./booking";

document.addEventListener("DOMContentLoaded", function() {
    mobileMenu();
});

function mobileMenu() {
    const btn = document.querySelector(".mobile-nav-button");
    const btnIcon = document.querySelector(".mobile-nav-button i");
    const nav = document.querySelector(".header__nav");
    const body = document.getElementsByTagName("body");

    if(btn) {
        btn.addEventListener("click", function() {
            if(btnIcon){
                if(nav.classList.contains('active')){
                    btnIcon.classList.replace('fa-xmark','fa-bars')
                }else{
                    btnIcon.classList.replace('fa-bars','fa-xmark')
                }
            }
            if(body[0]){
                body[0].classList.toggle('nav-active')
            }
            nav.classList.toggle("active");
        });
    }
}