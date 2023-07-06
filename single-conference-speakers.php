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
        $speaker_info = get_field('speaker_info');

    ?>
        <div class="speaker-info">
            <?php if ($portrait_id) : ?>
                <div class="portrait">
                    <?php echo wp_get_attachment_image($portrait_id, 'full'); ?>
                </div>
            <?php endif; ?>

            <?php if ($job_title_and_company) : ?>
                <div class="job-title-and-company">
                    <p><?php echo $job_title_and_company; ?></p>
                </div>
            <?php endif; ?>

            <?php if ($speaker_info) : ?>
                <div class="speaker-info-acf">
                    <?php echo $speaker_info; ?>
                </div>
            <?php endif; ?>
        </div>

    <?php
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