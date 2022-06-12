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
                                {{-- <a href="{{ route('admin.movies.index') }}" class="mx-2 mt-1">@lang('site.show_all')</a> --}}
                            </div>

                            <table class="table">
                                <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">@lang('equipments.name')</th>
                                    <th>@lang('equipments.model')</th>
                                    <th>@lang('movies.vote_count')</th>
                                    <th>@lang('movies.release_date')</th>
                                </tr>

                                @foreach ($equipments as $index => $equipment)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('admin.equipments.show', $equipment->id) }}">{{ $equipment->name }}</a></td>
                                        <td><span class="mx-2">{{ $equipment->model }}</span></td>
                                        <td>{{ $equipment->vote_count }}</td>
                                        <td>{{ $equipment->release_date }}</td>
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