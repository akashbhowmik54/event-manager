<?php
/**
 * Plugin Name: Ultimate Event Manager
 * Description: A custom WordPress plugin to manage events.
 * Version: 1.0.0
 * Author: Akash Kumar Bhowmik
 * Text Domain: ultimate-event-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define constants
define( 'ULMR_EVENT_MANAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'ULMR_EVENT_MANAGER_PATH', plugin_dir_path( __FILE__ ) );

// Load Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

use UltimateEventManager\Core\Plugin;
use UltimateEventManager\PostTypes\EventPostType;

// Activation/Deactivation
register_activation_hook(__FILE__, [EventPostType::class, 'activate']);
register_deactivation_hook(__FILE__, [EventPostType::class, 'deactivate']);


function member_directory_init() {
    Plugin::init();
}
add_action( 'plugins_loaded', 'member_directory_init' );
