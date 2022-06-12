<div id="eirs-chart"></div>

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
                name: "@lang('site.total') @lang('eirs.eirs')",
                data: @json($eirs->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($eirs->pluck('month')->toArray())
            }
        }

        var eirsChart = new ApexCharts(document.querySelector("#eirs-chart"), options);

        eirsChart.render();
    });//end of document ready
</script>