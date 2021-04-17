@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.side_categories')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary card-title" id="addCategoryModal"><i
                            class="fa fa-plus"></i>{{trans('site_lang.add_new_category_text')}}</a>
                    <div class="table-responsive">
                        <table id="categories_tbl" class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.clients_client_name')}}</th>
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
    <div id="add_category_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
         class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="modal_title">
                </div>
                <div class="modal-body">
                    <form method="post" id="categories" class="cmxform">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" id="id">
                        <fieldset>

                            <div class="form-group">
                                <label for="name">{{trans('site_lang.category_name')}}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       placeholder="{{trans('site_lang.category_name')}}"
                                       value="{{ old('name') }}">
                                <span class="text-danger" id="category_name_error"></span>
                            </div>
                            <div class="form-group">
                                <button data-dismiss="modal" class="btn btn-outline-danger" type="button">
                                    {{trans('site_lang.public_close_btn_text')}}
                                </button>
                                <input type="submit" class="btn btn-outline-primary" id="add_category"
                                       name="add_category"
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
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p> {{trans('site_lang.public_delete_modal_text')}}</p>
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
    <script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
    <script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>
@endsection
@section('custom-scripts')
    <script src="{{url('/assets/js/form-categories-validation.js') }}"></script>
    <script>
        // global app configuration object
        var config = {
            trans: {
                get_category_route: "{{route('categories.index')}}",
                add_category_route: "{{route('categories.store')}}",
                update_category_route: "{{route('categories.update')}}",

                add_new_category_text: "{{trans('site_lang.add_new_category_text')}}",
                edit_category_text: "{{trans('site_lang.edit_category_text')}}",
                public_continue_delete_modal_text: "{{trans('site_lang.public_continue_delete_modal_text')}}",
                public_delete_modal_text: "{{trans('site_lang.public_delete_modal_text')}}",
                public_delete_text: "{{trans('site_lang.public_delete_text')}}",
                public_add_btn_text: "{{trans('site_lang.public_add_btn_text')}}",
                edit_public: "{{trans('site_lang.public_edit_btn_text')}}",
                search_case_session_modal_title_edit: "{{trans('site_lang.search_case_session_modal_title_edit')}}",
                public_edit_btn_text: "{{trans('site_lang.public_edit_btn_text')}}",
                search_case_add_client: "{{trans('site_lang.search_case_add_client')}}",
                category_name: "{{trans('usersValidations.category_name')}}",
            }
        };

    </script>
    <script type="text/javascript" src="{{url('assets/js/categories.js') }}"></script>
@endsection
