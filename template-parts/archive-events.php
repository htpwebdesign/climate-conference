<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            the_archive_title('<h1 class="page-title">', '</h1>');
            the_archive_description('<div class="archive-description">', '</div>');
            ?>
        </header><!-- .page-header -->

        <?php
        // Display events based on categories "day-1" and "day-2"
        function display_events_by_category()
        {
            $args = array(
                'post_type'      => 'schedule', // Replace 'event' with your custom post type slug
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'event-day', // Replace 'event_category' with your custom taxonomy slug
                        'field'    => 'slug',
                        'terms'    => array('day-1', 'day-2'), // Categories to display
                    ),
                ),
                'posts_per_page' => -1, // Set the number of posts to display (-1 for all)
            );

            $events_query = new WP_Query($args);

            // Check if there are events to display
            if ($events_query->have_posts()) {
                echo '<div class="event-list">';

                while ($events_query->have_posts()) {
                    $events_query->the_post();
                    get_template_part('template-parts/content', 'schedule-filter'); // Change 'event' to match your content template file name
                }

                echo '</div>';
            }

            wp_reset_postdata();
        }

        // Call the function to display the events by category
        display_events_by_category();
        ?>

    <?php else : ?>

        <?php get_template_part('template-parts/content', 'none'); ?>

    <?php endif; ?>

</main><!-- #main -->

<?php
get_footer();
?>