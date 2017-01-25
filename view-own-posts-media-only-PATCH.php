<?php
/* 
Plugin Name: View own posts and media library items only - PATCH
Description: The original plugin doesn't work with custom roles. This plugin fix that problems
Version: 0.1
Author: Diego Juliao
Author URI: http://about.me/dianjuar
Text Domain: view-own-posts-media-only-PATCH
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
    define( 'VOPMO_PATCH', 'view-own-posts-media-only-PATCH' );
    # -------------------------------------  Define Constants OFF   ------------------------------------

    #---------------- Checking plugin dependencies ON  ----------------
    # Verify if the plugin "View_Own_Posts_Media_Only" is installed

    # Deactivate the current plugin
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
    
    if( !is_plugin_active( 'view-own-posts-media-only/view-own-posts-media-only.php' ) ) 
    {
        # Deactivate the current plugin
        deactivate_plugins( plugin_basename( __FILE__ ) );

        # Show an error alert on the admin area
        add_action( 'admin_notices', function () 
        {
            ?>
            <div class="updated error">
                <p>
                    <?php 
                    _e('The plugin <strong>"View own posts and media library items only - PATCH"</strong> needs the plugin <strong>"View own posts and media library items only"</strong> installed and active', VOPMO_PATCH);
                    echo '<br>';
                    _e('<strong>The plugin has been deactivate it</strong>', VOPMO_PATCH);
                    ?>
                </p>
            </div>
            <?php
            if ( isset( $_GET['activate'] ) )
                unset( $_GET['activate'] );
        } );
    }
    #---------------- Checking plugin dependencies OFF ----------------

    # plugin includes
    require_once(VOPMO_PATCH_PLUGIN_DIR . '/includes/class-view-own-posts-media-only-library-patch.php');
}