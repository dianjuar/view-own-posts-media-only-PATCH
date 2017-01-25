<?php
/* 
Plugin Name: View own posts and media library items only - PATCH
Description: The original plugin doesn't work with custom roles. This plugin fix that problems
Version: 0.1
Author: Diego Juliao
Author URI: http://about.me/dianjuar
Text Domain: view-own-posts-media-only-patch
Domain Path: /languages/
*/

# Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if ( !class_exists('View_Own_Posts_Media_Only_Patch') ) 
{   
    # -------------------------------------  Define Constants ON   -------------------------------------
    define( 'VOPMO_PATCH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    define( 'VOPMO_PATCH_PLUGIN_DIRNAME', plugin_basename(dirname(__FILE__)));
    define( 'VOPMO_PATCH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    define( 'VOPMO_PATCH', 'view-own-posts-media-only-patch' );
    # -------------------------------------  Define Constants OFF   ------------------------------------

    # plugin includes
    require_once(VOPMO_PATCH_PLUGIN_DIR . '/includes/class-view-own-posts-media-only-library-patch.php');
}