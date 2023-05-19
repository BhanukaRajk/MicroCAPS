const viewDefect = document.getElementById("view-defect");
const cancel = document.getElementById("cancel");

viewDefect?.addEventListener("click", () => {

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