function result() {

    console.log(localStorage.getItem(('geocodeMap')));

    if(localStorage.getItem(('geocodeMap')) !== 'undefined') {
        var url = "/api/" + localStorage.getItem(('geocodeMap')) + "&budget=20" + "&Distance=0.10";
        console.log("/api/" + localStorage.getItem(('geocodeMap')) + "&budget=20" + "&Distance=0.10");
    } else {
        console.log('get');
        var url = "/api/?loisirpositionLat=" +  $_GET('loisirpositionLat') + "&loisirpositionLng=" + $_GET('loisirpositionLng') + "&budget=20" + "&Distance=0.10";
    }


    if($_GET('Distance') <= 0.10) { var zoom = 12}
    if($_GET('Distance') == 0.20) { var zoom = 10}
    if($_GET('Distance') == 0.56) { var zoom = 9}
    if($_GET('Distance') == 1.10) { var zoom = 8}

    var premiercurser = 0;
    // Modifi le cluster
    var image = '/images/cycles.png';
    var image1 = '/images/Calque0.png';
    ajaxGet(url, function (reponse) {

        // Transforme la réponse en un tableau d'adresses
        var objects = JSON.parse(reponse);
        objects.forEach(function (object) {


            var paris = {
                lat: parseFloat(object.position.lat),
                lng: parseFloat(object.position.lng)
            }


            var marker = new google.maps.Marker({
                position: paris,
                map: map,
                icon:image,
                zIndex: 2000
            });

            marker.addListener('click', function () {
                console.log(object.name);
                    window.location = '#' + object.name;
                   });

            // la fonction push me ser a exporter des données pour qui puisse être réutiliser.
            locations.push({
                lat: object.position.lat,
                lng: object.position.lng,

            });

            if(premiercurser < 1) {
                premiercurser++;
                localStorage.setItem('geocodeLat', object.position.lat);
                localStorage.setItem('geocodeLng', object.position.lng);
                console.log(object.position.lat);
            }
        });



    });

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: {   lat: parseFloat(lat),
            lng: parseFloat(lng)
        }
    });

    var locations = []
}

function $_GET(param) {
    var vars = {};
    window.location.href.replace(location.hash, '').replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function (m, key, value) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );

    if (param) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}

console.log(localStorage.getItem('geocodeLat'));

if($_GET('loisirpositionLat') !== 'undefined' && $_GET('loisirpositionLng') !== 'undefined') {
    var lat = localStorage.getItem('geocodeLat');
    var lng = localStorage.getItem('geocodeLng');
} else {
    var lat = $_GET('loisirpositionLat');
    var lng = $_GET('loisirpositionLng');
}