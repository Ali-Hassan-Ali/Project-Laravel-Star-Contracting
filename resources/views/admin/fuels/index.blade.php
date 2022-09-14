@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('fuels.fuels')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('fuels.fuels')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_fuels'))
                            <a href="{{ route('admin.fuels.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_fuels'))
                            <form method="post" action="{{ route('admin.fuels.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input placeholder="From" class="date-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="start-date">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <input placeholder="To" class="date-search form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="end-date">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="fuels-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="animated-checkbox">
                                            <label class="m-0">
                                                <input type="checkbox" id="record__select-all">
                                                <span class="label-text"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>@lang('equipments.equipments')</th>
                                    <th>@lang('fuels.project')</th>
                                    <th>@lang('fuels.last_date')</th>
                                    <th>@lang('fuels.fuel_type')</th>
                                    <th>@lang('fuels.unit')</th>
                                    <th>@lang('fuels.no_of_units_filled')</th>
                                    <th>@lang('fuels.fuel_rate_per_litre')</th>
                                    <th>@lang('fuels.total_cost_of_fuel')</th>
                                    <th>@lang('fuels.last_mileage_reading')</th>
                                    <th>@lang('fuels.current_mileage_reading')</th>
                                    <th>@lang('fuels.average_mileage_reading')</th>
                                    <th>@lang('fuels.hours_worked_weekly')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                                </thead>
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
        var startData;
        var endData;
        let fuelsTable = $('#fuels-table').DataTable({
            dom: "tiplr",
            scrollY: '500px',
            sScrollX: "100%",
            scrollCollapse: true,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.fuels.data') }}',
                data: function (d) {
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'equipment', name: 'equipment'},
                {data: 'project', name: 'project'},
                {data: 'last_date', name: 'last_date'},
                {data: 'fuel_type', name: 'fuel_type'},
                {data: 'unit', name: 'unit'},
                {data: 'no_of_units_filled', name: 'no_of_units_filled'},
                {data: 'fuel_rate_per_litre', name: 'fuel_rate_per_litre'},
                {data: 'total_cost_of_fuel', name: 'total_cost_of_fuel'},
                {data: 'last_mileage_reading', name: 'last_mileage_reading'},
                {data: 'current_mileage_reading', name: 'current_mileage_reading'},
                {data: 'average_mileage_reading', name: 'average_mileage_reading'},
                {data: 'hours_worked_weekly', name: 'hours_worked_weekly'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[2, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            fuelsTable.search(this.value).draw();
        });
        $('.date-search').change(function () {

            if ($('#start-date').val() && $('#end-date').val()) {

                startData = $('#start-date').val();
                endData   = $('#end-date').val();

                dataTable.ajax.reload();

            }//end of if
        });

    </script>

@endpush