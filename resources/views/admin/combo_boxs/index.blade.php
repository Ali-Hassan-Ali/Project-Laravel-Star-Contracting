@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('combo_boxs.combo_boxs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('combo_boxs.combo_boxs')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_combo_boxs'))
                            <a href="{{ route('admin.combo_boxs.create', ['combo_boxs' => request()->combo_boxs ]) }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_combo_boxs'))
                            <form method="post" action="{{ route('admin.combo_boxs.bulk_delete') }}" style="display: inline-block;">
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

                    @php
                        $combo_boxs = ['make', 'model', 'owner_ship', 'equipment', 'type', 'rental_basis', 'operator', 'responsible_person', 'responsible_person_email', 'allocated_to', 'project_allocated_to', 'insurer', 'location', 'non_scheduled', 'unit', 'fuel_type', 'spec_type'];
                    @endphp
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group">
                                <select id="combo-boxs" class="form-control select2">
                                    <option value="">@lang('site.all') @lang('combo_boxs.type')</option>
                                    @foreach ($combo_boxs as $boxs)
                                        <option value="{{ $boxs }}" {{ $boxs == request()->combo_boxs ? 'selected' : '' }}>{{ $boxs }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div><!-- end of row -->

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table datatable" id="combo_boxs-table" style="width: 100%;">
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
                                    <th>@lang('combo_boxs.name')</th>
                                    <th>@lang('combo_boxs.type')</th>
                                    <th>@lang('admins.name')</th>
                                    <th>@lang('site.created_at')</th>
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

        let type;
        let combo_boxsTable = $('#combo_boxs-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.combo_boxs.data') }}',
                data: function (d) {
                    d.type = type ?? "{{ request()->combo_boxs }}";
                }
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'admin', name: 'admin'},
                {data: 'created_at', name: 'created_at', searchable: false},
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
            combo_boxsTable.search(this.value).draw();
        })

        $('#combo-boxs').on('change', function () {
            type = this.value;
            combo_boxsTable.ajax.reload();
        })
    </script>

@endpush