<?php

/**
 * Canadian Climate Conference Home page - Featured sponsors template
 *
 *
 * @package Canadian_Climate_Conference
 */



 if ( function_exists( 'get_field' ) ) :

    //get all sponsors with the taxonomy 'featured-industry'
    $args = array(
        'post_type'         => 'conference-events',
        'posts_per_page'    => -1,
        'tax_query'         => array(
            array(
                'taxonomy'  => 'conference-industry-type',
                'field'     => 'slug',
                'terms'     => 'featured-industry'
            )
        )
    );


    $featured_industries = new WP_Query( $args );

    if ( $featured_industries->have_posts() ) : ?>

        <section class="featured-industry-section">
            <h2 class="featured-industry-title">Featured Industries:</h2>
            <nav class="featured-industry-nav"> <?php
        
                while ( $featured_industries->have_posts() ) : 

                    $featured_industries->the_post(); 

                    if ( get_field( 'start_time' ) && get_field( 'duration' ) && get_field( 'event_information' ) ) :

                        $terms = get_the_terms($featured_industries->ID, 'conference-industry-type');

                        if ($terms && !is_wp_error($terms)) :
                            
                            foreach ($terms as $term) :

                                // Exclude the 'featured-industry' term
                                if ($term->slug != 'featured-industry') : ?>

                                    <div class="industry-item">
                                        <a href="<?php echo get_term_link( $term );?>">
                                            <?php echo $term->name; ?>
                                        </a>
                                    </div> <?php

                                endif;

                            endforeach;

                        endif;

                    endif; 

                endwhile;
                wp_reset_postdata(); ?>

            </nav>  
                    
        </section> <?php

    else : ?>

        <p>There are currently no featured industries yet. Please check back later.</p> <?php

    endif;

else : ?>

    <p>Oops! Something went wrong. Please check back later.</p> <?php

endif;


?>