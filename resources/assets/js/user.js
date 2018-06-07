$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click', '#btn-add', function(event) {
    event.preventDefault();
    var formType = 'create',
        email = $('#modal-create input[name="email"]').val(),
        name = $('#modal-create input[name="name"]').val(),
        level = $('#modal-create select[name="level"]').val();
    $('.text-danger').remove();
    addUser(formType, email, name, level);
});

$('body').on('click', '.btn-delete', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    swal({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            deleteUser(id);
            
        }
    })
});

$('body').on('click', '#choose-avatar', function() {
    $('#image').click();
});

$('body').on('change', '#image', function () {
    if (typeof (FileReader) != 'undefined') {
        var dvPreview = $('#image-preview');
        dvPreview.html('');
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        $($(this)[0].files).each(function () {
            var file = $(this);
            if (regex.test(file[0].name.toLowerCase())) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $('<img >');
                    img.attr('src', e.target.result);
                    img.attr('class', 'img-responsive img-circle');
                    dvPreview.append(img);
                }
                reader.readAsDataURL(file[0]);
            } else {
                swal(file[0].name + ' is not a valid image file.');
                dvPreview.html('');
                $('#image-preview').load(location.href + ' #image-preview')
                return false;
            }
        });
    } else {
        swal('This browser does not support HTML5 FileReader.');
    }
});

$('body').on('click', '#btn-update', function(event) {
    event.preventDefault();
    var formType = 'update',
        id = $('#modal-update input[name="userId"]').val(),
        name = $('#modal-update input[name="name"]').val(),
        password = $('#modal-update input[name="password"]').val(),
        password_confirmation = $('#modal-update input[name="password_confirmation"]').val(),
        phone = $('#modal-update input[name="phone"]').val(),
        avatar = $('#modal-update input[name="avatar"]').val();
    $('.text-danger').remove();
    updateUser(formType, id, name, password, password_confirmation, phone);
})

$('body').on('change', 'select.form-control', function(event) {
    event.preventDefault();
    var id = $(this).data('id'),
        currentRole = $(this).data('current-role'),
        role = $(this).val();
    if (role == currentRole) {
        swal('Warning!', 'The selected account is in this role!', 'warning');
    } else {
        changeRole(id, role);
    }
})

function deleteUser(id) {
    $.ajax({
        url: '/user/' + id,
        type: 'DELETE',
        data: {
            id: id
        },
        dataType: 'JSON',
        success: function(result) {
            swal({
                title: 'Success',
                text: result.msg,
                type: 'success',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            })
        },
        error: function(result) {
            swal(
                'Error!',
                result.responseText,
                'error'
            );
        }
    })
}

function changeRole(id, role) {
    var ajaxChangeRole = $.ajax({
        url: '/user/change-role/' + id,
        type: 'POST',
        data: {
            role: role
        },
        dataType: 'JSON'
    });

    ajaxChangeRole.done(function(data) {
        swal('Success!', 'The account has been changed role', 'success');
    });

    ajaxChangeRole.fail(function(data) {
        swal('Error!', 'Something error', 'error');
    });
}
