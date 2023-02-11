const cardPopup = document.querySelector(".card");
const classCard = [...cardPopup.classList];
function hiddenPopup() {
    cardPopup.classList.remove("show");
}
function showPopup() {
    cardPopup.classList.add("show");
}

const popsOnClick = document.querySelectorAll(".pop-on-click");

if (popsOnClick != null) {
    popsOnClick.forEach(popOnClick => {
       popOnClick.addEventListener("click", () => {
           popOnClick.classList.add("clicked");
           if(popOnClick.classList.contains("danger-style")) {
               cardPopup.classList.add("danger");
           } else {
               if (popOnClick.classList.contains("success-style") || popOnClick.classList.contains("done-style")) {
                   cardPopup.querySelector("span.exclamation").classList.add("success");
                   cardPopup.querySelector("span.exclamation").classList.remove("danger");
               }
           }
           showPopup();
       }) ;
    });
}


const deletePopup = document.getElementById("reject-popup");
/*
* If Click in X button in popup box just remove box
* */
if (deletePopup !== null) {
    deletePopup.addEventListener("click", () => {
        hiddenPopup();
        return false;
    });
}

const acceptedPopup = document.getElementById("accepted-popup");
/*
* If user click Ok (Confirm Operation) will apply action
* */
if (acceptedPopup != null) {
    acceptedPopup.addEventListener("click", () => {
        if (cardPopup.classList.contains("link")) {
            popsOnClick.forEach(clicked => {
                if (clicked.classList.contains("clicked")) {
                    clicked.parentElement.querySelector("#delete").click();
                    clicked.classList.remove("clicked")
                }
            });
        }

        hiddenPopup();
        return true;
    });
}

