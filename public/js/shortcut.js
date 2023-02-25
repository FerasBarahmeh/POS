// global funstions
function insertAfter(afterTo, newNode) {
    afterTo.parentNode.insertBefore(newNode, afterTo.nextSibling);
}

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

// Start Flash message
var flashMessageContainer = document.querySelector(".flash-message-container");
function createFlashMessage(type, message) {
    const p = document.createElement('p');
    p.classList.add("flash-message")
    p.classList.add(type);

    const typeMessage = document.createElement("span");
    typeMessage.classList.add("type-message");
    typeMessage.innerHTML = (type === "danger") ? "Error " : type;

    p.appendChild(typeMessage);

    const messageContinent = document.createElement("span");
    messageContinent.classList.add("message");
    messageContinent.innerHTML = message;

    p.appendChild(messageContinent);

    const times = document.createElement("span");
    times.classList.add("times");
    times.innerHTML = "&times";

    p.appendChild(times);

    return p;
}
/**
 * @author Feras Barahmeh
 * @version 1.0.0
 *
 * @param type specific type message
 * @param message content message
 * @param time select time before message hidden
 *
 * @return void
 * */
function flashMessage(type, message, time) {
    const flashMessageContainer = document.querySelector(".flash-message-container");
    const flashMessage = createFlashMessage(type, message);
    flashMessageContainer.appendChild(flashMessage);

    flashMessage.classList.add("fed-out");

    setTimeout(() => {
        flashMessageContainer.removeChild(flashMessage);
    }, time);
}
// End Flash Message

// start pagination table
function createPreviousBtn() {
    let previousBtn = document.createElement("button");
    previousBtn.classList.add("previous");
    previousBtn.innerText = "previous";

    if (currentSlide === 1) previousBtn.classList.add("un-active"); else  previousBtn.classList.remove("un-active");

    return previousBtn;
}
function createPaginationContainer(currentSlide=1, allSlidesNumber='100', rows=null) {
    let containerDiv = document.createElement("div");
    containerDiv.classList.add("pagination-container");

    // Statistics
    let divStatistics = document.createElement("div");
    divStatistics.classList.add("statistics");
    let spanNum = document.createElement("span");
    spanNum.classList.add("count");
    spanNum.innerText = currentSlide + ' ';
    divStatistics.appendChild(spanNum);

    // create from word
    let spanWord = document.createElement("span");
    spanWord.innerText = "from";
    divStatistics.appendChild(spanWord);

    let spanFrom = document.createElement("span");
    spanFrom.classList.add("from");
    spanFrom.innerText = ' ' + allSlidesNumber;

    divStatistics.appendChild(spanFrom);

    containerDiv.appendChild(divStatistics);

    // Create Bar
    let divBar = document.createElement("div");
    divBar.classList.add("bar");


    // previous button
    let previousBnt = createPreviousBtn(currentSlide)
    divBar.appendChild(previousBnt);

    // create pagination
    let divPagination = document.createElement("div");
    divPagination.classList.add("pagination");

    // Add Number In pagination

    divBar.appendChild(divPagination);

    // Next Button
    let nextBtn = document.createElement("button");
    nextBtn.classList.add("next");
    nextBtn.innerText = "Next";
    divBar.appendChild(nextBtn);

    containerDiv.appendChild(divBar);

    return containerDiv;
}
function getRowsTable(table) {
    return table.querySelectorAll("tbody tr");
}
function displaySlide(rows, tBody, rowsBerSlid, pageNumber) {
    tBody.innerHTML = '';
    pageNumber --;

    let start = rowsBerSlid * pageNumber;
    let end  = start + rowsBerSlid;

    let rowsSlide = Array.from(rows).slice(start, end);

    rowsSlide.forEach(row => {
        tBody.appendChild(row);
    });
}
function paginationButtons(slideNumber, rows) {
    let button = document.createElement("button");
    button.classList.add("num");
    button.textContent = slideNumber;

    if (currentSlide === slideNumber) {
        button.classList.add("active");
        currentBtn = button;
    }

    if (slideNumber === 1 || slideNumber === '1') {
        previous.classList.remove("un-visible");
    } else {
        previous.classList.add("un-visible");
    }



    button.addEventListener("click", () => {
        currentBtn.classList.remove("active");
        currentSlide = slideNumber;
        currentBtn = button;
        currentBtn.classList.add("active")

        if (currentSlide === 1) {
            previous.classList.add("un-active");
        } else {
            previous.classList.remove("un-active");
        }

        setupPagination(rows, tBody.parentElement.nextElementSibling.querySelector('.pagination'), shownRowsNumber)
        displaySlide(rows, tBody, shownRowsNumber, currentSlide);
        numberSlideContainer.innerText = slideNumber + ' ';
    });

    return button
}

function setupPagination(rows, pagination, rowsBerSlid) {

    pagination.innerHTML = '';
    let slideCount = Math.ceil(rows.length / rowsBerSlid);

    let start = currentSlide - numberPaginationInRow <= 0 ? 1 : currentSlide - numberPaginationInRow ;

    let end = currentSlide + numberPaginationInRow > slideCount ? slideCount : currentSlide + numberPaginationInRow ;

    for (let i = start; i <= end; i++) {
        let button = paginationButtons(i, rows);
        pagination.appendChild(button)
    }
}
let rows        = [];
let tableNumber = 0;
const shownRowsNumber = 5;
let currentSlide        = 1;
let allSlidesNumber = null;
let tBody = null;
let currentBtn = null;
let numberSlideContainer = null;
let numberPaginationInRow = 5;
let previous = null;
let next = null;

const tables = document.querySelectorAll(".pagination-table");
tables.forEach(table => {


    rows[tableNumber] = getRowsTable(table);
    let trs = rows[tableNumber];

    allSlidesNumber = Math.ceil(rows[tableNumber].length / shownRowsNumber);

    // Show First Slide
    let container = createPaginationContainer(currentSlide, allSlidesNumber, rows[tableNumber]);
    insertAfter(table, container);

    displaySlide(rows[tableNumber], table.querySelector("tbody"), shownRowsNumber, currentSlide);
    tBody = table.querySelector("tbody");

    previous = tBody.parentElement.nextElementSibling.querySelector(".previous");
    next = tBody.parentElement.nextElementSibling.querySelector(".next");

    previous.addEventListener("click", () => {

        let startPosition = (currentSlide * shownRowsNumber) - (shownRowsNumber * 2);

        let endPosition = startPosition + shownRowsNumber;

        let rows = [...trs];
        rows = rows.slice(startPosition, endPosition);


        tBody.innerHTML ='';
        rows.forEach(row => {
            tBody.appendChild(row);
        });

        currentBtn.classList.remove("active");
        if (startPosition === 0 && endPosition === shownRowsNumber) {
            previous.classList.add("un-active");
            currentBtn = container.querySelector(".pagination").firstElementChild;
        } else {
            currentBtn = currentBtn.previousElementSibling;
            previous.classList.remove("un-active");
        }

        next.classList.remove("un-active");
        currentBtn.classList.add("active");
        currentSlide--;


        // Shuffle Buttons
        shuffleButtons(container, table);
        let count = table.nextElementSibling.querySelector(".statistics .count");

        let num  =  count.innerText ;
        count.innerText = parseInt(num) - 1;

    });

    next.addEventListener("click", () => {

        let startPosition = currentSlide * shownRowsNumber ;
        let endPosition = startPosition + shownRowsNumber;

        let rows = [...trs];

        rows = rows.slice(startPosition, endPosition);

        tBody.innerHTML ='';
        rows.forEach(row => {
            tBody.appendChild(row);
        });

        currentBtn.classList.remove("active");

        if (endPosition - 1 === trs.length) {
            next.classList.add("un-active");
            currentBtn = container.querySelector(".pagination").lastElementChild;
        } else {
            currentBtn = currentBtn.nextElementSibling;
            next.classList.remove("un-active");
        }

        previous.classList.remove("un-active");
        currentBtn.classList.add("active");
        currentSlide++;


        // Shuffle Buttons

        shuffleButtons(container);
        let count = table.nextElementSibling.querySelector(".statistics .count");

        let num  =  count.innerText ;
        count.innerText = parseInt(num) + 1;

    });
    function shuffleButtons(container) {
        let pagination = container.querySelector(".pagination");
        pagination.innerHTML = '';
        let slideCount = Math.ceil(trs.length / shownRowsNumber);


        let start = currentSlide - numberPaginationInRow <= 0 ? 1 : currentSlide - numberPaginationInRow ;

        let end = currentSlide + numberPaginationInRow > slideCount ? slideCount : currentSlide + numberPaginationInRow ;

        for (let i = start; i <= end; i++) {
            let button = paginationButtons(i, trs);
            pagination.appendChild(button)
        }
    }


    setupPagination(rows[tableNumber], container.querySelector(".pagination"), shownRowsNumber, rows[tableNumber]);

    numberSlideContainer = table.nextElementSibling.querySelector(".statistics .count");
    numberSlideContainer.innerText = currentSlide + ' ';



    tableNumber++;
});