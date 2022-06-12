<div id="specs-chart"></div>

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
                name: "@lang('site.total') @lang('specs.specs')",
                data: @json($specs->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($specs->pluck('month')->toArray())
            }
        }

        var specsChart = new ApexCharts(document.querySelector("#specs-chart"), options);

        specsChart.render();
    });//end of document ready
</script>