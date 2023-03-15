
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
function whenClickInButtonSearch(input, fetchButton, lis, label, nameClassInputs, to) {
    fetchButton.addEventListener("click", () => {
        ifExist(input, lis);

        getInfo(
            to,
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
    whenClickInButtonSearch(searchInput, fetchButton, lis, label, "they-fill", "sales");

    // When Click up down
    whenClickDownUp(searchInput, ul, lis);
});
function salesProcess(response, classNameInput) {
    flashMessage("success", response.message, 5000);

    if (classNameInput === "they-fill-product") {
        const imageProduct = document.getElementById("img-product");

        // Live Change Image
        if (response["Image"] != null) {
            imageProduct.setAttribute("src", response["Image"]);
        }

        // TODO: Show Products depend on categories
    }

    const theyFillInputs = document.querySelectorAll('.' + classNameInput);
    theyFillInputs.forEach(fillInput => {
        fillInput.value =  response[fillInput.name];
        if (fillInput.hasAttribute("to")) fillInput.setAttribute("to", response["ClientId"]);
        fillInput.parentElement.querySelector("label").classList.add("up");
    });
}

/**
 * Summary. fetch data from db
 *
 * Description.
 *  function to fetch data from db and handel it by create
 *  for example we used this function to simplify make fetch items easier for the user;
 *  the user write name product for example and fill all (get all data from db)
 *  data for chosen product in field (Easier than filling them in manually)
 *
 *   @since 2/28/2023
 *   @param {string} controller the name controller you want to go (sales for example)
 *   @param {string} action name action you will to apply
 *          important note (the name action must be contained Ajax word case-sensitive)
 *  @param {string} primaryKey this primary key to select row from db
 *  @param {string} name name value check if is set post method or not (or controller)
 *  @param {string} classNameInput to select input you want to fill (by get all input the same class name)
 *
 *
 *  @return {void} return void value
 *
 *  @author Feras Barahmeh
 *  @version 1.1
 *
 * */
function getInfo(controller, action, primaryKey, name, classNameInput) {
    let xml = new XMLHttpRequest();
    // TODO: update function (separate fill inputs)
    xml.onreadystatechange = function () {

        if (this.readyState === 4 && this.status === 200) {

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
function whenClickInfoIcon(icon) {
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
    whenClickInButtonSearch(searchInputsProduct, fetchButton, lis, label, "they-fill-product", "sales");

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

    whenClickInfoIcon(infoIcon);


 });


// Remove Container table Popup
const xButtonContainer = document.getElementById("remove-container-table-popup");

if (xButtonContainer != null) {
    xButtonContainer.addEventListener("click", () => {
        xButtonContainer.closest("#container-table-popup").classList.remove("active");
    });
}


// Nav Popup
const sectionsButtons = document.querySelectorAll(".button-section");



// Switch between sections
sectionsButtons.forEach( sectionsButton => {

    sectionsButton.addEventListener("click", () => {
        if (! sectionsButton.classList.contains("active")) {
            document.querySelectorAll(".container-section").forEach(container => {
                if (container.getAttribute("for") === sectionsButton.getAttribute('id')) {
                    container.classList.add("active");
                    sectionsButton.classList.add("active");
                } else {
                    sectionsButtons.forEach(button => {button.classList.remove("active")});
                    container.classList.remove("active");
                }

            });

            sectionsButton.classList.add("active");
        }
    });
});

// drop down item container
function whenActiveFromAllDropItemButton(dropItemButtons, dropItemButton) {
    dropItemButtons.forEach(button => {
        if (button !== dropItemButton) {
            button.classList.remove("active");
            button.closest(".item").querySelector(".data-item").classList.remove("active");
            button.lastElementChild.classList.remove("angle-rotate");
        } else {
            dropItemButton.classList.toggle("active");
        }
    });
}
const dropItemButtons = document.querySelectorAll(".drop-item");

dropItemButtons.forEach(dropItemButton => {
   dropItemButton.addEventListener("click", (e) => {
       whenActiveFromAllDropItemButton(dropItemButtons, dropItemButton)
       dropItemButton.closest(".item").querySelector(".data-item").classList.toggle("active");

       dropItemButton.lastElementChild.classList.toggle("angle-rotate");
   });
});

// Search in nav popup
const searchNavPopups = document.querySelectorAll(".search-nav-popup");

searchNavPopups.forEach(searchNavPopup => {
   const sectionContainer = searchNavPopup.closest(".container-section");
   const items = sectionContainer.querySelectorAll(".item");


   searchNavPopup.addEventListener("keyup", (e) => {
       const value = searchNavPopup.value.toLowerCase();

       items.forEach(item => {
          let name = item.querySelector("span.name").textContent.toLowerCase();

           if (name.search(value) === -1) {
               item.classList.add("not-found");
           } else {
               item.classList.remove("not-found");
           }


       });
   });
});

// show nav popup
const controlShowNavButton = document.getElementById("show-nav-popup-button");

controlShowNavButton.addEventListener("click", () => {
   const nav = document.getElementById("nav-popup");
   nav.classList.toggle("active");
});

// Close popup nav
const buttonCloseNavPopup = document.getElementById("close-nav");
buttonCloseNavPopup.addEventListener("click", () => {
   buttonCloseNavPopup.closest("#nav-popup").classList.remove("active");
});

// display info product in from nav product section to Product section
const showProductNavButtons = document.querySelectorAll("[for=products-section] .data-item #show-product-nav-button");

showProductNavButtons.forEach(showProductNavButton => {
    showProductNavButton.addEventListener("click", () => {
       getInfo(
   "sales",
            showProductNavButton.getAttribute("action"),
            showProductNavButton.getAttribute("primaryKey"),
            showProductNavButton.getAttribute("name"),
            "they-fill-product"
       );
        buttonCloseNavPopup.click();
    });
});

// hidden nav popup when click out it
document.addEventListener("click", (e) => {
    const popupNav = document.getElementById("nav-popup");

    if (! popupNav.contains(e.target) && ! controlShowNavButton.contains(e.target) ) {
        popupNav.classList.remove("active");
    }

});



// Active set discount value section is chosen

/**
 *
 * Description function to active discount section depend on type discount
 *
 * @param {Object} activeButton the input type clicked set is active value
 * @param {Object} disabledButton un active value discount
 * @param {Object} activeContainer the input we will set the value by the type chosen in clicked button
 * @param {Object} disabledContainer the input we will un set the value by the type chosen in clicked button
 *
 * */
function activeAddDiscountSection(activeButton, disabledButton, activeContainer, disabledContainer) {
    activeButton.addEventListener("click", (e) => {
        if (activeButton.contains(e.target) && activeButton.checked === false) {

            activeButton.checked = false;
            activeContainer.classList.remove("active");
            activeContainer.querySelector("input").value = '0';
            inputTotalPrice.value = fetchPriceCard();
        } else {
            activeContainer.classList.add("active");
            activeContainer.querySelector("input").focus();

            // remove all active inputs containers
            disabledButton.checked = false;
            disabledContainer.classList.remove("active");
            disabledContainer.querySelector("input").value = '0';
            inputTotalPrice.value = fetchPriceCard();
        }
    });
}
function calcDiscountTotalPrice(price) {
    let discount;
    if (ifSetDiscount()) {

        discount = inputContainerDiscountPercentage.querySelector("input");
        if (parseFloat(discount.value) > 0) {
            price -= price * discount.value / 100;
            price = price <= 0 || discount.value === '' ? 0 : price;
        }
        discount = inputContainerValuePercentage.querySelector("input");
        if (parseFloat(discount.value) > 0) {
            price -= parseFloat(discount.value);
            price = price <= 0 || discount.value === '' ? 0 : price;
        }
    }

    return price;
}
const discountPercentageButton  = document.querySelector("[discount-percentage=percentage]");
const discountValueButton       = document.querySelector("[discount-value=value]");
const inputContainerDiscountPercentage = document.querySelector("[discount-percentage-input]");
const inputContainerValuePercentage = document.querySelector("[discount-value-input]");


// Active Percentage Discount
activeAddDiscountSection(
    discountPercentageButton,
    discountValueButton,
    inputContainerDiscountPercentage,
    inputContainerValuePercentage,
);

// Active Value Discount
activeAddDiscountSection(
    discountValueButton,
    discountPercentageButton,
    inputContainerValuePercentage,
    inputContainerDiscountPercentage,
);

function fetchPriceCard() {
    let rows = cartTable.querySelectorAll("tbody tr");
    let sellPrice = 0;
    let tax = 0;
    let quantity = 0;
    let price = 0;

    if (rows.length > 1) { //  1 is image row
        rows.forEach(row => {
            if (! row.classList.contains("img")) {
                let tds = row.querySelectorAll("td");
                tds.forEach(td => {
                    if (td.hasAttribute("sellprice"))
                        sellPrice = parseFloat(td.getAttribute("sellprice"));
                    if (td.hasAttribute("tax"))
                        tax = parseFloat(td.getAttribute("tax"));
                    if (td.hasAttribute("quantitychoose"))
                        quantity = parseFloat(td.getAttribute("quantitychoose"));
                });
                price += ((sellPrice * quantity) + (tax * sellPrice));
                quantity = 0; tax = 0; sellPrice = 0;
            }
        });

    } else {
        flashMessage("warning", "No products in cart", 5000);
    }

    return calcDiscountTotalPrice(price);
}
function liveCalculateDiscountPercentage() {
    inputContainerDiscountPercentage.querySelector("input").addEventListener("input", (e) => {
        inputTotalPrice.value = '';
        inputTotalPrice.value = fetchPriceCard()
    });
    inputContainerValuePercentage.querySelector("input").addEventListener("input", (e) => {
        inputTotalPrice.value = '';
        inputTotalPrice.value = fetchPriceCard();
    });
}
liveCalculateDiscountPercentage();
// Remove product from
function removeProductFromCart(button) {
    button.addEventListener("click", () => {
        button.closest("tr").remove();
    });
}
const removeTrProducts = document.querySelectorAll("#remove-td-product");
removeTrProducts.forEach(removeTrProduct => {
    removeProductFromCart(removeTrProduct);
});
function addEmptyCartImage(table) {
    const imgEmptyCart = table.querySelector(".empty-cart-image");
    const trImage = imgEmptyCart.closest("tr");
    const parentTable = table.parentElement;
    if (table.querySelector("tbody").childElementCount <= 1) {
        trImage.classList.remove("hidden");
        imgEmptyCart.classList.add("active");
        parentTable.classList.remove("responsive-table");
    } else {
        trImage.classList.add("hidden");
        imgEmptyCart.classList.remove("active");
        parentTable.classList.add("responsive-table");
    }
}

// Add Info To cart Table

function fetchDataInvolves() {
    let result = {};
    const dataInvolves = document.querySelectorAll(".data-involves");
    dataInvolves.forEach(dataInvolve => {
        const to = dataInvolve.getAttribute("to");
        result[to] = [];

        const inputs = dataInvolve.querySelectorAll("input");
        inputs.forEach(input => {
            if (input.value === '' ){
                flashMessage("danger",
                    `Can't filed <b class="bold-font"> ${input.getAttribute("name")}</b> Be Empty Filed`,
                    5000);
                return false;
            }
            result[to].push(JSON.parse(`{"${input.getAttribute("name")}":"${input.value}"   }`));

        });
    });

    return result;
}
function createRow(details) {
    let tr = document.createElement("tr");

    for (const detailsKey in details) {
        let count = 0;
        for (const detailKey of details[detailsKey]) {
            let td = document.createElement("td");

            if (count === 0) {
                if (detailsKey === "transactionParty") {
                    td.setAttribute("no-change", '');
                } else if (detailsKey === "involves") {
                    td.setAttribute("no-repeat", '');
                }
            }
            count++;
            td.setAttribute("infoTo", detailsKey);
            let values = Object.entries(detailKey)[0];
            // This Line to simplify live calculate discount
            td.setAttribute(values[0], values[1]);

            td.innerHTML = values[1];
            tr.appendChild(td);
        }
    }
    let button = document.createElement("button");
    button.classList.add("danger-color");
    button.classList.add("no-bg");
    button.classList.add("cursor-pointer");
    button.setAttribute("id", "remove-td-product");

    let i = document.createElement('i');
    i.classList.add('fa');
    i.classList.add("fa-trash");

    removeProductFromCart(button);
    button.appendChild(i);


    let td = document.createElement("td");
    td.appendChild(button);
    tr.appendChild(td);


    return tr;
}
function emptyInvolvesInputs() {
    const involvesInputs  = document.querySelector("[to=involves]").querySelectorAll("input");
    involvesInputs.forEach(input => {
        input.value = '';
        input.parentElement.querySelector("label").classList.remove("up");
    });

}
function addToCartButtonActive() {
    const fieldsSectionOneInputs        = document.querySelector("[to=transactionParty]").querySelectorAll("input");
    const fieldsSectionTowInputsInputs  = document.querySelector("[to=involves]").querySelectorAll("input");

    let flag = true;

    fieldsSectionOneInputs.forEach(input => {
        if (input.value === '')  {
            flag = false;
        }
    });
    fieldsSectionTowInputsInputs.forEach(input => {
        if (input.value === '')  {
            flag = false;
        }
    });

    return flag;

}
function checkIfValidInvolves(tBody, details, newRow) {

    let flag = true;
    const noRepeatedTd = newRow.querySelectorAll("[no-repeat]");

    if (tBody.children.length >= 2) {
        const trs = tBody.querySelectorAll("tr");

        let content = [];
        let noChange = [];
        trs.forEach(tr => {
            if (! tr.classList.contains("img")) {
                tr.querySelectorAll("[no-repeat]").forEach(td => {
                    content.push(td.textContent);
                });
                tr.querySelectorAll("[no-change]").forEach(td => {
                    noChange.push(td.textContent);
                });
            }
        });


        noRepeatedTd.forEach(td => {
            if (content.includes(td.textContent)) {
                flag = false;
                flashMessage("danger", `Can't repeat ${td.textContent}`, 5000);
            }

            if (noChange[0] !== newRow.querySelector("[no-change]").textContent) {
                flag = false;
                flashMessage("danger", `Can't change client in the same involves`, 5000);
            }
        });
    } else {
        tBody.querySelector(".img").classList.add("hidden");
    }

    return flag;
}
function ifSetDiscount() {
    return discountPercentageButton.checked === true || discountValueButton.checked === true;
}
function setCurrentPrice() {
    currentPrice = fetchPriceCard();
}
function changeTotalPrice() {
    setCurrentPrice();
    inputTotalPrice.value = currentPrice.toString();
}
function setNumberProducts(table) {
    document.getElementById("total-products").value = table.children.length - 1; // -1 the row empty image
}
const addToCartButton = document.getElementById("add-to-cart-button");
const cartTable = document.querySelector(".products-carts-table");
const tBodyCartTable = cartTable.querySelector("tbody");
const inputTotalPrice = document.getElementById("total-price");
let currentPrice = 0;
addEmptyCartImage(cartTable)

addToCartButton.addEventListener("click", () => {

    if (addToCartButtonActive(addToCartButton) === true) {
        const details = fetchDataInvolves();

        const newRow = createRow(details);

        if (checkIfValidInvolves(tBodyCartTable, details, newRow)) {
            tBodyCartTable.appendChild(newRow);
            emptyInvolvesInputs();
            changeTotalPrice();
            setNumberProducts(tBodyCartTable);
        }

    } else {
        flashMessage("warning", "all information is required", 5000);
    }

});

// Create Invoices
function isHasPrivilege(controller, action, username, password) {
    const xmlRequest = new XMLHttpRequest();

    xmlRequest.onload = () => {
        if (xmlRequest.status === 200 && xmlRequest.readyState === 4) {
            let request = JSON.parse(xmlRequest.responseText);
            if (request.result === false) {
                flashMessage("danger", request.message, 5000);
            } else if(request.result === true) {
                flashMessage("success", request.message, 5000);
                confirmContainer.classList.remove("active");
            }
        }
    };

    xmlRequest.open("POST", "http://estore.local/" + controller + '/' + action);
    xmlRequest.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    xmlRequest.send(`UserName=${username}&Password=${password}`);
}
function checkIfStatusConfirmProcedureButton(confirmProcedureButton, inputUsernameConfirmProcedure, inputPasswordConfirmProcedure) {
    confirmProcedureButton.style.pointerEvents = "none";
    inputUsernameConfirmProcedure.addEventListener("keyup", () => {
        if (inputUsernameConfirmProcedure.value !== '' && inputPasswordConfirmProcedure.value !== '') {
            confirmProcedureButton.style.pointerEvents = "auto";
        } else {
            confirmProcedureButton.style.pointerEvents = "none";
        }
    });
    inputPasswordConfirmProcedure.addEventListener("keyup", () => {
        if (inputPasswordConfirmProcedure.value !== '' && inputUsernameConfirmProcedure.value !== '') {
            confirmProcedureButton.style.pointerEvents = "auto";
        } else {
            confirmProcedureButton.style.pointerEvents = "none";
        }
    });
}
const createInvoiceButton = document.getElementById("create-invoice-button");
const confirmContainer = document.getElementById("confirm-container");
const inputUsernameConfirmProcedure = document.getElementById("create-invoice-checker-username");
const inputPasswordConfirmProcedure = document.getElementById("create-invoice-checker-password");
const confirmProcedureButton = document.getElementById("confirm-procedure");
createInvoiceButton.addEventListener("click", () => {
    confirmContainer.classList.toggle("active");
});
document.addEventListener("click", (e) => {
    if (! confirmContainer.contains(e.target) && ! createInvoiceButton.contains(e.target) && ! confirmProcedureButton.contains(e.target)) {
        confirmContainer.classList.remove("active");
    }
});
checkIfStatusConfirmProcedureButton(confirmProcedureButton, inputUsernameConfirmProcedure, inputPasswordConfirmProcedure);
confirmProcedureButton.addEventListener("click", () => {
    if (inputUsernameConfirmProcedure.value === '' && inputPasswordConfirmProcedure.value !== '') {
        flashMessage("warning", "Can't Set Empty username", 5000);
    } else if (inputPasswordConfirmProcedure.value === '' && inputUsernameConfirmProcedure.value !== '') {
        flashMessage("warning", "Can't Set Empty password", 5000);
    } else {
        // Check if password and user has privilege create invoice
        isHasPrivilege(
            "sales",
            "checkIfHasPrivilegeUserAjax",
            inputUsernameConfirmProcedure.value,
            inputPasswordConfirmProcedure.value)
    }
});