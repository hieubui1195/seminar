$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

scrollTop();
var seminarId = $('body input[name="seminarId"]').val();
var userId = $('body input[name="userId"]').val();
echo(seminarId, userId);

$('body').on('keyup', '#message-to-send', function(event) {
    if (event.keyCode === 13) {
        var seminarId = $('body input[name="seminarId"]').val(),
            message = $('body #message-to-send').val();
        
        if (message.length != 0) {
            sendMessage(seminarId, message);
            scrollTop();
        };
    }
});

$('body').on('click', '#btn-more-info', function(event) {
    event.preventDefault();
    $('#modal-seminar-info').modal('show');
});

$('body').on('submit', '#form-validate', function(event) {
    event.preventDefault();
    var inputCode = $('body #input-code').val();
    validate(seminarId, inputCode);
});

$('body').on('click', '.btn-delete-seminar', function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    swal({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            deleteSeminar(id);
        }
    });
});

function sendMessage(seminarId, message) {
    var userId = $('body input[name="userId"]');
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
                getMessage(result.id, userId);
                $('body #message-to-send').val('');
            }
        },
        error: function(result) {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        },
        complete: function() {
            var chatHistory = $('body .chat-history');
            chatHistory.scrollTop(chatHistory[0].scrollHeight);
        }
    });
}

function scrollTop() {
    var chatHistory = $('body .chat-history');
    if (chatHistory.length) {
        chatHistory.scrollTop(chatHistory[0].scrollHeight);
    }
}

function getMessage(messageId, currentUser) {
    $.ajax({
        url: '/message/' + messageId,
        type: 'GET',
        data: { messageId: messageId },
        dataType: 'JSON',
        success: function(result) {
            addMessageElement(currentUser, result);
            scrollTop();
        },
        error: function(result) {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        }
    });
}

function addMessageElement(currentUser, message) {
    var element = '';
    if (message[0][0]['user_id'] != currentUser) {
        element = '<li class="clearfix"><div class="message-data align-right">'
                        + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                        + '<span class="message-data-name"><a href="/user/' + message[0][0]['user']['id'] + '">'
                        + message[0][0]['user']['name'] + '</a></span> <i class="fa fa-circle me"></i></div>'
                        + '<div class="message other-message float-right">' + message[0][0]['message'] + '</div></li>';
        $('body .chat-history ul').append(element);
    } else {
        element = '<li class="clearfix"><div class="message-data">'
                        + '<span class="message-data-time">' + message[0][0]['created_at'] + '</span> &nbsp; &nbsp;'
                        + '<span class="message-data-name"><a href="/user/' + message[0][0]['user']['id'] + '">'
                        + message[0][0]['user']['name'] + '</a></span> <i class="fa fa-circle online"></i></div>'
                        + '<div class="message my-message">' + message[0][0]['message'] + '</div></li>';
        $('body .chat-history ul').append(element);
    }
}

function echo(seminarId, userId) {
    const app = new Vue({
        el: '#app',
        created() {
            Echo.private('message' + seminarId)
                .listen('MessageSentEvent', (e) => {
                    if (userId != e['message']['user_id']) {
                        var element = '<li class="clearfix"><div class="message-data">'
                                        + '<span class="message-data-time">' + e['message']['created_at'] + '</span> &nbsp; &nbsp;'
                                        + '<span class="message-data-name"><a href="/user/' + e['user']['id'] + '">'
                                        + e['user']['name'] + '</a></span> <i class="fa fa-circle online"></i></div>'
                                        + '<div class="message my-message">' + e['message']['message'] + '</div></li>';
                        $('body .chat-history ul').append(element);
                        scrollTop();
                    }
                });
        }
    });
}

function validate(seminarId, inputCode) {
    $.ajax({
        url: '/seminar/validate/' + seminarId,
        type: 'POST',
        dataType: 'JSON',
        data: {
            seminarId: seminarId,
            inputCode: inputCode
        },
        success: function(result) {
            if (result.status == 1) {
                location.reload();
                swal(
                    result.msgTitle,
                    result.msgContent,
                    'success'
                );
                scrollTop();
            } else if (result.status == 0) {
                swal(
                    result.msgTitle,
                    result.msgContent,
                    'error'
                );
            }
        },
        error: function(result) {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        }
    });
}

function getSeminarInfo(seminarId) {
    $.ajax({
        url: '/seminar/info/' + seminarId,
        type: 'POST',
        dataType: 'JSON',
        data: {
            seminarId: seminarId
        },
        error: function(result) {
            swal({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        }
    });
}

function deleteSeminar(seminarId) {
    var ajaxDeleteSeminar = $.ajax({
        url: '/seminar/' + seminarId,
        type: 'DELETE',
        dataType: 'JSON',
    });

    ajaxDeleteSeminar.done(function(data) {
        if (data.status == 1) {
            swal({
                title: data.msgTitle,
                text: data.msgContent,
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.value) {
                    var pathname = window.location.pathname,
                        fullurl = window.location.href,
                        href = fullurl.replace(pathname, '') + '/seminar';
                    window.location.href = href;
                }
            });
        }
    });
}
