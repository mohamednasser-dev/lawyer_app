<!-- start: HEAD -->
<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- end: HEAD -->
<!-- partial:partials/_sidebar.html -->
<?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- partial -->

<div class="page-wrapper">

    <!-- partial:partials/_navbar.html -->
<?php echo $__env->make('layouts.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- partial -->

    <div class="page-content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <!-- partial:partials/_footer.html -->

    <!-- partial -->
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/welcome.blade.php ENDPATH**/ ?>