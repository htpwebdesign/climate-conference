<?php
/**
 * Canadian Climate Conference Archive template for Conference Speakers
 *
 * @package Canadian_Climate_Conference
 */

get_header();

$selected_industry = isset($_GET['conference-industry-type']) ? sanitize_text_field($_GET['conference-industry-type']) : 'all';
$selected_date = isset($_GET['conference-date']) ? sanitize_text_field($_GET['conference-date']) : 'all';
$selected_event = isset($_GET['conference-event-type']) ? sanitize_text_field($_GET['conference-event-type']) : 'all';


$args = array(
    'post_type'      => 'conference-speakers',
    'posts_per_page' => -1,
);

if ($selected_industry !== 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'conference-industry-type',
        'field'    => 'slug',
        'terms'    => $selected_industry,
    );
}
if ($selected_date !== 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'conference-date',
        'field'    => 'slug',
        'terms'    => $selected_date,
    );
}
if ($selected_event !== 'all') {
    $args['tax_query'][] = array(
        'taxonomy' => 'conference-event-type',
        'field'    => 'slug',
        'terms'    => $selected_event,
    );
}

$speakers_query = new WP_Query($args);
?>

<!-- Industry Dropdown -->
<label for="conference-industry-type">Industry: </label>
<select name="conference-industry-type" id="industry-type" onchange="filterSpeakers()">
    <option value="all" <?php selected($selected_industry, 'all'); ?>>All</option>
    <?php
   
    $industry_terms = get_terms(array(
        'taxonomy'   => 'conference-industry-type', // Replace with the correct taxonomy name
        'hide_empty' => true,
    ));


    foreach ($industry_terms as $term) {
        $option_value = 'conference-industry-type-' . $term->slug;
        $option_label = $term->name;
        $selected = ($selected_industry === $term->slug || ($selected_industry === 'all' && $term->slug === '')) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($option_label) . '</option>';
    }
    ?>
</select>

<!-- Date Dropdown -->
<label for="conference-date">Date: </label>
<select name="conference-date" id="conference-date" onchange="filterSpeakers()">
    <option value="all" <?php selected($selected_date, 'all'); ?>>All</option>
    <?php
    // Get all unique date terms for the speaker posts
    $date_terms = get_terms(array(
        'taxonomy'   => 'conference-date', // Replace with the correct taxonomy name
        'hide_empty' => true,
    ));

    // Output the date options in the dropdown
    foreach ($date_terms as $term) {
        $option_value = 'conference-date-' . $term->slug;
        $option_label = $term->name;
        $selected = ($selected_date === $term->slug || ($selected_date === 'all' && $term->slug === '')) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($option_label) . '</option>';
    }
    ?>
</select>

<!-- Event Dropdown -->
<label for="conference-event-type">Event Type: </label>
<select name="conference-event-type" id="event-type" onchange="filterSpeakers()">
    <option value="all" <?php selected($selected_event, 'all'); ?>>All</option>
    <?php
    
    $event_terms = get_terms(array(
        'taxonomy'   => 'conference-event-type', // Replace with the correct taxonomy name
        'hide_empty' => true,
    ));

    
    foreach ($event_terms as $term) {
        $option_value = 'conference-event-type-' . $term->slug;
        $option_label = $term->name;
        $selected = ($selected_event === $term->slug || ($selected_event === 'all' && $term->slug === '')) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($term->slug) . '" ' . $selected . '>' . esc_html($option_label) . '</option>';
    }
    ?>
</select>

<section class="all-speakers-section">
    <h2 class="all-speakers-title">Speakers</h2>

    <div class="all-speakers-container">
        <?php
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
