@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item"><a class="back-page" href="{{ route('admin.equipments.attachment.index', $equipment->id) }}">@lang('equipments.attachments')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.equipments.attachment.store', ['equipment' => $equipment->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    @include('admin.partials._errors')

                    {{-- attachments --}}
                    <div class="form-group">
                        <label>@lang('insurances.claim_attachments') 
                            <span class="text-danger">*</span>
                            <small>( @lang('equipments.attachments_mssag') </small> 
                            <small style="font-weight: bold;">@lang('equipments.attachments_docum') )</small> 
                        </label>
                        <input type="file" name="attachments[]" multiple class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}" required>
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