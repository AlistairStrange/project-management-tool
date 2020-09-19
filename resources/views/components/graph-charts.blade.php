@section('scripts')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart',]});
        google.charts.setOnLoadCallback(drawChart);
        
        function drawChart() {
            var data = new google.visualization.DataTable();
            var records = {!! $data !!}

            data.addColumn('string', 'Month');
            data.addColumn('number', 'Open Tickets');
            data.addColumn('number', 'Closed Tickets');

            data.addRows(records);

            var options = {
                hAxis: {
                title: 'Months',
                },
                vAxis: {
                title: '# of Tickets'
                },
                series: {
                    0: { color: '#3fd1ca'},
                    1: { color: '#ed3b3b'}
                },
                seriesType: 'line',
                explorer: {},    
                animation: {"startup": true, "duration": 400,},
                backgroundColor: 'none',
                chartArea: {"backgroundColor": '#fff0',}
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
@endsection

<div class="container mt-8 shadow-md hover:shadow-lg rounded-md">
    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Open vs. Closed Tickets
    </div>
    <div class="font-sans" id="chart_div"></div>
</div>