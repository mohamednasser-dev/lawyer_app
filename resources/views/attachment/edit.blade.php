@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')

@include('layouts.errors')

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-8">
                        <h3 class="text-bold">{{trans('site_lang.attachments_edit_attach')}}</h3>
                    </div>

                </div>
                {!! Form::model($attachment, ['url' => ['attachment/'.$attachment->id.'/update'] , 'method'=>'post' ,'files'=> true]) !!}
                {!! csrf_field() !!}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {{ Form::label('img_Description',trans('site_lang.attachments_desc_attach')) }}
                        {{ Form::textarea('img_Description',$attachment->img_Description,["class"=>"form-control"]) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {{ Form::label('img_Url',trans('site_lang.attachments_file_attach')) }}
                        {{ Form::file('img_Url', ["class"=>"form-control"]) }}
                        @php
                        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                        @endphp

                        @if(!empty($attachment->img_Url))
                        
                        @if(! in_array( mime_content_type('uploads/attachments/'.$attachment->img_Url), $allowedMimeTypes))
                        <a href="{{url('uploads/attachments/'.$attachment->img_Url) }}" target="_blank"> <img src="{{url('uploads/attachments/file.jpg') }}" style="width:75px;height:50px;" />
                        </a>
                        @else
                        <a href="{{url('uploads/attachments/'.$attachment->img_Url) }}" target="_blank"> <img src="{{url('uploads/attachments/'.$attachment->img_Url) }}" style="width:50px;height:50px;" />
                        </a>
                        @endif
                        @endif


                    </div>
                </div>
                {{ Form::submit( trans('site_lang.public_edit_btn_text') ,['class'=>'btn btn-primary center-block']) }}
                {{ Form::close() }}
            </div>
        </div>
        <!-- end: TABLE WITH IMAGES PANEL -->
    </div>
</div>

@endsection


@section('custom-plugin')
<script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
<script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>

@endsection
@section('scriptDocument')
TableData.init();
UIModals.init();
FormElements.init();
UIButtons.init();
@endsection