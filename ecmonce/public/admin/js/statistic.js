$(document).ready(function() {
    // delelete
    $(document).on('click', '#export-file', function(event) {
        event.preventDefault();
        bootbox.confirm('Are you want to export file?', function(result) {
            if (result) {
                $('#form-export').submit();
            }
        });
    });

    chart();
});

function chart() {
    var ctx = $('#chart-statistic');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data['nameCategory'],
            datasets: [{
                label: '# Total Price',
                data: data['totalPrice'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            animation:{
                animateScale:true
            }
        }
    });

}
