@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('statistics.statistics')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('statistics.statistics') @lang('statistics.table')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">


                            <div class="d-flex my-2">
                                <h4 class="mb-0">@lang('site.top') @lang('equipments.equipments')</h4>
                                <a href="{{ route('admin.equipments.index') }}" class="mx-2 mt-1">@lang('site.show_all')</a>
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th>@lang('equipments.name')</th>
                                    <th>@lang('equipments.model')</th>
                                    <th>@lang('types.types')</th>
                                    <th>@lang('equipments.operator')</th>
                                </tr>

                                @foreach ($equipments as $index => $equipment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->model }}</td>
                                        <td>{{ $equipment->type->name }}</td>
                                        <td>{{ $equipment->operator }}</td>
                                    </tr>
                                @endforeach
                            </table>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection