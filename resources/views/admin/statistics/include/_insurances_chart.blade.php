<div id="insurances-chart"></div>

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
                name: "@lang('site.total') @lang('insurances.insurances')",
                data: @json($insurances->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($insurances->pluck('month')->toArray())
            }
        }

        var insurancesChart = new ApexCharts(document.querySelector("#insurances-chart"), options);

        insurancesChart.render();
    });//end of document ready
</script>