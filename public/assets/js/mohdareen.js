$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    var button = document.getElementById('mohdar_tbl');
    button.removeAttribute('style');
    $('#mohdar_tbl').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: config.trans.get_mohdareen,
        },
        columns: [
            {
                data: 'moh_Id',
                name: 'moh_Id',
            },
            {
                data: 'mokel_Name',
                name: 'mokel_Name',
            },
            {
                data: 'khesm_Name',
                name: 'khesm_Name',
            },
            {
                data: 'paper_Number',
                name: 'paper_Number',
            },
            {
                data: 'court_mohdareen',
                name: 'court_mohdareen',
            },
            {
                data: 'session_Date',
                name: 'session_Date',
            },
            {
                data: 'status',
                name: 'status',
            },

            {
                data: 'action',
                name: 'action',
                orderable: false,
            }
        ]
    });

    $('#addMohdarModal').click(function () {
        $('#mokel_Name').empty();
        $('#Opponent').empty();
        $.ajax({
            url: config.trans.get_mohdareen_clients,
            dataType: 'json',
            type: 'get',
            success: function (data) {
                $.each(data.khesm, function (i, index) {
                    $('#Opponent').append(`<option value="${index.client_Name}">${index.client_Name}</option>`);
                });
                $.each(data.clients, function (i, index) {
                    $('#mokel_Name').append(`<option value="${index.client_Name}">${index.client_Name}</option>`);
                });
            }
        });

        $('#modal_title').text(config.trans.add_mohdr_modal_title);
        $('#add_mohdar').val(config.trans.add_public_btn);
        $('#add_mohdar_model').modal('show');
    });
    $(document).on('click', '#editMohdar', function () {
        var id = $(this).data('moh-id');
        $.ajax({
            url: "/mohdareen/" + id + "/edit",
            dataType: "json",
            success: function (html) {
                $('#court_mohdareen').val(html.data.court_mohdareen);
                $('#paper_type').val(html.data.paper_type);
                $('#deliver_data').val(html.data.deliver_data);
                $('#session_Date').val(html.data.session_Date);
                $('#case_number').val(html.data.case_number);
                $('#paper_Number').val(html.data.paper_Number);
                $('#notes').val(html.data.notes);
                $("#form-field-select-3").val(html.data.cat_id);
                $('#id').val(html.data.moh_Id);
                $('#mokel_container').hide();
                $('#khesm_container').hide();
                $('#modal_title').text(config.trans.edit_mohdr_modal_title);
                $('#add_mohdar').val(config.trans.edit_public_btn);
                $('#add_mohdar_model').modal('show');
            }
        })
    });
    $(document).on('click', '#showMohdar', function () {
        var id = $(this).data('moh-id');
        $.ajax({
            url: "/mohdareen/" + id + "/edit",
            dataType: "json",
            success: function (html) {
                $('#court_mohdareen_show').val(html.data.court_mohdareen);
                $('#paper_type_show').val(html.data.paper_type);
                $('#deliver_data_show').val(html.data.deliver_data);
                $('#session_Date_show').val(html.data.session_Date);
                $('#case_number_show').val(html.data.case_number);
                $('#paper_Number_show').val(html.data.paper_Number);
                $('#mokel_Name_show').val(html.data.mokel_Name);
                $('#khesm_Name_show').val(html.data.khesm_Name);
                $('#notes_show').val(html.data.notes);
                $('.modal-title').text('تفاصيل المحضر');
                $('#show_mohdar_model').modal('show');
            }
        })
    });
    $(document).on('click', '#moh_status', function () {
        var id = $(this).data('moh-id');
        $.ajax({
            url: "mohdareen/updateStatus/" + id,
            dataType: "json",
            success: function (html) {
                toastr.error(html.msg);
                $('#mohdar_tbl').DataTable().ajax.reload();
            }
        })
    });
    var user_id;
    $(document).on('click', '#deleteMohadr', function () {
        user_id = $(this).data('moh-id');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function () {
        $.ajax({
            url: "mohdareen/destroy/" + user_id,
            beforeSend: function () {
                $('#ok_button').text(config.trans.public_continue_delete_modal_text);
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModal').modal('hide');
                    $('#mohdar_tbl').DataTable().ajax.reload();
                    $('#ok_button').text(config.trans.delete_public_btn);
                }, 1000);
            }
        })
    });
});
$(document).ready(function () {
    $(".modal").on("hidden.bs.modal", function () {
        $("#mohdars").trigger('reset');
    });
});
