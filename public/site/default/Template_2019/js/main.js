$(document).ready(function(){


$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
  if (!$(this).next().hasClass('show')) {
    $(this).parents('.dropdown-menu').first().find('.show').removeClass('show');
  }
  var $subMenu = $(this).next('.dropdown-menu');
  $subMenu.toggleClass('show');


  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
    $('.dropdown-submenu .show').removeClass('show');
  });


  return false;
});


if($("#js-scene").length){
    var scene = document.getElementById('js-scene');
    var parallax = new Parallax(scene);
}

    var owl = $('.home-carousel');
    owl.owlCarousel({
        margin:30,
        autoplay: true,
        nav:true,
        navText: ["", ""],
        autoplayTimeout: 5500,
        loop: true,
        stagePadding:0,
        responsive: {
                    0:{
                        items:1,
                        nav:true
                    },
                    380:{
                        items:2,
                        nav:true
                    },
                    800:{
                        items:3,
                        nav:true
                    },
                    1000:{
                        items:4,
                        nav:true
                    },
                   1200:{
                        items:4,
                        nav:true
                    },
                    1400:{
                        items:4,
                        nav:true,
                        loop:true
                    }
        }
    });


    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin: 30,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    var owl = $('.owl-carousel2');
    owl.owlCarousel({
        margin: 30,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });

});

$(window).on("load", function() { // makes sure the whole site is loaded
    $('#status').fadeOut(); // will first fade out the loading animation
    $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
    $('body').delay(350).css({'overflow':'visible'});
})

function checkValue(element) {
    if ($(element).val())
        $(element).addClass('has-value');
    else
        $(element).removeClass('has-value');
}
$('.form-control , .people-forms-fields').each(function() {
    checkValue(this);
})
/*$('.form-control , .people-forms-fields').blur(function() {*/
//$('.form-control , .people-forms-fields').on('blur', function() {
$(document).delegate('.form-control , .people-forms-fields','blur', function() {
    checkValue(this);
});





