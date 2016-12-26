<?php

    $labels = array(
		'name'                => _x( __('Consultation'), 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( __('Consultation'), 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( __('Consultation'), 'text_domain' ),
		'parent_item_colon'   => __( __('Parent Consultation:'), 'text_domain' ),
		'all_items'           => __( __('All Consultation'), 'text_domain' ),
		'view_item'           => __( __('View Consultation'), 'text_domain' ),
		'add_new_item'        => __( __('Add New Consultation'), 'text_domain' ),
		'add_new'             => __( __('New Consultation'), 'text_domain' ),
		'edit_item'           => __( __('Edit Consultation'), 'text_domain' ),
		'update_item'         => __( __('Update Consultation'), 'text_domain' ),
		'search_items'        => __( __('Search Consultation'), 'text_domain' ),
		'not_found'           => __( __('No Consultation found'), 'text_domain' ),
		'not_found_in_trash'  => __( __('No Consultation found in Trash'), 'text_domain' ),
	);
	$args = array(
		'label'               => __( __('Consultation'), 'text_domain' ),
		'description'         => __( __('option Consultation'), 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'rewrite'             => array ( 'slug', 'Consultation' ),
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 10,
		'menu_icon'           => 'dashicons-format-status',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
	);
	register_post_type( 'consultation', $args );
	
	$labels = array(
        'name'              => _x( __('Categories Post Type Consultation'), 'taxonomy general name' ),
        'singular_name'     => _x( __('Category'), 'taxonomy singular name' ),
        'search_items'      => __( __('Search Categories') ),
        'all_items'         => __( __('All Categories') ),
        'parent_item'       => __( __('Parent Category') ),
        'parent_item_colon' => __( __('Parent Category:') ),
        'edit_item'         => __( __('Edit Category') ),
        'update_item'       => __( __('Update Category') ),
        'add_new_item'      => __( __('Add New Category') ),
        'new_item_name'     => __( __('New Category Name') ),
        'menu_name'         => __( __('Categories') ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'categories' ),
    );

    register_taxonomy( 'consultation_categories', array( 'consultation' ), $args );
?>