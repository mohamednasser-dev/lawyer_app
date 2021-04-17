@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
          href="{{url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.add_case_header')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                     <h6 class="card-title">{{trans('site_lang.add_case_title')}}</h6>
                     <form class="cmxform" method="post" id="new_case">
                        <fieldset>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="mokel">{{trans('site_lang.search_case_clients')}}</label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple" data-width="100%"
                                        id="mokel" name="mokel_name[]" required>
                                    @foreach($clients as $client)
                                        <option
                                            value='{{$client->id}}'>{{$client->client_Name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="mokel_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="Opponent">{{trans('site_lang.search_case_khesms')}}</label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple" data-width="100%"
                                        id="Opponent" name="khesm_name[]" required>
                                    @foreach($khesm as $khesm)
                                        <option
                                            value='{{$khesm->id}}'>{{$khesm->client_Name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="khesm_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="invetation_num">{{trans('site_lang.home_session_case_number')}}</label>
                                <input type="text" name="invetation_num" class="form-control"
                                       id="invetation_num"
                                       placeholder="{{trans('site_lang.home_session_case_number')}}"
                                       value="{{ old('case_Number') }}">
                                <span class="text-danger" id="case_Number_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="circle_num">{{trans('site_lang.add_case_circle_num')}}</label>
                                <input type="text" name="circle_num" class="form-control"
                                       id="circle_num"
                                       placeholder="{{trans('site_lang.add_case_circle_num')}}"
                                       value="{{ old('circle_num') }}">
                                <span class="text-danger" id="circle_Number_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="court">{{trans('site_lang.add_case_court')}}</label>
                                <input type="text" name="court" class="form-control"
                                       id="court"
                                       placeholder="{{trans('site_lang.add_case_court')}}"
                                       value="{{ old('court') }}">
                                <span class="text-danger" id="court_Name_error"></span>
                            </div>
                            <label for="first_session_date">{{trans('site_lang.home_session_date')}}</label>
                            <div class="input-group date datepicker" id="datePickerSession">
                                <input type="text" class="form-control" id="first_session_date"
                                       name="first_session_date"
                                       value="{{ old('first_session_date') }}"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                                <span class="text-danger" id="first_date_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="inventation_type">{{trans('site_lang.add_case_inventation_type')}}</label>
                                <input type="text" name="inventation_type" id="inventation_type"
                                       class="form-control"
                                       placeholder="{{trans('site_lang.add_case_inventation_type')}}"
                                       value="{{ old('inventation_type') }}">
                                <span class="text-danger" id="lawsuit_error"></span>
                            </div>
                            @php
                                $user_type = auth()->user()->type;
                                if($user_type == 'admin'){
                            @endphp
                            <div class="form-group">
                                <label for="form-field-select-3">{{trans('site_lang.add_case_to_whom')}}</label>
                                <select id="form-field-select-3" name="to_whome" class="js-example-basic-single w-100"
                                        data-width="100%">
                                    <option value="">
                                        &nbsp;{{trans('site_lang.add_case_to_whom')}}</option>
                                    @foreach($categories as $category)
                                        <option
                                            value='{{$category->id}}'>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="lawsuit_error"></span>
                            </div>
                            @php
                                }
                            @endphp
                            <input class="btn btn-primary btn-block" type="submit" id="add_case" name="add_case"
                                   value="{{trans('site_lang.add_case_title')}}">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-plugin')
    <script src="{{url('/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{url('/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{url('/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endsection
@section('custom-scripts')

    <script src="{{url('/assets/js/form-validation.js') }}"></script>
    <script src="{{url('/assets/js/inputmask.js') }}"></script>
    <script src="{{url('/assets/js/select2.js') }}"></script>
    <script src="{{url('/assets/js/tags-input.js') }}"></script>
    <script src="{{url('assets/js/datepicker.js') }}"></script>
    <script>
        // global app configuration object
        var config = {
            trans: {
                to_whome: "{{trans('usersValidations.to_whome')}}",
                inventation_type: "{{trans('usersValidations.inventation_type')}}",
                first_session_date: "{{trans('usersValidations.first_session_date')}}",
                court: "{{trans('usersValidations.court')}}",
                circle_num: "{{trans('usersValidations.circle_num')}}",
                invetation_num: "{{trans('usersValidations.invetation_num')}}",
                add_case_route: "{{route('cases.store')}}",
            }
        };

    </script>
@endsection

