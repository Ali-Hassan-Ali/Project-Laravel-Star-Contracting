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
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus>
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
                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


