<?php
/**
 * The template for the front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Canadian_Climate_Conference
 */

get_header(); ?>

<main id="primary" class="site-main"> <?php

    if ( function_exists( 'get_field' ) ) :

        // Check if the post has any ACF fields
        if( get_field( 'hero_heading' ) && get_field( 'canadian_climate_conference' ) ) : ?>

            <header>
                <h1><?php the_field( 'hero_heading' ); ?></h1> <?php

                if ( the_field( 'conference_dates' ) ) : ?>
                    <p><?php the_field( 'conference_dates' ); ?></p> <?php 
                endif; 

                if ( the_field( 'venue_name' ) ) : ?>
                    <p><?php the_field( 'venue_name' ); ?></p> <?php
                endif;               

                if ( get_field( 'canadian_climate_conference' ) ) : ?>

                    <!-- Hero slider class required for slick -->
                    <div class="hero-slider"> <?php

                        $images = get_field('canadian_climate_conference');
                        foreach ( $images as $image ) :
    
                            $image_id = $image['ID'];
                            $image_attachment = wp_get_attachment_image( $image_id, 'full' ); ?>
    
                            <!-- slick slider info will go here -->
                            <div class="hero-image-container"> <?php 
                                echo $image_attachment; ?>
                            </div> <?php
    
                        endforeach; ?>
                    </div> <?php

                endif; ?>
            </header> <?php

        endif; ?>

        <section> <?php
            if ( the_field( 'hero_subtext_left' ) && the_field( 'hero_subtext_right' ) ) : ?>
                <p><?php the_field( 'hero_subtext_left' ); ?></p> 
                <p><?php the_field( 'hero_subtext_right' ); ?></p> <?php 
            endif;         

            if ( get_field( 'call_to_action_1' ) ) : 
                $call_to_action_1 = get_field( 'call_to_action_1' ); ?>

                <a href="<?php esc_url( $call_to_action_1[ 'url' ] ) ?>"> <?php 
                    echo esc_html( $call_to_action_1[ 'title' ] ) ?>
                </a> <?php
            endif; ?>
        </section> <?php


        //featured industries template
        get_template_part( 'template-parts/featured-industries', 'home' );     

        //featured speakers template
        get_template_part( 'template-parts/featured-speakers', 'home' );

        $call_to_action_2 = get_field( 'call_to_action_2' );
        if ( $call_to_action_2 ) : ?>
            <a href="<?php esc_url( $call_to_action_2[ 'url' ] ) ?>"> <?php 
                echo esc_html( $call_to_action_2[ 'title' ] ) ?>
            </a> <?php
        endif;

        
        if ( get_field( 'call_to_action_3' ) ) : 
            $call_to_action_3 = get_field( 'call_to_action_3' ); ?>

            <a href="<?php esc_url( $call_to_action_3[ 'url' ] ) ?>"> <?php 
                echo esc_html( $call_to_action_3[ 'title' ] ) ?>
            </a> <?php
        endif;

        //statistics section
        if ( the_field( 'statistics_top_right' ) && the_field( 'statistics_bottom_left' ) ) : ?>
            <figure class="statistics">
                <p> <?php the_field( 'statistics_top_right' ); ?> </p>    
                <p> <?php the_field( 'statistics_bottom_left' ); ?> </p>
            </figure> <?php 
        endif; 

        //featured sponsors template
        get_template_part( 'template-parts/featured-sponsors', 'home' );
    
        if ( get_field( 'call_to_action_4' ) ) : 
            $call_to_action_4 = get_field( 'call_to_action_4' );?>

            <a href="<?php esc_url( $call_to_action_4[ 'url' ] ) ?>"><?php 
                echo esc_html( $call_to_action_4[ 'title' ] ) ?>
            </a> <?php
        endif;

        //google maps section
        if( get_field( 'venue_map' ) ): 
            $venue_map = get_field( 'venue_map' ); ?>

            <div class="acf-map" data-zoom="16">
                <div class="marker" 
                    data-lat="<?php echo esc_attr( $venue_map[ 'lat' ] ); ?>" 
                    data-lng="<?php echo esc_attr( $venue_map[ 'lng' ] ); ?>">
                </div>
            </div> <?php 
        endif; 

        if ( the_field( 'venue_name' ) ) : ?>
            <section>
                <p><?php the_field( 'venue_name' ); ?></p>
                <p><?php the_field( 'venue_address' ); ?></p>
                <p><?php the_field( 'venue_phone_number' ); ?></p>
            </section> <?php
        endif; ?>

        <a href='mailto:<?php the_field( 'conference_e-mail' ); ?>'> <?php 
            the_field( 'conference_e-mail' ); ?>
        </a> <?php

    else: ?>
        <p>Oops! Something went wrong. Please check back later.</p> <?php
    endif; ?>

</main><!-- #main --> <?php
get_footer();