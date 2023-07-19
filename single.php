<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main-news">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-news-subtitle">' . esc_html__( '< Previous', 'climate-conference' ) . '</span>',
				'next_text' => '<span class="nav-news-subtitle">' . esc_html__( 'Next>', 'climate-conference' ) . '</span>',
			)
		);

	endwhile; // End of the loop.
	?>

</main><!-- #main -->

<?php
get_footer();
