<a href="{{ route('admin.spares.attachment.index', $spare->id) }}" class="btn btn-primary btn-sm" {{ $spare->attachments ? '' : 'disabled' }}>
	{{ '( ' . $spare->attachments()->count() . ' )' }}
</a>