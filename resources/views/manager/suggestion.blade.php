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
                        <div class="col-md-6">
                            <a class="btn btn-primary" id="addClientModal">
                                <i class="fa fa-plus"></i>{{trans('site_lang.add_option')}} </a>
                        </div>
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
                                    <td>{{$key+1}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->points_num}}</td>
                                    <td> {{$row->status}}</td>
                                    <td>{{$row->type}}</td>
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
@endsection
@section('custom-plugin')
@endsection
