<?php

/**
 * The template for FAQ page, uses inc/faq-page-functions.php
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main"> <?php

                                        faq_section('about');

                                        faq_section('faq');

                                        faq_section('general');


                                        // contact form here
                                        echo do_shortcode('[gravityform id="4" title="true"]'); ?>

</main><!-- #main --> <?php

                        get_footer();
                        ?>