<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Looks like that page doesn&rsquo;t exist.', 'climate-conference' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'Nothing here! Check out some of our blog posts to get the latest information on the Canadian Climate Conference.', 'climate-conference' ); ?></p>
				

					<?php

					the_widget( 'WP_Widget_Recent_Posts' );
					?>
					</div><!-- .widget -->

					<a class='home-link' href="<?php echo home_url(); ?>">Go back to the home page.</a>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
