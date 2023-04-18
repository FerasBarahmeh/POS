// DOM variable
const findClientInputs = document.querySelectorAll(".find-client-input");
const searchInputs = document.querySelectorAll(".search");
const prominentElement = document.querySelectorAll(".list-identifier");
const listsIdentifier = document.querySelectorAll("[fetchClientBy]");
let identifierClient = null;
let clientInfo = null;
const clientSectionHTML = document.querySelector("[client]");

function addFlayClassToLabelWhenFocus(label, hasValue) {
    if (! hasValue && ! label.classList.contains("flay")) {
        label.classList.add("flay");
    }
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

function setClientInfo() {
    let inputs = clientSectionHTML.querySelectorAll("input");
    inputs.forEach(input => {
        let id = input.getAttribute("id");
        input.value = clientInfo[id];
        flayLabel(input);
        // changeStatusLabelActionInput(label, !! input.value);

    });

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
              setClientInfo();
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
          });

      });
   });
});

const showInfoInputs = document.querySelectorAll(".show-info");
showInfoInputs.forEach(showInfoInput => {
    changeStatusLabelActionInput(showInfoInput);
});

// Start Products
let productsIDs = [];
let productInfo = {};
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


            getProductInfo(id).then( (res) => {
                    productInfo[id] = JSON.parse(res);
                }
            )
            .finally(() => {
                setProductInfo(productInfo[id]);
                hiddenListIdentifier(ul);


                // change color border
                ul.closest(".partisan").style.borderColor = "var(--success-color-300)";

                flashMessage("success", productInfo[id]["message"], 5000);

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