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

        <div class="button-container">
            <div class="tab-container">
                <button class="tablink" onclick="openTab(event, 'day1')">Day 1</button>
                <button class="tablink" onclick="openTab(event, 'day2')">Day 2</button>
            </div>

            <?php


            // Industry / Event Taxonomies 
            $industry = isset($_GET['conference-industry-type']) ? sanitize_text_field($_GET['conference-industry-type']) : '';
            $event = isset($_GET['conference-event-type']) ? sanitize_text_field($_GET['conference-event-type']) : '';

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


            <!-- Script to filter events and industries -->
            <script>
                function filterSchedule() {
                    let eventSelected = document.getElementById("event-type");
                    let industrySelected = document.getElementById("industry-type");


                    let selectedEvent = eventSelected.value;
                    let selectedIndustry = industrySelected.value;


                    let events = document.getElementsByClassName("conference-events");

                    // Display or hide based on selection 
                    for (let i = 0; i < events.length; i++) {
                        let event = events[i];

                        // if selectedEvents = selectedEvents dropdown, display block else display none 
                        if (selectedEvent === "all" || event.classList.contains(selectedEvent)) {
                            event.style.display = "block";
                        } else {
                            event.style.display = "none";
                        }

                        // the industry filter acts as a secondary filter, is to REMOVE things that dont match. From the remaining elements on screen.
                        // if the events do not match the selectedIndustry display none 
                        if (!event.classList.contains(selectedIndustry)) {
                            event.style.display = "none";
                        }
                    }
                }
            </script>

            <!-- Event -->
            <label for="conference-event-taxonomy">Event: </label>
            <select name="conference-event-taxonomy" id="event-type" onchange="filterSchedule()">
                <option value="all" selected="selected">All</option>
                <?php
                // Grab all of the terms in conference-event-tax
                $event_terms = get_terms(array(
                    'taxonomy'   => 'conference-event-taxonomy'
                ));
                // Display all options 
                foreach ($event_terms as $term) {
                    $option_value = 'conference-event-taxonomy-' . $term->slug;
                    $option_label = $term->name;
                    echo '<option value="' . esc_attr($option_value) . '">' . esc_html($option_label) . '</option>';
                }
                ?>
            </select>


            <!-- Industry -->
            <label for="conference-industry-type">Industry: </label>
            <select name="conference-industry-type" id="industry-type" onchange="filterSchedule()">
                <option value="all" selected="selected">All</option>
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
                                'terms'    => 'day-1', // Day 1 category slug
                            ),
                        ),
                        'posts_per_page' => -1, // -1 To display all 
                    );

                    $events_query = new WP_Query($args);

                    // Check if there are events to display
                    if ($events_query->have_posts()) {
                        echo '<div class="event-list">';
                        while ($events_query->have_posts()) {
                            $events_query->the_post();

                            get_template_part('template-parts/content', get_post_type());
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
                        'posts_per_page' => -1,  // -1 To display all 
                    );

                    $events_query = new WP_Query($args);

                    // Check if there are events to display
                    if ($events_query->have_posts()) {
                        echo '<div class="event-list">';
                        while ($events_query->have_posts()) {
                            $events_query->the_post();
                            get_template_part('template-parts/content', get_post_type());
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

        <!-- script function for day 1 / 2 tab  -->
        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
            }
        </script>

</main><!-- #main -->

<?php
get_footer();
?>


<!-- Add function register taax to flush in cpt  -->
<!-- remove archive news  -->
<!-- add built by in footer with links to portfolio -->