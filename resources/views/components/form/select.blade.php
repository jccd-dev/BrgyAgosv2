<div {{ $attributes->merge(['class' => '']) }}>
    <label for="input{{ $name }}" class="">
        {{$label}}
        @if ($required)
            <i class="text-danger p-1">*</i>
        @endif
    </label>
    <select id="input{{ $name }}" name="{{ $name }}" class="form-select">
        @if (!$value)
            <option selected value="">..</option>
        @endif
        {{-- loop the option provided --}}
        @foreach ($options as $key => $val)
            @if ($value == $val)
                <option selected value="{{ $val }}">{{ $key }}</option>
            @else
                <option value="{{ $val }}">{{ $key }}</option>
            @endif

        @endforeach
    </select>
    <span class="text-danger d-none" id="err-msg"></span>
</div>
