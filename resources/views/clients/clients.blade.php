@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.side_clients')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-primary card-title" id="addClientModal"><i
                            class="fa fa-plus"></i>{{trans('site_lang.clients_add_new_client_text')}}</a>

                    <div class="table-responsive">
                        <table id="client_tbl" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.clients_client_name')}}</th>
                                <th class="center">{{trans('site_lang.clients_client_unit')}}</th>
                                <th class="center">{{trans('site_lang.clients_client_address')}}</th>
                                <th class="center">{{trans('site_lang.clients_client_notes')}}</th>
                                <th class="center">{{trans('site_lang.clients_client_type')}}</th>
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
    <div id="add_client_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
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
                    <form method="post" id="clients" enctype="multipart/form-data" class="cmxform">
                        <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="id" id="id">
                        <fieldset>

                            <div class="form-group">
                                <input type="text" name="client_Name" class="form-control" id="client_Name"
                                       placeholder="{{trans('site_lang.clients_client_name')}}"
                                       value="{{ old('client_Name') }}">
                                <span class="text-danger" id="client_Name_error"></span>
                            </div>

                            <div class="form-group{{$errors->has('client_Unit')?' has-error':''}}">

                                <input name="client_Unit" id="client_Unit"
                                       placeholder="{{trans('site_lang.clients_client_unit')}}"
                                       class="form-control"
                                       value="{{ old('client_Unit') }}"/>
                                <span class="text-danger" id="client_Unit_error"></span>
                            </div>


                            <div class="form-group{{$errors->has('client_Address')?' has-error':''}}">

                                <input type="text" name="client_Address" id="client_Address"
                                       class="form-control"
                                       placeholder="{{trans('site_lang.clients_client_address')}}"
                                       value="{{ old('client_Address') }}">
                                <span class="text-danger" id="client_Address_error"></span>
                            </div>


                            <div class="form-group{{$errors->has('notes')?' has-error':''}}">
                                        <textarea type="text" name="notes" id="notes" class="form-control"
                                                  placeholder="{{trans('site_lang.clients_client_notes')}}"
                                                  value="{{ old('notes') }}" rows="10"></textarea>
                                <span class="text-danger" id="notes_error"></span>
                            </div>


                            <div class="form-group{{$errors->has('notes')?' has-error':''}}">
                                <select type="select" name="type" id="type" class="form-control"

                                        value="{{ old('type') }}">


                                    <option value="" selected
                                            data-default>{{trans('site_lang.clients_client_type')}}
                                    </option>
                                    <option
                                        value="client">{{trans('site_lang.clients_client_type_client')}}</option>
                                    <option
                                        value="khesm">{{trans('site_lang.clients_client_type_khesm')}}</option>


                                </select>
                                <span class="text-danger" id="type_error"></span>
                            </div>

                            @php
                                $user_type = auth()->user()->type;
                                if($user_type == 'admin'){
                            @endphp

                            <div class="form-group{{$errors->has('cat_id')?' has-error':''}}">
                                <select id="form-field-select-3" class="form-control select2-arrow"
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
                        </fieldset>
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
            $('#client_tbl').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('clients.index') }}",
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'center'
                    },
                    {
                        data: 'client_Name',
                        name: 'client_Name',
                        className: 'center'
                    }, {
                        data: 'client_Unit',
                        name: 'client_Unit',
                        className: 'center'
                    }, {
                        data: 'client_Address',
                        name: 'client_Address',
                        className: 'center'
                    }, {
                        data: 'notes',
                        name: 'notes',
                        className: 'center'
                    }, {
                        data: 'type',
                        name: 'type',
                        orderable: false,
                        className: 'center'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        className: 'center'
                    }
                ]
            });

            $('#addClientModal').click(function () {
                $('#modal_title').text("{{trans('site_lang.clients_add_new_client_text')}}");
                $('#add_client').val("{{trans('site_lang.public_add_btn_text')}}");
                $('#add_client_model').modal('show');
            });
            $('#clients').on('submit', function (event) {
                event.preventDefault();
                if ($('#add_client').val() == "{{trans('site_lang.public_add_btn_text')}}") {
                    $.ajax({
                        url: "{{route('clients.store')}}",
                        method: 'post',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#client_Name_error').empty();
                            $('#client_Unit_error').empty();
                            $('#client_Address_error').empty();
                            $('#notes_error').empty();
                            $('#type_error').empty();
                        },
                        success: function (data) {
                            $('#add_client_model').modal('hide');
                            toastr.success(data.success);
                            $("#clients").trigger('reset');
                            $('#client_tbl').DataTable().ajax.reload();
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#client_Name_error').html(data_error.responseJSON.errors.client_Name);
                                $('#client_Unit_error').html(data_error.responseJSON.errors.client_Unit);
                                $('#client_Address_error').html(data_error.responseJSON.errors.client_Address);
                                $('#notes_error').html(data_error.responseJSON.errors.notes);
                                $('#type_error').html(data_error.responseJSON.errors.type);
                                $('#To_error').html(data_error.responseJSON.errors.cat_id);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{ route('clients.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#client_Name_error').empty();
                            $('#client_Unit_error').empty();
                            $('#client_Address_error').empty();
                            $('#notes_error').empty();
                            $('#type_error').empty();
                        }, success: function (data) {
                            $('#add_client_model').modal('hide');
                            toastr.success(data.success);
                            $("#clients").trigger('reset');
                            $('#client_tbl').DataTable().ajax.reload();
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#client_Name_error').html(data_error.responseJSON.errors.client_Name);
                                $('#client_Unit_error').html(data_error.responseJSON.errors.client_Unit);
                                $('#client_Address_error').html(data_error.responseJSON.errors.client_Address);
                                $('#notes_error').html(data_error.responseJSON.errors.notes);
                                $('#type_error').html(data_error.responseJSON.errors.type);
                                $('#To_error').html(data_error.responseJSON.errors.cat_id);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '#editClient', function () {
                var id = $(this).data('client-id');
                $.ajax({
                    url: "/clients/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        $('#client_Name').val(html.data.client_Name);
                        $('#client_Unit').val(html.data.client_Unit);
                        $('#client_Address').val(html.data.client_Address);
                        $('#notes').val(html.data.notes);
                        $("#form-field-select-3").val(html.data.cat_id);
                        if (html.data.type == '{{trans('site_lang.clients_client_type_client')}}') {
                            $('#type').val('client');
                        } else {
                            $('#type').val('khesm');
                        }
                        $('#id').val(html.data.id);
                        $('#modal_title').text("{{trans('site_lang.clients_edit_client_text')}}");
                        $('#add_client').val("{{trans('site_lang.public_edit_btn_text')}}");
                        $('#add_client_model').modal('show');

                    }
                })
            });


            var client_id;

            $(document).on('click', '.btn-lg', function () {
                var id = $(this).data('moh-Id');
                $.ajax({
                    url: "mohdareen/updateStatus/" + id,
                    dataType: "json",
                    success: function (html) {
                        $("#status" + html.result.moh_Id).html(html.result.status);
                        // var status = html.status;
                        if (html.status) {
                            $("#status" + html.result.moh_Id).removeClass("label label-danger");
                            $("#status" + html.result.moh_Id).addClass("label label-success");
                            toastr.success(html.msg);
                        } else {
                            $("#status" + html.result.moh_Id).removeClass("label label-success");
                            $("#status" + html.result.moh_Id).addClass("label label-danger");
                            toastr.error(html.msg);
                        }
                    }
                })
            });


            $(document).on('click', '#deleteClient', function () {
                client_id = $(this).data('client-id');
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function () {
                $.ajax({
                    url: "clients/destroy/" + client_id,
                    beforeSend: function () {
                        $('#ok_button').text('{{trans('site_lang.public_continue_delete_modal_text')}}');
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            $('#client_tbl').DataTable().ajax.reload();
                        }, 100);
                    }
                })
            });
            $(document).ready(function () {
                $(".modal").on("hidden.bs.modal", function () {
                    $("#clients").trigger('reset');
                });
            });
        });

    </script>
@endsection
