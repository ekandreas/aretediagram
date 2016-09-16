<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save_data') {
    $data = $_REQUEST['data'];
    file_put_contents('data.json', json_encode($data));
    exit;
}

?>

<html>

<head>
    <title>Aretediagram</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">

    <link rel="stylesheet" href="/bower_components/handsontable/dist/handsontable.full.css">

    <link rel="stylesheet" href="https://cdn.anychart.com/css/latest/anychart-ui.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

</head>

<body>

    <!-- Uses a header that scrolls with the text, rather than staying
      locked at the top -->
    <div class="mdl-layout mdl-js-layout">
        <header class="mdl-layout__header mdl-layout__header--scroll">
            <div class="mdl-layout__header-row">
                <!-- Title -->
                <span class="mdl-layout-title">Aretediagram</span>
                <!-- Add spacer, to align navigation to the right -->
                <div class="mdl-layout-spacer"></div>
            </div>
        </header>
        <main class="mdl-layout__content">
            <div class="page-content">
                        <div id="container"></div>
                        <div id="example"></div>
            </div>
        </main>
    </div>


    <script src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <script src="https://cdn.anychart.com/js/7.11.1/anychart-bundle.min.js"></script>
    <script src="/bower_components/handsontable/dist/handsontable.full.js"></script>


    <script>

        var data = <?php echo file_get_contents('data.json'); ?>

        var loadChart = function(hot) {

            if(hot) {
                data = hot.getData();
                $('#container').html('');
                $.ajax({
                    url: '/',
                    type: 'POST',
                    data: {
                        'action':'save_data',
                        'data': data
                    },
                    success: function(data) {
                    }
                });
            } else {

            }

            var cloneOfData = JSON.parse(JSON.stringify(data));

            var graf_data = cloneOfData.splice(1);

            var dataSet = anychart.data.set(graf_data);

            var data1 = dataSet.mapAs({x: [0], value: [1]});
            var data2 = dataSet.mapAs({x: [0], value: [2]});
            var data3 = dataSet.mapAs({x: [0], value: [3]});
            var data4 = dataSet.mapAs({x: [0], value: [4]});
            var data5 = dataSet.mapAs({x: [0], value: [5]});
            var data6 = dataSet.mapAs({x: [0], value: [6]});

            // create radar chart
            chart = anychart.radar();

            // set container id for the chart
            chart.container('container');

            // set chart title text settings
            chart.title(data[0][0]);

            // force chart to stack values by Y scale.
            chart.yScale().stackMode(anychart.enums.ScaleStackMode.VALUE);

            // set yAxis settings
            //chart.yAxis().stroke('#545f69');
            //chart.yAxis().ticks().stroke('#545f69');

            // set yAxis labels settings
            //chart.yAxis().labels().fontColor('#545f69')
            //    .textFormatter(function() {return this.value / 1000000 + 'M'});

            // set xAxis labels appearance settings
            var xAxisLabels = chart.xAxis().labels();
            xAxisLabels.padding(5);

            // set chart legend settings
            chart.legend()
                .align('center')
                .position('bottom')
                .enabled(true);

            var series1 = chart.area(data1);
            series1.name(data[0][1]);

            var series2 = chart.area(data2);
            series2.name(data[0][2]);

            var series3 = chart.area(data3);
            series3.name(data[0][3]);

            var series4 = chart.area(data4);
            series4.name(data[0][4]);

            var series5 = chart.area(data5);
            series5.name(data[0][5]);

            var series6 = chart.area(data6);
            series6.name(data[0][6]);

            // initiate chart drawing
            chart.draw();
        };

        anychart.onDocumentReady(function() {
        });

        var container = document.getElementById('example');
        var hot = new Handsontable(container, {
            data: data,
            rowHeaders: true,
            colHeaders: true,
            afterChange: function (changes, source) {
                loadChart(hot);
            }
        });


    </script>


    <script type="text/javascript">


        $(function() {
            //loadChart();
        });

    </script>



</body>

</html>
