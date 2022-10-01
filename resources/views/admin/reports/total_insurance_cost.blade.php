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

					{{--city--}}
					<div class="col-md-3">
						<div class="form-group">
							<select class="form-control report-search equipment-city col-3 select2-tags-false" id="report-city">
								<option value="">@lang('site.all') @lang('citys.citys')</option>
								@foreach ($citys as $city)
									<option data-id="{{ $city->id }}" value="{{ $city->id }}">{{ $city->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

					{{-- equipments --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <select class="form-control report-search col-3 select2-tags-false equipment-man" id="report-city">
                                <option value="">@lang('site.all') @lang('equipments.equipments')</option>
                                @foreach ($equipments as $equipment)
                                    <option data-id="{{ $equipment->id }}" value="{{ $equipment->id }}">
                                        {{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no  }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

					{{-- from data --}}
                    <div class="col-md-3">
                        <div class="form-group">
                            <input placeholder="From" class="date-search report-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date">
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
                                    for="total-insurance" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
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
										<td class="text-center total"></td>
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
        let equipmentID;

        let dataTable = $('#breakdown_overview-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.reports.total_insurance_cost.data') }}',
                data: function (d) {
                    d.city_id      = cityID;
                    d.equipment_id = equipmentID;
                    d.start_data   = startData;
                    d.end_data     = endData;
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
                title: function () { 
                    let title = $('.title-download').html() + '\n' + 'Date ' + "{{ now()->format('d-m-Y') }}" 
                                + '\n' + 'For ' + $('#report-city').find(':selected').text() + '\n' + getStartDate($('#start-date').val()) + ' ' + getEndDate($('#start-date').val());

                    return title;
                },
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                	doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.defaultStyle.alignment = 'center';
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

                $('.total').html(' $' + total);
                $('.total-min').html('Total Cost Of Insurance $' + total);

            },
        });//end of dataTable

        $(document).on('keyup change', '#data-table-search',function () {
            dataTable.search(this.value).draw();
        });//end of dataTable

        $(document).on('keyup change', '.report-search', function () {

            cityID      = $('#report-city').val()  ?? false;
            startData   = $('#start-date').val()  ?? false;
        	endData     = $('#end-date').val() ?? false;
        	equipmentID = $('.equipment-man').val() ?? false;

            dataTable.ajax.reload();

        });//end of data-table-search-city

        $(document).on('change', '.equipment-city', function(e) {
            e.preventDefault();
            
            var id     = $(this).find(':selected').val();
            var url    = "/admin/ajax/city/"+id;
            var method = 'post';
            
            $.ajax({
                url: url,
                method: method,
                success: function (data) {
                    
                    $('.equipment-man').empty('');
                    $('.equipment-man').append(`<option value="">All Equipment</option>`);

                    $.each(data, function(index,item) {
                        
                        var html = `<option value="${item.id}" data-type="${item.spec_name}">${item.make} ${item.name} ${item.plate_no}</option>`;

                        $('.equipment-man').append(html);

                    });//end of each

                }//end of success
            })

        });//end of countrey

	</script>

@endpush