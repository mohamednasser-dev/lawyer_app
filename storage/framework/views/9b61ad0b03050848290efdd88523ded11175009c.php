<div id="add_new_mokel_modal" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="modal_title"></p>
            </div>
            <div class="modal-body">
                <form method="post" id="addMokelForm" class="cmxform">
                    <fieldset>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="clientId" id="clientId">
                        <input type="hidden" name="caseId" id="caseId" value="<?php echo e($id); ?>">
                        <div class="form-group" id="mokel_container">
                            <select class="js-example-basic-multiple w-100" multiple="multiple"
                                    data-width="100%"
                                    name="mokel_name[]">
                            </select>
                            <span class="text-danger" id="mokel_Name_error"></span>
                        </div>

                    </fieldset>
                </form>
                <div class="form-group">
                    <button data-dismiss="modal" class="btn btn-sm btn-outline-danger" type="button">
                        <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                    </button>
                    <input type="submit" class="btn btn-sm btn-outline-primary" id="add_mokel" name="add_mokel"
                           value="<?php echo e(trans('site_lang.public_add_btn_text')); ?>"/>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>


    <!-- /.modal-dialog -->
</div>
<?php /**PATH /home/dgmevmh7hnpa/public_html/tes/resources/views/cases/add_new_mokel_modal.blade.php ENDPATH**/ ?>