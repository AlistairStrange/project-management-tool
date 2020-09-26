@section('scripts')
    @parent
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(barGraph);

        function barGraph() {
            var records = {!! $dataBarChart !!};
            var data = new google.visualization.arrayToDataTable(records);

            var options = {
            legend: { position: 'none' },
            bars: 'vertical',
            colors: ['#3fd1ca'],
            chartArea: {"backgroundColor": '#fff0', "height": '70%', "width": '70%'},
            animation: {"startup": true, "duration": 400,},
            explorer: {},
            };

            var BarChart = new google.charts.Bar(document.getElementById('bar-chart-container'));
            BarChart.draw(data, options);
        }
    </script>
@endsection

<div class="container border border-2 mt-8 shadow-md hover:shadow-lg rounded-md h-full-1/2">
    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Tickets Status Breakdown
    </div>
    <div class="font-sans px-12 pt-4" id="bar-chart-container"></div>
</div>