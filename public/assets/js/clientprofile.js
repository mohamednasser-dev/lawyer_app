     $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        var id = $('#client_id').val();
        $('#clientnotes_tbl').DataTable({
            processing: true,
            serverSide: true,

            //

            ajax: {
                url: "/profile/" + id,
            },
            columns: [{
                    data: 'id',
                    name: 'id',

                    className: 'center'
                },
                {
                    data: 'notes',
                    name: 'notes',
                    className: 'center'
                },
                {
                    data: 'user_id.name',
                    name: 'user_id.name',
                    className: 'center'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    className: 'center'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    className: 'center'
                }
            ],

        });

    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {

        var id = $('#client_id').val();
        $('#clientcases_tbl').DataTable({
            processing: true,
            serverSide: true,

            ajax: {
                url: "/profile/client_cases/" + id,
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    className: 'center'
                },
                {
                    data: 'invetation_num',
                    name: 'invetation_num',
                    className: 'center'
                }, {
                    data: 'inventation_type',
                    name: 'inventation_type',
                    className: 'center'
                }, {
                    data: 'circle_num',
                    name: 'circle_num',
                    className: 'center'
                }, {
                    data: 'court',
                    name: 'court',
                    className: 'center'
                }, {
                    data: 'first_session_date',
                    name: 'first_session_date',
                    className: 'center'
                }, {
                    data: 'to_whome.name',
                    name: 'to_whome.name',

                    className: 'center'
                },

            ]

        });
    });






    // 

    var client_id;


    $('#createnote').click(function() {
        $('#createModal').modal('show');
        client_id = $('#client_id').val();
    });
    $('#client_note').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "/profile/store/" + client_id,
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success: function(data) {
                $('#createModal').modal('hide');
                toastr.success(data.success);
                $("#client_note").trigger('reset');
                $('#clientnotes_tbl').DataTable().ajax.reload();
            }
        })
    });



    var note_id;
    $(document).on('click', '#deletenote', function() {
        note_id = $(this).data('client-id');
        $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function() {
        $.ajax({
            url: "/profile/deletenote/" + note_id,
            success: function(data) {
                setTimeout(function() {
                    $('#confirmModal').modal('hide');
                    $('#clientnotes_tbl').DataTable().ajax.reload();
                }, 100);
            }
        })
    });

    $(document).on('click', '#editnote', function() {
        note_id = $(this).data('client-id');
        $.ajax({
            url: "/profile/" + note_id + "/edit_note",
            dataType: "json",
            success: function(html) {
                $('#note').val(html.data.notes);
                $('#id').val(html.data.id);
                $('#edit_note_model').modal('show');

            }
        })
    });
    $('#client_notes').on('submit', function(event) {
        //  note_ids = $(this).data('id');  
        console.log(note_id);
        event.preventDefault();
        $.ajax({
            url: "/profile/" + note_id + "/edit_notes",
            method: 'post',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",

            success: function(data) {
                $('#edit_note_model').modal('hide');
                toastr.success(data.success);
                $("#client_notes").trigger('reset');
                $('#clientnotes_tbl').DataTable().ajax.reload();
            }
        })
    });
 