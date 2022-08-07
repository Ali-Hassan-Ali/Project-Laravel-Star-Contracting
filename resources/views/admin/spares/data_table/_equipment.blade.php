@if ($spare->equipments)
	
	@foreach (json_decode($spare->equipments) as $data)
		<span class="badge badge-primary">{{ $data }}</span>
	@endforeach
	
@endif