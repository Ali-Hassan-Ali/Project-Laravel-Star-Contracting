@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.total_hours_worked')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item">@lang('reports.total_hours_worked')</li>
	</ul>
	
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="tile shadow">
				
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
							<div class="form-check form-switch" data-toggle="collapse" href="#collapse" role="button" aria-expanded="false" aria-controls="collapse">
								<label class="form-check-label mr-5">@lang('reports.show_details')</label>
								<input class="form-check-input" type="checkbox">
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
										<th class="text-center" style="width: 50px">@lang('fuels.project')</th>
										<th class="text-center" style="width: 50px">@lang('fuels.hours_worked_weekly')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center"></td>
										<td class="text-center"></td>
										<td class="text-center">@lang('reports.total_hours_worked')</td>
										<td class="text-center total">{{ $total_hours }}</td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
							
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total-min">@lang('reports.total_hours_worked') {{ $total_hours }}</h4>
			
			</div><!-- end of tile -->
			
		</div><!-- end of col -->
	
	</div><!-- end of row -->

@endsection

@push('scripts')
	
	<script>
        let equipmentID;
        let DataTable = $('#breakdown_overview-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.total_hours_worked.data') }}',
                data: function (d) {
                    d.equipment_id = equipmentID;
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'plate_no', name: 'plate_no'},
                {data: 'city', name: 'city'},
                {data: 'project', name: 'project'},
                {data: 'hours_worked_weekly', name: 'hours_worked_weekly'},
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

        $('#equipment-man').change(function () {

            equipmentID = this.value;
            let url     = '{{ route('admin.total_hours_worked.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';

            $.ajax({
                url: url,
                method: method,
                data: {equipment_id: id},
                success: function (data) {
                    $('.total').html(data);
                    $('.total-min').html('Total Hours Worked ' + data);
                }//end of success
            });//end of ajax

            DataTable.ajax.reload();

        });//end of data-table-search-city
        $('#equipment-city').change(function () {

            equipmentID = this.value;
            let url     = '{{ route('admin.total_hours_worked.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';

            if (!id) {

                $.ajax({
                    url: url,
                    method: method,
                    data: {equipment_id: id},
                    success: function (data) {
                        $('.total').html(data);
                        $('.total-min').html('Total Hours Worked ' + data);
                    }//end of success
                });//end of ajax
                DataTable.ajax.reload();
            }

        });//end of data-table-search-city
	</script>

@endpush