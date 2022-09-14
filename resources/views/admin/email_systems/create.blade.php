@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('email_systems.email_systems')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.email_systems.index') }}">@lang('email_systems.email_systems')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.email_systems.store') }}">
                    @csrf
                    @method('post')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('email_systems.email')<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--country_id--}}
                    <div class="row">
        
                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                            <select name="country_id" class="form-control col-6 select2" id="equipment-countrey" required>
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
                            <select name="city_id" class="form-control select2" id="equipment-city" required>
            
                            </select>
                        </div>
    
                    </div>{{-- row --}}
                    @php
                        $types = ['eir', 'expiry', 'insurances', 'other'];
                    @endphp
                    {{--equipment_id--}}
                    <div class="form-group">
                        <label>@lang('email_systems.type') <span class="text-danger">*</span></label>
                        <select name="type" class="form-control select2" required>
                            @foreach($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>@lang('email_systems.'. $type)</option>
                            @endforeach
                        </select>
                    </div>

                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


