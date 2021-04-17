<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/dropzone/dropzone.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/dropify/dist/dropify.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">

    <div class="col-lg-12 grid-margin  stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"></h4>
                <div class="form-group">
                </div>
                <?php echo e(Form::open(array('url' => 'userprofiles', 'method' => 'post', 'files' => true))); ?>


                <?php echo e(csrf_field()); ?>


                <fieldset>
                    <div class="form-group" style="text-align: center;">

                        <h6 class="card-title"></h6>
                        <a href="#" onclick="$('#userimg').trigger('click');">
                            <img width="150" height="150" id='OpenImgUpload' src="<?php echo e(asset('uploads/userprofile/'.Auth::user()->image)); ?>" alt="profile image" class="rounded-circle  center ">
                            <i class="fa fa-camera"></i>
                        </a>
                       

                        <input type="file" id='userimg' name="image" class="border" style="display: none;"/>

                    </div>
                    <?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="form-group">
                        <label for="name"><?php echo e(trans('site_lang.users_username')); ?></label>
                        <input id="name" class="form-control" name="name" value="<?php echo e(Auth::user()->name); ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="email"><?php echo e(trans('site_lang.users_email')); ?></label>
                        <input id="email" class="form-control" name="email" value="<?php echo e(Auth::user()->email); ?>" type="email">
                    </div>
                    <div class="form-group">
                        <label for="phone"><?php echo e(trans('site_lang.phone')); ?></label>
                        <input id="phone" class="form-control" name="phone" value="<?php echo e(Auth::user()->phone); ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="address"><?php echo e(trans('site_lang.address')); ?></label>
                        <input id="address" class="form-control" name="address" value="<?php echo e(Auth::user()->address); ?>" type="text">
                    </div>
                    <div class="form-group">
                        <label for="password"><?php echo e(trans('site_lang.auth_password')); ?></label>
                        <input id="password" class="form-control" name="password" type="password">
                    </div>
                    <div class="form-group">
                        <label for="confirm_password"><?php echo e(trans('site_lang.confirm_password')); ?></label>
                        <input id="confirm_password" class="form-control" name="password_confirmation" type="password">
                    </div>


                    <input class="btn btn-primary btn-block" type="submit" value="<?php echo e(trans('site_lang.edit')); ?>">
                </fieldset>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>


</div>





<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
 
<script src="<?php echo e(url('/assets/vendors/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/select2/select2.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/typeahead.js/typeahead.bundle.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/dropzone/dropzone.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/dropify/dist/dropify.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/bootstrap-colorpicker/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/form-validation.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/bootstrap-maxlength.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/inputmask.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/select2.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/typeahead.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/tags-input.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/dropzone.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/dropify.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptDocument'); ?>
UIModals.init();
TableData.init();

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\my_projects\Lawyer app\resources\views/userprofile/profile.blade.php ENDPATH**/ ?>