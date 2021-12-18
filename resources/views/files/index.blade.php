@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> الملفات</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-primary" id="addSubscribersModal"><i
                                    class="fa fa-plus"></i>اضافة ملفات جديدة </a>
                        </div>


                    </div>

                    <div class="table-responsive">
                        <table id="subscribers_tbl" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">الاسم</th>
                                <th class="center">النوع</th>
                                <th class="center">الملف</th>
                                <th class="center">{{trans('site_lang.chooses')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->type}}</td>
                                    <td><a href="{{url($row->file)}}" target="_blank"><img
                                                src="{{url('uploads/attachments/file.jpg') }}"
                                                style="width:75px;height:50px;"/></a>
                                    </td>
                                    <td>
                                        <button data-client-id="{{$row->id}}" id="deleteClient"
                                                class="btn btn-xs btn-outline-danger">
                                            <i class="fa fa-times fa fa-white"></i>&nbsp;&nbsp; {{trans('site_lang.public_delete_text')}}
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: PAGE -->

    <div id="add_subscriber_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
         class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal_title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{--                id="subscribers"--}}
                    <form method="post" action="{{route('files.store')}}" enctype="multipart/form-data">
                        <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                    <input type="text" name="type" class="form-control" id="type" required
                                           placeholder="النوع">
                                    <span class="text-danger" id="type_error"></span>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <label for="">يمكنك اضافه اكثر من ملف</label>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                    <input type="file" name="file[]" class="form-control" id="file" required
                                           placeholder="الملفات" multiple>
                                    <span class="text-danger" id="file_error"></span>
                                </div>
                            </div>


                        </div>
                        <div class="form-group right">
                            <button data-dismiss="modal" class="btn btn-default" type="button">
                                {{trans('site_lang.public_close_btn_text')}}
                            </button>
                            <input type="hidden" name="hidden_id" id="hidden_id"/>
                            <input type="submit" class="btn btn-primary" id="add_client" name="add_client"
                                   value="{{trans('site_lang.public_add_btn_text')}}"/>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>


        <!-- /.modal-dialog -->
    </div>




    {{--confirm modal--}}
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <h4 align="center" style="margin:0;">{{trans('site_lang.public_delete_modal_text')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button"
                            class="btn btn-danger">{{trans('site_lang.public_accept_btn_text')}}</button>
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">{{trans('site_lang.public_close_btn_text')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-plugin')
    <script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
    <script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>
    <script>
        var client_id;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#addSubscribersModal').click(function () {
                $('#modal_title').text("اضافة ملفات");
                $('#add_client').val("{{trans('site_lang.public_add_btn_text')}}");
                $('#add_subscriber_model').modal('show');
            });
            $('#subscribers').on('submit', function (event) {
                event.preventDefault();
                if ($('#add_client').val() == "{{trans('site_lang.public_add_btn_text')}}") {
                    $.ajax({
                        url: "{{route('files.store')}}",
                        method: 'post',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#cat_name_error').empty();
                            $('#address_error').empty();
                            $('#phone_error').empty();
                            $('#password_error').empty();
                            $('#email_error').empty();
                            $('#name_error').empty();
                            $('#package_id_error').empty();
                        },
                        success: function (data) {
                            $('#add_subscriber_model').modal('hide');
                            toastr.success(data.success);
                            $("#subscribers").trigger('reset');
                            $('#subscribers_tbl').DataTable().ajax.reload();
                        },
                        error: function (data_error, exception) {
                            if (exception == 'error') {

                                $('#name_error').html(data_error.responseJSON.errors.name);
                                $('#file_error').html(data_error.responseJSON.errors.file);

                            }
                        }
                    });
                }


            });
            $('#edit_subscribe').on('submit', function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('subscribers.update') }}",
                    method: "post",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        $('#edit_subscriber_modal').modal('hide');
                        toastr.success(data.success);
                        $("#edit_subscribe").trigger('reset');

                        $('#subscribers_tbl').DataTable().ajax.reload();
                    },
                    error: function (data_error, exception) {
                        if (exception == 'error') {
                            $('#package_id_error').html(data_error.responseJSON.errors.package_id);
                        }
                    }
                });

                0
            });

            $(document).on('click', '#editClient', function () {
                var id = $(this).data('client-id');
                $.ajax({
                    url: "/subscribers/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        console.log(html.data.id);
                        $('#package_id_dialog').val(html.data.package_id);
                        $('#edit_id').val(html.data.id);
                        $('#modal_title').text("{{trans('site_lang.clients_edit_client_text')}}");
                        $('#edit_client').val("{{trans('site_lang.public_edit_btn_text')}}");
                        $('#edit_subscriber_modal').modal('show');

                    }
                })
            });

            $(document).on('click', '#editClientData', function () {
                var id = $(this).data('client-id');
                $.ajax({
                    url: "/subscribers/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        console.log(html.data);
                        $('#package_id_dialog').val(html.data.package_id);
                        $('#edit_id').val(html.data.id);
                        $('#edit_name').val(html.data.name);
                        $('#edit_email').val(html.data.email);
                        $('#edit_phone').val(html.data.phone);
                        $('#edit_address').val(html.data.address);
                        $('#card_image').attr("src", "{{url('uploads/register/')}}" + "/" + html.data.card_image);
                        $('#card_link').attr("href", "{{url('uploads/register/')}}" + "/" + html.data.card_image);
                        $('#modal_title').text("{{trans('site_lang.clients_edit_client_text')}}");
                        $('#edit_clients').val("{{trans('site_lang.public_edit_btn_text')}}");
                        $('#edits_subscriber_model').modal('show');

                    }
                })
            });


            var client_id;



            $(document).on('click', '#deleteClient', function () {
                client_id = $(this).data('client-id');
                console.log(client_id);
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function () {
                $.ajax({
                    url: "/files/" + client_id + "/delete",
                    beforeSend: function () {
                        $('#ok_button').text("جارى الحذف ...");
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            window.location.reload();
                            // $('#subscribers_tbl').DataTable().ajax.reload();
                        }, 100);
                    }
                })
            });
            $(document).ready(function () {
                $(".modal").on("hidden.bs.modal", function () {
                    $("#subscribers").trigger('reset');
                });
            });
        });
    </script>
@endsection
