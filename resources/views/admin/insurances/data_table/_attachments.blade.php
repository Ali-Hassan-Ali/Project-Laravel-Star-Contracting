<a href="{{ route('admin.insurances.attachment.index', $insurance->id) }}" 
	class="btn btn-primary btn-sm">
	{{-- <i class="fa fa-edit"></i>  --}}
	{{-- @lang('site.download') --}}
	{{ '( ' . $insurance->attachments()->count() . ' )' }}
</a>