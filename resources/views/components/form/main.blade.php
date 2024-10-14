<form class="p-5" action="{{ $action ?? '' }}" method="POST" enctype="multipart/form-data">
    @method($method ?? 'POST')
    @csrf

    {{ $slot }}
    
    <div><button class="btn btn-lg btn-{{ $button ?? 'primary' }}" type="submit"> Valider </button></div>
</form>