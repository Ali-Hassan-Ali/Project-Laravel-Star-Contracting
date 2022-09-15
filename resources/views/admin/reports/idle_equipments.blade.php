@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.idle_equipments')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('reports.reports')</li>
		<li class="breadcrumb-item title-download">@lang('reports.idle_equipments')</li>
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
{{--										<th class="text-center" style="width: 50px">@lang('reports.number')</th>--}}
										<th class="text-center" style="width: 50px">@lang('citys.citys')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.equipments')</th>
										<th class="text-center" style="width: 50px">@lang('equipments.plate_no')</th>
									</tr>
									</thead>
									<tfoot>
									<tr>
										<td class="text-center" style="width: 50px"></td>
										<td class="text-center" style="width: 50px">@lang('reports.total_idle_equipments')</td>
										<td class="text-center total" style="width: 50px">{{ $equipments->count()  }}</td>
									</tr>
									</tfoot>
								</table>
							
							</div><!-- end of table responsive -->
						
						</div><!-- end of col -->
					
					</div><!-- end of row -->
				
				</div>{{--end of collapse --}}
				
				<h4 class="text-end total-min">@lang('reports.total_idle_equipments') {{ $equipments->count() }}</h4>
			
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
                url: '{{ route('admin.idle_equipments.data') }}',
            },
            columns: [
                {data: 'city', name: 'city'},
                {data: 'name', name: 'name'},
                {data: 'plate_no', name: 'plate_no'},
            ],//columns
            buttons: [{
                footer: true,
                extend: "pdf",
                title: $('.title-download').html() + ' - ' + "{{ now()->format('d-m-Y') }}",
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                    doc.content[1].table.headerRows = 0;
                },
            }],//buttons
        });

        $('#data-table-search-city').change(function () {

            DataTable.search(this.value).draw();

            let url    = '{{ route('admin.idle_equipments.sum') }}';
            var id     = $(this).find(':selected').data('id');
            var method = 'get';

            $.ajax({
                url: url,
                method: method,
                data: {city_id: id},
                success: function (data) {
                    $('.total').html(data);
                    $('.total-min').html('Total Idle Equipment ' + data);
                }//end of success
            });//end of ajax

        });//end of data-table-search-city
	</script>

@endpush