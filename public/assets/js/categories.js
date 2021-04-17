$(document).ready(function () {

    $('#categories_tbl').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: config.trans.get_category_route,
        },
        columns: [
            {
                data: 'id',
                name: 'id',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,

            }
        ]
    });
    $('#addCategoryModal').click(function () {
        $('#modal_title').text(config.trans.add_new_category_text);
        $('#add_category').val(config.trans.public_add_btn_text);
        $('#add_category_model').modal('show');
    });
    $(document).on('click', '#editCategory', function () {
        var id = $(this).data('category-id');
        $.ajax({
            url: "/categories/" + id + "/edit",
            dataType: "json",
            success: function (html) {
                $('#name').val(html.data.name);
                $('#id').val(html.data.id);
                $('#modal_title').text(config.trans.edit_category_text);
                $('#add_category').val(config.trans.public_edit_btn_text);
                $('#add_category_model').modal('show');

            }
        })
    });
    var category_id;

    $(document).on('click', '#deleteCategory', function () {
        category_id = $(this).data('category-id');
        $('#confirmModal').modal('show');
    });

    $('#ok_button').click(function () {
        $.ajax({
            url: "categories/destroy/" + category_id,
            beforeSend: function () {
                $('#ok_button').text(config.trans.public_continue_delete_modal_text);
            },
            success: function (data) {
                setTimeout(function () {
                    console.log(data);
                    toastr.error(data.msg);
                    $('#confirmModal').modal('hide');
                    $('#categories_tbl').DataTable().ajax.reload();
                }, 100);
            }
        })
    });
});
$(document).ready(function () {
    $(".modal").on("hidden.bs.modal", function () {
        $("#categories").trigger('reset');
    });
});
