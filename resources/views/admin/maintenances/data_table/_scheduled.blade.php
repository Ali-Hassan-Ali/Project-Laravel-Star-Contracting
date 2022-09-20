{{--claim--}}
{{-- <div class="form-group ml-3">
    <div class="form-check form-switch">
      <input class="form-check-input" id="scheduled" type="checkbox" name="scheduled" data-id="{{ $maintenance->id }}" value="{{ old('scheduled', $maintenance->scheduled) }}" {{ $maintenance->scheduled == '1' ? 'checked' : '' }} disabled>
    </div>
</div> --}}

{{ $maintenance->scheduled == '1' ? 'Yes' : 'No' }}