<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main single-product-main">

    <?php
    while (have_posts()) :
        the_post();

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;

    endwhile; // End of the loop.

    // Check if WooCommerce is active
    if (class_exists('WooCommerce')) {
        // Output the WooCommerce product loop
        woocommerce_content();
    }
    ?>

</main><!-- #main -->

<?php



get_footer();
?>