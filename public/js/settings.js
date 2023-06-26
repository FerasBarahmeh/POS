
// activate section li

let sectionSectionButtons = document.querySelectorAll("[section-setting]");
let currentActiveSectionBtn = getCurrentActiveSettingSectionButton(sectionSectionButtons);
let currentSection = document.querySelector("section.section.active");
// add active class in section btn when click
sectionSectionButtons.forEach(btn => {
    btn.addEventListener("click", () => {
        if (! btn.classList.contains("active")) {
            currentActiveSectionBtn.classList.remove("active");
            btn.classList.add("active");
            currentActiveSectionBtn = btn;
            // Show section
            let attributeName = btn.getAttribute("id");
            let section = document.querySelector("[for=" + attributeName + "]");

            currentSection.classList.remove("active");
            section.classList.add("active");
            currentSection = section;
        }
    }) ;
});


function toggleClassActive(parent) {
    let mainLayer = parent.querySelector("[main-layer]"),
        secondaryLayer = parent.querySelector("[secondary-layer]");
    mainLayer.classList.toggle("un-active");
    secondaryLayer.classList.toggle("active");
}
function getCurrentActiveSettingSectionButton(buttons) {
    let currentBtn = null;
    buttons.forEach(btn => {
        if (btn.classList.contains("active")) {
            currentBtn = btn;
        }
    });
    return currentBtn;
}
const showEditSectionButtons = document.querySelectorAll(".btn-show-edit-section");

showEditSectionButtons.forEach(button => {

   button.addEventListener("click", () => {
           // close all opened
           showEditSectionButtons.forEach(btn => {
               let field = btn.closest("[field]");
               let mainLayer = field.querySelector("[main-layer]"),
                   secondaryLayer = field.querySelector("[secondary-layer]");

               mainLayer.classList.remove("un-active");
               secondaryLayer.classList.remove("active");

           });
         let field = button.closest("[field]");
         toggleClassActive(field);
   });
});

const unDoButtons = document.querySelectorAll("[undo-btn]");
if (unDoButtons) {
    unDoButtons.forEach(btn => {
        btn.addEventListener("click", () => {
            let field = btn.closest("[field]");
            toggleClassActive(field);
        });
    });
}

// set current value in inputs
let secondaryLayers = document.querySelectorAll("[secondary-layer]");
secondaryLayers.forEach(layer => {
   let input = layer.querySelector("input");
   let field =  input.closest("[field]");
    input.value = field.querySelector("[main-layer] .value").textContent;
});


// Change Values
const savedButtons = document.querySelectorAll("button.save");
let nameTables = {
    "general-setting" : "subset_information_users",
    "account" : "settings",
    "notification" : "notification"
};
savedButtons.forEach(btn => {
    let field = btn.closest("[field]");
    let currentValue = field.querySelector("input").value.trim();
    let section = field.closest("section");
    let nameTable = nameTables[section.getAttribute("for")];
    let nameField = field.getAttribute("name_field");
    nameField = nameField.charAt(0).toUpperCase() + nameField.slice(1);

    btn.addEventListener("click", () => {
        let newValue = field.querySelector("input").value.trim();

        fetch("http://estore.local/settings/updateFieldValueAjax", {
            "method": "POST",
            "headers": {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            "body": `table=${nameTable}&column=${nameField}&newValue=${newValue}`,
        })
            .then(function(res){ return res.json(); })
            .then(function(data){

                if (data["result"]) {
                    fetch("http://estore.local/settings/changUserValueAjax", {
                        "method": "POST",
                        "headers": {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        "body": `extraInfo=extraUserInfo&key=${nameField}&value=${newValue}`,
                    }).then(() => {
                        let value = field.querySelector(".value");

                        value.textContent = '';
                        value.textContent = newValue;
                        field.querySelector("input").value = newValue
                        toggleClassActive(field);
                    });


                } else {

                    console.log(data["result"])
                    for (const error of data["errors"]) {
                        let p = document.createElement("p");
                        p.classList.add("error-message");
                        p.classList.add("active");
                        p.textContent = error;
                        field.prepend(p);
                    }
                }
            })



    });
});
