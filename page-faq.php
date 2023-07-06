<?php

/**
 * The template for FAQ page
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main">

<?php

faq_section('general');

faq_section('faq');

faq_section('about');


// contact form here
echo do_shortcode('[gravityform id="4" title="true"]');

?>

</main><!-- #main -->
<?php

get_footer();
?>