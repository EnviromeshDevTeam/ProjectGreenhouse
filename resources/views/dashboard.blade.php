<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Live Environment Data from 1st Device</div>
                    <div class="panel-body">
                        <div id="tempChart" style="height:200px"></div>
                        <div id="humChart" style="height:200px"></div>
                        <div id="co2Chart" style="height:200px"></div>
                        <div id="tvocChart" style="height:200px"></div>
                        <div id="soilMoistChart" style="height:200px"></div>
                        <div id="cpuTempChart" style="height:200px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--    Lets try google charts first-->
    <!--Async the script tags??-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        //PHP foreach of data object?

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(tempChart);
        google.charts.setOnLoadCallback(humidityChart);
        google.charts.setOnLoadCallback(co2Chart);
        google.charts.setOnLoadCallback(tvocChart);
        google.charts.setOnLoadCallback(soilMoistChart);

        //for loop here $envData[i][values]
        //TODO: Was originally gonna forloop the chart but couldn't decide whether todo forloop in javascript or php cause of google charts loads

        function tempChart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envData[0]['values']);?>);
            var options = {
                title: <?= json_encode($envData[0]['title']);?>,
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: <?= json_encode($envData[0]['vAxis']);?>
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };
            let chartElement = new google.visualization.LineChart(document.getElementById(<?= json_encode($envData[0]['htmlId']);?>));
            chartElement.draw(data, options);
        }

        function humidityChart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envData[1]['values']);?>);
            var options = {
                title: <?= json_encode($envData[1]['title']);?>,
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: <?= json_encode($envData[1]['vAxis']);?>
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };
            let chartElement = new google.visualization.LineChart(document.getElementById(<?= json_encode($envData[1]['htmlId']);?>));
            chartElement.draw(data, options);
        }

        function co2Chart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envData[2]['values']);?>);
            var options = {
                title: <?= json_encode($envData[2]['title']);?>,
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: <?= json_encode($envData[2]['vAxis']);?>
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };
            let chartElement = new google.visualization.LineChart(document.getElementById(<?= json_encode($envData[2]['htmlId']);?>));
            chartElement.draw(data, options);
        }

        function tvocChart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envData[3]['values']);?>);
            var options = {
                title: <?= json_encode($envData[3]['title']);?>,
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: <?= json_encode($envData[3]['vAxis']);?>
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };
            let chartElement = new google.visualization.LineChart(document.getElementById(<?= json_encode($envData[3]['htmlId']);?>));
            chartElement.draw(data, options);
        }

        function soilMoistChart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envData[4]['values']);?>);
            var options = {
                title: <?= json_encode($envData[4]['title']);?>,
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: <?= json_encode($envData[4]['vAxis']);?>
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };
            let chartElement = new google.visualization.LineChart(document.getElementById(<?= json_encode($envData[4]['htmlId']);?>));
            chartElement.draw(data, options);
        }
    </script>
</x-app-layout>
