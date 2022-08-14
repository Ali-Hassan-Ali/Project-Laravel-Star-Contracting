@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item">@lang('equipments.attachments')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <div class="row">

                    <div class="col-md-12">

                        <div class="table-responsive">

                            <table class="table table-hover">
                                <thead>
                                <tr>
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
                                </tr>
                                </thead>
                                <body>
                                    @foreach ($equipments as $equipment)
                                    <tr>
                                        <td>{{ $equipment->make }}</td>
                                        <td>{{ $equipment->name }}</td>
                                        <td>{{ $equipment->type ?? '' }}</td>
                                        <td>{{ $equipment->specs ?? '' }}</td>
                                        <td>{{ $equipment->plate_no }}</td>
                                        <td>{{ $equipment->chasis_no }}</td>
                                        <td>{{ $equipment->engine_no }}</td>
                                        <td>{{ $equipment->serial_no }}</td>
                                        <td>{{ $equipment->model }}</td>
                                        <td>{{ $equipment->year_of_manufacture }}</td>
                                        <td>{{ $equipment->registration_expiry }}</td>
                                        <td>{{ $equipment->country->name }}</td>
                                        <td>{{ $equipment->city->name }}</td>
                                        <td>{{ $equipment->owner_ship }}</td>
                                        <td>{{ $equipment->rental_basis }}</td>
                                        <td>{{ $equipment->rental_cost_basis }}</td>
                                        <td>{{ $equipment->operator }}</td>
                                        <td>{{ $equipment->driver_salary }}</td>
                                        <td>{{ $equipment->responsible_person }}</td>
                                        <td>{{ $equipment->email }}</td>
                                        <td>{{ $equipment->allocated_to }}</td>
                                        <td>{{ $equipment->project_allocated_to }}</td>
                                    </tr>

                                    <div class="table-responsive">

                                        <table class="table table-hover">
                                            <thead>
                                            <tr>
                                                <th>@lang('spares.part_no')</th>
                                                <th>@lang('spares.cost')</th>
                                                <th>@lang('spares.freight_charges')</th>
                                                <th>@lang('spares.used')</th>
                                                <th>@lang('spares.usage_date')</th>
                                                <th>@lang('spares.description')</th>
                                                <th>@lang('spares.location')</th>
                                            </tr>
                                            </thead>
                                            <body>
                                                @foreach ($equipment->spares as $spare)
                                                <tr>
                                                    <td>{{ $spare->part_no }}</td>
                                                    <td>{{ $spare->cost }}</td>
                                                    <td>{{ $spare->type ?? '' }}</td>
                                                    <td>{{ $spare->freight_charges ?? '' }}</td>
                                                    <td>{{ $spare->used }}</td>
                                                    <td>{{ $spare->usage_date }}</td>
                                                    <td>{{ $spare->description }}</td>
                                                    <td>{{ $spare->location }}</td>
                                                </tr>
                                                @endforeach
                                            </body>
                                        </table>

                                    </div><!-- end of table responsive -->

                                    @endforeach
                                </body>
                            </table>

                        </div><!-- end of table responsive -->

                    </div><!-- end of col -->

                </div><!-- end of row -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection
