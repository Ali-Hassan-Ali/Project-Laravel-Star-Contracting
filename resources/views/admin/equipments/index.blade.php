@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('equipments.equipments')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row mb-2">

                    <div class="col-md-12">

                        @if (auth()->user()->hasPermission('read_equipments'))
                            <a href="{{ route('admin.equipments.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.create')</a>
                        @endif

                        @if (auth()->user()->hasPermission('delete_equipments'))
                            <form method="post" action="{{ route('admin.equipments.bulk_delete') }}" style="display: inline-block;">
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

                            <table class="table datatable" id="equipments-table" style="width: 100%;">
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
                                    <th>@lang('equipments.make')</th>
                                    <th>@lang('equipments.name')</th>
                                    <th>@lang('types.types')</th>
                                    <th>@lang('specs.specs')</th>
                                    <th>@lang('equipments.plate_no')</th>
                                    <th>@lang('equipments.chasis_no')</th>
                                    <th>@lang('equipments.engine_no')</th>
                                    <th>@lang('equipments.serial_no')</th>
                                    <th>@lang('equipments.model')</th>
                                    <th>@lang('equipments.year_of_manufacture')</th>
                                    <th>@lang('equipments.registration_expiry')</th>
                                    <th>@lang('countrys.countrys')</th>
                                    <th>@lang('citys.citys')</th>
                                    <th>@lang('equipments.owner_ship')</th>
                                    <th>@lang('equipments.rental_basis')</th>
                                    <th>@lang('equipments.rental_cost_basis')</th>
                                    <th>@lang('equipments.operator')</th>
                                    <th>@lang('equipments.driver_salary')</th>
                                    <th>@lang('equipments.responsible_person')</th>
                                    <th>@lang('equipments.email')</th>
                                    <th>@lang('equipments.allocated_to')</th>
                                    <th>@lang('equipments.project_allocated_to')</th>
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

        let usersTable = $('#equipments-table').DataTable({
            dom: "tiplr",
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.equipments.data') }}',
            },
            columns: [
                {data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '1%'},
                {data: 'make', name: 'make'},
                {data: 'name', name: 'name'},
                {data: 'type', name: 'type'},
                {data: 'specs', name: 'specs'},
                {data: 'plate_no', name: 'plate_no'},
                {data: 'chasis_no', name: 'chasis_no'},
                {data: 'engine_no', name: 'engine_no'},
                {data: 'serial_no', name: 'serial_no'},
                {data: 'model', name: 'model'},
                {data: 'year_of_manufacture', name: 'year_of_manufacture'},
                {data: 'registration_expiry', name: 'registration_expiry'},
                {data: 'country', name: 'country'},
                {data: 'city', name: 'city'},
                {data: 'owner_ship', name: 'owner_ship'},
                {data: 'rental_basis', name: 'rental_basis'},
                {data: 'rental_cost_basis', name: 'rental_cost_basis'},
                {data: 'operator', name: 'operator'},
                {data: 'driver_salary', name: 'driver_salary'},
                {data: 'responsible_person', name: 'responsible_person'},
                {data: 'email', name: 'email'},
                {data: 'allocated_to', name: 'allocated_to'},
                {data: 'project_allocated_to', name: 'project_allocated_to'},
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
            usersTable.search(this.value).draw();
        })
    </script>

@endpush