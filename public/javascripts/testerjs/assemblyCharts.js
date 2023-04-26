var ctx = document.getElementById('assemblyOverall').getContext('2d');
var chart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Done', 'Ongoing'],
        datasets: [{
            data: [60, 40],
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
    cutout: 110
}
});

var ctx2 = document.getElementById('stage01').getContext('2d');
var ctx3 = document.getElementById('stage02').getContext('2d');
var ctx4 = document.getElementById('stage03').getContext('2d');
var ctx5 = document.getElementById('stage04').getContext('2d');

var chart2, chart3, chart4, chart5;

let arr = [[chart2,[ctx2, 10]], [chart3,[ctx3, 100]], [chart4,[ctx4, 55]], [chart5,[ctx5, 0]]];

arr.forEach(element => {
    element[0] = renderChart(element[1]);
});

function renderChart(ctx) {
    var chart = new Chart(ctx[0], {
        type: 'doughnut',
        data: {
            labels: ['Done', 'Ongoing'],
            datasets: [{
                data: [ctx[1], 100 - ctx[1]],
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
        cutout: 50
    }
    });

    return
}