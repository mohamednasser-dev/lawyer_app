<?php $__env->startSection('styles'); ?>
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0"><?php echo e(trans('site_lang.side_home')); ?>

        </h4>
    </div>

</div>
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0"><?php echo e(trans('site_lang.side_users')); ?></h6>
                            <div class="dropdown mb-2">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"><?php echo e($users->count()); ?></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                            <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width:<?php echo e($users->count()); ?>%" aria-valuenow="<?php echo e($cases->count()); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0"><?php echo e(trans('site_lang.search_case_sessions')); ?></h6>
                            <div class="dropdown mb-2">


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"><?php echo e($sessions->count()); ?></h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-danger">
                                    </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                                <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h6 class="card-title mb-0"><?php echo e(trans('site_lang.side_cases')); ?></h6>
                            <div class="dropdown mb-2">


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-12 col-xl-5">
                                <h3 class="mb-2"><?php echo e($cases->count()); ?> </h3>
                                <div class="d-flex align-items-baseline">
                                    <p class="text-success">
                                          </p>
                                </div>
                            </div>
                            <div class="col-6 col-md-12 col-xl-7">
                                <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->



<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h6><?php echo e(trans('site_lang.home_sessions_coming')); ?></h6>
                    <table class="table" id="sample_1">
                        <thead>
                            <tr>
                                <th scope="col" class="hidden-xs center">#</th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_date')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_status')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_month')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_case_number')); ?></th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $session; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row" class="hidden-xs center"><?php echo e($session->id); ?></th>
                                <td class="hidden-xs center"><?php echo e($session->session_date); ?></td>
                                <td class="hidden-xs center"><?php echo e($session->status); ?></td>
                                <td class="hidden-xs center"><?php echo e($session->month); ?></td>
                                <td class="hidden-xs center"><?php echo e($session->case_Id); ?></td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="sample_2">
                        <h6><?php echo e(trans('site_lang.home_session_missing')); ?></h6>
                        <thead class="black white-text">
                            <tr>
                                <th scope="col" class="hidden-xs center">#</th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_date')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_status')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_month')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_case_number')); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $sessionNo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sessionNo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row" class="hidden-xs center"><?php echo e($sessionNo->id); ?></th>
                                <td class="hidden-xs center"><?php echo e($sessionNo->session_date); ?></td>
                                <td class="hidden-xs center"><?php echo e($sessionNo->status); ?></td>
                                <td class="hidden-xs center"><?php echo e($sessionNo->month); ?></td>
                                <td class="hidden-xs center"><?php echo e($sessionNo->case_Id); ?></td>


                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
</div>




<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <h6> <?php echo e(trans('site_lang.side_mohdar')); ?></h6>
                    <table class="table" id="sample_3">
                        <thead class="black white-text">
                            <tr>
                                <th scope="col" class="hidden-xs center">#</th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.mohdar_court')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.mohdar_paper_type')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_date')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_session_case_number')); ?></th>
                                <th scope="col" class="hidden-xs center"><?php echo e(trans('site_lang.home_see_more')); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $mohder; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mohder): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row" class="hidden-xs center"><?php echo e($mohder->moh_Id); ?></th>
                                <td class="hidden-xs center"><?php echo e($mohder->court_mohdareen); ?></td>
                                <td class="hidden-xs center"><?php echo e($mohder->paper_type); ?></td>
                                <td class="hidden-xs center"><?php echo e($mohder->session_Date); ?></td>
                                <td class="hidden-xs center"><?php echo e($mohder->case_number); ?></td>
                                <td class="hidden-xs center">
                                    <a id="showMohdar" class="btn btn-xs" data-placement="top" data-original-title="show" data-moh-Id="<?php echo e($mohder->moh_Id); ?>"><i class="fa fa-eye"></i></a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>




<!-- modal mohder -->
<div id="show_mohdar_model" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal bs-example-modal-basic fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">
                    ×
                </button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>محضرين محكمة</strong>
                            <div class="well well-sm">
                                <span id="court_mohdareen_show"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>نوع الورقة</strong>
                            <div class="well well-sm">
                                <span id="paper_type_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>تاريخ تسليم الورقة</strong>
                            <p id="deliver_data">
                                <div class="well well-sm">
                                    <span id="deliver_data_show"></span>
                                </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>رقم الورقة</strong>
                            <div class="well well-sm">
                                <span id="paper_Number_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>تاريخ الجلسة</strong>
                            <div class="well well-sm">
                                <span id="session_Date_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>إسم الموكل</strong>
                            <div class="well well-sm">
                                <span id="mokel_Name_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12" id="khesm_container">
                        <div class="form-group">
                            <strong for="khesm_Name">
                                إسم الخصم
                            </strong>
                            <div class="well well-sm">
                                <span id="khesm_Name_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>
                                رقم القضية
                            </strong>
                            <div class="well well-sm">
                                <span id="case_number_show"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group<?php echo e($errors->has('notes')?' has-error':''); ?>">
                            <strong>
                                الملاحظات
                            </strong>
                            <div class="well well-sm">
                                <span id="notes_show"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">
                        Close
                    </button>

                </div>
            </div>
            <!-- /.modal-content -->
        </div>


        <!-- /.modal-dialog -->
    </div>
</div>

<!-- modal session note -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>
    $(document).ready(function() {
        $(document).on('click', '#showMohdar', function() {
            var id = $(this).data('moh-Id');
            console.log(id);
            $.ajax({
                url: "mohdareendata/" + id,
                dataType: "json",
                success: function(html) {
                    $('#court_mohdareen_show').html(html.data.court_mohdareen);
                    $('#paper_type_show').html(html.data.paper_type);
                    $('#deliver_data_show').html(html.data.deliver_data);
                    $('#session_Date_show').html(html.data.session_Date);
                    $('#case_number_show').html(html.data.case_number);
                    $('#paper_Number_show').html(html.data.paper_Number);
                    $('#mokel_Name_show').html(html.data.mokel_Name);
                    $('#khesm_Name_show').html(html.data.khesm_Name);
                    $('#notes_show').html(html.data.notes);
                    $('.modal-title').text("المحضر");
                    $('#show_mohdar_model').modal('show');

                }
            })
        });

    });
</script>

<script src="<?php echo e(url('/assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(url('/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')); ?>"></script>
<script src="<?php echo e(url('/assets/js/data-table.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scriptDocument'); ?>
UIModals.init();
TableData.init();

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/home.blade.php ENDPATH**/ ?>