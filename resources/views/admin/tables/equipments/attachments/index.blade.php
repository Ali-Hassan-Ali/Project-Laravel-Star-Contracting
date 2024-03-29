@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item">@lang('equipments.attachments')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_equipments'))
                            <a href="{{ route('admin.equipments.attachment.create', ['equipment' => $equipment->id]) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('equipments.name')</th>
                                    <th class="text-center">@lang('equipments.make')</th>
                                    <th class="text-center">@lang('equipments.attachments_name')</th>
                                    <th class="text-center">@lang('site.action')</th>
                                </tr>
                                </thead>
                                <body>
                                    @foreach ($equipment->attachments as $data)
                                    <tr>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->make }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a download="{{ $data->file_path }}" href="{{ $data->file_path }}" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> @lang('site.download')</a>
                                            @if($data->type == 'pdf')
                                                <a target="_blank" href="{{ $data->file_path }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> @lang('site.show')</a>
                                            @else
                                                <a target="_blank" href="{{ $data->file_path }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> @lang('site.view')</a>
                                            @endif
                                            
                                            @if (auth()->user()->hasPermission('delete_equipments'))
                                                
                                                <form action="{{ route('admin.equipments.attachment.destroy', ['equipment' => $equipment->id,'attachment' => $data->id]) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </body>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
