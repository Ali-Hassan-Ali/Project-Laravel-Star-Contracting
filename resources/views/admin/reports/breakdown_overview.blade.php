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

                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="From" class="date-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <input placeholder="To" class="date-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="end-date">
                        </div>
                    </div>

                </div><!-- end of row -->
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control col-6 select2-tags-false" id="equipment-city">
                                <option value="">@lang('site.all') @lang('citys.citys')</option>
                                @foreach ($citys as $city)
                                    <option data-id="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--equipment_id--}}
                    <div class="col-md-6">
                        <select id="equipment-man" class="form-control select2-tags-false" required>
                            <option value="" disabled>@lang('site.choose') @lang('equipments.equipments')</option>
                            {{-- @foreach ($equipments as $equipment)
								<option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
							@endforeach --}}
                        </select>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="d-flex flex-row-reverse">
                            <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
                                <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>
                
                </div><!-- end of row -->
                
                @php
                    $total = $average / $status->count();
                @endphp
                
                <div class="collapse" id="collapse{{ $city->id }}">
                    
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
                                        <td class="text-center count" style="width: 50px">{{ $status->count() }}</td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px">@lang('reports.average_break_down_duration')</td>
                                        <td class="text-center average" style="width: 50px">{{ number_format($total, 2) }} @lang('reports.days')</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- end of table responsive -->
                        
                        </div><!-- end of col -->
                    
                    </div><!-- end of row -->
                
                </div>{{--end of collapse --}}
    
                <h4 class="text-end count-min">@lang('reports.no_of_break_down') {{ $status->count() }}</h4>
                <h4 class="text-end average-min">@lang('reports.average_break_down_duration') {{ number_format($total, 2) }} @lang('reports.days')</h4>
                
            </div><!-- end of tile -->
            
            
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>

        let equipmentID;
        var startData;
        var endData;

        let dataTable = $('#breakdown_overview-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.breakdown_overview.data') }}',
                data: function (d) {
                    d.equipment_id = equipmentID;
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
                title: $('.title-download').html() + ' - ' + "{{ now()->format('d-m-Y') }}",
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                },
            }],
        });
        $('.date-search').change(function () {

            if ($('#start-date').val() && $('#end-date').val()) {

                startData = $('#start-date').val();
                endData   = $('#end-date').val();

                dataTable.ajax.reload();

            }//end of if
        });
        $('#equipment-man').change(function () {
    
            equipmentID = this.value;
            let url     = '{{ route('admin.breakdown_overview.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';
            
            $.ajax({
                url: url,
                method: method,
                data: {equipment_id: id},
                success: function (data) {
                    
                    let total = data.averages / data.count;
                    
                    $('.count').html(data.count);
                    $('.count-min').html('No Of Breakdowns ' + data.count);

                    $('.average').html($.number(total, 2));            
                    $('.average-min').html('Average Breakdown Duration ' + $.number(total, 2));

                }//end of success
            });//end of ajax
            
            dataTable.ajax.reload();
            
        });//end of data-table-search-city
        $('#equipment-city').change(function () {
    
            equipmentID = this.value;
            let url     = '{{ route('admin.breakdown_overview.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';
            
            if (!id) {
                
                $.ajax({
                    url: url,
                    method: method,
                    data: {equipment_id: id},
                    success: function (data) {
                        let total = data.averages / data.count;
                        $('.count').html(data.count);
                        $('.average').html($.number(total, 2));
                    }//end of success
                });//end of ajax
                DataTable.ajax.reload();
            }
    
        });//end of data-table-search-city
    </script>

@endpush