var seminar = function () {
    this.init = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

        this.addEvent();
        this.scrollTop();
        var seminarId = $('body input[name="seminarId"]').val();
        this.echo(seminarId);
    };

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

        $('body').on('keyup', '#message-to-send', function(event) {
            if (event.keyCode === 13) {
                var seminarId = $('body input[name="seminarId"]').val(),
                    message = $('body #message-to-send').val();
                
                if (message.length != 0) {
                    current.sendMessage(seminarId, message);
                    current.scrollTop();
                };
            }
        });
    };

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
            error: function(result)
            {
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
    };

    this.sendMessage = function(seminarId, message) {
        var current = this,
            userId = $('body input[name="userId"]');
        $.ajax({
            url: '/message',
            type: 'POST',
            data: {
                seminarId: seminarId,
                message: message
            },
            dataType: 'JSON',
            success: function(result) {
                if (result.status == 1) {
                    current.getMessage(result.id, userId);
                    $('body #message-to-send').val('');
                }
            },
            error: function(result) {
                console.log(result);
            },
            complete: function() {
                var chatHistory = $('body .chat-history');
                chatHistory.scrollTop(chatHistory[0].scrollHeight);
            }
        });
    };

    this.scrollTop = function() {
        var chatHistory = $('body .chat-history');
        chatHistory.scrollTop(chatHistory[0].scrollHeight);
    };

    this.getMessage = function(messageId, currentUser) {
        var current = this;
        $.ajax({
            url: '/message/' + messageId,
            type: 'GET',
            data: { messageId: messageId },
            dataType: 'JSON',
            success: function(result) {
                console.log(result);
                current.addMessageElement(currentUser, result);
                current.scrollTop();
            },
            error: function(result) {
                console.log(result);
            }
        });
    };

    this.addMessageElement = function(currentUser, message) {
        var element = '';
        if (message[0][0]['user_id'] != currentUser) {
            element = '<li class="clearfix"><div class="message-data align-right">'
                            + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                            + '<span class="message-data-name">' + message[0][0]['user']['name'] + '</span> <i class="fa fa-circle me"></i></div>'
                            + '<div class="message other-message float-right">' + message[0][0]['message'] + '</div></li>';
            $('body .chat-history ul').append(element);
        } else {
            element = '<li class="clearfix"><div class="message-data">'
                            + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                            + '<span class="message-data-name">' + message[0][0]['user']['name'] + '</span> <i class="fa fa-circle online"></i></div>'
                            + '<div class="message my-message">' + message[0][0]['message'] + '</div></li>';
            $('body .chat-history ul').append(element);
        }
    };
}
