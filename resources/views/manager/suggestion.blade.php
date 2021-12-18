@extends('welcome')
@section('styles')
    <link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.settings')}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="subscribers_tbl"  class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">اسم المستخدم</th>
                                <th class="center">الاسم</th>
                                <th class="center">البريد الإلكتروني</th>
                                <th class="center">الهاتف</th>
                                <th class="center">المقترح</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key=> $row)
                                <tr>
                                    <td>{{$row->User->name}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td> {{$row->phone}}</td>
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
@endsection
