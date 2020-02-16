function result() {

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
    console.log(localStorage.getItem(('geocodeMap')));



    var url = "/api/?loisirpositionLat=" +  $_GET('loisirpositionLat') + "&loisirpositionLng=" + $_GET('loisirpositionLng') + "&budget=20" + "&Distance=0.10";

    if($_GET('Distance') <= 0.10) { var zoom = 12}
    if($_GET('Distance') == 0.20) { var zoom = 10}
    if($_GET('Distance') == 0.56) { var zoom = 9}
    if($_GET('Distance') == 1.10) { var zoom = 8}


    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: zoom,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: {   lat: parseFloat($_GET('loisirpositionLat')),
            lng: parseFloat($_GET('loisirpositionLng'))
        }
    });

    // Modifi le cluster
    var image = '/images/cycles.png';
    var image1 = '../images/Calque0.png';
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
                document.getElementById('infoLoisirs').style.display = "block";
                document.getElementById('map').style.width = "80%";
                document.getElementById('infoLoisirs').innerHTML = '<img id="imageMap" src=' + object.image + ' alt=Aperçu><br />' + object.address + object.name;
            });

            // la fonction push me ser a exporter des données pour qui puisse être réutiliser.
            locations.push({
                lat: object.position.lat,
                lng: object.position.lng,

            });

        });


    });
}
var locations = []