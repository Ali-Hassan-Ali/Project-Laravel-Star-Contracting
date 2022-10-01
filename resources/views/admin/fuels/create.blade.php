@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('fuels.fuels')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.fuels.index') }}">@lang('fuels.fuels')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                @include('admin.partials._errors')

                <form method="post" action="{{ route('admin.fuels.store') }}">
                    @csrf
                    @method('post')

                    <div class="row">
                        
                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                            <select class="form-control col-6 select2" id="equipment-countrey">
                                <option value="" selected disabled>@lang('site.choose') @lang('countrys.countrys')</option>
                                @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}"
                                        data-url="{{ route('admin.ajax.country', $country->id) }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="equipment-city">
                            
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group @error('equipment_id') custom-select @enderror col-6">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control equipment select2 equipment" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.equipments')</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" data-type="{{ $equipment->spec->name }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @php
                            $data_times = ['last_date'];
                        @endphp

                        @foreach ($data_times as $data_time)
                            
                            {{--$data_time--}}
                            <div class="form-group col-6">
                                <label>@lang('fuels.' . $data_time)<span class="text-danger">*</span></label>
                                <input type="date" name="{{ $data_time }}" class="form-control @error($data_time) is-invalid @enderror" value="{{ old($data_time) }}" required autofocus>
                                @error($data_time)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        @endforeach
    
                        <div class="form-group col-6">
                            <label>@lang('fuels.project')<span class="text-danger">*</span></label>
                            <input type="text" name="project" class="form-control @error('project') is-invalid @enderror" value="{{ old('project') }}" required autofocus>
                            @error('project')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        {{--fuel_types--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.fuel_type') <span class="text-danger">*</span></label>
                            <select name="fuel_type" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('fuels.fuel_type')</option>
                                @foreach ($fuel_types as $fuel_type)
                                    <option value="{{ $fuel_type->name }}" {{ $fuel_type->name == old('fuel_type') ? 'selected' : '' }}>{{ $fuel_type->name }}</option>
                                @endforeach
                            </select>
                            @error('fuel_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--unit--}}
{{--                        <div class="form-group col-6">--}}
{{--                            <label>@lang('fuels.unit') <span class="text-danger">*</span></label>--}}
{{--                            <select name="unit" class="form-control select2" required>--}}
{{--                                <option value="" selected disabled>@lang('site.choose') @lang('fuels.unit')</option>--}}
{{--                                @foreach ($units as $unit)--}}
{{--                                    <option value="{{ $unit->name }}" {{ $unit->name == old('unit') ? 'selected' : '' }}>{{ $unit->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        {{--$data_time--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.no_of_units_filled')<span class="text-danger">*</span></label>
                            <input type="number" id="no-of-unit-filled" name="no_of_units_filled" class="form-control @error('no_of_units_filled') is-invalid @enderror" value="{{ old('no_of_units_filled', 0) }}" required autofocus>
                            @error('no_of_units_filled')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--fuel_rate_per_litre--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.fuel_rate_per_litre') <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" id="fuel_rate_per_litre" name="fuel_rate_per_litre" class="form-control @error('fuel_rate_per_litre') is-invalid @enderror" value="{{ old('fuel_rate_per_litre') }}">
                                @error('fuel_rate_per_litre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="test" name="average_mileage_reading" value="{{ old('average_mileage_reading', 0) }}" id="average_mileage_reading-hidding" hidden>

                        {{--total_cost_of_fuel--}}
                        <div class="form-group col-12">
                            <label>@lang('fuels.total_cost_of_fuel') <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="text" disabled id="total_cost_of_fuel" name="total_cost_of_fuel" class="form-control @error('total_cost_of_fuel') is-invalid @enderror" value="{{ old('total_cost_of_fuel') }}">
                                @error('total_cost_of_fuel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="test" name="total_cost_of_fuel" value="{{ old('total_cost_of_fuel', 0) }}" id="total_cost_of_fuel-hidding" hidden>


                        {{--last_mileage_reading--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.last_mileage_reading')<span class="text-danger">*</span></label>
                            <input type="number" id="last_mileage_reading" name="last_mileage_reading" class="form-control @error('last_mileage_reading') is-invalid @enderror" value="{{ old('last_mileage_reading', 0) }}" required autofocus>
                            @error('last_mileage_reading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--current_mileage_reading--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.current_mileage_reading')<span class="text-danger">*</span></label>
                            <input type="number" id="current_mileage_reading" name="current_mileage_reading" class="form-control @error('current_mileage_reading') is-invalid @enderror" value="{{ old('current_mileage_reading', 0) }}" required autofocus>
                            @error('current_mileage_reading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>{{-- row --}}


                    {{--average_mileage_reading--}}
                    <div class="form-group">
                        <label>@lang('fuels.average_mileage_reading')<span class="text-danger">*</span></label>
                        <input type="number" disabled id="average_mileage_reading" name="average_mileage_reading" class="form-control @error('average_mileage_reading') is-invalid @enderror" value="{{ old('average_mileage_reading', 0) }}" required autofocus>
                        @error('average_mileage_reading')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--hours_worked_weekly--}}
                    <div class="form-group">
                        <label>@lang('fuels.hours_worked_weekly')<span class="text-danger">*</span></label>
                        <input type="number" id="hours_worked_weekly" name="hours_worked_weekly" class="form-control @error('average_mileage_reading') is-invalid @enderror" value="{{ old('hours_worked_weekly', 0) }}" required autofocus>
                        @error('hours_worked_weekly')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script src="{{ asset('admin_assets/js/query.number.min.js') }}" type="text/javascript"></script>

    <script>
        
        $(document).on('change keyup', '#current_mileage_reading, #no-of-unit-filled, #last_mileage_reading',function (e) {
            e.preventDefault();
            console.log('ff');

            var current     = $('#current_mileage_reading').val();
            var lastCurrent = $('#last_mileage_reading').val();
            var unit        = $('#no-of-unit-filled').val();

            var subUnit = parseInt(current) - parseInt(lastCurrent);
            var total   =  parseInt(subUnit) / parseInt(unit);

            $('#average_mileage_reading').val($.number(total, 2));
            $('#average_mileage_reading-hidding').val($.number(total, 2));
            
        });//end of change

        $(document).on('change keyup', '#no-of-unit-filled, #fuel_rate_per_litre',function (e) {
            e.preventDefault();
            console.log('ff');

            var fuelRate    = $('#fuel_rate_per_litre').val();
            var unit        = $('#no-of-unit-filled').val();

            var total = parseInt(fuelRate) * parseInt(unit);

            $('#total_cost_of_fuel').val($.number(total, 3));
            $('#total_cost_of_fuel-hidding').val($.number(total, 3));
            
        });//end of change

        $(document).on('change', '.equipment',function () {
            
            var type = $(this).find(':selected').data('type');
            
            if (type == 'heavyweight') {
    
                $('#last_mileage_reading').attr('disabled', true);
                $('#current_mileage_reading').attr('disabled', true);
                $('#hours_worked_weekly').attr('disabled', false);
                
            }
    
            if (type == 'lightweight') {
        
                $('#last_mileage_reading').attr('disabled', false);
                $('#current_mileage_reading').attr('disabled', false);
                $('#hours_worked_weekly').attr('disabled', true);
        
            }
    
        });//end of change

        //select 2
        $('.select2').select2({
            'width': '100%',
            'tags': false,
            'minimumResultsForSearch': Infinity
        });

    </script>

@endpush