@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('statistics.statistics')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('statistics.statistics') @lang('statistics.chart')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            {{--equipments chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('equipments.equipments')</h4>

                                <select id="equipments-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}>
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="equipments-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row equipments-->

            {{--specs chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('specs.specs')</h4>

                                <select id="specs-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="specs-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row specs-->

            {{--maintenances chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('maintenances.maintenances')</h4>

                                <select id="maintenances-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="maintenances-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row maintenances-->

            {{--insurances chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('insurances.insurances')</h4>

                                <select id="insurances-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="insurances-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row insurances-->

            {{--spares chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('spares.spares')</h4>

                                <select id="spares-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="spares-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row spares-->

            {{--fuels chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('fuels.fuels')</h4>

                                <select id="fuels-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="fuels-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row fuels-->

            {{--eirs chart--}}
            <div class="row my-3">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <div class="d-flex justify-content-between">
                                <h4>@lang('eirs.eirs')</h4>

                                <select id="eirs-chart-year" style="width: 100px;">
                                    @for ($i = 5; $i >=0 ; $i--)
                                        <option value="{{ now()->subYears($i)->year }}"
                                                {{ now()->subYears($i)->year == now()->year ? 'selected' : '' }}
                                        >
                                            {{ now()->subYears($i)->year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div id="eirs-wrapper"></div>

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row eirs-->

        </div><!-- end of col -->

    </div><!-- end of row -->
@endsection

@push('scripts')

    <script>
        $(function () {

            // equipment
            equipmentChart("{{ now()->year }}");

            $('#equipments-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                equipmentChart(year);

            });//end of on change equipment

            // specs
            specsChart("{{ now()->year }}");

            $('#specs-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                specsChart(year);

            });//end of on change specs

            // maintenances
            maintenancesChart("{{ now()->year }}");

            $('#maintenances-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                maintenancesChart(year);

            });//end of on change maintenances

            // insurances
            insurancesChart("{{ now()->year }}");

            $('#insurances-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                insurancesChart(year);

            });//end of on change insurances

            // spares
            sparesChart("{{ now()->year }}");

            $('#spares-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                sparesChart(year);

            });//end of on change spares

            // fuels
            fuelsChart("{{ now()->year }}");

            $('#fuels-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                fuelsChart(year);

            });//end of on change fuels

            // eirs
            eirsChart("{{ now()->year }}");

            $('#eirs-chart-year').on('change', function () {

                let year = $(this).find(':selected').val();

                eirsChart(year);

            });//end of on change eirs

        });//end of document ready


        function equipmentChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#equipments-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.equipment.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#equipments-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of equipments

        function specsChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#specs-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.specs.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#specs-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of specs

        function maintenancesChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#maintenances-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.maintenances.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#maintenances-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of maintenances

        function insurancesChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#insurances-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.insurances.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#insurances-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of insurances

        function sparesChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#spares-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.spares.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#spares-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of spares

        function fuelsChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#fuels-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.fuels.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#fuels-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of fuels

        function eirsChart(year) {

            let loader = `
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="loader loader-md"></div>
                    </div>
                `;

            $('#eirs-wrapper').empty().append(loader);

            $.ajax({
                url : "{{ route('admin.eirs.chart') }}",
                data: {
                    'year': year,
                },
                cache: false,
                success: function (html) {

                    $('#eirs-wrapper').empty().append(html);

                },

            });//end of ajax call

        }//end of eirs
        
    </script>
@endpush