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
                        <div id="envChart" style="height:200px"></div>
                        <!--May need to create multiple of these with incrementing ids-->
                        <p>{{!!json_encode($envName)!!}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--    Lets try google charts first-->

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        //PHP foreach of data object?

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(EnvLineChart);

        function EnvLineChart() {
            var data = new google.visualization.arrayToDataTable(<?= json_encode($envName);?>);

            var options = {
                title: 'Humidity Graph',
                hAxis: {
                    title: 'created_at'
                },
                vAxis: {
                    title: 'humidity'
                },
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                backgroundColor: 'f1f8e9'
            };

            let chartElement = new google.visualization.LineChart(document.getElementById('envChart'));
            chartElement.draw(data, options);
        }
    </script>
</x-app-layout>
