<div class="mb-3">
    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
    <input type="{{ isset($type) ? $type : 'text' }}" class="form-control @error($field) is-invalid @enderror" name="{{ $field }}" id="{{ $field }}" value="{{ old($field) }}">
    @error($field)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
