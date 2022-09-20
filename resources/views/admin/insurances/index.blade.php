@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('insurances.insurances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('insurances.insurances')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_insurances'))
                            <a href="{{ route('admin.insurances.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_insurances'))
                            <form method="post" action="{{ route('admin.insurances.bulk_delete') }}" style="display: inline-block;">
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

                            <table class="table datatable" id="insurances-table" style="width: 100%;">
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
                                    <th>@lang('insurances.insurer')</th>
                                    <th>@lang('insurances.type_of_insurance')</th>
                                    <th>@lang('insurances.premium')</th>
                                    <th>@lang('insurances.policy_number')</th>
                                    <th>@lang('insurances.insurance_start_date')</th>
                                    <th>@lang('insurances.insurance_duration')</th>
                                    <th>@lang('insurances.insurance_expiry')</th>
                                    <th>@lang('insurances.claim')</th>
                                    <th style="width: 250px">@lang('insurances.claim_date')</th>
                                    <th>@lang('insurances.claim_amount')</th>
                                    <th>@lang('insurances.claim_description')</th>
                                    <th>@lang('insurances.claim_attachments')</th>
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
        let insurancesTable = $('#insurances-table').DataTable({
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
                url: '{{ route('admin.insurances.data') }}',
                data: function (d) {
                    d.start_data = startData;
                    d.end_data = endData;
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'equipment', name: 'equipment'},
                {data: 'insurer', name: 'insurer'},
                {data: 'type_of_insurance', name: 'type_of_insurance'},
                {data: 'premium', name: 'premium'},
                {data: 'policy_number', name: 'policy_number'},
                {data: 'insurance_start_date', name: 'insurance_start_date'},
                {data: 'insurance_duration', name: 'insurance_duration'},
                {data: 'insurance_expiry', name: 'insurance_expiry'},
                {data: 'claim', name: 'claim'},
                {data: 'claim_date', name: 'claim_date', width: '250%'},
                {data: 'claim_amount', name: 'claim_amount'},
                {data: 'claim_description', name: 'claim_description'},
                {data: 'attachments', name: 'attachments'},
                {data: 'actions', name: 'actions', searchable: false, sortable: false, width: '20%'},
            ],
            // order: [[5, 'desc']],
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            }
        });

        $('#data-table-search').keyup(function () {
            insurancesTable.search(this.value).draw();
        });
        $('.date-search').change(function () {

            if ($('#start-date').val() && $('#end-date').val()) {

                startData = $('#start-date').val();
                endData   = $('#end-date').val();

                dataTable.ajax.reload();

            }//end of if
        });

        $(document).ready(function() {

            $(document).on('change', '#claim',function () {


                var claim  = $(this).is(':checked') ? '1' : '0';
                var id     = $(this).data('id');
                var url    = "{{ route('admin.insurances.claim') }}";
                var method = 'post';

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        claim : claim,
                        id : id,
                    },
                    success: function (data) {

                        $('.datatable').DataTable().ajax.reload();

                        new Noty({
                            layout: 'topRight',
                            type: 'alert',
                            text: data,
                            killer: true,
                            timeout: 2000,
                        }).show();

                    }//end of success
                    
                });//end of ajax


                if ($(this).is(':checked')) {

                    $('#claim_description').attr('disabled', false);
                    $('#claim_amount').attr('disabled', false);
                    $('#claim_date').attr('disabled', false);
                    
                } else {

                    $('#claim_description').attr('disabled', true);
                    $('#claim_amount').attr('disabled', true);
                    $('#claim_date').attr('disabled', true);

                }//end of if
                
            });//end of chage
            
        });//end of reday fun


    </script>

@endpush