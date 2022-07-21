@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('insurances.insurances')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.insurances.index') }}">@lang('insurances.insurances')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.insurances.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    {{--equipments--}}
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

                    {{-- insurer --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurer') <span class="text-danger">*</span></label>
                        <input type="text" name="insurer" autofocus class="form-control @error('insurer') is-invalid @enderror" value="{{ old('insurer') }}" required>
                        @error('insurer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- type_of_insurance --}}
                    <div class="form-group">
                        <label>@lang('insurances.type_of_insurance') <span class="text-danger">*</span></label>
                        <input type="text" name="type_of_insurance" autofocus class="form-control @error('type_of_insurance') is-invalid @enderror" value="{{ old('type_of_insurance') }}" required>
                        @error('type_of_insurance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- premium --}}
                    <div class="form-group">
                        <label>@lang('insurances.premium') <span class="text-danger">*</span></label>
                        <input type="number" name="premium" autofocus class="form-control @error('premium') is-invalid @enderror" value="{{ old('premium') }}" required>
                        @error('premium')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- policy_number --}}
                    <div class="form-group">
                        <label>@lang('insurances.policy_number') <span class="text-danger">*</span></label>
                        <input type="number" name="policy_number" autofocus class="form-control @error('policy_number') is-invalid @enderror" value="{{ old('policy_number') }}" required>
                        @error('policy_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- insurance_start_date --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_start_date') <span class="text-danger">*</span></label>
                        <input type="date" name="insurance_start_date" autofocus class="form-control @error('insurance_start_date') is-invalid @enderror" value="{{ old('insurance_start_date') }}" required>
                        @error('insurance_start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- insurance_expiry --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_expiry') <span class="text-danger">*</span></label>
                        <input type="date" name="insurance_expiry" autofocus class="form-control @error('insurance_expiry') is-invalid @enderror" value="{{ old('insurance_expiry') }}" required>
                        @error('insurance_expiry')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- insurance_duration --}}
                    <div class="form-group">
                        <label>@lang('insurances.insurance_duration') <span class="text-danger">*</span></label>
                        <input type="number" name="insurance_duration" autofocus class="form-control @error('insurance_duration') is-invalid @enderror" value="{{ old('insurance_duration') }}" required>
                        @error('insurance_duration')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $claims = [1,0];
                    @endphp

                    {{--plate_no--}}
                    <div class="form-group">
                        <label>@lang('insurances.claims') <span class="text-danger">*</span></label>
                        <select name="claims" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.claim')</option>
                            @foreach ($claims as $claim)
                                <option value="{{ $claim }}" {{ $claim == old('claims') ? 'selected' : '' }}>@lang('site.' . $claim)</option>
                            @endforeach
                        </select>
                    </div>


                    {{-- claim_date --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_date') <span class="text-danger">*</span></label>
                        <input type="date" name="claim_date" autofocus class="form-control @error('claim_date') is-invalid @enderror" value="{{ old('claim_date') }}" required>
                        @error('claim_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- claim_amount --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_amount') <span class="text-danger">*</span></label>
                        <input type="number" name="claim_amount" autofocus class="form-control @error('claim_amount') is-invalid @enderror" value="{{ old('claim_amount') }}" required>
                        @error('claim_amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{-- claim_description --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_description') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('claim_description') is-invalid @enderror" name="claim_description" rows="20">{{ old('claim_description') }}</textarea>
                        @error('claim_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- claim_attachments --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_attachments') <span class="text-danger">*</span></label>
                        <input type="file" name="claim_attachments" autofocus class="form-control @error('claim_attachments') is-invalid @enderror" value="{{ old('claim_attachments') }}" required>
                        @error('claim_attachments')
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


