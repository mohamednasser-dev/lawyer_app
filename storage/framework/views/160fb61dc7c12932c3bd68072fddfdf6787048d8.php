<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-8">
                        <h3 class="text-bold"><?php echo e(trans('site_lang.attachments_new_attach')); ?></h3>

                    </div>

                </div>
                <?php echo e(Form::open(array('url' =>url('attachment/'.$case_id.'/store') ,'files'=>true )   )); ?>

                <?php echo csrf_field(); ?>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('img_Url',trans('site_lang.attachments_file_attach'))); ?>

                        <?php echo e(Form::file('img_Url', ["class"=>"form-control"])); ?>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 ">
                    <div class="form-group">
                        <?php echo e(Form::label('img_Description',trans('site_lang.attachments_desc_attach'))); ?>

                        <?php echo e(Form::textarea('img_Description',old('img_Description'),["class"=>"form-control"])); ?>

                    </div>
                </div>


                <?php echo e(Form::submit( trans('site_lang.attachments_new_attach') ,['class'=>'btn btn-primary center-block'])); ?>


                <?php echo e(Form::close()); ?>

            </div>
        </div>
        <!-- end: TABLE WITH IMAGES PANEL -->
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-plugin'); ?>
<script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptDocument'); ?>
TableData.init();
UIModals.init();
FormElements.init();
UIButtons.init();
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/attachment/create.blade.php ENDPATH**/ ?>