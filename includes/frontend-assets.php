<?php
/**
 * Frondend assets
 */
function sws_add_assets() {
	
	wp_register_script( 'sws-preloader-scripts',  plugins_url( 'assets/js/sws-preloader.js', __DIR__ ), array('jquery') );
	wp_register_style( 'sws-preloader-styles',  plugins_url( 'assets/css/sws-preloader.css', __DIR__ ) );

	wp_enqueue_script( 'sws-preloader-scripts' );
	
	wp_enqueue_style( 'sws-preloader-styles' );
}
add_action( 'wp_enqueue_scripts', 'sws_add_assets' );