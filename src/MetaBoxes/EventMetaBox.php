<?php
namespace UltimateEventManager\MetaBoxes;

class EventMetaBox {
    public function register(): void {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post_event', [$this, 'save_meta_boxes']);
    }

    /**
    * Register meta boxes.
    */
    public function add_meta_boxes() {
    add_meta_box(
    'event_details_box',
    __( 'Event Details', 'ultimate-event-manager' ),
    array( $this, 'render_event_details_box' ),
    'event',
    'normal',
    'high'
    );
    }

    /**
    * Render the Event Details meta box.
    */
    public function render_event_details_box( $post ) {
        // Nonce for verification.
        wp_nonce_field( 'event_details_nonce_action', 'event_details_nonce' );

        $organizer = get_post_meta( $post->ID, '_event_organizer', true );
        $date_time = get_post_meta( $post->ID, '_event_date_time', true );
        $participants = get_post_meta( $post->ID, '_event_participants', true );
        $location = get_post_meta( $post->ID, '_event_location', true );
        $notes = get_post_meta( $post->ID, '_event_notes', true );
        ?>

        <p>
            <label for="event_organizer"><strong><?php esc_html_e( 'Organizer Name:', 'ultimate-event-manager' ); ?></strong></label><br />
            <input type="text" name="event_organizer" id="event_organizer" value="<?php echo esc_attr( $organizer ); ?>" class="widefat" />
        </p>

        <p>
            <label for="event_date_time"><strong><?php esc_html_e( 'Event Date & Time:', 'ultimate-event-manager' ); ?></strong></label><br />
            <input type="datetime-local" name="event_date_time" id="event_date_time" value="<?php echo esc_attr( $date_time ); ?>" class="widefat" />
        </p>

        <p>
            <label for="event_participants"><strong><?php esc_html_e( 'Number of Participants:', 'ultimate-event-manager' ); ?></strong></label><br />
            <input type="number" name="event_participants" id="event_participants" value="<?php echo esc_attr( $participants ); ?>" class="widefat" />
        </p>

        <p>
            <label for="event_location"><strong><?php esc_html_e( 'Event Location:', 'ultimate-event-manager' ); ?></strong></label><br />
            <input type="text" name="event_location" id="event_location" value="<?php echo esc_attr( $location ); ?>" class="widefat" />
        </p>

        <p>
            <label for="event_notes"><strong><?php esc_html_e( 'Additional Notes:', 'ultimate-event-manager' ); ?></strong></label><br />
            <textarea name="event_notes" id="event_notes" rows="4" class="widefat"><?php echo esc_textarea( $notes ); ?></textarea>
        </p>

        <?php
    }

}
