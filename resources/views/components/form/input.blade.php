<div {{ $attributes->merge(['class' => ''])}}>
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $inputClass }}" id="{{ $inputId }}" placeholder="{{ $placeholder }}">
    <span class="text-danger d-none" id="err-msg"></span>
</div>
