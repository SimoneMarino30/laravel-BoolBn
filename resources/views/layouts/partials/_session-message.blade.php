@if (session('message_content'))
    <div class="alert alert-{{session('message_type') ? session('message_type') : 'success'}} d-flex justify-content-between">
        {{session('message_content')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif