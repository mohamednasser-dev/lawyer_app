$(function () {
    'use strict';
    $.validator.setDefaults({
        submitHandler: function () {
            var form = $('#update_case_form').serialize();
            console.log(form);
            $.ajax({
                url: config.routes.update_case_data,
                dataType: 'json',
                data: form,
                type: 'post',
                success: function (data) {
                    toastr.success(data.msg);
                }, error: function (data_error, exception) {
                    if (exception == 'error') {
                        $('#session_date_error').html(data_error.responseJSON.errors.session_date);
                    }
                }
            });

        }
    });
    $(function () {
        // validate signup form on keyup and submit
        $("#update_case_form").validate({
            rules: {
                invetation_num: {
                    required: true,
                },
                inventation_type: {
                    required: true,
                },
                circle_num: {
                    required: true,

                }, court: {
                    required: true,
                }

            },
            messages: {
                invetation_num: {
                    required: config.trans.case_number,
                },
                circle_num: {
                    required: config.trans.circle_num,
                },
                court: {
                    required: config.trans.court_mohdareen,
                },
                inventation_type: {
                    required: config.trans.inventation_type,
                }
            },
            errorPlacement: function (label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            }
        });
    });
});
