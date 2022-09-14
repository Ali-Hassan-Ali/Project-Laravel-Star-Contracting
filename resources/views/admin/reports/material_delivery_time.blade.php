@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.material_delivery_time')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item">@lang('reports.material_delivery_time')</li>
    </ul>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <div class="tile shadow">
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
{{--                            <label>@lang('citys.citys') <span class="text-danger">*</span></label>--}}
                            <select class="form-control col-6 select2-tags-false" id="data-table-search-city">
                                <option value="">@lang('site.all') @lang('citys.citys')</option>
                                @foreach ($citys as $city)
                                    <option data-id="{{ $city->id }}" value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
	                
	                <div class="col-md-6">
		                <div class="d-flex flex-row-reverse">
			                <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
				                <label class="form-check-label mr-5">@lang('reports.show_details')</label>
				                <input class="form-check-input" type="checkbox">
			                </div>
		                </div>
	                </div>
                
                </div><!-- end of row -->
	
	            <div class="collapse" id="collapse{{ $city->id }}">
		            
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
                                    <td class="text-center average" style="width: 50px">{{ number_format($total / $equipments->count(), 2) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        
                        </div><!-- end of table responsive -->
                    
                    </div><!-- end of col -->
                
                </div><!-- end of row -->
		            
	            </div>{{--end of collapse --}}
    
                <h4 class="text-end average-min">@lang('reports.average_delivery_time') {{ number_format($total / $equipments->count(), 2) }}</h4>
                
            </div><!-- end of tile -->
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>
        let cityId;
        let DataTable = $('#material_delivery_time-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.material_delivery_time.data') }}',
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
                title: `Star-Contracting`,
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                },
            }],
        });
        $('#data-table-search-city').change(function () {
            
            DataTable.search(this.value).draw();
    
            let url    = '{{ route('admin.material_delivery_time.sum') }}';
            let count  = '{{ $equipments->count() }}';
            var id     = $(this).find(':selected').data('id');
            var method = 'get';
            
            $.ajax({
                url: url,
                method: method,
                data: {city_id: id},
                success: function (data) {
                    let total = data.total / data.count;
                    let sum = $.number(total, 2);
                    $('.average').html(sum);
                    $('.average-min').html('Average Delivery Time ' + sum);
                }//end of success
            });//end of ajax
            
        });//end of data-table-search-city
    </script>

@endpush