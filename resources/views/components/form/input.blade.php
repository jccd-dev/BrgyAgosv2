<div {{ $attributes->merge(['class' => ''])}}>
    <label for="input{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholder }}">
    <span class="text-danger" id="err-msg"></span>
</div>
