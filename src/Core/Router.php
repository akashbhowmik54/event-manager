<?php

namespace UltimateEventManager\Core;

class Router {
    public function register() {
        add_filter('template_include', [$this, 'load_templates']);
    }

    /**
    * Load custom templates from plugin
    */
    public function load_templates( $template ) {

        if ( is_post_type_archive( 'event' ) ) {
            $archive_template = ULMR_EVENT_MANAGER_PATH . 'templates/archive-event.php';
            if ( file_exists( $archive_template ) ) {
                return $archive_template;
            }
        }

        if ( is_singular( 'event' ) ) {
            $single_template = ULMR_EVENT_MANAGER_PATH . 'templates/single-event.php';
            if ( file_exists( $single_template ) ) {
                return $single_template;
            }
        }

        return $template;
    }
}
