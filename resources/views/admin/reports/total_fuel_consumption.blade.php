@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.total_fuel_consumption')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item title-download">@lang('reports.total_fuel_consumption')</li>
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
										<th class="text-center" style="width: 50px">@lang('citys.citys')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.project')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.equipments')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.no_of_units_filled')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.fuel_rate_per_litre')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.total_cost_of_fuel')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" id="total-unit" style="width: 50px">{{ $totalUnit }}</td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center total-cost" style="width: 50px">$ {{ $totalCost }}</td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
						
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total-cost">@lang('fuels.total_cost_of_fuel') $ {{ $totalCost }}</h4>
				<h4 class="text-end total-unit">@lang('fuels.no_of_units_filled') {{ $totalUnit }}</h4>
			
			</div><!-- end of tile -->
		
		</div><!-- end of col -->
	
	</div><!-- end of row -->

@endsection

@push('scripts')
	
	<script>
        function getStartDate(EData) {
            if (EData) {

                var newDate = $.datepicker.formatDate("dd-mm-yy", new Date(EData));
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
                url: '{{ route('admin.total_fuel_consumption.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'city', name: 'city'},
                {data: 'project', name: 'project'},
                {data: 'name', name: 'name'},
                {data: 'no_of_units_filled', name: 'no_of_units_filled'},
                {data: 'fuel_rate_per_litre', name: 'fuel_rate_per_litre'},
                {data: 'total_cost_of_fuel', name: 'total_cost_of_fuel'},
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
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                },
            }],
        });

        $(document).on('keyup change', '#data-table-search',function () {
            
            dataTable.search(this.value).draw();

            var sum = dataTable.column(5).data().sum();
            var totalUnit = dataTable.column(3).data().sum();
            
            $('#total-unit').html(totalUnit);

            $('.total').html('$ ' + sum);
            $('.total-min').html('Total Cost Of Fuel $ ' + sum);
        });


        $(document).on('keyup change', '.report-search', function () {


            cityID      = $('#report-city').val()  ?? false;
            startData   = $('#start-date').val()  ?? false;
            endData     = $('#end-date').val() ?? false;

            let url     = '{{ route('admin.total_fuel_consumption.sum') }}';
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
                    $('.total-min').html('Total Cost Of Fuel $ ' + sum);

                }//end of success
            });//end of ajax
            dataTable.ajax.reload();

        });//end of data-table-search-city

	</script>

@endpush