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
                @if (auth()->user()->hasPermission('read_roles'))
                {{-- roles --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_admins'))
                {{-- admins --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_countrys'))
                {{-- countrys --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_countrys'))
                {{-- citys --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_types'))
                {{-- types --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_status'))
                {{-- status --}}
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
                @endif
                
                @if (auth()->user()->hasPermission('read_specs'))
                {{-- specs --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_insurances'))
                {{-- insurances --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_insurances'))
                {{-- insurances --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_spares'))
                {{-- spares --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_maintenances'))
                {{-- maintenances --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_fuels'))
                {{-- fuels --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_eirs'))
                {{-- eirs --}}
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
                @endif

                @if (auth()->user()->hasPermission('read_request_parts'))
                {{-- request_parts --}}
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
                @endif


            </div><!-- end of row -->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')

    <script>
        $(function () {

            topStatistics();

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

    </script>
@endpush