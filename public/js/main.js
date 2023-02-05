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

// Hidden icon search when focus in input field search session
const inputSearch = document.getElementById("search-session");

if (inputSearch !== null) {
    inputSearch.onfocus = () => {
        inputSearch.parentElement.querySelector(".search-icon").classList.add("un-visible");
    }
    inputSearch.onblur = () => {
        inputSearch.parentElement.querySelector(".search-icon").classList.remove("un-visible");
    }

    // Search In Sessions
    const appNav = document.getElementById("app_navigation");
    inputSearch.addEventListener("keyup", () => {
       const content = inputSearch.value.toLowerCase();
       const links = appNav.querySelectorAll("a");
       links.forEach(link => {
           const linkTo = link.innerText.toLowerCase();
           const li = link.closest("li");
           if (linkTo.search(content) === -1) {
               li.classList.add("hidden");
           } else {
               li.classList.remove("hidden");
           }
        });
    });
}


