<?php
/**
 * Plugin Name: Event Manager
 * Version: 1.0.0
 * Description: Manage events via front-end form and custom posts.
 * Author: Akash Kumar Bhowmik
 * Text Domain: event-manager
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'EVENT_MANAGER_VERSION', '1.0.0' );
define( 'EVENT_MANAGER_DIR', plugin_dir_path( __FILE__ ) );
define( 'EVENT_MANAGER_URL', plugin_dir_url( __FILE__ ) );

// Load core class.
require_once EVENT_MANAGER_DIR . 'includes/class-event-manager.php';

// Initialize.
Event_Manager\Event_Manager::get_instance();