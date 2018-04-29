var user = function () {
    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        this.addEvent();
    }

    this.addEvent = function() {
        var current = this;
        $('body').on('click', '#btn-add', function(event) {
            event.preventDefault();
            var formType = 'create',
                email = $('#modal-create input[name="email"]').val(),
                name = $('#modal-create input[name="name"]').val(),
                level = $('#modal-create select[name="level"]').val();
            $('.text-danger').remove();
            current.addUser(formType, email, name, level);
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
                    current.deleteUser(id);
                    
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
            current.updateUser(formType, id, name, password, password_confirmation, phone);
        })
    }

    this.addUser = function(formType, email, name, level) {
        $.ajax({
            url: '/user',
            type: 'POST',
            data: {
                formType: formType,
                email: email,
                name: name,
                level: level
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
                            location.reload();
                        }
                    });
                }
            },
            error: function(result)
            {
                var errors = JSON.parse(result.responseText);
                if (errors.errors.email) {
                    var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.email + '</b>')
                    $('#modal-create input[name="email"]').after(message);
                }

                if (errors.errors.name) {
                    var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.name + '</b>')
                    $('#modal-create input[name="name"]').after(message);
                }
            }
        });
    }

    this.deleteUser = function(id) {
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

    this.updateUser = function(formType, id, name, password, password_confirmation, phone) {
        // formData = new FormData();
        // formData.append('formType', formType);
        // formData.append('id', id);
        // formData.append('name', name);
        // formData.append('password', password);
        // formData.append('password_confirmation', password_confirmation);
        // formData.append('avatar', $('#image')[0].files[0]);
        // for (var pair of formData.entries())
        // {
        //  console.log(pair[0]+ ', '+ pair[1]); 
        // }
        $.ajax({
            url: '/user/' + id,
            type: 'PUT',
            data: {
                formType: formType,
                id: id,
                name: name,
                password: password,
                password_confirmation: password_confirmation,
                phone: phone,
                // avatar: $('#image')[0].files[0]
            },
            // enctype: 'multipart/form-data',
            // processData: false,
            // contentType: false,
            dataType: 'JSON',
            success: function(result) {
                if (result.status == 1) {
                    $('#modal-update').modal('hide');
                    swal('Success!', result.msg, 'success');
                    $('.profile-title').load(location.href + ' .profile-title');
                    $('.profile-name').load(location.href + ' .profile-name');
                    $('.profile-phone').load(location.href + ' .profile-phone');
                }
            },
            error: function(result) {
                var errors = JSON.parse(result.responseText);
                if (errors.errors.name) {
                    var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.name + '</b>')
                    $('#modal-update input[name="name"]').after(message);
                }

                if (errors.errors.password) {
                    var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.password + '</b>')
                    $('#modal-update input[name="password"]').after(message);
                }

                if (errors.errors.phone) {
                    var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.phone + '</b>')
                    $('#modal-update input[name="phone"]').after(message);
                }
            }
        });
    }
}
