$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('body').on('click', '.not-viewed', function(event) {
    event.preventDefault();
    var href = $(this).attr('href'),
        id = $(this).attr('data-id');

    var ajaxViewNotification = $.ajax({
        url: '/notification/view',
        type: 'POST',
        dataType: 'JSON',
        data: {id: id},
    });

    ajaxViewNotification.done(function() {
        location.href = href;
    });
});

$('body').on('click', '#marked-all', function(event) {
    var ajaxMarkedAll = $.ajax({
        url: '/notification/marked',
        type: 'POST',
        dataType: 'HTML'
    });

    ajaxMarkedAll.done(function(result) {
        $('#notification-list').html(result);
        $('.count-notification').remove();
    });
});
