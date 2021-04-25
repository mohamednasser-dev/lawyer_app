 <!DOCTYPE html>
 <html lang="en">

 <!-- Mirrored from www.nobleui.com/html/template/demo_1/pages/error/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:10:07 GMT -->

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Lawyer App</title>
     <!-- core:css -->
     <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/core/core.css')); ?>">
     <!-- endinject -->
     <!-- plugin css for this page -->
     <!-- end plugin css for this page -->
     <!-- inject:css -->
     <link rel="stylesheet" href="<?php echo e(url('/assets/fonts/feather-font/css/iconfont.css')); ?>">
     <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
     <!-- endinject -->
     <!-- Layout styles -->
     <link rel="stylesheet" href="<?php echo e(url('/assets/css/demo_1/style.css')); ?>">
     <!-- End layout styles -->
     <link rel="shortcut icon" href="<?php echo e(url('/assets/images/favicon.png')); ?>" />
 </head>

 <body>
     <div class="main-wrapper">
         <div class="page-wrapper full-page">
             <div class="page-content d-flex align-items-center justify-content-center">

                 <div class="row w-100 mx-0 auth-page">
                     <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                         <img src="https://www.nobleui.com/html/template/assets/images/404.svg" class="img-fluid mb-2" alt="404">
                          <?php if(Session::has('errors')): ?>
                             <div class="">
                                 <h4 class="mb-2"><?php echo e(Session('errors')); ?></h4>
                             </div>
                             <?php endif; ?>
                         
                         <h6 class="text-muted mb-3 text-center">
                         </h6>
                         <a href="<?php echo e(url('home')); ?>" class="btn btn-primary">Back to home</a>
                     </div>
                 </div>

             </div>
         </div>
     </div>

     <!-- core:js -->
     <script src="<?php echo e(url('/assets/vendors/core/core.js')); ?>"></script>
     <!-- endinject -->
     <!-- plugin js for this page -->
     <!-- end plugin js for this page -->
     <!-- inject:js -->
     <script src="<?php echo e(url('/assets/vendors/feather-icons/feather.min.js')); ?>"></script>
     <script src="<?php echo e(url('/assets/js/template.js')); ?>"></script>
     <!-- endinject -->
     <!-- custom js for this page -->
     <!-- end custom js for this page -->
 </body>

 <!-- Mirrored from www.nobleui.com/html/template/demo_1/pages/error/404.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:10:07 GMT -->

 </html><?php /**PATH D:\projects\lawyer_app\resources\views/errors/minimal.blade.php ENDPATH**/ ?>