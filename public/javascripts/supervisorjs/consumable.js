// CONSUMABLE FILTERING FUNCTION

const ctypeRadios = document.querySelectorAll("input[type=radio][name=cons-type]");
const cstateRadios = document.querySelectorAll("input[type=radio][name=stock-state]");


// ATTACH EVENT LISTENERS TO ALL FILTER INPUTS

// CHECK ALL RADIO BUTTONS AND CALL THE FILTER WHEN ANY OF THEM IS CHANGED
for (let radio of ctypeRadios) {
    radio.addEventListener('change', consumeFilter);
}
for (let radio of cstateRadios) {
    radio.addEventListener('change', consumeFilter);
}



// FUNCTION OF FILTERING
function consumeFilter() {

    // GET THE REQUESTED TYPE OF CONSUMABLE
    const typeOfConsume = document.querySelector(
        "input[type=radio][name=cons-type]:checked"
    ).value;

    // GET THE REQUESTED STATUS OF CONSUMABLE
    const stateOfConsume = document.querySelector(
        "input[type=radio][name=stock-state]:checked"
    ).value;


    // FOR ERROR CHECKING
    console.log(typeOfConsume);
    console.log(stateOfConsume);

    // SETTING KEY VALUE PAIRS
    const formData = new FormData();
    formData.append("typeOfConsume", typeOfConsume);
    formData.append("stateOfConsume", stateOfConsume);


    if (!formData) {
        console.error("FormData not supported");
        return;
    }
    

    fetch(BASE_URL + "Supervisors/findConsumables", {
        method: "POST",
        // headers: {
        //     'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            console.log("Data = "+data);

            const consumeDataBoard = document.querySelector('#consumeBoard');

            if(data) {

                let consumeSet = '';

                data.forEach((consume) => {
                    consumeSet += `<div class="carcard" onclick="expandConsumable(this)">
                                    <div class="cardhead">
                                        <div class="cardid">
                                        <div class="con-id display-none">${consume.ConsumableId}</div>
                                        <div class="carmodel">${consume.ConsumableName}</div>
                                        <div class="chassisno">${consume.Volume == null ? 'Grease' : 'Lubricants'}</div>
                                        <div class="consumable-quantity display-none">${consume.Volume == null ? consume.Weight+' Kgs' : consume.Volume+' Liters'}</div>
                                        </div>
                                        <div class="carstatuscolor">
                                        <div class="status-circle ${consume.Volume == null ? (consume.Weight >= 60 ? 'status-green-circle' : 'status-orange-circle') : (consume.Volume >= 60 ? 'status-green-circle' : 'status-orange-circle')} "></div>
                                        </div>
                                    </div>
                                    <div class="carpicbox">
                                        <img src="${BASE_URL}public/images/consumables/${consume.Image}" class="carpic" alt="${consume.ConsumableName}">
                                    </div>
                                    <div class="carstatus ${consume.Volume == null ? (consume.Weight >= 60 ? 'available' : 'lower') : (consume.Volume >= 60 ? 'available' : 'lower')}">${consume.Volume == null ? (consume.Weight >= 60 ? 'Available' : 'Low in stock') : (consume.Volume >= 60 ? 'Available' : 'Low in stock')}</div>
                                    <div class="chassisno con-last-update">Last update: ${consume.UDate} at ${consume.UTime.substring(0, 5)} </div>
                                    <div class="chassisno con-last-update">By: ${consume.Updater} </div>

                                    </div>`;
                });

                consumeSet += '';
                consumeDataBoard.innerHTML = consumeSet;

            } else {
                consumeDataBoard.innerHTML =    `<div class="no-data horizontal-centralizer">
                                                    <div class="margin-top-5 vertical-centralizer">
                                                        <div> Nothing to show :( </div>
                                                        <div>
                                                            <img src="${BASE_URL}public/images/common/no_data.png" class="no-data-icon" alt="No Data">
                                                        </div>
                                                    </div>
                                                </div>`;
            }

        })
        .catch((error) => console.error(error));
}



function expandConsumable(Consume) {

    // GET THE VALUES FROM THE TOOL CARD
    var consumeId = Consume.querySelector('.con-id').innerText;
    var consumeName = Consume.querySelector('.carmodel').innerText;
    var quantity = Consume.querySelector('.consumable-quantity').innerText;
    var consumepic = Consume.querySelector('.carpic');
    var consumeImg = consumepic.getAttribute('src');
    var lastupdate = Consume.querySelector('.con-last-update').innerText;

    // FILL THE INPUT FIELDS IN THE FORM
    document.querySelector('.form-conname').innerText = consumeName;
    document.querySelector('.form-con-quantity').innerText = "Current Stock: " + quantity;
    document.querySelector('.form-con-lastupdate').innerText = lastupdate;
    document.getElementById("formConsImg").setAttribute("src", consumeImg);
    document.getElementById("formConId").setAttribute("value", consumeId);

    document.getElementById("stock").setAttribute("value", quantity.split(' ')[0].trim());
    document.querySelector('.form-con-stock-label').innerText = "Current Stock update (" + quantity.split(' ')[1].trim() + ")";

    document.getElementById("formConType").setAttribute("value", quantity.split(' ')[1].trim());


    // SHOW THE POPUP FORM
    document.getElementById("consumeUpdatePopUp").setAttribute("class", "background-bluer");
    document.getElementsByClassName("vehicle-data-board").classList.toggle("noscroll");
}


function closeDetailedConsumable() {

    // CLOSE THE POPUP FORM
    document.getElementById("consumeUpdatePopUp").setAttribute("class", "background-bluer display-none");
    document.getElementsByClassName("vehicle-data-board").classList.remove("noscroll");
}



function closeConsumeAddingPopup() {
    //// var popupDiv = document.getElementById('addNewConBox');
    //// popupDiv.style.display = 'none';
    document.getElementById("addNewConBox").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
}

function showConsumeAddingPopup() {
    //// var popupDiv = document.getElementById('addNewConBox');
    //// popupDiv.style.display = '';
    document.getElementById("addNewConBox").setAttribute("class", "delete-conf-blur horizontal-centralizer");
}



function consumeDeleteConfirmation() {
    // GET THE VALUES FROM THE LEAVE TABLE

    // FILL THE INPUT FIELDS IN THE FORM
    const ConsumableId = document.querySelector('.form-conid').getAttribute('value');
    document.getElementById("del-form-con-id").setAttribute("value", ConsumableId);

    // SHOW THE POPUP FORM
    document.getElementById("popupWindow").classList.remove("display-none");
}

function closeConsumeDeleteConfirmation() {

    // CLOSE THE POPUP FORM
    document.getElementById("popupWindow").classList.toggle("display-none");
    //// document.getElementById("popupWindow").setAttribute("class", "delete-conf-blur horizontal-centralizer display-none");
    //// document.getElementsByClassName("databoard").classList.remove("noscroll");
}


function closeConsumeDelConfBox() {
    var popupDiv = document.getElementById('consumeDelConf');
    popupDiv.style.display = 'none';
}




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
        previewc.style.backgroundImage = `url(${BASE_URL}public/images/placeholder.jpg)`;
        imagec.value = "";
});