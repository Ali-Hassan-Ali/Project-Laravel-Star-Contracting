@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('spares.spares')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.spares.update', $spare->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

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

                        {{-- equipment --}}
                        <div class="form-group @error('equipment_id') custom-select @enderror">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipments[]" multiple id="equipment-man" class="form-control select2" required>
                                <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id', $spare->equipment_id) ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--name--}}
                        <div class="form-group col-6">
                            <label>@lang('spares.name')<span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $spare->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--part_no--}}
                        <div class="form-group col-6">
                            <label>@lang('spares.part_no')<span class="text-danger">*</span></label>
                            <input type="text" name="part_no" class="form-control @error('part_no') is-invalid @enderror" value="{{ old('part_no', $spare->part_no) }}" required autofocus>
                            @error('part_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--cost--}}
                        <div class="form-group col-6">
                            <label>@lang('spares.cost') <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $spare->cost) }}" required>
                                @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        {{--freight_charges--}}
                        <div class="form-group col-6">
                            <label>@lang('spares.freight_charges') <span class="text-danger">*</span></label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" name="freight_charges" class="form-control @error('freight_charges') is-invalid @enderror" value="{{ old('freight_charges', $spare->freight_charges) }}" required>
                                @error('freight_charges')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    </div>{{-- row --}}

                    {{--$used--}}
                    <div class="form-group ml-3">
                        <div class="form-check form-switch">
                          <input class="form-check-input" id="used" type="checkbox" name="used" value="{{ old('used', '1') }}" {{ old('used', $spare->used) == '0' ? '' : 'checked' }}>
                          <label class="form-check-label">@lang('spares.used')</label>
                        </div>
                    </div>

                    {{-- usage_date --}}
                    <div class="form-group">
                        <label>@lang('spares.usage_date') <span class="text-danger">*</span></label>
                        <input {{ old('used', $spare->used) == '1' ? '' : 'disabled' }} id="usage-date" type="date" name="usage_date" autofocus class="form-control @error('usage_date') is-invalid @enderror" value="{{ old('usage_date', $spare->usage_date ? date('Y-m-d', strtotime($spare->usage_date)) : '') }}" required>
                        @error('usage_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="form-group">
                        <label>@lang('spares.description') <span class="text-danger">*</span></label>
                        <textarea {{ old('used', $spare->used) == '1' ? '' : 'disabled' }} id="usage-description" class="form-control @error('description') is-invalid @enderror" name="description" rows="6">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    
                    {{-- attachments --}}
                    <div class="form-group">
                        <label>@lang('spares.attachments') <span class="text-danger">*</span></label>
                        <input type="file" name="attachments[]" autofocus class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}">
                        @error('attachments')
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
        
        $('#used').on('change', function () {

            var value = $(this).is(':checked') ? '1' : '0';

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