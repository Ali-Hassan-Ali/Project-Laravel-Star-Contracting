<div id="equipments-chart"></div>

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
                name: "@lang('site.total') @lang('equipments.equipments')",
                data: @json($equipments->pluck('total')->toArray())
            }],
            xaxis: {
                categories: @json($equipments->pluck('month')->toArray())
            }
        }

        var equipmentsChart = new ApexCharts(document.querySelector("#equipments-chart"), options);

        equipmentsChart.render();
    });//end of document ready
</script>