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

            <header class="home-header"> <?php
                
                if ( get_field( 'canadian_climate_conference' ) ) : ?>

                    <!-- Hero slider class required for slick -->
                    <div class="hero-container">

                        <div class="hero-slider"> <?php
                        $images = get_field('canadian_climate_conference');
                        foreach ( $images as $image ) :
    
                            $image_id = $image['ID'];
                            $image_attachment = wp_get_attachment_image( $image_id, 'full' ); 
                            echo $image_attachment; 
    
                        endforeach; ?>
                        </div> 
                    </div><?php


                endif; 

                $conference_dates = get_field( 'conference_dates' );
                $venue_name = get_field( 'venue_name' ); ?> 
                
                <div class="hero-text">
                    <h1><?php the_field( 'hero_heading' ); ?></h1>
                    <p><?php the_field( 'conference_dates' ); ?></p> 

                    <p><?php the_field( 'venue_name' ); ?></p> 
                </div> 

                
            </header> <?php

        endif; ?>

        <section class="hero-lower-subtext">
            <?php
                $hero_subtext_left = get_field( 'hero_subtext_left' );
                $hero_subtext_right = get_field( 'hero_subtext_right' );
                if ( $hero_subtext_left && $hero_subtext_right ) : ?>
                    <p><?php echo $hero_subtext_left; ?></p> 
                    <p><?php echo $hero_subtext_right; ?></p> <?php 
                endif;         

                if ( get_field( 'call_to_action_1' ) ) : 
                    $call_to_action_1 = get_field( 'call_to_action_1' ); ?>

                    <a class="call-to-action" href="<?php echo esc_url( $call_to_action_1[ 'url' ] ) ?>"> <?php 
                        echo esc_html( $call_to_action_1[ 'title' ] ) ?>
                    </a> <?php
                endif; ?>
        </section> <?php



        //featured industries template
        get_template_part( 'template-parts/featured-industries', 'home' );     

        //featured speakers template
        get_template_part( 'template-parts/featured-speakers', 'home' ); ?>

        <div class="cta-container"> <?php
            $call_to_action_2 = get_field( 'call_to_action_2' );
            if ( $call_to_action_2 ) : ?>
                <a class="call-to-action" href="<?php esc_url( $call_to_action_2[ 'url' ] ) ?>"> <?php 
                    echo esc_html( $call_to_action_2[ 'title' ] ) ?>
                </a> <?php
            endif;
    
            
            if ( get_field( 'call_to_action_3' ) ) : 
                $call_to_action_3 = get_field( 'call_to_action_3' ); ?>
    
                <a class="call-to-action" href="<?php esc_url( $call_to_action_3[ 'url' ] ) ?>"> <?php 
                    echo esc_html( $call_to_action_3[ 'title' ] ) ?>
                </a> <?php
            endif; ?>
        
        </div> <?php


        //statistics section
        $statistics_right = get_field( 'statistics_top_right' );
        $statistics_left = get_field( 'statistics_bottom_left' );
        if ( $statistics_left && $statistics_right ) : ?>
            <figure class="statistics">
                <div>
                    <p> <?php the_field( 'statistics_top_right' ); ?> </p>    
                </div>
                <div></div>
                <div>
                    <p> <?php the_field( 'statistics_bottom_left' ); ?> </p>
                </div>
                <div></div>
            </figure> <?php 
        endif; 

        //featured sponsors template
        get_template_part( 'template-parts/featured-sponsors', 'home' );
    
        if ( get_field( 'call_to_action_4' ) ) : 
            $call_to_action_4 = get_field( 'call_to_action_4' );?>

            <a class="call-to-action" href="<?php esc_url( $call_to_action_4[ 'url' ] ) ?>"><?php 
                echo esc_html( $call_to_action_4[ 'title' ] ) ?>
            </a> <?php
        endif; ?>

        <section class="map-section"> <?php
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

            $venue_name = get_field( 'venue_name' );
            $venue_address = get_field( 'venue_address' );
            $venue_phone_number = get_field( 'venue_phone_number' );
            $conference_email = get_field( 'conference_e-mail' );

            if ( $venue_name ) : ?>
                <section class="venue-details">
                    <p><?php echo $venue_name; ?></p>
                    <p><?php echo $venue_address; ?></p>
                    <p><?php echo $venue_phone_number; ?></p>
                    <a href='mailto:<?php echo $conference_email; ?>'> <?php 
                        echo $conference_email; ?>
                    </a>
                </section> <?php
            endif;
            else: ?>
            <p>Oops! Something went wrong. Please check back later.</p> <?php
            endif; ?>
        </section>


</main><!-- #main --> <?php
get_footer();