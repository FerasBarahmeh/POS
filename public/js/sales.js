const DiscountType = {
    fixed:1,
    percentage: 0,
}
let messages = null;
const findClientInputs = document.querySelectorAll(".find-client-input");
const searchInputs = document.querySelectorAll(".search");
const prominentElement = document.querySelectorAll(".list-identifier");
const listsIdentifier = document.querySelectorAll("[fetchClientBy]");
let identifierClient = null;
let clientInfo = null;
const clientSectionHTML = document.querySelector("[client]");
const clientInfoHtml = document.querySelector(".info-client");
const snippetProductsTableHtml = document.getElementById("snippet-products");
const typePaymentHtml = document.getElementById("TypePayment");
const statusInvoiceHtml = document.getElementById("statusInvoice");

let  typePaymentValue = getValueOptionSection(typePaymentHtml)
let typePaymentName = getNameOptionSelection(typePaymentHtml);

let statusInvoiceValue = getValueOptionSection(statusInvoiceHtml);
let statusInvoiceName = getNameOptionSelection(statusInvoiceHtml);

const checkInputsHtml = document.querySelectorAll("input[type=checkbox]");
const discountHtml = document.getElementById("discount");
const applyDiscountBtn = document.getElementById("apply-discount");

let discountValue = null;

let totalPriceAfterDiscount = null;
const totalPriceHtml = document.getElementById("total-price");
let totalPriceWithTax = 0;
let totalPriceWithoutTax = 0;

function lenObj(obj) {
    return Object.keys(obj).length;
}
function getLanguage() {
    getMessages("sales", "getMessagesAjax", "sales.messages").then((result) => {
        messages = result;
        return result;
    });
}
getLanguage();
function addFlayClassToLabelWhenFocus(label, hasValue) {
    if (! hasValue && ! label.classList.contains("flay")) {
        label.classList.add("flay");
    }
}
function getValueOptionSection(selection) {
    return selection.options[selection.selectedIndex].value;
}
function getNameOptionSelection(selection) {
    return selection.options[selection.selectedIndex].text;
}
function removeFlayClassToLabel(input) {
    let inputContainer = input.parentElement;
    let label = inputContainer.querySelector("label");

    label.classList.remove("flay");
}
function addFlayToLabel(input) {
    let inputContainer = input.parentElement;
    let label = inputContainer.querySelector("label");
    label.classList.add("flay");

}
function addFlayClassToLabelWhenBlur(label, hasValue) {
    if (!hasValue && label.classList.contains("flay")) {
        label.classList.remove("flay");
    }
}

function changeStatusLabelActionInput(input) {
    let inputContainer = input.parentElement;
    let label = inputContainer.querySelector("label");

    input.addEventListener("focus", () => {
        addFlayClassToLabelWhenFocus(label, !!input.value);
    });
    input.addEventListener("blur", () => {
        addFlayClassToLabelWhenBlur(label, !!input.value);
    });
}
/**
 * Hidden search lists if you want hidden all lists and if you remove specific list
 * @param ul the list you want remove
 * @return void
 * */
function hiddenListIdentifier(ul=null) {
    if (! ul) {
        prominentElement.forEach(listIdentifier => {
            listIdentifier.classList.remove("active");
            listIdentifier.closest(".component-input-js").classList.remove("focus");
        });
    } else  {
        ul.classList.remove("active");
        ul.closest(".component-input-js").classList.remove("focus");
    }
}
function showListIdentifier(ul) {
    ul.classList.add("active");
    ul.closest(".component-input-js").classList.add("focus");
}
function whenFocusInFindInput(input) {
    let containerInput = input.closest(".component-input-js");
    let ul = containerInput.querySelector("ul");

    input.addEventListener("focus", () => {
        hiddenListIdentifier();
        showListIdentifier(ul);

    });
}

// Activate disabled for all input disabled
document.querySelectorAll("input[disabled]").forEach(input => {
    input.addEventListener("click", () => {
        input.disabled = true;
    });
    input.addEventListener("focus", () => {
        input.disabled = true;
    });
});

searchInputs.forEach(searchInput => {
    changeStatusLabelActionInput(searchInput);
});
findClientInputs.forEach(findClientInput => {
    whenFocusInFindInput(findClientInput);
});

function hiddenProminentElements() {
    document.addEventListener("click", (e) => {

        prominentElement.forEach(listIdentifier => {
            let container = listIdentifier.closest(".component-input-js");
            if (e.target.contains(container) ) {
                listIdentifier.classList.remove("active");
                container.classList.remove("focus");
            }
        });
    });
}
hiddenProminentElements();

async function getInfoClientReq(id) {

    return await fetch("http://estore.local/sales/getInfoClientAjax", {
        "method": "POST",
        "headers": {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        "body": `id=${id}`,
    })
        .then(function(res){ return res.json(); })
        .then(function(data){
            return JSON.stringify(data);
        });

}
function flayLabel(inputLabel) {
    let label = inputLabel.parentElement.querySelector("label");
    label.classList.add("flay");
}
function dropLabel(inputLabel) {
    let label = inputLabel.parentElement.querySelector("label");
    label.classList.remove("flay");
}

function fillInputsClientInfo() {
    let inputs = clientSectionHTML.querySelectorAll("input");
    inputs.forEach(input => {
        let id = input.getAttribute("id");
        input.value = clientInfo[id];
        flayLabel(input);
    });
}
function setClientInfo() {
    let nameClient = clientInfoHtml.querySelector(".name-client");
    let addressClient = clientInfoHtml.querySelector(".address");
    nameClient.textContent = clientInfo.Name;
    addressClient.textContent = clientInfo["Address"];
}
function calcTotalPrice() {
    totalPriceWithTax = 0;
    totalPriceWithoutTax = 0;
    for (const productsKey in products) {
        let price = parseFloat(products[productsKey]["SellPrice"]);
        let tax = parseFloat(products[productsKey]["Tax"]);

        totalPriceWithTax += price + (price * tax);
        totalPriceWithoutTax += price;
    }
}
function calcTax(price, tax) {
    return  parseFloat(price) + (parseFloat(price) * parseFloat(tax));
}
function createRowSnippetProductTable(rowInfo, currency) {

    let tr = document.createElement("tr");

    let name = document.createElement("td");
    name.textContent = rowInfo.Name;

    tr.appendChild(name);

    let qty = document.createElement("td");
    qty.textContent = rowInfo["QuantityChoose"] + " " + rowInfo["Unit"];
    tr.appendChild(qty);

    let tax = document.createElement("td");
    tax.textContent = rowInfo["Tax"];
    tr.appendChild(tax);

    let price = document.createElement("td");
    let priceWithTax = calcTax(rowInfo["SellPrice"], rowInfo["Tax"]);


    price.textContent = currency + " " + rowInfo["SellPrice"];
    tr.appendChild(price);

    let total = document.createElement("td");
    total.textContent = currency + " " + parseFloat(priceWithTax) * parseFloat(rowInfo["QuantityChoose"]);
    tr.appendChild(total);

    return tr;

}
function fillSnippetProductsTable(currency='$') {
    let tbody = snippetProductsTableHtml.querySelector("tbody");
    removeAllChildNodes(tbody);
    for (const id in products) {
        let row = createRowSnippetProductTable(products[id], currency)
        tbody.appendChild(row);
    }
}
listsIdentifier.forEach(listIdentifier => {

   let lis = listIdentifier.querySelectorAll("li");

   lis.forEach(li => {
       let ul = li.parentElement;
      li.addEventListener("click", () => {
          identifierClient = li.getAttribute("ClientId");

          getInfoClientReq(identifierClient).then( (res) => {
              clientInfo = JSON.parse(res);
            }
          )
          .finally(() => {
              fillInputsClientInfo();
              hiddenListIdentifier(ul);
              flashMessage("success", clientInfo["message"], 5000);

              // change color border
              ul.closest(".partisan").style.borderColor = "var(--success-color-300)";

              // Scroll window to next section
              window.scrollBy({
                  top: 100,
                  left: 0,
                  behavior: "smooth",
              });
              setClientInfo();
          });

      });
   });
});

const showInfoInputs = document.querySelectorAll(".show-info");
showInfoInputs.forEach(showInfoInput => {
    changeStatusLabelActionInput(showInfoInput);
});

// Start Products
let products = {};
let productsHTML = {};
let currentProductSelected = null;
let idCurrentProductSelected = null;

const productsListHTML = document.querySelectorAll("[fetchProductBy]");

async function getProductInfo(id) {

    return await fetch("http://estore.local/sales/getInfoProductAjax", {
        "method": "POST",
        "headers": {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        "body": `id=${id}`,
    })
        .then(function(res){ return res.json(); })
        .then(function(data){
            return JSON.stringify(data);
        });
}

function setProductInfo(product) {
    let inputs = document.querySelector("[product]").querySelectorAll("input");
    inputs.forEach(input => {
        let idInput = input.getAttribute("id");
        flayLabel(input);
        input.value = product[idInput];
    });
}
productsListHTML.forEach(ul => {

    let lis = ul.querySelectorAll("li");

    lis.forEach(li => {

        li.addEventListener("click", () => {
            let id = li.getAttribute("ProductID");
            let ul = li.parentElement;


            getProductInfo(id).then((res) => {
                    let info = JSON.parse(res);

                    if (info.result) {
                        idCurrentProductSelected = info["ProductId"];
                        currentProductSelected = {"id":info["ProductId"], info:info};
                        activationDisabledBtn(addToCartSalesHTML);
                        setProductInfo(info);
                    } else {
                        flashMessage("danger", info.message, 5000);
                    }
                }
            )
            .finally(() => {
                hiddenListIdentifier(ul);

                // change color border
                ul.closest(".partisan").style.borderColor = "#65cd65";

                flashMessage("success", currentProductSelected.info["message"], 5000);

                // Scroll window to next section
                window.scrollBy({
                    top: 100,
                    left: 0,
                    behavior: "smooth",
                });
            });

        });
    });
});

// Add To Cart
const addToCartSalesHTML = document.getElementById("add-to-cart-sales");
const cartSalesHTML = document.getElementById("cart-sales");
const productsInputs = document.querySelector("[product]").querySelectorAll("input");
function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}
function cleanInputs(inputs) {
    inputs.forEach(input => {
       input.value = '';
        removeFlayClassToLabel(input);
    });
}
function removeProductFromOrder(id) {
    productsHTML[id].remove();
    delete productsHTML[id];
    delete products[id];
}
function addEventRemoveOrder(btn, id) {
    btn.addEventListener("click", () => {
        removeProductFromOrder(id);
        if (lenObj(products) === 0) {
            resitDiscountVariable();
            resitDiscountInput();
            unCheckInputs(checkInputsHtml);
            disabledActiveBtn(applyDiscountBtn);
        }
        calcTotalPrice();
        fillSnippetProductsTable();
        calculateDiscount(getTypeDiscount());
        fillTotalPriceWithDiscountInput();
    });
}
function createBtnEdit() {

    let btnEdit = document.createElement("button");
    btnEdit.classList.add("edit-icon");

    let iEdit = document.createElement("i");
    iEdit.classList.add("fa");
    iEdit.classList.add("fa-edit");
    iEdit.setAttribute("aria-hidden", "true");

    btnEdit.appendChild(iEdit);
    return btnEdit;
}
function createBtnDelete() {
    let btnDel = document.createElement("button");
    btnDel.classList.add("del-icon");
    btnDel.classList.add("del-from-cart-sales");

    let iEdit = document.createElement("i");
    iEdit.classList.add("fa");
    iEdit.classList.add("fa-trash");
    iEdit.setAttribute("aria-hidden", "true");

    btnDel.appendChild(iEdit);
    return btnDel;
}
function addEventEditOrder(btn, id) {
    btn.addEventListener("click", () => {

        let inputs = document.querySelector("[product]").querySelectorAll("input");
        let product = products[id]
        inputs.forEach(input => {
            let nameId = input.getAttribute("id");
            input.value = product[nameId];
            addFlayToLabel(input);
        });

        idCurrentProductSelected = id;
        currentProductSelected = {"id":id, "info":product};
        activationDisabledBtn(addToCartSalesHTML);
        removeProductFromOrder(id);
        fillSnippetProductsTable();
    });
}
function createRowProduct(info) {
    let tr = document.createElement("tr");
    let id = info["ProductId"];
    tr.setAttribute("id", id);

    let name = document.createElement("th");
    name.innerText = info["Name"];

    let quantity = document.createElement("th");
    quantity.innerText = info["QuantityChoose"];

    let barcode = document.createElement("th");
    barcode.innerText = info["BarCode"];

    let unit = document.createElement("th");
    unit.innerText = info["Unit"];

    let sellPrice = document.createElement("th");
    sellPrice.innerText = info["SellPrice"];


    let tax = document.createElement("th");
    tax.innerText = info["Tax"];

    let control = document.createElement("th");

    let btnEdit = createBtnEdit();
    addEventEditOrder(btnEdit, id);

    let btnDel = createBtnDelete();
    addEventRemoveOrder(btnDel, id);

    control.appendChild(btnEdit);
    control.appendChild(btnDel);


    tr.appendChild(name);
    tr.appendChild(quantity);
    tr.appendChild(barcode);
    tr.appendChild(unit);
    tr.appendChild(sellPrice);
    tr.appendChild(tax);
    tr.appendChild(control);

    productsHTML[id] = tr;

    return tr;
}
function addProductsToCartSales() {
    let tBodyCart = cartSalesHTML.querySelector("tbody");
    removeAllChildNodes(tBodyCart);
    for (const id in products) {
        let row = createRowProduct(products[id]);
        tBodyCart.appendChild(row);
    }
}
function resitCurrentProduct() {
    currentProductSelected = null;
    idCurrentProductSelected = null;
}
function disabledActiveBtn(disableBtn) {
    disableBtn.setAttribute("disabled", "disabled");
    disableBtn.classList.add("disabled");
    disableBtn.classList.remove("activation");
}
function activationDisabledBtn(disableBtn) {
    disableBtn.removeAttribute( "disabled");
    disableBtn.classList.add("activation");
    disableBtn.classList.remove("disabled");
}
function fillTotalPriceInput() {
    totalPriceHtml.textContent = totalPriceWithTax.toFixed(3);
}
function fillTotalPriceWithDiscountInput() {
    totalPriceHtml.textContent = parseFloat(totalPriceAfterDiscount).toFixed(3);
}
function resitDiscountInput() {
    discountHtml.value = '';
}
addToCartSalesHTML.addEventListener("click", () => {

    if (idCurrentProductSelected !== null && currentProductSelected !== null) {
        products[currentProductSelected.id] = currentProductSelected.info;
        setChangeDefaultValuesInInputs();
        addProductsToCartSales();
        calcTotalPrice();
        fillSnippetProductsTable();
        resitCurrentProduct();
        cleanInputs(productsInputs);
        disabledActiveBtn(addToCartSalesHTML);
        fillTotalPriceInput();
    }
});

// change information product before add to cart
const unDisabledInputsProduct = document.querySelector("[product]").querySelectorAll("[un-disabled]");

function changeInfoProduct(input) {
    let newVal = input.value;
    let idName = input.getAttribute("id");

    if (idCurrentProductSelected !== null && currentProductSelected != null) {
        products[idCurrentProductSelected][idName] = newVal;
    }
}
function setChangeDefaultValuesInInputs() {
    unDisabledInputsProduct.forEach(input => {
        changeInfoProduct(input);
    });
}

// Tools Bar Button
const toolsBarBtn = document.getElementById("tools-bar-btn");
const clearInputsBtn = document.getElementById("clear-inputs");
toolsBarBtn.addEventListener("click", () => {
    let ul = toolsBarBtn.parentElement.querySelector("ul").classList.toggle("active");
});

if (clearInputsBtn != null) {
    clearInputsBtn.addEventListener("click", () => {
        cleanInputs(productsInputs);
    });
}

// Change Status Radio inputs
function uncheckInput(input) {
    input.checked = false;
}
function unCheckInputs(inputs) {
    inputs.forEach(input => {
       uncheckInput(input);
    });
}
function ifHasDiscount() {
    let value = Number(discountHtml.value);
    let flag = null;
    for (let i = 0; i < checkInputsHtml.length; i++) {
        if (checkInputsHtml[i].checked === true) {
            flag = true;
            break;
        } else {
            flag = false;
        }
    }
    return value > 0 && flag;
}
function getTypeDiscount() {
    let checkedValue = null;
    if (ifHasDiscount()) {
        checkInputsHtml.forEach(input => {
           if (input.checked) {
               checkedValue = parseInt(input.value);
           }
        });
    }
    return checkedValue;
}
function changeStatusActiveDiscount() {
    if (ifHasDiscount()) {
        activationDisabledBtn(applyDiscountBtn);
    } else {
        disabledActiveBtn(applyDiscountBtn);
    }
}
function resitDiscountVariable() {
    totalPriceAfterDiscount = null;
    discountValue = 0;
}
// type discount inputs
checkInputsHtml.forEach(input => {
    input.addEventListener("click", () => {
        let inputChecked = input.checked;
        unCheckInputs(checkInputsHtml);
        input.checked = !!inputChecked;
        changeStatusActiveDiscount();
        if (! ifHasDiscount()) {
            resitDiscountVariable();
            fillTotalPriceInput();
            resitDiscountInput();
        }
    });
});
discountHtml.addEventListener("keyup", (e) => {
    changeStatusActiveDiscount();
    if (e.target.value === '') {
        resitDiscountVariable();
        fillTotalPriceInput();
        resitDiscountInput();
    } else {
        discountValue = parseFloat(e.target.value);
    }
});
function calculateDiscount(valueTypeDiscount) {
    totalPriceAfterDiscount = totalPriceWithTax;

    if (valueTypeDiscount === DiscountType.fixed) {
        totalPriceAfterDiscount -= discountValue;
    } else if(valueTypeDiscount === DiscountType.percentage) {
        totalPriceAfterDiscount *= discountValue / 100.0;
    }
}

function isValidDiscount() {
    let valueTypeDiscount = getTypeDiscount();

    if (lenObj(products) === 0) {
        console.log("in products")
        flashMessage("danger", messages["message_no_products_in_cart"], 5000);
        return false;
    }
    if (! (valueTypeDiscount === DiscountType.fixed || valueTypeDiscount === DiscountType.percentage)) {
        flashMessage("danger", messages["message_cant_change_type_discount"], 5000);
        return false;
    }

    return true;
}
applyDiscountBtn.addEventListener("click", () => {
    if (isValidDiscount()) {
        calculateDiscount(getTypeDiscount());
        totalPriceHtml.textContent = totalPriceAfterDiscount.toFixed(3);
    }
});
const canselOfferBtn = document.getElementById("cansel-offer");
canselOfferBtn.addEventListener("click", () => {
    resitDiscountInput();
    resitDiscountVariable();
    unCheckInputs(checkInputsHtml);
    changeStatusActiveDiscount();
    // totalPriceHtml.textContent = totalPriceWithTax;
    fillTotalPriceInput()
});