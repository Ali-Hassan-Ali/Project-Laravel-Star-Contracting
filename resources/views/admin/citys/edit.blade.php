@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('citys.citys')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.citys.index') }}">@lang('citys.citys')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.citys.update', $city->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('citys.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $city->name }}" required autofocus>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                        <select name="country_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('countrys.countrys')</option>
                            @foreach ($countrys as $country)
                                <option value="{{ $country->id }}" 
                                    {{ $country->id == old('country_id') ? 'selected' : '' }}
                                    {{ $country->id == $city->country_id ? 'selected' : '' }}
                                    >{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

