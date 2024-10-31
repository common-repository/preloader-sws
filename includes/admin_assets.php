<?php
/**
 * Add admin assets
 */
function sws_add_admin_assets() {
	wp_register_script( 'select2-scripts', plugins_url( 'assets/js/select2.min.js', __DIR__ ), array( 'jquery' ) );
	wp_register_script( 'sws-admin-scripts', plugins_url( 'assets/js/sws-admin-scripts.js', __DIR__ ), array( 'jquery', 'select2-scripts', 'wp-color-picker' ) );
	
	wp_register_style( 'select2-styles', plugins_url( 'assets/css/select2.min.css', __DIR__ ) );
	wp_register_style( 'sws-admin-styles', plugins_url( 'assets/css/sws-admin-styles.css', __DIR__ ) );

	wp_enqueue_script( 'select2-scripts' );
	wp_enqueue_script( 'sws-admin-scripts' );
	
	wp_enqueue_style( 'wp-color-picker' ); 
	wp_enqueue_style( 'select2-styles' ); 
	wp_enqueue_style( 'sws-admin-styles' ); 
}
add_action( 'admin_enqueue_scripts', 'sws_add_admin_assets');