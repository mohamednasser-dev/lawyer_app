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
                        <h3 class="text-bold">{{trans('site_lang.search_case_attachments')}} 
                                                </div>
                    <div class="col-sm-5 col-md-4">

                    <a href="{{url('attachment/'.$case_id.'/create')}}"
                                   class="btn btn-primary text-bold">{{trans('site_lang.attachments_new_attach')}}</a>
                                            </div>
                </div>
                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover"
                                       id="sample_1">
                                    <thead >
                                    <tr>
                                        <th scope="col" class="hidden-xs center">#</th>

                                        <th scope="col"
                                            class="hidden-xs center">{{trans('site_lang.attachments_file_attach')}}
                                        </th>
                                        <th scope="col"
                                            class="hidden-xs center">{{trans('site_lang.attachments_desc_attach')}}</th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($case_attachment as $case_attachment)
                                        <tr>
                                            <th scope="row" class="hidden-xs center">{{$case_attachment->id}}</th>

                                            <td class="hidden-xs center">
                                                @if(!empty($case_attachment->img_Url))
                                                    @php
                                                        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                                                    @endphp
                                                    @if(! in_array( mime_content_type('uploads/attachments/'.$case_attachment->img_Url), $allowedMimeTypes))
                                                        <a href="{{url('uploads/attachments/'.$case_attachment->img_Url) }}"
                                                           target="_blank"> <img
                                                                src="{{url('uploads/attachments/file.jpg') }}"
                                                                style="width:75px;height:50px;"/>
                                                        </a>
                                                    @else
                                                        <a href="{{url('uploads/attachments/'.$case_attachment->img_Url) }}"
                                                           target="_blank"> <img
                                                                src="{{url('uploads/attachments/'.$case_attachment->img_Url) }}"
                                                                style="width:50px;height:50px;"/>
                                                        </a>
                                                    @endif
                                                @endif

                                            </td>
                                            <td class="hidden-xs center">{{$case_attachment->img_Description}}</td>
                                            <td class="hidden-xs center"><a class='btn btn-raised btn-primary btn-sml'
                                                                            href=" {{url('attachment/'.$case_attachment->id.'/edit')}}"><i
                                                        class="fa fa-edit"></i>{{trans('site_lang.public_edit_btn_text')}}</a>


                                                <form method="get" id='delete-form'
                                                      action="{{url('attachment/'.$case_attachment->id.'/delete')}}"
                                                      style='display: none;'>
                                                {{csrf_field()}}
                                                <!-- {{method_field('delete')}} -->
                                                </form>
                                                <button type="submit" class='btn btn-danger btn-primary btn-sml'
                                                        form="delete-form">

                                                    <i
                                                        class="fa fa-trash"></i>{{trans('site_lang.public_delete_text')}}
                                                </button>

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