function map() {

    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 48.9240588, lng: 2.4741888999999997},
        zoom: 6
    });


    var image = '/images/cycles.png';
    // Try HTML5 geolocation.
    if (navigator.geolocation) {

        var infoWindow = new google.maps.InfoWindow({map: map});

        navigator.geolocation.getCurrentPosition(function (position) {

            // redirection pour pointer dans la section map
            document.location.href = "#map";

            // Pour afficher ma position actuel
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var map = new google.maps.Map(document.getElementById('map'), {

                zoom: 12
            });

            infoWindow.setPosition(pos);
            infoWindow.setContent('Vous êtes ICI.');
            map.setCenter(pos);


            // Position du marker cercle
            var marker = new google.maps.Marker({
                position: pos,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 90,
                    strokeOpacity: 0.2,
                },
                draggable: true,
                map: map
            });


            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            console.log("/api/?loisirpositionLat=" +  position.coords.latitude + "&loisirpositionLng=" + position.coords.longitude + "&budget=20" + "&Distance=0.10");

            var urlLocalisation = "/api/?loisirpositionLat=" +  position.coords.latitude + "&loisirpositionLng=" + position.coords.longitude + "&budget=200" + "&Distance=0.10";

            // Appel ajax avec une boucle foreach pour affiche la listes des activités sur google map
            ajaxGet(urlLocalisation, function (reponse) {

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
                        if(window.innerWidth < 700 ) {
                            document.getElementById('map').style.width = "100%";
                            document.getElementById('infoLoisirs').style.width = "100%";
                        }
                        document.getElementById('infoLoisirs').innerHTML = '<img id="imageMap" src=/images/' + object.image + ' alt=Aperçu><br />' + '<h4>' + object.name + '</h4>' + '<br />' + '<a href="https://www.cadito.fr/sejours/' + object.id + '?positionL=' + object.position.lat + '&positionN=' + object.position.lng + '" >' + '<p class="reserver">Plus d\'info</p>' + '</a>';

                    });

                    // la fonction push me ser a exporter des données pour qui puisse être réutiliser.
                    locations.push({
                        lat: object.position.lat,
                        lng: object.position.lng,

                    });

                });


            });
        });

        var locations = [];

    } else {
        // Browser doesn't support Geolocation
        document.getElementById('infoLoisirs').innerHTML = "La géolocalisation n'est pas supporter par votre navigateur";
        document.getElementById('infoLoisirs').innerHTML = '<p class="reserver">Activer le GPS</p>';
    }

}


(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.12';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



