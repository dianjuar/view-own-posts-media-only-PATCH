<?php


if( !class_exists('View_Own_Posts_Media_Only_Patch') )
{


require_once( WP_PLUGIN_DIR . '/view-own-posts-media-only/view-own-posts-media-only.php' );

/**
* Class to put a patch to the problem with the custom roles on the plugin 'View own posts and media library items only'
*
* The plugin doesn't work with custom roles, just doesn't. With this the plugin will work with custom roles.
*
* @since 0.1 With "View own posts and media library items only" - V1.3
*/
class View_Own_Posts_Media_Only_Patch extends View_Own_Posts_Media_Only
{
    /**
     * @override
     * On the origina class is private, and for some reason that triggers a fatal error.
     */
    protected $lib = null;
    
    function __construct()
    {
        # Call the parent constructor
        parent::__construct();
        
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

    /**
     * Override the function with the custom code to do exactly what I want.
     */
    public function query_set_only_author($query) 
    {

        global $current_user, $pagenow;

        if (!($pagenow == 'edit.php' || $pagenow == 'upload.php' || 
            ($pagenow=='admin-ajax.php' && !empty($_POST['action']) && $_POST['action']=='query-attachments'))) {
            return;
        }

        // do not limit user with Administrator role
        if (current_user_can('administrator')) {
            return;
        }    

        $exclude_custom_post_types = $this->lib->get_option('exclude_custom_post_types', array());              
        $post_type = $query->get('post_type');
        if (in_array($post_type, $exclude_custom_post_types)) {
            return;
        }

        $suppressing_filters = $query->get('suppress_filters'); // Filter suppression on?

        /**
         * I need to put comment the conditional current_user_can('edit_posts') off. Because not all the roles can edit post, maybe they can 
         * edit_CUSTOM_POST. Put that conditional is too restrictive.
         */
        if (!$suppressing_filters && is_admin() && /*current_user_can('edit_posts') &&*/ !current_user_can('edit_others_posts')) {
            $query->set('author', $current_user->ID);

            add_filter('views_edit-post', array(&$this, 'fix_post_counts'));
            add_filter('views_upload', array(&$this, 'fix_media_counts'));
        }
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