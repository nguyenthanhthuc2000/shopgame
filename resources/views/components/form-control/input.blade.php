<div class="mb-3 {{ $class ?? '' }}">
    <label for="{{ $id ?? '' }}" class="form-label">{{ $placeholder ?? '' }}</label>
    <input type="{{ $name ?? '' }}" class="form-control {{ $input_class ?? '' }}" id="{{ $id ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}" value={{ $value ?? '' }}>
</div>
