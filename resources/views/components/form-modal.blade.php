<form class="row g-4" id={{$id}}>
    {{ $slot }}

    <div>
        {{ $button ?? ''}}
    </div>
</form>
