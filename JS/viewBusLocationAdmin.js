var map;
var mark;
var lineCoords = [];

window.lat = 2.97690;
window.lng = 101.72812857567598;


const firebaseConfig = {
    apiKey: "AIzaSyAg8iVwGi-X6dJCe15dvavK0ndAoVPutsA",
    authDomain: "university-bus-system.firebaseapp.com",
    databaseURL: "https://university-bus-system-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "university-bus-system",
    storageBucket: "university-bus-system.appspot.com",
    messagingSenderId: "446380655695",
    appId: "1:446380655695:web:ee019fad4684435252163a"
}

firebase.initializeApp(firebaseConfig);

var ref = firebase.database().ref('gps');

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: lat,
            lng: lng
        },
        zoom: 18
    });

    var busIcon = {
        url: 'https://cdn-icons-png.flaticon.com/512/5030/5030991.png',
        scaledSize: new google.maps.Size(50, 50),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(25, 25)
    };

    mark = new google.maps.Marker({
        position: {
            lat: lat,
            lng: lng
        },
        map: map,
        title: 'UNITEN',
        icon: busIcon
    });
}

ref.on("value", function (snapshot) {
    var gps = snapshot.val();
    console.log(gps.latitude);
    console.log(gps.longitude);

    if (map && mark) {
        map.setCenter({
            lat: gps.latitude,
            lng: gps.longitude
        });

        mark.setPosition({
            lat: gps.latitude,
            lng: gps.longitude
        });


        lineCoords.push(new google.maps.LatLng(gps.latitude, gps.longitude));

        var lineCoordinatesPath = new google.maps.Polyline({
            path: lineCoords,
            geodesic: true,
            strokeColor: '#2E10FF'
        });

        lineCoordinatesPath.setMap(map);
    }
});

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAm_aJ9lxcthdOugBg_c8q-P-vvT12ULMA&callback=initMap"></script>