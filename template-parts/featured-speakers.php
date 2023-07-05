<?php

/**
 * Canadian Climate Conference Home page - Featured speakers template
 *
 *
 * @package Canadian_Climate_Conference
 */

//get all speakers with the taxonomy 'featured'
$featured_speakers = get_posts(array(
    'post_type'         => 'conference-speakers',
    'posts_per_page'    => -1,
    'tax_query'         => array(
        array(
            'taxonomy'  => 'conference-industry-type',
            'field'     => 'slug',
            'terms'     => 'featured-speaker'
        )
    )
));

//output the  featured speakers
if ($featured_speakers) { ?>

    <section class="featured-speakers-section">

        <div class="featured-speakers-container">

            <h2 class="featured-speakers-title">Featured Speakers:</h2>

            <div class="featured-speakers-row"> <?php

                foreach ($featured_speakers as $post) {

                    setup_postdata( $post );

                    $speaker_portrait = get_field( 'portrait_' ); 
                    $speaker_name = esc_html( get_the_title() ); 
                    $speaker_title = esc_html( get_field( 'job_title_and_company' ) );

                    $terms = get_the_terms($post->ID, 'conference-industry-type'); 
                    foreach ($terms as $term) {
                        if ($term->slug == 'featured-speaker') {

                            $term_link = get_term_link( $term ); ?>
                            
                            <div class="featured-speakers-col">
                                
                                <a href="<?php echo $term_link ?>" target="_blank"> 
                                    <img class="featured-speakers-logo" 
                                        src="<?php echo $speaker_portrait; ?>" 
                                        alt="<?php echo `an image of $speaker_name`; ?>">
                                    <p><?php echo $speaker_name ?></p>
                                    <p><?php echo $speaker_title ?></p>
                                </a> 
                            </div><?php
                        }
                    }
                } ?>

            </div>

        </div>

    </section> <?php

    wp_reset_postdata();
}
?>