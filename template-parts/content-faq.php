<?php



function faq_section($section_name, $post_id = false, $format_value = true) {

    if (have_rows($section_name)) {

        $field = get_field_object($section_name); ?>

        <section class="faq-section">

            <div class="faq-container">
                
                <h2 class="faq-section-title"> <?php echo $field['label']; ?> </h2>
                <div class="faq-row">
                    <div class="faq-col">
                        <div class="faq-accordion" id="accordion"> <?php

                            if (have_rows($section_name)) {

                                $i = 1;

                                while (have_rows($section_name)) {

                                    the_row(); 
                                    ?>

                                    <div class="faq-question-container">

                                        <div class="faq-question-header" id="heading">
                                            <p class="faq-question-text">

                                                <button class="faq-btn btn-link" 
                                                    type="button" 
                                                    data-toggle="collapse" 
                                                    data-target="#collapse" 
                                                    aria-expanded="true" 
                                                    aria-controls="collapse"> <?php

                                                    echo get_sub_field('question'); ?>

                                                </button>
                                            </p>

                                        </div>

                                        <div id="collapse" 
                                            class="faq-collapse" 
                                            aria-labelledby="heading" 
                                            data-parent="#accordionExample">

                                            <div class="faq-card-body"> <?php

                                            echo get_sub_field('answer'); ?>

                                            </div>
                                        </div>
                                    </div> 
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
?>