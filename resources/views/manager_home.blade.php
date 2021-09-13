@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{url('/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">{{trans('site_lang.side_ControlPanel')}}
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">اجمالى العملاء النشطة</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$users_active_count}}</h3>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">العملاء المنتهي باقتهم</h6>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$users_ended_count}}</h3>
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
                                <h6 class="card-title mb-0">العملاء الساري باقتهم</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$users_current_count}}</h3>
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
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">عدد العملاء بالنسبة للباقات</h6>
                    <canvas id="chartjsBar"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">إحصائيات تسجيل الحساب</h6>
                    <canvas id="chartjsArea"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script src="{{url('/assets/plugins/chartjs/Chart.min.js')}}"></script>
    <script src="{{url('/assets/js/chartjs.js')}}"></script>
    <script>
        $(function () {
            'use strict';
            if ($('#chartjsArea').length) {
                new Chart($('#chartjsArea'), {
                    type: 'line',
                    data: {
                        labels: ['Jun','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'nov', 'des'] ,
                        datasets: [{
                            data: {!! $users_month_count !!},
                            label: "عدد العملاء",
                            borderColor: "#7ee5e5",
                            backgroundColor: "#c2fdfd",
                            fill: true
                        }
                        ]
                    }
                });
            }

            // Bar chart
            if ($('#chartjsBar').length) {
                new Chart($("#chartjsBar"), {
                    type: 'bar',
                    data: {
                        labels: {!! $packages !!},
                        datasets: [
                            {
                                label: "Population",
                                backgroundColor: ["#b1cfec", "#7ee5e5", "#66d1d1", "#f77eb9", "#4d8af0", "#66d1d1", "#f77eb9", "#4d8af0"],
                                data: {!! $package_users_count !!}
                            }
                        ]
                    },
                    options: {
                        legend: {display: false},
                    }
                });
            }
        });
    </script>
@endsection

