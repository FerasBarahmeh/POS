
const searchInputs = document.querySelectorAll(".input-container .search-input");

function whenFocusInput(input, label, ul) {
    input.onfocus = function () {

        // Show flash message
        getMessages("sales", "getMessagesAjax", "sales.messages").then((result) => {
            if (input.name === "Name") {
                flashMessage("info", result.message_hint_search_client, 5000);
            } else if(input.name === "Email") {
                flashMessage("info", result.message_hint_search_client_email, 5000);
            }
        });

        // flay label
        label.classList.add("up");

        // Active list
        ul.classList.add("active");
    }
}
function whenBlurInput(input, label, ul, lis) {
    input.onblur = () => {

        // control label input
        if (input.value === '') {
            label.classList.remove("up");
        } else if (input.value == null) {
            label.classList.add("up");
        }

        // Control label
        if (input.value === '') {
            ul.classList.add("active");
            label.classList.add("up");
        }

        document.addEventListener("click", (e) => {
            const element = e.target;

            if (element === input) {
                ul.classList.remove("active");
                ul.classList.add("active");
            } else {
                lis.forEach(li => {
                    if (element === li) {
                        ul.classList.remove("active")
                    } else {
                        ul.classList.remove("active");
                    }
                });
            }


        });
    };
}

function whenWriteInInput(input, fetchButton, lis) {

    // control button
    input.addEventListener("keyup", (e) => {

        if (input.getAttribute("primaryKey") != null) input.removeAttribute("primaryKey");

        if (input.value === '') {
            fetchButton.classList.remove("active");
        } else {
            fetchButton.classList.add("active");
        }

    });
}
function whenClickDownUp(input, ul, lis) {

    let count = -1;
    document.addEventListener("keydown", (e) => {
        if (ul.classList.contains("active")) {
            if (e.key === "ArrowDown") {
                if (count < ul.children.length - 1) {
                    count++;
                    count-1 >= 0 ? lis[count-1].classList.remove("hover") : null;
                    lis[count].classList.add("hover");
                }
            } else if (e.key === "ArrowUp") {
                if (count > 0) {
                    count--;
                    count+1 <= ul.children.length - 1 ? lis[count+1].classList.remove("hover") : null;

                    lis[count].classList.add("hover");
                }
            } else if (e.key === "Enter") {
                lis.forEach(li => {
                   if (li.classList.contains("hover")) {
                       li.classList.remove("hover");
                       li.click();
                   }
                });
            }
        }
    });
}
function ifExist(input, lis) {
    let value = input.value.trim();

    lis.forEach(li => {
       if (li.textContent.trim() === value) {
           input.removeAttribute("primaryKey");
           input.setAttribute("primaryKey", li.getAttribute("primaryKey"));
           return true;
       }
    });

    // return false;

}
function whenClickInButtonSearch(input, fetchButton, lis, label, nameClassInputs) {
    fetchButton.addEventListener("click", () => {
        ifExist(input, lis);

        getInfo(
            "sales",
            input.getAttribute("action"),
            input.getAttribute("primaryKey"),
            input.name,
            nameClassInputs,
        );
        input.value = '';
        label.classList.remove("up");
        fetchButton.classList.remove("active");


    });
}
function whenClickLis(lis, input, ul, fetchButton) {
    lis.forEach(li => {
        li.addEventListener("click", () => {
            input.value = li.textContent;
            ul.classList.remove("active");
            fetchButton.classList.add("active");
            input.setAttribute("primaryKey", li.getAttribute("primaryKey"));
        });
    });
}
searchInputs.forEach(searchInput => {
    let ul = searchInput.closest(".input-container").querySelector("ul");
    let lis = searchInput.closest(".input-container").querySelectorAll("li");
    let fetchButton = searchInput.parentElement.querySelector(".fetch-btn");
    let label = searchInput.parentElement.querySelector(".label-input");

    // When focus search input
    whenFocusInput(searchInput, label, ul);

    // When Blur input
    whenBlurInput(searchInput, label, ul, lis);

    // When Write in input
    whenWriteInInput(searchInput, fetchButton, lis)

    // When click li
    whenClickLis(lis, searchInput, ul, fetchButton);

    // Control button search
    whenClickInButtonSearch(searchInput, fetchButton, lis, label, "they-fill");

    // When Click up down
    whenClickDownUp(searchInput, ul, lis);
});
function buttonGetProducts(response) {
    const showSlideButton = document.getElementById("show-slide");
    showSlideButton.classList.add("active");

    console.log(response["productsCategory"])


}
function salesProcess(response, classNameInput) {
    flashMessage("success", response.message, 5000);

    if (classNameInput === "they-fill-product") {
        const imageProduct = document.getElementById("img-product");

        // Live Change Image
        if (response["Image"] != null) {
            imageProduct.setAttribute("src", response["Image"]);
        }

        // TODO: Show Products depend on categories

        // active show productions to this product category
        buttonGetProducts(response);
        
    }

    const theyFillInputs = document.querySelectorAll('.' + classNameInput);
    theyFillInputs.forEach(fillInput => {
        fillInput.value =  response[fillInput.name];
        fillInput.parentElement.querySelector("label").classList.add("up");
    });
}
function getInfo(controller, action, primaryKey, name, classNameInput) {
    let xml = new XMLHttpRequest();


    xml.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {

            console.log(xml.responseText)
            let response = JSON.parse(xml.responseText);

            if (response.result === "false" || response.result === false) {
                flashMessage("danger", response.message, 5000);
            } else {
                if (controller === "sales") {
                    salesProcess(response, classNameInput);
                }

            }
        }
    }


    xml.open("POST", "http://estore.local/"+ controller +"/" + action);
    xml.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    xml.send(`primaryKey=${primaryKey}&name=${name}`);
}





/*
* ----------------------------- Products ------------------------------------
*
* */



// Show Information popup
function whenKeyupFillInput(input, icon) {
    input.addEventListener("keyup", () => {
        if (input.value == null) {
            icon.classList.remove("active");
        } else {
            icon.classList.add("active");
        }
    });
}
function whenBlurFillInput(input, label, icon) {
    input.onblur = () => {

        icon.classList.remove("active");
        label.classList.remove("up")

        if (input.value !== '') {
            label.classList.add("up");
            icon.classList.add("active");
        } else {
            icon.classList.remove("active");
            label.classList.remove("up")
        }
    };
}
function whenClickInfoIcon(icon, statisticsPopup) {
    if (icon != null) {
        icon.addEventListener("click", () => {
            console.log(icon)
        });
    }
}
function whenFocusInputFill(input, label) {
    input.onfocus = () => {
      // label.classList.add("up");
    };
}
const searchInputsProducts = document.querySelectorAll(".search-input-product");
const theyFillInputs = document.querySelectorAll(".fill-product");
const statisticsPopups = document.querySelectorAll("#statistics-popup");

// Get Products
searchInputsProducts.forEach(searchInputsProduct => {

    let ul = searchInputsProduct.closest(".input-container").querySelector("ul");
    let lis = searchInputsProduct.closest(".input-container").querySelectorAll("li");
    let fetchButton = searchInputsProduct.parentElement.querySelector(".fetch-btn");
    let label = searchInputsProduct.parentElement.querySelector(".label-input");

    // When focus search input
    whenFocusInput(searchInputsProduct, label, ul);

    // When Blur input
    whenBlurInput(searchInputsProduct, label, ul, lis);

    // When Write in input
    whenWriteInInput(searchInputsProduct, fetchButton, lis)

    // When click li
    whenClickLis(lis, searchInputsProduct, ul, fetchButton);

    // Control button search
    whenClickInButtonSearch(searchInputsProduct, fetchButton, lis, label, "they-fill-product");

    // When Click up down
    whenClickDownUp(searchInputsProduct, ul, lis);
});
theyFillInputs.forEach(theyFillInput => {
    let infoIcon = theyFillInput.parentElement.querySelector(".info-icon");
    let statisticsPopup = theyFillInput.parentElement.querySelector("#statistics-popup");
    let label = theyFillInput.parentElement.querySelector("label");


    whenFocusInputFill(theyFillInput, label)

    whenKeyupFillInput(theyFillInput, infoIcon);

    whenBlurFillInput(theyFillInput, label, infoIcon);

    whenClickInfoIcon(infoIcon, statisticsPopup);


 });


// Remove Container table Popup
const xButtonContainer = document.getElementById("remove-container-table-popup");

if (xButtonContainer != null) {
    xButtonContainer.addEventListener("click", () => {
        xButtonContainer.closest("#container-table-popup").classList.remove("active");
    });
}