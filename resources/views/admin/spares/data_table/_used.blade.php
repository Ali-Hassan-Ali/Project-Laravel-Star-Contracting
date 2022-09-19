{{--claim--}}
{{-- <div class="form-group ml-3">
    <div class="form-check form-switch">
      <input class="form-check-input" id="used" type="checkbox" name="used" data-id="{{ $spare->id }}" value="{{ old('used', $spare->used) }}" {{ $spare->used == '1' ? 'checked' : '' }} disabled>
    </div>
</div> --}}

{{ $spare->used == '1' ? 'Yes' : 'No' }}