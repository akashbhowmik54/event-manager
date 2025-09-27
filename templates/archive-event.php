<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header(); ?>

<div class="ak-event-archive container">
    
    <!-- Archive Header -->
    <header class="ak-event-header">
        <h1 class="ak-event-title"><?php post_type_archive_title(); ?></h1>
        <p class="ak-event-subtitle"><?php esc_html_e( 'Discover upcoming events and submit your own!', 'ultimate-event-manager' ); ?></p>
    </header>

    <!-- Event Grid -->
    <div class="ak-event-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="ak-event-card">
                    <a href="<?php the_permalink(); ?>" class="ak-event-link">
                        <div class="ak-event-thumb">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( ULMR_EVENT_MANAGER_URL . '/assets/images/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="ak-event-content">
                            <h2 class="ak-event-name"><?php the_title(); ?></h2>
                            <p class="ak-event-date">
                                <i class="dashicons dashicons-calendar"></i>
                                <?php 
                                    $raw_date = get_post_meta( get_the_ID(), '_event_date_time', true );
                                    if ( $raw_date ) {
                                        $timestamp = strtotime( $raw_date );
                                        echo esc_html( date_i18n( 'F j, Y \a\t g:i A', $timestamp ) );
                                    }
                                ?>
                            </p>
                            <p class="ak-event-category">
                                <i class="dashicons dashicons-tag"></i>
                                <?php echo get_the_term_list( get_the_ID(), 'event_category', '', ', ', '' ); ?>
                            </p>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>

            <div class="ak-event-pagination">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p class="ak-no-events"><?php esc_html_e( 'No events found.', 'ultimate-event-manager' ); ?></p>
        <?php endif; ?>
    </div>

    <!-- Event Submission Form -->
    <div class="ak-event-form">
        <h2><?php esc_html_e( 'Submit Your Event', 'ultimate-event-manager' ); ?></h2>
        <p><?php esc_html_e( 'Share your event with the community. Fill out the form below to submit.', 'ultimate-event-manager' ); ?></p>
        <?php echo do_shortcode('[event_submission_form]'); ?>
    </div>

</div>

<?php get_footer(); ?>
