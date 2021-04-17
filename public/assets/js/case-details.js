$(document).ready(function () {
    var caseId;
    var session_id;
    var client_id;
    var note_id;
    var who_delete;
    var who_delete_text;
    var client_count;
    var khesm_count;

//getCaseData
    $('#btnPrintCase').attr("href", config.routes.print_case);
    $("#sessions_table").dataTable().fnDestroy();
    $('#sessions_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: config.routes.case_session,
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                className: 'center'
            },
            {
                data: 'session_date',
                name: 'session_date',
                className: 'center'
            }, {
                data: 'status',
                name: 'status',
                className: 'center'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                className: 'center'
            }
        ]
    });
    $.ajax({
        url: config.routes.case_details,
        dataType: "json",
        success: function (html) {
            //for case data
            $('#to_whome').html(html.result.to_whom); //text
            $('#caseId').val(html.result.case.id); //text
            $('#input_whome').val(html.result.to_whom); //input
            // $('#invetation_num').html(html.result.case.invetation_num);
            $('#invetation_num').val(html.result.case.invetation_num);//input
            // $('#inventation_type').html(html.result.case.inventation_type);
            $('#inventation_type').val(html.result.case.inventation_type);//input
            // $('#court').html(html.result.case.court);
            $('#court').val(html.result.case.court);//input
            // $('#circle_num').html(html.result.case.circle_num);
            $('#circle_num').val(html.result.case.circle_num);//input
            $('#first_session_date').html(html.result.case.first_session_date);
            //for counting
            $('#attach_count').html(html.result.attachments_counts);
            $('#notes_count').html(html.result.notes_count);
            $('#sessions_count').html(html.result.sessions_counts);
            //for mokel_table tabel
            $('#mokel_table tbody').prepend(html.result.clients);
            // $('#mokel_table').DataTable();
            //for khesm_table tabel
            $('#khesm_table tbody').prepend(html.result.khesm);

            client_count = html.result.client_count;
            khesm_count = html.result.khesm_count;
            // $('#khesm_table').DataTable();
            //attachments url
            var attachment_url = "attachment/" + caseId;
            $('#attachment').attr("href", attachment_url);
            $("#form-field-select-3").val(html.result.case.to_whome);
        }
    })


    //show modal form for adding sessions
    $('#addSessionModal').click(function () {
        $('.modal-title').text(config.trans.add_session_btn);
        $('#add_session').val(config.trans.add_session_btn);
        $('#add_session_model').modal('show');
    });

    $(document).on('click', '#editSession', function () {
        var id = $(this).data('session-id');
        $.ajax({
            url: config.routes.get_case_session_date + "/" + id,
            dataType: "json",
            success: function (html) {
                $('#session_Date').val(html.data.session_date);
                $('#sessionId').val(html.data.id);
                $('.modal-title').text(config.trans.edit_session_modal_title);
                $('#add_session').val(config.trans.edit_public);
                $('#add_session_model').modal('show');
            }
        })
    });

    //update session status
    $(document).on('click', '#change-session-status', function () {
        var id = $(this).data('session-id');
        $.ajax({
            url: config.routes.update_case_session_status + "/" + id,
            dataType: "json",
            success: function (html) {
                $('#sessions_table').DataTable().ajax.reload();
                if (html.status) {
                    toastr.success(html.msg);
                } else {
                    toastr.error(html.msg);
                }
            }
        })
    });
    $(document).on('click', '#deleteSession', function () {
        session_id = $(this).data('session-id');
        who_delete = "session";
        $('#confirmModal').modal('show');
    });
    //end sessions

    //start for session notes
    //get notes for one session
    $(document).on('click', '#showSessionNotes', function () {
        // $('#session-notes-table tbody tr').remove();
        $("#session-notes-table").dataTable().fnDestroy();
        session_id = $(this).data('session-id');
        var href = config.routes.print_session_note + "/" + session_id;
        $('#btnPrintNotes').attr("href", href);
        $('#session-notes-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: config.routes.get_session_notes + "/" + session_id,
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    className: 'center'
                },
                {
                    data: 'note',
                    name: 'note',
                    className: 'center'
                }, {
                    data: 'status',
                    name: 'status',
                    className: 'center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    className: 'center'
                }
            ]
        });
    });

    //show modal form for adding notes
    $('#addNotesModal').click(function () {
        if (session_id != null) {
            $('#session_Id').val(session_id);
            $('#modal_title').text(config.trans.search_case_case_add_note);
            $('#add_note').val(config.trans.public_add_btn_text);
            $('#add_note_model').modal('show');
        } else {
            toastr.error(config.trans.search_case_session_id_warning_text);
        }
    });
    $(document).on('click', '#editNote', function () {
        var id = $(this).data('notes-id');
        $.ajax({
            url: "/notes/" + id + "/edit",
            dataType: "json",
            success: function (html) {
                $('#note').val(html.data.note);
                $('#noteId').val(html.data.id);
                $('.modal-title').text(config.trans.search_case_session_modal_title_edit);
                $('#add_note').val(config.trans.public_edit_btn_text);
                $('#add_note_model').modal('show');

            }
        })
    });
    $(document).on('click', '#deleteNote', function () {
        note_id = $(this).data('notes-id');
        who_delete = "note";
        $('#confirmModal').modal('show');
    });
    $(document).on('click', '#change-note-status', function () {
        var id = $(this).data('notes-id');
        $.ajax({
            url: config.routes.update_session_note_status + "/" + id,
            dataType: "json",
            success: function (html) {
                $('#session-notes-table').DataTable().ajax.reload();
                if (html.status) {
                    toastr.success(html.msg);
                } else {
                    toastr.error(html.msg);
                }
            }
        })
    });
    //print session Notes
    $(document).on('click', '#printNotes', function () {
        window.location.href = "notes/exportNotes/" + session_id;
    });

    //clients operations
    // delete mokel
    $(document).on('click', '#deleteClient', function () {
        who_delete_text = $(this).data('client-type');
        if ($(this).data('client-type') === config.trans.clients_client_type_client) {
            if (client_count > 1) {
                client_id = $(this).data('mokel-id');
                who_delete = "clients";
                $('#confirmModal').modal('show');

            } else {
                toastr.error(config.trans.delete_client_warning);
            }
        } else {
            if (khesm_count > 1) {
                client_id = $(this).data('mokel-id');
                who_delete = "clients";
                $('#confirmModal').modal('show');
            } else {
                toastr.error(config.trans.delete_khesm_warning);
            }

        }
    });
    // show mokel modal
    $('#addMokelModal').click(function () {
        $('.js-example-basic-multiple').empty();
        $('.js-example-basic-multiple').val("");
        $.ajax({
            url: config.routes.get_client_for_case,
            dataType: "json",
            success: function (html) {
                $('.js-example-basic-multiple').append(html.result);
                $('.modal-title').text(config.trans.clients_add_new_client_text);
                $('#add_mokel').val(config.trans.search_case_add_client);
                $('#add_new_mokel_modal').modal('show');
            }
        })
    });
    // show khesm modal
    $('#addKhesmModal').click(function () {
        $('.js-example-basic-multiple').empty();
        $('.js-example-basic-multiple').val("");
        $.ajax({
            url: config.routes.get_khesm_for_case,
            dataType: "json",
            success: function (html) {
                $('.js-example-basic-multiple').append(html.result);
                $('.modal-title').text(config.trans.clients_add_new_khesm_text);
                $('#add_mokel').val(config.trans.search_case_add_khesm);
                $('#add_new_mokel_modal').modal('show');

            }
        })
    });
    $('#add_mokel').click(function () {
        var form = $('#addMokelForm').serialize();
        $.ajax({
            url: config.routes.add_new_client,
            dataType: 'json',
            data: form,
            type: 'post'
            , success: function (data) {
                $('#add_new_mokel_modal').modal('hide');
                if ($('#add_mokel').val() == config.trans.search_case_add_client) {
                    $('#mokel_table').prepend(data.result);
                    client_count = client_count + 1;
                } else {
                    $('#khesm_table').prepend(data.result);
                    khesm_count = khesm_count + 1;
                }
                toastr.success(data.msg);
            }, error: function (data_error, exception) {
                if (exception == 'error') {
                    $('#mokel_error').html(data_error.responseJSON.errors.mokel_name);
                }
            }
        });

    });
    $('#ok_button').click(function () {
        if (who_delete == "session") {
            $.ajax({
                url: config.routes.delete_case_session + "/" + session_id,
                beforeSend: function () {
                    $('#ok_button').text(config.trans.public_continue_delete_modal_text);
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#sessions_table').DataTable().ajax.reload();
                        $('#ok_button').text(config.trans.public_delete_text);
                    }, 1000);
                }, error: function (data_error, exception) {
                    $('#confirmModal').modal('hide');
                    $('#ok_button').text(config.trans.public_delete_text);
                    toastr.error(config.trans.search_case_delete_session_text);
                }
            })
        } else if (who_delete == "clients") {
            $.ajax({
                url: config.routes.delete_clients + "/" + client_id,
                beforeSend: function () {
                    $('#ok_button').text(config.trans.public_continue_delete_modal_text);
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#userRow' + client_id).remove();
                        console.log(who_delete_text);
                        if (who_delete_text === config.trans.clients_client_type_client) {
                            client_count = client_count - 1;
                        } else {
                            khesm_count = khesm_count - 1;
                        }
                        $('#ok_button').text(config.trans.public_delete_text);
                    }, 1000);
                }
            })
        } else if (who_delete == "note") {
            $.ajax({
                url: config.routes.delete_session_note + "/" + note_id,
                beforeSend: function () {
                    $('#ok_button').text(config.trans.public_continue_delete_modal_text);
                },
                success: function (data) {
                    setTimeout(function () {
                        $('#confirmModal').modal('hide');
                        $('#session-notes-table').DataTable().ajax.reload();
                        $('#ok_button').text(config.trans.public_delete_text);
                    }, 1000);
                }
            })
        }
    });

});
$(document).ready(function () {
    $(".modal").on("hidden.bs.modal", function () {
        $("#sessionForm").trigger('reset');
    });
});
