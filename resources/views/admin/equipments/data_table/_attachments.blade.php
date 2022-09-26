{{-- @if ($equipment->attachments()->count() > 0) --}}

	<a href="{{ route('admin.equipments.attachment.index', $equipment->id) }}" class="btn btn-primary btn-sm">
		{{-- <i class="fa fa-eye"></i> --}}
		{{ '( ' . $equipment->attachments()->count() . ' )' }}
	</a>

{{-- @else

	<a href="#" disabled class="btn btn-primary btn-sm">
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@endif --}}