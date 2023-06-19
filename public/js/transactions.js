const selectTypeTransactionBtnHtml = document.getElementById("select-type-btn");
const typesTransaction = document.getElementById("type-filter").querySelectorAll("li");
let messages = null;
getMessages("transactions", "getMessagesAjax", "transactions.messages").then((result) => {
   messages = result;
   return result;
});
function toggleAngleSelectBox() {
   let angels = document.querySelectorAll(".angle");
   angels.forEach(angel => {
      angel.classList.toggle("active")
   });
}
selectTypeTransactionBtnHtml.addEventListener("click", () => {
   toggleAngleSelectBox();
   let types = selectTypeTransactionBtnHtml.parentElement.querySelector("ul");
   types.classList.toggle("open");
});

typesTransaction.forEach(li => {
   li.addEventListener("click", () => {
      let content = li.textContent;
      let span = selectTypeTransactionBtnHtml.querySelector("span");
      span.textContent = '';
      span.textContent = content;
      let types = selectTypeTransactionBtnHtml.parentElement.querySelector("ul").classList.toggle("open");
      toggleAngleSelectBox();

      //TODO: Fetch Type Filter AJax
   });
});


// Filter Between Values
function createRow(res, transactionsTypes, paymentStatus) {

    let tr = document.createElement("tr");

    let td1 = document.createElement("td");
    td1.textContent = res["InvoiceId"];
    tr.appendChild(td1);

    let td2 = document.createElement("td");
    td2.textContent = transactionsTypes[res["TypeInvoice"]];
    tr.appendChild(td2);

    let td3 = document.createElement("td");
    let paymentAmount = Number(res["PaymentAmount"]);
    let paymentLiteral = Number(res["PaymentLiteral"]);
    td3.textContent = paymentAmount + paymentLiteral;
    tr.appendChild(td3);

    let td4 = document.createElement("td");
    td4.textContent = res["Created"];
    tr.appendChild(td4);

    let td5 = document.createElement("td");
    td5.textContent = res["NumberProducts"];
    tr.appendChild(td5);

    let td6 = document.createElement("td");
    td6.textContent = res["Discount"];
    tr.appendChild(td6);

    let td7 = document.createElement("td");
    td7.textContent = res["DiscountType"] == null ? messages["text_no_disc"] : res["DiscountType"];
    tr.appendChild(td7);

    let td8 = document.createElement("td");
    td8.textContent = res["Name"];
    tr.appendChild(td8);

    let td9 = document.createElement("td");
    td9.textContent = paymentStatus[res["PaymentStatus"]];
    tr.appendChild(td9);

    let td10 = document.createElement("td");
    td10.innerHTML = `<td>
           <div class="icons">
               <span class="description dir-r top-5" description="show"><i class="fa fa-print"></i></span>
           </div>
       </td>`;
    tr.appendChild(td10);
    return tr;


}




const filtersBetweenValuesHtml = document.querySelectorAll("[filter-between-vals]");

filtersBetweenValuesHtml.forEach(filter => {
   let fromInputHtml = filter.querySelector("input[input-from]")
   let toInputHtml = filter.querySelector("input[input-to]")
   let applyBtnHtml =filter.querySelector("button[apply-btn]");


   applyBtnHtml.addEventListener("click", () => {
      let fromValue = fromInputHtml.value;
      let toValue = toInputHtml.value;

      fetch("http://estore.local/transactions/applyBetweenQueryAjax", {
         "method": "POST",
         "headers": {
            'Content-Type': 'application/x-www-form-urlencoded',
         },
         "body": `from=${fromValue}&to=${toValue}`,
      })
          .then(function(res){ return res.json(); })
          .then(function(data){
             return JSON.stringify(data);
          })
          .then((resRows)=> {
             let transactionTableHtml = document.getElementById("transactions-table");
             let tbodyHtml = transactionTableHtml.querySelector("tbody");


             resRows = JSON.parse(resRows);
             removeAllChildNodes(tbodyHtml);

             let data = resRows[0];
             for (const key in data) {
                let tr = createRow(data[key], resRows["transactionsTypes"], resRows["paymentsStatus"]);
                tbodyHtml.appendChild(tr);
             }
             new PaginationTable(transactionTableHtml).pagination()

          });
   });
});