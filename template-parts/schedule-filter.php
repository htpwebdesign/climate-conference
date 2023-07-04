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


$args = array(
    'post_type' => 'schedule', // Replace 'event' with your custom post type slug
    'posts_per_page' => 10, // Specify the number of events to display
);

$query = new WP_Query($args);

if ($query->have_posts()) {
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

<?php

		endwhile;

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
