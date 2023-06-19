let mess = null;

getMessages("index", "getMessagesAjax", "template.common").then((res) => {
    mess = res; return res;})
// global functions
function insertAfter(afterTo, newNode) {
    afterTo.parentNode.insertBefore(newNode, afterTo.nextSibling);
}

// TODO: Convert Structure Delete To AJAX
const cardPopup = document.querySelector(".card");
// const classCard = [...cardPopup.classList];
function hiddenPopup(e) {
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
function createSymbol(type) {
    const symbol = document.createElement("span");
    symbol.classList.add("flash-symbol");
    symbol.classList.add(type)
    const containerSymbol = document.createElement("span");

    switch (type) {
        case "danger":
            containerSymbol.innerHTML = 'X';
            break;

        case "success":
            const i = document.createElement('i');
            i.classList.add("fa");
            i.classList.add("fa-check");
            containerSymbol.appendChild(i);
            break;
        case "warning":
            const exclamation = document.createElement('i');
            exclamation.classList.add("fa");
            exclamation.classList.add("fa-radiation");
            containerSymbol.appendChild(exclamation);
            break;


        case "info":
            containerSymbol.innerHTML = '!';
            break;
    }
    symbol.appendChild(containerSymbol);
    return symbol;
}

function createFlashMessage(type, message) {
    const p = document.createElement('p');
    p.classList.add("flash-message")
    p.classList.add(type);


    p.appendChild(createSymbol(type));

    const typeMessage = document.createElement("span");
    typeMessage.classList.add("type-message");
    typeMessage.innerHTML = (type === "danger") ? "Error : " : type + ' : ';

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
 * *@version 1.2
 *
 * @param type specific type message
 * @param message content message
 * @param time select time before message hidden
 *
 * @return void
 * */
function flashMessage(type, message, time=5000) {
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

const tables = document.querySelectorAll(".pagination-table");



class PaginationTable {

    constructor(table) {
        this.table = table;
        this.tBody = this.getTBody();
        this.currentRow = 0;
        this.currentSlidePos = 1;
        this.ulBtns = null;
        this.rows = this.getRowsAsArray();
        this.numberRowsInSlide = 4;
        this.countSlides = Math.ceil(this.rows.length / this.numberRowsInSlide);
        this.prevBtn = null;
        this.nextBtn = null;
        this.currentSlideDiv = null;
        this.paginationSection = null;
        this.isUpperBar = this.table.classList.contains("upper");
        this.fromDiv = null;
    }
    getRowsAsHtmlObj() {
        return this.tBody.querySelectorAll("tr");
    }
    getRowsAsArray() {
        let trs = [];
        let rows = this.getRowsAsHtmlObj()
        for (const rowsKey in rows) {
            if (rows.hasOwnProperty(rowsKey)) {
                trs.push(rows[rowsKey]);
            }
        }
        return trs;
    }
    getTBody() {
        return this.table.querySelector("tbody");
    }
    resitALl (e=null) {
        this.numberRowsInSlide = Number(e.target.value)
        this.currentRow = 0;
        this.currentSlidePos = 1;
        this.countSlides = Math.ceil(this.rows.length / this.numberRowsInSlide);
    }
    whenChangeShowRowsValue(e) {
        //TODO: add value to local storage
        this.resitALl(e)
        this.fromDiv.textContent = '';
        this.fromDiv.textContent = this.countSlides;
        this.shuffleButtons();
        this.showSlide()
    }
    createPaginationBar() {

        let barPaginationDiv = document.createElement("div");
        barPaginationDiv.classList.add("bar-pagination");

        // Create statistics div
        let statisticsDiv = document.createElement("div");
        statisticsDiv.classList.add("statistics");
        let numberSlideDiv = document.createElement("number-slide");
        let label = document.createElement("label");
        // label.textContent = mess["text_number_rerecord_in_slide"];
        label.textContent = "Number Rerecord In Slide";
        numberSlideDiv.appendChild(label);

        // Create select
        let select = document.createElement("select");
        select.addEventListener("change", (e) => {this.whenChangeShowRowsValue(e)})


        // Create Options
        for (let i = 1; i <= 5; i++) {
            let opt = document.createElement("option");
            opt.value = i * 2;
            if ( i * 2 === 4) {
                opt.selected = true;
            }
            opt.textContent = i * 2;
            select.appendChild(opt);
        }

        numberSlideDiv.appendChild(select);
        statisticsDiv.appendChild(numberSlideDiv);
        barPaginationDiv.appendChild(statisticsDiv);

        // create counter hint
        let counterDiv = document.createElement("div");
        counterDiv.classList.add("counter");
        // create number current slide div
        let currentSlideDiv = document.createElement("div");
        currentSlideDiv.textContent = this.currentSlidePos;
        this.currentSlideDiv = currentSlideDiv;
        counterDiv.appendChild(currentSlideDiv);
        // create from span
        let fromSpan = document.createElement("span");
        // fromSpan.textContent = mess["text_from"];
        fromSpan.textContent = "from";
        counterDiv.appendChild(fromSpan)
        // create from div
        let fromDiv = document.createElement("div");
        fromDiv.textContent = this.countSlides;
        this.fromDiv = fromDiv;
        counterDiv.appendChild(fromDiv);

        statisticsDiv.appendChild(counterDiv);

        // start buttons
        let buttonsDiv = document.createElement("div");
        buttonsDiv.classList.add("buttons");

        // create previous button
        let previousBtn = document.createElement("button");
        previousBtn.classList.add("previous");
        previousBtn.textContent = "Previous"
        buttonsDiv.appendChild(previousBtn);
        this.prevBtn  = previousBtn;

        // create next button
        let nextBtn = document.createElement("button");
        nextBtn.classList.add("next");
        nextBtn.classList.add("active");
        nextBtn.textContent = "Next";
        this.nextBtn = nextBtn;

        // create ul
        let ul = document.createElement("ul");
        this.ulBtns = ul;
        buttonsDiv.appendChild(ul)
        this.shuffleButtons();


        buttonsDiv.appendChild(nextBtn);

        barPaginationDiv.appendChild(buttonsDiv);
        if (this.isUpperBar) {
            barPaginationDiv.classList.add("upper")
        }
        return barPaginationDiv;

    }
    createNodesNumber(content, count=null) {
        let li = document.createElement("li");
        if (count != null) {
            li.setAttribute("count", count);
            li.addEventListener("click", () => {
                if (this.currentSlidePos > count) {
                    this.currentRow = (count * this.numberRowsInSlide) -this.numberRowsInSlide;
                } else if(this.currentSlidePos < count) {
                    this.currentRow += this.numberRowsInSlide;
                }
                this.currentSlidePos = count;
                li.classList.add("current-slide");
                this.showSlide()
                this.shuffleButtons();
            });
        } else {
            li.classList.add("pointer-e-non");
        }
        // Check if this an active slide
        if (count === this.currentSlidePos) {
            li.classList.add("current-slide");
        }

        li.textContent = content;
        return li;
    }
    checkActivationPrevNextBtn() {
        if (this.countSlides === 1) {
            this.nextBtn.classList.remove("active")
            this.prevBtn.classList.remove("active")
            return;
        }
        if (this.currentSlidePos === this.countSlides) {
            this.nextBtn.classList.remove("active")
            this.prevBtn.classList.add("active")
        }
        if (this.currentSlidePos === 1) {
            this.prevBtn.classList.remove("active")
            this.nextBtn.classList.add("active")
        } else {
            this.prevBtn.classList.add("active")
        }
    }
    shuffleButtons() {
        removeAllChildNodes(this.ulBtns);

        if (this.countSlides <= 6) {
            for (let i = 1; i <= this.countSlides; i++) {
                let li = this.createNodesNumber(i, i);
                this.ulBtns.appendChild(li);
            }
            this.checkActivationPrevNextBtn();
            return true;
        }

        // If current slide not override half slides I will create nodes (1 to 6) (...) (lasNode)
        let halfSlidesCount = Math.floor(this.countSlides / 2);
        if (this.currentSlidePos < halfSlidesCount && this.currentSlidePos <= 6) {
            for(let i = 1; i < 6; i++) {
                let li = this.createNodesNumber(i, i);
                this.ulBtns.appendChild(li);
            }
            // Create Dot node
            this.ulBtns.appendChild(this.createNodesNumber("..."));
            // Create Last Node
            this.ulBtns.appendChild(this.createNodesNumber(this.countSlides, this.countSlides));

            this.checkActivationPrevNextBtn();
        }

        // If current slide not override half slides I will create nodes (1) (...) (lasNode - 6 to last node)
        if (this.currentSlidePos <= this.countSlides && this.currentSlidePos >= this.countSlides - 6) {
            this.ulBtns.appendChild(this.createNodesNumber(1, 1));
            // Create Dot node
            this.ulBtns.appendChild(this.createNodesNumber("..."));
            for(let i = this.countSlides - 5; i <= this.countSlides; i++) {
                let li = this.createNodesNumber(i, i);
                this.ulBtns.appendChild(li);
            }
            this.checkActivationPrevNextBtn();
        }

        // If current slide in medium
        if (this.currentSlidePos > 6 && this.currentSlidePos < this.countSlides - 6) {
            this.ulBtns.appendChild(this.createNodesNumber(1, 1));
            // Create Dot node
            this.ulBtns.appendChild(this.createNodesNumber("..."));

            for(let i = this.currentSlidePos; i < this.currentSlidePos + 4; i++) {
                this.ulBtns.appendChild(this.createNodesNumber(i, i));
            }
            this.ulBtns.appendChild(this.createNodesNumber("..."));
            this.ulBtns.appendChild(this.createNodesNumber(this.countSlides, this.countSlides));
            this.checkActivationPrevNextBtn();
        }

    }
    appendPaginationSectionInTable() {
        this.paginationSection = this.createPaginationBar();

        // remove all previous pagination section
        if (this.paginationSection != null) {
            let bars = this.table.parentElement.querySelectorAll(".bar-pagination");
            bars.forEach((bar) => {
                bar.remove()
            });
        }
        if (this.isUpperBar) {
            this.table.parentElement.prepend(this.paginationSection);
        }  else {
            this.table.parentElement.appendChild(this.paginationSection);
        }

    }
    changeSlideNumberInStatisticsSection() {
        this.currentSlideDiv.textContent = '';
        this.currentSlideDiv.textContent = this.currentSlidePos;
    }
    showSlide() {
        removeAllChildNodes(this.tBody);
        this.rows.slice(this.currentRow, this.currentRow + this.numberRowsInSlide).forEach((row) => {
           this.tBody.appendChild(row);
        });
        this.changeSlideNumberInStatisticsSection()
        this.shuffleButtons()
    }
    pagination() {
        this.appendPaginationSectionInTable();
        this.showSlide();
        this.nextBtn.addEventListener("click", () => {
            this.currentSlidePos++;
            this.currentRow += this.numberRowsInSlide;
            this.showSlide();
        });
        this.prevBtn.addEventListener("click", () => {
            this.currentSlidePos--;
            this.currentRow -= this.numberRowsInSlide;
            this.showSlide();
        });
    }
}
tables.forEach(table => {
    let pagination = new PaginationTable(table);
    pagination.pagination()
});

// End Pagination table