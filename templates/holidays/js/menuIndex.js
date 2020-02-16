function Menu() {

    this.scroll = function () {

        // Le menu scrollbas apparait que que lorsque l'utilisateur est sur un ordinateur
        if (window.innerWidth > 700) {
            if (window.scrollY > 50) {
                document.getElementById('menu-header').style.backgroundColor = "white";
                document.getElementsByClassName('title')[0].style.color = "black";
                document.getElementsByClassName('blue')[1].style.color = "black";
                document.getElementsByClassName('blue')[2].style.color = "black";
                document.getElementsByClassName('blue')[3].style.color = "black";
            }
            if (window.scrollY < 50) {
                document.getElementById('menu-header').style.backgroundColor = "rgba(145, 145, 145, 0)";
                document.getElementsByClassName('title')[0].style.color = "white";
                document.getElementsByClassName('blue')[1].style.color = "white";
                document.getElementsByClassName('blue')[2].style.color = "white";
                document.getElementsByClassName('blue')[3].style.color = "white";

            }
        }

    };

    this.mobile = function () {
        document.getElementById('deroul-menu').style.display = "block";
        document.getElementById('menu-mobile').style.display = "none";
        document.getElementById('menu-close').style.display = "block";
    };

    this.closeMenu = function () {
        document.getElementById('deroul-menu').style.display = "none";
        document.getElementById('menu-mobile').style.display = "block";
        document.getElementById('menu-close').style.display = "none";
    };

    this.openDate = function () {
        console.log("menue activer");
        document.getElementById('outils-recherche').style.display = "initial";
        document.getElementById('date-open').style.display = "none";

    };

}

var menuAccueil = new Menu();
var menuOpen = new Menu();

menuAccueil.scroll();
document.getElementById('menu-mobile').addEventListener('click', menuAccueil.mobile, false);
document.getElementById('menu-close').addEventListener('click', menuAccueil.closeMenu, false);
addEventListener('scroll', menuOpen.scroll, false);
