@section('scripts')
    @parent
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(lineGraph);
        
        function lineGraph() {
            var data = new google.visualization.DataTable();
            var records = {!! $dataLineChart !!};

            data.addColumn('string', 'Month');
            data.addColumn('number', 'Open');
            data.addColumn('number', 'Closed');

            data.addRows(records);

            var options = {
                series: {
                    0: { color: '#3fd1ca'},
                    1: { color: '#ed3b3b'}
                },
                legend: { 
                    position: 'right',
                    alignment: 'center',
                },
                seriesType: 'line',
                explorer: {},    
                animation: {"startup": true, "duration": 400,},
                backgroundColor: 'none',
                chartArea: {"backgroundColor": '#fff0', "height": '70%', "width": '70%'}
            };

            var LineChart = new google.visualization.LineChart(document.getElementById('line-chart-container'));
            LineChart.draw(data, options);
        }
    </script>
@endsection

<div class="container border border-2 mt-8 shadow-md hover:shadow-lg rounded-md h-full-1/2">
    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Open vs. Closed Tickets
    </div>
    <div class="font-sans pt-4" id="line-chart-container"></div>
</div>