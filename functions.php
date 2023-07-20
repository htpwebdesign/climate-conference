<?php

/**
 * Canadian Climate Conference functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Canadian_Climate_Conference
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

// define google maps api key
global $maps_key;
$maps_key = getenv('GOOGLE_MAPS_API_KEY');

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function climate_conference_setup()
{
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Canadian Climate Conference, use a find and replace
		* to change 'climate-conference' to the name of your theme in all the template files.
		*/
	load_theme_textdomain('climate-conference', get_template_directory() . '/languages');

	// Add default posts and comments RSS feed links to head.
	add_theme_support('automatic-feed-links');

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support('title-tag');

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'header' => esc_html__('Main Navigation', 'climate-conference'),
			'footer' => esc_html__('Portfolios', 'climate-conference'),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'climate_conference_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support('customize-selective-refresh-widgets');



	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'climate_conference_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function climate_conference_content_width()
{
	$GLOBALS['content_width'] = apply_filters('climate_conference_content_width', 640);
}
add_action('after_setup_theme', 'climate_conference_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function climate_conference_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Footer', 'climate-conference'),
			'id'            => 'footer_widget_area',
			'description'   => esc_html__('Adjust Widget Here', 'climate-conference'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="footer-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action('widgets_init', 'climate_conference_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function climate_conference_scripts()
{
	wp_enqueue_style('climate-conference-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_style_add_data('climate-conference-style', 'rtl', 'replace');

	//for Google Fonts
	wp_enqueue_style(
		'climate-conference-googlefonts',
		'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&family=Montserrat:wght@400;700&display=swap',
		array(),
		null
	);


	//for google maps api
	global $maps_key;
	wp_enqueue_script('jquery');
	wp_enqueue_script(
		'google-maps',
		"https://maps.googleapis.com/maps/api/js?key=$maps_key&callback=Function.prototype",
		array(),
		'3',
		true
	);
	wp_enqueue_script(
		'google-map-init',
		get_template_directory_uri() .
			'/js/googlemaps.js',
		array(),
		'3.7.0',
		true
	);

	//for Mailchimp submit on pressing enter
	wp_enqueue_script('subscribe-form', get_template_directory_uri() . '/js/subscribe-form.js', array('jquery'), '1.0.0', true);

	//for slick slider
	wp_enqueue_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', array('jquery'), '1.8.1', true);
	wp_enqueue_script('slick', get_template_directory_uri() . '/js/carousels.js', array('jquery'), _S_VERSION, true);

	wp_enqueue_script('climate-conference-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

	// FAQ accordion 
	wp_enqueue_script('faq-page-functions', get_template_directory_uri() . '/js/faq.js', array(), _S_VERSION, false);

	// For speaker.js
	wp_enqueue_script('archive-conference-speakers', get_template_directory_uri() . '/js/speakers.js', array(), _S_VERSION, false);

	// For schedule.js
	wp_enqueue_script('conference-event-schedule', get_template_directory_uri() . '/js/schedule.js', array(), _S_VERSION, false);

	//For menu navigation
	wp_enqueue_script('header', get_template_directory_uri() . '/js/menu-navigation.js', array(), _S_VERSION, false);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'climate_conference_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom Post Types & Taxonomies
 */
require get_template_directory() . '/inc/cpt-taxonomy.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load FAQ section function(s)
 */
require get_template_directory() . '/inc/faq-page-functions.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
	require get_template_directory() . '/inc/woocommerce.php';
}



/**
 * Enable classic editor for ACF restrictions
 */
function ccc_editor_filter($use_block_editor, $post)
{
	$page_ids = array(33, 81);
	if (in_array($post->ID, $page_ids)) {
		return false;
	} else {
		return $use_block_editor;
	}
}

add_filter('use_block_editor_for_post', 'ccc_editor_filter', 10, 2);


/**
 * Add Google Maps API Filter
 */
function my_acf_google_map_api($api)
{
	global $maps_key;
	$api['key'] = $maps_key;
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

/**
 * Add Woocommerce Checkout Field filter changes
 */
add_filter('woocommerce_checkout_fields', 'custom_override_checkout_fields');
function custom_override_checkout_fields($fields)
{

	//remove each label, basecode from: 
	//https://stackoverflow.com/questions/25442289/woocommerce-remove-all-form-labels-at-once
	foreach ($fields as $category => $value) {
		if (is_array($value)) {
			foreach ($value as $field => $property) {
				//placeholder text as label before label unset
				$fields[$category][$field]['placeholder'] = ucfirst($property['label']);

				unset($fields[$category][$field]['label']);
			}
		}
	}

	unset($fields['billing']['billing_company']);

	return $fields;
}

/**
 * Skip lazy loading for hero section
 */
function disable_lazy_load_for_specific_images($attr, $attachment, $size)
{
	if (strpos($attr['class'], 'skip-lazy') !== false) {
		$attr['loading'] = 'eager';
	}

	return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'disable_lazy_load_for_specific_images', 10, 3);



//image size for sponsors
//add_image_size( 'sponsor', 415, 75, true );

// Remove placeholder image in tickets page
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// Remove ticket detail link 
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// Remove sku 
add_filter('wc_product_sku_enabled', '__return_false');


// Add the description below the price
add_action('woocommerce_after_shop_loop_item', 'display_product_description', 15);
function display_product_description()
{
	global $product;
	echo '<h3 class="product-title">' . $product->get_title() . '</h3>';
	echo '<div class="product-price">' . $product->get_price_html() . '</div>';
	echo '<div class="product-description">' . $product->get_description() . '</div>';
	echo '<a href="' . esc_url($product->add_to_cart_url()) . '" class="button">' . __('Buy Now', 'woocommerce') . '</a>';
}

// Remove the price
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// Remove title
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

// Remove description 
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_excerpt', 10);

// Remove category 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// Remove upsell 
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);


// Description under price
function move_description_under_price()
{
	remove_action('woocommerce_after_shop_loop_item_title', 'tppdil_description', 20);
	add_action('woocommerce_after_shop_loop_item_title', 'tppdil_description', 30);
}

add_action('woocommerce_before_shop_loop', 'move_description_under_price');
