<?php
/*
Plugin Name: Fixed Position Save, Publish, Delete buttons for WordPress Admin
Description: Save a lot of your time by scrolling less in WP admin! Show buttons (Scroll to top and Publish/Update and Save Draft and Preview) in the bottom of the screen when user scrolls near bottom.
Author: WPPluginCo.com (@wppluginco) and Spencer Hill (@s3w47m88)
Author URI: https://www.wppluginco.com/
Version: 1.0.5
*/

class Wppcbottompublishbutton {

    protected $allowed_types;

    function __construct() {

        # Load plugin text domain
        add_action( 'init', array( $this, 'plugin_textdomain' ) );

        # Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

    }

    public function plugin_textdomain() {

        $domainwbpb = 'wppcbottompublishbutton';
        $locale = apply_filters( 'plugin_locale', get_locale(), $domainwbpb );
        load_textdomain( $domainwbpb, WP_LANG_DIR.'/'.$domainwbpb.'/'.$domainwbpb.'-'.$locale.'.mo' );
        load_plugin_textdomain( $domainwbpb, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

    }

    public function wppc_get_current_post_type() {

        global $post, $typenow, $pagenow;

        if(( $post && $post->post_type && $pagenow == 'post.php') || ( $post && $post->post_type && $pagenow == 'post-new.php') ) :
            $post_type = $post->post_type;
        else :
            return false;
        endif;

        return $post_type;
    }

    public function register_admin_styles() {

        # Only load js css we are are editing a post  or page or custom post type
        if($this->wppc_get_current_post_type()) :

            wp_enqueue_style( 'wppcbottompublishbutton-plugin-styles', plugins_url( 'css/wppc-bottom-publish-button.admin.css', __FILE__ ) );

        endif;

    }

    public function register_admin_scripts() {

        # Only load js if we are are editing a post or page or custom post type
        if($this->wppc_get_current_post_type()) :

			wp_enqueue_script( 'wppcbottompublishbutton-admin-script', plugins_url( 'js/wppc-bottom-publish-button.admin.js', __FILE__ ), array('jquery') );

			# Translatable trings
			$js_data = array(
				'update'     => __( 'Update', 'wppcbottompublishbutton' ),
				'publish'    => __( 'Publish', 'wppcbottompublishbutton' ),
				'publishing' => __( 'Publishing...', 'wppcbottompublishbutton' ),
				'updating'   => __( 'Updating...', 'wppcbottompublishbutton' ),
				'totop'      => __( 'To top', 'wppcbottompublishbutton' ),
				'preview'    => __( 'Preview', 'wppcbottompublishbutton' ),
				'previewchanges' => __( 'Preview Changes', 'wppcbottompublishbutton' ),
				'savedraft' => __( 'Save Draft', 'wppcbottompublishbutton' ),
			);

            # strings to javascript
			wp_localize_script('wppcbottompublishbutton-admin-script', 'wppcbottompublishbuttonParams', $js_data);

        endif;

    }
}

if (is_admin()):
	$ufb = new Wppcbottompublishbutton();
endif;