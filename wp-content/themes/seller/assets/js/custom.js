jQuery(document).ready( function () {

	//For Menu Bar
		jQuery('#site-navigation li').find('ul').hide();
		jQuery('#site-navigation li').hover(
			function(){
				jQuery(this).find('> ul').slideDown('fast');
			},
			function(){
				jQuery(this).find('ul').hide();
			});	
	
	//For Tooltips
	jQuery('#social-icons a').tooltipster({theme: 'tooltipster-shadow'});
	
	});//end ready
	
	
	
jQuery(document).ready(function(){
			jQuery('.bxslider').bxSlider( {
			mode: 'fade',
			speed: 1000,
			captions: true,
			minSlides: 1,
			maxSlides: 1,
			adaptiveHeight: true,
			auto: true,
			preloadImages: 'all',
			pause: 5000,
			autoHover: true });
			});