<?php
namespace UltimateEventManager\Frontend;

class FrontendAssets {
    public function register(): void {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
    }

    public function enqueue_styles(): void {
        wp_enqueue_style(
            'single-member-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/single-event.css',
            [],
            '1.0',
            'all'
        );

        wp_enqueue_style(
            'archive-member-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/archive-event.css',
            [],
            '1.0',
            'all'
        );
    }

    public function enqueue_scripts(): void {
        
        wp_enqueue_script(
            'event-form',
            ULMR_EVENT_MANAGER_URL . 'assets/js/event-form.js',
            ['jquery'],
            '1.0.0',
            true
        );

        wp_localize_script( 'event-form', 'wpApiSettings', [
            'root'  => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ),
        ]);
    }

    
}
