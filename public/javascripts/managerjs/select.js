
export default class select {
    constructor(select) {
        this.select = select;
    }

    create(classname, type=false) {
        
        this.select.forEach(selector => {

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
                        if (classname != null) {
                            if (type) {
                                this.addFieldStyle(select.value, classname);
                            } else {
                                this.addFormStyle(select.value, classname);
                            }
                        }
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

        });
    }

    addFormStyle(value, classname) {
        if (value === "") {
            document.getElementById(classname).classList.add("text-gray");
            document.getElementById(classname+"-label").classList.add("display-none");
            document.getElementById("repairD").classList.add("margin-top-4");
        } else {
            document.getElementById(classname).classList.remove("text-gray");
            document.getElementById(classname+"-label").classList.remove("display-none");
            document.getElementById("repairD").classList.remove("margin-top-4");
        }
    }

    addFieldStyle(value, classname) {
        if (value === "") {
            document.getElementById(classname+"-label").classList.add("display-none");
        } else {
            document.getElementById(classname+"-label").classList.remove("display-none");
        }
    }

}
