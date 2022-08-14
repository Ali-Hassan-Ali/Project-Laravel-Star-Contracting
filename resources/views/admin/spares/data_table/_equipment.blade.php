@if (json_decode($spare->equipments))
	
	@foreach (json_decode($spare->equipments) as $data)
		@php
			 $equipment = \App\Models\Equipment::find($data);
		@endphp

		<span class="badge badge-primary">{{ $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no }}</span>
	@endforeach
	
@endif