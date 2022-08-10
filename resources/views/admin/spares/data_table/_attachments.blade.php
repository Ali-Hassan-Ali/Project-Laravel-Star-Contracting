@if ($spare->attachments()->count() > 0)

	<a href="{{ route('admin.spares.attachment.index', $spare->id) }}" class="btn btn-primary btn-sm" {{ $spare->attachments ? '' : 'disabled' }}>
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@else

	<a href="#" disabled class="btn btn-primary btn-sm">
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@endif