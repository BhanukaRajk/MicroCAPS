// BASE URL
const BASE_URL = "http://localhost/:8080MicroCAPS/";





// BUTTON ENABLING AND DISABLING PROCESS HANDLER /////////////////////////////////////////////////////////////////////////////////

// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS
const completenesscheckboxes = document.querySelectorAll("input[type=checkbox][class=connected-btn]");
const holdingcheckboxes = document.querySelectorAll("input[type=checkbox][class=holding-btn]");

// DISABLE ALL THE CONNECTION BUTTONS WHEN HOLD BUTTON PRESSED
for (let hdcheckbox of holdingcheckboxes) {

    if (hdcheckbox.checked) {
        const process = hdcheckbox.id;
        const processid = process.split("-")[0];
        const connectbtnx = document.querySelector("input[type=checkbox][name=" + processid + "-con]")
        connectbtnx.disabled = true;
    }

    hdcheckbox?.addEventListener('change', (event) => {

        // CONTROL THE UPDATED PROCESS' HOLD BUTTON AND CONNECT BUTTON
        const holdbtn = event.target;
        const process = holdbtn.id;
        const processid = process.split("-")[0];
        const connectbtn = document.querySelector("input[type=checkbox][name=" + processid + "-con]")

        if (holdbtn.checked) {
            connectbtn.checked = false;
            connectbtn.disabled = true;
        } else {
            connectbtn.disabled = false;
        }

    });
}




var items = document.getElementsByClassName('pagination-item');


showPage(1);


let PageCount = 0;
if (items.length % 8 == 0) {
    PageCount = items.length / 8;
} else {
    PageCount = Math.floor(items.length / 8) + 1;
}

// SELECT THE PAGE BUTTON SET ELEMENT
var buttonSet = document.querySelector('.page-button-set');

// CREATE A BUTTON FOR EACH PAGE AND APPEND TO THE BUTTON SET ELEMENT
for (var i = 1; i <= PageCount; i++) {
    var button = document.createElement('button');
    button.classList.add('paginate');
    button.textContent = i;
    button.addEventListener('click', function() {
        showPage(this.textContent);
    });
    buttonSet.appendChild(button);
}



function showPage(pageNumber) {
    // GET ALL PAGINATION ITEMS
    var items = document.getElementsByClassName('pagination-item');

    // CALCULATE START AND END INDICES FOR ITEMS TO SHOW
    var startIndex = (pageNumber - 1) * 8;
    var endIndex = startIndex + 8;

    // LOOP THROUGH ALL ITEMS AND HIDE/SHOW BASED ON INDEX
    for (var i = 0; i < items.length; i++) {
        if (i >= startIndex && i < endIndex) {
            items[i].style.display = 'flex';
        } else {
            items[i].style.display = 'none';
        }
    }
}



// RELOAD CHART WHEN A CHANGE HAPPEND ///////////////////////////////////////////////////////////////////////////////////////////

function reloadChart() {

    let chassisNo = document.getElementById("vehicle_id").innerHTML;
    let stage = document.getElementById("stage_id").innerHTML;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            destroyChart(document.getElementById(stage));

            var ctx = document.getElementById(stage).getContext('2d');

            let ltx = document.getElementById(stage+'-label');

            updateChart(ctx, ltx, JSON.parse(response), 110);

        }
    };
    xhttp.open("POST", BASE_URL + "Vehicles/assemblyStagePercentageDetail", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo+"&stage="+stage);

}

function updateChart(ctx, ltx, data, cutout = 50) {

    let done = data['overall'].completed/(parseInt(data['overall'].completed) + parseInt(data['overall'].pending))*100;
    let ongoing = data['overall'].pending/(parseInt(data['overall'].completed) + parseInt(data['overall'].pending))*100;

    let chartGrid = cutout == 50 ? 'chart-grid-stage-add' : 'chart-grid-add';

    if (done == 0) {
        ltx.innerHTML = '0%';
        ltx.classList.add(chartGrid + '-1');
    } else if (done == 100) {
        ltx.innerHTML = '100%';
        ltx.classList.add(chartGrid + '-3');
    } else {
        ltx.innerHTML = Math.floor(done) + '%';
        ltx.classList.add(chartGrid + '-2');
    }

    var chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Done', 'Ongoing'],
            datasets: [{
                data: [done, ongoing],
                backgroundColor: ['#017EFA', '#51CBFF']
            }]
        },
        options: {
        plugins: {
            legend: {
                display: false
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        cutout: cutout
    }
    });
}

function destroyChart(ctx) {

    var chart = Chart.getChart(ctx);

    chart.destroy();

}





// PROCESS STATUS UPDATER ////////////////////////////////////////////////////////////////////////////////////////////////////////

// EVENT LISTNERS TO UPDATE THE PROCESS
// for (let cmcheckbox of completenesscheckboxes) {
//     cmcheckbox.addEventListener('change', updateProcessStatus);
// }
// for (let hdcheckbox of holdingcheckboxes) {
//     hdcheckbox.addEventListener('change', updateProcessStatus);
// }


function updateProcessStatus(ProcessId, btn) {

    const VehicleId = document.querySelector('#vehicle_id').innerHTML;

    const checkbox = document.querySelector("input[type=checkbox][name=" + ProcessId + "-" + btn +"]");

    let status = "";

    if (checkbox.checked) {
        if (btn == 'con') {
            status = 'completed';
        } else if (btn == 'hold') {
            status = 'OnHold';
        }
    } else {
        status = 'Pending';
    }

    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicleID", VehicleId);
    formData.append("proID", ProcessId);
    formData.append("status", status);

    if (!formData) {
        console.error("FormData not supported");
        return;
    }


    fetch(BASE_URL + "Supervisors/recordUpdateProcess", {
        method: "POST",
        // headers: {
        //     'Content-type': 'multipart/form-data'
        //     'Content-type': 'application/json'
        // },
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {

            console.log("Data = " + data);

            if (data) {
                reloadChart();
            }

        })
        .catch((error) => console.error(error));
}