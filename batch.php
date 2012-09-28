<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2012
 */

/*
   Plugin Name: batch-move
   Plugin URI:
   Description: Batch-Moving Posts plugin.
   Author: CS Walchum.net
   Version: 1.0
   Author URI: http://www.walchum.net
*/

// Link in het admin menu
if ( ! defined( 'BATCH_PLUGIN_BASENAME' ) )
	define( 'BATCH_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( ! defined( 'BATCH_PLUGIN_NAME' ) )
	define( 'BATCH_PLUGIN_NAME', trim( dirname( BATCH_PLUGIN_BASENAME ), '/' ) );
if ( ! defined( 'BATCH_PLUGIN_DIR' ) )
	define( 'BATCH_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . BATCH_PLUGIN_NAME );

if ( ! defined( 'BATCH_PLUGIN_URL' ) )
	define( 'BATCH_PLUGIN_URL', WP_PLUGIN_URL . '/' . BATCH_PLUGIN_NAME );

function batch_plugin_path( $path = '' ) {
	return path_join( BATCH_PLUGIN_DIR, trim( $path, '/' ) );
}
/**
 * Set language file
 *
 */

load_plugin_textdomain('batch-move', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
/**
 * include some configuration, classes and functions
 *
 */

include_once('include/config.inc.php');
include_once('include/classes.php');
include_once('include/functions.php');

/**
 * Create new batchMove class
 *
 * Structure who has all information
 *
 */
$bm = new batchMove;
/**
 * Set many language strings
 *
 */
$bm->orderbydef = $orderbysLng;//start all defined in config.inc.php and *.mo files
$bm->orderdef = $orderLng;
$bm->frmlabels = $formLabels;
$bm->frmhelp = $formHelp;
$bm->pageing = $pageing;
$bm->information = $information;
$bm->ret_head = $ret_head;
$bm->action = $actions;// end config defined

function batch_plugin_url( $path = '' ) {
	return plugins_url( $path, BATCH_PLUGIN_BASENAME );
}

/* Runs when plugin is activated, NO INSTALL */
//register_activation_hook(__FILE__,'batch_install');

/* Runs on plugin deactivation, NO DEINSTALL*/
//register_deactivation_hook( __FILE__, 'batch_remove' );

function batch_install() {
}

function batch_remove() {
}


function batch_add_css_files(){
	wp_enqueue_style( 'batch_css', batch_plugin_url('css/batch.css'));
}
add_action('init', 'batch_add_css_files');

function wp_batch_admin(){
	include('batch_admin.php');
}

function wp_batch_actions(){
	global $application;
	/**
	 * Here you can set menustring ($application)
	 * What kind of role (editor)
	 * The internal Wordpress name (batchadmin)
	 * Function who is fired (wp_batch_admin)
	 *
	 */
	add_posts_page($application, $application, "editor", "batchadmin", "wp_batch_admin");
}
add_action('admin_menu', 'wp_batch_actions');//

/*
   function wp_batch(){
   include('batch-show.php');
   }
   function wp_batch_actions(){
   //to set initial values
   add_options_page("Options","Options","", "batch-show","wp_batch" );
   }
   add_action('admin_menu', 'wp_batch_options');
*/


function wp_batch_show(){
	//include('batch-show.php');
}

function batch_add_javascript_files()
{
	wp_enqueue_script( 'batch_js', batch_plugin_url('js/batch.js'));
}
add_action('init', 'batch_add_javascript_files');
//for later frontside use
add_shortcode('batch-move', 'wp_batch_show');

?>
