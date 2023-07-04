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

        <div class="tab-container">
            <button class="tablink" onclick="openTab(event, 'day1')">Day 1</button>
            <button class="tablink" onclick="openTab(event, 'day2')">Day 2</button>
        </div>


        <div id="day1" class="tabcontent">
            <?php
            // Display events for day 1
            function display_events_day1()
            {
                $args = array(
                    'post_type'      => 'ccc-events',
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
                    'post_type'      => 'ccc-events',
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