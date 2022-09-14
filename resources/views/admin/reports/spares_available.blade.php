@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.spares_available')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item">@lang('reports.spares_available')</li>
    </ul>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <div class="tile shadow">
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
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
                                
                                <table class="table datatable table-sm table-bordered table-hover" id="spares_available-table" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">@lang('citys.citys')</th>
                                        <th class="text-center">@lang('equipments.equipments')</th>
                                        <th class="text-center">@lang('spares.name')</th>
                                        <th class="text-center" style="width: 121px">@lang('spares.part_no')</th>
                                        <th class="text-center" style="width: 50px">@lang('spares.cost')</th>
                                        <th class="text-center" style="width: 121px">@lang('spares.freight_charges')</th>
                                        <th class="text-center" style="width: 121px">@lang('spares.used')</th>
                                        <th class="text-center" style="width: 100px">@lang('spares.location')</th>
                                        <th class="text-center" style="width: 100px">@lang('reports.total_cost')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 116px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-end" olspan="2">@lang('reports.total_cost_spare')</td>
                                        <td class="text-center" style="width: 50px">$ {{ $totalCostSpare }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- end of table responsive -->
                        
                        </div><!-- end of col -->
                    
                    </div><!-- end of row -->
                
                </div>{{--end of collapse --}}
            
            </div><!-- end of tile -->
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>
        let cityId;
        let DataTable = $('#spares_available-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.spares_available.data') }}',
            },
            columns: [
                {data: 'site', name: 'site'},
                {data: 'equipments', name: 'equipments'},
                {data: 'name', name: 'name'},
                {data: 'part_no', name: 'part_no'},
                {data: 'cost', name: 'cost'},
                {data: 'cost', name: 'cost'},
                {data: 'used', name: 'used'},
                {data: 'location', name: 'location'},
                {data: 'total_cost', name: 'total_cost'},
            ],
            buttons: [{
                footer: true,
                extend: "pdf",
                title: `Star-Contracting`,
                className: 'btn btn-primary',
                orientation: 'landscape',
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
            
            let url    = '{{ route('admin.spares_available.sum') }}';
            let count  = '{{ $spares->count() }}';
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