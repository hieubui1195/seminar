$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var seminarId = $('#seminar-id').val();

$('body').on('click', '#btn-save-editor', function(event) {
    event.preventDefault();
    var report = CKEDITOR.instances['editor'].getData();

    save(seminarId, report);
});

$('body').on('click', '#btn-publish-report', function(event) {
    event.preventDefault();
    publishReport(seminarId);
});

function save(seminarId, report) {
    $.ajax({
        url: '/seminar/editor/' + seminarId,
        type: 'POST',
        dataType: 'JSON',
        data: {
            seminarId: seminarId,
            report: report
        },
        success: function(result) {
            if (result.status == 1) {
                swal(
                    result.msgTitle,
                    result.msgContent,
                    'success'
                )
            }
        },
        error: function(result) {
            swal(
                'Error',
                result.responseText,
                'error'
            )
        }
    });
}

function publishReport(seminarId) {
    $.ajax({
        url: '/seminar/report/publish/' + seminarId,
        type: 'POST',
        dataType: 'JSON',
        data: { seminarId: seminarId },
        success: function(result) {
            if (result.status == 1) {
                swal(
                    result.msgTitle,
                    result.msgContent,
                    'success'
                )
            }
        },
        error: function(result) {
            swal(
                'Error',
                result.responseText,
                'error'
            )
        }
    });
}
