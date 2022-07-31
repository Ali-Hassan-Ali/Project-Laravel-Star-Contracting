{{--claim--}}
<div class="form-group ml-3">
    <div class="form-check form-switch">
      <input class="form-check-input" id="claim" type="checkbox" name="claim" data-id="{{ $insurance->id }}" value="{{ old('claim', $insurance->claim) }}" {{ $insurance->claim == '1' ? 'checked' : '' }}>
      <label class="form-check-label">@lang('insurances.claim')</label>
    </div>
</div>