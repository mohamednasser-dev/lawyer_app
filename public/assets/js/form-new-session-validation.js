$(function () {
    'use strict';
    $(function () {
        // validate signup form on keyup and submit
        $("#sessionForm").validate({
            rules: {
                session_Date: {
                    required: true,
                }
            },
            messages: {
                session_Date: {
                    required: config.trans.session_Date,
                }
            },
            errorPlacement: function (label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            },submitHandler:function (){
                var form = $('#sessionForm').serialize();
                console.log(form);
                if ($('#add_session').val() == config.trans.add_session_btn) {
                    $.ajax({
                        url: config.routes.add_session_route,
                        dataType: 'json',
                        data: form,
                        type: 'post',
                        success: function (data) {
                            $('#sessions_table').DataTable().ajax.reload();
                            $('#add_session_model').modal('hide');
                            toastr.success(data.msg);
                            $("#sessionForm").trigger('reset');
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#session_date_error').html(data_error.responseJSON.errors.session_date);
                            }
                        }
                    });
                } else {
                    $.ajax({
                        url: config.routes.update_session_route,
                        dataType: 'json',
                        data: form,
                        type: 'post',
                        success: function (data) {
                            $('#sessions_table').DataTable().ajax.reload();
                            toastr.success(data.msg);
                            $('#add_session_model').modal('hide');
                        }, error: function (data_error, exception) {
                            if (exception == 'error') {
                                $('#session_date_error').html(data_error.responseJSON.errors.session_date);
                            }
                        }
                    });
                }
            }
        });
    });
});
