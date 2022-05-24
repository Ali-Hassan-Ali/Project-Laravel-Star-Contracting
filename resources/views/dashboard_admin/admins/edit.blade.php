@extends('dashboard_admin.layout.app')

@section('content')

<div class="content-wrapper" style="min-height: 956.281px;">
    
    <section class="content-header">

        <h1>@lang('dashboard.admins')</h1>

        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.admin.welcome') }}"><i class="fa fa-dashboard"></i> @lang('dashboard.dashboard')</a></li>
            <li><a href="{{ route('dashboard.admin.admins.index') }}"> @lang('dashboard.admins')</a></li>
            <li class="active">@lang('dashboard.edit')</li>
        </ol>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header">
                <h3 class="box-title">@lang('dashboard.edit')</h3>
            </div><!-- end of box header -->

            <div class="box-body">


                <form action="{{ route('dashboard.admin.admins.update', $admin->id) }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    {{ method_field('put') }}


                    <div class="form-group">
                        <label>@lang('dashboard.name')</label>
                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ $admin->name }}">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>@lang('dashboard.phone')</label>
                        <input type="text" name="phone" class="form-control{{ $errors->has('phone') ? 'is-invalid' : '' }}" value="{{ $admin->phone }}">
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>@lang('dashboard.email')</label>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ $admin->email }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>@lang('dashboard.citys')</label>
                        <select name="city_id" class="form-control">
                            @foreach ($citys as $city)
                                <option value="{{ $city->id }}" 
                                        {{ old('city_id') == $city->id ? 'selected' : '' }}
                                        {{ $admin->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>@lang('dashboard.image')</label>
                        <input type="file" name="image" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }} image">
                        @if ($errors->has('image'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <img src="{{ $admin->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                    </div>

                    <div class="form-group">
                        <label>@lang('admin.permissions')</label>
                        <div class="nav-tabs-custom">

                            @php
                                $models = ['admins','orders','apartments','citys'];
                                $maps = ['create', 'read', 'update', 'delete'];
                            @endphp

                            <ul class="nav nav-tabs">
                                @foreach ($models as $index=>$model)
                                    <li class="nav-item"><a class="nav-link {{ $index == 0 ? 'active' : '' }}" href="#{{ $model }}" data-toggle="tab">@lang('dashboard.' . $model)</a></li>
                                @endforeach
                            </ul>

                            <div class="tab-content">

                                @foreach ($models as $index=>$model)

                                    <div class="tab-pane {{ $index == 0 ? 'active' : '' }} my-3 mb-5" id="{{ $model }}">

                                        @foreach ($maps as $map)
                                            {{--create_admins--}}
                                            <label class="mx-2"><input type="checkbox" name="permissions[]" {{ $admin->hasPermission($model . '_' . $map) ? 'checked' : '' }} value="{{ $model . '_' . $map }}"> @lang('dashboard.' . $map)</label>
                                        @endforeach

                                    </div>

                                @endforeach

                            </div><!-- end of tab content -->

                        </div><!-- end of nav tabs -->

                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('dashboard.edit')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of box body -->

        </div><!-- end of box -->

    </section><!-- end of content -->

</div>

@endsection
