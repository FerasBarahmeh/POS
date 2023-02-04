// Search Employee Table
// Search By Name
const nameEmployees   = document.querySelectorAll(".name-employee-row");
const inputFindEmployee = document.getElementById("find-employee");

if (inputFindEmployee !== null) {
    inputFindEmployee.addEventListener("keyup", (e) => {
        let content = e.target.value.toLowerCase();
        nameEmployees.forEach((th) => {
            const name = th.innerText.toLowerCase().split(' ').join("");
            const tr = th.closest("tr");
            if (name.search(content) === -1) {
                tr.classList.add("un-visible");
            } else {
                tr.classList.remove("un-visible");
            }
        });
    });
}
