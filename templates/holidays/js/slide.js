function Slide() {
    this.nbimage = '';

    this.image = function () {
        if (this.nbimage != 'a') {
            document.getElementById('img-slide2').style.display = 'flex';
            document.getElementById('img-slide1').style.display = 'none';
            this.nbimage = 'a';

        } else {
            document.getElementById('img-slide2').style.display = 'none';
            document.getElementById('img-slide1').style.display = 'flex';
            this.nbimage = 'b';

        }
    };

    this.autoplay = function () {
        setInterval(cursor.image, 18500);

    }
}

var cursor = new Slide();
var play = new Slide();
play.autoplay();
document.getElementById('bouton-slide-right').addEventListener('click', cursor.image, false);
document.getElementById('bouton-slide-left').addEventListener('click', cursor.image, false);