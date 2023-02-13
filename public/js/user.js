// Search Employee Table
// Search By Name
const nameUsers   = document.querySelectorAll(".name-user-row");
const inputFindUser = document.getElementById("find-user");

if (inputFindUser !== null) {
    inputFindUser.addEventListener("keyup", (e) => {
        let content = e.target.value.toLowerCase();
        nameUsers.forEach((th) => {
            const name = th.innerText.toLowerCase();
            const tr = th.closest("tr");
            if (name.search(content) === -1) {
                tr.classList.add("un-visible");
            } else {
                tr.classList.remove("un-visible");
            }
        });
    });
}

// Check if users exist ajax call  (isNameAlreadyUsedAction) function
function whenBlurInput(inputUser) {
    inputUser.addEventListener("blur", () => {
        const label     = inputUser.parentElement.querySelector("label");
        const message   = inputUser.parentElement.querySelector(".message");
        if (inputUser.value === '' && message == null) {
            label.style.transform = "translateY(0)";
        }
        if ( message == null) {
            inputUser.onfocus = () => {
                if (message != null)
                    label.style.transform = "translateY(-41px)";
                else
                    label.style.transform = "translateY(-21px)";
            }
        }
    });
}
function isset(input, action, nameValue) {
    let xml = new XMLHttpRequest();

    xml.onload = function () {
        if (this.readyState === 4 && this.status === 200) {
            let filed = input.parentElement;

            // Remove old rejected symbol
            const childSymbols = filed.children;
            for (const i of childSymbols) {
                let iType = i.nodeName.toLowerCase();
                if (iType === 'i' || iType === "svg" ) {
                    i.remove()
                }
            }

            // Remove Messages Old
            if (filed.querySelector(".rejected-value-input.message") != null ) {
                filed.querySelector(".rejected-value-input.message").remove();
            }


            // Create symbol
            let i = document.createElement('i');
            let spanMessage = document.createElement("span");
            spanMessage.className = "rejected-value-input message";


            // Add Common class between success and field in symbol
            i.className = "rejected-value-input fa ";

            const responseContent = JSON.parse(xml.responseText);

            spanMessage.innerText = responseContent.message;

            if (responseContent.result === '1') {
                i.className += "  fa-check success";
                filed.querySelector("label").style.transform = "translateY(-21px)";
            } else if(responseContent.result === '0') {
                filed.prepend(spanMessage);
                filed.querySelector("label").style.transform = "translateY(-41px)";
                i.className += " fa-exclamation danger";
            } else {

            }

            if (i.classList.contains("success") || i.classList.contains("danger") ) {
                filed.appendChild(i);
            }
        }
    };

    xml.open("POST", "http://estore.local/users/" + action);
    xml.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
    );
    xml.send(nameValue + "=" + input.value);
}

const inputUser = document.querySelector("input[name=UserName]") ;

if (inputUser != null) {
    inputUser.addEventListener("keyup", (e) => {
        isset(inputUser, "isNameAlreadyUsed", "UserName");
    });

    whenBlurInput(inputUser);
}


// Check Email
const inputEmail = document.querySelector("input[name=Email]") ;

if (inputEmail != null) {
    inputEmail.addEventListener("keyup", () => {
        isset(inputEmail, "isEmailAlreadyUsed", "Email");
    });

    whenBlurInput(inputEmail);
}

// TODO: convert table users to slides