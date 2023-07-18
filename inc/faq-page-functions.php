<?php

/**
 * Canadian Climate Conference faq page content template
 *
 *
 * @package Canadian_Climate_Conference
 */

// Gets the faq sections from the faq acf field group, defined by $section_name
function faq_section($section_name, $post_id = false, $format_value = true)
{
    if (function_exists('get_field')) {
        if (have_rows($section_name)) {
            $field = get_field_object($section_name);
?>
            <div class="accordion">
                <strong>
                    <h2><?php echo $field['label']; ?></h2>
                </strong>

                <div class="accordion-panel" id="accordion-panel-<?php echo $section_name; ?>">
                    <?php
                    if (have_rows($section_name)) {
                        $i = 1;
                        while (have_rows($section_name)) {
                            the_row();
                            $collapse_id = $section_name . '-' . $i;
                    ?>
                            <div class="faq-question-container">
                                <p class="faq-question-text">
                                    <strong><?php echo get_sub_field('question'); ?></strong>
                                </p>
                                <div id="collapse-<?php echo $section_name . '-' . $i; ?>" class="faq-collapse">
                                    <?php echo get_sub_field('answer'); ?>
                                </div>
                                <button class="faq-btn" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $collapse_id; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $collapse_id; ?>">
                                    <!-- Arrow -->
                                    <svg class="arrow-faq" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z" />
                                    </svg>
                                </button>
                            </div>
                    <?php
                            $i++;
                        }
                    }
                    ?>
                </div>
            </div>
<?php
        }
    }
}
?>