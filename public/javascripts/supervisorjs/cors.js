const BASE_URL = "http://localhost:8080/MicroCAPS/";


function dashboardChart() {

    let chassisNo = document.getElementById("dashboardChart").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = this.responseText;

            destroyChart(document.getElementById('myChart'));

            var ctx = document.getElementById('myChart').getContext('2d');

            let ltx = document.getElementById('myChart-label');

            updateChart(ctx, ltx, JSON.parse(response), 80);

        }
    };
    xhttp.open("POST", BASE_URL + "Vehicles/assemblyPercentageDetail", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("chassisNo="+chassisNo);

}

function saveChanges(id, position) {
    let formdata = new FormData();
    formdata.append("id", id);
    formdata.append("image", document.getElementById("image").files[0]);
    formdata.append("firstname", document.getElementById("firstname").value);
    formdata.append("lastname", document.getElementById("lastname").value);
    formdata.append("email", document.getElementById("email").value);
    formdata.append("mobile", document.getElementById("mobile").value);
    formdata.append("nic", document.getElementById("nic").value);
    $.ajax({
        type: 'POST',
        url:  BASE_URL+position+'s/settings',
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            location.reload(true);
        }
    });
}

function updatePassword() {
    let formdata = new FormData();
    formdata.append("currentPassword", document.getElementById("currentpassword").value);
    formdata.append("newPassword", document.getElementById("newpassword").value);
    formdata.append("confirmPassword", document.getElementById("confirmpassword").value);
    $.ajax({
        type: 'POST',
        url: BASE_URL + 'Users/updatePassword',
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            location.reload(true);
        }
    });
}

function addConsumables() {
    let formdata = new FormData();
    formdata.append("image", document.getElementById("imagec").files[0]);
    formdata.append("name", document.getElementById("conName").value);
    formdata.append("type", document.getElementById("consume-type").value);
    formdata.append("status", document.getElementById("status").value);
    $.ajax({
        type: 'POST',
        url:  BASE_URL + 'Supervisors/addNewConsumables',
        data: formdata,
        processData: false,
        contentType: false,
        success: (response) => {
            location.reload(true);
        }
    });
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