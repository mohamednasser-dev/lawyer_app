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
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.search_case_search')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="cases" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الموكل </th>
                                <th>  اسم الخصم</th>
                                <th>رقم الدعوى</th>
                                <th>المحكمة</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
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

    <script src="{{url('/assets/js/form-update-case-validation.js') }}"></script>
    <script src="{{url('/assets/js/inputmask.js') }}"></script>
    <script src="{{url('/assets/js/select2.js') }}"></script>
    <script src="{{url('/assets/js/tags-input.js') }}"></script>
    <script src="{{url('/assets/js/datepicker.js') }}"></script>
    <script>
        // global app configuration object
        var config = {
            routes: {
                get_cases_route: "{{route('caseDetails.index')}}",
                add_session_route: "{{route('caseDetails.store')}}",
                update_session_route: "{{route('caseDetails.update')}}",
                add_note_route: "{{route('notes.store')}}",
                update_note_route: "{{ route('notes.update') }}",
                update_case_data: "{{ route('caseDetails.updateCase') }}",
                add_new_client: "{{ route('caseDetails.addNewClient') }}",
                get_case_details: "{{ route('caseDetails.addNewClient') }}",
            }, trans: {
                select2_place_holder: "{{trans('site_lang.clients_client_type_client_hint')}}",
                select1_place_holder: "{{trans('site_lang.clients_client_type_khesm_hint')}}",
                add_session_btn: "{{trans('site_lang.search_case_case_add_session')}}",
                search_case_session_waiting: "{{trans('site_lang.search_case_session_waiting')}}",
                add_session_modal_title: "{{trans('site_lang.search_case_session_modal_title')}}",
                edit_session_modal_title: "{{trans('site_lang.search_case_session_modal_title_edit')}}",
                public_continue_delete_modal_text: "{{trans('site_lang.public_continue_delete_modal_text')}}",
                public_delete_modal_text: "{{trans('site_lang.public_delete_modal_text')}}",
                public_delete_text: "{{trans('site_lang.public_delete_text')}}",
                search_case_case_add_note: "{{trans('site_lang.search_case_case_add_note')}}",
                public_add_btn_text: "{{trans('site_lang.public_add_btn_text')}}",
                edit_public: "{{trans('site_lang.public_edit_btn_text')}}",
                search_case_session_id_warning_text: "{{trans('site_lang.search_case_session_id_warning_text')}}",
                search_case_session_modal_title_edit: "{{trans('site_lang.search_case_session_modal_title_edit')}}",
                public_edit_btn_text: "{{trans('site_lang.public_edit_btn_text')}}",
                clients_add_new_client_text: "{{trans('site_lang.clients_add_new_client_text')}}",
                clients_add_new_khesm_text: "{{trans('site_lang.clients_add_new_khesm_text')}}",
                search_case_add_client: "{{trans('site_lang.search_case_add_client')}}",
                search_case_add_khesm: "{{trans('site_lang.search_case_add_khesm')}}",
                search_case_case_warning_text: "{{trans('site_lang.search_case_case_warning_text')}}",
                search_case_delete_session_text: "{{trans('site_lang.search_case_delete_session_text')}}",
                court_mohdareen: "{{trans('usersValidations.court')}}",
                circle_num: "{{trans('usersValidations.circle_num')}}",
                case_number: "{{trans('usersValidations.invetation_num')}}",
                inventation_type: "{{trans('usersValidations.inventation_type')}}",

            }
        };

        var casee_id;
        $(document).on('click', '#deletecase', function () {
            casee_id = $(this).data('case-id');

            $('#confirmModala').modal('show');
        });
        $('#okbutton').click(function () {

            $.ajax({
                url: "/caseDetails/delete/" + casee_id,
                success: function (data) {
                    toastr.success(data.msg);
                    setTimeout(function () {
                        $('#confirmModala').modal('hide');
                        $('#cases').DataTable().ajax.reload();
                        location.reload();
                    }, 100);
                }
            })
        });
    </script>
    <script src="{{url('/assets/js/search-cases.js') }}"></script>

@endsection
