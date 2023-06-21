function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}
// TODO: set active first one in nav
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



// Remove Message Tip
function finishedMessage() {
    document.querySelectorAll(".message").forEach(mass => {
        mass.classList.add("finished");
    });
}
setTimeout(finishedMessage, 5000);


// Ajax Get Messages

/**
 * @todo Update function to accept multi files
 * this function to get words messages in multi-language
 *
 * How Use it this function ?
 *
 * getMessage(controllerName, action, nameFile).then((result)=>
 *      // Do What you want
 * );
 *
 * @param controller determine the controller you want fetch data from
 * @param action the action method name this method must include `Ajax` word to
 * @param nameFile the file name you want load for example "template.common" where template name folder and common name file
 *
 *
 * @return Promise object
 * @version 1.0
 * @author Feras Barahmeh
 *
 * */
const getMessages = (controller, action, nameFile) => {
    return new Promise((resolve, reject) => {
        let xml = new XMLHttpRequest();

        xml.onload = function () {
            if (this.readyState === 4 && this.status === 200) {
                resolve(JSON.parse(xml.responseText));
            } else {
                reject(Error("File name not valid"));
            }
        }


        xml.open("POST", "http://estore.local/"+ controller +"/" + action);
        xml.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
        );

        xml.send(`nameFile=${nameFile}`);

    });
};

// Covert inputs min = 0 to abs
document.querySelectorAll('input[positive]').forEach((inp) => {
    inp.addEventListener("keyup", (e) => {
        if (e.target.value < 0 ) {
            e.target.value = e.target.value  * -1;
        }
    });
})

// Up labels when focus input
let inputsHtml = document.querySelectorAll(".up-label-focus");
if (inputsHtml != null) {
    inputsHtml.forEach((input) => {
        let label = input.parentElement.querySelector("label");
        if (input.value !== '') {
            label.classList.add("float")

        }

        input.addEventListener("focus", () => {
            let label = input.parentElement.querySelector("label");

            if (input.value === '') {
                label.classList.add("float")
            }
        });
        input.addEventListener("blur", () => {
            let label = input.parentElement.querySelector("label");

            if (input.value === '') {
                label.classList.remove("float")
            }
        });
    });
}
