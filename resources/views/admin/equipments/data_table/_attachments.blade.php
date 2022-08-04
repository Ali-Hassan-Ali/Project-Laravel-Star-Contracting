@if ($equipment->attachments()->count() > 0)

	<a href="{{ route('admin.equipments.attachments', $equipment->id) }}" class="btn btn-primary btn-sm" {{ $equipment->attachments ? '' : 'disabled' }}>
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@else

	<a href="#" disabled class="btn btn-primary btn-sm">
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@endif