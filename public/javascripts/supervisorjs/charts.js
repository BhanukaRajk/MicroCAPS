var ctx = document?.getElementById('myChart').getContext('2d');
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
    cutout: 80
}
});