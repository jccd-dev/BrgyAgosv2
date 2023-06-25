@props(['title', 'divClass', 'btnClass', 'type'])

<div class="{{ $divClass }}">
    <button type="{{ $type }}" class="btn {{ $btnClass }}">{{ $title }}</button>
</div>
