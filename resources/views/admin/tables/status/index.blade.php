@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('status.status')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('status.status')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_status'))
                            <a href="{{ route('admin.status.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_status'))
                            <form method="post" action="{{ route('admin.status.bulk_delete') }}" style="display: inline-block;">
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

                            <table class="table datatable" id="status-table" style="width: 100%;">
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
                                    <th>@lang('status.as_of')</th>
                                    <th>@lang('status.working_status')</th>
                                    <th>@lang('status.hours_worked')</th>
                                    <th>@lang('status.break_down_date')</th>
                                    <th>@lang('status.break_down_duration')</th>
                                    <th>@lang('status.descrption')</th>
                                    {{-- <th>@lang('site.action')</th> --}}
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
        let dataTable = $('#status-table').DataTable({
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
                url: '{{ route('admin.status.data') }}',
                data: function (d) {
                    d.old = 'old';
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'equipment', name: 'equipment'},
                {data: 'as_of', name: 'as_of'},
                {data: 'working_status', name: 'working_status'},
                {data: 'hours_worked', name: 'hours_worked'},
                {data: 'break_down_date', name: 'break_down_date'},
                {data: 'break_down_duration', name: 'break_down_duration'},
                {data: 'break_down_description', name: 'break_down_description'},
                // {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
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
            usersTable.search(this.value).draw();
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