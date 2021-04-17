$(function () {
    'use strict';
    $.validator.setDefaults({
        submitHandler: function () {
            // $('#mohdars').on('submit', function (event) {
            //     event.preventDefault();
            var form = $('#categories').serialize();
            if ($('#add_category').val() == config.trans.public_add_btn_text) {
                $.ajax({
                    url: config.trans.add_category_route,
                    dataType: 'json',
                    data: form,
                    type: 'post',
                    success: function (data) {
                        $('#categories_tbl').DataTable().ajax.reload();
                        $('#add_category_model').modal('hide');
                        toastr.success(data.msg);
                        errorHandler3.hide();

                        $("#categories").trigger('reset');
                    }, error: function (data_error, exception) {
                        if (exception == 'error') {
                            $('#category_name_error').html(data_error.responseJSON.errors.name);
                        }
                    }
                });
            } else {
                $.ajax({
                    url: config.trans.update_category_route,
                    dataType: 'json',
                    data: form,
                    type: 'post'
                    , success: function (data) {
                        $('#categories_tbl').DataTable().ajax.reload();
                        toastr.success(data.msg);
                        $('#add_category_model').modal('hide');
                        $("#categories").trigger('reset');
                    }, error: function (data_error, exception) {
                        if (exception == 'error') {

                        }
                    }
                });
            }
            // });
        }
    });
    $(function () {
        // validate signup form on keyup and submit
        $("#categories").validate({
            rules: {
                name: {
                    required: true,
                }
            },
            messages: {
                name: {
                    required: config.trans.category_name,
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
