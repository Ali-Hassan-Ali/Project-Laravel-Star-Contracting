@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.total_equipment_expenditure')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item">@lang('reports.total_equipment_expenditure')</li>
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
								
								<table class="table datatable table-sm table-bordered table-hover" id="material_delivery_time-table" style="width: 100%;">
									<thead>
									<tr>
										<th class="text-center" style="width: 50px">@lang('citys.citys')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.equipments')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.rental_cost_basis')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.driver_salary')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_spares_cost')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_cost_of_fuel')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_expenditure')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px">@lang('reports.total_expenditure')</td>
										<td class="text-center total" style="width: 50px">$ {{ $total }}</td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
						
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total">@lang('reports.total_expenditure') $ {{ $total }}</h4>
			
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
                url: '{{ route('admin.total_equipment_expenditure.data') }}',
            },
            columns: [
                {data: 'city', name: 'city'},
                {data: 'name', name: 'name'},
                {data: 'rental_cost_basis', name: 'rental_cost_basis'},
                {data: 'driver_salary', name: 'driver_salary'},
                {data: 'total_spares_cost', name: 'total_spares_cost'},
                {data: 'total_cost_of_fuel', name: 'total_cost_of_fuel'},
                {data: 'total_expenditure', name: 'total_expenditure'},
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

            let url    = '{{ route('admin.total_equipment_expenditure.sum') }}';
            var id     = $(this).find(':selected').data('id');
            var method = 'get';

            $.ajax({
                url: url,
                method: method,
                data: {city_id: id},
                success: function (data) {
                    $('.total').html('$ ' + data);
                }//end of success
            });//end of ajax

        });//end of data-table-search-city
	</script>

@endpush