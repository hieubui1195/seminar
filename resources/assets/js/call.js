var config = {
    apiKey: "AIzaSyAi2YNagT8DE8BusrJg4vDj91tyAlz4TrI",
    authDomain: "seminar-8448e.firebaseapp.com",
    databaseURL: "https://seminar-8448e.firebaseio.com",
    projectId: "seminar-8448e",
    storageBucket: "",
    messagingSenderId: "915525042957"
};
firebase.initializeApp(config);

document.getElementsByTagName('body').onload = showMyFace();
var callerId = $('#current-user').val(),
    receiverId = $('#receiver-id').val();
var callId;
var database = firebase.database().ref();
var yourVideo = document.getElementById('your-video');
var friendsVideo = document.getElementById('friends-video');
var yourId = $('#current-user').val();
var servers = {'iceServers': [
    {'urls': 'stun:stun.services.mozilla.com'},
    {'urls': 'stun:stun.l.google.com:19302'}
]};
var pc = new RTCPeerConnection(servers);
pc.onicecandidate = (event => event.candidate?sendMessage(yourId, JSON.stringify({'ice': event.candidate})):console.log("Sent All Ice") );
pc.onaddstream = (event => friendsVideo.srcObject = event.stream);

function sendMessage(senderId, data) {
    var msg = database.push({ sender: senderId, message: data });
    msg.remove();
}

database.on('child_added', readMessage);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('body').on('click', '#btn-call', function(event) {
    event.preventDefault();
    showFriendsFace(callerId, receiverId);
});

$('body').on('click', '#btn-publish-report-call', function(event) {
    event.preventDefault();
    var report = CKEDITOR.instances['editor'].getData();
    publishReport(report);
});

$('body').on('click', '#btn-finish', function(event) {
    event.preventDefault();
    pc.close();
    location.href = '/home';
});

function readMessage(data) {
    var msg = JSON.parse(data.val().message);
    var sender = data.val().sender;
    if (sender != yourId) {
        if (msg.ice != undefined) {
            pc.addIceCandidate(new RTCIceCandidate(msg.ice));
        } else if (msg.sdp.type == 'offer') {                        
            swal({
                title: 'Call notification?',
                text: 'You have a call to come from ' + sender + '. Do you want to accept?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, accept it!'
            }).then((result) => {
                if (result.value) {
                    pc.setRemoteDescription(new RTCSessionDescription(msg.sdp))
                        .then(() => pc.createAnswer())
                        .then(answer => pc.setLocalDescription(answer))
                        .then(() => sendMessage(yourId, JSON.stringify({'sdp': pc.localDescription})));
                    approveCall(callId);
                } else {
                    swal(
                        'Error!',
                        'Rejected the call.',
                        'error'
                    );
                    
                }
            });
        } else if (msg.sdp.type == 'answer') {
            pc.setRemoteDescription(new RTCSessionDescription(msg.sdp));
        }
    }
};

function showMyFace() {
    navigator.mediaDevices.getUserMedia({audio:true, video:true})
        .then(stream => yourVideo.srcObject = stream)
        .then(stream => pc.addStream(stream));
}

var fetchData = function(dataURL) {
    return $.ajax({
        url: dataURL,
        type: 'POST',
        dataType: 'JSON',
        data: {
            callerId: callerId,
            receiverId: receiverId
        },
    });
}

function showFriendsFace(callerId, receiverId) {
    var ajaxCall = fetchData('/user/call-noti/' + callerId + '/' + receiverId);
    ajaxCall.fail(function() {
        swal(
            'Error!',
            'Some errors have occurred.',
            'error'
        );
    });

    var ajaxCreateCall = fetchData('/create-call');

    $.when(ajaxCall, ajaxCreateCall).done(function(result1, result2) {
        pc.createOffer()
            .then(offer => pc.setLocalDescription(offer) )
            .then(() => sendMessage(yourId, JSON.stringify({'sdp': pc.localDescription})) );
    })
}

function approveCall() {
    var callerId = getURLParameter('caller'),
        receiverId = getURLParameter('receiver');
    fetchData('/update-call')
}

function getURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++){
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam)
        {
            return sParameterName[1];
        }
    }
}

function publishReport(report) {
    var callerId = getURLParameter('caller'),
        receiverId = getURLParameter('receiver');
    var ajaxGetCallId = fetchData('/call/get');

    var ajaxPublishReport = ajaxGetCallId.then(function(data) {
        return $.ajax({
            url: '/call/publish',
            type: 'POST',
            dataType: 'JSON',
            data: {
                reportId: data.id,
                report: report
            }
        });
    });

    ajaxPublishReport.done(function(data) {
        if (data.status == 1) {
            swal(
                data.msgTitle,
                data.msgContent,
                'success'
            );
        }
    });
}

function getSender(userId) {
    var ajaxGetSender = $.ajax({
        url: '/user/' + userId,
        type: 'GET',
        dataType: 'JSON',
        data: { userId: userId }
    });

    ajaxGetSender.done(function(data) {
        return data;
    });
}
