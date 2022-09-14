@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('reports.spares_used')</h2>
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
						
						<div class="table-responsive">
							
							<div class="col-md-12">
								
								<div class="d-flex">
									<div class="p-2"><h3>{{ $city->name }}</h3></div>
									<div class="ml-auto p-3">
										<div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
											<label class="form-check-label mr-5">@lang('reports.show_details')</label>
											<input class="form-check-input" type="checkbox">
										</div>
									</div>
								</div>
								
								<div class="collapse" id="collapse{{ $city->id }}">
									@php
										$total = 0;
									@endphp
									@foreach ($city->equipments as $index=>$equipment)
									
									@if ($equipment->sparesWithNotUse()->count() > 0)
										
										<strong>
											@lang('equipments.equipments') | {{ $equipment->make . ' ' . $equipment->name  . ' ' . $equipment->plate_no }}
										</strong>
										<div class="table-responsive-sm">
											<table class="table table-sm table-bordered table-hover">
												@if ($index == 0)
													<thead>
													<tr>
														<th class="text-center">@lang('spares.name')</th>
														<th class="text-center" style="width: 121px">@lang('spares.part_no')</th>
														<th class="text-center" style="width: 50px">@lang('spares.cost')</th>
														<th class="text-center" style="width: 121px">@lang('spares.freight_charges')</th>
														<th class="text-center" style="width: 121px">@lang('spares.used')</th>
														<th class="text-center" style="width: 100px">@lang('spares.location')</th>
														<th class="text-center" style="width: 100px">@lang('reports.total_cost')</th>
													</tr>
													</thead>
												@endif
												<body>
												@php
													$totalCost = 0;
												@endphp
												@foreach ($equipment->spares as $spare)
													@if($spare->used == '1')
														@php
															$totalCost += $spare->cost + $spare->freight_charges;
														@endphp
													<tr>
														<td class="text-center" style="width: 121px">{{ $spare->name }}</td>
														<td class="text-center" style="width: 116px">{{ $spare->part_no ?? '-' }}</td>
														<td class="text-center" style="width: 121px">$ {{ $spare->cost }}</td>
														<td class="text-center" style="width: 121px">$ {{ $spare->freight_charges }}</td>
														<td class="text-center" style="width: 121px">{{ $spare->used ? 'Yes' : 'No' }}</td>
														<td class="text-center" style="width: 100px">{{ $spare->location }}</td>
														<td class="text-center" style="width: 100px">$ {{ $spare->cost + $spare->freight_charges }}</td>
													</tr>
													@endif
												@endforeach
												</body>
												<tfoot>
												<tr>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px"></td>
													<td class="text-center" style="width: 50px">$ {{ $totalCost }}</td>
														@php
															$total += $totalCost;
														@endphp
												</tr>
												</tfoot>
											</table>
										</div>
									
									@endif
								@endforeach
								</div>{{-- end of collapse  --}}
								<table class="table table-sm table-hover">
								<tfoot>
									<tr>
									<td class="text-center" style="width: 121px"></td>
									<td class="text-center" style="width: 116px"></td>
									<td class="text-center" style="width: 121px"></td>
									<td class="text-center" style="width: 121px"></td>
{{--									<td class="text-center" style="width: 121px"></td>--}}
									<td class="text-end" olspan="2" >@lang('reports.total_cost_used')</td>
									<td class="text-center" style="width: 125px">$ {{ $total }}</td>
								</tr>
								</tfoot>
								</table>
								
							</div><!-- end of col -->
							
						</div><!-- end of row -->
					
					</div><!-- end of tile -->
				
				</div><!-- end of col -->
			
			</div><!-- end of row -->
		
		@endif
	
	@endforeach

@endsection