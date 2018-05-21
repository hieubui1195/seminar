$(document).ready(function() {
    $('.logout').on('click', function(event) {
        event.preventDefault();
        $('#logout-form').submit();
    })

    if ($('select').length > 0) {
        $('select').select2();
    } 
    if ($('.time').length > 0) {
        $('.time').daterangepicker({ 
            timePicker: true, 
            timePickerIncrement: 30, 
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
            },
            startDate: $('#start-seminar').val(),
            endDate: $('#end-seminar').val(), 
            function(start, end, label) {
                swal("A new date range was chosen: " 
                    + start.format('YYYY-MM-DD HH:mm:ss') 
                    + ' to ' 
                    + end.format('YYYY-MM-DD HH:mm:ss'));
            }
        });
    }

    if ($('table').length > 0) {
        $('table').DataTable();
    }
})
