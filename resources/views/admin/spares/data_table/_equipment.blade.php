@if (json_decode($spare->equipments))
	
	@foreach (json_decode($spare->equipments) as $data)
		@php
			 $equipment = \App\Models\Equipment::find($data);
		@endphp
		
		@if(isset($equipment))
			<span class="badge badge-primary text-center">{{ $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no }}</span>
		@endif

	@endforeach
	
@endif