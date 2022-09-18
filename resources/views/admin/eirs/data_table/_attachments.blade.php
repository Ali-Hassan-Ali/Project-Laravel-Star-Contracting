<a href="{{ route('admin.eirs.attachment.index', $eir->id) }}" class="btn btn-primary btn-sm">
	{{ '( ' . $eir->attachments()->count() . ' )' }}
</a>