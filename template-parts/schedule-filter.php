<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main">


<?php if (have_posts()) : ?>

    <?php

    $args = array(
        'post_type'      => 'conference-events', // Replace 'event' with your custom post type slug
        'posts_per_page' => -1, // Specify the number of events to display
        'meta_query'     => array(
            array(
                'key'     => 'conference-industry-type', // Replace 'industry_type' with the actual meta key for industry type
                'value'   => $industry,
                'compare' => '=',
            ),
            array(
                'key'     => 'conference-event-type', // Replace 'industry_type' with the actual meta key for industry type
                'value'   => $event,
                'compare' => '=',
            ),
        ),
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) {
    ?>


    get_template_part('template-parts/content', get_post_type());

    <?php
        while ($query->have_posts()) {
            $query->the_post();
            // Display event details like title, date, location, etc.
            the_title('<h2>', '</h2>');
            the_date();
            the_content();
        }
    } else {
        // No events found
        echo 'No events found.';
    }

    wp_reset_postdata();
    ?>

</main><!-- #main -->

<?php
get_footer();
