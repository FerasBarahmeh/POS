const cardPopup = document.querySelector(".card");
if (cardPopup != null) {
    const classCard = [...cardPopup.classList];
}
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

            // Get name Action
            const indexLinkClass = classCard.indexOf("link");

            // Get Element by id to apply action for example(if link we will click to this link)
            if (classCard.length > indexLinkClass) {
                document.getElementById(classCard[indexLinkClass + 1]).click();
            }
        }

        hiddenPopup();
        return true;
    });
}

