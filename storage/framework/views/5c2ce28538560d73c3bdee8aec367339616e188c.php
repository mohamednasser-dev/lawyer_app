<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('site_lang.side_home')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo e(trans('site_lang.add_case_header')); ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                     <h6 class="card-title"><?php echo e(trans('site_lang.add_case_title')); ?></h6>
                     <form class="cmxform" method="post" id="new_case">
                        <fieldset>
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="mokel"><?php echo e(trans('site_lang.search_case_clients')); ?></label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple" data-width="100%"
                                        id="mokel" name="mokel_name[]" required>
                                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value='<?php echo e($client->id); ?>'><?php echo e($client->client_Name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="mokel_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="Opponent"><?php echo e(trans('site_lang.search_case_khesms')); ?></label>
                                <select class="js-example-basic-multiple w-100" multiple="multiple" data-width="100%"
                                        id="Opponent" name="khesm_name[]" required>
                                    <?php $__currentLoopData = $khesm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $khesm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value='<?php echo e($khesm->id); ?>'><?php echo e($khesm->client_Name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="khesm_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="invetation_num"><?php echo e(trans('site_lang.home_session_case_number')); ?></label>
                                <input type="text" name="invetation_num" class="form-control"
                                       id="invetation_num"
                                       placeholder="<?php echo e(trans('site_lang.home_session_case_number')); ?>"
                                       value="<?php echo e(old('case_Number')); ?>">
                                <span class="text-danger" id="case_Number_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="circle_num"><?php echo e(trans('site_lang.add_case_circle_num')); ?></label>
                                <input type="text" name="circle_num" class="form-control"
                                       id="circle_num"
                                       placeholder="<?php echo e(trans('site_lang.add_case_circle_num')); ?>"
                                       value="<?php echo e(old('circle_num')); ?>">
                                <span class="text-danger" id="circle_Number_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="court"><?php echo e(trans('site_lang.add_case_court')); ?></label>
                                <input type="text" name="court" class="form-control"
                                       id="court"
                                       placeholder="<?php echo e(trans('site_lang.add_case_court')); ?>"
                                       value="<?php echo e(old('court')); ?>">
                                <span class="text-danger" id="court_Name_error"></span>
                            </div>
                            <label for="first_session_date"><?php echo e(trans('site_lang.home_session_date')); ?></label>
                            <div class="input-group date datepicker" id="datePickerSession">
                                <input type="text" class="form-control" id="first_session_date"
                                       name="first_session_date"
                                       value="<?php echo e(old('first_session_date')); ?>"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                                <span class="text-danger" id="first_date_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="inventation_type"><?php echo e(trans('site_lang.add_case_inventation_type')); ?></label>
                                <input type="text" name="inventation_type" id="inventation_type"
                                       class="form-control"
                                       placeholder="<?php echo e(trans('site_lang.add_case_inventation_type')); ?>"
                                       value="<?php echo e(old('inventation_type')); ?>">
                                <span class="text-danger" id="lawsuit_error"></span>
                            </div>
                            <?php
                                $user_type = auth()->user()->type;
                                if($user_type == 'admin'){
                            ?>
                            <div class="form-group">
                                <label for="form-field-select-3"><?php echo e(trans('site_lang.add_case_to_whom')); ?></label>
                                <select id="form-field-select-3" name="to_whome" class="js-example-basic-single w-100"
                                        data-width="100%">
                                    <option value="">
                                        &nbsp;<?php echo e(trans('site_lang.add_case_to_whom')); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="lawsuit_error"></span>
                            </div>
                            <?php
                                }
                            ?>
                            <input class="btn btn-primary btn-block" type="submit" id="add_case" name="add_case"
                                   value="<?php echo e(trans('site_lang.add_case_title')); ?>">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-plugin'); ?>
    <script src="<?php echo e(url('/assets/vendors/jquery-validation/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/inputmask/jquery.inputmask.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/select2/select2.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

    <script src="<?php echo e(url('/assets/js/form-validation.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/inputmask.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/select2.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/tags-input.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/datepicker.js')); ?>"></script>
    <script>
        // global app configuration object
        var config = {
            trans: {
                to_whome: "<?php echo e(trans('usersValidations.to_whome')); ?>",
                inventation_type: "<?php echo e(trans('usersValidations.inventation_type')); ?>",
                first_session_date: "<?php echo e(trans('usersValidations.first_session_date')); ?>",
                court: "<?php echo e(trans('usersValidations.court')); ?>",
                circle_num: "<?php echo e(trans('usersValidations.circle_num')); ?>",
                invetation_num: "<?php echo e(trans('usersValidations.invetation_num')); ?>",
                add_case_route: "<?php echo e(route('cases.store')); ?>",
            }
        };

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\projects\my_projects\Lawyer app\resources\views/cases/add_case.blade.php ENDPATH**/ ?>