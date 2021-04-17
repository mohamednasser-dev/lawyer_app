@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/dropzone/dropzone.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/dropify/dist/dropify.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">

@endsection

@section('content')

<div class="row">

    <div class="col-lg-12 grid-margin  stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <div class="form-group">
                </div>
                {{Form::open(array('url' => 'userprofiles', 'method' => 'post', 'files' => true))}}

                {{ csrf_field() }}

                <fieldset>
                    <div class="form-group" style="text-align: center;">

                        <h6 class="card-title"></h6>
                        <a href="#" onclick="$('#userimg').trigger('click');">
                            <img width="150" height="150" id='OpenImgUpload' src="{{ asset('uploads/userprofile/'.Auth::user()->image) }}" alt="profile image" class="rounded-circle  center ">
                            <i class="fa fa-camera"></i>
                        </a>
                       

                        <input type="file" id='userimg' name="image" class="border" style="display: none;"/>

                    </div>
                    @include('layouts.errors')

                    <div class="form-group">
                        <label for="name">{{trans('site_lang.users_username')}}</label>
                        <input id="name" class="form-control" name="name" value="{{Auth::user()->name}}" type="text">
                    </div>
                    <div class="form-group">
                        <label for="email">{{trans('site_lang.users_email')}}</label>
                        <input id="email" class="form-control" name="email" value="{{Auth::user()->email}}" type="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">{{trans('site_lang.phone')}}</label>
                        <input id="phone" class="form-control" name="phone" value="{{Auth::user()->phone}}" type="text">
                    </div>
                    <div class="form-group">
                        <label for="address">{{trans('site_lang.address')}}</label>
                        <input id="address" class="form-control" name="address" value="{{Auth::user()->address}}" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password">{{trans('site_lang.auth_password')}}</label>
                        <input id="password" class="form-control" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">{{trans('site_lang.confirm_password')}}</label>
                        <input id="confirm_password" class="form-control" name="password_confirmation" type="password">
                    </div>


                    <input class="btn btn-primary btn-block" type="submit" value="{{trans('site_lang.edit')}}">
                </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>


</div>





@endsection
@section('scripts')
 
<script src="{{url('/assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{url('/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
<script src="{{url('/assets/vendors/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{url('/assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{url('/assets/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
<script src="{{url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')}}"></script>
<script src="{{url('/assets/vendors/dropzone/dropzone.min.js')}}"></script>
<script src="{{url('/assets/vendors/dropify/dist/dropify.min.js')}}"></script>
<script src="{{url('/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{url('/assets/vendors/moment/moment.min.js')}}"></script>
<script src="{{url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')}}"></script>
<script src="{{url('/assets/js/form-validation.js')}}"></script>
<script src="{{url('/assets/js/bootstrap-maxlength.js')}}"></script>
<script src="{{url('/assets/js/inputmask.js')}}"></script>
<script src="{{url('/assets/js/select2.js')}}"></script>
<script src="{{url('/assets/js/typeahead.js')}}"></script>
<script src="{{url('/assets/js/tags-input.js')}}"></script>
<script src="{{url('/assets/js/dropzone.js')}}"></script>
<script src="{{url('/assets/js/dropify.js')}}"></script>

@endsection
@section('scriptDocument')
UIModals.init();
TableData.init();

@endsection