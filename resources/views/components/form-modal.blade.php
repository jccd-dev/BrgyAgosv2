<form class="row g-4" id={{$id}} method="POST" enctype="multipart/form-data">
    {{ $slot }}

    <div>
        {{ $button ?? ''}}
    </div>
</form>
