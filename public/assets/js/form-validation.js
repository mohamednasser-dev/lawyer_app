$(function () {
    'use strict';
var caseForm;
    $.validator.setDefaults({
        submitHandler: function (vaildedForm) {
            var form = $('#new_case').serialize();
            $.ajax({
                url: config.trans.add_case_route,
                dataType: 'json',
                data: form,
                type: 'post',
                beforeSend: function () {
                    $('#mokel_error').empty();
                    $('#khesm_error').empty();
                    $('#case_Number_error').empty();
                    $('#circle_Number_error').empty();
                    $('#court_Name_error').empty();
                    $('#first_date_error').empty();
                    $('#lawsuit_error').empty();
                    $('#To_error').empty();
                }, success: function (data) {
                    if (data.status) {
                        toastr.success(data.msg);
                        // $("#new_case").trigger('reset');
                        // $("#new_case").hideErrors();
                        caseForm.resetForm();
                        vaildedForm.reset();
                        $(".js-example-basic-multiple").select2();
                        // location.reload();
                    } else {
                        toastr.error(data.msg);
                    }
                }, error: function (data_error, exception) {
                    if (exception == 'error') {
                        $('#mokel_error').html(data_error.responseJSON.errors.mokel_name);
                        $('#khesm_error').html(data_error.responseJSON.errors.khesm_name);
                        $('#case_Number_error').html(data_error.responseJSON.errors.invetation_num);
                        $('#circle_Number_error').html(data_error.responseJSON.errors.circle_num);
                        $('#court_Name_error').html(data_error.responseJSON.errors.court);
                        $('#first_date_error').html(data_error.responseJSON.errors.first_session_date);
                        $('#lawsuit_error').html(data_error.responseJSON.errors.inventation_type);
                        $('#To_error').html(data_error.responseJSON.errors.to_whome);
                    }
                }
            });
        }
    });
    $(function () {
        // validate signup form on keyup and submit
       caseForm= $("#new_case").validate({
            rules: {
                invetation_num: {
                    required: true,
                },
                circle_num: {
                    required: true,
                },
                court: {
                    required: true,

                },
                first_session_date: {
                    required: true,
                },
                inventation_type: {
                    required: true,

                },
                to_whome: {
                    required: true,

                }

            },
            messages: {
                invetation_num: {
                    required: config.trans.invetation_num,
                },
                circle_num: {
                    required: config.trans.circle_num,
                },
                court: {
                    required: config.trans.court,
                },
                first_session_date: {
                    required: config.trans.first_session_date,
                },
                inventation_type: {
                    required: config.trans.inventation_type,
                },
                to_whome: {
                    required: config.trans.to_whome,
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
