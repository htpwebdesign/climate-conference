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
    while (have_posts()) :
        the_post();

        $job_title_and_company = get_field('job_title_and_company');
        $portrait_id = get_field('portrait_', false, false);
        $speaker_name = esc_html(get_the_title());
        $speaker_info = get_field('speaker_info');

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

    ?>
        <?php if ($portrait_id) : ?>
            <div class="portrait">
                <?php echo wp_get_attachment_image($portrait_id, 'full'); ?>
            </div>
        <?php endif; ?>

        <?php if ($speaker_info) : ?>
    <p class="speaker-info-acf">
        <?php echo $speaker_info; ?>
    </p>
<?php endif; ?>


        <?php
        // Close speaker-info div
        if ($speaker_name || $job_title_and_company) {
            echo '</div>';
        }

        // Display speaker content
        get_template_part('template-parts/content', 'single');

        the_post_navigation(
            array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'climate-conference') . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'climate-conference') . '</span> <span class="nav-title">%title</span>',
            )
        );

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;


    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
?>
