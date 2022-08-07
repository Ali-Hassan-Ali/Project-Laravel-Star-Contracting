@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('status.status')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.status.index') }}">@lang('status.status')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.status.store') }}">
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
                        <div class="form-group col-6 @error('equipment_id') custom-select @enderror">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.equipments')</option>
                                {{-- @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                @endforeach --}}
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--as_of--}}
                        <div class="form-group col-6">
                            <label>@lang('status.as_of') <span class="text-danger">*</span></label>
                            <input type="date" disabled class="form-control @error('as_of') is-invalid @enderror" value="{{ old('as_of', date('Y-m-d', strtotime( now() ))) }}" autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('as_of')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" hidden id="as_of" name="as_of" class="form-control" value="{{ old('as_of', date('Y-m-d', strtotime( now() ))) }}" max="{{ date('Y-m-d', strtotime( now() )) }}">

                        @php
                            $status = ['Breakdown', 'Working'];
                        @endphp

                        {{--working_status--}}
                        <div class="form-group col-6">
                            <label>@lang('status.working_status') <span class="text-danger">*</span></label>
                            <select name="working_status" id="working-status" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('status.working_status')</option>
                                @foreach ($status as $statu)
                                    <option value="{{ $statu }}" {{ $statu == old('working_status') ? 'selected' : '' }}>@lang('status.' . $statu)</option>
                                @endforeach
                            </select>
                        </div>

                        {{--hours_worked--}}
                        <div class="form-group col-6">
                            <label>@lang('status.hours_worked') <span class="text-danger">*</span></label>
                            <input type="number" id="hours_worked" name="hours_worked" class="form-control @error('hours_worked') is-invalid @enderror" value="{{ old('hours_worked') }}" autofocus>
                            @error('hours_worked')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--break_down_date--}}
                        <div class="form-group col-6">
                            <label>@lang('status.break_down_date') <span class="text-danger">*</span></label>
                            <input type="date" disabled id="break_down_date" name="break_down_date" class="form-control @error('break_down_date') is-invalid @enderror" value="{{ old('break_down_date') }}" autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('break_down_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--break_down_duration--}}
                        <div class="form-group col-6">
                            <label>@lang('status.break_down_duration') <span class="text-danger">*</span></label>
                            <input type="number" disabled id="break_down_duration" class="form-control @error('break_down_duration') is-invalid @enderror" value="{{ old('break_down_duration') }}" autofocus>
                            @error('break_down_duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="number" hidden id="break_down_duration_hidden" name="break_down_duration" class="form-control" value="{{ old('break_down_duration') }}">

                    </div>{{-- row --}}

                    {{-- break_down_description --}}
                    <div class="form-group">
                        <label>@lang('status.descrption') <span class="text-danger">*</span></label>
                        <textarea disabled id="break_down_description" class="form-control @error('break_down_description') is-invalid @enderror" name="break_down_description" rows="3">{{ old('break_down_description') }}</textarea>
                        @error('break_down_description')
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

    <script>

        $(document).ready(function() {

            $(document).on('change', '#break_down_date',function () {

                var oneD      = 1000 * 60 * 60 * 24;
                var startDate = new Date($('#break_down_date').val());
                var endDate   = new Date($('#as_of').val());

                var countDay = Math.round((endDate.getTime() - startDate.getTime()) / oneD);
                $('#break_down_duration').val(countDay);
                $('#break_down_duration_hidden').val(countDay);
                
            });

            $('#working-status').on('change', function () {

                var value = $(this).val();

                if (value == 'Breakdown') {

                    $('#break_down_description').attr('disabled', false);
                    $('#break_down_date').attr('disabled', false);

                    $('#break_down_duration').attr('disabled', true);

                }//end of if

                if (value == 'Working') {

                    $('#break_down_description').attr('disabled', true);
                    $('#break_down_date').attr('disabled', true);

                    $('#hours_worked').attr('disabled', false);

                }//end of if
                
            });//end of chage

        });//end of document ready
        

    </script>

@endpush