@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.average_expenditure_per_km')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item title-download">@lang('reports.average_expenditure_per_km')</li>
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

                    <div class="col-md-6">
                        <div class="d-flex flex-row-reverse">
                            <div class="form-check form-switch">
                                <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                <input class="form-check-input" type="checkbox"
                                       data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
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
										<th class="text-center" style="width: 50px">@lang('equipments.equipments')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.rental_cost_basis')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.driver_salary')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_spares_cost')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_cost_of_fuel')</th>
										<th class="text-center" style="width: 50px">@lang('reports.total_expenditure')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.average_mileage_reading')</th>
										<th class="text-center" style="width: 50px">@lang('reports.average_expenditure')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px">@lang('reports.average_expenditure')</td>
										<td class="text-center total" style="width: 50px"></td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
						
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total-min"></h4>
			
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
                url: '{{ route('admin.reports.expenditure_per_KM.data') }}',
                data: function (d) {
                    d.city_id = cityID;
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'city', name: 'city'},
                {data: 'name', name: 'name'},
                {data: 'rental_cost_basis', name: 'rental_cost_basis'},
                {data: 'driver_salary', name: 'driver_salary'},
                {data: 'total_spares_cost', name: 'total_spares_cost'},
                {data: 'total_cost_of_fuel', name: 'total_cost_of_fuel'},
                {data: 'total_expenditure', name: 'total_expenditure'},
                {data: 'average_mileage_reading', name: 'average_mileage_reading'},
                {data: 'average_expenditure', name: 'average_expenditure'},
            ],
            buttons: [{
                footer: true,
                extend: "pdf",
                pageSize: 'A4',
                orientation: 'landscape',
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
                    doc.content.push(
                        {text: $('.dataTables_info').text() , margin:[0, 10, 0, 100]},
                    );
                },
            }],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
     
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };

                var columnCount = api.column(8).data();
     
                // Total over all pages
                total = api
                    .column(8)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                if (total == 0) {
                    
                    // Update footer
                    $(api.column(8).footer()).html('0');
                    $('.total-min').html('Total Expenditure 0');

                } else {

                    var sum = total / columnCount.count();

                    // Update footer
                    $(api.column(8).footer()).html('$ ' + $.number(sum, 2));
                    $('.total-min').html('Average Expenditure $ ' + $.number(sum, 2));

                }//end of if

     
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