/* Common */
// Logout Dropdown
const drop = document.getElementById("drop");
const logout = document.getElementById("logout");

drop?.addEventListener("click", () => {
    logout.classList.toggle("display-block");
});

// Select
document.querySelectorAll('.custom-select').forEach(setupSelector);
document.querySelectorAll('.custom-select-2').forEach(setupSelector);

function setupSelector(selector) {
    selector.addEventListener('mousedown', e => {

        e.preventDefault();

        const select = selector.children[0];
        const dropDown = document.createElement('ul');
        dropDown.className = "selector-options";

        [...select.children].forEach(option => {
            const dropDownOption = document.createElement('li');
            dropDownOption.textContent = option.textContent;

            dropDownOption.addEventListener('mousedown', (e) => {
                e.stopPropagation();
                select.value = option.value;
                selector.value = option.value;
                addshellSelect(selector);
                select.dispatchEvent(new Event('change'));
                selector.dispatchEvent(new Event('change'));
                dropDown.remove();
            });

            dropDown.appendChild(dropDownOption);
        });

        if (selector.contains(e.target)) {
            selector.appendChild(dropDown);
        }   
        else {
            dropDown.remove();
        }
        
        // handle click out
        document.addEventListener('click', (e) => {
            if (!selector.contains(e.target)) {
                dropDown.remove();
            }
        });
    });
}

function addshellSelect(selector) {
    if (selector.className === "custom-select-2") {
        if (selector.value === "") {
            document.getElementById("chassis").classList.add("text-gray");
            document.getElementById("chassis-label").classList.add("display-none");
            document.getElementById("repairD").classList.add("margin-top-4");
        } else {
            document.getElementById("chassis").classList.remove("text-gray");
            document.getElementById("chassis-label").classList.remove("display-none");
            document.getElementById("repairD").classList.remove("margin-top-4");
        }
    }  
}