const selectTypeTransactionBtnHtml = document.getElementById("select-type-btn");
const typesTransaction = document.getElementById("type-filter").querySelectorAll("li");

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



// Add event listener to show the native date picker on click
document.getElementById('custom-date-input').addEventListener('click', function() {
   this.setAttribute('type', 'date');
});

// Add event listener to reset the input type after date selection
document.getElementById('custom-date-input').addEventListener('change', function() {
   this.setAttribute('type', 'text');
});
