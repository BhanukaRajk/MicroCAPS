
const username = document.getElementById("username");
const password = document.getElementById("password");
const vCode = document.getElementById("vCode");
const usernameLabel = document.getElementById("username-label");
const passwordLabel = document.getElementById("password-label");
const vcodeLabel = document.getElementById("vcode-lable");

username?.addEventListener("focus", () => {
    username.classList.remove("form-control-invalid");
    usernameLabel.classList.remove("red");
    usernameLabel.innerHTML = "Username";
});

password?.addEventListener("focus", () => {
    password.classList.remove("form-control-invalid");
    passwordLabel.classList.remove("red");
    passwordLabel.innerHTML = "Password";
});

vCode?.addEventListener("focus", () => {
    vCode.classList.remove("form-control-invalid");
    vcodeLabel.classList.remove("red");
    vcodeLabel.innerHTML = "Verification Code";
});

const newpassword = document.getElementById("newpassword");
const newpasswordLabel = document.getElementById("newpassword-label");
const confirmpassword = document.getElementById("confirmpassword");
const confirmLabel = document.getElementById("confirm-label");
const updatebtn = document.getElementById("update-btn");

let passwordOne;
let passwordTwo;

newpassword?.addEventListener("input", () => {
    passwordOne = newpassword.value;
});

confirmpassword?.addEventListener("input", () => {
    passwordTwo = confirmpassword.value;
    if (passwordTwo === "") {
        confirmpassword.classList.remove("form-control-red");
        confirmLabel.classList.remove("red");
        updatebtn.disabled = true;
    }
    else if (!passwordMatch(passwordOne, passwordTwo)) {
        confirmpassword.classList.remove("form-control-green");
        confirmLabel.classList.remove("green");
        confirmpassword.classList.add("form-control-red");
        confirmLabel.classList.add("red");
        updatebtn.disabled = true;
    }
    else {
        confirmpassword.classList.remove("form-control-red");
        confirmpassword.classList.add("form-control-green");
        confirmLabel.classList.remove("red");
        confirmLabel.classList.add("green");
        updatebtn.disabled = false;
    }
});

function passwordMatch(passwordOne, passwordTwo) {
    if (passwordOne === passwordTwo) {
        return true;
    } else {
        return false;
    }
}
