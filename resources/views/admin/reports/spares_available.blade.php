@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.spares_available')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item title-download">@lang('reports.spares_available')</li>
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

                    <div class="col-md-6" for="total-insurance">
                        <div class="d-flex flex-row-reverse" for="total-insurance">
                            <div class="form-check form-switch" for="total-insurance" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
                                <label class="form-check-label mr-5" for="total-insurance">@lang('reports.show_details')</label>
                                <input class="form-check-input" id="spares-available" type="checkbox">
                            </div>
                        </div>
                    </div>

                </div><!-- end of row -->
                
                <div class="collapse" id="collapse">
                    
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
                                        <th class="text-center" style="width: 100px">@lang('reports.total_cost')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center">@lang('reports.total_cost_spare')</td>
                                        <td class="text-center total">$ {{ $totalCostSpare }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- end of table responsive -->
                        
                        </div><!-- end of col -->
                    
                    </div><!-- end of row -->
                
                </div>{{--end of collapse --}}

                <h4 class="text-end total-min">@lang('reports.total_cost_spare') $ {{ $totalCostSpare }}</h4>
            
            </div><!-- end of tile -->
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>
        
        function getDate(EData) {
            if (EData) {

                var newDate = $.datepicker.formatDate("dd-mm-yy", new Date(EData));
                return newDate;
            }

            return '';
        }

        var startData;
        var endData;
        let cityID;

        let dataTable = $('#spares_available-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.spares_available.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'site', name: 'site'},
                {data: 'equipments', name: 'equipments'},
                {data: 'name', name: 'name'},
                {data: 'part_no', name: 'part_no'},
                {data: 'cost', name: 'cost'},
                {data: 'cost', name: 'cost'},
                {data: 'used', name: 'used'},
                {data: 'total_cost', name: 'total_cost'},
            ],
            buttons: [{
                footer: true,
                extend: "pdf",
                text: 'All',
                title: function () { 
                    let title = $('.title-download').html() + '\n' + 'Date ' + "{{ now()->format('d-m-Y') }}" 
                                + '\n' + 'For ' + $('#report-city').find(':selected').text() + '\n' + 'From' + getDate($('#start-date').val()) + ' ' + 'To' + getDate($('#start-date').val());

                    return title;
                },
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

        $(document).on('keyup change', '#data-table-search',function () {
            var sum = dataTable.column(7).data().sum();
            dataTable.search(this.value).draw();
            $('.total').html('$ ' + sum);
            $('.total-min').html('Total Cost Of Available Spares $ ' + sum);
        });


        $(document).on('keyup change', '.report-search', function () {


            cityID      = $('#report-city').val()  ?? false;
            startData   = $('#start-date').val()  ?? false;
            endData     = $('#end-date').val() ?? false;

            let url     = '{{ route('admin.spares_available.sum') }}';
            var id      = $('#report-city').find(':selected').val();
            var method  = 'get';

            $.ajax({
                url: url,
                method: method,
                data: {
                    city_id: $('#report-city').val()  ?? false,
                    start_data: $('#start-date').val()  ?? false,
                    end_data: $('#end-date').val() ?? false,
                },
                success: function (data) {

                    let total = data.total / data.count;
                    let sum = $.number(total, 2);
                    $('.total').html('$ ' + sum);
                    $('.total-min').html('Total Cost Of Available Spares $ ' + sum);

                }//end of success
            });//end of ajax
            dataTable.ajax.reload();

        });//end of data-table-search-city


    </script>

@endpush

