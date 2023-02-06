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

// Start navigation Bar
    function hiddenSearchIcon(inputSearch) {
        inputSearch.onfocus = () => {
            inputSearch.parentElement.querySelector(".search-icon").classList.add("un-visible");
        }
        inputSearch.onblur = () => {
            inputSearch.parentElement.querySelector(".search-icon").classList.remove("un-visible");
        }
    }

    function hiddenMainLi(li, contentInput) {

        const links = li.querySelectorAll("a");
        links.forEach(link => {
           const content = link.textContent.toLowerCase();
           if (content.search(contentInput) === -1) {
               li.classList.add("un-visible");
           } else {
               li.classList.remove("un-visible");
           }
        });
    }
    function hiddenSubMenu(li, contentInput, subMenu) {
        subMenu.classList.remove("un-visible")
        const as = li.querySelectorAll("a");
        const button = subMenu.closest("li").querySelector("button");
        const span = button.querySelector("span");

        as.forEach(link => {
            const buttonContent = span.innerText.toLowerCase();
            const content = link.textContent.toLowerCase() + buttonContent;

            if (content.search(contentInput) === -1 ) {
                li.classList.add("un-visible");
                subMenu.closest(".main-li").classList.add("un-visible");
            } else {
                li.classList.remove("un-visible");
                subMenu.closest(".main-li").classList.remove("un-visible");
            }
        });
    }
    function hiddenGrandLi(li, contentInput) {
        const lis = li.querySelectorAll(".li-level-2");
        let counter = 0;
        const subMenu = li.querySelector(".sub-menu");
        const numChild = subMenu.childElementCount;

        lis.forEach(li => {
            hiddenSubMenu(li, contentInput, subMenu);
            if (li.classList.contains("un-visible")) {
                counter++;
            }

            if (counter === numChild) {
                subMenu.classList.add("un-visible");
            } else {
                subMenu.classList.remove("un-visible");
            }

        });
    }

    // Hidden icon search when focus in input field search session
    const inputSearch = document.getElementById("search-session");

    if (inputSearch !== null) {

        hiddenSearchIcon(inputSearch);

        // Search In Sessions
        const appNav    = document.getElementById("app_navigation");
        const lis  = appNav.querySelectorAll("li.main-li");

        inputSearch.addEventListener("keyup", () => {
           const contentInput = inputSearch.value.toLowerCase();

           lis.forEach(li => {
                if (! li.classList.contains("grand-li")) {
                    hiddenMainLi(li, contentInput);
                } else {
                    hiddenGrandLi(li, contentInput);
                }
           });
        });
    }

    // Hidden SubMenu
    const grandLis = document.querySelectorAll(".grand-li");

    grandLis.forEach(grandLi =>  {
       grandLi.addEventListener('click', () => {
          grandLi.querySelector(".sub-menu").classList.toggle('un-visible');
          grandLi.querySelector(".angle").classList.toggle("angle-rotate");
       });
    });




