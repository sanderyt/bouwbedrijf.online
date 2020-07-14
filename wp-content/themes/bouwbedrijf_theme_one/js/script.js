const hamburgerIcon = document.querySelector(".header__hamburger");
const menu = document.querySelector(".header__menu");

const toggleMenu = () => {
  menu.classList.toggle("open");
  hamburgerIcon.classList.toggle("open");
};

hamburgerIcon.addEventListener("click", toggleMenu);
