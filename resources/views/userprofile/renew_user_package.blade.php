@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection
@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">{{trans('site_lang.side_home')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page"> {{trans('site_lang.renew_package')}}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-title">
                <h4>
                    {{trans('site_lang.current_packages')}}
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="subscribers_tbl"  class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.packae_name')}}</th>
                                <th class="center">{{trans('site_lang.package_cost')}}</th>
                                <th class="center">{{trans('site_lang.package_duration')}}</th>
                                <th class="center">{{trans('site_lang.chooses')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key=> $row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->cost}}</td>
                                <td>{{$row->duration}} {{trans('site_lang.month')}}</td>
                                <td>
                                    @if (auth()->user()->package_id == $row->id)
                                        <a class="btn btn-sm" data-user-Id="{{$row->id}}" id="change-user-status" href="{{route('subscribers.updateStatus',['type'=>'demo','id'=>$row->id])}}">
                                            <span class="btn btn-warning text-bold">{{trans('site_lang.renew_package')}}</span></a>
                                    @else
                                        <a class="btn btn-sm" data-user-Id="{{$row->id}}" id="change-user-status" href="{{route('subscribers.updateStatus',['type'=>'deactive','id'=>$row->id])}}">
                                            <span class="btn btn-success text-bold">{{trans('site_lang.subscribe')}}</span></a>
                                    @endif
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

@endsection

@section('custom-plugin')
<script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
<script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>
@endsection
