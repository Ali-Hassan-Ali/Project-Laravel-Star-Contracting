<div id="spares-chart"></div>

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
                name: "@lang('site.total') @lang('spares.spares')",
                data: @json($spares->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($spares->pluck('month')->toArray())
            }
        }

        var sparesChart = new ApexCharts(document.querySelector("#spares-chart"), options);

        sparesChart.render();
    });//end of document ready
</script>