<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/prismjs/themes/prism.css')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('site_lang.side_home')); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"> <?php echo e(trans('site_lang.search_case_search')); ?></li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">
                        <table id="cases" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الموكل \ اسم الخصم</th>
                                <th>رقم الدعوى</th>
                                <th>المحكمة</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
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
    <script src="<?php echo e(url('/assets/vendors/prismjs/prism.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/vendors/clipboard/clipboard.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>

    <script src="<?php echo e(url('/assets/js/form-update-case-validation.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/inputmask.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/select2.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/tags-input.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/datepicker.js')); ?>"></script>
    <script>
        // global app configuration object
        var config = {
            routes: {
                get_cases_route: "<?php echo e(route('caseDetails.index')); ?>",
                add_session_route: "<?php echo e(route('caseDetails.store')); ?>",
                update_session_route: "<?php echo e(route('caseDetails.update')); ?>",
                add_note_route: "<?php echo e(route('notes.store')); ?>",
                update_note_route: "<?php echo e(route('notes.update')); ?>",
                update_case_data: "<?php echo e(route('caseDetails.updateCase')); ?>",
                add_new_client: "<?php echo e(route('caseDetails.addNewClient')); ?>",
                get_case_details: "<?php echo e(route('caseDetails.addNewClient')); ?>",
            }, trans: {
                select2_place_holder: "<?php echo e(trans('site_lang.clients_client_type_client_hint')); ?>",
                select1_place_holder: "<?php echo e(trans('site_lang.clients_client_type_khesm_hint')); ?>",
                add_session_btn: "<?php echo e(trans('site_lang.search_case_case_add_session')); ?>",
                search_case_session_waiting: "<?php echo e(trans('site_lang.search_case_session_waiting')); ?>",
                add_session_modal_title: "<?php echo e(trans('site_lang.search_case_session_modal_title')); ?>",
                edit_session_modal_title: "<?php echo e(trans('site_lang.search_case_session_modal_title_edit')); ?>",
                public_continue_delete_modal_text: "<?php echo e(trans('site_lang.public_continue_delete_modal_text')); ?>",
                public_delete_modal_text: "<?php echo e(trans('site_lang.public_delete_modal_text')); ?>",
                public_delete_text: "<?php echo e(trans('site_lang.public_delete_text')); ?>",
                search_case_case_add_note: "<?php echo e(trans('site_lang.search_case_case_add_note')); ?>",
                public_add_btn_text: "<?php echo e(trans('site_lang.public_add_btn_text')); ?>",
                edit_public: "<?php echo e(trans('site_lang.public_edit_btn_text')); ?>",
                search_case_session_id_warning_text: "<?php echo e(trans('site_lang.search_case_session_id_warning_text')); ?>",
                search_case_session_modal_title_edit: "<?php echo e(trans('site_lang.search_case_session_modal_title_edit')); ?>",
                public_edit_btn_text: "<?php echo e(trans('site_lang.public_edit_btn_text')); ?>",
                clients_add_new_client_text: "<?php echo e(trans('site_lang.clients_add_new_client_text')); ?>",
                clients_add_new_khesm_text: "<?php echo e(trans('site_lang.clients_add_new_khesm_text')); ?>",
                search_case_add_client: "<?php echo e(trans('site_lang.search_case_add_client')); ?>",
                search_case_add_khesm: "<?php echo e(trans('site_lang.search_case_add_khesm')); ?>",
                search_case_case_warning_text: "<?php echo e(trans('site_lang.search_case_case_warning_text')); ?>",
                search_case_delete_session_text: "<?php echo e(trans('site_lang.search_case_delete_session_text')); ?>",
                court_mohdareen: "<?php echo e(trans('usersValidations.court')); ?>",
                circle_num: "<?php echo e(trans('usersValidations.circle_num')); ?>",
                case_number: "<?php echo e(trans('usersValidations.invetation_num')); ?>",
                inventation_type: "<?php echo e(trans('usersValidations.inventation_type')); ?>",

            }
        };

        var casee_id;
        $(document).on('click', '#deletecase', function () {
            casee_id = $(this).data('case-id');

            $('#confirmModala').modal('show');
        });
        $('#okbutton').click(function () {

            $.ajax({
                url: "/caseDetails/delete/" + casee_id,
                success: function (data) {
                    toastr.success(data.msg);
                    setTimeout(function () {
                        $('#confirmModala').modal('hide');
                        $('#cases').DataTable().ajax.reload();
                        location.reload();
                    }, 100);
                }
            })
        });
    </script>
    <script src="<?php echo e(url('/assets/js/search-cases.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/cases/search_case.blade.php ENDPATH**/ ?>