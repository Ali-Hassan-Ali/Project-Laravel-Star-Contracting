@extends('dashboard_admin.layout.app')

@section('content')

@section('title', __('dashboard.admins') . ' | ' . __('dashboard.show'))

</header>

<div class="content-wrapper" style="min-height: 956.281px;">
    
    <section class="content-header">

        <h1>@lang('dashboard.admins')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.admin.welcome') }}"><i class="fa fa-dashboard"></i> @lang('dashboard.dashboard')</a></li>
            <li class="active">@lang('dashboard.admins')</li>
        </ol>

    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">

                <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.admins') <small>{{ $admins->count() }}</small></h3>

                <form action="{{ route('dashboard.admin.admins.index') }}" method="get">

                    <div class="row">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="@lang('dashboard.search')" value="{{ request()->search }}">
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('dashboard.search')</button>
                            @if (auth()->user()->hasPermission('admins_create'))
                                <a href="{{ route('dashboard.admin.admins.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('dashboard.add')</a>
                            @else
                                <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('dashboard.add')</a>
                            @endif
                        </div>

                    </div>
                </form><!-- end of form -->

            </div><!-- end of box header -->

            <div class="box-body">

                @if ($admins->count() > 0)

                    <div class="table-responsive">

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('dashboard.name')</th>
                                <th>@lang('dashboard.email')</th>
                                <th>@lang('dashboard.phone')</th>
                                <th>@lang('dashboard.citys')</th>
                                <th>@lang('dashboard.image')</th>
                                <th>@lang('dashboard.created_at')</th>
                                <th>@lang('dashboard.action')</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($admins as $index=>$admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->city->name }}</td>
                                    <td><img data-enlargeable width="100" style="cursor: zoom-in" src="{{ $admin->image_path }}" style="width: 100px;" class="img-thumbnail" alt=""></td>
                                    <td>{{ $admin->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        @if (auth()->user()->hasPermission('admins_update'))
                                            <a href="{{ route('dashboard.admin.admins.edit', $admin->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('dashboard.edit')</a>
                                        @else
                                            <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('dashboard.edit')</a>
                                        @endif
                                        @if (auth()->user()->hasPermission('admins_delete'))
                                            <form action="{{ route('dashboard.admin.admins.destroy', $admin->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('dashboard.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('dashboard.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            
                            @endforeach
                            </tbody>

                        </table><!-- end of table -->
                        
                        {{ $admins->appends(request()->query())->links() }}

                    </div><!-- end of table  responsive-->
                    
                @else
                    
                    <h2>@lang('dashboard.no_data_found')</h2>
                    
                @endif

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->
    
</div><!-- end of content wrapper -->

@endsection