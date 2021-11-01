@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
    <link rel="stylesheet" href="{{url('/assets/plugins/dropify/css/dropify.min.css')}}">
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.employers')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-primary" id="addClientModal">
                                <i class="fa fa-plus"></i>{{trans('site_lang.add_new_emp')}} </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="subscribers_tbl"  class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">صورة الموظف</th>
                                <th class="center">اسم الموظف</th>
                                <th class="center">الهاتف</th>
                                <th class="center">البريد الإلكتروني</th>
                                <th class="center">{{trans('site_lang.chooses')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td class="text-lg-center">
                                        <img src="{{ asset('uploads/userprofile/'.$row->image) }}" style="height: 100px;width: 100px;">
                                    </td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td> {{$row->email}}</td>
                                    <td>
                                        <button data-client-id="{{$row->id}}" id="editClient" class="btn btn-xs btn-outline-success" >
                                            <i class="fa fa-edits"></i>&nbsp;&nbsp; {{trans('site_lang.edit')}}</button>
                                        &nbsp;&nbsp;
                                        <button data-point-id="{{$row->id}}" id="deletePoint"  class="btn btn-xs btn-outline-danger">
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

    <div id="add_package_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
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
                    {{ Form::open( ['route' =>'employers.store','method'=>'post', 'files'=>'true'] ) }}
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="package_id" value="1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                <input type="text" name="name" class="form-control" id="name" required
                                       placeholder="{{trans('site_lang.users_username')}}">
                                <span class="text-danger" id="name_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('email')?' has-error':''}}">
                                <input name="email" id="email" placeholder="{{trans('site_lang.users_email')}}"
                                       required class="form-control"/>
                                <span class="text-danger" id="email_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('password')?' has-error':''}}">
                                <input type="password" name="password" id="password" class="form-control" required
                                       placeholder="{{trans('site_lang.auth_password')}}">
                                <span class="text-danger" id="password_error"></span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('phone')?' has-error':''}}">

                                <input type="number" name="phone" id="phone" class="form-control"
                                       placeholder="{{trans('site_lang.subPhone')}}">
                                <span class="text-danger" id="phone_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('address')?' has-error':''}}">
                                <input type="text" name="address" id="address" class="form-control"
                                       placeholder="{{trans('site_lang.client_Address')}}" rows="10">
                                <span class="text-danger" id="address_error"></span>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <label> الصورة الشخصية</label>
                            <div class="form-group{{$errors->has('password')?' has-error':''}}">
                                <input type="file" required name="image" id="myDropify" class="border"/>
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
                    {{ Form::close() }}
                </div>
            </div>
        </div>
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
    <script src="{{url('/assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{url('/assets/js/dropify.js')}}"></script>
    <script>
        var client_id;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {
            $('#package_tbl').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('packages.index') }}",
                },
                columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'center'
                },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'center'
                    }, {
                        data: 'cost',
                        name: 'cost',
                        className: 'center'
                    }, {
                        data: 'duration',
                        name: 'duration',
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
                $('#modal_title').text("{{trans('site_lang.add_new_emp')}}");
                $('#add_client').val("{{trans('site_lang.public_add_btn_text')}}");
                $('#add_package_model').modal('show');
            });
            $('#packages').on('submit', function (event) {
                event.preventDefault();
                console.log($('#add_client').val());
                if ($('#add_client').val() == "{{trans('site_lang.public_add_btn_text')}}") {

                    $.ajax({
                        url: "{{route('points.store')}}",
                        method: 'post',
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#package_Name_error').empty();
                            $('#packae_cost_error').empty();
                            $('#package_duration_error').empty();
                            $('#package_description_error').empty();

                        },
                        success: function (data) {
                            $('#add_package_model').modal('hide');
                            toastr.success(data.success);
                            $("#packages").trigger('reset');
                            $('#package_tbl').DataTable().ajax.reload();
                        },
                        error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#package_Name_error').html(data_error.responseJSON.errors.name);
                                $('#packae_cost_error').html(data_error.responseJSON.errors.cost);
                                $('#package_duration_error').html(data_error.responseJSON.errors.duration);
                                $('#package_description_error').html(data_error.responseJSON.errors.description);

                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: "{{ route('packages.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function () {
                            $('#package_Name_error').empty();
                            $('#packae_cost_error').empty();
                            $('#package_duration_error').empty();
                            $('#package_description_error').empty();
                        },
                        success: function (data) {
                            $('#add_package_model').modal('hide');
                            toastr.success(data.success);
                            $("#packages").trigger('reset');
                            $('#package_tbl').DataTable().ajax.reload();
                        },
                        error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#package_Name_error').html(data_error.responseJSON.errors.name);
                                $('#packae_cost_error').html(data_error.responseJSON.errors.cost);
                                $('#package_duration_error').html(data_error.responseJSON.errors.duration);
                                $('#package_description_error').html(data_error.responseJSON.errors.description);
                            }
                        }
                    });
                }
            });

            $(document).on('click', '#editPackage', function () {
                var id = $(this).data('package-id');

                $.ajax({
                    url: "/packages/" + id + "/edit",
                    dataType: "json",
                    success: function (html) {
                        $('#add_package_model').modal('show');
                        $('#name').val(html.data.name);
                        $('#cost').val(html.data.cost);
                        $('#duration').val(html.data.duration);
                        $('#description').val(html.data.description);
                        $('#id').val(html.data.id);
                        $('#modal_title').text("{{trans('site_lang.package_edit_client_text')}}");
                        $('#add_client').val("{{trans('site_lang.public_edit_btn_text')}}");
                    }
                })
            });


            var point_id;

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


            $(document).on('click', '#deletePoint', function () {
                point_id = $(this).data('point-id');
                $('#confirmModal').modal('show');
            });
            $('#ok_button').click(function () {
                $.ajax({
                    url: "points/destroy/" + point_id,
                    beforeSend: function () {
                        $('#ok_button').text("{{trans('site_lang.public_continue_delete_modal_text')}}");
                    },
                    success: function (data) {
                        setTimeout(function () {
                            $('#confirmModal').modal('hide');
                            window.location.reload();
                        }, 100);
                    }
                })
            });
            $(document).ready(function () {
                $(".modal").on("hidden.bs.modal", function () {
                    $("#packages").trigger('reset');
                });
            });
        });
    </script>
@endsection
