<?php

namespace UltimateEventManager\Handlers;

class ContactFormHandler {
    public function __construct() {
        add_action( 'init', [ $this, 'handle_form_submission' ] );
    }

    /**
     * Handle form submission
     */
    public function handle_form_submission() {
        if ( ! isset( $_POST['event_submit'] ) ) {
            return;
        }

        if ( ! isset( $_POST['event_form_nonce'] ) || ! wp_verify_nonce( $_POST['event_form_nonce'], 'event_form_action' ) ) {
            return;
        }

        if ( ! is_user_logged_in() ) {
            return;
        }

        $event_title        = sanitize_text_field( $_POST['event_title'] );
        $event_description  = sanitize_textarea_field( $_POST['event_description'] );
        $organizer_name     = sanitize_text_field( $_POST['organizer_name'] );
        $event_date         = sanitize_text_field( $_POST['event_date'] );
        $event_participants = intval( $_POST['event_participants'] );
        $event_location     = sanitize_text_field( $_POST['event_location'] );
        $event_notes        = sanitize_textarea_field( $_POST['event_notes'] );
        $event_category     = intval( $_POST['event_category'] );

        $post_id = wp_insert_post([
            'post_title'   => $event_title,
            'post_content' => $event_description,
            'post_type'    => 'event',
            'post_status'  => 'draft',
        ]);

        if ( $post_id ) {
            update_post_meta( $post_id, '_event_organizer', $organizer_name );
            update_post_meta( $post_id, '_event_date_time', $event_date );
            update_post_meta( $post_id, '_event_participants', $event_participants );
            update_post_meta( $post_id, '_event_location', $event_location );
            update_post_meta( $post_id, '_event_notes', $event_notes );

            if ( $event_category ) {
                wp_set_post_terms( $post_id, [ $event_category ], 'event_category' );
            }

            if ( ! empty( $_FILES['event_image']['name'] ) ) {
                require_once ABSPATH . 'wp-admin/includes/file.php';
                require_once ABSPATH . 'wp-admin/includes/image.php';

                $upload = media_handle_upload( 'event_image', $post_id );
                if ( ! is_wp_error( $upload ) ) {
                    set_post_thumbnail( $post_id, $upload );
                }
            }

            wp_redirect( add_query_arg( 'event_submitted', 'true', get_permalink() ) );
            exit;
        }
    }
}
