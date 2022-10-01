@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.material_delivery_time')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item title-download">@lang('reports.material_delivery_time')</li>
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
                            
                            <table class="table datatable table-sm table-bordered table-hover" id="material_delivery_time-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('citys.citys')</th>
                                    <th class="text-center">@lang('users.name')</th>
                                    <th class="text-center">@lang('eirs.eir_no')</th>
                                    <th class="text-center">@lang('eirs.date')</th>
                                    <th class="text-center">@lang('eirs.actual_arrival_to_site_date')</th>
                                    <th class="text-center">@lang('reports.delivery_time')</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-end" style="width: 50px">@lang('reports.average_delivery_time')</td>
                                    <td class="text-center average" style="width: 50px"></td>
                                </tr>
                                </tfoot>
                            </table>
                        
                        </div><!-- end of table responsive -->
                    
                    </div><!-- end of col -->
                
                </div><!-- end of row -->
		            
	            </div>{{--end of collapse --}}
    
                <h4 class="text-end average-min">
                    @lang('reports.average_delivery_time') 
                </h4>
                
            </div><!-- end of tile -->
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>

        function getStartDate(SData) {
            if (SData) {

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

        let dataTable = $('#material_delivery_time-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.reports.material_delivery_time.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'city', name: 'city'},
                {data: 'name', name: 'name'},
                {data: 'eir_no', name: 'eir_no'},
                {data: 'eir_date', name: 'eir_date'},
                {data: 'actual_arrival_to_site_date', name: 'actual_arrival_to_site_date'},
                {data: 'total_break_down_duration', name: 'total_break_down_duration'},
            ],
            buttons: [{
                footer: true,
                extend: "pdf",
                pageSize: 'A4',
                title: function () { 
                    let title = $('.title-download').html() + '\n' + 'Date ' + "{{ now()->format('d-m-Y') }}" 
                                + '\n' + 'For ' + $('#report-city').find(':selected').text() + '\n' + getStartDate($('#start-date').val()) + ' ' + getEndDate($('#start-date').val());

                    return title;
                },
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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
     
                // Total over all pages
                total = api
                    .column(5)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
     
                // Update footer
                $(api.column(5).footer()).html(total);

                $('.average-min').html('Average Delivery Time ' + total);
            },
        });

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