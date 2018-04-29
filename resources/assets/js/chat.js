var chat = function () {
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
        $('body').on('submit', '#form-message', function (event) {
            event.preventDefault();
            var seminarId = $('body input[name="seminarId"]').val(),
                message = $('body #message-content').val();

            current.addMessage(seminarId, message);
        });
    }

    this.addMessage = function(seminarId, message) {
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
                    $('#chat-box').load(document.URL + ' #chat-box');
                }
            },
            error: function(result)
            {
                console.log(result);
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
}
