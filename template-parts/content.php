<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if (is_singular()) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php else : ?>
            <h2 class="entry-title"><a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php endif; ?>
    </header><!-- .entry-header -->

    <?php climate_conference_post_thumbnail(); ?>

    <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'climate-conference'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'climate-conference'),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <!-- Remove or comment out the code below to remove the "Posted on" information -->
    <?php /*
    <footer class="entry-footer">
        <?php climate_conference_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    */ ?>
</article><!-- #post-<?php the_ID(); ?> -->
