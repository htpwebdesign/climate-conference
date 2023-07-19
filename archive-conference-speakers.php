<?php
/**
 * Canadian Climate Conference Archive template for Conference Speakers
 *
 * @package Canadian_Climate_Conference
 */

get_header();

$selected_industry = isset( $_GET['conference-industry-type'] ) ? sanitize_text_field( $_GET['conference-industry-type'] ) : 'all';

$args = array(
	'post_type'      => 'conference-speakers',
	'posts_per_page' => -1,
	'tax_query'      => array(),
);

if ( $selected_industry !== 'all' ) {
	$args['tax_query'][] = array(
		'taxonomy' => 'conference-industry-type',
		'field'    => 'slug',
		'terms'    => $selected_industry,
	);
}

$speakers_query = new WP_Query( $args );
?>
<label class="label" for="conference-industry-type">Industry: </label>
<select name="conference-industry-type" id="industry-type" onchange="filterSpeakers()">
	<option value="all" <?php selected( $selected_industry, 'all' ); ?>>All</option>
	<?php
	$industry_terms = get_terms( array(
		'taxonomy'   => 'conference-industry-type',
		'hide_empty' => true,
	) );

	foreach ( $industry_terms as $term ) {
		$selected = selected( $selected_industry, $term->slug, false );
		echo '<option value="' . esc_attr( $term->slug ) . '" ' . $selected . '>' . esc_html( $term->name ) . '</option>';
	}
	?>
</select>

<div class="all-speakers-container">
	<?php
	if ( $speakers_query->have_posts() ) :
		while ( $speakers_query->have_posts() ) :
			$speakers_query->the_post();

			if ( get_field( 'portrait_' ) && get_field( 'job_title_and_company' ) && get_the_title() ) {

				$speaker_portrait_id = get_field( 'portrait_', false, false );
				$speaker_portrait    = wp_get_attachment_image( $speaker_portrait_id, 'medium' );

				$speaker_name  = esc_html( get_the_title() );
				$speaker_title = esc_html( get_field( 'job_title_and_company' ) );

				// Retrieve the industry taxonomy term for the speaker
				$industry_terms  = get_the_terms( $post->ID, 'conference-industry-type' );
				$speaker_industry = '';

				if ( $industry_terms && ! is_wp_error( $industry_terms ) ) {
					$industry_term    = array_shift( $industry_terms );
					$speaker_industry = $industry_term->slug;
				}
				?>

				<div class="single-speaker" data-industry="<?php echo esc_attr( $speaker_industry ); ?>">
					<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" target="_blank">
						<?php echo $speaker_portrait; ?>
						<p><?php echo $speaker_name; ?></p>
						<p><?php echo $speaker_title; ?></p>
					</a>
				</div>

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

<?php
get_footer();
?>
