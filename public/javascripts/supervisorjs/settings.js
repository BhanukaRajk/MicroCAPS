const edit = document.getElementById("edit");
const change = document.getElementById("change");
const image = document.getElementById("image");
const preview = document.getElementById("img-preview");
const chgPass = document.getElementById("chg-pass");
const cancel = document.getElementById("cancel");


edit?.addEventListener("click", () => {

    $("#details :input").prop("disabled", false);

    edit.classList.add("display-none");
    change.classList.remove("display-none");
    preview.classList.add("pointer");

});

change?.addEventListener("click", () => {

    $("#details :input").prop("disabled", true);

    edit.classList.remove("display-none");
    change.classList.add("display-none");
    preview.classList.remove("pointer");

});

preview?.addEventListener("click", () => {
    image.click();
});

image?.addEventListener("change", () => {
    getImgData();
});

function getImgData() {
    const files = image.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            preview.style.backgroundImage = `url(${this.result})`;
            // preview.setAttribute('src', this.result);
        });
    }
    
}

chgPass?.addEventListener("click", () => {

    const overlay = document.querySelector("#overlay");
    const popcon = document.querySelector("#pop-con");

    overlay.classList.add('visible');   
    popcon.classList.add('pop');

});

cancel?.addEventListener("click", () => {
    
        const overlay = document.querySelector("#overlay");
        const popcon = document.querySelector("#pop-con");
    
        overlay.classList.remove('visible');   
        popcon.classList.remove('pop');
    
    }
);

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