<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css">
        video {
            background-color: #ddd;
            border-radius: 7px;
            margin: 10px 0px 0px 10px;
            width: 320px;
            height: 240px;
        }
        button {
            margin: 5px 0px 0px 10px !important;
            width: 654px;
        }
    </style>
</head>
    <body onload="showMyFace()">

        <video id="yourVideo" autoplay muted></video>
        <video id="friendsVideo" autoplay class="friendsVideo"></video>
        <video autoplay class="friendsVideo"></video>
        <br />
        <button onclick="showFriendsFace()" type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span> Call</button>

    <script type="text/javascript" src="{{ asset('bower/firebase/firebase.js') }}"></script>
    <script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyAi2YNagT8DE8BusrJg4vDj91tyAlz4TrI",
        authDomain: "seminar-8448e.firebaseapp.com",
        databaseURL: "https://seminar-8448e.firebaseio.com",
        projectId: "seminar-8448e",
        storageBucket: "",
        messagingSenderId: "915525042957"
    };
    firebase.initializeApp(config);

    var database = firebase.database().ref();
    var yourVideo = document.getElementById('yourVideo');
    var friendsVideo = document.getElementsByClassName('friendsVideo');
    var yourId = Math.floor(Math.random()*1000000000);
    var servers = {'iceServers': [{'urls': 'stun:stun.services.mozilla.com'}, {'urls': 'stun:stun.l.google.com:19302'}]};
    var pc = new RTCPeerConnection(servers);
    pc.onicecandidate = (event => event.candidate ? sendMessage(yourId, JSON.stringify({'ice': event.candidate})) : console.log('Sent All Ice') );
    pc.ontrack = (event => {friendsVideo[0].srcObject = event.streams[0]});

    function sendMessage(senderId, data) {
        var msg = database.push({ sender: senderId, message: data });
        msg.remove();
    }

    function readMessage(data) {
        var msg = JSON.parse(data.val().message);
        var sender = data.val().sender;
        if (sender != yourId) {
            if (msg.ice != undefined) {
                pc.addIceCandidate(new RTCIceCandidate(msg.ice));
            } else if (msg.sdp.type == "offer") {
                var r = confirm("Answer call?");
                if (r == true) {
                    pc.setRemoteDescription(new RTCSessionDescription(msg.sdp))
                        .then(() => pc.createAnswer())
                        .then(answer => pc.setLocalDescription(answer))
                        .then(() => sendMessage(yourId, JSON.stringify({'sdp': pc.localDescription})));
                } else {
                    alert("Rejected the call");
                }
            } else if (msg.sdp.type == "answer") {
                pc.setRemoteDescription(new RTCSessionDescription(msg.sdp));
            }
        }
    };

    database.on('child_added', readMessage);

    function showMyFace() {
        navigator.mediaDevices.getUserMedia({audio:true, video:true})
            .then(stream => yourVideo.srcObject = stream)
            .then(stream => pc.addStream(stream));
    }

    function showFriendsFace() {
        pc.createOffer()
            .then(offer => pc.setLocalDescription(offer) )
            .then(() => sendMessage(yourId, JSON.stringify({'sdp': pc.localDescription})) );
    }
    </script>
    </body>
</html>
