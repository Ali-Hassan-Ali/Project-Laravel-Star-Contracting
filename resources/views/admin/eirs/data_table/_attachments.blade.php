@if ($eir->attachments()->count() > 0)

	<a href="{{ route('admin.eirs.attachment.index', $eir->id) }}" class="btn btn-primary btn-sm" {{ $eir->attachments ? '' : 'disabled' }}>
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@else

	<a href="#" disabled class="btn btn-primary btn-sm">
		<i class="fa fa-eye"></i> @lang('site.all_attachments')
	</a>

@endif