
<?php if(Session::has('errors')): ?>
    <div class="alert alert-danger">
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<p><?php echo e($value); ?></p>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- <p><?php echo e(Session('errors')); ?></p> -->
    </div>
<?php endif; ?>




<?php if(session('success')): ?>
                <div class="alert alert-success" role='alert'>
                <?php echo e(session('success')); ?>

                </div>
 <?php endif; ?>
<?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/layouts/errors.blade.php ENDPATH**/ ?>