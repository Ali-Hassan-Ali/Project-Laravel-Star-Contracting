@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.eir_overview')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item title-download">@lang('reports.eir_overview')</li>
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
							<div class="form-check form-switch" data-toggle="collapse" href="#collapse-eir_overview" role="button" aria-expanded="false" aria-controls="collapse-eir_overview">
								<label class="form-check-label mr-5">@lang('reports.show_details')</label>
								<input class="form-check-input" type="checkbox">
							</div>
						</div>
					</div>
				
				</div><!-- end of row -->
				
				<div class="collapse" id="collapse-eir_overview">
					
					<div class="row">
						
						<div class="col-md-12">
							
							<div class="table-responsive">
								
								<table class="table datatable table-sm table-bordered table-hover" id="eir_overview-table" style="width: 100%;">
									<thead>
									<tr>
{{--										<th class="text-center">@lang('site.DT_RowIndex')</th>--}}
										<th class="text-center">@lang('eirs.eir_no')</th>
										<th class="text-center">@lang('eirs.date')</th>
										<th class="text-center">@lang('eirs.status')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center"></td>
										<td class="text-end" >@lang('reports.total_EIRs')</td>
										<td class="text-center count">{{ $eirs->count() }}</td>
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
        let equipmentID;
        let DataTable = $('#eir_overview-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.eir_overview.data') }}',
                data: function (d) {
                    d.equipment_id = equipmentID;
                }
            },
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'eir_no', name: 'eir_no'},
                {data: 'date', name: 'date'},
                {data: 'status', name: 'status'},
            ],
            rowGroup: {
                dataSrc: 'equipment_name',
                startRender: function (rows, group) {
                    return  group;
                },
            },
            buttons: [{
                footer: true,
                extend: "pdf",
                pageSize: 'A4',
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

        $('#equipment-man').change(function () {

            equipmentID = this.value;
            let url     = '{{ route('admin.eir_overview.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';

            $.ajax({
                url: url,
                method: method,
                data: {equipment_id: id},
                success: function (data) {
                    $('.count').html(data.count);
                }//end of success
            });//end of ajax

            DataTable.ajax.reload();

        });//end of data-table-search-city
        $('#equipment-city').change(function () {

            equipmentID = this.value;
            let url     = '{{ route('admin.eir_overview.sum') }}';
            var id      = $(this).find(':selected').val();
            var method  = 'get';

            if (!id) {

                $.ajax({
                    url: url,
                    method: method,
                    data: {equipment_id: id},
                    success: function (data) {
                        $('.count').html(data.count);
                    }//end of success
                });//end of ajax
                DataTable.ajax.reload();
            }

        });//end of data-table-search-city
	</script>

@endpush