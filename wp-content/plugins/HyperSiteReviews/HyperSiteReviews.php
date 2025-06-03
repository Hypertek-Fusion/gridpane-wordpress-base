<?php

/*
 * Plugin Name: HyperSite Reviews
 * Version: 0.0.1
 * Requires PHP: 8.4
*/

/**
 * Register the "Reviews" custom post type
 */

 if ( ! class_exists('HyperSiteReviews')) {
    class HyperSiteReviews {
        public static function init() {
            function hsrev_setup_post_type() {
                register_post_type( 'reviews', ['public' => true ] ); 
            } 
            add_action( 'init', 'hsrev_setup_post_type' );


            /**
             * Activate the plugin.
             */
            function hsrev_activate() { 
                // Trigger our function that registers the custom post type plugin.
                hsrev_setup_post_type(); 
                // Clear the permalinks after the post type has been registered.
                flush_rewrite_rules(); 
            }
            register_activation_hook( __FILE__, 'hsrev_activate' );

            /**
             * Deactivation hook.
             */
            function hsrev_deactivate() {
                // Unregister the post type, so the rules are no longer in memory.
                unregister_post_type( 'book' );
                // Clear the permalinks to remove our post type's rules from the database.
                flush_rewrite_rules();
            }
            register_deactivation_hook( __FILE__, 'hsrev_deactivate' );
            }
        }

        HyperSiteReviews::init();
    }

?>