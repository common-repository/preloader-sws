<?php
/**
 * Delete all preloader options from Data Base
 */
$options = get_option( 'sws_preloader_options' );
if ( isset( $options) && ! empty( $options ) ) {
	delete_option( 'sws_preloader_options' );
}