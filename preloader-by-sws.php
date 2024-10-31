<?php
/**
* Plugin Name: Preloader by WordPress Monsters
* Description: Add preloader to your website and customize it! This plugin gives to select a lot of cool preloaders (100+). Most of them are extremely awesome!
* Version: 1.2.3
* Author: WordPress Monsters
* Author URI: http://www.wpmonsters.org/
*/

define( 'SWS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SWS_PLUGIN_URL', __FILE__ );
define( 'SWS_PLUGIN_NAME', 'Preloader by SWS' );

require_once( SWS_PLUGIN_DIR .  'includes/admin_assets.php' );
require_once( SWS_PLUGIN_DIR .  'includes/frontend-assets.php' );
require_once( SWS_PLUGIN_DIR .  'includes/sws-preloader-settings.php' );
require_once( SWS_PLUGIN_DIR .  'includes/view.php' );
