@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.total_insurance_cost')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item title-download">@lang('reports.total_insurance_cost')</li>
	</ul>
	
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="tile shadow">

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <input placeholder="From" class="date-search report-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input placeholder="To" class="date-search report-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="end-date">
                        </div>
                    </div>

					{{--city--}}
					<div class="col-md-3">
						<div class="form-group">
							<select class="form-control report-search col-6 select2-tags-false" id="report-city">
								<option value="">@lang('site.all') @lang('citys.citys')</option>
								@foreach ($citys as $city)
									<option data-id="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
					{{--search--}}
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
						</div>
					</div>
					
				
				</div><!-- end of row -->

				<div class="row mb-2">
				
					<div class="col-md-12" for="total-insurance">
						<div class="d-flex flex-row-reverse" for="total-insurance">
							<div class="form-check form-switch" for="total-insurance" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
								<label class="form-check-label mr-5" for="total-insurance">@lang('reports.show_details')</label>
								<input class="form-check-input" id="total-insurance" type="checkbox">
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
										<th class="text-center" style="width: 50px">@lang('equipments.plate_no')</th>
										<th class="text-center" style="width: 50px">@lang('citys.citys')</th>
										<th class="text-center" style="width: 50px">@lang('insurances.insurer')</th>
										<th class="text-center" style="width: 50px">@lang('insurances.type_of_insurance')</th>
										<th class="text-center" style="width: 50px">@lang('insurances.policy_number')</th>
										<th class="text-center" style="width: 50px">@lang('insurances.premium')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center">@lang('reports.total_cost_of_insurance')</td>
										<td class="text-center total">$ {{ $total_premium  }}</td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
						
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total-min">@lang('reports.total_cost_of_insurance') $ {{ $total_premium }}</h4>
			
			</div><!-- end of tile -->
		
		</div><!-- end of col -->
	
	</div><!-- end of row -->

@endsection

@push('scripts')
	
	<script>
		
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
                url: '{{ route('admin.total_insurance_cost.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'plate_no', name: 'plate_no'},
                {data: 'city', name: 'city'},
                {data: 'insurer', name: 'insurer'},
                {data: 'type_of_insurance', name: 'type_of_insurance'},
                {data: 'policy_number', name: 'policy_number'},
                {data: 'premium', name: 'premium'},
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

        $(document).on('keyup change', '#data-table-search',function () {
            var sum = dataTable.column(5).data().sum();
            $('.total').html('*$ ' + sum);
            $('.total-min').html('Total Cost Of Insurance $ ' + sum);
            dataTable.search(this.value).draw();
        });

        $(document).on('keyup change', '.report-search', function () {

            cityID      = $('#report-city').val()  ?? false;
            startData   = $('#start-date').val()  ?? false;
        	endData     = $('#end-date').val() ?? false;

            let url     = '{{ route('admin.total_insurance_cost.sum') }}';
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
                    $('.total').html('$ ' + data);
                    $('.total-min').html('Total Cost Of Insurance $ ' + data);
                }//end of success
            });//end of ajax
            dataTable.ajax.reload();

        });//end of data-table-search-city
	</script>

@endpush