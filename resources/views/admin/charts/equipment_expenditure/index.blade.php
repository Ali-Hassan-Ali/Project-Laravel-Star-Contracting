@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('statistics.statistics')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
		<li class="breadcrumb-item">@lang('statistics.statistics') @lang('statistics.equipment_expenditure')</li>
	</ul>
	
	<div class="row">
		
		<div class="col-md-12">
			
			{{--equipments chart--}}
			<div class="row my-3">
				
				<div class="col-md-12">
					
					<div class="card">
						
						
						<div class="card-body">

							<div class="row">
								
								{{--city--}}
								<div class="col-md-4">
									<div class="form-group">
										<select class="form-control col-6 select2-tags-false" id="equipment-city">
											<option value="">@lang('site.all') @lang('citys.citys')</option>
											@foreach ($citys as $city)
												<option value="{{ $city->id }}" data-name="{{ $city->name }}">{{ $city->name }}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
			                            <select id="equipment-man" class="form-control select2" required>
			                                <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
			                                @foreach ($equipments as $equipment)
												<option value="{{ $equipment->id }}" data-name="{{ $city->name }}">{{ $equipment->name }}</option>
											@endforeach
			                            </select>
		                        	</div>
		                        </div>

								<div class="col-md-4">
									
									<select id="report-year" class="form-control select2">
										@for ($i = 5; $i >=0 ; $i--)
											<option value="{{ now()->subYears($i)->year }}"
													{{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}>
												{{ now()->subYears($i)->year }}
											</option>
										@endfor
									</select>
								</div>

							</div>{{-- row --}}
							
							
							<div id="equipment-expenditure-chart-wrapper"></div>
						
						</div><!-- end of card body -->
					
					</div><!-- end of card -->
				
				</div><!-- end of col -->
			
			</div><!-- end of row equipments-->
			
		</div><!-- end of col -->
	
	</div><!-- end of row -->
@endsection

@push('scripts')
	
	<script>
        $(function () {

            // equipment
            FulChart("{{ now()->year }}");

            $('#equipment-city').on('change', function () {

                var cityId = $(this).find(':selected').val();
                var year   = $('#report-year').find(':selected').val() ?? "{{ now()->year }}";

                FulChart(year, cityId, 0);

            });//end of on change equipment
	        
            $('#equipment-man').on('change', function () {

                var cityId = $('#equipment-city').find(':selected').val();
                var year   = $('#report-year').find(':selected').val() ?? "{{ now()->year }}";

                var equipmentId = $(this).find(':selected').val();

                FulChart(year, cityId, equipmentId);

            });//end of on change equipment

            $('#report-year').on('change', function () {

                var year = $(this).find(':selected').val();

                FulChart(year);

            });//end of on change equipment

        });//end of document ready

        function FulChart(year, cityId = 0, equipmentId = 0) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#fuel-chart-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.chart.equipment_expenditure.chart') }}",
                data: {
                    'year': year,
                    'city_id': cityId,
                    'equipment_id': equipmentId,
                },
                cache: false,
                success: function (html) {

                	var city = $('#equipment-city').find(':selected').data('name');
                	var name = $('#equipment-man').find(':selected').data('name');
                	var year = $('#report-year').find(':selected').val();

                	var data = `${city} . '-' . ${name} . '-' . ${year}`;

                    $('#equipment-expenditure-chart-wrapper').empty().append(html);
                    // $('.apexcharts-legend').empty().append(data);

                },

            });//end of ajax call

        }//end of equipments
	
	</script>
@endpush