@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('site.home')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item">@lang('site.home')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            {{--top statistics--}}
            <div class="row" id="top-statistics">

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-lock"></span> @lang('roles.roles')</p>
                                <a href="{{ route('admin.roles.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="roles-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-users"></span> @lang('admins.admins')</p>
                                <a href="{{ route('admin.admins.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="admins-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-flag"></span> @lang('countrys.countrys')</p>
                                <a href="{{ route('admin.countrys.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="countrys-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-city"></span> @lang('citys.citys')</p>
                                <a href="{{ route('admin.citys.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="citys-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-hurricane"></span> @lang('types.types')</p>
                                <a href="{{ route('admin.types.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="types-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-list-check"></span> @lang('status.status')</p>
                                <a href="{{ route('admin.status.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="status-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fas fa-check-double"></span> @lang('specs.specs')</p>
                                <a href="{{ route('admin.specs.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="specs-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-car-burst"></span> @lang('insurances.insurances')</p>
                                <a href="{{ route('admin.insurances.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="insurances-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fas fa-tools"></span> @lang('equipments.equipments')</p>
                                <a href="{{ route('admin.equipments.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="equipments-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->


                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-server"></span> @lang('spares.spares')</p>
                                <a href="{{ route('admin.spares.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="spares-count" style="display: none"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-wrench"></span> @lang('maintenances.maintenances')</p>
                                <a href="{{ route('admin.maintenances.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="maintenances-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-gas-pump"></span> @lang('fuels.fuels')</p>
                                <a href="{{ route('admin.fuels.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="fuels-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa fa-users"></span> @lang('eirs.eirs')</p>
                                <a href="{{ route('admin.eirs.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="eirs-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-code-compare"></span> @lang('request_parts.request_parts')</p>
                                <a href="{{ route('admin.request_parts.index') }}">@lang('site.show_all')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="request_parts-count" style="display: none;"></h3>
                        </div>

                    </div>

                </div><!-- end of col -->

            </div><!-- end of row -->

            {{--movies chart--}}
            <div class="row my-3">

     {{--            <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('movies.movies_chart')</h4>

                                <select id="movies-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="movies-chart-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col --> --}}

            </div><!-- end of row -->

{{--             <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">


                            <div class="d-flex my-2">
                                <h4 class="mb-0">@lang('movies.top') @lang('movies.popular')</h4>
                                {{-- <a href="{{ route('admin.movies.index') }}" class="mx-2 mt-1">@lang('site.show_all')</a> --}}
                            </div>

                            <table class="table">
                                {{-- <tr>
                                    <th>#</th>
                                    <th style="width: 30%;">@lang('movies.title')</th>
                                    <th>@lang('movies.vote')</th>
                                    <th>@lang('movies.vote_count')</th>
                                    <th>@lang('movies.release_date')</th>
                                </tr> --}}

                                {{-- @foreach ($popularMovies as $index => $movie)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="{{ route('admin.movies.show', $movie->id) }}">{{ $movie->title }}</a></td>
                                        <td><i class="fa fa-star text-warning"></i> <span class="mx-2">{{ $movie->vote }}</span></td>
                                        <td>{{ $movie->vote_count }}</td>
                                        <td>{{ $movie->release_date }}</td>
                                    </tr>
                                @endforeach --}}
                            </table>

                            <div class="d-flex my-2">
                                {{-- <h4 class="mb-0">@lang('movies.top') @lang('movies.now_playing')</h4> --}}
                                {{-- <a href="{{ route('admin.movies.index', ['type' => 'now_playing']) }}" class="mx-2 mt-1">@lang('site.show_all')</a> --}}
                            </div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row --> --}}

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')

    <script>
        $(function () {

            topStatistics();

            moviesChart("{{ now()->year }}");

            $('#movies-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                moviesChart(year);

            });//end of on change

        });//end of document ready

        function topStatistics() {

            $.ajax({
                url: "{{ route('admin.home.top_statistics') }}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .loader-sm').hide();

                    $('#top-statistics #roles-count').show().text(data.roles_count);
                    $('#top-statistics #admins-count').show().text(data.admins_count);
                    $('#top-statistics #countrys-count').show().text(data.countrys_count);

                    $('#top-statistics #citys-count').show().text(data.citys_count);
                    $('#top-statistics #types-count').show().text(data.types_count);
                    $('#top-statistics #status-count').show().text(data.status_count);

                    $('#top-statistics #specs-count').show().text(data.specs_count);
                    $('#top-statistics #insurances-count').show().text(data.insurances_count);
                    $('#top-statistics #equipments-count').show().text(data.equipments_count);

                    $('#top-statistics #spares-count').show().text(data.spares_count);
                    $('#top-statistics #maintenances-count').show().text(data.maintenances_count);
                    $('#top-statistics #fuels-count').show().text(data.fuels_count);

                    $('#top-statistics #eirs-count').show().text(data.eirs_count);
                    $('#top-statistics #request_parts-count').show().text(data.request_parts_count);

                },//ajac success

            });//end of ajax call

        }//end of fun

        function moviesChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#movies-chart-wrapper').empty().append(loader);

            $.ajax({
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#movies-chart-wrapper').empty().append(html);

                },

            });//end of ajax call

        }
    </script>
@endpush