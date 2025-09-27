<?php
namespace UltimateEventManager\PostTypes;

class EventPostType {
    public function register() {
        add_action('init', [$this, 'register_post_type']);
        add_action('init', [$this, 'register_taxonomy']);
    }

    /**
    * Register the Event post type.
    */
    public function register_post_type() {
        $labels = array(
        'name' => _x( 'Events', 'post type general name', 'ultimate-event-manager' ),
        'singular_name' => _x( 'Event', 'post type singular name', 'ultimate-event-manager' ),
        'menu_name' => __( 'Events', 'ultimate-event-manager' ),
        'name_admin_bar' => __( 'Event', 'ultimate-event-manager' ),
        'add_new' => __( 'Add New', 'ultimate-event-manager' ),
        'add_new_item' => __( 'Add New Event', 'ultimate-event-manager' ),
        'new_item' => __( 'New Event', 'ultimate-event-manager' ),
        'edit_item' => __( 'Edit Event', 'ultimate-event-manager' ),
        'view_item' => __( 'View Event', 'ultimate-event-manager' ),
        'all_items' => __( 'All Events', 'ultimate-event-manager' ),
        'search_items' => __( 'Search Events', 'ultimate-event-manager' ),
        'not_found' => __( 'No events found.', 'ultimate-event-manager' ),
        'not_found_in_trash' => __( 'No events found in Trash.', 'ultimate-event-manager' ),
        );

        $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'has_archive' => true,
        'capability_type' => 'event',
        'map_meta_cap' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        );

        register_post_type( 'event', $args );
    }

    /**
    * Register Event Category taxonomy.
    */
    public function register_taxonomy() {
        $labels = array(
        'name' => _x( 'Event Categories', 'taxonomy general name', 'ultimate-event-manager' ),
        'singular_name' => _x( 'Event Category', 'taxonomy singular name', 'ultimate-event-manager' ),
        'search_items' => __( 'Search Event Categories', 'ultimate-event-manager' ),
        'all_items' => __( 'All Event Categories', 'ultimate-event-manager' ),
        'edit_item' => __( 'Edit Event Category', 'ultimate-event-manager' ),
        'update_item' => __( 'Update Event Category', 'ultimate-event-manager' ),
        'add_new_item' => __( 'Add New Event Category', 'ultimate-event-manager' ),
        'new_item_name' => __( 'New Event Category', 'ultimate-event-manager' ),
        'menu_name' => __( 'Categories', 'ultimate-event-manager' ),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'event-category' ),
        );

        register_taxonomy( 'event_category', array( 'event' ), $args );
    }

    /**
    * Add capabilities to admin on activation.
    */
    public static function activate() {
        self::add_caps_to_admin();
        flush_rewrite_rules();
    }


    /**
    * Flush rules on deactivate.
    */
    public static function deactivate() {
        self::remove_caps_from_admin();
        flush_rewrite_rules();
    }


    /**
    * Add event caps to administrators.
    */
    private static function add_caps_to_admin() {
        $admin = get_role( 'administrator' );
        if ( $admin ) {
            $admin->add_cap( 'read_event' );
            $admin->add_cap( 'read_private_events' );
            $admin->add_cap( 'edit_event' );
            $admin->add_cap( 'edit_events' );
            $admin->add_cap( 'edit_others_events' );
            $admin->add_cap( 'edit_published_events' );
            $admin->add_cap( 'publish_events' );
            $admin->add_cap( 'delete_event' );
            $admin->add_cap( 'delete_events' );
            $admin->add_cap( 'delete_others_events' );
            $admin->add_cap( 'delete_private_events' );
            $admin->add_cap( 'delete_published_events' );
        }
    }


    /**
    * Remove event caps from administrators.
    */
    private static function remove_caps_from_admin() {
    $admin = get_role( 'administrator' );
        if ( $admin ) {
            $admin->remove_cap( 'read_event' );
            $admin->remove_cap( 'read_private_events' );
            $admin->remove_cap( 'edit_event' );
            $admin->remove_cap( 'edit_events' );
            $admin->remove_cap( 'edit_others_events' );
            $admin->remove_cap( 'edit_published_events' );
            $admin->remove_cap( 'publish_events' );
            $admin->remove_cap( 'delete_event' );
            $admin->remove_cap( 'delete_events' );
            $admin->remove_cap( 'delete_others_events' );
            $admin->remove_cap( 'delete_private_events' );
            $admin->remove_cap( 'delete_published_events' );
        }
    }
}
