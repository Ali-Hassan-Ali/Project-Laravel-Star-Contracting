@if ($spare->equipments()->count() > 0)
	
	@foreach (json_decode($spare->equipments) as $data)
		@php
			 $equipment = \App\Models\Equipment::find($data);
		@endphp

		<span class="badge badge-primary">{{ $equipment->name }}</span>
	@endforeach
	
@endif