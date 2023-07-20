	<?php

	/**
	 * The template for displaying ticket pages
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

	<main id="primary" class="site-main">

		<?php
		while (have_posts()) :
			the_post();

			echo "<h1 id='entry-title'>Tickets</h1>";

			// Display Tickets 
			if (class_exists('WooCommerce')) {
				// Display General Admission tickets
				echo "<h2 class='ticketClass'>General</h2>";
				echo do_shortcode('[products category="general"]');

				// Display VIP tickets
				echo "<h2 class='ticketClass'>VIP</h2>";
				echo do_shortcode('[products category="vip"]');
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main>

	<?php

	get_footer();
	?>