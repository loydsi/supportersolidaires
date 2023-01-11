const icons = document.querySelector(".icons");
const nav = document.querySelector("nav");
const faBurger = document.querySelector("fa-burger");

icons.addEventListener("click", () => {
  nav.classList.toggle("burgermenu")
})