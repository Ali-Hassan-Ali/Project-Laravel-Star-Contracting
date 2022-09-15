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

                @if (auth()->user()->hasPermission('read_equipments'))
                {{-- status --}}
                <div class="col-md-2 mb-2">

                    <a href="#" class="card data-ajax" style="background: yellow; color: black;" data-url="{{ route('admin.home.ajax.eir_pending_approved') }}">
                        
                        <div class="card-body">

                            <h3 class="mb-0 text-center" id="eir-under-review-count" style="display: none;"></h3>

                            <div class="d-flex justify-content-center mb-2 text-center">
                                <p class="mb-0">@lang('statistics.eir_pending_approved')</p>
                            </div>

                            <div class="loader loader-sm"></div>

                        </div>

                    </a>

                </div><!-- end of col -->

                @endif
                
                @if (auth()->user()->hasPermission('read_status'))
                {{-- status --}}
                <div class="col-md-2 mb-2">

                    <a href="#" class="card data-ajax pb-2-1" style="background: green; color: #fff;" data-url="{{ route('admin.home.ajax.eir_in_transit') }}">
                        
                        <div class="card-body">

                            <h3 class="mb-0 text-center" id="eir-in-transit-count" style="display: none;"></h3>

                            <div class="d-flex justify-content-center mb-2 text-center">
                                <p class="mb-0">@lang('statistics.eir_in_transit')</p>
                            </div>

                            <div class="loader loader-sm"></div>

                        </div>

                    </a>

                </div><!-- end of col -->

                @endif

                @if (auth()->user()->hasPermission('read_spares'))
                {{-- status --}}
                <div class="col-md-2 mb-2">

                    <a href="#" class="card data-ajax pb-2-1" style="background: blue; color: #fff;" data-url="{{ route('admin.home.ajax.equipment_vehicle') }}">
                        
                        <div class="card-body">

                            <h3 class="mb-0 text-center" id="equipment-vehicle-count" style="display: none;"></h3>

                            <div class="d-flex justify-content-center text-center text-centerw mb-2">
                                <p class="mb-0">@lang('statistics.equipment_vehicle')</p>
                            </div>

                            <div class="loader loader-sm"></div>

                        </div>

                    </a>

                </div><!-- end of col -->

                @endif


                @if (auth()->user()->hasPermission('read_maintenances'))
                {{-- status --}}
                <div class="col-md-2 mb-2">

                    <a href="#" class="card data-ajax pb-2-1" data-url="{{ route('admin.home.ajax.equipment_rented') }}">
                        
                        <div class="card-body">

                            <h3 class="mb-0 text-center" id="equipment-rented-count" style="display: none;"></h3>

                            <div class="d-flex justify-content-center mb-2">
                                <p class="mb-0">@lang('statistics.equipment_rented')</p>
                            </div>

                            <div class="loader loader-sm"></div>

                        </div>

                    </a>

                </div><!-- end of col -->

                @endif

                @if (auth()->user()->hasPermission('read_maintenances'))
                {{-- status --}}
                <div class="col-md-2">

                    <a href="#" style="background: #cc0808; color: #fff;" class="card data-ajax" data-url="{{ route('admin.home.ajax.equipment_barkdown') }}">
                        
                        <div class="card-body p-3">

                            <h1 class="mb-0 text-center" id="equipment-barkdown-count" style="display: none; font-size: 50px;"></h1>

                            <div class="d-flex justify-content-center mb-2">
                                <p class="mb-0">@lang('statistics.equipment_barkdown')</p>
                            </div>

                            <div class="loader loader-sm"></div>

                        </div>

                    </a>

                </div><!-- end of col -->

                @endif


            </div><!-- end of row -->

        </div><!-- end of col -->

        <div class="col-md-12" id="data-table-hidden" hidden>

            <div class="tile shadow">

                <div class="row">

                    <div class="col-12" id="data-table">

                        <div class="table-responsive">


                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->        

        <div class="col-md-12 mt-3">

            {{--top statistics--}}
            <div class="row" id="top-statistics">

                @if (auth()->user()->hasPermission('read_equipments'))
                {{-- status --}}
                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="app-menu__icon fas fa-tools"></span> @lang('equipments.equipments')</p>
                                <a href="{{ route('admin.equipments.index') }}">@lang('site.show_all')</a>
                                <a href="{{ route('admin.equipments.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="equipments-count" style="display: none;"></h3>
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
                                <a href="{{ route('admin.status.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="status-count" style="display: none;"></h3>
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
                                <a href="{{ route('admin.spares.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="spares-count" style="display: none"></h3>
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
                                <a href="{{ route('admin.eirs.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="eirs-count" style="display: none;"></h3>
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
                                <a href="{{ route('admin.maintenances.create') }}">@lang('site.add')</a>
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
                                <a href="{{ route('admin.fuels.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="fuels-count" style="display: none;"></h3>
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

                @if (auth()->user()->hasPermission('read_insurances'))
                {{-- insurances --}}
                <div class="col-md-4 mb-2">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between mb-2">
                                <p class="mb-0"><span class="fa-solid fa-car-burst"></span> @lang('insurances.insurances')</p>
                                <a href="{{ route('admin.insurances.index') }}">@lang('site.show_all')</a>
                                <a href="{{ route('admin.insurances.create') }}">@lang('site.add')</a>
                            </div>

                            <div class="loader loader-sm"></div>

                            <h3 class="mb-0" id="insurances-count" style="display: none;"></h3>
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

            topStatisticsTable();

            $(document).on('click', '.data-ajax', function function_name(e) {
                e.preventDefault();

                let url    = $(this).data('url');
                let method = 'get';

                $.ajax({
                    url: url,
                    method: method,
                    cache: false,
                    success: function (data) {
                        
                        let loader = `
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="loader loader-md"></div>
                                </div>
                            `;
                        if ($("#data-table-hidden").attr("hidden")) {

                            $("#data-table-hidden").attr("hidden", false);

                        } else {

                            $("#data-table-hidden").attr("hidden", true);
                        }

                        // $('#data-table-hidden').attr('hidden', false);
                        $('#data-table').empty().append(loader);
                        $('#data-table').empty('').append(data);

                    }//end of success
                });
                
            });

        });//end of document ready

        function topStatistics() {

            $.ajax({
                url: "{{ route('admin.home.top_statistics') }}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .loader-sm').hide();

                    $('#top-statistics #equipments-count').show().text(data.equipments_count);
                    $('#top-statistics #status-count').show().text(data.status_count);
                    $('#top-statistics #spares-count').show().text(data.spares_count);
                    $('#top-statistics #eirs-count').show().text(data.eirs_count);
                    $('#top-statistics #maintenances-count').show().text(data.maintenances_count);
                    $('#top-statistics #fuels-count').show().text(data.fuels_count);
                    $('#top-statistics #request_parts-count').show().text(data.request_parts_count);
                    $('#top-statistics #insurances-count').show().text(data.insurances_count);

                },//ajac success

            });//end of ajax call

        }//end of fun

        function topStatisticsTable() {

            $.ajax({
                url: "{{ route('admin.home.top_statistics.tables') }}",
                cache: false,
                success: function (data) {

                    $('#top-statistics .loader-sm').hide();

                    $('#top-statistics #eir-under-review-count').show().text(data.eir_under_review_count);
                    $('#top-statistics #eir-in-transit-count').show().text(data.eir_in_transit_count);
                    $('#top-statistics #equipment-vehicle-count').show().text('30');
                    // $('#top-statistics #equipment-vehicle-count').show().text(data.equipment_vehicle_count);
                    $('#top-statistics #equipment-rented-count').show().text(data.equipment_rented_count);
                    $('#top-statistics #equipment-barkdown-count').show().text(data.equipment_barkdown_count);

                },//ajac success

            });//end of ajax call

        }//end of fun

    </script>
@endpush