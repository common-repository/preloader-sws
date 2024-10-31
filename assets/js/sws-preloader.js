jQuery(window).load(function() {
	var $ = jQuery;
	var $preloader = $('.sws-preloader');
	function hidePreloader() {
		$preloader.fadeOut(500);
		$('html').css("cssText", "overflow: visible !important;");
	}
	var preloaderDelayTime = $preloader.data('delay');
	setTimeout( hidePreloader, preloaderDelayTime ); 
});