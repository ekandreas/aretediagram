<html>

<head>
    <title>Aretediagram</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">

    <link rel="stylesheet" href="/bower_components/handsontable/dist/handsontable.full.css">

    <link rel="stylesheet" href="https://cdn.anychart.com/css/latest/anychart-ui.min.css">
    

</head>

<body>


<div id="container"></div>

    <div id="example"></div>


    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <script src="https://cdn.anychart.com/js/7.11.1/anychart-bundle.min.js"></script>
    <script src="/bower_components/handsontable/dist/handsontable.full.js"></script>


    <script>

        var data = [
            ["", "Ford", "Volvo", "Toyota", "Honda"],
            ["2016", 10, 11, 12, 13],
            ["2017", 20, 11, 14, 13],
            ["2018", 30, 15, 12, 13]
        ];

        var container = document.getElementById('example');
        var hot = new Handsontable(container, {
            data: data,
            rowHeaders: true,
            colHeaders: true
        });


    </script>


    <script type="text/javascript">

        anychart.onDocumentReady(function() {
            // create data set on our data
            var dataSet = anychart.data.set([
                ['2007', 1368763, 1991297, 431097],
                ['2008', 799873, 1254823, 561983],
                ['2009', 1497653, 1732987, 1019874],
                ['2010', 1351874, 332871, 2027634],
                ['2011', 1582987, 649853, 1961085]
            ]);

            // map data for the first series, take x from the zero column and value from the first column of data set
            var data1 = dataSet.mapAs({x: [0], value: [1]});
            // map data for the second series, take x from the zero column and value from the second column of data set
            var data2 = dataSet.mapAs({x: [0], value: [2]});
            // map data for the third series, take x from the zero column and value from the third column of data set
            var data3 = dataSet.mapAs({x: [0], value: [3]});

            // create radar chart
            chart = anychart.radar();

            // set container id for the chart
            chart.container('container');

            // set chart title text settings
            chart.title('Region Sales by Year (2007-2011) (Stacked)');

            // force chart to stack values by Y scale.
            chart.yScale().stackMode(anychart.enums.ScaleStackMode.VALUE);

            // set yAxis settings
            chart.yAxis().stroke('#545f69');
            chart.yAxis().ticks().stroke('#545f69');

            // set yAxis labels settings
            chart.yAxis().labels().fontColor('#545f69')
                .textFormatter(function() {return this.value / 1000000 + 'M'});

            // set xAxis labels appearance settings
            var xAxisLabels = chart.xAxis().labels();
            xAxisLabels.padding(5);

            // set chart legend settings
            chart.legend()
                .align('center')
                .position('bottom')
                .enabled(true);

            // create first series with mapped data and appearance settings
            var series1 = chart.area(data1);
            series1.name('Arizona');

            // create second series with mapped data and appearance settings
            var series2 = chart.area(data2);
            series2.name('Florida');

            // create third series with mapped data and appearance settings
            var series3 = chart.area(data3);
            series3.name('Nevada');

            // initiate chart drawing
            chart.draw();
        });

    </script>



</body>

</html>
