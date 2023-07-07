<?php
/**
 * Canadian Climate Conference Archive template for Conference Speakers
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<section class="all-speakers-section">
	<h2 class="all-speakers-title">Speakers</h2>

	<div class="all-speakers-container">
		<?php
		$args = array(
			'post_type'      => 'conference-speakers',
			'posts_per_page' => -1,
		);

		$speakers_query = new WP_Query($args);

		if ($speakers_query->have_posts()) :
			while ($speakers_query->have_posts()) :
				$speakers_query->the_post();

				if (get_field('portrait_') && get_field('job_title_and_company') && get_the_title()) {

					$speaker_portrait_id = get_field('portrait_', false, false);
					$speaker_portrait    = wp_get_attachment_image($speaker_portrait_id, 'medium');

					$speaker_name  = esc_html(get_the_title());
					$speaker_title = esc_html(get_field('job_title_and_company'));
					?>

					<div class="single-speaker">
						<a href="<?php echo esc_url(get_permalink($post->ID)); ?>" target="_blank">
							<?php echo $speaker_portrait; ?>
							<p><?php echo $speaker_name; ?></p>
							<p><?php echo $speaker_title; ?></p>
						</a>
					</div>

				<?php
				} else {
					?>
					<p>Sorry, no speakers to display.</p>
				<?php
				}
			endwhile;
		else :
			?>
			<p>Sorry, no speakers to display.</p>
		<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
</section>

<?php
get_footer();
?>
