$(document).ready(function () {
    $('#cases').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: config.routes.get_cases_route,
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                className: 'center'
            },
            {
                data: 'client_Name',
                name: 'client_Name',
                className: 'center'
            }, {
                data: 'khesm_Name',
                name: 'khesm_Name',
                className: 'center'
            }, {
                data: 'invetation_num',
                name: 'invetation_num',
                className: 'center'
            }, {
                data: 'court',
                name: 'court',
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
