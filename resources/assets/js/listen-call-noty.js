$(document).ready(function() {
    var currentUser = $('body #current-user-id').val();
    notifyCall(currentUser);
});

function notifyCall(currentUser) {
    const app = new Vue({
        el: '#app',
        created() {
            Echo.private('call')
                .listen('NotifyCallEvent', (e) => {
                    console.log(e);
                    if (currentUser == e['receiverId']) {
                        swal({
                            title: 'Call notification?',
                            text: 'You have a call to come from ' + e['caller']['name'] + '.',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, accept it!'
                        }).then((result) => {
                            if (result.value) {
                                location.href = '/user/video/' + e['receiverId'] + 
                                '?caller=' + e['caller']['id'] + '&receiver=' + e['receiverId'];
                            }
                        });
                    }
                });
        }
    });
}
