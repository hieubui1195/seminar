$('.logout').on('click', function(event) {
    event.preventDefault();
    $('#logout-form').submit();
})

$('select').select2();

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


// var dataTable = function(table) {
//     $(table).DataTable();
// }
