@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.equipments.store') }}">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('equipments.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
                    </div>

                    {{--make--}}
                    <div class="form-group">
                        <label>@lang('equipments.make')<span class="text-danger">*</span></label>
                        <input type="text" name="make" class="form-control" value="{{ old('make') }}" required autofocus>
                    </div>

                    {{--model--}}
                    <div class="form-group">
                        <label>@lang('equipments.model')<span class="text-danger">*</span></label>
                        <input type="text" name="model" class="form-control" value="{{ old('model') }}" required autofocus>
                    </div>

                    {{--owner_ship--}}
                    <div class="form-group">
                        <label>@lang('equipments.owner_ship')<span class="text-danger">*</span></label>
                        <input type="text" name="owner_ship" class="form-control" value="{{ old('owner_ship') }}" required autofocus>
                    </div>

                    {{--operator--}}
                    <div class="form-group">
                        <label>@lang('equipments.operator')<span class="text-danger">*</span></label>
                        <input type="text" name="operator" class="form-control" value="{{ old('operator') }}" required autofocus>
                    </div>

                    {{--responsible_person--}}
                    <div class="form-group">
                        <label>@lang('equipments.responsible_person')<span class="text-danger">*</span></label>
                        <input type="text" name="responsible_person" class="form-control" value="{{ old('responsible_person') }}" required autofocus>
                    </div>

                    {{--project_allocated_to--}}
                    <div class="form-group">
                        <label>@lang('equipments.project_allocated_to')<span class="text-danger">*</span></label>
                        <input type="text" name="project_allocated_to" class="form-control" value="{{ old('project_allocated_to') }}" required autofocus>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>@lang('equipments.email')<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    </div>

                    {{--driver_salary--}}
                    <div class="form-group">
                        <label>@lang('equipments.driver_salary')<span class="text-danger">*</span></label>
                        <input type="number" name="driver_salary" class="form-control" value="{{ old('driver_salary') }}" required autofocus>
                    </div>

                    {{--rental_basis--}}
                    <div class="form-group">
                        <label>@lang('equipments.rental_basis')<span class="text-danger">*</span></label>
                        <input type="number" name="rental_basis" class="form-control" value="{{ old('rental_basis') }}" required autofocus>
                    </div>

                    {{--registration_expiry--}}
                    <div class="form-group">
                        <label>@lang('equipments.registration_expiry')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="registration_expiry" class="form-control" value="{{ old('registration_expiry') }}" required autofocus>
                    </div>

                    {{--expiry_reminder_sent--}}
                    <div class="form-group">
                        <label>@lang('equipments.expiry_reminder_sent')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="expiry_reminder_sent" class="form-control" value="{{ old('expiry_reminder_sent') }}" required autofocus>
                    </div>

                    {{--year_of_manufacture--}}
                    <div class="form-group">
                        <label>@lang('equipments.year_of_manufacture')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="year_of_manufacture" class="form-control" value="{{ old('year_of_manufacture') }}" required autofocus>
                    </div>

                    {{--rental_cost_basis--}}
                    <div class="form-group">
                        <label>@lang('equipments.rental_cost_basis')<span class="text-danger">*</span></label>
                        <input type="datetime-local" name="rental_cost_basis" class="form-control" value="{{ old('rental_cost_basis') }}" required autofocus>
                    </div>

                    @php
                        $status = [1,0];
                    @endphp

                    {{--plate_no--}}
                    <div class="form-group">
                        <label>@lang('equipments.plate_no') <span class="text-danger">*</span></label>
                        <select name="plate_no" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.plate_no')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('plate_no') ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                    </div>

                    {{--chasis_no--}}
                    <div class="form-group">
                        <label>@lang('equipments.chasis_no') <span class="text-danger">*</span></label>
                        <select name="chasis_no" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.chasis_no')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('chasis_no') ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                    </div>

                    {{--engine_no--}}
                    <div class="form-group">
                        <label>@lang('equipments.engine_no') <span class="text-danger">*</span></label>
                        <select name="engine_no" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.engine_no')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('engine_no') ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                    </div>

                    {{--serial_no--}}
                    <div class="form-group">
                        <label>@lang('equipments.serial_no') <span class="text-danger">*</span></label>
                        <select name="serial_no" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.serial_no')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('serial_no') ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                    </div>


                    {{--countrys--}}
                    <div class="form-group">
                        <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                        <select name="country_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('countrys.countrys')</option>
                            @foreach ($countrys as $country)
                                <option value="{{ $country->id }}" {{ $country->id == old('country_id') ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{--types--}}
                    <div class="form-group">
                        <label>@lang('types.types') <span class="text-danger">*</span></label>
                        <select name="type_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('types.types')</option>
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


