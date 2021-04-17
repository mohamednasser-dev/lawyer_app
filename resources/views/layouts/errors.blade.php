
@if(Session::has('errors'))
    <div class="alert alert-danger">
    @foreach ($errors->all() as  $value)

<p>{{ $value }}</p>

@endforeach
        <!-- <p>{{ Session('errors') }}</p> -->
    </div>
@endif




@if(session('success'))
                <div class="alert alert-success" role='alert'>
                {{session('success')}}
                </div>
 @endif
