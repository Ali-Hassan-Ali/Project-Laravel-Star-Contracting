@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('eirs.eirs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('eirs.eirs')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_eirs'))
                            <a href="{{ route('admin.eirs.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_eirs'))
                            <form method="post" action="{{ route('admin.eirs.bulk_delete') }}" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="record_ids" id="record-ids">
                                <button type="submit" class="btn btn-danger" id="bulk-delete" disabled="true"><i class="fa fa-trash"></i> @lang('site.bulk_delete')</button>
                            </form><!-- end of form -->
                        @endif

                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="data-table-search" class="form-control" autofocus placeholder="@lang('site.search')">
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="eirs-table" style="width: 100%;">
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
                                    <th>@lang('eirs.eir_no')</th>
                                    <th>@lang('eirs.date')</th>
                                    <th>@lang('eirs.expected_process_date')</th>
                                    <th>@lang('eirs.expected_po_released_date')</th>
                                    <th>@lang('eirs.expected_payment_transfer_date')</th>
                                    <th>@lang('eirs.expected_shipment_pickup_date')</th>
                                    <th>@lang('eirs.expected_arrival_to_site_date')</th>
                                    <th>@lang('eirs.actual_process_date')</th>
                                    <th>@lang('eirs.actual_po_released_date')</th>
                                    <th>@lang('eirs.actual_payment_transfer_date')</th>
                                    <th>@lang('eirs.actual_shipment_pickup_date')</th>
                                    <th>@lang('eirs.actual_arrival_to_site_date')</th>
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

        let eirsTable = $('#eirs-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.eirs.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'equipment', name: 'equipment'},
                {data: 'eir_no', name: 'eir_no'},
                {data: 'date', name: 'date'},
                {data: 'expected_process_date', name: 'expected_process_date'},
                {data: 'expected_po_released_date', name: 'expected_po_released_date'},
                {data: 'expected_payment_transfer_date', name: 'expected_payment_transfer_date'},
                {data: 'expected_shipment_pickup_date', name: 'expected_shipment_pickup_date'},
                {data: 'expected_arrival_to_site_date', name: 'expected_arrival_to_site_date'},
                {data: 'actual_process_date', name: 'actual_process_date'},
                {data: 'actual_po_released_date', name: 'actual_po_released_date'},
                {data: 'actual_payment_transfer_date', name: 'actual_payment_transfer_date'},
                {data: 'actual_shipment_pickup_date', name: 'actual_shipment_pickup_date'},
                {data: 'actual_arrival_to_site_date', name: 'actual_arrival_to_site_date'},
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
            eirsTable.search(this.value).draw();
        })
    </script>

@endpush