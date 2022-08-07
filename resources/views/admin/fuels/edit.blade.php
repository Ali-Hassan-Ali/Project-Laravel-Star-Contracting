@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('fuels.fuels')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.fuels.index') }}">@lang('fuels.fuels')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.fuels.update', $fuel->id) }}">
                    @csrf
                    @method('put')

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
                        <div class="form-group @error('equipment_id') custom-select @enderror">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.equipments')</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id', $fuel->equipment_id) ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        @php
                            $data_times = ['last_date','next_date'];
                        @endphp

                        @foreach ($data_times as $data_time)
                            
                            {{--$data_time--}}
                            <div class="form-group col-6">
                                <label>@lang('fuels.' . $data_time)<span class="text-danger">*</span></label>
                                <input type="date" name="{{ $data_time }}" class="form-control @error($data_time) is-invalid @enderror" value="{{ old($data_time, date('Y-m-d', strtotime($fuel[$data_time])) ) }}" required autofocus>
                                @error($data_time)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        @endforeach

                        {{--unit--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.unit') <span class="text-danger">*</span></label>
                            <select name="unit" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('fuels.unit')</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->name }}" {{ $unit->name == old('unit', $fuel->unit) ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--$data_time--}}
                        <div class="form-group col-6">
                            <label>@lang('fuels.no_of_units_filled')<span class="text-danger">*</span></label>
                            <input type="number" id="no-of-unit-filled" name="no_of_units_filled" class="form-control @error('no_of_units_filled') is-invalid @enderror" value="{{ old('no_of_units_filled', $fuel->no_of_units_filled) }}" required autofocus>
                            @error('no_of_units_filled')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>{{-- row --}}


                    {{--fuel_types--}}
                    <div class="form-group @error('fuel_type') custom-select @enderror">
                        <label>@lang('fuels.fuel_type') <span class="text-danger">*</span></label>
                        <select name="fuel_type" class="form-control select2" required>
                            <option value="" selected disabled>@lang('site.choose') @lang('fuels.fuel_type')</option>
                            @foreach ($fuel_types as $fuel_type)
                                <option value="{{ $fuel_type->name }}" {{ $fuel_type->name == old('fuel_type', $fuel->fuel_type) ? 'selected' : '' }}>{{ $fuel_type->name }}</option>
                            @endforeach
                        </select>
                        @error('fuel_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $numbers = ['last_mileage_reading','current_mileage_reading','average_mileage_reading',
                                    'fuel_rate_per_litre','hours_worked_weekly','total_cost_of_fuel'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('fuels.' . $number)<span class="text-danger">*</span></label>
                            <input type="number" {{ $number == 'average_mileage_reading' ? 'disabled' : '' || $number == 'total_cost_of_fuel' ? 'disabled' : '' }} id="{{ $number }}" name="{{ $number }}" class="form-control @error($number) is-invalid @enderror" value="{{ old($number, $fuel[$number]) }}" required autofocus>
                            @error($number)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    <input type="number" name="average_mileage_reading" value="{{ $fuel->average_mileage_reading }}" id="average_mileage_reading-hidding" hidden>
                    <input type="number" name="total_cost_of_fuel" value="{{ $fuel->total_cost_of_fuel }}" id="total_cost_of_fuel-hidding" hidden>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>
        
        $(document).on('change', '#current_mileage_reading, #no-of-unit-filled, #last_mileage_reading',function () {

            var current     = $('#current_mileage_reading').val();
            var lastCurrent = $('#last_mileage_reading').val();
            var unit        = $('#no-of-unit-filled').val();

            var total = current - lastCurrent / unit;

            $('#average_mileage_reading').val(total);
            $('#average_mileage_reading-hidding').val(total);
            
        });//end of chage

        $(document).on('change', '#no-of-unit-filled, #fuel_rate_per_litre',function () {

            var fuelRate    = $('#fuel_rate_per_litre').val();
            var unit        = $('#no-of-unit-filled').val();

            var total = fuelRate * unit;

            $('#total_cost_of_fuel').val(total);
            $('#total_cost_of_fuel-hidding').val(total);
            
        });//end of chage

    </script>

@endpush