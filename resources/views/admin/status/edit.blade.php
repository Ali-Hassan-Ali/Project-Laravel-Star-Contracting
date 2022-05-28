@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('status.status')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.status.index') }}">@lang('status.status')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.status.update', $status->id) }}">
                    @csrf
                    @method('put')

                    {{--equipment_id--}}
                    <div class="form-group @error('equipment_id') custom-select @enderror">
                        <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                        <select name="equipment_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id', $status->equipment_id) ? 'selected' : '' }}>{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $statuses = [1,0];
                    @endphp

                    {{--working_status--}}
                    <div class="form-group">
                        <label>@lang('status.working_status') <span class="text-danger">*</span></label>
                        <select name="working_status" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('status.working_status')</option>
                            @foreach ($statuses as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('working_status', $status->working_status) ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                    </div>

                    {{--as_of--}}
                    <div class="form-group">
                        <label>@lang('status.as_of') <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="as_of" class="form-control @error('as_of') is-invalid @enderror" value="{{ old('as_of', $status->as_of) }}" required autofocus>
                        @error('as_of')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--break_down_date--}}
                    <div class="form-group">
                        <label>@lang('status.break_down_date') <span class="text-danger">*</span></label>
                        <input type="datetime-local" name="break_down_date" class="form-control @error('break_down_date') is-invalid @enderror" value="{{ old('break_down_date', $status->break_down_date) }}" required autofocus>
                        @error('break_down_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--break_down_duration--}}
                    <div class="form-group">
                        <label>@lang('status.break_down_duration') <span class="text-danger">*</span></label>
                        <input type="number" name="break_down_duration" class="form-control @error('break_down_duration') is-invalid @enderror" value="{{ old('break_down_duration', $status->break_down_duration) }}" required autofocus>
                        @error('break_down_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--hours_worked--}}
                    <div class="form-group">
                        <label>@lang('status.hours_worked') <span class="text-danger">*</span></label>
                        <input type="number" name="hours_worked" class="form-control @error('hours_worked') is-invalid @enderror" value="{{ old('hours_worked', $status->hours_worked) }}" required autofocus>
                        @error('hours_worked')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- break_down_description --}}
                    <div class="form-group">
                        <label>@lang('status.descrption') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('break_down_description') is-invalid @enderror" name="break_down_description" rows="3">{{ $status->break_down_description }}</textarea>
                        @error('break_down_description')
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

