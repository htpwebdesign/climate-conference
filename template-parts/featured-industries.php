<?php

/**
 * Canadian Climate Conference Home page - Featured sponsors template
 *
 *
 * @package Canadian_Climate_Conference
 */

//get all sponsors with the taxonomy 'featured-industry'
$featured_industries = get_posts(array(
    'post_type' => 'conference-events',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'conference-industry-type',
            'field' => 'slug',
            'terms' => 'featured-industry'
        )
    )
));


if ($featured_industries) { ?>

    <section class="featured-industry-section">

        <div class="featured-industry-container">

            <h2 class="featured-industry-title">Featured Industries:</h2>

            <div class="featured-industry-row"> <?php

                foreach ($featured_industries as $post) {
                    
                    $terms = get_the_terms($post->ID, 'conference-industry-type');

                    if ($terms && !is_wp_error($terms)) {
                        
                        foreach ($terms as $term) {

                            // Exclude the 'featured-industry' term
                            if ($term->slug != 'featured-industry') { ?>

                                <div class="industry-item"><a href="<?php echo get_term_link( $term );?>"><?php echo $term->name; ?></a></div> <?php
                            }
                        }
                    }
                }
                 ?>

            </div>

        </div>

    </section> <?php

    wp_reset_postdata();
}
?>