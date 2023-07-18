<?php

/**
 * Canadian Climate Conference Home page - Featured speakers template
 *
 *
 * @package Canadian_Climate_Conference
 */

if (function_exists('get_field')) :

    //get all speakers with the industry taxonomy 'featured'
    $args = array(
        'post_type'         => 'conference-speakers',
        'posts_per_page'    => -1,
        'tax_query'         => array(
            array(
                'taxonomy'  => 'conference-industry-type',
                'field'     => 'slug',
                'terms'     => 'featured-speaker'
            )
        )
    );

    $featured_speakers = new WP_Query($args); ?>

    <section class="featured-speakers-section"> <?php

                                                //output the featured speakers
                                                if ($featured_speakers->have_posts()) : ?>

            <h2 class="featured-speakers-title">Featured Speakers:</h2>

            <div class="speaker-slider featured-speaker-container"> <?php

                                                                    while ($featured_speakers->have_posts()) :

                                                                        $featured_speakers->the_post();

                                                                        //check if the speaker has a portrait, job title, and name, if none, display a message
                                                                        if (get_field('portrait_') && get_field('job_title_and_company') && get_the_title()) :

                                                                            $speaker_portrait_id = get_field('portrait_', false, false);
                                                                            $speaker_portrait = wp_get_attachment_image($speaker_portrait_id, 'full');

                                                                            $speaker_name = esc_html(get_the_title());
                                                                            $speaker_title = esc_html(get_field('job_title_and_company')); ?>

                        <div class="single-speaker">

                            <a class="speaker-info" href="<?php echo get_permalink($post->ID) ?>" target="_blank">
                                <?php echo $speaker_portrait; ?>
                                <p><?php echo $speaker_name; ?></p>
                                <p><?php echo $speaker_title; ?></p>
                            </a>
                        </div> <?php

                                                                        else : ?>

                        <p>Sorry, no featured speakers to display.</p> <?php

                                                                        endif;

                                                                    endwhile;
                                                                    wp_reset_postdata(); ?>

            </div> <?php

                                                else : ?>

            <p>Sorry, no featured speakers to display.</p> <?php

                                                        endif; ?>
    </section> <?php

            else : ?>

    <p>Oops! Something went wrong. Please check back later.</p> <?php

                                                            endif;
                                                                ?>