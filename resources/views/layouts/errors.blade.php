@if($errors->any())
    <div class="alert alert-danger alert-icon alert-dismissible">
        <em class="icon ni ni-cross-circle"></em>
        <ul class="list mb-0">
            @foreach ($errors->all() as $error)
                <li>{!! $error !!}</li>
            @endforeach
        </ul>
        <button class="close" data-bs-dismiss="alert"></button>
    </div>

@endif

@if(session()->has('message'))
    <div class="alert alert-success alert-icon alert-dismissible">
        <em class="icon ni ni-check-circle"></em>
        {{ session()->get('message') }}
        <button class="close" data-bs-dismiss="alert"></button>
    </div>
@endif
