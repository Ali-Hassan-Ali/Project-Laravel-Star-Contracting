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
                            <a href="{{ route('admin.equipments.attachment.create', ['equipment' => $equipment->id]) }}" class="btn btn-primary">
                                <i class="fa fa-plus"></i> @lang('site.add')
                            </a>
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">@lang('equipments.equipments')</th>
                                    <th class="text-center">@lang('equipments.attachments_name')</th>
                                    <th class="text-center">@lang('site.action')</th>
                                </tr>
                                </thead>
                                <body>
                                    @foreach ($equipment->attachments as $data)
                                    <tr>
                                        <td>{{ $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            <a download="{{ $data->file_path }}" href="{{ $data->file_path }}" class="btn btn-primary btn-sm"
                                                data-html="true" data-placement="right" title="@lang('site.download')">
                                                <i class="fa fa-download"></i> 
                                            </a>
                                            <a target="_blank" href="{{ $data->file_path }}" class="btn btn-warning btn-sm"
                                                data-html="true" data-placement="right" title="@lang('site.show')">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            
                                            @if (auth()->user()->hasPermission('delete_equipments'))
                                                
                                                <form action="{{ route('admin.equipments.attachment.destroy', ['equipment' => $equipment->id,'attachment' => $data->id]) }}" class="my-1 my-xl-0" method="post" style="display: inline-block;">
                                                    @csrf
                                                    @method('delete')

                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        data-html="true" data-placement="right" title="@lang('site.delete')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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

@push('scripts')

    <script>

        $(document).on('click', '.open-pdf', function () {
            window.open($(this).attr('href'));
            return false;
        });

    </script>

@endpush
