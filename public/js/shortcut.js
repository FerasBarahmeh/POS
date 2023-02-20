// TODO: Convert Structure Delete To AJAX
const cardPopup = document.querySelector(".card");
const classCard = [...cardPopup.classList];
function hiddenPopup(e) {
    console.log(e)
    e.closest(".card").classList.remove("show");
}
function showPopup(e) {
    e.previousElementSibling.classList.add("show");
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
            showPopup(popOnClick);
        }) ;
    });
}


const deletePopups = document.querySelectorAll("#reject-popup");
/*
* If Click in X button in popup box just remove box
* */
if (deletePopups !== null) {
    deletePopups.forEach(deletePopup => {
        deletePopup.addEventListener("click", () => {
            hiddenPopup(deletePopup);
            return false;
        });
    });
}

const acceptedPopups = document.querySelectorAll("#accepted-popup");
/*
* If user click Ok (Confirm Operation) will apply action
* */
if (acceptedPopups != null) {
    acceptedPopups.forEach(acceptedPopup => {
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
    })
}