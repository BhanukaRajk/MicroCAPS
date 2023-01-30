const edit = document.getElementById("edit");
const change = document.getElementById("change");
const image = document.getElementById("image");
const preview = document.getElementById("img-preview");

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
            preview.setAttribute('src', this.result);
        });
    }
    
}
