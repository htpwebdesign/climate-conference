<?php

/**
 * Canadian Climate Conference Home page - Featured sponsors template
 *
 *
 * @package Canadian_Climate_Conference
 */

//get all sponsors with the taxonomy 'featured'
$featured_sponsors = get_posts(array(
    'post_type' => 'conference-sponsors',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'conference-industry-type',
            'field' => 'slug',
            'terms' => 'featured-sponsors'
        )
    )
));

//output the logo and link for all featured sponsors with the taxonomy 'featured'
if ($featured_sponsors) { ?>

    <section class="featured-sponsors-section">

        <div class="featured-sponsors-container">

            <h2 class="featured-sponsors-title">Proudly Sponsored by:</h2>

            <div class="featured-sponsors-row"> <?php

                foreach ($featured_sponsors as $post) {

                    setup_postdata( $post );

                    $sponsor_logo = get_field( 'logo' ); 
                    $company_name = esc_html( get_the_title() ); ?>

                    <div class="featured-sponsors-col">

                        <h3><?php the_title(); ?></h3>
                        
                        <a href="<?php echo get_field( 'link' ); ?>" target="_blank"> 
                            <img class="featured-sponsors-logo" 
                                src="<?php echo $sponsor_logo; ?>" 
                                alt="<?php echo `$company_name's logo`; ?>">
                        </a>

                    </div> <?php
                } ?>

            </div>

        </div>

    </section> <?php

    wp_reset_postdata();
}
?>