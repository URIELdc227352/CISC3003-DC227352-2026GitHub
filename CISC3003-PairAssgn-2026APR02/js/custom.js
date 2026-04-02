(function ($) {
	
	"use strict";

	// Header Type = Fixed
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var box = $('.header-text').height();
    var header = $('header').height();

    if (scroll >= box - header) {
      $("header").addClass("background-header");
    } else {
      $("header").removeClass("background-header");
    }
  });


  // Acc
    $(document).on("click", ".naccs .menu > div", function() {
      var naccsParent = $(this).closest(".naccs");
      var numberIndex = $(this).index();

      if (!$(this).hasClass("active")) {
          naccsParent.find(".menu > div").removeClass("active");
          naccsParent.find("ul > li").removeClass("active");

          $(this).addClass("active");
          naccsParent.find("ul > li:eq(" + numberIndex + ")").addClass("active"); 

          var listItemHeight = naccsParent.find("ul")
            .find("li:eq(" + numberIndex + ")")
            .innerHeight();
          naccsParent.find("ul").height(listItemHeight + "px");
      }
    });

	$('.owl-listing').owlCarousel({
		items:1,
		loop:true,
		dots: true,
		nav: false,
		autoplay: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:1
			  },
			  1000:{
				  items:1
			  },
			  1600:{
				  items:1
			  }
		  }
	})
	

	// Menu Dropdown Toggle
  if($('.menu-trigger').length){
    $(".menu-trigger").on('click', function() { 
      $(this).toggleClass('active');
      $('.header-area .nav').slideToggle(200);
    });
  }


	// Page loading animation
  $(window).on('load', function() {
    if($('#js-preloader').length) {
      $('#js-preloader').addClass('loaded');
    }
  });

  function updatePartnerSectionVisibility() {
    var selectedPartner = $('#choosePartner').val();
    var johnSection = $('#partner-section-john');
    var urielSection = $('#partner-section-uriel');

    if (!johnSection.length || !urielSection.length) {
      return;
    }

    if (selectedPartner === 'John') {
      johnSection.show();
      urielSection.hide();
    } else if (selectedPartner === 'Uriel') {
      johnSection.hide();
      urielSection.show();
    } else {
      johnSection.show();
      urielSection.hide();
    }

    $('.popular-categories:visible .naccs .menu div.active').each(function() {
      var naccsParent = $(this).closest('.naccs');
      var activeItem = naccsParent.find('ul li.active');
      if (activeItem.length) {
        naccsParent.find('ul').height(activeItem.innerHeight() + 'px');
      }
    });
  }

  $(document).on('click', '#search-btn', function() {
    updatePartnerSectionVisibility();
    var selectedPartner = $('#choosePartner').val();
    var target = selectedPartner === 'Uriel' ? $('#partner-section-uriel') : $('#partner-section-john');
    if (target.length) {
      target[0].scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });

  $(document).on('change', '#choosePartner', function() {
    updatePartnerSectionVisibility();
  });

  updatePartnerSectionVisibility();

  // 兜底方案：如果加载时间过长（3秒），强制移除动画
  setTimeout(function() {
    $('#js-preloader').addClass('loaded');
  }, 3000);
	

	




})(window.jQuery);