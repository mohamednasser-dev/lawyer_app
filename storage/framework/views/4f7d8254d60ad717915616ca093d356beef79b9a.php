<?php $__env->startSection('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/select2/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('/assets/vendors/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet"
          href="<?php echo e(url('/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-header" data-toggle="collapse" href="#multiCollapseExample1" role="button"
                     aria-expanded="true" aria-controls="multiCollapseExample1">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-title mb-0"> <?php echo e(trans('site_lang.search_case_info_head')); ?></div>
                    </div>

                </div>
                <div class="card-body">
                    <form id="update_case_form" method="post" class="cmxform">
                        <fieldset>
                            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                            <input type="hidden" name="to_whome" id="to_whome">
                            <input type="hidden" name="caseId" id="caseId">
                            <div class="form-group">
                                <label for="invetation_num"><?php echo e(trans('site_lang.home_session_case_number')); ?></label>
                                <input type="text" name="invetation_num" class="form-control" id="invetation_num"
                                       placeholder="<?php echo e(trans('site_lang.home_session_case_number')); ?>"
                                       value="<?php echo e(old('court_mohdareen')); ?>">
                                <span class="text-danger" id="mohdareen_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="inventation_type">
                                    <?php echo e(trans('site_lang.add_case_inventation_type')); ?>

                                </label>
                                <input type="text" placeholder="<?php echo e(trans('site_lang.add_case_inventation_type')); ?>"
                                       class="form-control" id="inventation_type" name="inventation_type">
                            </div>
                            <div class="form-group">
                                <label for="circle_num">
                                    <?php echo e(trans('site_lang.add_case_circle_num')); ?>

                                </label>
                                <input type="text" placeholder="<?php echo e(trans('site_lang.add_case_circle_num')); ?>"
                                       class="form-control" id="circle_num" name="circle_num">
                            </div>
                            <div class="form-group">
                                <label for="courts">
                                    <?php echo e(trans('site_lang.add_case_court')); ?>

                                </label>
                                <input type="text" placeholder="<?php echo e(trans('site_lang.add_case_court')); ?>"
                                       class="form-control" id="court" name="court">
                            </div>
                            <?php
                                $user_type = auth()->user()->type;
                                if($user_type == 'admin'){
                            ?>
                            <div class="form-group">
                                <label for="form-field-select-3">
                                    <?php echo e(trans('site_lang.add_case_to_whom')); ?>

                                </label>
                                <select id="form-field-select-3" class="js-example-basic-single w-100" data-width="100%"
                                        name="to_whome">
                                    <option value="">
                                        &nbsp;<?php echo e(trans('site_lang.add_case_to_whom')); ?></option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value='<?php echo e($category->id); ?>'><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger" id="To_error"></span>
                            </div>
                            <?php
                                }
                            ?>
                            <div class="form-group center-block">
                                <button class="btn btn-primary block" type="submit" id="btn_case_update"
                                        name="btn_case_update">
                                    <?php echo e(trans('site_lang.public_edit_btn_text')); ?> &nbsp;&nbsp;<i
                                        class="fa fa-arrow-circle-up"></i>
                                </button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0"><?php echo e(trans('site_lang.search_case_sessions')); ?></h6>
                                <div class="dropdown mb-2">
                                    <a href="#session_container"
                                       class="btn-sm btn-info"><?php echo e(trans('site_lang.home_more_options')); ?></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h4 class="mb-2" id="sessions_count"></h4>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart2" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0"><?php echo e(trans('site_lang.mohdar_notes')); ?></h6>
                                <div class="dropdown mb-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h4 class="mb-2" id="notes_count"></h4>

                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart3" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0"><?php echo e(trans('site_lang.search_case_attachments')); ?></h6>
                                <div class="dropdown mb-2">


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h4 class="mb-2" id="attach_count"></h4>

                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="apexChart1" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0"><?php echo e(trans('site_lang.search_case_sessions')); ?></h6>
                                <div class="dropdown mb-2">


                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h4 class="mb-2"> 12</h4>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="" class="mt-md-3 mt-xl-0">

                                                <span
                                                    data-peity='{"stroke": ["rgb(126, 229, 229)"], "fill": ["rgba(126, 229, 229, .3)"],"height": 50, "width": 80 }'
                                                    class="peity-line">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-title mb-0"> <?php echo e(trans('site_lang.search_case_clients')); ?></div>
                        <a class="btn btn-outline-primary" id="addMokelModal"><i
                                class="fa fa-plus">&nbsp;&nbsp;</i><?php echo e(trans('site_lang.search_case_add_client')); ?>

                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="mokel_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo e(trans('site_lang.clients_client_name')); ?></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-title mb-0"> <?php echo e(trans('site_lang.search_case_khesms')); ?></div>
                        <a class="btn btn-outline-success" id="addKhesmModal"><i class="fa fa-plus">
                                &nbsp;&nbsp;</i><?php echo e(trans('site_lang.search_case_add_khesm')); ?>

                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="khesm_table">
                            <thead>
                            <tr>
                                <th class="hidden-xs center">#</th>
                                <th class="hidden-xs center"><?php echo e(trans('site_lang.clients_client_name')); ?></th>
                                <th class="hidden-xs center"></th>

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
    <div class="row" id="session_container">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-title mb-0"> <?php echo e(trans('site_lang.search_case_sessions')); ?></div>
                        <a class="btn btn-outline-primary" id="addSessionModal"><i
                                class="fa fa-plus">&nbsp;&nbsp;</i><?php echo e(trans('site_lang.search_case_case_add_session')); ?>

                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="sessions_table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center"><?php echo e(trans('site_lang.home_session_date')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.home_session_status')); ?></th>
                                <th class="center"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="card-title mb-0"> <?php echo e(trans('site_lang.mohdar_notes')); ?></div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <a class="btn btn-outline-primary" id="addNotesModal"><i
                                    class="fa fa-plus">&nbsp;&nbsp;</i><?php echo e(trans('site_lang.search_case_case_add_note')); ?>

                            </a>
                            &nbsp;&nbsp;
                            <a class="btn btn-warning" id="btnPrintNotes" target="_blank"><i
                                    class="fa fa-print"></i>&nbsp;&nbsp;<?php echo e(trans('site_lang.search_case_case_print_notes')); ?>

                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="session-notes-table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center"><?php echo e(trans('site_lang.search_case_session_note')); ?></th>
                                <th class="center"><?php echo e(trans('site_lang.home_session_status')); ?></th>
                                <th class="center"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('cases.add_session_notes_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <?php echo $__env->make('cases.add_session_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    
    <?php echo $__env->make('cases.add_new_mokel_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <?php echo $__env->make('cases.add_new_mokel_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?php echo e(trans('site_lang.public_delete_modal_text')); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button"
                            class="btn btn-sm btn-success"><?php echo e(trans('site_lang.public_accept_btn_text')); ?></button>
                    <button type="button" class="btn btn-sm btn-danger"
                            data-dismiss="modal"><?php echo e(trans('site_lang.public_close_btn_text')); ?></button>
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
    <script src="<?php echo e(url('/assets/vendors/peity/jquery.peity.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('custom-scripts'); ?>
    <script src="<?php echo e(url('assets/js/case-details.js')); ?>"></script>

    <script src="<?php echo e(url('/assets/js/form-update-case-validation.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/form-new-session-validation.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/form-session-new-note-validation.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/inputmask.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/select2.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/tags-input.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/datepicker.js')); ?>"></script>
    <script src="<?php echo e(url('/assets/js/peity.js')); ?>"></script>

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
                print_case: "caseDetails/printCase/" +<?php echo e($id); ?>,
                case_details: "/caseDetails/" + <?php echo e($id); ?> +"/edit",
                get_client_for_case: "<?php echo e(url('getClientByType/client/'.$id)); ?>",
                get_khesm_for_case: "<?php echo e(url('getClientByType/khesm/'.$id)); ?>",
                delete_clients: "<?php echo e(url('deleteClient/'.$id)); ?>",
                case_session: "<?php echo e(url('getSessions/'.$id)); ?>",
                update_case_session_status: "<?php echo e(url('updateStatusSession')); ?>",
                get_case_session_date: "<?php echo e(url('showSessionData')); ?>",
                delete_case_session: "<?php echo e(url('caseDetails/destroy')); ?>",
                print_session_note: "<?php echo e(url('printSessionNotes')); ?>",
                get_session_notes: "<?php echo e(url('getSessionNotes')); ?>",
                update_session_note_status: "<?php echo e(url('updateStatus')); ?>",
                delete_session_note: "<?php echo e(url('destroy')); ?>",


            }, trans: {
                select2_place_holder: "<?php echo e(trans('site_lang.clients_client_type_client_hint')); ?>",
                clients_client_type_client: "<?php echo e(trans('site_lang.clients_client_type_client')); ?>",
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
                session_Date: "<?php echo e(trans('usersValidations.first_session_date')); ?>",
                session_note: "<?php echo e(trans('usersValidations.session_note')); ?>",
                delete_khesm_warning: "<?php echo e(trans('usersValidations.delete_khesm_warning')); ?>",
                delete_client_warning: "<?php echo e(trans('usersValidations.delete_client_warning')); ?>",

            }
        };

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('welcome', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/cases/case_details.blade.php ENDPATH**/ ?>