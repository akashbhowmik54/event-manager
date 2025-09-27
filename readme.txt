=== Ultimate Event Manager ===
Contributors: akash054
Tags: events, event manager, front-end submission, custom post type
Requires at least: 6.0
Tested up to: 6.5
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Manage and display events easily with front-end submission and category organization.

== Description ==
Ultimate Event Manager is a lightweight WordPress plugin that allows you to create, manage, and display events on your site. Users can submit events from the front-end, and administrators can manage them from the WordPress dashboard.

**Features:**
* Custom Post Type for Events
* Event Categories taxonomy
* Front-end submission form with AJAX/REST API
* Event meta fields: Organizer, Date & Time, Participants, Location, Notes, Description, Feature Image
* Automatically sets a placeholder image if no image is uploaded
* Responsive archive and single event templates
* WP REST API integration for event submission
* Smooth user-friendly messages after form submission

== Installation ==
1. Upload the `ultimate-event-manager` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add `[event_submission_form]` shortcode to any page to display the event submission form.
4. Visit the Events archive page to view submitted events.

== Frequently Asked Questions ==

= Can users submit events without logging in? =
No, users must be logged in to submit an event. Guests will see a message prompting them to log in.

= How can I display the event form on a page? =
Use the shortcode `[event_submission_form]` in the editor where you want the form to appear.

= Can I edit submitted events? =
Yes, administrators can edit all fields of submitted events from the WordPress dashboard, including the event category.

= Does it support feature images? =
Yes, users can upload a feature image while submitting an event. If no image is uploaded, a default placeholder will be shown.

== Changelog ==
= 1.0.0 =
* Initial release
* Custom Post Type: Event
* Taxonomy: Event Categories
* Front-end submission form via REST API
* Meta fields: Organizer, Date & Time, Participants, Location, Notes, Description
* Feature image support with placeholder
* Responsive single and archive templates

== Upgrade Notice ==
= 1.0.0 =
Initial release of Ultimate Event Manager. All features are included.

== Additional Notes ==
- For better performance, use a caching plugin if your site has many events.

== Credits ==

Developed by Akash Kumar Bhowmik.
