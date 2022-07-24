@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('specs.specs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.specs.index') }}">@lang('specs.specs')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.specs.store') }}">
                    @csrf
                    @method('post')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('specs.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--type_spec--}}
                    <div class="form-group">
                        <label>@lang('specs.type_spec')<span class="text-danger">*</span></label>
                        <input type="text" name="type_spec" class="form-control @error('type_spec') is-invalid @enderror" value="{{ old('type_spec') }}" required autofocus>
                        @error('type_spec')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--countrys--}}
                    <div class="form-group @error('country_id') custom-select @enderror">
                        <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                        <select name="country_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('countrys.countrys')</option>
                            @foreach ($countrys as $country)
                                <option value="{{ $country->id }}" {{ $country->id == old('country_id') ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{--citys--}}
                    <div class="form-group @error('city_id') custom-select @enderror">
                        <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                        <select name="city_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('citys.citys')</option>
                            @foreach ($citys as $city)
                                <option value="{{ $city->id }}" {{ $city->id == old('city_id') ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- break_down_description --}}
                    <div class="form-group">
                        <label>@lang('specs.description') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="20">{{ old('description') }}</textarea>
                        @error('description')
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


