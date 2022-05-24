@extends('dashboard_admin.layout.app')

@section('content')

@section('title', __('dashboard.dashboard') .' - '. __('dashboard.apartments') .' - '. __('dashboard.show'))

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dashboard.apartments')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.admin.welcome') }}"><i class="fa fa-dashboard"></i> @lang('dashboard.dashboard')</a></li>
                <li class="active">@lang('dashboard.apartments')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('dashboard.apartments') <small>{{ $apartments->total() }}</small></h3>

                    <form action="{{ route('dashboard.admin.apartments.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('dashboard.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('dashboard.search')</button>
                                @if (auth()->user()->hasPermission('apartments_create'))
                                    <a href="{{ route('dashboard.admin.apartments.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('dashboard.add')</a>
                                @else
                                    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('dashboard.add')</a>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($apartments->count() > 0)
                    
                        <div class="table-responsive">
                            
                            <table class="table table-hover">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('dashboard.title')</th>
                                    <th>@lang('dashboard.type')</th>
                                    {{-- <th>@lang('dashboard.city')</th> --}}
                                    <th>@lang('dashboard.city')</th>
                                    <th>@lang('dashboard.status')</th>
                                    <th>@lang('dashboard.image')</th>
                                    <th>@lang('dashboard.created_at')</th>
                                    <th>@lang('dashboard.action')</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                @foreach ($apartments as $index=>$apartment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $apartment->title }}</td>
                                        <td>{{ $apartment->type }}</td>
                                        <td>{{ $apartment->city }}</td>
                                        <td>
                                            {{ $apartment->status == false ? 'warning' : 'success' }}
                                            @if (auth()->user()->hasPermission('apartments_status'))
                                                <a href="{{ route('dashboard.admin.apartments.status', $apartment->id) }}" class="btn btn-{{ $apartment->status == false ? 'danger' : 'success' }} btn-sm">
                                                    <i class="fa fa-eye"></i> 
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-{{ $apartment->status == false ? 'danger' : 'success' }} btn-sm disabled">
                                                    <i class="fa fa-edit"></i> 
                                                </a>
                                            @endif
                                        </td>
                                        <td><img src="{{ $apartment->image_path }}" width="70"></td>
                                        <td>{{ $apartment->created_at->toFormattedDateString() }}</td>
                                        <td>
                                            @if (auth()->user()->hasPermission('apartments_update'))
                                                <a href="{{ route('dashboard.admin.apartments.edit', $apartment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('dashboard.edit')</a>
                                            @else
                                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('dashboard.edit')</a>
                                            @endif
                                            @if (auth()->user()->hasPermission('apartments_delete'))
                                                <form action="{{ route('dashboard.admin.apartments.destroy', $apartment->id) }}" method="post" style="display: inline-block">
                                                    {{ csrf_field() }}
                                                    {{ method_field('delete') }}
                                                    <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('dashboard.delete')</button>
                                                </form><!-- end of form -->
                                            @else
                                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('dashboard.delete')</button>
                                            @endif
                                            @if (auth()->user()->hasPermission('apartments_read'))
                                                <a href="{{ route('dashboard.admin.apartments.show', $apartment->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> @lang('dashboard.show')</a>
                                            @endif
                                        </td>
                                    </tr>
                                
                                @endforeach
                                </tbody>

                            </table><!-- end of table -->
                            
                            {{ $apartments->appends(request()->query())->links() }}

                        </div><!-- end of table  responsive-->
                        
                    @else
                        
                        <h2>@lang('dashboard.no_data_found')</h2>
                        
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
