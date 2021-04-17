
<?php $__env->startSection('styles'); ?>
<link href="<?php echo e(url('/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css')); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo e(url('/plugins/bootstrap-modal/css/bootstrap-modal.css')); ?>" rel="stylesheet" type="text/css" />

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">


    <div class="col-sm-12 col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">


                <?php echo Form::model($permission, ['route' => ['permission.update',$permission->id] , 'method'=>'put' ,'files'=> true]); ?>

                <?php echo e(csrf_field()); ?>



                <div class="form-group">
                    <strong><?php echo e(trans('site_lang.empName')); ?></strong>
                    <span><i> <?php echo e(Form::label('user_id',$permission->getUser->name,
                                                $permission->getUser->name
                                            ,["class"=>"form-control " ])); ?>

                            <i> </span>
                </div>


                <div class="form-group">


                    <div class="table-responsive">
                        <table class="table mb-5">
                            <tbody>
                                <tr>
                                    <th><?php echo e(trans('site_lang.users')); ?></th>
                                    <td>


                                        <label class="switch">
                                            <input type="hidden" name="users" id='users' value="no">
                                            <?php echo e(Form::checkbox('users', 'yes',  $permission->users=="yes"?true:false)); ?>


                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                </tr>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.clients')); ?></th>
                                        <td>


                                            <label class="switch">

                                                <input type="hidden" name="clients" id='clients' value="no">
                                                <?php echo e(Form::checkbox('clients', 'yes',  $permission->clients=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                </div>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.addcases')); ?></th>
                                        <td>

                                            <label class="switch">
                                                <input type="hidden" name="addcases" id='addcases' value="no">
                                                <?php echo e(Form::checkbox('addcases', 'yes',  $permission->addcases=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                    </tr>
                                </div>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.search_case')); ?></th>
                                        <td>
                                            <label class="switch">

                                                <input type="hidden" name="search_case" id='search_case' value="no">
                                                <?php echo e(Form::checkbox('search_case', 'yes',  $permission->search_case=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                </div>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.mohdreen')); ?></th>
                                        <td>
                                            <label class="switch">

                                                <input type="hidden" name="mohdreen" id='mohdreen' value="no">
                                                <?php echo e(Form::checkbox('mohdreen', 'yes',  $permission->mohdreen=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                </div>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.category')); ?></th>
                                        <td>
                                            <label class="switch">

                                                <input type="hidden" name="category" id='category' value="no">
                                                <?php echo e(Form::checkbox('category', 'yes',  $permission->category=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                </div>

                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.daily_report')); ?></th>
                                        <td>
                                            <label class="switch">

                                                <input type="hidden" name="daily_report" id='daily_report' value="no">
                                                <?php echo e(Form::checkbox('daily_report', 'yes',  $permission->daily_report=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                </div>


                                <div class="form-group">
                                    <tr>
                                        <th><?php echo e(trans('site_lang.monthly_report')); ?></th>
                                        <td>
                                            <label class="switch">

                                                <input type="hidden" name="monthly_report" id='monthly_report' value="no">
                                                <?php echo e(Form::checkbox('monthly_report', 'yes',  $permission->monthly_report=="yes"?true:false)); ?>

                                                <span class="slider round"></span>
                                            </label>

                                        </td>
                                    </tr>
                                </div>
                            </tbody>
                        </table>

                    </div>
  <!-- end test -->
  <div class="form-group">

<?php echo e(Form::submit( trans('site_lang.edit') ,['class'=>'btn btn-success btn-block'])); ?>

</div>
                </div>
            </div>


            <!-- test -->


            <!-- Rounded switch -->


          
            <?php echo e(Form::close()); ?>

        </div>


    </div>

    <!-- end: PAGE -->


</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(url('/plugins/toastr/toastr.js')); ?>"></script>
<script src="<?php echo e(url('/plugins/bootstrap-modal/js/bootstrap-modal.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/plugins/bootstrap-modal/js/bootstrap-modalmanager.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('/js/ui-modals.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptDocument'); ?>
UIModals.init();
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dgmevmh7hnpa/public_html/tes/resources/views/permission/permission.blade.php ENDPATH**/ ?>