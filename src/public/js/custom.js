$(document).ready(function(){
  if ($(window).width() <= 414){

    $(".affiliation_eligibility_evaluation .affiliation.wow").removeClass("wow");
    $(".affiliation_eligibility_evaluation .eligibility.wow").removeClass("wow");
    $(".affiliation_eligibility_evaluation .eligibility").addClass("animated");
    $(".affiliation_eligibility_evaluation .affiliation").addClass("animated");
    $(".alumini-banner-wrapper").removeClass("margin-top-fix");


  }else{
    $(".affiliation_eligibility_evaluation .affiliation").addClass("wow");
    $(".affiliation_eligibility_evaluation .eligibility").addClass("wow");
    $(".affiliation_eligibility_evaluation .eligibility").removeClass("animated");
    $(".affiliation_eligibility_evaluation .affiliation").removeClass("animated");
    $(".alumini-banner-wrapper").addClass("margin-top-fix");


  }
  if ($(window).width() <= 768){

    $(".alumini-banner-inner-wrapper").removeClass("custom-shadow");
    $(".single-event-events").addClass("margin-top-fixing");


  }else {
    $(".alumini-banner-inner-wrapper").addClass("custom-shadow");
    $(".single-event-events").removeClass("margin-top-fixing");

  }

  $('.experience-video-project-wrapper').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  asNavFor: '.experience-videos-preview-wrapper',
  arrows: false,
  variableWidth: false,
  fade: true

  });

  $('.experience-videos-preview-wrapper').slick({
    slidesToShow: 3,
    focusOnSelect: true,
    centerMode: false,
    asNavFor: '.experience-video-project-wrapper',
    prevArrow:'.experience-videos-slider-wrapper .video-left-arrow',
    nextArrow:'.experience-videos-slider-wrapper .video-right-arrow',
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3

      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }

  ]
  });

  // NEWS AND UPDATES STARTS

  $('.news_update_items').slick({
    slidesToShow: 4,
    prevArrow:'.news-update-slider .left-arrow',
    nextArrow:'.news-update-slider .right-arrow',
    responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3

      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
  });



  $(window).on("scroll", function() {


    if($(window).width() > 1200 && $(window).scrollTop() > 30) {
        $(".navbar-default").addClass("navbar-default-scroll-color");
        $(".navbar").addClass("navbar-default-scroll-height");
        $("#bs-example-navbar-collapse-1").addClass("bs-example-navbar-collapse-1-scroll-padding");
        $(".nav-subnav").addClass("navbar-default-scroll-subnav");
        // hidden-md-down is white logo
        $(".hidden-md-down").addClass("navbar-brand-scroll");

        $(".dummy-nav").addClass("dummy-small-height");



    } else {

        //remove the background property so it comes transparent again (defined in your css)
       $(".navbar-default").removeClass("navbar-default-scroll-color");
       $(".navbar").removeClass("navbar-default-scroll-height");
       $("#bs-example-navbar-collapse-1").removeClass("bs-example-navbar-collapse-1-scroll-padding");
       $(".nav-subnav").removeClass("navbar-default-scroll-subnav");
       // hidden-md-down is white logo
       $(".hidden-md-down").removeClass("navbar-brand-scroll");
       $(".dummy-nav").removeClass("dummy-small-height");



    }

    if ($(window).width() > 1900){
      $("#bs-example-navbar-collapse-1 .nav-subnav").css("clear","both");
      $("#bs-example-navbar-collapse-1 .nav-subnav").css("margin-top","-85px");
    }
    if ($(window).width() > 1900 && $(window).scrollTop() > 30){
      $("#bs-example-navbar-collapse-1 .nav-subnav").css("margin-top","-100px");
    }


  });


});
