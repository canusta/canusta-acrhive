












$(window).resize(function() {


	resized();


});





function buttonizeGallery() {


	$('#galleryInner').find('img:first-child').addClass('currentImage').fadeIn(500);

	
	if ($("#galleryArrowRight")[0]){
	
	
	   $('#galleryArrowRight').click(function() {
	
		
			var current = $('.currentImage');
	
			current.fadeOut();
			
			current.removeClass('currentImage');
		
		    if ( current.is(":last-child"))
		    {
		        current.parent().find('img:first-child').addClass('currentImage');
		    }else{
			    current.next().addClass('currentImage');;
		    }
		    
		    var currentImageMT = ( 580 - $('.currentImage').height() ) / 2;
		    
		    $('.currentImage').css( 'top', currentImageMT + 'px')
		    
		    $('.currentImage').fadeIn();
			
			
		
  	});
  	
  	
  	
  	$('#galleryArrowLeft').click(function() {
	
		var current = $('.currentImage');
	
		current.fadeOut();
		
		current.removeClass('currentImage');
	
	    if ( current.is(":first-child"))
	    {
	        current.parent().find('img:last-child').addClass('currentImage');
	    }else{
		    current.prev().addClass('currentImage');;
	    }
	    
	    var currentImageMT = ( 580 - $('.currentImage').height() ) / 2;
	    
	    $('.currentImage').css( 'top', currentImageMT + 'px')
	    
	    $('.currentImage').fadeIn();
		
  	});
	}
	
	
	
	$(document).keydown(function(e){
	var direction;
    switch (e.keyCode) {
        case 40:

            break;
        case 38:

            break;
        case 37:
            $('#galleryArrowLeft').click();
            break;
        case 39:
            $('#galleryArrowRight').click();
            break;
        default:
            direction='???';  
    }
});

	
	
}



function buttonizeForm() {

$('#iletisimFormuAd').click(function() { $('#iletisimFormuAd').removeClass('formAlert'); });
$('#iletisimFormuSoyad').click(function() { $('#iletisimFormuSoyad').removeClass('formAlert'); });
$('#iletisimFormuTelefon').click(function() { $('#iletisimFormuTelefon').removeClass('formAlert'); });
$('#iletisimFormuSabitTelefon').click(function() { $('#iletisimFormuSabitTelefon').removeClass('formAlert'); });
$('#iletisimFormuEMail').click(function() { $('#iletisimFormuEMail').removeClass('formAlert'); });
$('#iletisimFormuAdres').click(function() { $('#iletisimFormuAdres').removeClass('formAlert'); });
$('#iletisimFormMessage').click(function() { $('#iletisimFormMessage').removeClass('formAlert'); });



	
	 $('#formSubmit').click(function() {
	 
	 	var cntr = 0;
	 
	 	if($.trim($('#iletisimFormuAd').val()).length == 0) { $('#iletisimFormuAd').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormuSoyad').val()).length == 0) { $('#iletisimFormuSoyad').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormuTelefon').val()).length == 0) { $('#iletisimFormuTelefon').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormuSabitTelefon').val()).length == 0) { $('#iletisimFormuSabitTelefon').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormuEMail').val()).length == 0) { $('#iletisimFormuEMail').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormuAdres').val()).length == 0) { $('#iletisimFormuAdres').addClass('formAlert'); } else { cntr++; }
	 	
	 	if($.trim($('#iletisimFormMessage').val()).length == 0) { $('#iletisimFormMessage').addClass('formAlert'); } else { cntr++; }
	
		if(cntr==7) { $('#iletisimFormuForm').submit(); }
		
	});
	
	
}





function launchPage() {

	

	buttonizeRoot();
	
	
	
	
	
}





function launchRoot() {


	
/* 	$('#layer-sky-bg').css('width', '100px'); */
/*
	$('#layer-sky-bg').css('height', '293px');
	$('#layer-sky-bg img').css('width', '100px');
	$('#layer-sky-bg img').css('height', '293px');
*/

	$('#layer-loading').fadeOut(1000);

		
	
	$('#layer-sky-pink').delay(0).fadeIn(1000).delay(12000).fadeOut(1000);;;
	$('#layer-ground-wc').delay(500).fadeIn(1000).delay(11500).fadeOut(1000);;
	$('#layer-ground').delay(1000).fadeIn(1000).delay(11000).fadeOut(1000);;
	$('#layer-building').delay(1500).fadeIn(3500).delay(7000).fadeOut(1000);;
	$('#layer-sky-bg').delay(2500).fadeIn(2000).delay(9500).fadeOut(1000);;
	$('#header').delay(2500).fadeIn(2000).delay(9500).fadeOut(1000);;
	$('#layer-hosgeldiniz').delay(4500).fadeIn(1000).delay(1000).fadeOut(1000);
	$('#mainNewsletter').delay(8000).fadeIn(1000);
	$('#rootEgeLogo').delay(9000).fadeIn(1000);
	$('#rootMenuContainer').delay(10000).fadeIn(1000);
	$('#rootKavuklarLogo').delay(11000).fadeIn(1000);
	$('#main').delay(12000).fadeIn(1000);
	$('#footer').delay(12000).fadeIn(1000);
	$('#skipIntroButton').delay(12000).fadeOut(1000);
		



	
	
	
	
	
	



	
	$('#layer-sky-pink, #layer-ground-wc, #layer-ground, #layer-building, #layer-sky-bg, #layer-header, #layer-menu').delay(12000).fadeOut(100);
	$('.header-1').delay(12000).fadeOut();
	
/* 	 */
	
	
	$('#layer-header-2').delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-2-bg').delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-4').delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-4-bg').delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-5').delay(24000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-5-bg').delay(24000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-6').delay(29000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-6-bg').delay(29000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-3').delay(34000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-3-bg').delay(34000).fadeIn(2000).delay(4000).fadeOut(1000, function() {
        loopSlider();
      });

	
	buttonizeRoot();
	
	resized();
	
	haberArrowHeightFix();
	
}



function loopSlider() {
	
	$('#layer-header-2').delay(0).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-2-bg').delay(0).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-4').delay(6000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-4-bg').delay(6000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-5').delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-5-bg').delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-6').delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-6-bg').delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-3').delay(24000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-3-bg').delay(24000).fadeIn(2000).delay(4000).fadeOut(1000, function() {
        loopSlider();
      });
	
}



function haberArrowHeightFix() {
	
/* 	$('.haberButton').height($(this).parent().find('.haberContent').css('height')); */
/* 	alert($('.haberButton').parent().find('.haberContent').css('height')); */
	
}



function buttonizeRoot() {

$('#skipIntroButton').click(function() {
	
	skipIntro();
		
});
	
	$('#rootMainHakkinda').mouseover(function() {
		var position = $(this).offset();
		$('#rootMenuHakkindaRollOverContainer').css("left", position.left + "px");
		var ttop = position.top + 10;
		$('#rootMenuHakkindaRollOverContainer').css("top", ttop + "px");
		$('#rootMenuHakkindaRollOverContainer').fadeIn(100);
		$("#rootMenuGaleriRollOverContainer").fadeOut();
		$("#rootMenuBasinRollOverContainer").fadeOut();
		$("#rootMenuIletisimRollOverContainer").fadeOut();
	});
	
	$('#rootMainGaleri').mouseover(function() {
		var position = $(this).offset();
		$('#rootMenuGaleriRollOverContainer').css("left", position.left + "px");
		var ttop = position.top + 10;
		$('#rootMenuGaleriRollOverContainer').css("top", ttop + "px");
		$('#rootMenuGaleriRollOverContainer').fadeIn(100);
		$("#rootMenuHakkindaRollOverContainer").fadeOut();
		$("#rootMenuBasinRollOverContainer").fadeOut();
		$("#rootMenuIletisimRollOverContainer").fadeOut();
	});
	
	$('#rootMainBasin').mouseover(function() {
		var position = $(this).offset();
		$('#rootMenuBasinRollOverContainer').css("left", position.left + "px");
		var ttop = position.top + 10;
		$('#rootMenuBasinRollOverContainer').css("top", ttop + "px");
		$('#rootMenuBasinRollOverContainer').fadeIn(100);
		$("#rootMenuHakkindaRollOverContainer").fadeOut();
		$('#rootMenuGaleriRollOverContainer').fadeOut();
		$("#rootMenuHakkindaRollOverContainer").fadeOut();
		$("#rootMenuIletisimRollOverContainer").fadeOut();
	});
	
	$('#rootMainIletisim').mouseover(function() {
		var position = $(this).offset();
		$('#rootMenuIletisimRollOverContainer').css("left", position.left + "px");
		var ttop = position.top + 10;
		$('#rootMenuIletisimRollOverContainer').css("top", ttop + "px");
		$('#rootMenuIletisimRollOverContainer').fadeIn(100);
		$("#rootMenuHakkindaRollOverContainer").fadeOut();
		$('#rootMenuGaleriRollOverContainer').fadeOut();
		$("#rootMenuHakkindaRollOverContainer").fadeOut();
		$("#rootMenuBasinRollOverContainer").fadeOut();
	});
	
	$('#rootMenuHakkindaRollOverContainer').mouseleave(function() {
		$(this).fadeOut();
	});
	
	$('#rootMenuGaleriRollOverContainer').mouseleave(function() {
		$(this).fadeOut();
	});
	
	$('#rootMenuBasinRollOverContainer').mouseleave(function() {
		$(this).fadeOut();
	});
	
	$('#rootMenuIletisimRollOverContainer').mouseleave(function() {
		$(this).fadeOut();
	});
	
	
	
	$('#mainNewsletter').click(function() {
		$('#mainNewsletterBox').stop().animate({ marginTop: 0 }, 500);
	});
	
	$('#mainNewsletterSubmit').click(function() {
	 
	 	$('#newsletterForm').submit();
		
	});
	
	
}



function resized() {
	
	var wW = $(window).width(); 
	var ml = Math.round( ( wW - 1800 ) / 2 ) ;
	$(".header").css("marginLeft", ml + "px");
	$("#layer-content").css("marginLeft", ml + "px");
	$("#pageHeaderBg").css("marginLeft", ml + "px");
/* 	$('.header-bg img').css("width", wW+"px" ); */

	
}




function skipIntro() {

	$('#skipIntroButton').stop().fadeOut(0);

	$('#layer-loading').fadeOut(1000);
	
	
	

	
	$('#layer-sky-pink, #layer-ground-wc, #layer-ground, #layer-building, #layer-sky-bg, #layer-header, #layer-menu').clearQueue().fadeIn(0);
	$('.header-1').clearQueue();
	setTimeout(function() {
    	$('.header-1').fadeOut(2000);
    }, 4000);
	
	
	
	$('#layer-header-2').clearQueue().delay(6000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-2-bg').clearQueue().delay(6000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-4').clearQueue().delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-4-bg').clearQueue().delay(12000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-5').clearQueue().delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-5-bg').clearQueue().delay(18000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-6').clearQueue().delay(23000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-6-bg').clearQueue().delay(23000).fadeIn(2000).delay(4000).fadeOut(1000);
	
	$('#layer-header-3').clearQueue().delay(29000).fadeIn(2000).delay(4000).fadeOut(1000);
	$('#layer-header-3-bg').clearQueue().delay(29000).fadeIn(2000).delay(4000).fadeOut(1000, function() {
        loopSlider();
      });
	
	$('#layer-hosgeldiniz').clearQueue().hide();
	
	
	
	
	
	
	
	
	$('#header').clearQueue().stop().fadeIn(0);
	$('#rootLangButton').clearQueue().stop().fadeIn(0);
	$('#rootEgeLogo').clearQueue().stop().fadeIn(0);
	$('#mainNewsletter').clearQueue().stop().fadeIn(0);
	$('#rootMenuContainer').clearQueue().stop().fadeIn(0);
	$('#rootKavuklarLogo').clearQueue().stop().fadeIn(0);
	$('#main').clearQueue().stop().fadeIn(0);
	$('#footer').clearQueue().stop().fadeIn(0);
	
	
	
	buttonizeRoot();
	
	resized();
	
	haberArrowHeightFix();
	
	
}














