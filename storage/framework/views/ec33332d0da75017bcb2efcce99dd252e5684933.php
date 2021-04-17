<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from www.nobleui.com/html/template/demo_4/dashboard-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 25 Sep 2020 17:40:34 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($id); ?>&nbsp; <?php echo e(trans('site_lang.reports_print_daily_1')); ?></title>
    <!-- core:css -->
    <link rel="shortcut icon" href="<?php echo e(url('/assets/images/favicon.png')); ?>" />
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/core/core.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/css/demo_1/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">



</head>

<?php if(session('lang')=='en'): ?>

<body class="ltr">
    <?php else: ?>

    <body class="rtl">
        <?php endif; ?>


        <div style="text-align:center;font-size: 30px;background-color: #8E9AA2;color: white; padding-top: 15px; padding-bottom: 15px;">
            <hl class="center"><?php echo e(trans('site_lang.reports_print_daily_1')); ?>&nbsp; <?php echo e($id); ?></hl>
        </div>
        <br>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="table" style="text-align:center" id="DailyContainer">
                <table id="dailyTable" class="table table-bordered " style="width:100%">

                    <thead>
                        <tr>
                            <?php if(session('lang')=='en'): ?>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.mohdar_notes')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.home_session_date')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_court')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_inventation_type')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_circle_num')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.home_session_case_number')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.clients_client_type_khesm')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.clients_client_type_client')); ?></th>
                            <th style="width: 10%;" >#</th>
                            <?php else: ?>
                            <th style="width: 10%;" >#</th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.clients_client_type_client')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.clients_client_type_khesm')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.home_session_case_number')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_circle_num')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_inventation_type')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.add_case_court')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.home_session_date')); ?></th>
                            <th style="width: 10%;" ><?php echo e(trans('site_lang.mohdar_notes')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1;
                        ?>
                        <?php if($data->count() > 0): ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php if(session('lang')=='en'): ?>
                            <?php if($row->Printnotes ==null): ?>
                            <td>----</td>
                            <?php else: ?>
                            <td><?php echo e($row->Printnotes->note); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($row->session_date); ?></td>
                            <td><?php echo e($row->cases->court); ?></td>
                            <td><?php echo e($row->cases->inventation_type); ?></td>
                            <td><?php echo e($row->cases->circle_num); ?></td>
                            <td><?php echo e($row->cases->invetation_num); ?></td>
                            <td><?php echo e($khesm->client_Name); ?></td>
                            <td><?php echo e($clients->client_Name); ?></td>
                            <td><?php echo e($i); ?></td>
                            <?php else: ?>
                            <td><?php echo e($i); ?></td>
                            <td><?php echo e($clients->client_Name); ?></td>
                            <td><?php echo e($khesm->client_Name); ?></td>
                            <td><?php echo e($row->cases->invetation_num); ?></td>
                            <td><?php echo e($row->cases->circle_num); ?></td>
                            <td><?php echo e($row->cases->inventation_type); ?></td>
                            <td><?php echo e($row->cases->court); ?></td>
                            <td><?php echo e($row->session_date); ?></td>
                            <?php if($row->Printnotes ==null): ?>
                            <td>----</td>
                            <?php else: ?>
                            <td><?php echo e($row->Printnotes->note); ?></td>
                            <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                        <?php
                        $i=$i+1;
                        ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="<?php echo e(url('/assets/vendors/core/core.js')); ?>"></script>
        <script src="<?php echo e(url('/assets/js/template.js')); ?>"></script>
        <script src="<?php echo e(url('/assets/js/data-table.js')); ?>"></script>

        <script>
            window.print();
        </script>
    </body>

</html>
<?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/Reports/DailyPDF.blade.php ENDPATH**/ ?>