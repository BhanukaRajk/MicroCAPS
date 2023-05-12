// CHART RENDERING FUNCTION
function renderChart(ctx, ltx, data, cutout = 50) {
    
    let done = data.complete/(data.complete + data.pending)*100;
    let ongoing = data.pending/(data.complete + data.pending)*100;

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


// DESTROY CHART ON CANVAS WHEN PAGE NOT RELOADING TO CHANGE THE CHART DETAILS
function destroyChart(ctx) {

    var chart = Chart.getChart(ctx);

    chart.destroy();

}