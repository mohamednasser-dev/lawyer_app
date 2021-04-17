<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.nobleui.com/html/template/demo_4/dashboard-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:40:34 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$id}}&nbsp; {{trans('site_lang.reports_print_daily_1')}}</title>
    <!-- core:css -->
    <link rel="shortcut icon" href="{{url('/assets/images/favicon.png')}}" />
    <link rel="stylesheet" href="{{url('/assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{url('/assets/css/demo_1/style.css')}}">
    <link rel="stylesheet" href="{{url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">



</head>

@if(session('lang')=='en')

<body class="ltr">
    @else

    <body class="rtl">
        @endif


        <div style="text-align:center;font-size: 30px;background-color: #8E9AA2;color: white; padding-top: 15px; padding-bottom: 15px;">
            <hl class="center">{{trans('site_lang.reports_print_daily_1')}}&nbsp; {{$id}}</hl>
        </div>
        <br>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="table" style="text-align:center" id="DailyContainer">
                <table id="dailyTable" class="table table-bordered " style="width:100%">

                    <thead>
                        <tr>
                            @if(session('lang')=='en')
                            <th style="width: 10%;" >{{trans('site_lang.mohdar_notes')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.home_session_date')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_court')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_inventation_type')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_circle_num')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.home_session_case_number')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.clients_client_type_khesm')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.clients_client_type_client')}}</th>
                            <th style="width: 10%;" >#</th>
                            @else
                            <th style="width: 10%;" >#</th>
                            <th style="width: 10%;" >{{trans('site_lang.clients_client_type_client')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.clients_client_type_khesm')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.home_session_case_number')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_circle_num')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_inventation_type')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.add_case_court')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.home_session_date')}}</th>
                            <th style="width: 10%;" >{{trans('site_lang.mohdar_notes')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        @endphp
                        @if($data->count() > 0)
                        @foreach($data as $row)
                        <tr>
                            @if(session('lang')=='en')
                            @if ($row->Printnotes ==null)
                            <td>----</td>
                            @else
                            <td>{{$row->Printnotes->note}}</td>
                            @endif
                            <td>{{$row->session_date}}</td>
                            <td>{{$row->cases->court}}</td>
                            <td>{{$row->cases->inventation_type}}</td>
                            <td>{{$row->cases->circle_num}}</td>
                            <td>{{$row->cases->invetation_num}}</td>
                            <td>{{$khesm->client_Name}}</td>
                            <td>{{$clients->client_Name}}</td>
                            <td>{{$i}}</td>
                            @else
                            <td>{{$i}}</td>
                            <td>{{$clients->client_Name}}</td>
                            <td>{{$khesm->client_Name}}</td>
                            <td>{{$row->cases->invetation_num}}</td>
                            <td>{{$row->cases->circle_num}}</td>
                            <td>{{$row->cases->inventation_type}}</td>
                            <td>{{$row->cases->court}}</td>
                            <td>{{$row->session_date}}</td>
                            @if ($row->Printnotes ==null)
                            <td>----</td>
                            @else
                            <td>{{$row->Printnotes->note}}</td>
                            @endif
                            @endif
                        </tr>
                        @php
                        $i=$i+1;
                        @endphp
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <script src="{{url('/assets/vendors/core/core.js')}}"></script>
        <script src="{{url('/assets/js/template.js')}}"></script>
        <script src="{{url('/assets/js/data-table.js')}}"></script>

        <script>
            window.print();
        </script>
    </body>

</html>
