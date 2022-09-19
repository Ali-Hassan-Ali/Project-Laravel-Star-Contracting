{{--claim--}}
{{-- <div class="form-group ml-3">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" name="idle" value="{{ old('idle', $eir->idle) }}" {{ $eir->idle == '1' ? 'checked' : '' }}>
    </div>
</div> --}}

{{ $eir->idle == '1' ? 'Yes' : 'No' }}