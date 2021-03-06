@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{trans('site_lang.side_home')}}
            </h4>
        </div>
    </div>
    @if(auth()->user()->parent_id == null)
        @php
            $expiry_date = auth()->user()->expiry_date;
            $expiry_package = auth()->user()->expiry_package;
            $package_name = auth()->user()->Package->name ;
            if(auth()->user()->warning_date < Carbon\Carbon::now()){
                $warning = 'y';
            }else{
                $warning = 'n';
            }
        @endphp
    @else
        @php
            $parent_user = \App\User::where('id',auth()->user()->parent_id)->first();
            $expiry_date = $parent_user->expiry_date;
            $expiry_package = $parent_user->expiry_package;
            $package_name = $parent_user->Package->name ;
            if($parent_user->warning_date < Carbon\Carbon::now()){
                $warning = 'y';
            }else{
                $warning = 'n';
            }
        @endphp
    @endif
    @if($expiry_package == 'y')
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card card-inverse-danger">
                            <div class="card-body ">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h2 style="font-size: 25px;"
                                        class="card-title mb-0">{{trans('site_lang.alert')}}</h2>
                                    <div class="dropdown mb-2">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-8 col-md-12 col-xl-10">
                                        <div class="d-flex align-items-baseline">
                                            <h3 class="mb-7">{{trans('site_lang.package_ended')}} ( {{$package_name}}
                                                )</h3>
                                        </div>
                                    </div>
                                    <div class="col-4 col-md-12 col-xl-10">
                                        <div class="d-flex align-items-baseline">
                                            <div class="d-flex align-items-baseline">
                                                <p class="text-success">
                                                    {{trans('site_lang.expired_date')}} {{$expiry_date}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @if(auth()->user()->parent_id == null)
                                        <div class="col-4 col-md-12 col-xl-10">
                                            <div class="d-flex align-items-baseline">
                                                <div class="d-flex align-items-baseline">
                                                    <a href="{{route('renew_package')}}" class="btn btn-primary"
                                                       style="color: white;">{{trans('site_lang.renew_package')}} </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    @else
        @if($warning == 'y')
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card card-inverse-warning">
                                <div class="card-body ">
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <h2 style="font-size: 25px;"
                                            class="card-title mb-0">{{trans('site_lang.alert')}}</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-xl-10">
                                            <div class="d-flex align-items-baseline">
                                                <h4 class="mb-7">{{trans('site_lang.package_warning')}} </h4>
                                            </div>
                                            <div class="d-flex align-items-baseline">
                                                <h3 class="mb-7">( {{$package_name}} )</h3>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-12 col-xl-10">
                                            <div class="d-flex align-items-baseline">
                                                <div class="d-flex align-items-baseline">
                                                    <p class="text-success">
                                                        {{trans('site_lang.expired_date')}} {{$expiry_date}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        @if(auth()->user()->parent_id == null)
                                            <div class="col-4 col-md-12 col-xl-10">
                                                <div class="d-flex align-items-baseline">
                                                    <div class="d-flex align-items-baseline">
                                                        <a href="{{route('renew_package')}}" class="btn btn-primary"
                                                           style="color: white;">{{trans('site_lang.renew_package')}} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">{{trans('site_lang.side_users')}}</h6>
                                    <div class="dropdown mb-2">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{$users->count()}}</h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                 style="width:{{$users->count()}}%" aria-valuenow="{{$cases->count()}}"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">{{trans('site_lang.search_case_sessions')}}</h6>
                                    <div class="dropdown mb-2">


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{$sessions->count()}}</h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-danger">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h6 class="card-title mb-0">{{trans('site_lang.side_cases')}}</h6>
                                    <div class="dropdown mb-2">


                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-md-12 col-xl-5">
                                        <h3 class="mb-2">{{$cases->count()}} </h3>
                                        <div class="d-flex align-items-baseline">
                                            <p class="text-success">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-12 col-xl-7">
                                        <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->



        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h6>{{trans('site_lang.home_sessions_coming')}}</h6>
                            <table class="table" id="sample_1">
                                <thead>
                                <tr>
                                    <th scope="col" class="hidden-xs center">#</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_date')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_status')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_month')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_case_number')}}</th>


                                </tr>
                                </thead>
                                <tbody>
                                @foreach($session as $session)
                                    <tr>
                                        <th scope="row" class="hidden-xs center">{{$session->id}}</th>
                                        <td class="hidden-xs center">{{$session->session_date}}</td>
                                        <td class="hidden-xs center">{{$session->status}}</td>
                                        <td class="hidden-xs center">{{$session->month}}</td>
                                        <td class="hidden-xs center">{{$session->cases->invetation_num}}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="sample_2">
                                <h6>{{trans('site_lang.home_session_missing')}}</h6>
                                <thead class="black white-text">
                                <tr>
                                    <th scope="col" class="hidden-xs center">#</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_date')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_status')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_month')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_case_number')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sessionNo as $sessionNo)
                                    <tr>
                                        <th scope="row" class="hidden-xs center">{{$sessionNo->id}}</th>
                                        <td class="hidden-xs center">{{$sessionNo->session_date}}</td>
                                        <td class="hidden-xs center">{{$sessionNo->status}}</td>
                                        <td class="hidden-xs center">{{$sessionNo->month}}</td>
                                        <td class="hidden-xs center">{{$sessionNo->cases->invetation_num}}</td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            {{--{{$sessionNo->paginate()}}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <h6> {{trans('site_lang.side_mohdar')}}</h6>
                            <table class="table" id="sample_3">
                                <thead class="black white-text">
                                <tr>
                                    <th scope="col" class="hidden-xs center">#</th>
                                    <th scope="col" class="hidden-xs center">{{trans('site_lang.mohdar_court')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.mohdar_paper_type')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_date')}}</th>
                                    <th scope="col"
                                        class="hidden-xs center">{{trans('site_lang.home_session_case_number')}}</th>
                                    <th scope="col" class="hidden-xs center">{{trans('site_lang.home_see_more')}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mohder as $mohder)
                                    <tr>
                                        <th scope="row" class="hidden-xs center">{{$mohder->moh_Id}}</th>
                                        <td class="hidden-xs center">{{$mohder->court_mohdareen}}</td>
                                        <td class="hidden-xs center">{{$mohder->paper_type}}</td>
                                        <td class="hidden-xs center">{{$mohder->session_Date}}</td>
                                        <td class="hidden-xs center">{{$mohder->case_number}}</td>
                                        <td class="hidden-xs center">
                                            <a id="showMohdar" class="btn btn-xs btn-blue tooltips" data-placement="top"
                                               data-original-title="{{trans('site_lang.home_see_more')}}"
                                               data-mohid="{{$mohder->moh_Id}}"><i
                                                    class="fa fa-eye-slash"></i>
                                            </a>
                                        {{--                                    <a id="showMohdar" class="btn btn-xs" data-placement="top" data-original-title="show" data-moh-Id="{{$mohder->moh_Id}}"><i class="fa fa-eye"></i></a></td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- modal mohder -->
        <div id="show_mohdar_model" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
             class="modal bs-example-modal-basic fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                            ??
                        </button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>???????????? ??????????</strong>
                                    <div class="well well-sm">
                                        <span id="court_mohdareen_show"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>?????? ????????????</strong>
                                    <div class="well well-sm">
                                        <span id="paper_type_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>?????????? ?????????? ????????????</strong>
                                    <p id="deliver_data">
                                    <div class="well well-sm">
                                        <span id="deliver_data_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>?????? ????????????</strong>
                                    <div class="well well-sm">
                                        <span id="paper_Number_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>?????????? ????????????</strong>
                                    <div class="well well-sm">
                                        <span id="session_Date_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>?????? ????????????</strong>
                                    <div class="well well-sm">
                                        <span id="mokel_Name_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12" id="khesm_container">
                                <div class="form-group">
                                    <strong for="khesm_Name">
                                        ?????? ??????????
                                    </strong>
                                    <div class="well well-sm">
                                        <span id="khesm_Name_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>
                                        ?????? ????????????
                                    </strong>
                                    <div class="well well-sm">
                                        <span id="case_number_show"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group{{$errors->has('notes')?' has-error':''}}">
                                    <strong>
                                        ??????????????????
                                    </strong>
                                    <div class="well well-sm">
                                        <span id="notes_show"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">
                                ??????????
                            </button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>


                <!-- /.modal-dialog -->
            </div>
        </div>

        <!-- modal session note -->
    @endif
@endsection
@section('custom-scripts')

    <script>
        $(document).ready(function () {
            $(document).on('click', '#showMohdar', function () {
                var id = $(this).data('mohid');
                console.log(id);
                $.ajax({
                    url: "mohdareendata/" + id,
                    dataType: "json",
                    success: function (html) {
                        $('#court_mohdareen_show').html(html.data.court_mohdareen);
                        $('#paper_type_show').html(html.data.paper_type);
                        $('#deliver_data_show').html(html.data.deliver_data);
                        $('#session_Date_show').html(html.data.session_Date);
                        $('#case_number_show').html(html.data.case_number);
                        $('#paper_Number_show').html(html.data.paper_Number);
                        $('#mokel_Name_show').html(html.data.mokel_Name);
                        $('#khesm_Name_show').html(html.data.khesm_Name);
                        $('#notes_show').html(html.data.notes);
                        $('.modal-title').text("???????????? ????????????");
                        $('#show_mohdar_model').modal('show');

                    }
                })
            });

        });
    </script>

    <script src="{{url('/assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{url('/assets/js/data-table.js')}}"></script>
@endsection
@section('scriptDocument')
    UIModals.init();
    TableData.init();

@endsection
