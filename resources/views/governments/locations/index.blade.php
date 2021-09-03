@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')
    <?php
    $lat = '30.044352632821397';
    $lng = '31.223632812499993';
    ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.addresses_2')}}</li>
            <li class="breadcrumb-item active" aria-current="page"> {{$gov_data->name}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-primary" id="addClientModal">
                                <i class="fa fa-plus"></i>{{trans('site_lang.add_location')}} </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="subscribers_tbl"  class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.name')}}</th>
                                <th class="center">{{trans('site_lang.address')}}</th>
                                <th class="center">{{trans('site_lang.type')}}</th>
                                <th class="center">{{trans('site_lang.status')}}</th>
                                <th class="center">{{trans('site_lang.chooses')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=> $row)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->address}}</td>
                                    <td>{{$row->type}}</td>
                                    <td>
                                        @if($row->status == 'show')
                                        <a href="{{route('locations.change_status',$row->id)}}"  class="btn btn-xs btn-outline-success">
                                            <i class="fa fa-times fa fa-white"></i>&nbsp;&nbsp; {{trans('site_lang.show')}} </a>
                                        @else
                                            <a href="{{route('locations.change_status',$row->id)}}"  class="btn btn-xs btn-outline-danger">
                                                <i class="fa fa-times fa fa-white"></i>&nbsp;&nbsp; {{trans('site_lang.hidden')}} </a>
                                        @endif
                                    </td>
                                    <td>
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
                    <form method="post" action="{{route('locations.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group{{$errors->has('name')?' has-error':''}}">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="{{trans('site_lang.address_name')}}"
                                           value="{{ old('name') }}">
                                    <span class="text-danger" id="package_Name_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group{{$errors->has('address')?' has-error':''}}">
                                    <input type="text" name="address" class="form-control" id="address"
                                           placeholder="{{trans('site_lang.address')}}"
                                           value="{{ old('address') }}">
                                    <span class="text-danger" id="package_Name_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group{{$errors->has('type')?' has-error':''}}">
                                <select id="form-field-select-3" class="form-control select2-arrow" name="type">
                                    <option value='Court'>{{trans('site_lang.Court')}}</option>
                                    <option value='Police_station'>{{trans('site_lang.Police_station')}}</option>
                                    <option value='Real_estate_month'>{{trans('site_lang.real_estate_month')}}</option>
                                </select>
                                <span class="text-danger" id="package_id_error"></span>
                            </div>
                        </div>
                        <label>{{ __('site_lang.choose_address_on_map') }}</label>
                        <div class="form-group row">
                            <div class="card-body parent" style='text-align:right' id="parent">
                                <div id="" class="form-group row">
                                    <div class="col-sm-12 ">
                                        <div id="us1" style="width:100%;height:400px;"></div>
                                    </div>
                                    <input required type="hidden" name="government_id" id="government_id" value="{{$gov_data->id}}">
                                    <input required type="hidden" name="lat" id="lat" value="{{$lat}}">
                                    <input required type="hidden" name="long" id="lng" value="{{$lng}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group right">
                            <button type="submit" class="btn btn-primary" >
                                {{trans('site_lang.public_add_btn_text')}}
                            </button>
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
                $('#modal_title').text("{{trans('site_lang.add_location')}}");
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
                    url: "destroy/" + point_id,
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
    <script>
        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng({{$lat}},{{$lng}}),
                zoom: 5,
            };
            var map = new google.maps.Map(document.getElementById("us1"), mapProp);
        }
    </script>
    <script
        src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDPN_XufKy-QTSCB68xFJlqtUjHQ8m6uUY&callback=myMap"></script>
    <script src="{{url('/')}}/js/locationpicker.jquery.js"></script>
    <script>
        $('#us1').locationpicker({
            location: {
                latitude: {{$lat}},
                longitude: {{$lng}}
            },
            radius: 300,
            markerIcon: "{{url('/images/map-marker.png')}}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng')
            }
        });
    </script>
@endsection
