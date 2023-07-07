<?php
/**
 * The template for displaying a single speaker post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	// Get the current speaker post
	$current_speaker_id = get_the_ID();

	// Query the speaker posts
	$args = array(
		'post_type'      => 'conference-speakers',
		'posts_per_page' => -1,
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
	);

	$speaker_query = new WP_Query($args);

	if ($speaker_query->have_posts()) :
		$current_index = -1;
		$speaker_ids   = array();

		while ($speaker_query->have_posts()) :
			$speaker_query->the_post();

			$speaker_ids[] = get_the_ID();

			if (get_the_ID() === $current_speaker_id) {
				$current_index = count($speaker_ids) - 1;
			}
		endwhile;

		// Reset post data
		wp_reset_postdata();

		if ($current_index > -1) {
			$current_speaker_id = $speaker_ids[$current_index];
			$current_speaker    = get_post($current_speaker_id);

			$job_title_and_company = get_field('job_title_and_company', $current_speaker_id);
			$portrait_id = get_field('portrait_', false, false);

			$speaker_name  = esc_html($current_speaker->post_title);
			$speaker_info  = get_field('speaker_info', $current_speaker_id);
			$speaker_title = get_the_title($current_speaker_id);

			// Display speaker name and job title and company
			if ($speaker_name || $job_title_and_company) {
				echo '<div class="speaker-info">';
				echo '<div class="job-title-and-company">';
				if ($speaker_name) {
					echo '<h1>' . $speaker_name . '</h1>';
				}
				if ($job_title_and_company) {
					echo '<h2>' . $job_title_and_company . '</h2>';
				}
				echo '</div>';
			}

			// Display speaker portrait
			if ($portrait_id) {
				echo '<div class="portrait">';
				echo wp_get_attachment_image($portrait_id, 'medium');
				echo '</div>';
			}

			if ($speaker_info) {
				echo '<p class="speaker-info-acf">' . $speaker_info . '</p>';
			}

			if ($speaker_name || $job_title_and_company) {
				echo '</div>';
			}

			// Previous speaker
			$prev_index        = ($current_index - 1 >= 0) ? $current_index - 1 : count($speaker_ids) - 1;
			$prev_speaker_id   = $speaker_ids[$prev_index];
			$prev_speaker_link = get_permalink($prev_speaker_id);
			$prev_speaker_title = get_the_title($prev_speaker_id);

			// Next speaker
			$next_index        = ($current_index + 1 < count($speaker_ids)) ? $current_index + 1 : 0;
			$next_speaker_id   = $speaker_ids[$next_index];
			$next_speaker_link = get_permalink($next_speaker_id);
			$next_speaker_title = get_the_title($next_speaker_id);

			// Output previous and next navigation
			echo '<div class="post-navigation">';
			echo '<div class="nav-previous">';
			if ($prev_speaker_id) {
				echo '<a href="' . esc_url($prev_speaker_link) . '" rel="prev">' . esc_html__('Previous:', 'climate-conference') . ' ' . esc_html($prev_speaker_title) . '</a>';
			}
			echo '</div>';

			echo '<div class="nav-next">';
			if ($next_speaker_id) {
				echo '<a href="' . esc_url($next_speaker_link) . '" rel="next">' . esc_html__('Next:', 'climate-conference') . ' ' . esc_html($next_speaker_title) . '</a>';
			}
			echo '</div>';
			echo '</div>';
		} else {
			echo '<p>Sorry, the speaker could not be found.</p>';
		}
	else :
		echo '<p>Sorry, no speakers to display.</p>';
	endif;
	?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if (comments_open() || get_comments_number()) :
		comments_template();
	endif;
	?>

</main><!-- #main -->

<?php
get_footer();
?>
