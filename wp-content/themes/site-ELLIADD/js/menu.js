(function () {
    "use strict";
    var desciption = document.querySelector('#description');
    var leSVG = document.querySelector('body>header>div>a>svg');
    var menuPrinc = document.querySelector('body>header>div>nav.menu_princ');
    var elliadd = document.querySelector('body>header>div>a');
    var flechesMenu = document.querySelectorAll('body > header > div > nav.menu_princ > ul > li');
    var menuResponsive = document.querySelector('body>header>div>div:first-of-type');
    var croix = document.querySelectorAll('body > header > div > div:first-of-type > span');

    var scroller = true;
    var size = true;
    var menuOuvert = true;

    function petit() {
        desciption.style.transition = '';
        desciption.style.opacity = 0;
        elliadd.style.height = '80px';
        leSVG.style.height = '80px';
        menuPrinc.classList.add('fuite');
    }

    function grand() {
        desciption.style.transition = 'opacity 1s ease-in-out';
        desciption.style.opacity = 1;
        elliadd.style.height = '130px';
        leSVG.style.height = '';
        menuPrinc.classList.remove('fuite');
    }

    function scrolleur() {

        if (window.innerWidth > 940) {
            if (scrollY > 0) {

                if (scroller == true) {
                    scroller = false;
                    petit();
                }
            } else {
                scroller = true;
                grand();
            }
        }
    }

    function resize() {
        if (window.innerWidth < 940) {
            if (size == true) {
                size = false;
                petit();
            }
        } else if (scrollY == 0) {
            size = true;
            scroller = true;
            grand();
        }
        if (window.innerWidth >= 940) {
            menuPrinc.style.display = 'flex';
            if (scrollY > 0) {
                menuPrinc.classList.add('fuite');
            }
            if (croix[0].className == 'un') {
                animeMenu();
                menuOuvert = true;
            }
        } else {
            menuPrinc.style.display = 'none';
        }
    }

    function animeMenu() {
        croix[0].classList.toggle("un");
        croix[1].classList.toggle("deux");
        croix[2].classList.toggle("trois");
    }

    window.addEventListener('scroll', scrolleur);
    window.onresize = resize;

    menuResponsive.addEventListener('click', function () {
        if (menuOuvert) {
            menuOuvert = false;
            menuPrinc.classList.remove('fuite');
            menuPrinc.style.display = 'flex';
            animeMenu();
        } else {
            menuOuvert = true;
            menuPrinc.style.display = 'none';
            animeMenu();
        }
    });

    for (var i = 0; i < flechesMenu.length; i++) {
        var flecheMenu = flechesMenu[i];
        flecheMenu.addEventListener('click', function () {
            this.children[2].classList.toggle('rotation');
            this.children[1].classList.toggle('visible');
        });
    }
}());