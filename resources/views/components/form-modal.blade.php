<form class="row g-4" id={{$id}} method="POST">
    {{ $slot }}

    <div>
        {{ $button ?? ''}}
    </div>
</form>
