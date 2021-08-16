
@if(Session::has('errors'))
    <div class="alert alert-danger">
    @foreach ($errors->all() as  $value)

<p>{{ $value }}</p>

@endforeach
        <!-- <p>{{ Session('errors') }}</p> -->
    </div>
@endif

@if(Session::has('danger'))
    <div class="alert alert-danger">
        <p>{{ Session('danger') }}</p>
    </div>
@endif
@if(Session::has('danger_deactive'))
    <div class="alert alert-danger">
        <p>{{ Session('danger_deactive') }}</p>
        <a target="_blank" href="http://land.golden-info.com/index.html#tm-area-contact">تواصل مع خدمه العملاء </a>
    </div>
@endif


@if(session('success'))
                <div class="alert alert-success" role='alert'>
                {{session('success')}}
                </div>
 @endif
