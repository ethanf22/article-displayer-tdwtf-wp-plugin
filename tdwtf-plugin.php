<?php

/*
Plugin Name: TDWTF Article Plugin
Plugin URI: http://www.spokanewp.com
Description: A plugin to display a description and link to the most recent TDWTF article.
Version: 1.0
Author: Ethan Federman
Author URI: http://www.spokanewp.com
License: GPL2
*/

define( 'WDWTF_PLUGIN_ABSOLUTE_PATH', dirname(__FILE__) );
define( 'TDWTF_BASEPLUGIN_PATH', plugin_basename(__FILE__) );
define( 'TDWTF_PLUGIN_DIR', plugin_dir_url(__FILE__) . '/' );

spl_autoload_register( function( $class_name ) {
	$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
	$class_file = str_replace( '\\', DIRECTORY_SEPARATOR, ltrim( $class_name, '\\' ) ) . '.php';
	require_once $classes_dir . $class_file;
} );

$controller = new \TDWTFPlugin\Controller();

//register_activation_hook( __FILE__, array( $controller, 'init' ) );

$controller->init();

if(is_admin())
{
	$controller->initAdmin();
}