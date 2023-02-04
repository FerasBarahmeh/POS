// Switch Main nav
const menuSwitch    = document.getElementById("menu-switch");
const mainNav       = document.getElementById("main_navigation");
const conditionMenu = menuSwitch.getAttribute("data-condition-menu");
const actionView    = document.getElementById("action-view");


menuSwitch.addEventListener("click", () => {
    mainNav.classList.toggle("hidden");
    menuSwitch.classList.toggle("rout-90");
    mainNav.classList.remove("hidden-mobile");
    actionView.parentElement.classList.toggle("grid");
});

// Show Drop Down Menu
const dropDown  = document.getElementById("drop-down");
const menu      = dropDown.querySelector("#menu");

dropDown.addEventListener("click", () => {
    menu.classList.toggle("visible");
});

