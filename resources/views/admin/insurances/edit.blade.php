@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('insurances.insurances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.insurances.index') }}">@lang('insurances.insurances')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.insurances.update', $insurance->id) }}">
                    @csrf
                    @method('put')

                    {{--equipments--}}
                    <div class="form-group @error('equipment_id') custom-select @enderror">
                        <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                        <select name="equipment_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id', $insurance->equipment_id) ? 'selected' : '' }}>{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--insurer--}}
                    <div class="form-group @error('insurer') custom-select @enderror">
                        <label>@lang('insurances.insurer') <span class="text-danger">*</span></label>
                        <select name="insurer" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('insurances.insurer')</option>
                            @foreach ($insurers as $insurer)
                                <option value="{{ $insurer->name }}" {{ $insurer->name == old('insurer', $insurance->insurer) ? 'selected' : '' }}>{{ $insurer->name }}</option>
                            @endforeach
                        </select>
                        @error('insurer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- type_of_insurance --}}
                    <div class="form-group @error('type_of_insurance') custom-select @enderror">
                        <label>@lang('insurances.type_of_insurance') <span class="text-danger">*</span></label>
                        <select name="type_of_insurance" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('insurances.type_of_insurance')</option>
                            @foreach ($type_insurances as $type_insur)
                                <option value="{{ $type_insur->name }}" {{ $type_insur->name == old('type_of_insurance', $insurance->type_of_insurance) ? 'selected' : '' }}>{{ $type_insur->name }}</option>
                            @endforeach
                        </select>
                        @error('type_of_insurance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- premium --}}
                    <label>@lang('insurances.premium') <span class="text-danger">*</span></label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="premium" class="form-control @error('premium') is-invalid @enderror" value="{{ old('premium', $insurance->premium) }}" required>
                        @error('premium')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- policy_number --}}
                    <div class="form-group">
                        <label>@lang('insurances.policy_number') <span class="text-danger">*</span></label>
                        <input type="text" name="policy_number" autofocus class="form-control @error('policy_number') is-invalid @enderror" value="{{ old('policy_number', $insurance->policy_number) }}" required>
                        @error('policy_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- insurance_start_date --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_start_date') <span class="text-danger">*</span></label>
                            <input type="date" name="insurance_start_date" id="insurance_start_date"  autofocus class="form-control @error('insurance_start_date') is-invalid @enderror" value="{{ old('insurance_start_date', date('Y-m-d', strtotime($insurance->insurance_start_date))) }}" required>
                        @error('insurance_start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- insurance_duration --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_duration') <span class="text-danger">*</span></label>
                        <input type="number" name="insurance_duration" id="insurance_duration" autofocus class="form-control @error('insurance_duration') is-invalid @enderror" value="{{ old('insurance_duration', $insurance->insurance_duration) }}" required>
                        @error('insurance_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- insurance_expiry --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_expiry') <span class="text-danger">*</span></label>
                        <input type="date" name="insurance_expiry" id="insurance_expiry" disabled autofocus class="form-control @error('insurance_expiry') is-invalid @enderror" value="{{ old('insurance_expiry', date('Y-m-d', strtotime($insurance->insurance_expiry)) ) }}" required>
                        @error('insurance_expiry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <input type="date" name="insurance_expiry" id="insurance_expiry_hidden" value="{{ old('insurance_expiry', date('Y-m-d', strtotime($insurance->insurance_expiry))) }}" hidden>


                   {{--claim--}}
                    <div class="form-group ml-3">
                        <div class="form-check form-switch">
                          <input class="form-check-input" id="claim" type="checkbox" name="claim" value="{{ old('claim', $insurance->claim) }}" {{ $insurance->claim == '1' ? 'checked' : '' }}>
                          <label class="form-check-label">@lang('insurances.claim')</label>
                        </div>
                    </div>


                    {{-- claim_date --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_date') <span class="text-danger">*</span></label>
                        <input type="date" {{ old('claim', $insurance->claim) == '0' ? 'disabled' : '' }} name="claim_date" id="claim_date" autofocus class="form-control @error('claim_date') is-invalid @enderror" value="{{ old('claim_date', date('Y-m-d', strtotime($insurance->claim_date)) ) }}" max="{{ date('Y-m-d', strtotime(now())) }}">
                        @error('claim_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- claim_amount --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_amount') <span class="text-danger">*</span></label>
                        <input type="number" {{ old('claim', $insurance->claim) == '0' ? 'disabled' : '' }} name="claim_amount" id="claim_amount" autofocus class="form-control @error('claim_amount') is-invalid @enderror" value="{{ old('claim_amount', $insurance->claim_amount) }}">
                        @error('claim_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- claim_description --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_description') <span class="text-danger">*</span></label>
                        <textarea {{ old('claim', $insurance->claim) == '0' ? 'disabled' : '' }} id="claim_description" class="form-control @error('claim_description') is-invalid @enderror" name="claim_description" rows="5">{{ old('claim_description', $insurance->claim_description) }}</textarea>
                        @error('claim_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- claim_attachments --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_attachments') <span class="text-danger">*</span></label>
                        <input type="file" name="claim_attachments" autofocus class="form-control @error('claim_attachments') is-invalid @enderror" value="{{ old('claim_attachments') }}">
                        @error('claim_attachments')
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