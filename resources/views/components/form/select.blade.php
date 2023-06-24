<div {{ $attributes->merge(['class' => '']) }}>
    <label for="input{{ $name }}" class="form-label">{{$label}}</label>
    <select id="input{{ $name }}" name="{{ $name }}" class="form-select">
        <option selected value="">..</option>
        {{-- loop the option provided --}}
        @foreach ($options as $key => $val)
            <option value="{{ $val }}">{{ $key }}</option>
        @endforeach
    </select>
    <span class="text-danger" id="err-msg"></span>
</div>
