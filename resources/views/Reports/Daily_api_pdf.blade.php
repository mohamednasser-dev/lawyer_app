<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <style>
     @page { size: 500pt 500pt; }
     </style> -->
    <!-- <meta charset="utf-8"> -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Report</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css2?family=Cairo' rel='stylesheet'>


</head>

<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div style="text-align:center;font-size: 30px;background-color: #8E9AA2;color: white;">
                <hl class="center">{{trans('site_lang.reports_print_daily_1')}}&nbsp; {{$id}}</hl>
            </div>
            <br>
            <table class="table table-striped table-bordered table-hover table-full-width"
                   id="PrintdailyTable">
                <thead>
                <tr>
                    <th>{{trans('site_lang.mohdar_notes')}}</th>
                    <th>{{trans('site_lang.home_session_date')}}</th>
                    <th>{{trans('site_lang.add_case_court')}}</th>
                    <th>{{trans('site_lang.add_case_inventation_type')}}</th>
                    <th>{{trans('site_lang.add_case_circle_num')}}</th>
                    <th>{{trans('site_lang.home_session_case_number')}}</th>
                    <th>{{trans('site_lang.clients_client_type_khesm')}}</th>
                    <th>{{trans('site_lang.clients_client_type_client')}}</th>
                    <th>#</th>
                </tr>
                </thead>

                <tbody>

                {{--                @foreach($data as $caseSession)--}}
                @php
                    $i=1;
                @endphp

                @foreach($data as $key=> $row)
                    <tr>
                        @if ($row->printnotes ==null)
                            <td>----</td>
                        @else
                            <td>{{$row->printnotes->note}}</td>
                        @endif
                        <td>{{$row->session_date}}</td>
                        <td>{{$row->cases->court}}</td>
                        <td>{{$row->cases->inventation_type}}</td>
                        <td>{{$row->cases->circle_num}}</td>
                        <td>{{$row->cases->invetation_num}}</td>
                        <td>{{$row->khesm}}</td>
                        <td>{{$row->client}}</td>
                        <td>{{$i}}</td>
                    </tr>
                    @php
                        $i=$i+1;
                    @endphp
                @endforeach


                </tbody>
            </table>


        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>
