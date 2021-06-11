<!DOCTYPE html> 

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
	<link rel="stylesheet" href="<?php echo e(url('/assets/css/demo_2/style.css')); ?>">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?php echo e(url('/assets/images/favicon.png')); ?>" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


</head>
<!-- end: HEAD -->
<!-- start: BODY -->

<body>





    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 ">
                    <div class="col-md-8 col-xl-4 mx-auto">
                        <div class="card">
                            <div class="row">
                                <!-- <div class="col-md-4 pr-md-0">
                                    <div class="auth-left-wrapper">

                                    </div>
                                </div> -->
                                <div class="col-md-12 pl-md-0 rtl">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">Lawyer<span>App</span></a>
                                        <h5 class="text-muted font-weight-normal mb-4"><?php echo e(trans('site_lang.auth_cont_title')); ?></h5>
                                        <form class="form-login" action="<?php echo e(route('login')); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                           
                                            <div class="form-group">
                                                <!-- <label for="exampleInputEmail1">Email address</label> -->
                                                <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" value="<?php echo e(old('email')); ?>" name="email" placeholder="<?php echo e(trans('site_lang.users_email')); ?>">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                                <?php if($errors->has('email')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                                    <br>
                                                <div class="form-group">
                                                    <!-- <label for="exampleInputPassword1">Password</label> -->
                                                    <input type="password" class="form-control text-bold" name="password" placeholder="<?php echo e(trans('site_lang.auth_password')); ?>">
                                                    <i class="fa fa-lock"></i>

                                                    </span>
                                                    <?php if($errors->has('password')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                             
                                            <div class="mt-3">

                                                <button type="submit" class="btn btn-primary btn-block">
                                                    <?php echo e(trans('site_lang.auth_login_text')); ?> <i class="fa fa-arrow-circle-left"></i>
                                                </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        jQuery(document).ready(function() {
            Main.init();
            Login.init();
        });
    </script>

</body>

</html><?php /**PATH D:\projects\lawyer_app\resources\views/auth/login.blade.php ENDPATH**/ ?>