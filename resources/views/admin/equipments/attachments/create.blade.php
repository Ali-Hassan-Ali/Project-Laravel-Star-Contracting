@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
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
                        <label>@lang('insurances.claim_attachments') <span class="text-danger">*</span></label>
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


@push('scripts')

    <script>

        $('#country').on('change', function () {

            var value  = $(this).val();
            var method = 'post';
            var url    = "{{ route('admin.equipments.country') }}";

            $.ajax({
                url: url,
                method: method,
                data: {
                    country_id : value
                },
                success: function (data) {
                    
                    $('#city').empty('');

                    $.each(data, function(index,item) {

                        var html = `<option value="${item.id}">${item.name}</option>`;

                        $('#city').append(html);

                    });//end of each

                }//end of each
            });
            
        });//end of chage
        
        $('#types-equipment').on('change', function () {

            var value  = $(this).val();
            var method = 'post';
            var url    = "{{ route('admin.equipments.type') }}";

            $.ajax({
                url: url,
                method: method,
                data: {
                    type : value
                },
                success: function (data) {
                    
                    $('#spec-id').empty('');

                    $.each(data, function(index,item) {

                        var html = `<option value="${item.id}">${item.name}</option>`;

                        $('#spec-id').append(html);

                    });//end of each

                }//end of each
            });
            
        });//end of chage

        $('#operator').on('change', function () {

            var value = $(this).val();

            if (value == 'driver' || value == 'Driver') {

                $('#driver-salary').attr('disabled', false);

            } else {

                $('#driver-salary').attr('disabled', true);

            }//end of if
            
        });//end of chage

        
        $('#allocated-to').on('change', function () {
            
            var value = $(this).val();

            if (value == 'project' || value == 'Project') {

                $('#project-allocated-to').attr('disabled', false);

            } else {

                $('#project-allocated-to').attr('disabled', true);

            }//end of if
            
        });//end of chage

        $('#owner-ship').on('change', function () {
            
            var value = $(this).val();

            if (value == 'rented' || value == 'Rented') {

                $('#rental-cost-basis').attr('disabled', false);
                $('#rental-basis').attr('disabled', false);

            } else {

                $('#rental-cost-basis').attr('disabled', true);
                $('#rental-basis').attr('disabled', true);

            }//end of if
            
        });//end of chage


    </script>

@endpush