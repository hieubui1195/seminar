$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
$('body').on('click', '#btn-save-editor', function (event) {
    event.preventDefault();
    var seminarId = $('#seminar-id').val(),
        report = CKEDITOR.instances['editor'].getData();

    save(seminarId, report);
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
