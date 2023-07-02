<form {{ $attributes(['class'=>"row gy-4"]) }} id={{$id}} method="POST" enctype="multipart/form-data">
    {{ $slot }}

    {{ $button ?? ''}}
</form>
