const selectTypeTransactionBtnHtml = document.getElementById("select-type-btn");
let messages = null;
getMessages("transactions", "getMessagesAjax", "transactions.messages").then((result) => {
   messages = result;
   return result;
});