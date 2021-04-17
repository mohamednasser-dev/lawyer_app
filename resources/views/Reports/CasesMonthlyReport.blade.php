@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/select2/select2.min.css') }}">
<link rel="stylesheet" href="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">

 
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.side_reports_monthly')}}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <a class="btn btn-primary card-title" id="btn_search_monthly" target="_blank"><i class="fa fa-print"></i>&nbsp;&nbsp;{{trans('site_lang.reports_print')}}</a>
                    <div class="col-md-6 col-lg-3 col-sm-6">
                        <div class="form-group">
                            <select id="Month" name="form-field-select-1" class="js-example-basic-single w-100" data-width="100%">
                                <option value="01" selected="selected">1</option>
                                <option value="02">2</option>
                                <option value="03">3</option>
                                <option value="04">4</option>
                                <option value="05">5</option>
                                <option value="06">6</option>
                                <option value="07">7</option>
                                <option value="08">8</option>
                                <option value="09">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-sm-6">
                        <div class="form-group">
                            <select id="year" name="form-field-select-1" class="js-example-basic-single w-100" data-width="100%">
                                <option value="2020" selected="selected">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                                <option value="2031">2031</option>
                                <option value="2032">2032</option>
                                <option value="2033">2033</option>
                                <option value="2034">2034</option>
                                <option value="2035">2035</option>
                                <option value="2036">2036</option>
                                <option value="2037">2037</option>
                                <option value="2038">2038</option>
                                <option value="2039">2039</option>
                                <option value="2040">2040</option>
                            </select>
                        </div>
                        <input id="user_type" type="hidden" value="{{auth()->user()->type}}" />
                        <input id="user_cat" type="hidden" value="{{auth()->user()->cat_id}}" />
                    </div>
                    @php
                    $user_type = auth()->user()->type;
                    if($user_type == 'admin'){
                    @endphp
                    <div class="col-md-6 col-lg-3 col-sm-6">
                        <div class="form-group">
                            <select id="type" class="js-example-basic-single w-100" data-width="100%" name="type">
                                <option value="">
                                    &nbsp;{{trans('site_lang.add_case_to_whom')}}</option>

                                <option value="all" selected="selected">{{trans('site_lang.reports_all')}}</option>
                                @foreach($categories as $category)
                                <option value='{{$category->id}}'>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @php
                    }
                    @endphp
                </div>
                <div class="table-responsive" id="DailyContainer">
                    <table id="MonthlyTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{trans('site_lang.clients_client_type_client')}}</th>
                                <th>{{trans('site_lang.clients_client_type_khesm')}}</th>
                                <th>{{trans('site_lang.home_session_case_number')}}</th>
                                <th>{{trans('site_lang.add_case_circle_num')}}</th>
                                <th>{{trans('site_lang.add_case_inventation_type')}}</th>
                                <th>{{trans('site_lang.add_case_court')}}</th>
                                <th>{{trans('site_lang.home_session_date')}}</th>
                                <th>{{trans('site_lang.mohdar_notes')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('custom-plugin')
<script src="{{url('/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
<script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>

@endsection
@section('custom-scripts')
<script src="{{url('/assets/js/select2.js') }}"></script>
<script src="{{url('/assets/js/datepicker.js') }}"></script>
<script src="{{url('/assets/js/daily_search.js') }}"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>


@endsection