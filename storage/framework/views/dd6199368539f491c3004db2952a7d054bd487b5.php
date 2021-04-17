<div id="add_session_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title"></p>
            </div>
            <div class="modal-body">
                <form method="post" id="sessionForm" class="cmxform">
                    <fieldset>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="sessionId" id="sessionId">
                        <input type="hidden" name="case_Id" id="case_Id" value="<?php echo e($id); ?>">
                        <label for="session_Date"><?php echo e(trans('site_lang.home_session_date')); ?></label>
                        <div>
                            <div class="input-group date datepicker" id="datePickerSessionMohderSession">
                                <input type="text" class="form-control" id="session_Date" name="session_Date"
                                       value="<?php echo e(old('session_Date')); ?>"><span class="input-group-addon"><i
                                        data-feather="calendar"></i></span>
                                <span class="text-danger" id="session_date_error"></span>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <button data-dismiss="modal" class="btn btn-outline-danger" type="button">
                                <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                            </button>
                            <input type="submit" class="btn btn-outline-primary" id="add_session" name="add_session"
                                   value="<?php echo e(trans('site_lang.search_case_case_add_session')); ?>"/>
                        </div>
                    </fieldset>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php /**PATH C:\xampp\htdocs\my websites\NewT-E-S\resources\views/cases/add_session_modal.blade.php ENDPATH**/ ?>