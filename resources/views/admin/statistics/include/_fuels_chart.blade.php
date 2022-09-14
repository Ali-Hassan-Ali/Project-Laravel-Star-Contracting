<div id="fuels-chart"></div>

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
                name: "@lang('site.total') @lang('fuels.fuels')",
                data: @json($fuels->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($fuels->pluck('month')->toArray())
            }
        }

        var fuelsChart = new ApexCharts(document.querySelector("#fuels-chart"), options);

        fuelsChart.render();
    });//end of document ready
</script>