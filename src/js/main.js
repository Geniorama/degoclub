(function($) {

    function activeCarousels() {
      //Slider Home Carousel

      $('.owl-slider-home').owlCarousel({
          items: 1,
          autoplay:false,
          dots: true,
          
          responsive:{
            0:{
                nav: false,
                autoplay: true
            },
            480:{
                nav: false
            },
            720:{
                nav: true
            }
        }
      });

      //Screenshot Carousel

      $('.owl-screenshots').owlCarousel({
          dots: true,
          nav: false,
          autoplay: true,
          responsive:{
            0:{
                items: 1
            },
            480:{
                items: 2
            },
            720:{
                items: 3
            }
        }
      });

      //Testimonial Carousel

      $('.owl-testimonial').owlCarousel({
          nav: true,
          dots: true,
          responsive:{
              0:{   
                items: 1,
                nav: false
              },
              480:{
                items: 2
              },
              720:{
                items: 3
              }
          }
      }); 
    }
    
    activeCarousels();
    

    function changeArrows() {
        $('.owl-carousel .owl-nav .owl-prev').html('<i class="fas fa-angle-left"></i>');
        $('.owl-carousel .owl-nav .owl-next').html('<i class="fas fa-angle-right"></i>');
    }

    changeArrows();

    //Menú

    $('.header-default .nav-link').click(function(){
        $('.header-default .nav-link').removeClass('active');
        $(this).addClass('active');
    });

    //Header secondary
    function headerSecondary() {
        function changeLogo() {
            $('.header-default.secondary .nav-brand-theme').attr('src','src/img/logo_blanco.png'); 
        }

        changeLogo();

        $('.header-default.secondary .btn').removeClass('btn-primary');
        $('.header-default.secondary .btn').addClass('btn-secondary');
    }
    
    headerSecondary();

    function modifyBtn() {
        $identifyNav = $('.header-default .nav').attr('id');
        
        if ($identifyNav == 'login-nav') {
            $('.nav-theme .btn').attr('href','registro.php');
            //alert('este es el login');
        } else if ($identifyNav == 'register-nav') {
            $('.nav-theme .btn').attr('href','login.php');
        } else {
            $('.nav-theme .btn').attr('href','registro.php');
            $('.nav-theme #inicia-sesion').show();
        }


        $('#login-nav .btn').html('<i class="fas fa-user-plus"></i> Regístrate');
        $('#register-nav .btn').html('<i class="fas fa-key"></i> Inicia sesión');
    }

    modifyBtn();

    //Smoothscroll
    $('html').smoothScroll();

    //Menu sticky 
	$(window).on('scroll', function(){
        // aca se pregunta si el scroll se movio de pa bajo.
           if ($(this).scrollTop() > 150) {
              $('.header-default').addClass('header-sticky');
              $('.btn-whatsapp').fadeIn();
              $('.back-to-top').fadeIn();
           }
           if ($(this).scrollTop() < 150) {
            $('.header-default').removeClass('header-sticky');
            $('.btn-whatsapp').fadeOut();
            $('.back-to-top').fadeOut();
           }
   });

   //Menu responsive
   $('.button-toggle').click(function() {
       $('.header-default .nav-theme').slideToggle();
   });

   var ventana_ancho = $(window).width();

   if (ventana_ancho <= 480) {
    $('.header-default .nav .nav-item .nav-link').click(function() {
        $('.header-default .nav-theme').slideToggle();
    });
   }

      
	

  

})(jQuery);