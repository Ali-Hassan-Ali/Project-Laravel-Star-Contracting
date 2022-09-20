<div id="equipment-expenditure-chart"></div>

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
                name: "@lang('equipments.total')",
                data: @json($total)
            }],
            xaxis: {
                categories: @json($month)
            }
        }

        var equipmentsChart = new ApexCharts(document.querySelector("#equipment-expenditure-chart"), options);

        equipmentsChart.render();
    });//end of document ready
</script>