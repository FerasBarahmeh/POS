// Search Employee Table
// Search By Name
const nameUsers   = document.querySelectorAll(".name-user-row");
const inputFindUser = document.getElementById("find-user");

if (inputFindUser !== null) {
    inputFindUser.addEventListener("keyup", (e) => {
        let content = e.target.value.toLowerCase();
        nameUsers.forEach((th) => {
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
