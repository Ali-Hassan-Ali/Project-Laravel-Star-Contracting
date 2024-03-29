@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('insurances.insurances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.insurances.index') }}">@lang('insurances.insurances')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.insurances.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

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
                            <select class="form-control select2-tags-false" required id="equipment-city">
                                
                            </select>
                        </div>
                        {{--equipments--}}
                        <div class="form-group @error('equipment_id') custom-select @enderror">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control select2-tags-false" required>
                                <option value="" disabled>@lang('site.choose') @lang('equipments.equipments')</option>
                                @if(old('equipment_id'))

                                    @foreach ($equipments as $equipment)
                                        <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                    @endforeach

                                @endif
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--insurer--}}
                        <div class="form-group col-6 @error('insurer') custom-select @enderror">
                            <label>@lang('insurances.insurer') <span class="text-danger">*</span></label>
                            <select name="insurer" class="form-control select2" required>
                                <option value="">@lang('site.choose') @lang('insurances.insurer')</option>
                                @foreach ($insurers as $insurer)
                                    <option value="{{ $insurer->name }}" {{ $insurer->name == old('insurer') ? 'selected' : '' }}>{{ $insurer->name }}</option>
                                @endforeach
                            </select>
                            @error('insurer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- type_of_insurance --}}
                        <div class="form-group col-6 @error('type_of_insurance') custom-select @enderror">
                            <label>@lang('insurances.type_of_insurance') <span class="text-danger">*</span></label>
                            <select name="type_of_insurance" class="form-control select2" required>
                                <option value="">@lang('site.choose') @lang('insurances.type_of_insurance')</option>
                                @foreach ($type_insurances as $type_insur)
                                    <option value="{{ $type_insur->name }}" {{ $type_insur->name == old('type_of_insurance') ? 'selected' : '' }}>{{ $type_insur->name }}</option>
                                @endforeach
                            </select>
                            @error('type_of_insurance')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- premium --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.premium') <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="premium" class="form-control @error('premium') is-invalid @enderror" value="{{ old('premium') }}" required>
                                @error('premium')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- policy_number --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.policy_number') <span class="text-danger">*</span></label>
                            <input type="text" name="policy_number" autofocus class="form-control @error('policy_number') is-invalid @enderror" value="{{ old('policy_number') }}" required>
                            @error('policy_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- insurance_start_date --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.insurance_start_date') <span class="text-danger">*</span></label>
                                <input type="date" name="insurance_start_date" id="insurance_start_date"  autofocus class="form-control @error('insurance_start_date') is-invalid @enderror" value="{{ old('insurance_start_date') }}" required max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('insurance_start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- insurance_duration --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.insurance_duration') <span class="text-danger">*</span></label>
                            <input type="number" name="insurance_duration" id="insurance_duration" autofocus class="form-control @error('insurance_duration') is-invalid @enderror" value="{{ old('insurance_duration') }}" required>
                            @error('insurance_duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- insurance_expiry --}}
                        <div class="form-group">
                            <label>@lang('insurances.insurance_expiry') <span class="text-danger">*</span></label>
                            <input type="date" name="insurance_expiry" id="insurance_expiry" disabled autofocus class="form-control @error('insurance_expiry') is-invalid @enderror" value="{{ old('insurance_expiry') }}" required>
                            @error('insurance_expiry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="insurance_expiry" id="insurance_expiry_hidden" value="{{ old('insurance_expiry') }}" hidden>


                       {{--claim--}}
                        <div class="form-group ml-3">
                            <div class="form-check form-switch">
                              <input class="form-check-input" id="claim" type="checkbox" name="claim" value="{{ old('claim', '1') }}" {{ old('claim') == '1' ? 'checked' : '' }}>
                              <label class="form-check-label">@lang('insurances.claim')</label>
                            </div>
                        </div>


                        {{-- claim_date --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.claim_date') <span class="text-danger">*</span></label>
                            <input type="date" name="claim_date" {{ old('claim','0') == '1' ? '' : 'disabled' }} id="claim_date" autofocus class="form-control @error('claim_date') is-invalid @enderror" value="{{ old('claim_date') }}" max="{{ date('Y-m-d', strtotime(now())) }}" required>
                            @error('claim_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- claim_amount --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.claim_amount') <span class="text-danger">*</span></label>
                            <input type="number" {{ old('claim','0') == '1' ? '' : 'disabled' }} name="claim_amount" id="claim_amount" autofocus class="form-control @error('claim_amount') is-invalid @enderror" required value="{{ old('claim_amount') }}">
                            @error('claim_amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>{{-- row --}}
                    

                    {{-- claim_description --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_description') <span class="text-danger">*</span></label>
                        <textarea {{ old('claim','0') == '1' ? '' : 'disabled' }} id="claim_description" class="form-control @error('claim_description') is-invalid @enderror" name="claim_description" rows="5" required>{{ old('claim_description') }}</textarea>
                        @error('claim_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- claim_attachments --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_attachments') <span class="text-danger">*</span>
                            <small>( @lang('insurances.attachments_mssage')</small>
                            <small style="font-weight: bold;">@lang('insurances.attachments_docum') )</small>
                        </label>
                        <input type="file" name="attachments[]" multiple class="form-control @error('attachments') is-invalid @enderror" accept=".pdf,image/*,.doc,.docx" required>
                        @error('attachments')
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

            $('#insurance_duration').on('change keyup', function () {

                var startDate = new Date($("#insurance_start_date").val()),
                    days      = parseInt($(this).val());

                var newDate = startDate.setDate(startDate.getDate() + days);

                $("#insurance_expiry").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd
                $("#insurance_expiry_hidden").val(new Date(newDate).toLocaleDateString('en-CA'));//YYYY-MM-dd


            });//end of chage

            $('#claim').on('change', function () {


                if ($(this).is(':checked')) {

                    $('#claim_description').attr('disabled', false);
                    $('#claim_amount').attr('disabled', false);
                    $('#claim_date').attr('disabled', false);
                    
                } else {

                    $('#claim_description').attr('disabled', true);
                    $('#claim_amount').attr('disabled', true);
                    $('#claim_date').attr('disabled', true);

                }//end of if
                
            });//end of chage
            
        });//end of reday fun
        

    </script>

@endpush