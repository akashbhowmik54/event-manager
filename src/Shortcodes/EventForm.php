<?php
namespace UltimateEventManager\Shortcodes;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class EventForm {

    public function __construct() {
        add_action('init', [$this, 'register_shortcode']);
    }

    public function register_shortcode() {
        add_shortcode('event_submission_form', [$this, 'render_form']);
    }

    /**
     * Render front-end form
     */
    public function render_form() {
        if ( ! is_user_logged_in() ) {
            return '<p>You must be logged in to submit an event.</p>';
        }

        ob_start(); ?>

        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field( 'event_form_action', 'event_form_nonce' ); ?>

            <p>
                <label for="event_title">Event Title *</label><br>
                <input type="text" name="event_title" id="event_title" required>
            </p>

            <p>
                <label for="event_description">Event Description *</label><br>
                <textarea name="event_description" id="event_description" required></textarea>
            </p>

            <p>
                <label for="organizer_name">Organizer Name *</label><br>
                <input type="text" name="organizer_name" id="organizer_name" required>
            </p>

            <p>
                <label for="event_image">Feature Image</label><br>
                <input type="file" name="event_image" id="event_image" accept="image/*">
            </p>

            <p>
                <label for="event_date">Event Date & Time *</label><br>
                <input type="datetime-local" name="event_date" id="event_date" required>
            </p>

            <p>
                <label for="event_participants">Number of Participants *</label><br>
                <input type="number" name="event_participants" id="event_participants" required>
            </p>

            <p>
                <label for="event_location">Event Location *</label><br>
                <input type="text" name="event_location" id="event_location" required>
            </p>

            <p>
                <label for="event_notes">Additional Notes</label><br>
                <textarea name="event_notes" id="event_notes"></textarea>
            </p>

            <p>
                <label for="event_category">Category *</label><br>
                <?php
                wp_dropdown_categories([
                    'taxonomy' => 'event_category',
                    'name'     => 'event_category',
                    'id'       => 'event_category',
                    'class'    => 'postform',
                    'required' => true,
                    'show_option_none' => 'Select Category',
                    'hide_empty'    => false,
                ]);
                ?>
            </p>

            <p>
                <input type="submit" name="event_submit" value="Submit Event">
            </p>
        </form>

        <?php
        return ob_get_clean();
    }

    
}

