$(function () {
    'use strict';

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    if ($('#datePickerSession').length) {
        $('#datePickerSession').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });
        document.querySelector("input[type=text][id=first_session_date]")
            .setAttribute("placeholder", yyyy + "-" + mm + "-" + dd);
    }
    if ($('#datePickerDeliverData').length) {
        $('#datePickerDeliverData').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });
        document.querySelector("input[type=text][id=deliver_data]")
            .setAttribute("placeholder", yyyy + "-" + mm + "-" + dd);
    }
    if ($('#datePickerSessionMohderSession').length) {
        $('#datePickerSessionMohderSession').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });
        document.querySelector("input[type=text][id=session_Date]")
            .setAttribute("placeholder", yyyy + "-" + mm + "-" + dd);
    }
    if ($('#datePickerReports').length) {
        $('#datePickerReports').datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            autoclose: true
        });
        document.querySelector("input[type=text][id=search_daily]")
            .setAttribute("placeholder", yyyy + "-" + mm + "-" + dd);
    }

});
