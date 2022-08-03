
@foreach (json_decode($equipment->project_allocated_to) as $data)
	<span class="badge badge-primary">{{ $data }}</span>
@endforeach