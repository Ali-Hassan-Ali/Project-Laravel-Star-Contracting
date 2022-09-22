@if (json_decode($spare->equipments))
	
	@foreach (json_decode($spare->equipments) as $data)
		@php
			 $equipment = \App\Models\Equipment::find($data);
		@endphp
		
		@if(isset($equipment))
			{{ $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no }} <br>
		@endif

	@endforeach
	
@endif