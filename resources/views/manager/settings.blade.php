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
                <div class="card-body">
                    <h6 class="card-title">{{trans('site_lang.settings')}}</h6>
                    <form class="forms-sample" action="{{route('settings.update',1)}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">{{trans('site_lang.about_us')}}</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="about_us" id="simpleMdeExample" rows="10">{{$data->about_us}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">الخصوصية</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="privacy" id="simpleMdeExample" rows="10">{{$data->privacy}} </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="exampleInputMobile" class="col-sm-3 col-form-label">الشروط والاحكام</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="terms" id="simpleMdeExample" rows="10">{{$data->terms}}
                                </textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-plugin')
@endsection
