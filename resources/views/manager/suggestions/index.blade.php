@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.side_Packages')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="subscribers_tbl" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center"> المستخدم</th>
                                <th class="center">الاسم</th>
                                <th class="center">البريد الإلكتروني</th>
                                <th class="center">الهاتف</th>
                                <th class="center">الاقتراح</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->user_id}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{$row->phone}}</td>
                                    <td>{{$row->message}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
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
                $('#modal_title').text("{{trans('site_lang.Add_new_package')}}");
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
