const hamburgerIcon = document.querySelector(".header__hamburger");
const menu = document.querySelector(".mobilemenu");
const navitems = document.querySelector(".mobilemenu__list");

const toggleMenu = () => {
  menu.classList.toggle("open");
  hamburgerIcon.classList.toggle("open");
  navitems.classList.toggle("open");
};

hamburgerIcon.addEventListener("click", toggleMenu);
