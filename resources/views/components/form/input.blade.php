<div {{ $attributes->merge(['class' => ''])}}>
    <label for="{{ $name }}" class="">
        {{ $label }}
        @if ($required)
            <i class="text-danger p-1">*</i>
        @endif
    </label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $inputClass }}" id="{{ $inputId }}" placeholder="{{ $placeholder }}">
    <span class="text-danger d-none" id="err-msg"></span>
</div>
