<?php
function ccc_register_cpt()
{
    // Register Events 
    $labels = array(
        'name'                  => _x('Events', 'post type general name'),
        'singular_name'         => _x('Event', 'post type singular name'),
        'menu_name'             => _x('Events', 'admin menu'),
        'name_admin_bar'        => _x('Event', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'event'),
        'add_new_item'          => __('Add New Event'),
        'new_item'              => __('New Event'),
        'edit_item'             => __('Edit Event'),
        'view_item'             => __('View Event'),
        'all_items'             => __('All Events'),
        'search_items'          => __('Search Events'),
        'parent_item_colon'     => __('Parent Events:'),
        'not_found'             => __('No events found.'),
        'not_found_in_trash'    => __('No events found in Trash.'),
        'archives'              => __('Event Archives'),
        'insert_into_item'      => __('Insert into event'),
        'uploaded_to_this_item' => __('Uploaded to this event'),
        'filter_item_list'      => __('Filter events list'),
        'items_list_navigation' => __('event list navigation'),
        'items_list'            => __('Events list'),
        'featured_image'        => __('Event featured image'),
        'set_featured_image'    => __('Set event featured image'),
        'remove_featured_image' => __('Remove event featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'schedule'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-schedule',
        'supports'           => array('title', 'thumbnail'),
        'order' => 'ASC',
    );

    register_post_type('conference-events', $args);

    //Register Sponsors
    $labels = array(
        'name'                  => _x('Sponsors', 'post type general name'),
        'singular_name'         => _x('Sponsor', 'post type singular name'),
        'menu_name'             => _x('Sponsors', 'admin menu'),
        'name_admin_bar'        => _x('Sponsors', 'add new on admin bar'),
        'add_new'               => _x('Add New', 'sponsor'),
        'add_new_item'          => __('Add New Sponsor'),
        'new_item'              => __('New Sponsors'),
        'edit_item'             => __('Edit Sponsor'),
        'view_item'             => __('View Sponsor'),
        'all_items'             => __('All Sponsors'),
        'search_items'          => __('Search Sponsors'),
        'parent_item_colon'     => __('Parent Sponsors:'),
        'not_found'             => __('No sponsors found.'),
        'not_found_in_trash'    => __('No sponsors found in Trash.'),
        'archives'              => __('Sponsor Archives'),
        'insert_into_item'      => __('Insert into spnsor'),
        'uploaded_to_this_item' => __('Uploaded to this spnsor'),
        'filter_item_list'      => __('Filter sponsors list'),
        'items_list_navigation' => __('Sponsor list navigation'),
        'items_list'            => __('Sponsors list'),
        'featured_image'        => __('Sponsor featured image'),
        'set_featured_image'    => __('Set sponsor featured image'),
        'remove_featured_image' => __('Remove sponsor featured image'),
        'use_featured_image'    => __('Use as featured image'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'sponsor'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-businessperson',
        'supports'            => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('conference-sponsors', $args);

    //Register Speakers
    $labels = array(
		'name'               => __('Speakers', 'text-domain'),
		'singular_name'      => __('Speaker', 'text-domain'),
		'add_new'            => __('Add New Speaker', 'text-domain'),
		'add_new_item'       => __('Add New Speaker', 'text-domain'),
		'edit_item'          => __('Edit Speaker', 'text-domain'),
		'new_item'           => __('New Speaker', 'text-domain'),
		'view_item'          => __('View Speaker', 'text-domain'),
		'search_items'       => __('Search Speakers', 'text-domain'),
		'not_found'          => __('No speakers found', 'text-domain'),
		'not_found_in_trash' => __('No speakers found in Trash', 'text-domain'),
		'parent_item_colon'  => __('Parent Speaker:', 'text-domain'),
		'menu_name'          => __('Speakers', 'text-domain'),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => true,
		'has_archive'         => true,
		'publicly_queryable'  => true,
		'query_var'           => true,
		'rewrite'             => array('slug' => 'speakers'),
		'capability_type'     => 'post',
		'menu_icon'           => 'dashicons-businessman',
		'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
	);

	register_post_type('conference-speakers', $args);
}
add_action('init', 'ccc_register_cpt');



//Register Taxonomies Function
function ccc_register_taxonomies()
{

    /**
     * Register an 'industry' taxonomy for post types: 'conference-events', 'conference-speakers', 'conference-sponsors'.
     * Used on home page and for filtering on schedule and speakers pages by industry.
     */

    // Industry Types
    $labels = array(
        'name'              => _x('Industry Types', 'taxonomy general name'),
        'singular_name'     => _x('Industry Type', 'taxonomy singular name'),
        'search_items'      => __('Search Industry Types'),
        'all_items'         => __('All Industry Types'),
        'parent_item'       => __('Parent Industry Type'),
        'parent_item_colon' => __('Parent Industry Type:'),
        'edit_item'         => __('Edit Industry Type'),
        'update_item'       => __('Update Industry Type'),
        'add_new_item'      => __('Add New Industry Type'),
        'new_item_name'     => __('New Industry Type Name'),
        'menu_name'         => __('Industry Type'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'industry'),
    );


    register_taxonomy('conference-industry-type', array('conference-events', 'conference-speakers', 'conference-sponsors'), $args);


    // Event Type 
    $labels = array(
        'name'              => _x('Event Types', 'taxonomy general name'),
        'singular_name'     => _x('Event Type', 'taxonomy singular name'),
        'search_items'      => __('Search Event Types'),
        'all_items'         => __('All Event Types'),
        'parent_item'       => __('Parent Event Type'),
        'parent_item_colon' => __('Parent Event Type:'),
        'edit_item'         => __('Edit Event Type'),
        'update_item'       => __('Update Event Type'),
        'add_new_item'      => __('Add New Event Type'),
        'new_item_name'     => __('New Event Type Name'),
        'menu_name'         => __('Event Type'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'event-types'),
    );


    register_taxonomy('conference-event-type', array('conference-events'), $args);


    // Schedule 
    $labels = array(
        'name'              => _x('Event', 'taxonomy general name'),
        'singular_name'     => _x('Event', 'taxonomy singular name'),
        'search_items'      => __('Search Event'),
        'all_items'         => __('All Event'),
        'parent_item'       => __('Parent Event'),
        'parent_item_colon' => __('Parent Event:'),
        'edit_item'         => __('Edit Event'),
        'update_item'       => __('Update Event'),
        'add_new_item'      => __('Add New Event'),
        'new_item_name'     => __('New Event Name'),
        'menu_name'         => __('Event'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'event'),
    );


    register_taxonomy('conference-event-taxonomy', array('conference-events'), $args);

    // Day 
    $labels = array(
        'name'              => _x('Event Day', 'taxonomy general name'),
        'singular_name'     => _x('Event Day', 'taxonomy singular name'),
        'search_items'      => __('Search Event Day'),
        'all_items'         => __('All Event Day'),
        'parent_item'       => __('Parent Event Day'),
        'parent_item_colon' => __('Parent Event: Day'),
        'edit_item'         => __('Edit Event Day'),
        'update_item'       => __('Update Event Day'),
        'add_new_item'      => __('Add New Event Day'),
        'new_item_name'     => __('New Event Name Day'),
        'menu_name'         => __('Event Day'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'event-day'),
    );




    register_taxonomy('conference-event-day', array('conference-events'), $args);



    $labels = array(
        'name'              => _x( 'Sponsor Types', 'taxonomy general name' ),
        'singular_name'     => _x( 'Sponsor Types', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Sponsor Types' ),
        'all_items'         => __( 'All Sponsor Types' ),
        'parent_item'       => __( 'Parent Sponsor Type' ),
        'parent_item_colon' => __( 'Parent Sponsor Type:' ),
        'edit_item'         => __( 'Edit Sponsor Type' ),
        'view_item'         => __( 'View Sponsor Type' ),
        'update_item'       => __( 'Update Sponsor Type' ),
        'add_new_item'      => __( 'Add New Sponsor Type' ),
        'new_item_name'     => __( 'New Sponsor Type Name' ),
        'menu_name'         => __( 'Sponsor Type' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'show_in_nav_menu'  => true,
        'show_in_rest'      => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'sponsors' ),
    );
    register_taxonomy( 'conference-sponsors-taxonomy', array( 'conference-sponsors' ), $args );

}
add_action('init', 'ccc_register_taxonomies');


// Flush 
function ccc_rewrite_flush()
{
    ccc_register_cpt();
    ccc_register_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'ccc_rewrite_flush');
