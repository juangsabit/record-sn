<!DOCTYPE html>
<html>

<head>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="icon" href="AVI.png" type="image/png" sizes="16x16">
  <title>Serial Number FCT</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-6">
            </div>
            <div class="col-6 text-right  mt-3">
                <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
        <div class="row">
            <div id="container" style="height: 700px; min-width: 1000px; max-width: 1200px; margin: 0 auto" class="mt-3">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://code.highcharts.com/stock/highstock.js"></script>
    <script src="https://code.highcharts.com/stock/modules/data.js"></script>
    <script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
    
    <script>
        Highcharts.getJSON('ajax/ajax_graph.php', function (data) {
            Highcharts.stockChart('container', {

                chart: {
                    height: (10 / 16 * 100) + '%' // 16:9 ratio
                },

                rangeSelector: {
                    allButtonsEnabled: true,
                    buttons: [
                    {
                        type: 'month',
                        count: 3,
                        text: 'Day',
                        dataGrouping: {
                            forced: true,
                            units: [['day', [1]]]
                        }
                    }, {
                        type: 'year',
                        count: 1,
                        text: 'Week',
                        dataGrouping: {
                            forced: true,
                            units: [['week', [1]]]
                        }
                    }
                    // , {
                    //     type: 'all',
                    //     text: 'Month',
                    //     dataGrouping: {
                    //         forced: true,
                    //         units: [['month', [1]]]
                    //     }
                    // }
                    ],
                    buttonTheme: {
                        width: 60
                    },
                    selected: 2
                },

                title: {
                    text: 'FCT Productivity Graph'
                },

                subtitle: {
                    text: 'Only data fct ok and pwb from siix'
                },

                _navigator: {
                    enabled: false
                },

                series: [{
                    name: 'Actual',
                    data: data,
                    marker: {
                        enabled: null, // auto
                        radius: 3,
                        lineWidth: 1,
                        lineColor: '#FFFFFF'
                    },
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            });
        });
    </script>

</body>

</html>