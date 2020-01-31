    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 0,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });


    var TxtType = function(el, toRotate, period) {

        this.toRotate = toRotate;

        this.el = el;

        this.loopNum = 0;

        this.period = parseInt(period, 10) || 2000;

        this.txt = '';

        this.tick();

        this.isDeleting = false;

    };


    TxtType.prototype.tick = function() {

        var i = this.loopNum % this.toRotate.length;

        var fullTxt = this.toRotate[i];


        if (this.isDeleting) {

        this.txt = fullTxt.substring(0, this.txt.length - 1);

        } else {

        this.txt = fullTxt.substring(0, this.txt.length + 1);

        }


        this.el.innerHTML = '<span class="x1">'+this.txt+'</span>';


        var that = this;

        var delta = 200 - Math.random() * 100;


        if (this.isDeleting) { delta /= 2; }


        if (!this.isDeleting && this.txt === fullTxt) {

        delta = this.period;

        this.isDeleting = true;

        } else if (this.isDeleting && this.txt === '') {

        this.isDeleting = false;

        this.loopNum++;

        delta = 500;

        }


        setTimeout(function() {

        that.tick();

        }, delta);

    };


    window.onload = function() {

        var elements = document.getElementsByClassName('x');

        for (var i=0; i<elements.length; i++) {

            var toRotate = elements[i].getAttribute('data-type');

            var period = elements[i].getAttribute('data-period');

            if (toRotate) {

              new TxtType(elements[i], JSON.parse(toRotate), period);

            }

        }

    };

var windowScrolled = function() {
  $(window).scroll(function() {

    var $w = $(this), st = $w.scrollTop(), navbar = $('.js-navbar') ;

    if ( st > 550 ) {
      navbar.addClass('scrolled');
    } else {
      navbar.removeClass('scrolled');
    }
    
  })

}
windowScrolled();

function openForms(evt, formName) {
  var i ,x = $('.forms');
  for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";
  }
  y = $('.formsLinks');
  for (i = 0; i < y.length; i++) {
    y[i].className = y[i].className.replace(" activee", "");
  }
  document.getElementById(formName).style.display = "block";
  evt.currentTarget.className += " activee";
  
}
