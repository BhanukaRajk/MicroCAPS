const imagec = document.getElementById("imagec");
const previewc = document.getElementById("img-previewc");
const removec = document.getElementById("removec");

previewc?.addEventListener("click", () => {
    imagec.click();
});

imagec?.addEventListener("change", () => {
    getImgData();
});

function getImgData() {
    const files = imagec.files[0];
    if (files) {
        const fileReader = new FileReader();
        fileReader.readAsDataURL(files);
        fileReader.addEventListener("load", function () {
            previewc.style.backgroundImage = `url(${this.result})`;
            // preview.setAttribute('src', this.result);
        });
    }
    
}

removec?.addEventListener("click", () => {
        previewc.style.backgroundImage = `url(http://localhost:8888/MicroCAPS/public/images/placeholder.jpg)`;
        imagec.value = "";
});
