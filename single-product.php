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


            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile;

        // Check if WooCommerce is active
        if (class_exists('WooCommerce')) {

            woocommerce_content();
        }
        ?>
    </main>

    <?php
    get_footer();
    ?>