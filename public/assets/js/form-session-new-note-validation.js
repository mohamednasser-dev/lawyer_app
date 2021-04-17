$(function () {
    'use strict';
    $(function () {
        // validate signup form on keyup and submit
        $("#notesForm").validate({
            rules: {
                note: {
                    required: true,
                }
            },
            messages: {
                note: {
                    required: config.trans.session_note,
                }
            },
            errorPlacement: function (label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            },submitHandler : function() {
                var form = $('#notesForm').serialize();
                if ($('#add_note').val() == config.trans.public_add_btn_text) {
                    $.ajax({
                        url: config.routes.add_note_route,
                        dataType: 'json',
                        data: form,
                        type: 'post',
                        success: function (data) {
                            $('#session-notes-table').DataTable().ajax.reload();
                            $('#add_note_model').modal('hide');
                            $("#notesForm").trigger('reset');
                            toastr.success(data.msg);
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#note_error').html(data_error.responseJSON.errors.note);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: config.routes.update_note_route,
                        dataType: 'json',
                        data: form,
                        type: 'post'
                        , success: function (data) {
                            $('#session-notes-table').DataTable().ajax.reload();
                            toastr.success(data.msg);
                            $('#add_note_model').modal('hide');
                            $("#notesForm").trigger('reset');
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#note_error').html(data_error.responseJSON.errors.note);
                            }
                        }
                    });
                }
            }
        });
    });
});
