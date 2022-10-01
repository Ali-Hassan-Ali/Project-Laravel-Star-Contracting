@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.equipments_overview')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
		<li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
	</ul>
	
	@foreach ($citys as $city)
		
		@if ($city->equipments()->count() > 0)
			
			<div class="row">
				
				<div class="col-md-12">
					
					<div class="tile shadow">
						
						<div class="col-md-6">
							<a href="" class="btn btn-primary print" data-id="{{ $city->id }}"><i class="fa fa-file-pdf" aria-hidden="true"></i> @lang('site.print')</a>
						</div>
						
						<div class="table-responsive" id="print-{{ $city->id }}">
							
							<div class="col-md-12">
								
								<div class="d-flex">
									<div class="p-2"><h3>{{ $city->name }}</h3></div>
									<div class="ml-auto p-3">
										<div class="form-check form-switch">
											<label class="form-check-label mr-5">@lang('reports.show_details')</label>
											<input class="form-check-input" type="checkbox"
											data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
										</div>
									</div>
								</div>
								
								<div class="collapse" id="collapse{{ $city->id }}">
									
									@foreach ($city->equipments as $index=>$equipment)
									
									@if ($equipment->count() > 0)
										
										<strong>
											@lang('equipments.equipments') | {{ $equipment->make . ' ' . $equipment->name  . ' ' . $equipment->plate_no }}
										</strong>
										
										@if($equipment->statusBreakdown->count() > 0)
											{{--status--}}
											<h4 class="ml-3">@lang('reports.table_status')</h4>
											<div class="table-responsive-sm">
												{{--status--}}
												<table class="table table-sm table-bordered table-hover ml-3">
												@if ($index == 0)
												<thead>
													<tr>
														<th class="text-center" style="width: 150px">@lang('status.as_of')</th>
														<th class="text-center" style="width: 250px">@lang('status.working_status')</th>
														<th class="text-center" style="width: 0px">@lang('status.break_down_date')</th>
													</tr>
													</thead>
												@endif
												<body>
												@foreach ($equipment->statusBreakdown as $statu)
													<tr>
														<td class="text-center" style="width: 150px">{{ $statu->as_of ? date('d-m-Y', strtotime($statu->as_of)) : '' }}</td>
														<td class="text-center" style="width: 250px">{{ $statu->working_status }}</td>
														<td class="text-center" style="width: 0px">{{ $statu->break_down_date ? date('d-m-Y', strtotime($statu->break_down_date)) : '' }}</td>
													</tr>
												@endforeach
												</body>
												<tfoot>
													<tr>
														<td class="text-end" colspan="2" style="width: 250px">@lang('reports.no_of_break_down')</td>
														<td class="text-center" style="width: 0px">{{ $equipment->statusBreakdown->count() }}</td>
													</tr>
													</tfoot>
												</table>
											</div>
										@endif
										
										@if($equipment->eirs->count() > 0)
											{{--eir--}}
											<h4 class="ml-3">@lang('reports.table_EIRs')</h4>
											<div class="table-responsive-sm">
												{{--status--}}
												<table class="table table-sm table-bordered table-hover ml-3">
													@if ($index == 0)
													<thead>
														<tr>
															<th class="text-center" style="width: 150px">@lang('eirs.date')</th>
															<th class="text-center" style="width: 250px">@lang('eirs.eir_no')</th>
															<th class="text-center" style="width: 0px">@lang('eirs.status')</th>
														</tr>
														</thead>
													@endif
													<body>
													@foreach ($equipment->eirs as $eir)
														<tr>
															<td class="text-center" style="width: 150px">{{ $eir->date ? date('d-m-Y', strtotime($eir->date)) : '' }}</td>
															<td class="text-center" style="width: 250px">{{ $eir->eir_no }}</td>
															<td class="text-center" style="width: 0px">{{ $eir->status }}</td>
														</tr>
													@endforeach
													</body>
													<tfoot>
													<tr>
														<td class="text-end" colspan="2" style="width: 250px">@lang('reports.total_EIRs')</td>
														<td class="text-center" style="width: 0px">{{ $equipment->eirs->count() }}</td>
													</tr>
													</tfoot>
												</table>
											</div>
										@endif
										
										@if($equipment->sparesUsed->count() > 0)
											{{--spares--}}
											<h4 class="ml-3">@lang('reports.table_spares')</h4>
											<div class="table-responsive-sm">
												{{--spares--}}
												<table class="table table-sm table-bordered table-hover ml-3">
													@if ($index == 0)
													<thead>
													<tr>
														<th class="text-center" style="width: 50px">@lang('spares.used')</th>
														<th class="text-center" style="width: 50px">@lang('spares.cost')</th>
														<th class="text-center" style="width: 50px">@lang('spares.freight_charges')</th>
														<th class="text-center" style="width: 50px">@lang('reports.total_cost_of_used_spares')</th>
													</tr>
													</thead>
													@endif
													<body>
													@php
														$total_cost_of_used_spares = 0;
													@endphp
													@foreach ($equipment->sparesUsed as $spare)
														@php
															$total_cost_of_used_spares += $spare->cost + $spare->freight_charges;
														@endphp
														<tr>
															<td class="text-center" style="width: 50px">{{ $spare->used ? 'Yes' : 'No' }}</td>
															<td class="text-center" style="width: 50px">{{ $spare->cost }}</td>
															<td class="text-center" style="width: 50px">{{ $spare->freight_charges }}</td>
															<td class="text-center" style="width: 50px">{{ $spare->cost + $spare->freight_charges }}</td>
														</tr>
													@endforeach
													</body>
													<tfoot>
													<tr>
														<td class="text-center" style="width: 05px">{{ $equipment->sparesUsed->count() }}</td>
														<td class="text-center" style="width: 50px"></td>
														<td class="text-center" style="width: 50px"></td>
														<td class="text-center" style="width: 50px">{{ $total_cost_of_used_spares }}</td>
													</tr>
													</tfoot>
												</table>
											</div>
										@endif
										
										@if($equipment->fuels->count() > 0)
											{{--fuels--}}
											<h4 class="ml-3">@lang('reports.table_fuel')</h4>
											<div class="table-responsive-sm">
												{{--fuels--}}
												<table class="table table-sm table-bordered table-hover ml-3">
													@if ($index == 0)
													<thead>
														<tr>
															<th class="text-center" style="width: 50px">@lang('fuels.no_of_units_filled')</th>
															<th class="text-center" style="width: 50px">@lang('fuels.total_cost_of_fuel')</th>
														</tr>
														</thead>
													@endif
													<body>
													@foreach ($equipment->fuels as $fuel)
													<tr>
															<td class="text-center" style="width: 50px">{{ $fuel->no_of_units_filled }}</td>
															<td class="text-center" style="width: 50px">{{ $fuel->total_cost_of_fuel}}</td>
														</tr>
													@endforeach
													</body>
													<tfoot>
													<tr>
														<td class="text-center" style="width: 50px">{{ $equipment->fuels->sum('no_of_units_filled') }}</td>
														<td class="text-center" style="width: 50px">{{ $equipment->fuels->sum('total_cost_of_fuel') }}</td>
													</tr>
													</tfoot>
												</table>
											</div>
										@endif
									
									@endif
								@endforeach
								
								</div>{{-- end of collapse  --}}
							
							</div><!-- end of col -->
						
						</div><!-- end of row -->
					
					</div><!-- end of tile -->
				
				</div><!-- end of col -->
			
			</div><!-- end of row -->
		
		@endif
	
	@endforeach

@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
	<script>
        $('.print').click(function (e) {
            e.preventDefault();
            
            var id = $(this).data('id');
	        
            var element = document.getElementById('print-' + id);

            var opt = {
                margin:       1,
                filename:     'myfile.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2 },
                jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
            };

			// New Promise-based usage:
            html2pdf().set(opt).from(element).save();

			// Old monolithic-style usage:
            html2pdf(element, opt);
            
        });//end of click
	</script>
	
@endpush