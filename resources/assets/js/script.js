$('.logout').on('click', function(event) {
    event.preventDefault();
    $('#logout-form').submit();
})

var dataTable = function(table) {
    $(table).DataTable();
}
