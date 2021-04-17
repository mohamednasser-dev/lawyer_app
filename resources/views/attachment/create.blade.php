@extends('welcome')
@section('styles')

@endsection

@section('content')
@include('layouts.errors')

<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-8">
                        <h3 class="text-bold">{{trans('site_lang.attachments_new_attach')}}</h3>

                    </div>

                </div>
                {{ Form::open(array('url' =>url('attachment/'.$case_id.'/store') ,'files'=>true )   ) }}
                {!! csrf_field() !!}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {{ Form::label('img_Url',trans('site_lang.attachments_file_attach')) }}
                        {{ Form::file('img_Url', ["class"=>"form-control"]) }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="form-group">
                        {{ Form::label('img_Description',trans('site_lang.attachments_desc_attach')) }}
                        {{ Form::textarea('img_Description',old('img_Description'),["class"=>"form-control"]) }}
                    </div>
                </div>


                {{ Form::submit( trans('site_lang.attachments_new_attach') ,['class'=>'btn btn-primary center-block']) }}

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