
<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('site_lang.side_home')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo e(trans('site_lang.side_reports_daily')); ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <a class="btn btn-primary card-title" id="btn_search_daily" target="_blank"><i
                                class="fa fa-print"></i>&nbsp;&nbsp;<?php echo e(trans('site_lang.reports_print')); ?></a>
                        <div class="col-md-6 col-lg-5 col-sm-6">
                            <div class="input-group date datepicker" id="datePickerReports">
                                <input type="text" class="form-control" id="search_daily"
                                       name="search_daily"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                            </div>
                            <input id="user_type" type="hidden" value="<?php echo e(auth()->user()->type); ?>"/>
                            <input id="user_cat" type="hidden" value="<?php echo e(auth()->user()->cat_id); ?>"/>
                        </div>
                        <?php
                            $user_type = auth()->user()->type;
                            if($user_type == 'admin'){
                        ?>
                        <div class="col-md-6 col-lg-3 col-sm-6">
                            <div class="form-group">
                                <select id="Dailytype" class="js-example-basic-single w-100"
                                        data-width="100%"
                                        name="Dailytype">
                                    <option value="">
                                        &nbsp;<?php echo e(trans('site_lang.add_case_to_whom')); ?></option>

                                    <option value="all"
                                            selected="selected"><?php echo e(trans('site_lang.reports_all')); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                    <div class="table-responsive" id="DailyContainer">
                        <table id="dailyTable" class="table table-bordered">
                            <thead>
                            <tr>
                                <th><?php echo e(trans('site_lang.clients_client_type_client')); ?></th>
                                <th><?php echo e(trans('site_lang.clients_client_type_khesm')); ?></th>
                                <th><?php echo e(trans('site_lang.home_session_case_number')); ?></th>
                                <th><?php echo e(trans('site_lang.add_case_circle_num')); ?></th>
                                <th><?php echo e(trans('site_lang.add_case_inventation_type')); ?></th>
                                <th><?php echo e(trans('site_lang.add_case_court')); ?></th>
                                <th><?php echo e(trans('site_lang.home_session_date')); ?></th>
                                <th><?php echo e(trans('site_lang.mohdar_notes')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-plugin'); ?>
    <script src="<?php echo e(url('/assets/vendors/select2/select2.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('/assets/js/select2.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/datepicker.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/daily_search.js')); ?>"></script>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dgmevmh7hnpa/public_html/tes/resources/views/Reports/CasesDailyReport.blade.php ENDPATH**/ ?>