@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.breakdown_overview')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item title-download">@lang('reports.breakdown_overview')</li>
    </ul>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <div class="tile shadow">

                <div class="row">

                    {{--city--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control report-search col-6 select2-tags-false" id="report-city">
                                <option value="">@lang('site.all') @lang('citys.citys')</option>
                                @foreach ($citys as $city)
                                    <option data-id="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- from data --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <input placeholder="From" class="date-search start-date report-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date">
                        </div>
                    </div>

                    {{-- to data --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <input placeholder="To" class="date-search report-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="end-date">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">
                    {{--search--}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                        </div>
                    </div>

                    <div class="col-md-6" for="form-switch">
                        <div class="d-flex flex-row-reverse" for="form-switch">
                            <div class="form-check form-switch" for="form-switch" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <label class="form-check-label mr-5" for="form-switch">@lang('reports.show_details')</label>
                                <input class="form-check-input" id="form-switch" type="checkbox">
                            </div>
                        </div>
                    </div>

                </div><!-- end of row -->
                
                <div class="collapse" id="collapse">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            
                            <div class="table-responsive">
                                
                                <table class="table datatable table-sm table-bordered table-hover" id="breakdown_overview-table" style="width: 100%;">
                                    <thead>
                                    <tr>
{{--                                        <th class="text-center" style="width: 50px">@lang('site.DT_RowIndex')</th>--}}
                                        <th class="text-center" style="width: 50px">@lang('citys.citys')</th>
                                        <th class="text-center" style="width: 50px">@lang('status.as_of')</th>
                                        <th class="text-center" style="width: 50px">@lang('status.break_down_date')</th>
                                        <th class="text-center" style="width: 50px">@lang('status.break_down_duration')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.idle')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.date')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.actual_arrival_to_site_date')</th>
                                        <th class="text-center" style="width: 50px">@lang('reports.eir_break_down_duration')</th>
                                        <th class="text-center" style="width: 50px">@lang('reports.total_break_down_duration')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px">@lang('reports.no_of_break_down')</td>
                                        <td class="text-center" id="break-down-count" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px">@lang('reports.average_break_down_duration')</td>
                                        <td class="text-center average" style="width: 50px"></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- end of table responsive -->
                        
                        </div><!-- end of col -->
                    
                    </div><!-- end of row -->
                
                </div>{{--end of collapse --}}
    
                <h4 class="text-end count-min"></h4>
                <h4 class="text-end average-min"></h4>
                
            </div><!-- end of tile -->
            
            
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>

        function getStartDate(SData) {
            if (EData) {

                var newDate = $.datepicker.formatDate("dd-mm-yy", new Date(SData));
                return 'From ' + newDate;
            }

            return '';
        }

        function getEndDate(EData) {
            if (EData) {

                var newDate = $.datepicker.formatDate("dd-mm-yy", new Date(EData));
                return 'To ' + newDate;
            }

            return '';
        }

        var startData;
        var endData;
        let cityID;

        let dataTable = $('#breakdown_overview-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.reports.breakdown_overview.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'city', name: 'city'},
                {data: 'as_of', name: 'as_of'},
                {data: 'break_down_date', name: 'break_down_date'},
                {data: 'break_down_duration', name: 'break_down_duration'},
                {data: 'eir_idle', name: 'eir_idle'},
                {data: 'eir_date', name: 'eir_date'},
                {data: 'actual_arrival_to_site_date', name: 'actual_arrival_to_site_date'},
                {data: 'eir_break_down_duration', name: 'eir_break_down_duration'},
                {data: 'total_break_down_duration', name: 'total_break_down_duration'},
            ],
            rowGroup: {
                dataSrc: 'equipment_name',
                startRender: function (rows, group) {
                    return group;
                },
            },
            buttons: [{
                footer: true,
                extend: "pdf",
                title: function () { 
                    let title = $('.title-download').html() + '\n' + 'Date ' + "{{ now()->format('d-m-Y') }}" 
                                + '\n' + 'For ' + $('#report-city').find(':selected').text() + '\n' + getStartDate($('#start-date').val()) + ' ' + getEndDate($('#start-date').val());

                    return title;
                },
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                },
            }],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                var column = api.column(8).data();
     
                // Total over all pages
                total = api
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                $(api.column(8).footer()).html(total);
                $('.average-min').html('Average Breakdown Duration ' + total / total + ' Days');

                $('#break-down-count').html(column.count());
                $('.count-min').html('No Of Breakdowns ' + column.count());

            },
        });//end of dataTable

        $(document).on('keyup change', '#data-table-search',function () {
            dataTable.search(this.value).draw();
        });//end of dataTable


        $(document).on('keyup change', '.report-search', function () {

            cityID      = $('#report-city').val()  ?? false;
            startData   = $('#start-date').val()  ?? false;
            endData     = $('#end-date').val() ?? false;

            dataTable.ajax.reload();

        });//end of data-table-search-city

    </script>

@endpush



