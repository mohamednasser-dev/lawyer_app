@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet"
          href="{{url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.side_mohdar')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary card-title" id="addMohdarModal"><i
                            class="fa fa-plus"></i>{{trans('site_lang.mohdar_add_mohdar')}}</a>
                    <div class="table-responsive">
                        <table id="mohdar_tbl" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.clients_client_type_client')}}</th>
                                <th class="center">{{trans('site_lang.clients_client_type_khesm')}}</th>
                                <th class="center">{{trans('site_lang.mohdar_paper_num')}}</th>
                                <th class="center">{{trans('site_lang.mohdar_court')}}</th>
                                <th class="center">{{trans('site_lang.home_session_date')}}</th>
                                <th class="center">{{trans('site_lang.home_session_status')}}</th>
                                <th class="center"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: PAGE -->
    <div id="add_mohdar_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
         class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>
                <div class="modal-body">
                    <form method="post" id="mohdars" class="cmxform">
                        <fieldset>
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="court_mohdareen">{{trans('site_lang.mohdar_court')}}</label>
                                <input type="text" name="court_mohdareen" class="form-control"
                                       id="court_mohdareen" placeholder="{{trans('site_lang.mohdar_court')}}"
                                       value="{{ old('court_mohdareen') }}">
                                <span class="text-danger" id="court_mohdareen_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="paper_type">{{trans('site_lang.mohdar_paper_type')}}</label>
                                <input name="paper_type" id="paper_type"
                                       placeholder="{{trans('site_lang.mohdar_paper_type')}}"
                                       class="form-control"
                                       value="{{ old('paper_type') }}"/>
                                <span class="text-danger" id="paper_type_error"></span>
                            </div>
                            <label for="deliver_data">{{trans('site_lang.mohdar_paper_deliver')}}</label>
                            <div class="input-group date datepicker" id="datePickerDeliverData">
                                <input type="text" class="form-control" id="deliver_data"
                                       name="deliver_data"
                                       value="{{ old('deliver_data') }}"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                                <span class="text-danger" id="deliver_data_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="paper_Number">{{trans('site_lang.mohdar_paper_num')}}</label>
                                <input name="paper_Number" id="paper_Number"
                                       placeholder="{{trans('site_lang.mohdar_paper_num')}}"
                                       class="form-control"
                                       value="{{ old('paper_Number') }}"/>
                                <span class="text-danger" id="paper_Number_error"></span>
                            </div>
                            <label for="session_Date">{{trans('site_lang.home_session_date')}}</label>
                            <div class="input-group date datepicker" id="datePickerSessionMohderSession">
                                <input type="text" class="form-control" id="session_Date"
                                       name="session_Date"
                                       value="{{ old('deliver_data') }}"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                                <span class="text-danger" id="session_Date_error"></span>
                            </div>
                            <div class="form-group" id="mokel_container">
                                <label for="mokel">{{trans('site_lang.search_case_clients')}}</label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple"
                                        data-width="100%"
                                        id="mokel_Name" name="mokel_Name[]">
                                </select>
                                <span class="text-danger" id="mokel_Name_error"></span>
                            </div>
                            <div class="form-group" id="khesm_container">
                                <label for="Opponent">{{trans('site_lang.search_case_khesms')}}</label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple"
                                        data-width="100%"
                                        id="Opponent" name="khesm_Name[]">

                                </select>
                                <span class="text-danger" id="khesm_Name_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="case_number">{{trans('site_lang.home_session_case_number')}}</label>
                                <input name="case_number" id="case_number"
                                       placeholder="{{trans('site_lang.home_session_case_number')}}"
                                       class="form-control"
                                       value="{{ old('case_number') }}"/>
                                <span class="text-danger" id="case_number_error"></span>
                            </div>

                            <div class="form-group">
                                <label for="notes">{{trans('site_lang.mohdar_notes')}}</label>
                                <input name="notes" id="notes" placeholder="{{trans('site_lang.mohdar_notes')}}"
                                       class="form-control"
                                       value="{{ old('notes') }}"/>
                                <span class="text-danger" id="notes_error"></span>
                            </div>

                            @php
                                $user_type = auth()->user()->type;
                                if($user_type == 'admin'){
                            @endphp

                            <div class="form-group">
                                <select id="form-field-select-3" class="js-example-basic-single w-100"
                                        data-width="100%"
                                        name="cat_id">
                                    <option value="">
                                        &nbsp;{{trans('site_lang.add_case_to_whom')}}</option>
                                    @foreach($categories as $category)
                                        <option
                                            value='{{$category->id}}'>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="To_error"></span>
                            </div>

                            @php
                                }
                            @endphp

                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-outline-danger" type="button">
                                    {{trans('site_lang.public_close_btn_text')}}
                                </button>
                                <input type="submit" class="btn btn-outline-primary" id="add_mohdar" name="add_mohdar"
                                       value="{{trans('site_lang.public_add_btn_text')}}"/>
                            </div>
                        </fieldset>
                    </form>

                </div>

            </div>
            <!-- /.modal-content -->
        </div>


        <!-- /.modal-dialog -->
    </div>
    <div id="show_mohdar_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
         class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                </div>
                <div class="modal-body">

                    <fieldset>

                        <div class="form-group">
                            <label for="court_mohdareen_show">{{trans('site_lang.mohdar_court')}}</label>

                            <input id="court_mohdareen_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="paper_type_show">{{trans('site_lang.mohdar_paper_type')}}</label>
                            <input id="paper_type_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="deliver_data_show">{{trans('site_lang.mohdar_paper_deliver')}}</label>
                            <input id="deliver_data_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="paper_Number_show">{{trans('site_lang.mohdar_paper_num')}}</label>
                            <input id="paper_Number_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="session_Date_show">{{trans('site_lang.home_session_date')}}</label>
                            <input id="session_Date_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="mokel_Name_show">{{trans('site_lang.clients_client_type_client')}}</label>
                            <input id="mokel_Name_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="khesm_Name_show">
                                {{trans('site_lang.clients_client_type_khesm')}}
                            </label>

                            <input id="khesm_Name_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group">
                            <label for="case_number_show">
                                {{trans('site_lang.home_session_case_number')}}
                            </label>
                            <input id="case_number_show"
                                   class="form-control" readonly/>
                        </div>

                        <div class="form-group{{$errors->has('notes')?' has-error':''}}">
                            <label for="notes_show">
                                {{trans('site_lang.mohdar_notes')}}
                            </label>
                            <input id="notes_show"
                                   class="form-control" readonly/>
                        </div>
                    </fieldset>

                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-outline-info-muted" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>


            <!-- /.modal-dialog -->
        </div>
    </div>
    {{--confirm modal--}}
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 align="center" style="margin:0;"> {{trans('site_lang.public_delete_modal_text')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button"
                            class="btn btn-outline-primary">{{trans('site_lang.public_accept_btn_text')}}</button>
                    <button type="button" class="btn btn-outline-danger"
                            data-dismiss="modal">{{trans('site_lang.public_close_btn_text')}}</button>
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
    <script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
    <script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>

@endsection
@section('custom-scripts')

    <script src="{{url('/assets/js/form-mohdr-validation.js') }}"></script>
    <script src="{{url('/assets/js/inputmask.js') }}"></script>
    <script src="{{url('/assets/js/select2.js') }}"></script>
    <script src="{{url('/assets/js/tags-input.js') }}"></script>
    <script src="{{url('assets/js/datepicker.js') }}"></script>
    <script>
        // global app configuration object
        var config = {
            trans: {
                cat_id: "{{trans('usersValidations.to_whome')}}",
                inventation_type: "{{trans('usersValidations.inventation_type')}}",
                session_Date: "{{trans('usersValidations.first_session_date')}}",
                court_mohdareen: "{{trans('usersValidations.court')}}",
                paper_type: "{{trans('usersValidations.paper_type')}}",
                deliver_data: "{{trans('usersValidations.deliver_data')}}",
                paper_Number: "{{trans('usersValidations.paper_Number')}}",
                notes: "{{trans('usersValidations.notes')}}",
                circle_num: "{{trans('usersValidations.circle_num')}}",
                case_number: "{{trans('usersValidations.invetation_num')}}",
                btn_add_text: "{{trans('site_lang.public_add_btn_text')}}",
                add_mohdr_modal_title: "{{trans('site_lang.mohdar_add_mohdar')}}",
                add_public_btn: "{{trans('site_lang.public_add_btn_text')}}",
                edit_public_btn: "{{trans('site_lang.public_edit_btn_text')}}",
                delete_public_btn: "{{trans('site_lang.public_delete_text')}}",
                public_continue_delete_modal_text: "{{trans('site_lang.public_continue_delete_modal_text')}}",
                edit_mohdr_modal_title: "{{trans('site_lang.mohdar_edit_mohdar')}}",
                add_mohdr_route: "{{route('mohdareen.store')}}",
                update_mohdr: "{{ route('mohdareen.update') }}",
                get_mohdareen: "{{ route('mohdareen.index') }}",
                get_mohdareen_clients: "{{route('getClients')}}",

            }
        };

    </script>
    
    <script type="text/javascript" src="{{url('assets/js/mohdareen.js') }}"></script>

@endsection
