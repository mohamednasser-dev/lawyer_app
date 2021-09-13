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
                <form action="{{route('subscribers.search')}}" method="get">

                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-primary" id="addSubscribersModal"><i class="fa fa-plus"></i>{{trans('site_lang.clients_add_new_client_text')}} </a>
                    </div>

                        <div class="form-group{{$errors->has('package_id')?' has-error':''}} col-md-4" style="padding-right: 50px; padding-left: 50px;">
                            <select class="form-control select2-arrow" name="cmb_package_id" id="cmb_package_id">
                                <option value="">
                                    &nbsp;{{trans('site_lang.subPackage')}}</option>
                                @foreach($packages as $package)
                                    @if($package->id == $selected_package)
                                        <option value='{{$package->id}}' selected>{{$package->name}}</option>
                                    @else
                                        <option value='{{$package->id}}'>{{$package->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="text-danger" id="To_error"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-success" id="addSubscribersModal">{{trans('site_lang.search')}} </button>
                        </div>

                </div>
                </form>
                <div class="table-responsive">
                    <table id="subscribers_tbl"  class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.subName')}}</th>
                                <th class="center">{{trans('site_lang.subPackage')}}</th>
                                <th class="center">{{trans('site_lang.subEmail')}}</th>
                                <th class="center">{{trans('site_lang.subPhone')}}</th>

                                <th class="center">{{trans('site_lang.subStatus')}}</th>
                                <th class="center">{{trans('site_lang.EXPIRE_DATE')}}</th>
                                <th class="center">{{trans('site_lang.chooses')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key=> $row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row->name}}</td>
                                <td> @if($row->package_id != null){{$row->Package->name}} @endif</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>

                                <td>
                                    @if ($row->status == trans('site_lang.statusDeactive'))
                                        <a class="btn btn-sm" data-user-id="{{$row->id}}" id="change-user-status" href="{{route('subscribers.updateStatus',['type'=>'active','id'=>$row->id])}}">
                                            <span class="btn btn-danger text-bold"> {{$row->status}}</span></a>
                                    @elseif ($row->status == trans('site_lang.statusDemo'))
                                        <a class="btn btn-sm" data-user-Id="{{$row->id}}" id="change-user-status" href="{{route('subscribers.updateStatus',['type'=>'demo','id'=>$row->id])}}">
                                            <span class="btn btn-warning text-bold">{{$row->status}}</span></a>
                                    @else
                                        <a class="btn btn-sm" data-user-Id="{{$row->id}}" id="change-user-status" href="{{route('subscribers.updateStatus',['type'=>'deactive','id'=>$row->id])}}">
                                            <span class="btn btn-success text-bold">{{$row->status}}</span></a>
                                    @endif
                                </td>
                                <td>{{$row->expiry_date}}</td>
                                <td>
                                    <button data-client-id="{{$row->id}}" id="editClient" class="btn btn-xs btn-outline-success" >
                                        <i class="fa fa-edits"></i>&nbsp;&nbsp; {{trans('site_lang.edit_package')}}</button>
                                    &nbsp;&nbsp;
                                    &nbsp;&nbsp;
                                    <button data-client-id="{{$row->id}}" id="editClientData" class="btn btn-xs btn-outline-primary" >
                                        <i class="fa fa-edits"></i>&nbsp;&nbsp; {{trans('site_lang.edit_client')}}</button>
                                    &nbsp;&nbsp;
                                    &nbsp;&nbsp;
                                    <button data-client-id="{{$row->id}}" id="deleteClient"  class="btn btn-xs btn-outline-danger">
                                        <i class="fa fa-times fa fa-white"></i>&nbsp;&nbsp; {{trans('site_lang.public_delete_text')}} </button>

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

<div id="add_subscriber_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
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
                <form method="post" action="{{route('subscribers.store')}}">
                    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                <input type="text" name="name" class="form-control" id="name" required placeholder="{{trans('site_lang.users_username')}}">
                                <span class="text-danger" id="name_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('email')?' has-error':''}}">
                                <input name="email" id="email" placeholder="{{trans('site_lang.users_email')}}" required class="form-control" />
                                <span class="text-danger" id="email_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('password')?' has-error':''}}">
                                <input type="password" name="password" id="password" class="form-control" required placeholder="{{trans('site_lang.auth_password')}}">
                                <span class="text-danger" id="password_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('phone')?' has-error':''}}">

                                <input type="number" name="phone" id="phone" class="form-control" placeholder="{{trans('site_lang.subPhone')}}">
                                <span class="text-danger" id="phone_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('address')?' has-error':''}}">
                                <input type="text" name="address" id="address" class="form-control" placeholder="{{trans('site_lang.client_Address')}}" rows="10">
                                <span class="text-danger" id="address_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('cat_id')?' has-error':''}}">
                                <select id="form-field-select-3" class="form-control select2-arrow" name="package_id">
                                    <option value="">
                                        &nbsp;{{trans('site_lang.side_Packages')}}</option>
                                    @foreach($packages as $package)
                                    <option value='{{$package->id}}'>{{$package->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="package_id_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('password')?' has-error':''}}">
                                <input type="text" name="cat_name" id="cat_name" class="form-control" required placeholder="{{trans('site_lang.subCatname')}}">
                                <span class="text-danger" id="cat_name_error"></span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group right">
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" class="btn btn-primary" id="add_client" name="add_client" value="{{trans('site_lang.public_add_btn_text')}}" />
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>


    <!-- /.modal-dialog -->
</div>


<div id="edits_subscriber_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
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
                <form method="post" action="{{route('subscribers.edit')}}">
                    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="id">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                <input type="text" name="name" class="form-control" id="edit_name" required placeholder="{{trans('site_lang.users_username')}}">
                                <span class="text-danger" id="name_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('email')?' has-error':''}}">
                                <input name="email" id="edit_email" placeholder="{{trans('site_lang.users_email')}}" required class="form-control" />
                                <span class="text-danger" id="email_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('password')?' has-error':''}}">
                                <input type="password" name="password" id="edit_password" class="form-control"  placeholder="{{trans('site_lang.auth_password')}}">
                                <span class="text-danger" id="password_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('phone')?' has-error':''}}">

                                <input type="number" name="phone" id="edit_phone" class="form-control" placeholder="{{trans('site_lang.subPhone')}}">
                                <span class="text-danger" id="phone_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('address')?' has-error':''}}">
                                <input type="text" name="address" id="edit_address" class="form-control" placeholder="{{trans('site_lang.client_Address')}}" rows="10">
                                <input type="hidden" name="id" id="edit_id" >
                                <span class="text-danger" id="address_error"></span>
                            </div>
                        </div>



                    </div>
                    <div class="form-group right">
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>

                        <input type="submit" class="btn btn-primary" id="add_client" name="add_client" value="{{trans('site_lang.public_edit_btn_text')}}" />
                    </div>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>


    <!-- /.modal-dialog -->
</div>

<div id="edit_subscriber_modal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
{{--                id="edit_subscribe"--}}
                <form method="post"  action="{{route('subscribers.update')}}">
                    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <select id="package_id_dialog" class="form-control select2-arrow" name="package_id">
                                    <option value="">
                                        &nbsp;{{trans('site_lang.side_Packages')}}</option>
                                    @foreach($packages as $package)
                                    <option value='{{$package->id}}'>{{$package->name}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="package_id_error"></span>
                            </div>
                        </div>


                    </div>
                    <div class="form-group right">
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" class="btn btn-primary" id="edit_client" name="edit_client" value="{{trans('site_lang.public_add_btn_text')}}" />
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
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{trans('site_lang.public_accept_btn_text')}}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site_lang.public_close_btn_text')}}</button>
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
    $(document).ready(function() {
        $('#addSubscribersModal').click(function() {
            $('#modal_title').text("{{trans('site_lang.clients_add_new_client_text')}}");
            $('#add_client').val("{{trans('site_lang.public_add_btn_text')}}");
            $('#add_subscriber_model').modal('show');
        });
        $('#subscribers').on('submit', function(event) {
            event.preventDefault();
            if ($('#add_client').val() == "{{trans('site_lang.public_add_btn_text')}}") {
                $.ajax({
                    url: "{{route('subscribers.store')}}",
                    method: 'post',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend: function() {
                        $('#cat_name_error').empty();
                        $('#address_error').empty();
                        $('#phone_error').empty();
                        $('#password_error').empty();
                        $('#email_error').empty();
                        $('#name_error').empty();
                        $('#package_id_error').empty();
                    },
                    success: function(data) {
                        $('#add_subscriber_model').modal('hide');
                        toastr.success(data.success);
                        $("#subscribers").trigger('reset');
                        $('#subscribers_tbl').DataTable().ajax.reload();
                    },
                    error: function(data_error, exception) {
                        if (exception == 'error') {
                            $('#cat_name_error').html(data_error.responseJSON.errors.cat_name);
                            $('#address_error').html(data_error.responseJSON.errors.address);
                            $('#phone_error').html(data_error.responseJSON.errors.phone);
                            $('#password_error').html(data_error.responseJSON.errors.password);
                            $('#email_error').html(data_error.responseJSON.errors.email);
                            $('#name_error').html(data_error.responseJSON.errors.name);
                            $('#package_id_error').html(data_error.responseJSON.errors.package_id);
                        }
                    }
                });
            }


        });
        $('#edit_subscribe').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('subscribers.update') }}",
                method: "post",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    $('#edit_subscriber_modal').modal('hide');
                    toastr.success(data.success);
                    $("#edit_subscribe").trigger('reset');

                    $('#subscribers_tbl').DataTable().ajax.reload();
                },
                error: function(data_error, exception) {
                    if (exception == 'error') {
                        $('#package_id_error').html(data_error.responseJSON.errors.package_id);
                    }
                }
            });

0
        });

        $(document).on('click', '#editClient', function() {
            var id = $(this).data('client-id');
            $.ajax({
                url: "/subscribers/" + id + "/edit",
                dataType: "json",
                success: function(html) {
                    console.log(html.data.id);
                    $('#package_id_dialog').val(html.data.package_id);
                    $('#edit_id').val(html.data.id);
                    $('#modal_title').text("{{trans('site_lang.clients_edit_client_text')}}");
                    $('#edit_client').val("{{trans('site_lang.public_edit_btn_text')}}");
                    $('#edit_subscriber_modal').modal('show');

                }
            })
        });

        $(document).on('click', '#editClientData', function() {
            var id = $(this).data('client-id');
            $.ajax({
                url: "/subscribers/" + id + "/edit",
                dataType: "json",
                success: function(html) {
                    console.log(html.data.id);
                    $('#package_id_dialog').val(html.data.package_id);
                    $('#edit_id').val(html.data.id);
                    $('#edit_name').val(html.data.name);
                    $('#edit_email').val(html.data.email);
                    $('#edit_phone').val(html.data.phone);
                    $('#edit_address').val(html.data.address);

                    $('#modal_title').text("{{trans('site_lang.clients_edit_client_text')}}");
                    $('#edit_clients').val("{{trans('site_lang.public_edit_btn_text')}}");
                    $('#edits_subscriber_model').modal('show');

                }
            })
        });


        var client_id;

        $(document).on('click', '.btn-lg', function() {
            var id = $(this).data('moh-Id');
            $.ajax({
                url: "mohdareen/updateStatus/" + id,
                dataType: "json",
                success: function(html) {
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
        $(document).on('click', '#change-user-status', function() {
            var id = $(this).data('user-id');
            $.ajax({
                url: "subscribers/updateStatus/" + id,
                dataType: "json",
                success: function(html) {
                    $('#subscribers_tbl').DataTable().ajax.reload();
                    if (html.status) {
                        toastr.success(html.msg);
                    } else {
                        toastr.error(html.msg);
                    }
                }
            })
        });

        $(document).on('click', '#deleteClient', function() {
            client_id = $(this).data('client-id');
            $('#confirmModal').modal('show');
        });
        $('#ok_button').click(function() {
            $.ajax({
                url: "subscribers/" + client_id + "/delete",
                beforeSend: function() {
                    $('#ok_button').text("جارى الحذف ...");
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        window.location.reload();
                        // $('#subscribers_tbl').DataTable().ajax.reload();
                    }, 100);
                }
            })
        });
        $(document).ready(function() {
            $(".modal").on("hidden.bs.modal", function() {
                $("#subscribers").trigger('reset');
            });
        });
    });
</script>
@endsection
