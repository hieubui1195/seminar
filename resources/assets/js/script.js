$('.logout').on('click', function(event) {
    event.preventDefault();
    $('#logout-form').submit();
})

var dataTable = function(table) {
    $(table).DataTable();
}

var timerange = function(element) {
	$(element).daterangepicker({ 
        timePicker: true, 
        timePickerIncrement: 30, 
        locale: {
          	format: 'YYYY-MM-DD HH:mm:ss'
        },
        startDate: $('#start-date').val(),
        endDate: $('#end-date').val(), 
        function(start, end, label) {
            swal("A new date range was chosen: " 
                + start.format('YYYY-MM-DD HH:mm:ss') 
                + ' to ' 
                + end.format('YYYY-MM-DD HH:mm:ss'));
        }
    });
}

var multiselect = function(element) {
	$(element).select2();
}

