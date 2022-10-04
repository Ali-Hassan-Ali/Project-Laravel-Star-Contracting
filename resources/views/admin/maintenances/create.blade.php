@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('maintenances.maintenances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.maintenances.index') }}">@lang('maintenances.maintenances')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                @include('admin.partials._errors')

                <form method="post" action="{{ route('admin.maintenances.store') }}">
                    @csrf
                    @method('post')

                    <div class="row">
                        
                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                            <select class="form-control col-6 select2-tags-false" id="equipment-countrey">
                                <option value="">@lang('site.choose') @lang('countrys.countrys')</option>
                                @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}" 
                                        data-url="{{ route('admin.ajax.country', $country->id) }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                            <select class="form-control select2-tags-false" id="equipment-city">
                                
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group @error('equipment_id') custom-select @enderror">
                            <label>@lang('maintenances.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control select2-tags-false" required>
                                <option value="" disabled>@lang('site.choose') @lang('equipments.equipments')</option>
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

                        {{--last_service_date--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.last_service_date')<span class="text-danger">*</span></label>
                            <input type="date" name="last_service_date" id="last_service_date" class="form-control @error('last_service_date') is-invalid @enderror" value="{{ old('last_service_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('last_service_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--next_service_date--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.next_service_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="next_service_date" id="next_service_date" class="form-control @error('next_service_date') is-invalid @enderror" value="{{ old('next_service_date') }}" required autofocus>
                            @error('next_service_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="next_service_date" id="next_service_date_hidden" hidden value="{{ old('next_service_date') }}" hidden>

                        {{--last_service_km--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.last_service_km')<span class="text-danger">*</span></label>
                            <input type="number" name="last_service_km" id="last_service_km" class="form-control @error('last_service_km') is-invalid @enderror" value="{{ old('last_service_km') }}" required autofocus>
                            @error('last_service_km')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--next_service_dueon_km--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.next_service_dueon_km')<span class="text-danger">*</span></label>
                            <input type="number" name="next_service_dueon_km" disabled id="next_service_dueon_km" class="form-control @error('next_service_dueon_km') is-invalid @enderror" value="{{ old('next_service_dueon_km') }}" required autofocus>
                            @error('next_service_dueon_km')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="number" name="next_service_dueon_km" id="next_service_dueon_km_hidden" hidden value="{{ old('next_service_dueon_km') }}" hidden>

                        {{--actual_service_date--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.actual_service_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_service_date" class="form-control @error('actual_service_date') is-invalid @enderror" value="{{ old('actual_service_date') }}" required autofocus>
                            @error('actual_service_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--actual_service_reading--}}
                        <div class="form-group col-6">
                            <label>@lang('maintenances.actual_service_reading')<span class="text-danger">*</span></label>
                            <input type="number" name="actual_service_reading" class="form-control @error('actual_service_reading') is-invalid @enderror" value="{{ old('actual_service_reading') }}" required autofocus>
                            @error('actual_service_reading')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    
                    </div>{{-- row --}}


                    {{--scheduled--}}
                    <div class="form-group ml-3">
                        <div class="form-check form-switch">
                          <input class="form-check-input" id="scheduled" type="checkbox" name="scheduled" value="{{ old('scheduled', '1') }}" {{ old('scheduled', '0') == '0' ? '' : 'checked' }}>
                          <label class="form-check-label">@lang('maintenances.scheduled')</label>
                        </div>
                    </div>

                    {{--equipments--}}
                    <div class="form-group @error('non_scheduled') custom-select @enderror">
                        <label>@lang('maintenances.non_scheduled') <span class="text-danger">*</span></label>
                        <select {{ old('scheduled', '1') == '0' ? 'disabled' : '' }} name="non_scheduled" id="non-scheduled" class="form-control select2-tags-false" required>
                            <option value="" selected disabled>@lang('site.choose') @lang('maintenances.non_scheduled')</option>
                            @foreach ($non_scheduleds as $scheduled)
                                <option value="{{ $scheduled->name }}" {{ $scheduled->name == old('non_scheduled') ? 'selected' : '' }}>{{ $scheduled->name }}</option>
                            @endforeach
                        </select>
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

@push('scripts')

    <script>

        $(document).ready(function() {

            $('.select2-tags-false').select2({
                'width': '100%',
                'tags': false,
                'minimumResultsForSearch': Infinity
            });

            $('#last_service_date').on('change', function () {

                var startDate = new Date($(this).val()),
                    days      = parseInt(90);

                var newDate = startDate.setDate(startDate.getDate() + days);

                $("#next_service_date").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd
                $("#next_service_date_hidden").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd
                
            });//end of chage last service date

            // $('#last_service_km').on('change', function () {

            //     var startDate = new Date($(this).val()),
            //         days      = parseInt(4000);

            //     var newDate = startDate.setDate(startDate.getDate() + days);

            //     $("#next_service_dueon_km").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd
            //     $("#next_service_dueon_km_hidden").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd
                
            // });//end of chage last service date


            $('#last_service_km').on('change keyup', function () {

                var start  = parseInt($(this).val()),
                    count  = parseInt(4000);

                var total = start + count;

                $("#next_service_dueon_km").val(total);//YYYY-MM-dd
                $("#next_service_dueon_km_hidden").val(total);//YYYY-MM-dd
                
            });//end of chage last service date

            $('#scheduled').on('change', function () {

                var value = $(this).is(':checked') ? '1' : '0';

                if (value == '0') {

                    $('#non-scheduled').attr('disabled', false);

                } else {

                    $('#non-scheduled').attr('disabled', true);

                }//end of if
                
            });//end of chage scheduled

        });//end of document ready 
        

    </script>

@endpush