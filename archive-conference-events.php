<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if (have_posts()) : ?>

        <header class="page-header">
            <?php
            echo "<h1>Schedule</h1>";
            ?>
        </header><!-- .page-header -->

        <!-- Day 1/2 Buttons -->
        <div class="button-container" id="button-container">
            <div class="tab-container">
                <button class="tablink" onclick="openTab(event, 'day1')">Day 1</button>
                <button class="tablink" onclick="openTab(event, 'day2')">Day 2</button>
            </div>
        </div>
        <?php


        // Industry / Event Taxonomies 
        $industry = isset($_GET['conference-industry-type']) ? sanitize_text_field($_GET['conference-industry-type']) : '';
        $event = isset($_GET['conference-event-type']) ? sanitize_text_field($_GET['conference-event-type']) : '';

        $industry_args = array(
            'taxonomy' => 'conference-industry-type',
            'hide_empty' => true
        );

        if ($industry !== 'all') {
            $industry_args['slug'] = $industry;
        }

        $industry_terms = get_terms($industry_args);

        $event_args = array(
            'taxonomy' => 'conference-event-type',
            'hide_empty' => true
        );

        if ($event !== 'all') {
            $event_args['slug'] = $event;
        }

        $event_terms = get_terms($event_args);


        $terms = get_terms(
            array(
                'post_type'      => 'conference-events',
                'posts_per_page' => -1,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'conference-industry-type',
                        'field'    => 'slug',
                        'terms'    => $industry,
                    ),
                    array(
                        'taxonomy' => 'conference-event-type',
                        'field'    => 'slug',
                        'terms'    => $event,
                    ),
                ),
            ),
        );

        ?>

        <!-- Industry -->
        <div class="industry-type-container">
            <label for="conference-industry-type">Industry: </label>
            <select name="conference-industry-type" id="industry-type" onchange="filterSchedule()">
                <option value="all" selected="selected" class="industry-options">All</option>
                <?php
                // Grab all of the terms in conference-event-tax
                $industry_terms = get_terms(array(
                    'taxonomy'   => 'conference-industry-type'
                ));
                // Display all options 
                foreach ($industry_terms as $term) {
                    $option_value = 'conference-industry-type-' . $term->slug;
                    $option_label = $term->name;
                    echo '<option value="' . esc_attr($option_value) . '">' . esc_html($option_label) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Event -->
        <div class="event-container">
            <label for="conference-event-type">Event Type: </label>
            <select name="conference-event-type" id="event-type" onchange="filterSchedule()">
                <option value="all" selected="selected" class="event-options">All</option>
                <?php
                // Grab all of the terms in conference-event-tax
                $event_terms = get_terms(array(
                    'taxonomy'   => 'conference-event-type'
                ));
                // Display all options 
                foreach ($event_terms as $term) {
                    $option_value = 'conference-event-type-' . $term->slug;
                    $option_label = $term->name;
                    echo '<option value="' . esc_attr($option_value) . '">' . esc_html($option_label) . '</option>';
                }
                ?>
            </select>
        </div>

        <div id="day1" class="tabcontent">
            <?php
            // Display events for day 1
            function display_events_day1()
            {
                $args = array(
                    'post_type'      => 'conference-events',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'conference-event-day',
                            'field'    => 'slug',
                            'terms'    => 'day-1',
                        ),
                    ),
                    'posts_per_page' => -1,
                    'meta_key'       => 'start_time',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'meta_type'      => 'TIME', // Specify the meta_type as TIME
                );

                $events_query = new WP_Query($args);

                // Check if there are events to display
                if ($events_query->have_posts()) {
                    echo '<div class="event-list">';
                    while ($events_query->have_posts()) {
                        $events_query->the_post();

                        $event_id      = get_the_ID(); // Get the ID of the current post
                        $title         = get_the_title();
                        $industry      = get_the_terms($event_id, 'conference-industry-type');
                        $description   = get_field('event_information', $event_id);
                        $start_time    = get_field('start_time', $event_id);
                        $speaker_name  = get_field('conference-events', $event_id);

                        // Format start time
                        $formatted_start_time = date('g:i A', strtotime($start_time));

                        $post_type = get_post_type(); // Get the current post type

                        // Get all classes related to the CPT ID
                        $cpt_classes = get_post_class('', $event_id);

                        // Combine classes grabbed from CPT ID into a single string
                        $cpt_class_string = implode(' ', $cpt_classes);
            ?>
                        <div class="event <?php echo $cpt_class_string; ?>" id="<?php echo $post_type . '-' . $event_id; ?>">
                            <div class="event-details">
                                <p class="start-time"><?php echo 'Start Time: ' . $formatted_start_time; ?></p>
                                <h2 class="event-title"><?php echo $title; ?></h2>
                            </div>
                            <button class="toggle-button" onclick="toggleAccordion('<?php echo $post_type . '-' . $event_id; ?>')">
                                <!-- Arrow  -->
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                                </svg>
                                <path d="M7 10l5 5 5-5z"></path>

                            </button>
                            <div class="panel">
                                <p><b>Industry:</b> <?php echo $industry[0]->name; ?></p>
                                <p>Featuring: <?php echo $speaker_name; ?></p>
                                <p><?php echo $description; ?></p>
                            </div>
                        </div>

            <?php
                    }
                    echo '</div>';
                } else {
                    echo '<p>No events found for Day 1.</p>';
                }

                wp_reset_postdata();
            }

            // Call function to display day 1
            display_events_day1();
            ?>
        </div>

        <div id="day2" class="tabcontent">
            <?php
            // Display events for day 2
            function display_events_day2()
            {
                $args = array(
                    'post_type'      => 'conference-events',
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'conference-event-day',
                            'field'    => 'slug',
                            'terms'    => 'day-2',
                        ),
                    ),
                    'posts_per_page' => -1,
                    'meta_key'       => 'start_time',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'meta_type'      => 'TIME', // Specify the meta_type as TIME
                );

                $events_query = new WP_Query($args);

                // Check if there are events to display
                if ($events_query->have_posts()) {
                    echo '<div class="event-list">';
                    while ($events_query->have_posts()) {
                        $events_query->the_post();

                        $event_id      = get_the_ID(); // Get the ID of the current post
                        $title         = get_the_title();
                        $industry      = get_the_terms($event_id, 'conference-industry-type');
                        $description   = get_field('event_information', $event_id);
                        $start_time    = get_field('start_time', $event_id);
                        $speaker_name  = get_field('conference-events', $event_id);

                        // Format start time
                        $formatted_start_time = date('g:i A', strtotime($start_time));

                        $post_type = get_post_type(); // Get the current post type

                        // Get all classes related to the CPT ID
                        $cpt_classes = get_post_class('', $event_id);

                        // Combine classes grabbed from CPT ID into a single string
                        $cpt_class_string = implode(' ', $cpt_classes);
            ?>
                        <div class="event <?php echo $cpt_class_string; ?>" id="<?php echo $post_type . '-' . $event_id; ?>">
                            <div class="event-details">
                                <p class="start-time"><?php echo 'Start Time: ' . $formatted_start_time; ?></p>
                                <h2 class="event-title"><?php echo $title; ?></h2>
                            </div>
                            <button class="toggle-button" onclick="toggleAccordion('<?php echo $post_type . '-' . $event_id; ?>')">
                                <!-- Arrow  -->
                                <svg class="arrow" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                                </svg>
                                <path d="M7 10l5 5 5-5z"></path>

                            </button>
                            <div class="panel">
                                <p><b>Industry:</b> <?php echo $industry[0]->name; ?></p>
                                <p>Featuring: <?php echo $speaker_name; ?></p>
                                <p><?php echo $description; ?></p>
                            </div>
                        </div>


            <?php
                    }
                    echo '</div>';
                } else {
                    echo '<p>No events found for Day 2.</p>';
                }

                wp_reset_postdata();
            }

            // Call function to display day 2
            display_events_day2();
            ?>
        </div>
    <?php else : ?>

        <?php get_template_part('template-parts/content', 'none'); ?>

    <?php endif; ?>

</main><!-- #main -->

<?php
// get_footer();
?>



<!-- add built by in footer with links to portfolio -->