@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('spares.spares')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.spares.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- equipment --}}
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

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('spares.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--part_no--}}
                    <div class="form-group">
                        <label>@lang('spares.part_no')<span class="text-danger">*</span></label>
                        <input type="text" name="part_no" class="form-control @error('part_no') is-invalid @enderror" value="{{ old('part_no') }}" required autofocus>
                        @error('part_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    {{--part_no--}}
                    <div class="form-group">
                        <label>@lang('spares.cost')<span class="text-danger">*</span></label>
                        <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost') }}" required autofocus>
                        @error('cost')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--freight_charges--}}
                    <div class="form-group">
                        <label>@lang('spares.freight_charges')<span class="text-danger">*</span></label>
                        <input type="text" name="freight_charges" class="form-control @error('freight_charges') is-invalid @enderror" value="{{ old('freight_charges') }}" required autofocus>
                        @error('freight_charges')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $status = ['1', '0'];
                    @endphp

                    {{--$used--}}
                    <div class="form-group">
                        <label>@lang('spares.used') <span class="text-danger">*</span></label>
                        <select name="used" id="used" class="form-control select2 @error('used') custom-select @enderror" required>
                            <option value="" selected disabled>@lang('site.choose') @lang('spares.used')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('used') ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                            @endforeach
                        </select>
                        @error('used')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- usage_date --}}
                    <div class="form-group">
                        <label>@lang('spares.usage_date') <span class="text-danger">*</span></label>
                        <input {{ old('spare ') == '0' ? 'disabled' : '' }} disabled id="usage-date" type="date" name="usage_date" autofocus class="form-control @error('usage_date') is-invalid @enderror" value="{{ old('usage_date') }}" required>
                        @error('usage_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="form-group">
                        <label>@lang('spares.description') <span class="text-danger">*</span></label>
                        <textarea {{ old('spare ') == '0' ? 'disabled' : '' }} disabled id="usage-description" class="form-control @error('description') is-invalid @enderror" name="description" rows="6">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--citys--}}
                    <div class="form-group">
                        <label>@lang('spares.location') <span class="text-danger">*</span></label>
                        <select name="city_id" class="form-control select2" required>
                            <option value="" selected disabled>@lang('site.choose') @lang('spares.location')</option>
                            @foreach ($citys as $city)
                                <option value="{{ $city->id }}" {{ $city->id == old('city_id') ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    
                    {{-- attachments --}}
                    <div class="form-group">
                        <label>@lang('spares.attachments') <span class="text-danger">*</span></label>
                        <input type="file" name="attachments" autofocus class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}" required>
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
        
        $('#used').on('change', function () {

            var value = $(this).val();

            if (value == '0') {

                $('#usage-date').attr('disabled', true);
                $('#usage-description').attr('disabled', true);

            } else {

                $('#usage-date').attr('disabled', false);
                $('#usage-description').attr('disabled', false);

            }//end of if
            
        });//end of chage

    </script>

@endpush