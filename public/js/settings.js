
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


