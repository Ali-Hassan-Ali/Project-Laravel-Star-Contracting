@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('maintenances.maintenances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.maintenances.index') }}">@lang('maintenances.maintenances')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                @include('admin.partials._errors')

                <form method="post" action="{{ route('admin.maintenances.store') }}">
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
                        $numbers    = ['last_service_km','next_service_dueon_km','actual_service_reading'];
                        $data_times = ['last_service_date','next_service_date','actual_service_date'];
                        $status     = [1, 0];
                        $enums      = ['scheduled'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('maintenances.' . $number)<span class="text-danger">*</span></label>
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
                            <label>@lang('maintenances.' . $data_time)<span class="text-danger">*</span></label>
                            <input type="date" name="{{ $data_time }}" class="form-control @error($data_time) is-invalid @enderror" value="{{ old($data_time) }}" required autofocus>
                            @error($data_time)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach


                    @foreach ($enums as $enum)
                        
                        {{--$enum--}}
                        <div class="form-group">
                            <label>@lang('maintenances.' . $enum) <span class="text-danger">*</span></label>
                            <select name="{{ $enum }}" class="form-control select2 @error($enum) custom-select @enderror" required>
                                <option value="">@lang('site.choose') @lang('maintenances.' . $enum)</option>
                                @foreach ($status as $statu)
                                    <option value="{{ $statu }}" {{ $statu == old($enum) ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                                @endforeach
                            </select>
                            @error($enum)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach


                    {{-- non_scheduled --}}
                    <div class="form-group">
                        <label>@lang('maintenances.non_scheduled') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('non_scheduled') is-invalid @enderror" name="non_scheduled" rows="6">{{ old('non_scheduled') }}</textarea>
                        @error('non_scheduled')
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


