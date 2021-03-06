@section('scripts')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['bar']});
        google.charts.setOnLoadCallback(barGraph);

        function barGraph() {
            var records = {!! $dataBarChart !!};
            var data = new google.visualization.arrayToDataTable(records);

            var options = {
            title: 'Tickets status breakdown',
            legend: { position: 'none' },
            bars: 'vertical',
            chartArea: {"backgroundColor": '#fff0', "height": '80%'},
            animation: {"startup": true, "duration": 400,},
            explorer: {},
            };

            var chart = new google.charts.Bar(document.getElementById('bar-chart-container'));
            chart.draw(data, options);
        }
    </script>
@endsection

<div class="container mt-8 shadow-md hover:shadow-lg rounded-md">
    <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
        Tickets Status Breakdown
    </div>
    <div class="font-sans" id="bar-chart-container"></div>
</div>