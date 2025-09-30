<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header(); ?>

<div class="ak-event-single">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); ?></h1>

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="ak-event-image"><?php the_post_thumbnail( 'large' ); ?></div>
    <?php endif; ?>

    <div class="ak-event-details">
        <p><strong><?php esc_html_e( 'Description:', domain: 'ultimate-event-manager' ); ?></strong> <?php echo apply_filters( 'the_content', get_the_content() ); ?></p>
        <p><strong><?php esc_html_e( 'Organizer:', 'ultimate-event-manager' ); ?></strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_event_organizer', true ) ); ?></p>
        <p>
            <strong><?php esc_html_e( 'Date & Time:', 'ultimate-event-manager' ); ?>
            </strong> 
            <?php 
                $raw_date = get_post_meta( get_the_ID(), '_event_date_time', true );
                if ( $raw_date ) {
                    $timestamp = strtotime( $raw_date );
                    echo esc_html( date_i18n( 'F j, Y \a\t g:i A', $timestamp ) );
                }
            ?>
        </p>
        <p><strong><?php esc_html_e( 'Participants:', 'ultimate-event-manager' ); ?></strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_event_participants', true ) ); ?></p>
        <p><strong><?php esc_html_e( 'Location:', 'ultimate-event-manager' ); ?></strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_event_location', true ) ); ?></p>
        <p><strong><?php esc_html_e( 'Notes:', 'ultimate-event-manager' ); ?></strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_event_notes', true ) ); ?></p>
        <p><strong><?php esc_html_e( 'Category:', 'ultimate-event-manager' ); ?></strong> <?php echo get_the_term_list( get_the_ID(), 'event_category', '', ', ', '' ); ?></p>
    </div>

    <div class="ak-event-form">
        <h2><?php esc_html_e( 'Submit Your Event', 'ultimate-event-manager' ); ?></h2>
        <?php echo do_shortcode('[event_submission_form]'); ?>
    </div>

<?php endwhile; endif; ?>

</div>

<?php get_footer(); ?>
