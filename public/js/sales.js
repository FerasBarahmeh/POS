// DOM variable
const findClientInputs = document.querySelectorAll(".find-client-input");
const searchInputs = document.querySelectorAll(".search");
const listsIdentifier = document.querySelectorAll(".list-identifier");
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
        listsIdentifier.forEach(listIdentifier => {
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
searchInputs.forEach(searchInput => {
    changeStatusLabelActionInput(searchInput);
});
findClientInputs.forEach(findClientInput => {
    whenFocusInFindInput(findClientInput);
});

function hiddenAllListIdentifierList() {
    document.addEventListener("click", (e) => {

        listsIdentifier.forEach(listIdentifier => {
            let container = listIdentifier.closest(".component-input-js");
            if (e.target.contains(container) ) {
                listIdentifier.classList.remove("active");
                container.classList.remove("focus");
            }
        });

    });
}
hiddenAllListIdentifierList();

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
function setClientInfo() {
    let inputs = clientSectionHTML.querySelectorAll("input");
    inputs.forEach(input => {
        let id = input.getAttribute("id");
        let label = input.parentElement.querySelector("label");
        input.value = clientInfo[id];
        label.classList.add("flay");
        changeStatusLabelActionInput(label, !! input.value);

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
              console.log(clientInfo["message"])
              flashMessage("success", clientInfo["message"], 5000);

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