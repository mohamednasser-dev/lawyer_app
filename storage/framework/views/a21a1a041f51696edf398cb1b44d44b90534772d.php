<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row"> 
    <div class="col-sm-5 col-md-4 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <input type="hidden" id='client_id' value='<?php echo e($client_data->id); ?>' />

                    <table class="table ">
                        <thead>
                            <tr>
                                <h4 style="text-align: right"><?php echo e(trans('site_lang.client_info')); ?></h4>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo e(trans('site_lang.Client_name')); ?></td>
                                <td><?php echo e($client_data->client_Name); ?> </td>


                                </td>

                            </tr>
                            <tr>
                                <td><?php echo e(trans('site_lang.client_Unit')); ?></td>
                                <td><?php echo e($client_data->client_Unit); ?> </td>

                            </tr>
                            <tr>
                                <td><?php echo e(trans('site_lang.type')); ?></td>

                                <td><?php echo e($client_data->type); ?> </td>


                            </tr>
                            <tr>
                                <td><?php echo e(trans('site_lang.client_Address')); ?></td>
                                <td> <?php echo e($client_data->client_Address); ?></td>


                            </tr>
                            <tr>
                                <td><?php echo e(trans('site_lang.notes')); ?></td>
                                <td><?php echo e($client_data->notes); ?> </td>

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
                        <h3 class="text-bold"><?php echo e(trans('site_lang.notes')); ?></h3>
                    </div>
                    <?php
                    $user_type = auth()->user()->type;
                    if($user_type == 'admin'){
                    ?>
                    <div class="col-sm-5 col-md-4">
                        <a class="btn btn-primary " id="createnote"><i class="fa
                                                            fa-plus">&nbsp;&nbsp;</i><?php echo e(trans('site_lang.add_notes')); ?>

                        </a>
                    </div>
                </div>
                <br>
                <?php
                }
                ?>
                <div class="table-responsive">
                    <input type="hidden" id='client_id' value='<?php echo e($client_data->id); ?>' />

                    <table id="clientnotes_tbl" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center"><?php echo e(trans('site_lang.notes')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.emp')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.createdAt')); ?></th>
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
                    <input type="hidden" id='client_id' value='<?php echo e($client_data->id); ?>' />
                    <h3 class="text-bold"><?php echo e(trans('site_lang.cases')); ?></h3>

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

<div id="confirmModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title"><?php echo e(trans('site_lang.public_delete_modal_text')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger"><?php echo e(trans('site_lang.public_accept_btn_text')); ?></button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('site_lang.public_close_btn_text')); ?></button>
            </div>
        </div>
    </div>
</div>


<div id="createModal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal_title"><?php echo e(trans('site_lang.add_notes')); ?></h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="client_note" enctype="multipart/form-data">
                    <input type="hidden" id="token" name="_token" value="<?php echo e(csrf_token()); ?>">

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <fieldset>

                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <textarea class="form-control" style="width:100%;" name="notes" id="notes" placeholder="<?php echo e(trans('site_lang.notes')); ?>" value="<?php echo e(old('notes')); ?>" form="client_note"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>


                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="add" name="add" value="<?php echo e(trans('site_lang.public_add_btn_text')); ?>" />
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            <?php echo e(trans('site_lang.public_close_btn_text')); ?>

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
                <h4 class="modal-title" id="modal_title"><?php echo e(trans('site_lang.edit_notes')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="post" id="client_notes" enctype="multipart/form-data">
                    <input type="hidden" id="token" name="_token" value="<?php echo e(csrf_token()); ?>">


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <textarea class="form-control" style="width:100%;" name="notes" id="note" placeholder="<?php echo e(trans('site_lang.notes')); ?>" form="client_notes"></textarea>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" id="edit" name="edit" value="<?php echo e(trans('site_lang.public_edit_btn_text')); ?>" />
                        <button data-dismiss="modal" class="btn btn-default" type="button">
                            <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                        </button>

                    </div>
                </form>



            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-plugin'); ?>
<script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(url('assets/js/clientprofile.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/clients/profile.blade.php ENDPATH**/ ?>