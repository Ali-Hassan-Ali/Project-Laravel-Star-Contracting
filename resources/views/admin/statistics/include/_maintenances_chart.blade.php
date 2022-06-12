<div id="maintenances-chart"></div>

<script>
    $(function () {
        var options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                    borderRadius: 20,
                }

            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            dataLabels: {
                enabled: false
            },
            fill: {
                colors: ['#009688']
            },
            series: [{
                name: "@lang('site.total') @lang('maintenances.maintenances')",
                data: @json($maintenances->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($maintenances->pluck('month')->toArray())
            }
        }

        var maintenancesChart = new ApexCharts(document.querySelector("#maintenances-chart"), options);

        maintenancesChart.render();
    });//end of document ready
</script>