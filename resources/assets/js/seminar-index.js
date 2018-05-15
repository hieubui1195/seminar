$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('submit', '#form-create-seminar', function(event) {
    event.preventDefault();
    var formType = $('#modal-create input[name="formType"]').val(),
        name = $('#modal-create input[name="name"]').val(),
        chairman = $('#modal-create select[name="selectChairman"]').val(),
        time = $('#modal-create input[name="time"]').val(),
        description = $('#modal-create textarea[name="description"]').val(),
        members = $('#modal-create select[name="members[]"]').val();

    $('.text-danger').remove();
    console.log(formType+name+chairman+description+time+members);
    addSeminar(formType, name, chairman, description, time, members);
});

function addSeminar(formType, name, chairman, description, time, members) {
    $.ajax({
        url: '/seminar',
        type: 'POST',
        data: {
            formType: formType,
            name: name,
            chairman: chairman,
            description: description,
            time: time,
            members: members
        },
        dataType: 'JSON',
        success: function(result) {
            if (result.status == 1) {
                $('#modal-create').modal('hide');
                swal({
                    title: 'Success',
                    text: result.msg,
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        location.href("/seminar/" + id);
                    }
                });
            }
        },
        error: function(result) {
            var errors = JSON.parse(result.responseText);
            if (errors.errors.name) {
                var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.name + '</b>')
                $('#modal-create input[name="name"]').after(message);
            }

            if (errors.errors.chairman) {
                var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.chairman + '</b>')
                $('#modal-create input[name="selectChairman"]').after(message);
            }

            if (errors.errors.time) {
                var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.time + '</b>')
                $('#modal-create input[name="time"]').after(message);
            }

            if (errors.errors.members) {
                var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.members + '</b>')
                $('#modal-create select[name="members[]"]').after(message);
            }

            if (errors.errors.description) {
                var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.description + '</b>')
                $('#modal-create input[name="description"]').after(message);
            }
        }
    });
}
