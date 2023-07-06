<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Canadian_Climate_Conference
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php dynamic_sidebar( 'footer_widget_area' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php wp_footer(); ?>
</body>
</html>
