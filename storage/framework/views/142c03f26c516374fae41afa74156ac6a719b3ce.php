<div id="add_note_model" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p id="modal_title"></p>
            </div>
            <div class="modal-body">
                <form method="post" id="notesForm" class="cmxform">
                    <fieldset>
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="noteId" id="noteId">
                        <input type="hidden" name="session_Id" id="session_Id">
                        <div class="form-group">
                                 <textarea type="text" name="note" id="note" class="form-control"
                                           placeholder="<?php echo e(trans('site_lang.search_case_session_note')); ?>"
                                           value="<?php echo e(old('note')); ?>" rows="3"></textarea>
                            <span class="text-danger" id="note_error"></span>
                        </div>

                        <div class="form-group">
                            <button data-dismiss="modal" class="btn btn-sm btn-danger" type="button">
                                <?php echo e(trans('site_lang.public_close_btn_text')); ?>

                            </button>
                            <input type="submit" class="btn btn-sm btn-outline-primary" id="add_note" name="add_note"
                                   value=" <?php echo e(trans('site_lang.public_add_btn_text')); ?>"/>
                        </div>
                    </fieldset>
                </form>

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php /**PATH C:\xampp\htdocs\NewT-E-S\resources\views/cases/add_session_notes_modal.blade.php ENDPATH**/ ?>