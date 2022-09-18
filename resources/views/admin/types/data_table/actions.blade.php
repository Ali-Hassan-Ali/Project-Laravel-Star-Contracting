@if (auth()->user()->hasPermission('update_types'))
    <a href="{{ route('admin.types.edit', $id) }}" class="btn btn-warning btn-sm"
        data-html="true" data-placement="right" title="@lang('site.edit')">
        <i class="fa fa-edit"></i> 
        {{-- @lang('site.edit') --}}
    </a>
@endif

@if (auth()->user()->hasPermission('delete_types'))
    <form action="{{ route('admin.types.destroy', $id) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-danger btn-sm delete"
            data-html="true" data-placement="right" title="@lang('site.delete')">
            <i class="fa fa-trash"></i> 
            {{-- @lang('site.delete') --}}
        </button>
    </form>
@endif
