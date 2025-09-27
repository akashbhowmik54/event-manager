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

        <form id="eventForm" method="post" enctype="multipart/form-data" class="ak-event-form-wrapper">
            <?php wp_nonce_field( 'event_form_action', 'event_form_nonce' ); ?>

            <div class="ak-form-row">
                <label for="event_title">Event Title *</label>
                <input type="text" name="event_title" id="event_title" placeholder="Enter event title" required>
            </div>

            <div class="ak-form-row">
                <label for="event_description">Event Description *</label>
                <textarea name="event_description" id="event_description" placeholder="Describe your event" required></textarea>
            </div>

            <div class="ak-form-row">
                <label for="organizer_name">Organizer Name *</label>
                <input type="text" name="organizer_name" id="organizer_name" placeholder="Your name" required>
            </div>

            <div class="ak-form-row">
                <label for="event_image">Feature Image</label>
                <input type="file" name="event_image" id="event_image" accept="image/*">
            </div>

            <div class="ak-form-row ak-form-inline">
                <div class="ak-form-col">
                    <label for="event_date">Event Date & Time *</label>
                    <input type="datetime-local" name="event_date" id="event_date" required>
                </div>

                <div class="ak-form-col">
                    <label for="event_participants">Number of Participants *</label>
                    <input type="number" name="event_participants" id="event_participants" required>
                </div>
            </div>

            <div class="ak-form-row">
                <label for="event_location">Event Location *</label>
                <input type="text" name="event_location" id="event_location" placeholder="Event venue" required>
            </div>

            <div class="ak-form-row">
                <label for="event_notes">Additional Notes</label>
                <textarea name="event_notes" id="event_notes" placeholder="Any extra info"></textarea>
            </div>

            <div class="ak-form-row">
                <label for="event_category">Category *</label>
                <?php
                wp_dropdown_categories([
                    'taxonomy' => 'event_category',
                    'name'     => 'event_category',
                    'id'       => 'event_category',
                    'class'    => 'postform',
                    'required' => true,
                    'show_option_none' => 'Select Category',
                    'hide_empty' => false,
                ]);
                ?>
            </div>

            <div class="ak-form-row">
                <input type="submit" name="event_submit" value="Submit Event" class="ak-submit-btn">
            </div>
        </form>

        <?php
        return ob_get_clean();
    }

    
}

