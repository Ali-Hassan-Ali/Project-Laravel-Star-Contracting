@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('maintenances.maintenances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('maintenances.maintenances')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_maintenances'))
                            <a href="{{ route('admin.maintenances.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_maintenances'))
                            <form method="post" action="{{ route('admin.maintenances.bulk_delete') }}" style="display: inline-block;">
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

                            <table class="table datatable" id="maintenances-table" style="width: 100%;">
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
                                    <th>@lang('maintenances.last_service_date')</th>
                                    <th>@lang('maintenances.last_service_km')</th>
                                    <th>@lang('maintenances.next_service_date')</th>
                                    <th>@lang('maintenances.next_service_dueon_km')</th>
                                    <th>@lang('maintenances.actual_service_date')</th>
                                    <th>@lang('maintenances.actual_service_reading')</th>
                                    <th>@lang('maintenances.scheduled')</th>
                                    <th>@lang('maintenances.non_scheduled')</th>
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
        let dataTable = $('#maintenances-table').DataTable({
            dom: "tiplr",
            scrollY: '500px',
            sScrollX: "100%",
            scrollCollapse: true,
            serverSide: true,
            processing: true,
            language: {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.maintenances.data') }}',
                data: function (d) {
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'equipment', name: 'equipment'},
                {data: 'last_service_date', name: 'last_service_date'},
                {data: 'last_service_km', name: 'last_service_km'},
                {data: 'next_service_date', name: 'next_service_date'},
                {data: 'next_service_dueon_km', name: 'next_service_dueon_km'},
                {data: 'actual_service_date', name: 'actual_service_date'},
                {data: 'actual_service_reading', name: 'actual_service_reading'},
                {data: 'scheduled', name: 'scheduled'},
                {data: 'non_scheduled', name: 'non_scheduled'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            order: [[2, 'desc']],
            rowCallback: function(row, data, index) {
        
                    alert(data.actual_service_date, data.next_service_date);
                if (data.actual_service_date > data.next_service_date || data.actual_service_reading > data.next_service_dueon_km) {
                    $(row).addClass('bg-danger-datatable text-black');
            
                }
        
            },
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            dataTable.search(this.value).draw();
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