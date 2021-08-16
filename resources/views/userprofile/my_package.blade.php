@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/dropzone/dropzone.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/dropify/dist/dropify.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')}}">
@endsection
@section('content')
    @php
        $expiry_date = auth()->user()->expiry_date;
        $expiry_package = auth()->user()->expiry_package;
        $package_name = auth()->user()->Package->name ;
        if(auth()->user()->warning_date < Carbon\Carbon::now()){
            $warning = 'y';
        }else{
            $warning = 'n';
        }
    @endphp
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.my_package')}}</li>
        </ol>
    </nav>
<div class="row">
    <div class="col-lg-12 grid-margin  stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-xl-12 stretch-card">
                            <div class="row flex-grow">
                                <div class="col-md-12 grid-margin stretch-card">
                                    @if($warning == 'y')
                                        <div class="card card-inverse-warning">
                                            <div class="card-body ">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    <h2 style="font-size: 25px;"
                                                        class="card-title mb-0">{{trans('site_lang.alert')}}</h2>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 col-xl-10">
                                                        <div class="d-flex align-items-baseline">
                                                            <h4 class="mb-7">{{trans('site_lang.package_warning')}} </h4>
                                                        </div>
                                                        <div class="d-flex align-items-baseline">
                                                            <h3 class="mb-7">( {{$package_name}} )</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-12 col-xl-10">
                                                        <div class="d-flex align-items-baseline">
                                                            <div class="d-flex align-items-baseline">
                                                                <p class="text-success">
                                                                    {{trans('site_lang.expired_date')}} {{$expiry_date}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->parent_id == null)
                                                        <div class="col-4 col-md-12 col-xl-10">
                                                            <div class="d-flex align-items-baseline">
                                                                <div class="d-flex align-items-baseline">
                                                                    <a href="{{route('renew_package')}}" class="btn btn-primary"
                                                                       style="color: white;">{{trans('site_lang.renew_package')}} </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card card-inverse-success">
                                            <div class="card-body ">
                                                <div class="d-flex justify-content-between align-items-baseline">
                                                    <h2 style="font-size: 25px;"
                                                        class="card-title mb-0">{{trans('site_lang.alert')}}</h2>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-12 col-xl-10">
                                                        <div class="d-flex align-items-baseline">
                                                            <h4 class="mb-7">{{trans('site_lang.package_warning')}} </h4>
                                                        </div>
                                                        <div class="d-flex align-items-baseline">
                                                            <h3 class="mb-7">( {{$package_name}} )</h3>
                                                        </div>
                                                    </div>
                                                    <div class="col-4 col-md-12 col-xl-10">
                                                        <div class="d-flex align-items-baseline">
                                                            <div class="d-flex align-items-baseline">
                                                                <p class="text-success">
                                                                    {{trans('site_lang.expired_date')}} {{$expiry_date}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->parent_id == null)
                                                        <div class="col-4 col-md-12 col-xl-10">
                                                            <div class="d-flex align-items-baseline">
                                                                <div class="d-flex align-items-baseline">
                                                                    <a href="{{route('renew_package')}}" class="btn btn-primary"
                                                                       style="color: white;">{{trans('site_lang.renew_package')}} </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
