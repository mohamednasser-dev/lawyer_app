<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?> 
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 col-md-8">
                        <h3 class="text-bold"><?php echo e(trans('site_lang.search_case_attachments')); ?> 
                                                </div>
                    <div class="col-sm-5 col-md-4">

                    <a href="<?php echo e(url('attachment/'.$case_id.'/create')); ?>"
                                   class="btn btn-primary text-bold"><?php echo e(trans('site_lang.attachments_new_attach')); ?></a>
                                            </div>
                </div>
                <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover"
                                       id="sample_1">
                                    <thead >
                                    <tr>
                                        <th scope="col" class="hidden-xs center">#</th>

                                        <th scope="col"
                                            class="hidden-xs center"><?php echo e(trans('site_lang.attachments_file_attach')); ?>

                                        </th>
                                        <th scope="col"
                                            class="hidden-xs center"><?php echo e(trans('site_lang.attachments_desc_attach')); ?></th>
                                        <th scope="col">
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $case_attachment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case_attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th scope="row" class="hidden-xs center"><?php echo e($case_attachment->id); ?></th>

                                            <td class="hidden-xs center">
                                                <?php if(!empty($case_attachment->img_Url)): ?>
                                                    <?php
                                                        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
                                                    ?>
                                                    <?php if(! in_array( mime_content_type('uploads/attachments/'.$case_attachment->img_Url), $allowedMimeTypes)): ?>
                                                        <a href="<?php echo e(url('uploads/attachments/'.$case_attachment->img_Url)); ?>"
                                                           target="_blank"> <img
                                                                src="<?php echo e(url('uploads/attachments/file.jpg')); ?>"
                                                                style="width:75px;height:50px;"/>
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(url('uploads/attachments/'.$case_attachment->img_Url)); ?>"
                                                           target="_blank"> <img
                                                                src="<?php echo e(url('uploads/attachments/'.$case_attachment->img_Url)); ?>"
                                                                style="width:50px;height:50px;"/>
                                                        </a>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </td>
                                            <td class="hidden-xs center"><?php echo e($case_attachment->img_Description); ?></td>
                                            <td class="hidden-xs center"><a class='btn btn-raised btn-primary btn-sml'
                                                                            href=" <?php echo e(url('attachment/'.$case_attachment->id.'/edit')); ?>"><i
                                                        class="fa fa-edit"></i><?php echo e(trans('site_lang.public_edit_btn_text')); ?></a>


                                                <form method="get" id='delete-form'
                                                      action="<?php echo e(url('attachment/'.$case_attachment->id.'/delete')); ?>"
                                                      style='display: none;'>
                                                <?php echo e(csrf_field()); ?>

                                                <!-- <?php echo e(method_field('delete')); ?> -->
                                                </form>
                                                <button type="submit" class='btn btn-danger btn-primary btn-sml'
                                                        form="delete-form">

                                                    <i
                                                        class="fa fa-trash"></i><?php echo e(trans('site_lang.public_delete_text')); ?>

                                                </button>

                                            </td>


                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end: PAGE -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-plugin'); ?>
<script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/attachment/index.blade.php ENDPATH**/ ?>