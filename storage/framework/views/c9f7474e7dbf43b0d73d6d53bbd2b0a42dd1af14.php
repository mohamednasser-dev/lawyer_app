<?php $__env->startComponent('mail::message'); ?>
# Introduction

Your Code is : 
<?php echo e($token); ?>


<?php $__env->startComponent('mail::button', ['url' => '']); ?>
Button Text
<?php echo $__env->renderComponent(); ?>

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/Mail/Messages/resetPassMail.blade.php ENDPATH**/ ?>