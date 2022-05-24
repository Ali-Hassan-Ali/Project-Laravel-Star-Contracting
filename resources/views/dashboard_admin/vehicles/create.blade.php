@extends('dashboard_admin.layout.app')

@section('content')

@section('title', __('dashboard.dashboard') .' - '. __('dashboard.vehicles')  .' - '. __('dashboard.add'))

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('dashboard.vehicles')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.admin.welcome') }}"><i class="fa fa-dashboard"></i> @lang('dashboard.dashboard')</a></li>
                <li><a href="{{ route('dashboard.admin.vehicles.index') }}"> @lang('dashboard.vehicles')</a></li>
                <li class="active">@lang('dashboard.add')</li>
            </ol>

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('dashboard.add')</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    <form action="{{ route('dashboard.admin.vehicles.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>@lang('dashboard.plate')</label>
                            <input type="text" name="plate" class="form-control @error('plate') is-invalid @enderror" value="{{ old('plate') }}">
                            @error('plate')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.car_model')</label>
                            <input type="text" name="car_model" class="form-control @error('car_model') is-invalid @enderror" value="{{ old('car_model') }}">
                            @error('car_model')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.car_brand')</label>
                            <input type="text" name="car_brand" class="form-control @error('car_brand') is-invalid @enderror" value="{{ old('car_brand') }}">
                            @error('car_brand')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.mechanic_name')</label>
                            <input type="text" name="mechanic_name" class="form-control @error('mechanic_name') is-invalid @enderror" value="{{ old('mechanic_name') }}">
                            @error('mechanic_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.maifunction')</label>
                            <input type="datetime" name="maifunction" class="form-control @error('maifunction') is-invalid @enderror" value="{{ old('maifunction') }}">
                            @error('maifunction')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.date_of_recieve')</label>
                            <input type="date" name="date_of_recieve" class="form-control @error('date_of_recieve') is-invalid @enderror" value="{{ old('date_of_recieve') }}">
                            @error('date_of_recieve')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.services_cost')</label>
                            <input type="date" name="services_cost" class="form-control @error('services_cost') is-invalid @enderror" value="{{ old('services_cost') }}">
                            @error('services_cost')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>@lang('dashboard.insurance_scan')</label>
                            <input type="file" name="insurance_scan" class="form-control @error('insurance_scan') is-invalid @enderror" value="{{ old('insurance_scan') }}">
                            @error('insurance_scan')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>@lang('dashboard.registeration_scan')</label>
                            <input type="file" name="registeration_scan" class="form-control @error('registeration_scan') is-invalid @enderror" value="{{ old('registeration_scan') }}">
                            @error('registeration_scan')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> @lang('dashboard.add')
                            </button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
