@extends('layouts.admin.app')

@section('content')
	
	<div>
		<h2>@lang('site.home')</h2>
	</div>
	
	<ul class="breadcrumb mt-2">
		<li class="breadcrumb-item">@lang('site.home')</li>
	</ul>
	
	<div class="row">
		
		<div class="col-md-12">
			
			{{--top statistics--}}
			<div class="row">
				
				{{-- status --}}
				<div class="mb-2">
					
					<div class="card">
						
						<div class="card-body">
							
							<div>
								<canvas id="myChart"></canvas>
							</div>
							
						</div>
					</div>
				</div>
			
			
			</div>
		
		</div><!-- end of col -->
	
	</div><!-- end of row -->
@endsection

@push('scripts')
	
	{{--morris --}}
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script>
        const labels = [1,2,3];

        const data = {
            labels: labels,
            datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [4,145],
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };
	</script>
	
	<script>
        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
	</script>

@endpush