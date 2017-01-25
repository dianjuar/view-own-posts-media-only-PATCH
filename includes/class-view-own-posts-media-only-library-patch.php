<?php


if( !class_exists('View_Own_Posts_Media_Only_Patch') )
{

/**
* Class to put a patch to the problem with the custom roles on the plugin 'View own posts and media library items only'
*
* The plugin doesn't work with custom roles, just doesn't. With this the plugin will work with custom roles.
*/
class View_Own_Posts_Media_Only_Patch
{
    
    function __construct()
    {
        # I18n (Loads text-domain) or the translations
        add_action('plugins_loaded', 
            array(&$this, 'load_text_domain') );
    }

    /**
     * I18n (Loads text-domain) or the translations
     */
    public function load_text_domain() 
    {
        load_plugin_textdomain( VOPMO_PATCH, false, VOPMO_PATCH_PLUGIN_DIRNAME . '/languages' );
    }
    
}# End class

    $view_own_posts_media_only_patch = new View_Own_Posts_Media_Only_Patch();
}


/**
 <?php

if( is_plugin_active($plugin) ||
     )

require_once( WP_PLUGIN_DIR . '/view-own-posts-media-only/view-own-posts-media-only.php' );


 */