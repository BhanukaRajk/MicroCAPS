// GET ALL FILTER CHECKBOXES AND RADIO BUTTONS

const completenesscheckboxes = document.querySelectorAll("input[type=checkbox][class=connected-btn]");
const holdingcheckboxes = document.querySelectorAll("input[type=checkbox][class=holding-btn]");


const BASE_URL = "http://localhost:8080/MicroCAPS/";




// let PROCEED = true;
const nextbtn = document.querySelector('#stage-passer');




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





// let PROCEED = false;
// let numUnchecked = completenesscheckboxes.length;

// for (let cmcheckbox of completenesscheckboxes) {
//     if (cmcheckbox.checked) {
//         numUnchecked--;
//         if (numUnchecked === 0) {
//             PROCEED = true;
//         }
//     }
// }

// function updateNextBtnDisabled() {
//     nextbtn.disabled = !PROCEED;
// }
// updateNextBtnDisabled();


// for (let cmcheckbox of completenesscheckboxes) {
//     cmcheckbox?.addEventListener('change', (event) => {
//         if (event.target.checked) {
//             numUnchecked--;
//             if (numUnchecked === 0) {
//                 PROCEED = true;
//             }
//         } else if(!event.target.checked) {
//             numUnchecked++;
//             PROCEED = false;
//         }
//         updateNextBtnDisabled();
//     });
// }

// updateNextBtnDisabled();

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







// EVENT LISTNERS TO UPDATE THE PROCESS
for (let cmcheckbox of completenesscheckboxes) {
    cmcheckbox.addEventListener('change', updateProcessStatus);
}
for (let hdcheckbox of holdingcheckboxes) {
    hdcheckbox.addEventListener('change', updateProcessStatus);
}


function updateProcessStatus() {

    const ButtonID = this.id;

    const VehicleId = document.querySelector('#vehicle_id').innerHTML;
    const ProcessId = ButtonID.split("-")[0];

    console.log(VehicleId);
    console.log(ProcessId);

    let completeness, holding;

    if (document.querySelector("input[type=checkbox][name=" + ProcessId + "-con]").checked) {
        completeness = 1;
    } else {
        completeness = 0;
    }

    if (document.querySelector("input[type=checkbox][name=" + ProcessId + "-hold]").checked) {
        holding = 1;
    } else {
        holding = 0;
    }



    // JSON STRINGIFY USED BECAUSE AN ARRAY IS PASSED USING THIS checkboxesset VARIABLE
    const formData = new FormData();
    formData.append("vehicleID", VehicleId);
    formData.append("proID", ProcessId);
    formData.append("completeness", completeness);
    formData.append("holding", holding);


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