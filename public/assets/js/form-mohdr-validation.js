$(function () {
    'use strict';
    var mohdrForm;
    $.validator.setDefaults({
        submitHandler: function () {
            // $('#mohdars').on('submit', function (event) {
            //     event.preventDefault();
            var form = $('#mohdars').serialize();
            if ($('#add_mohdar').val() == config.trans.btn_add_text) {
                $.ajax({
                    url: config.trans.add_mohdr_route,
                    dataType: 'json',
                    data: form,
                    type: 'post',
                    success: function (data) {
                        console.log(data)
                        $('#add_mohdar_model').modal('hide');
                        toastr.success(data.success);
                        $("#mohdars").trigger('reset');
                        $(".js-example-basic-multiple").select2();
                        $('#mohdar_tbl').DataTable().ajax.reload();
                    }, error: function (data_error, exception) {
                        if (exception == 'error') {
                            $('#court_mohdareen_error').html(data_error.responseJSON.errors.court_mohdareen);
                            $('#paper_type_error').html(data_error.responseJSON.errors.paper_type);
                            $('#deliver_data_error').html(data_error.responseJSON.errors.deliver_data);
                            $('#session_Date_error').html(data_error.responseJSON.errors.session_Date);
                            $('#mokel_Name_error').html(data_error.responseJSON.errors.mokel_Name);
                            $('#khesm_Name_error').html(data_error.responseJSON.errors.khesm_Name);
                            $('#case_number_error').html(data_error.responseJSON.errors.case_number);
                            $('#To_error').html(data_error.responseJSON.errors.cat_id);

                        }
                    }
                });
            } else {
                console.log("else" + form);
                $.ajax({
                    url: config.trans.update_mohdr,
                    dataType: 'json',
                    data: form,
                    type: 'post'
                    , success: function (data) {
                        $('#add_mohdar_model').modal('hide');
                        toastr.success(data.msg);
                        $("#mohdars").trigger('reset');
                        $(".js-example-basic-multiple").select2();
                        $('#mohdar_tbl').DataTable().ajax.reload();
                    }, error: function (data_error, exception) {
                        if (exception == 'error') {
                            $('#court_mohdareen_error').html(data_error.responseJSON.errors.court_mohdareen);
                            $('#paper_type_error').html(data_error.responseJSON.errors.paper_type);
                            $('#deliver_data_error').html(data_error.responseJSON.errors.deliver_data);
                            $('#session_Date_error').html(data_error.responseJSON.errors.session_Date);
                            $('#mokel_Name_error').html(data_error.responseJSON.errors.mokel_Name);
                            $('#khesm_Name_error').html(data_error.responseJSON.errors.khesm_Name);
                            $('#case_number_error').html(data_error.responseJSON.errors.case_number);
                            $('#To_error').html(data_error.responseJSON.errors.cat_id);

                        }
                    }
                });
            }
            // });
        }
    });
    $(function () {
        // validate signup form on keyup and submit
        mohdrForm = $("#mohdars").validate({
            rules: {
                case_number: {
                    required: true,
                },
                circle_num: {
                    required: true,
                },
                court_mohdareen: {
                    required: true,

                }, paper_type: {
                    required: true,

                }, deliver_data: {
                    required: true,

                },
                session_Date: {
                    required: true,
                },
                inventation_type: {
                    required: true,

                }, paper_Number: {
                    required: true,

                }, notes: {
                    required: true,

                },
                cat_id: {
                    required: true,

                }

            },
            messages: {
                case_number: {
                    required: config.trans.case_number,
                },
                circle_num: {
                    required: config.trans.circle_num,
                },
                court_mohdareen: {
                    required: config.trans.court_mohdareen,
                }, paper_type: {
                    required: config.trans.paper_type,
                }, deliver_data: {
                    required: config.trans.deliver_data,
                }, paper_Number: {
                    required: config.trans.paper_Number,
                },
                session_Date: {
                    required: config.trans.session_Date,
                },
                inventation_type: {
                    required: config.trans.inventation_type,
                }, notes: {
                    required: config.trans.notes,
                },
                cat_id: {
                    required: config.trans.cat_id,
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
