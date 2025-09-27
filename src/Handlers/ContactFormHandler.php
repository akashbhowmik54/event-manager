<?php

namespace UltimateEventManager\Handlers;

class ContactFormHandler {
    public function __construct() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

     /**
     * Register REST API routes
     */
    public function register_routes() {
        register_rest_route(
            'uem/v1',
            '/submit-event',
            [
                'methods'             => 'POST',
                'callback'            => [ $this, 'handle_form_submission' ],
                'permission_callback' => function () {
                    return is_user_logged_in();
                },
                'args'                => [
                    'event_title'        => [ 'required' => true ],
                    'event_description'  => [ 'required' => true ],
                    'organizer_name'     => [ 'required' => true ],
                    'event_date'         => [ 'required' => true ],
                    'event_participants' => [ 'required' => true ],
                    'event_location'     => [ 'required' => true ],
                    'event_category'     => [ 'required' => false ],
                    'event_notes'        => [ 'required' => false ],
                ],
            ]
        );
    }

    /**
     * Handle submission
     */
    public function handle_form_submission( \WP_REST_Request $request ) {
        $event_title        = sanitize_text_field( $request['event_title'] );
        $event_description  = sanitize_textarea_field( $request['event_description'] );
        $organizer_name     = sanitize_text_field( $request['organizer_name'] );
        $event_date         = sanitize_text_field( $request['event_date'] );
        $event_participants = intval( $request['event_participants'] );
        $event_location     = sanitize_text_field( $request['event_location'] );
        $event_notes        = sanitize_textarea_field( $request['event_notes'] );
        $event_category     = intval( $request['event_category'] );

        $post_id = wp_insert_post([
            'post_title'   => $event_title,
            'post_content' => $event_description,
            'post_type'    => 'event',
            'post_status'  => 'draft',
        ]);

        if ( is_wp_error( $post_id ) ) {
            return new \WP_Error( 'event_error', 'Failed to create event', [ 'status' => 500 ] );
        }

        // Save meta
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
            require_once ABSPATH . 'wp-admin/includes/media.php';

            $upload = media_handle_upload( 'event_image', $post_id );
            if ( ! is_wp_error( $upload ) ) {
                set_post_thumbnail( $post_id, $upload );
            }
        }

        return [
            'success' => true,
            'message' => 'Event submitted successfully!',
            'post_id' => $post_id,
        ];

    }
}
