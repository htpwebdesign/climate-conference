<?php

/**
 * Canadian Climate Conference Home page - Featured sponsors template
 *
 *
 * @package Canadian_Climate_Conference
 */

if ( function_exists( 'get_field' ) ) :


    //get all sponsors with the industry taxonomy 'featured'
    $args = array(
        'post_type'         => 'conference-sponsors',
        'posts_per_page'    => -1,
        'tax_query'         => array(
            array(
                'taxonomy'  => 'conference-industry-type',
                'field'     => 'slug',
                'terms'     => 'featured-sponsors'
            )
        )
    );

    $featured_sponsors = new WP_Query( $args );

    //output the logo and link for all featured sponsors with the taxonomy 'featured'
    if ( $featured_sponsors->have_posts() ) : ?>

        <section class="featured-sponsors-section"> 

            <h2 class="featured-sponsors-title">Proudly Sponsored by:</h2> <?php

            while($featured_sponsors->have_posts()) :

                $featured_sponsors->the_post(); 

                //check for the logo and link fields, if none, display a message
                if ( get_field( 'logo' ) && get_field( 'link' ) ) : 
                    
                    $sponsor_logo_id = get_field( 'logo', false, false ); 
                    $sponsor_logo = wp_get_attachment_image( $sponsor_logo_id, 'full' );
                    $company_name = esc_html( get_the_title() ); ?>

                    <div class="single-sponsor">

                        <p><?php echo $company_name; ?></p>
                        <a href="<?php echo get_field( 'link' ); ?>" target="_blank"> <?php 
                            echo $sponsor_logo; ?>
                        </a>

                    </div> <?php

                else : ?>
                    <p>Sorry, no featured sponsors to display.</p> <?php

                endif; 

            endwhile;
            wp_reset_postdata(); ?>

        </section> <?php

    else : ?>
        <p>There are currently no sponsors yet. Please check back later.</p> <?php

    endif;

else : ?>
    <p>Oops! Something went wrong. Please check back later.</p> <?php

endif;
?>