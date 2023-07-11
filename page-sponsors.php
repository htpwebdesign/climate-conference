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

<main id="primary" class="site-main">

	<?php
	while (have_posts()) :
		the_post();

		get_template_part('template-parts/content', '');

		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;

	endwhile; // End of the loop.

	?><div class="sponsor-wrapper"><?php

	$taxonomy  = 'conference-sponsors-taxonomy';
		$terms = get_terms(
			array(
				'taxonomy' => $taxonomy,
				'orderby' => 'ID'
			)
		);

	if($terms && ! is_wp_error($terms) ){
		foreach($terms as $term){
			$args = array(
				'post_type'      => 'conference-sponsors',
				'posts_per_page' => -1,
				'order'          => 'DESC',
				'orderby'        => 'ID',
				'tax_query'      => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $term->slug,
					)
				),
			);

			$query = new WP_Query( $args ); ?>
				<section class="sponsor-types"> <?php
				if ( $query -> have_posts() ) {
					
					echo '<h2>' . esc_html( $term->name ) . '</h2>';
					while ( $query -> have_posts() ) {
						$query -> the_post();
						if (function_exists('get_field')){
							?> <div class="single-sponsor"> <?php 

							$image = get_field('logo');
							$size = 'medium';
							if($image) {
								echo wp_get_attachment_image( $image, $size );
							}

							

							$link = get_field('link');
							if ($link){
								$link_url = $link['url'];
    							$link_title = $link['title']; ?>
								<a href="<?php echo esc_url( $link_url ); ?>"><?php echo esc_html( $link_title ); ?></a> <?php
							}

							if (get_field('description') ) { ?>
								<p><?php the_field('description'); ?></p><?php
							}

							?> </div> <?php
						}
					}
					wp_reset_postdata();
				}
				?> </section> <?php
			}
		} ?>

		<a class="sponsor-button" href="<?php echo esc_url(get_permalink(281)); ?>">Become A Sponsor</a>
				<?php

	?> </div> 

</main><!-- #main -->

<?php
get_footer();
