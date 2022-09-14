<div id="eirs-chart"></div>

<script>
    $(function () {
        var options = {
              chart: {
                width: "100%",
                type: "bar"
              },
              title: {
                text: `@lang('chart.total_fuel_consumption')`,
                 style: {
                    fontSize: "20px",
                    fontFamily: "Helvetica, Arial, sans-serif",
                    fontWeight: "bold"
                  },
              },
              series: [
                    {
                      name: "@lang('chart.total_fuel_consumption') ($)",
                      data: [
                        @foreach ($fuels as $data)
                        {
                            x: "{{ $data->month }}", y: "{{ $data->total_units }}",
                        },
                        @endforeach
                      ],
                    },
                    {
                      name: "@lang('site.total') @lang('chart.no_of_gallons')",
                      data: [
                        @foreach ($fuels as $data)
                        {
                            x: "{{ $data->month }}", y: "{{ $data->total_cost }}",
                        },
                        @endforeach
                      ],
                    },
                ]
            };


        var eirsChart = new ApexCharts(document.querySelector("#eirs-chart"), options);

        eirsChart.render();

    });//end of document ready
</script>

{{-- yaxis: {
  title: {
    text: 'Smiley Percentage'
  }
},
xaxis: {
  title: {
    text: 'month'
  }
}, --}}