<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header(); ?>

<div class="ak-event-archive">
    <h1><?php post_type_archive_title(); ?></h1>
    <div class="ak-event-grid">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="ak-event-card">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'medium' ); ?>
                        <?php endif; ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php echo esc_html( get_post_meta( get_the_ID(), '_event_date_time', true ) ); ?></p>
                        <p><?php echo get_the_term_list( get_the_ID(), 'event_category', '', ', ', '' ); ?></p>
                    </a>
                </div>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e( 'No events found.', 'ultimate-event-manager' ); ?></p>
        <?php endif; ?>
    </div>
    <div class="ak-event-form">
        <h2><?php esc_html_e( 'Submit Your Event', 'ultimate-event-manager' ); ?></h2>
        <?php echo do_shortcode('[event_submission_form]'); ?>
    </div>
</div>

<?php get_footer(); ?>