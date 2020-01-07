function show() {


    var image = '/images/cycles.png';

    // Fonction qui récupère les variables GET dans une url
    // Permet d'afficher le resultat de toute la base de données via google map
    function $_GET(param) {
        var vars = {};
        window.location.href.replace( location.hash, '' ).replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );

        if ( param ) {
            return vars[param] ? vars[param] : null;
        }
        return vars;
    }

    var latP = $_GET('positionL');
    var lngP = $_GET('positionN');

    var latt = Number(latP);
    var lngg = Number(lngP);

    var position = {lat: latt, lng: lngg};
    var map = new google.maps.Map(document.getElementById('map'), {
        icone:image,
        zoom: 15,
        center: position
    });
    var marker = new google.maps.Marker({
        icone:image,
        position: position,
        map: map
    });
}

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.12';
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
