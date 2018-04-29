var seminar = function () {
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
        $('body').on('submit', '#form-create-seminar', function(event) {
            event.preventDefault();
            var formType = $('#modal-create input[name="formType"]').val(),
                name = $('#modal-create input[name="name"]').val(),
                chairman = $('#modal-create select[name="selectChairman"]').val(),
                time = $('#modal-create input[name="time"]').val(),
                description = $('#modal-create textarea[name="description"]').val(),
                members = $('#modal-create select[name="members[]"]').val();

            $('.text-danger').remove();
            current.addSeminar(formType, name, chairman, description, time, members);
        });

        // $('body').on('click', '.btn-delete', function(event) {
        //     event.preventDefault();
        //     var id = $(this).data('id');
        //     swal({
        //         title: 'Are you sure?',
        //         text: "You won't be able to revert this!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             current.deleteUser(id);
                    
        //         }
        //     })
        // });

        // $('body').on('click', '#choose-avatar', function() {
        //     $('#image').click();
        // });

        // $('body').on('change', '#image', function () {
        //     if (typeof (FileReader) != 'undefined') {
        //         var dvPreview = $('#image-preview');
        //         dvPreview.html('');
        //         var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        //         $($(this)[0].files).each(function () {
        //             var file = $(this);
        //             if (regex.test(file[0].name.toLowerCase())) {
        //                 var reader = new FileReader();
        //                 reader.onload = function (e) {
        //                     var img = $('<img >');
        //                     img.attr('src', e.target.result);
        //                     img.attr('class', 'img-responsive img-circle');
        //                     dvPreview.append(img);
        //                 }
        //                 reader.readAsDataURL(file[0]);
        //             } else {
        //                 swal(file[0].name + ' is not a valid image file.');
        //                 dvPreview.html('');
        //                 $('#image-preview').load(location.href + ' #image-preview')
        //                 return false;
        //             }
        //         });
        //     } else {
        //         swal('This browser does not support HTML5 FileReader.');
        //     }
        // });

        // $('body').on('click', '#btn-update', function(event) {
        //     event.preventDefault();
        //     var formType = 'update',
        //         id = $('#modal-update input[name="userId"]').val(),
        //         name = $('#modal-update input[name="name"]').val(),
        //         password = $('#modal-update input[name="password"]').val(),
        //         password_confirmation = $('#modal-update input[name="password_confirmation"]').val(),
        //         phone = $('#modal-update input[name="phone"]').val(),
        //         avatar = $('#modal-update input[name="avatar"]').val();
        //     $('.text-danger').remove();
        //     current.updateUser(formType, id, name, password, password_confirmation, phone);
        // })
    }

    this.addSeminar = function(formType, name, chairman, description, time, members) {
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
                console.log(result);
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
                console.log(result);
                // var errors = JSON.parse(result.responseText);
                // if (errors.errors.email) {
                //     var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.email + '</b>')
                //     $('#modal-create input[name="email"]').after(message);
                // }

                // if (errors.errors.name) {
                //     var message = $('<span class="text-danger"></span>').html('<b>' + errors.errors.name + '</b>')
                //     $('#modal-create input[name="name"]').after(message);
                // }
            }
        });
    }
}
