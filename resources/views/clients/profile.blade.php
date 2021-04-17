@extends('welcome')
@section('styles')
<link rel="stylesheet" href="{{url('/assets/vendors/prismjs/themes/prism.css')}}">
@endsection

@section('content')

<div class="row"> 
    <div class="col-sm-5 col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <input type="hidden" id='client_id' value='{{$client_data->id}}' />

                    <table class="table ">
                        <thead>
                            <tr>
                                <h4 style="text-align: right">{{trans('site_lang.client_info')}}</h4>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td>{{trans('site_lang.Client_name')}}</td>
                                <td>{{$client_data->client_Name}} </td>


                                </td>

                            </tr>
                            <tr>
                                <td>{{trans('site_lang.client_Unit')}}</td>
                                <td>{{$client_data->client_Unit}} </td>

                            </tr>
                            <tr>
                                <td>{{trans('site_lang.type')}}</td>

                                <td>{{$client_data->type}} </td>


                            </tr>
                            <tr>
                                <td>{{trans('site_lang.client_Address')}}</td>
                                <td> {{$client_data->client_Address}}</td>


                            </tr>
                            <tr>
                                <td>{{trans('site_lang.notes')}}</td>
                                <td>{{$client_data->notes}} </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7 col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-8">
                        <h3 class="text-bold">{{trans('site_lang.notes')}}</h3>
                    </div>
                    @php
                    $user_type = auth()->user()->type;
                    if($user_type == 'admin'){
                    @endphp
                    <div class="col-sm-5 col-md-4">
                        <a class="btn btn-primary " id="createnote"><i class="fa
                                                            fa-plus">&nbsp;&nbsp;</i>{{trans('site_lang.add_notes')}}
                        </a>
                    </div>
                </div>
                <br>
                @php
                }
                @endphp
                <div class="table-responsive">
                    <input type="hidden" id='client_id' value='{{$client_data->id}}' />

                    <table id="clientnotes_tbl" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">{{trans('site_lang.notes')}}</th>
                                <th class="center">{{trans('site_lang.emp')}}</th>
                                <th class="center">{{trans('site_lang.createdAt')}}</th>
                                <th class="center"></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <div class="col-sm-12 col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <input type="hidden" id='client_id' value='{{$client_data->id}}' />
                    <h3 class="text-bold">{{trans('site_lang.cases')}}</h3>

                    <table id="clientcases_tbl" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="center"> رقم الدعوى</th>
                                <th class="center">نوع الدعوى</th>
                                <th class="center">رقم الدائرة</th>
                                <th class="center">المحكمة</th>
                                <th class="center">تاريخ اول جلسة</th>
                                <th class="center">موجهه الى</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>







</div>
<!-- end: PAGE -->
{{--confirm modal--}}
<div id="confirmModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">{{trans('site_lang.public_delete_modal_text')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{trans('site_lang.public_accept_btn_text')}}</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('site_lang.public_close_btn_text')}}</button>
            </div>
        </div>
    </div>
</div>


<div id="createModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">{{trans('site_lang.add_notes')}}</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="client_note" enctype="multipart/form-data">
                    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <fieldset>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea class="form-control" style="width:100%;" name="notes" id="notes" placeholder="{{trans('site_lang.notes')}}" value="{{ old('notes') }}" form="client_note"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="add" name="add" value="{{trans('site_lang.public_add_btn_text')}}" />
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>



<div id="edit_note_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title">{{trans('site_lang.edit_notes')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="client_notes" enctype="multipart/form-data">
                    <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" style="width:100%;" name="notes" id="note" placeholder="{{trans('site_lang.notes')}}" form="client_notes"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="edit" name="edit" value="{{trans('site_lang.public_edit_btn_text')}}" />
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            {{trans('site_lang.public_close_btn_text')}}
                        </button>

                    </div>
                </form>



            </div>
        </div>
    </div>
</div>


@endsection

@section('custom-plugin')
<script src="{{url('/assets/vendors/prismjs/prism.js')}}"></script>
<script src="{{url('/assets/vendors/clipboard/clipboard.min.js')}}"></script>

<script type="text/javascript" src="{{url('assets/js/clientprofile.js') }}"></script>

@endsection