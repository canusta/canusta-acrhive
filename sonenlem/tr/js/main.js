




/* =========================================================================================== */
/*                                                                                             */
/*     GENERAL                                                                                 */
/*                                                                                             */
/* =========================================================================================== */

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 
/*     Control                                                                                  
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 

var developmentMode = 1	;

/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 
/*     Vars                                                                                  
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 

var anasayfaInterval
;

var fullPageImgWidth 			= 3600,
	fullPageImgHeight 			= 2000,
	fullPageAspect				= fullPageImgWidth / fullPageImgHeight,
	pass						= '1234',
	menuStatus					= 'maximized',
	currentPage					= 'home'
;


/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 
/*     Window                                                                                  
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 

$(window).load(function() { run(); });
$(window).resize(function() { resized(); });



/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 
/*     On Load                                                                                  
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 

function run () {
	// if(developmentMode===0)  : loadAnasayfa();
	var big = (developmentMode===0) ? passwordAction() : loadInterface();
	
}



/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 
/*     Resized                                                                                  
/* - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */ 

function resized () { 
	updateGlobals();
	resizeImg();
	relocateMenu();
	if(wW<=600 && menuStatus=='maximized' && currentPage==='home') {
		minimizeMenu();
	}
	if(wW>=600 && menuStatus=='minimized' && currentPage==='home'){
		maximizeMenu();
	}
	if(currentPage==='home') resizeAnasayfa();
	if(currentPage==='barneo') resizeBarneo();
	if(currentPage==='polarOcean') resizePolarOcean();
	if(currentPage==='followUs') resizeFollowUs();
	if(currentPage==='theteam') resizeTheTeam();
	if(currentPage==='audioDiary') resizeAudioDiary();
	if(currentPage==='news') resizeNews();
	if(currentPage==='preparing') resizePreparing();
	if(currentPage==='progressMap') resizeProgressMap();
	if(currentPage==='expeditionPhotos') resizeExpeditionPhotos();

}

function resizeImg () {
	var img = $('.imgFitHeight img');
	var imgHeight = wH;
	var imgWidth = wH * fullPageAspect;
	if(imgWidth<=wW) { 
		imgWidth = wW;
		imgHeight = wW / fullPageAspect;
	}
	var imgML = ( ( wW - imgWidth ) / 2 );
	var imgMT = ( ( wH - imgHeight ) / 2 );
	img.css( { 'height' : imgHeight+"px" , 'marginLeft' : imgML , 'marginTop' : imgMT } );
}

function relocateMenu() {
	var menu = $('#menu');
	var menuWidth = menu.width();
	var menuML = ( wW - menuWidth ) / 2;
	// menu.css('marginLeft',menuML+'px');
	if(menuStatus==='minimized'){
		var menuTrgt = 0-menu.height();
		var tl = new TimelineMax({
			repeat: 0,
			yoyo: false
		});

		tl.timeScale(0.7); // 0.7

		tl.to([menu], 1, {
			bottom: menuTrgt,
			ease: Back.easeIn.config(1.7)
		})
	}
}

function showPreloader (argument) {

	var preloader = $('div#preloader');
	TweenMax.to([preloader], 0, {
		// scale: 1,
		delay: 0,
		left: '100%',
		ease: Expo.easeIn
	})
	TweenMax.to([preloader], 0.4, {
		// scale: 1,
		delay: 0,
		left: '50%',
		ease: Expo.easeOut
	})
}

function hidePreloader (argument) {
	var preloader = $('div#preloader');
	TweenMax.to([preloader], 1, {
		// scale: 1,
		delay: 1,
		left: '-60',
		ease: Expo.easeIn
	})
}









/* =========================================================================================== */
/*                                                                                             */
/*     PASSWORD                                                                                 */
/*                                                                                             */
/* =========================================================================================== */

function passwordAction (argument) {
	$.ajax({
	    url : "password.html",
	    success : function(result){
	        $('body').html(result);
	        TweenMax.to([$('#password')], 1, {
				top: '50%',
				ease: Expo.easeOut
			})
			$('#passwordInput').on('keyup', function(e) {
			    if (e.which == 13) {
			        e.preventDefault();
			        checkPassword();    }
			});
	    }
	});
}

function checkPassword (argument) {
	var enteredPassword = document.getElementById("passwordInput").value;
	if( enteredPassword!=pass){openWrongPassBox()}else{passwordIsCorrect()}
}

function openWrongPassBox (argument) {
	var passIncorrect = $('#passwordIncorrect');
	passIncorrect.css('opacity', '1');
	TweenMax.to([passIncorrect], 2, {
		opacity: '0',
		delay: '1',
		ease: Expo.easeOut
	})
}

function passwordIsCorrect (argument) {
	var passwordDiv = $('#password');
	TweenMax.to([passwordDiv], 1, {
		marginTop: '0px',
		top: '100%',
		ease: Expo.easeIn,
		onComplete:loadInterface
	})
}




/* =========================================================================================== */
/*                                                                                             */
/*     INTERFACE                                                                                 */
/*                                                                                             */
/* =========================================================================================== */

function loadInterface () {
	$.ajax({
	    url : "interface.html",
	    success : function(result){
	        $('body').html(result);
	        loadAnasayfa();
	    }
	});
}

function minimizeMenu () {

	menuStatus = 'minimized';

	var menu = $('#menu');
	var hamburger = $('#hamburger');
	hamburger.css('display','block');

	var menuH = menu.height();
	
	var hamburgerH = hamburger.height();

	var menuTrgt = 0-menuH;
	var hamburgetTrgt = 0-hamburgerH;

	var tl = new TimelineMax({
		repeat: 0,
		yoyo: false
	});

	tl.timeScale(0.7); // 0.7

	tl.to([menu], 1, {
		bottom: menuTrgt,
		ease: Back.easeIn.config(1.7),
		opacity: 0
	})

	TweenMax.to([hamburger], 1, {
		bottom: 0,
		opacity: 1
	})

}

function maximizeMenu () {

	menuStatus = 'maximized';

	var menu = $('#menu');
	var hamburger = $('#hamburger');
	hamburger.css('display','block');

	var menuH = menu.height();
	
	var hamburgerH = hamburger.height();

	var menuTrgt = 0;
	var hamburgetTrgt = 0-hamburgerH;

	var tl = new TimelineMax({
		repeat: 0,
		yoyo: false
	});

	tl.timeScale(0.7); // 0.7

	tl.to([menu], 1, {
		bottom: menuTrgt,
		ease: Back.easeOut.config(1.7),
		opacity: 1
	})

	TweenMax.to([hamburger], 1, {
		bottom: hamburgetTrgt,
		opacity: 0
	})

}

function showMenu () {

	menuStatus = 'shown';

	var menu = $('#menu');
	var hamburger = $('#hamburger');
	hamburger.css('display','block');

	var menuH = menu.height();
	
	var hamburgerH = hamburger.height();

	var menuTrgt = 0;
	var hamburgetTrgt = 0-hamburgerH;

	var tl = new TimelineMax({
		repeat: 0,
		yoyo: false
	});

	tl.timeScale(0.7); // 0.7

	tl.to([menu], 1, {
		bottom: menuTrgt,
		ease: Back.easeOut.config(1.7),
		opacity: 1
	})

	TweenMax.to([hamburger], 1, {
		bottom: hamburgetTrgt,
		opacity: 0
	})

	menu.addClass('shownMenu');

}

function closeMenu () {

	menuStatus = 'minimized';

	var menu = $('#menu');
	var hamburger = $('#hamburger');
	hamburger.css('display','block');

	var menuH = menu.height();
	
	var hamburgerH = hamburger.height();

	var menuTrgt = 0-menuH;
	var hamburgetTrgt = 0-hamburgerH;

	var tl = new TimelineMax({
		repeat: 0,
		yoyo: false
	});

	tl.timeScale(0.7); // 0.7

	tl.to([menu], 1, {
		bottom: menuTrgt,
		ease: Back.easeIn.config(1.7),
		opacity: 0
	})

	TweenMax.to([hamburger], 1, {
		bottom: 0,
		opacity: 1
	})

	menu.removeClass('shownMenu');

}

function buttonizeMenu () {

	$('#hamburger').click(function() { 
		showMenu();
	});

	$('#menuClose').click(function() { 
		closeMenu();
	});

	$('#language').click(function() { 
		window.location.href = 'http://wwww.sonenlem.com/';
	});
	
	$('#menuItemHome').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadAnasayfa();
			minimizeMenu();
		}

	});

	$('#menuItemTheGoal').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadTheGoal();
			minimizeMenu();
		}
	});

	$('#menuItemBarneo').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadBarneo();
			minimizeMenu();
		}
	});

	$('#menuItemThePolarOcean').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadPolarOcean();
			minimizeMenu();
		}
	});

	$('#menuItemFollowUsHere').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadFollowUs();
			minimizeMenu();
		}
	});

	$('#menuItemTheTeam').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadTheTeam();
			minimizeMenu();
		}
	});

	$('#menuItemPreparing').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadPreparing();
			minimizeMenu();
		}
	});

	$('#menuItemSupport').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadSupport();
			minimizeMenu();
		}
	});

	$('#menuItemAudioDiary').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadAudioDiary();
			minimizeMenu();
		}
	});

	$('#menuItemNews').click(function() { 
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadNews();
			minimizeMenu();
		}
	});

	$('#menuItemProgressMap').click(function() { 
		
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadProgressMap();
			minimizeMenu();
		}
	});

	$('#menuItemExpeditionPhotos').click(function() { 
		
		if($(this).checkHasClass('currentMenuItem')=='false')
		{
			$(document).scrollTo( 0 );
			$('.currentMenuItem').removeClass('currentMenuItem');
			$(this).addClass('currentMenuItem');
			loadExpeditionPhotos();
			minimizeMenu();
		}
	});

}



/* =========================================================================================== */
/*                                                                                             */
/*     ANASAYFA                                                                                 */
/*                                                                                             */
/* =========================================================================================== */

function loadAnasayfa () {
	showPreloader();
	$.ajax({
	    url : "anasayfa.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        openAnasayfa();
	        currentPage = 'home';
	    }
	});
}

function openAnasayfa () {
	resized();
    buttonizeMenu();

	var imgLoad = imagesLoaded( $('.preload') );

	imgLoad.on( 'always', function( instance ) {
		hidePreloader();
		var hiddens = $('.hide');
		startCycleAnasayfaImages();
		$('.currentAnasayfaImage img').animate({ opacity: 1 }, 1500);
		$('#homeText').animate({ opacity: 1 }, 1500);
		// alert('addClass')
	});

	$('#homeText').click(function() {
		$('#homeText').animate({ opacity: 0 }, 1500);
		$('#homeText').css('cursor', 'default');
	});
	
}

function startCycleAnasayfaImages () {
	anasayfaInterval=setInterval(function () {cycleAnasayfaImages()}, 5000);
}

function cycleAnasayfaImages () {
	var currentImg = $('.currentAnasayfaImage');
	var next = $('.currentAnasayfaImage').next();
	if(next.checkHasClass('imgFitHeight')==='false'){
		next = $( "#pageAnasayfa .imgFitHeight:first-child" );
	}
	currentImg.find('img').css('opacity','0');
	next.find('img').css('opacity', '1');
	currentImg.removeClass('currentAnasayfaImage');
	next.addClass('currentAnasayfaImage');
}

function resizeAnasayfa () {
	var homeText = $('#homeText');
	if(wW<=1200) {
		var mt = 150;
	}else{
		var mt = ( wH - homeText.height() ) / 2.4;
	}
	
	homeText.css('top', mt+'px');

}








/* =========================================================================================== */
/*                                                                                             */
/*     EXPEDITION PHOTOS                                                                       
/*                                                                                             */
/* =========================================================================================== */

function loadExpeditionPhotos () {
	showPreloader();
	$.ajax({
	    url : "expeditionPhotos.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        openExpeditionPhotos();
	        currentPage = 'expeditionPhotos';
	    }
	});
}

function openExpeditionPhotos () {
	resized();
    buttonizeMenu();

	var imgLoad = imagesLoaded( $('.preload') );

	imgLoad.on( 'always', function( instance ) {
		hidePreloader();
		var hiddens = $('.hide');
		startCycleAnasayfaImages();
		$('.currentAnasayfaImage img').animate({ opacity: 1 }, 1500);
		// alert('addClass')
	});
	
}

function startCycleAnasayfaImages () {
	anasayfaInterval=setInterval(function () {cycleAnasayfaImages()}, 5000);
}

function cycleAnasayfaImages () {
	var currentImg = $('.currentAnasayfaImage');
	var next = $('.currentAnasayfaImage').next();
	if(next.checkHasClass('imgFitHeight')==='false'){
		next = $( "#pageAnasayfa .imgFitHeight:first-child" );
	}
	currentImg.find('img').css('opacity','0');
	next.find('img').css('opacity', '1');
	currentImg.removeClass('currentAnasayfaImage');
	next.addClass('currentAnasayfaImage');
}

function resizeAnasayfa () {
	var homeText = $('#homeText');
	if(wW<=1200) {
		var mt = 150;
	}else{
		var mt = ( wH - homeText.height() ) / 2.4;
	}
	
	homeText.css('top', mt+'px');

}










/* =========================================================================================== */
/*                                                                                             */
/*     THE GOAL                                                                                 
/*                                                                                             */
/* =========================================================================================== */

function loadTheGoal () {
	showPreloader();
	$.ajax({
	    url : "thegoal.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'theGoal';
	        resized();
	        minimizeMenu();
	        // $('.preload').animate({ opacity: 1 }, 1500);

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
			  hidePreloader();
				var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}







/* =========================================================================================== */
/*                                                                                             */
/*     BARNEO                                                                                
/*                                                                                             */
/* =========================================================================================== */

function loadBarneo () {
	showPreloader();
	$.ajax({
	    url : "barneo.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'barneo';
	        resized();
	        minimizeMenu();
	        // $('.preload').animate({ opacity: 1 }, 1500);

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
				hidePreloader();
			  	var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}

function resizeBarneo () {

	var barneoText = $('#barneoText');
	if(wW<=1200) {
		var mt = wH  / 2;
		barneoText.css('height', 'auto').css('marginTop', mt+'px').css('marginBottom', '0px');
	}else{
		var mt = ( wH - barneoText.height() ) / 2;
		barneoText.css('height', 'auto').css('marginTop', mt+'px').css('marginBottom', mt+'px');
	}

	$('.barneoVideo').css('height',wH+'px');
	


}






/* =========================================================================================== */
/*                                                                                             */
/*     POLAR OCEAN                                                                                
/*                                                                                             */
/* =========================================================================================== */

function loadPolarOcean () {
	showPreloader();
	$.ajax({
	    url : "polarocean.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'polarOcean';
	        resized();
	        minimizeMenu();
	        // $('.preload').animate({ opacity: 1 }, 1500);

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
				hidePreloader();
			  	var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}

function resizePolarOcean () {
	var polarOceanText = $('#polarOceanText');
	var mt = ( wH - polarOceanText.height() ) / 2;
	polarOceanText.css('top', mt+'px');
}






/* =========================================================================================== */
/*                                                                                             */
/*     FOLLOW US                                                                                
/*                                                                                             */
/* =========================================================================================== */

function loadFollowUs () {
	showPreloader();
	$.ajax({
	    url : "followus.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'followUs';
	        resized();
	        minimizeMenu();

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
				hidePreloader();
			  	var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}

function resizeFollowUs () {
	var followUsContent = $('#followUsContent');
	var mt = ( wH - followUsContent.height() ) / 2;
	followUsContent.css('top', mt+'px');
	// alert('asd')
}





/* =========================================================================================== */
/*                                                                                             */
/*     The Team                                                                            
/*                                                                                             */
/* =========================================================================================== */

function loadTheTeam () {
	showPreloader();
	$.ajax({
	    url : "theteam.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'theteam';
	        resized();
	        minimizeMenu();

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
				hidePreloader();
			  	var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}

function resizeTheTeam () {
	var theTeamContent = $('#theTeamContent');
	var theTeamImages = $('#theTeamImages');

	theTeamImages.css('height', theTeamContent.height()+'px');
	// alert('asd')
}




/* =========================================================================================== */
/*                                                                                             */
/*     Preparing                                                                           
/*                                                                                             */
/* =========================================================================================== */

function loadPreparing () {
	// showPreloader();
	$.ajax({
	    url : "preparing.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'preparing';
	        resized();
	        minimizeMenu();

			var imgLoad = imagesLoaded( $('.preload') );

			$('#preparingContent').animate({ opacity: 1 }, 1500);

			imgLoad.on( 'progress', function( instance, image ) {
			  var result = image.isLoaded ? 'loaded' : 'broken';
			  // console.log( 'image is ' + result + ' for ' + image.img.src );
			  // image.animate({ opacity: 1 }, 1500);
			  image.img.css('opacity','1');
			});

	    }
	});
}

function resizePreparing () {
	var preparingVideo = $('.preparingVideo');
	preparingVideo.css('height',wH+'px');
	trc('ad')
}






/* =========================================================================================== */
/*                                                                                             */
/*     Audio Diary                                                                           
/*                                                                                             */
/* =========================================================================================== */

function loadAudioDiary () {
	// showPreloader();
	$.ajax({
	    url : "audiodiary.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'audioDiary';
	        resized();
	        minimizeMenu();

			$('#audioDiaryContent').animate({ opacity: 1 }, 1500);

	    }
	});
}

function resizeAudioDiary () {
	// var audioDiaryContent = $('#audioDiaryContent');
	// var mt = ( wH - audioDiaryContent.height() ) / 2;
	// audioDiaryContent.css('top', mt+'px');
}





/* =========================================================================================== */
/*                                                                                             */
/*     Support                                                                           
/*                                                                                             */
/* =========================================================================================== */

function loadSupport () {
	showPreloader();
	$.ajax({
	    url : "support.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'support';
	        resized();
	        minimizeMenu();

			var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
			  hidePreloader();
			  	var hiddens = $('.hide');
				$.each(hiddens, function( index, value ) {
				  $(this).delay((index*1000)+1000).animate({ opacity: 1 }, 1500);
				});
			});
	    }
	});
}

function resizeSupport () {
	// var preparingContent = $('#preparingContent');
	// var mt = ( wH - preparingContent.height() ) / 2;
	// preparingContent.css('top', mt+'px');
}



/* =========================================================================================== */
/*                                                                                             */
/*     News                                                                           
/*                                                                                             */
/* =========================================================================================== */

function loadNews () {
	// showPreloader();
	$.ajax({
	    url : "news.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'news';
	        resized();
	        minimizeMenu();

	        $('#newsContent').animate({ opacity: 1 }, 1500);

	    }
	});
}

function resizeNews () {
	// var audioDiaryContent = $('#audioDiaryContent');
	// var mt = ( wH - audioDiaryContent.height() ) / 2;
	// audioDiaryContent.css('top', mt+'px');
}





/* =========================================================================================== */
/*                                                                                             */
/*     Progress Map                                                                           
/*                                                                                             */
/* =========================================================================================== */

function loadProgressMap () {
	showPreloader();
	$.ajax({
	    url : "progressMap.html",
	    success : function(result){
	        $('#pageHolder').html(result);
	        currentPage = 'progressMap';
	        resized();
	        minimizeMenu();

	        var imgLoad = imagesLoaded( $('.preload') );

			imgLoad.on( 'always', function( instance ) {
			  hidePreloader();
			  $('.hide').animate({ opacity: 1 }, 1500);
			});

	    }
	});
}

function resizeProgressMap () {
	// var audioDiaryContent = $('#audioDiaryContent');
	// var mt = ( wH - audioDiaryContent.height() ) / 2;
	// audioDiaryContent.css('top', mt+'px');
}








/* =========================================================================================== */
/*                                                                                             */
/*     COMMON FUNCTIONS                                                                        */
/*                                                                                             */
/* =========================================================================================== */

function updateGlobals () {wW = window.innerWidth;wH = window.innerHeight;}

function trc(string){console.log(string);}

function random (num) {return Math.floor((Math.random() * num) + 1);}

function shuffle(o){for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x); return o;};

$.fn.checkHasClass=function(a){ return this.hasClass(a).toString(); };
