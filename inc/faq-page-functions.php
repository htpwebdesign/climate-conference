<?php

/**
 * Canadian Climate Conference faq page content template
 *
 *
 * @package Canadian_Climate_Conference
 */

 //gets the faq sections from the faq acf field group, defined by $section_name
function faq_section($section_name, $post_id = false, $format_value = true) {
 

    if ( function_exists( 'get_field' ) ):

        if ( have_rows( $section_name ) ):
    
            $field = get_field_object( $section_name ); ?>
    
            <section class="faq-section">
                <h2 class="faq-section-title"> <?php echo $field['label']; ?> </h2> <?php
    
                if ( have_rows( $section_name ) ):

                    $i = 1;
                    while ( have_rows( $section_name )) :

                        the_row();?>
                        <div class="faq-question-container">

                                <p class="faq-question-text">
                                    <button class="faq-btn btn-link" 
                                        type="button" 
                                        data-toggle="collapse" 
                                        data-target="#collapse" 
                                        aria-expanded="true" 
                                        aria-controls="collapse"> <?php

                                        echo get_sub_field( 'question' ); ?>
                                    </button>
                                </p>

                            <div id="collapse" 
                                class="faq-collapse" 
                                aria-labelledby="heading" 
                                data-parent="#accordionExample">
                                <?php echo get_sub_field( 'answer' ); ?>
                            </div>

                        </div> 
                        <?php
                        $i++;
                    endwhile;
                endif; ?>
            </section> <?php 
        endif;
    endif;
}
?>