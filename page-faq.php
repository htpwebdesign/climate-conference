<?php

/**
 * The template for FAQ page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */


require('template-parts/content-faq.php');

get_header();
?>

<main id="primary" class="site-main">

<?php
faq_section('general');

faq_section('faq');

faq_section('about');
?>

</main><!-- #main -->
<?php
get_sidebar();
get_footer();
?>