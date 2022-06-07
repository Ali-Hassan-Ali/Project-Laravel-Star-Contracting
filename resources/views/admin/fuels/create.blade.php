@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('fuels.fuels')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.fuels.index') }}">@lang('fuels.fuels')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                @include('admin.partials._errors')

                <form method="post" action="{{ route('admin.fuels.store') }}">
                    @csrf
                    @method('post')

                    {{--equipment_id--}}
                    <div class="form-group @error('equipment_id') custom-select @enderror">
                        <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                        <select name="equipment_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    @php
                        $numbers    = ['no_of_units_filled','last_mileage_reading','current_mileage_reading','average_mileage_reading','fuel_rate_per_litre','hours_worked_weekly','total_cost_of_fuel'];
                        $data_times = ['last_date','next_date'];
                        $textareas  = ['unit','fuel_type'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('fuels.' . $number)<span class="text-danger">*</span></label>
                            <input type="number" name="{{ $number }}" class="form-control @error($number) is-invalid @enderror" value="{{ old($number) }}" required autofocus>
                            @error($number)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    @foreach ($data_times as $data_time)
                        
                        {{--$data_time--}}
                        <div class="form-group">
                            <label>@lang('fuels.' . $data_time)<span class="text-danger">*</span></label>
                            <input type="date" name="{{ $data_time }}" class="form-control @error($data_time) is-invalid @enderror" value="{{ old($data_time) }}" required autofocus>
                            @error($data_time)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    @foreach ($textareas as $textarea)
                        
                        {{-- $textarea --}}
                        <div class="form-group">
                            <label>@lang('fuels.'.$textarea) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error($textarea) is-invalid @enderror" name="{{ $textarea }}" rows="6">{{ old($textarea) }}</textarea>
                            @error($textarea)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    @endforeach

                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


