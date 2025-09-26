<?php
namespace UltimateEventManager\Frontend;

class FrontendAssets {
    public function register(): void {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function enqueue_styles(): void {
        wp_enqueue_style(
            'single-member-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/single-member.css',
            [],
            '1.0',
            'all'
        );

        wp_enqueue_style(
            'single-team-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/single-team.css',
            [],
            '1.0',
            'all'
        );

        wp_enqueue_style(
            'archive-member-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/archive-member.css',
            [],
            '1.0',
            'all'
        );

        wp_enqueue_style(
            'archive-team-style',
            ULMR_EVENT_MANAGER_URL . 'assets/css/archive-team.css',
            [],
            '1.0',
            'all'
        );
    }

    
}
