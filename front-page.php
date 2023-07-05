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

get_header();

?>

<main id="primary" class="site-main">
 
    <?php
    // Check if the post has any ACF fields
    if( get_field( 'hero_heading' ) ):?>
 
        <h1> <?php the_field( 'hero_heading' ); ?> </h1>

        <p> <?php the_field( 'conference_dates' ); ?> </p>

        <p> <?php the_field( 'venue_name' ); ?> </p>

        <?php
        $images = get_field('canadian_climate_conference');

        if ($images) :
            foreach ($images as $image) :
                echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
            endforeach;
        endif;
        ?>


        <p> <?php the_field( 'hero_subtext_left' ); ?> </p>

        <p> <?php the_field( 'hero_subtext_right' ); ?> </p>

        <?php
        $call_to_action_1 = get_field( 'call_to_action_1' );
        if ( $call_to_action_1 ) : ?>
            <a href="<?php esc_url( $call_to_action_1[ 'url' ] ) ?>"><?php echo esc_html( $call_to_action_1[ 'title' ] ) ?></a> <?php
        endif;

        //featured speakers template here

        $call_to_action_2 = get_field( 'call_to_action_2' );
        if ( $call_to_action_2 ) : ?>
            <a href="<?php esc_url( $call_to_action_2[ 'url' ] ) ?>"><?php echo esc_html( $call_to_action_2[ 'title' ] ) ?></a> <?php
        endif;

        $call_to_action_3 = get_field( 'call_to_action_3' );
        if ( $call_to_action_3 ) : ?>
            <a href="<?php esc_url( $call_to_action_3[ 'url' ] ) ?>"><?php echo esc_html( $call_to_action_3[ 'title' ] ) ?></a> <?php
        endif;

        //featured industries template here  
        get_template_part( 'template-parts/featured-industries', 'home' );             
        ?>

        <p> <?php the_field( 'statistics_top_right' ); ?> </p>

        <p> <?php the_field( 'statistics_bottom_left' ); ?> </p>

        <?php

        //load featured sponsors template here as template-parts/featured-sponsors.php
        get_template_part( 'template-parts/featured-sponsors', 'home' );
      

        
        $call_to_action_4 = get_field( 'call_to_action_4' );
        if ( $call_to_action_4 ) : ?>
            <a href="<?php esc_url( $call_to_action_4[ 'url' ] ) ?>"><?php echo esc_html( $call_to_action_4[ 'title' ] ) ?></a> <?php
        endif;


        $venue_map = get_field( 'venue_map' );
        if( $venue_map ): ?>
            <div class="acf-map" data-zoom="16">
                <div class="marker" data-lat="<?php echo esc_attr( $venue_map[ 'lat' ] ); ?>" data-lng="<?php echo esc_attr( $venue_map[ 'lng' ] ); ?>"></div>
                <?php echo $venue_map['lat'];
                echo $venue_map['lng']; ?>
            </div>
        <?php endif; ?>

        <p> <?php the_field( 'venue_name' ); ?> </p>

        <p> <?php the_field( 'venue_address' ); ?> </p>

        <p> <?php the_field( 'venue_phone_number' ); ?> </p>

        <a href='mailto:<?php the_field( 'conference_e-mail' ); ?>'> <?php the_field( 'conference_e-mail' ); ?> </a>

        <?php
    else:
    // No ACF fields found
        ?>
        <p>No content found.</p>
        <?php
        endif;
        ?>

</main><!-- #main -->
 
<?php
get_footer();