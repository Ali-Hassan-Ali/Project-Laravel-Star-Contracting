@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('users.users')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.users.index') }}">@lang('users.users')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('users.f_name')<span class="text-danger">*</span></label>
                        <input type="text" name="f_name" class="form-control" value="{{ $user->f_name }}" required autofocus>
                    </div>

                    <div class="form-group">
                        <label>@lang('users.l_name')<span class="text-danger">*</span></label>
                        <input type="text" name="l_name" class="form-control" value="{{ $user->l_name }}" required autofocus>
                    </div>

                    {{--email--}}
                    <div class="form-group">
                        <label>@lang('users.email')<span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $user->Email }}" required>
                    </div>

                   

                    <div class="form-group">
                        <label>@lang('users.phone')<span class="text-danger">*</span></label>
                        <input type="number" name="phone" class="form-control" value="{{ $user->phone }}" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('users.otp')<span class="text-danger">*</span></label>
                        <input type="number" name="otp" class="form-control" value="{{ $user->OTP }}" required>
                    </div>

                    <div class="form-group">
                        <label>@lang('users.password')<span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" value="{{ old('password') }}" required>
                    </div>

                    {{--password_confirmation--}}
                    <div class="form-group">
                        <label>@lang('users.password_confirmation')<span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

