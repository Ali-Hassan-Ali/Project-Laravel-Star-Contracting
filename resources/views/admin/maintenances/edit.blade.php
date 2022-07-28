@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('maintenances.maintenances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.maintenances.index') }}">@lang('maintenances.maintenances')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.maintenances.update', $maintenance->id) }}">
                    @csrf
                    @method('put')

                    <div class="form-group @error('equipment_id') custom-select @enderror">
                        <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                        <select name="equipment_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id', $maintenance->equipment_id) ? 'selected' : '' }}>{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--last_service_date--}}
                    <div class="form-group">
                        <label>@lang('maintenances.last_service_date')<span class="text-danger">*</span></label>
                        <input type="date" name="last_service_date" class="form-control @error('last_service_date') is-invalid @enderror" value="{{ old('last_service_date', date('Y-m-d', strtotime($maintenance->last_service_date))) }}" required autofocus>
                        @error('last_service_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--next_service_date--}}
                    <div class="form-group">
                        <label>@lang('maintenances.next_service_date')<span class="text-danger">*</span></label>
                        <input type="date" disabled name="next_service_date" class="form-control @error('next_service_date') is-invalid @enderror" value="{{ old('next_service_date', date('Y-m-d', strtotime($maintenance->next_service_date))) }}" required autofocus>
                        @error('next_service_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--last_service_km--}}
                    <div class="form-group">
                        <label>@lang('maintenances.last_service_km')<span class="text-danger">*</span></label>
                        <input type="number" name="last_service_km" class="form-control @error('last_service_km') is-invalid @enderror" value="{{ old('last_service_km', $maintenance->last_service_km) }}" required autofocus>
                        @error('last_service_km')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--next_service_dueon_km--}}
                    <div class="form-group">
                        <label>@lang('maintenances.next_service_dueon_km')<span class="text-danger">*</span></label>
                        <input type="number" name="next_service_dueon_km" class="form-control @error('next_service_dueon_km') is-invalid @enderror" value="{{ old('next_service_dueon_km', $maintenance->next_service_dueon_km) }}" required autofocus>
                        @error('next_service_dueon_km')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--actual_service_date--}}
                    <div class="form-group">
                        <label>@lang('maintenances.actual_service_date')<span class="text-danger">*</span></label>
                        <input type="date" name="actual_service_date" class="form-control @error('actual_service_date') is-invalid @enderror" value="{{ old('actual_service_date', date('Y-m-d', strtotime($maintenance->actual_service_date)) ) }}" required autofocus>
                        @error('actual_service_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--actual_service_reading--}}
                    <div class="form-group">
                        <label>@lang('maintenances.actual_service_reading')<span class="text-danger">*</span></label>
                        <input type="number" name="actual_service_reading" class="form-control @error('actual_service_reading') is-invalid @enderror" value="{{ old('actual_service_reading', $maintenance->actual_service_reading) }}" required autofocus>
                        @error('actual_service_reading')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $status = ['1', '0'];
                    @endphp

                    {{--scheduled--}}
                    <div class="form-group">
                        <label>@lang('maintenances.scheduled') <span class="text-danger">*</span></label>
                        <select name="scheduled" id="scheduled" class="form-control select2 @error('scheduled') custom-select @enderror" required>
                            <option value="">@lang('site.choose') @lang('maintenances.scheduled')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('scheduled', $maintenance->scheduled) ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                        @error('scheduled')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--equipments--}}
                    <div class="form-group @error('non_scheduled') custom-select @enderror">
                        <label>@lang('maintenances.non_scheduled') <span class="text-danger">*</span></label>
                        <select {{ old('scheduled', $maintenance->scheduled) == '0' ? 'disabled' : '' }} id="non-scheduled" name="non_scheduled" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('maintenances.non_scheduled')</option>
                            @foreach ($non_scheduleds as $scheduled)
                                <option value="{{ $scheduled->name }}" {{ $scheduled->name == old('non_scheduled', $maintenance->non_scheduled) ? 'selected' : '' }}>{{ $scheduled->name }}</option>
                            @endforeach
                        </select>
                        @error('non_scheduled')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

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
        
        $('#scheduled').on('change', function () {

            var value = $(this).val();

            if (value == '0') {

                $('#non-scheduled').attr('disabled', false);

            } else {

                $('#non-scheduled').attr('disabled', true);

            }//end of if
            
        });//end of chage

    </script>

@endpush

