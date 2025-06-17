<?php

function infinityrank_child_theme(){
    wp_enqueue_style('infintyrank-child-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts','infinityrank_child_theme');


// Custom post type for city locations with categories and tags

function create_seo_agency_post_type() {
    $labels = array(
        'name'               => __('SEO Agencies'),
        'singular_name'      => __('SEO Agency'),
        'menu_name'          => __('SEO Agencies'),
        'name_admin_bar'     => __('SEO Agency'),
        'add_new'            => __('Add New SEO Agency'),
        'add_new_item'       => __('Add New SEO Agency'),
        'edit_item'          => __('Edit SEO Agency'),
        'new_item'           => __('New SEO Agency'),
        'view_item'          => __('View SEO Agency'),
        'all_items'          => __('All SEO Agencies'),
        'search_items'       => __('Search SEO Agencies'),
        'not_found'          => __('No SEO Agencies found.'),
        'not_found_in_trash' => __('No SEO Agencies found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'seo-agency'), // Custom slug for the URL
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location', // Choose an appropriate icon
        'show_in_rest'       => true, // Enables block editor and REST API compatibility
        'capability_type'    => 'post',
        'taxonomies'         => array('category', 'post_tag'), // Add support for categories and tags
    );

    register_post_type('seo_agency', $args);
}
add_action('init', 'create_seo_agency_post_type');



// Adding Case Study custom post type with categories and tags

function create_case_study_post_type() {
    $labels = array(
        'name'               => __('Case Studies'),
        'singular_name'      => __('Case Study'),
        'menu_name'          => __('Case Studies'),
        'name_admin_bar'     => __('Case Study'),
        'add_new'            => __('Add New Case Study'),
        'add_new_item'       => __('Add New Case Study'),
        'edit_item'          => __('Edit Case Study'),
        'new_item'           => __('New Case Study'),
        'view_item'          => __('View Case Study'),
        'all_items'          => __('All Case Studies'),
        'search_items'       => __('Search Case Studies'),
        'not_found'          => __('No Case Studies found.'),
        'not_found_in_trash' => __('No Case Studies found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'case-studies'), // Custom slug for the URL
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-analytics', // Icon for Case Study
        'show_in_rest'       => true, // Enables block editor and REST API compatibility
        'capability_type'    => 'post',
        'taxonomies'         => array('category', 'post_tag'), // Add support for categories and tags
    );

    register_post_type('case_study', $args);
}
add_action('init', 'create_case_study_post_type');


function custom_rewrite_rules() {
    add_rewrite_rule(
        '^case-studies/category/([^/]+)/?$',
        'index.php?post_type=case_study&case_study_category=$matches[1]',
        'top'
    );
}
add_action('init', 'custom_rewrite_rules');

// Ensure the custom taxonomy query is recognized
function add_query_vars($vars) {
    $vars[] = 'case_study_category';
    return $vars;
}
add_filter('query_vars', 'add_query_vars');

// Adjust the WordPress template to handle the custom URL
function case_study_template_redirect() {
    if (get_query_var('case_study_category')) {
        include(get_template_directory() . '/archive-case_study.php');
        exit;
    }
}
add_action('template_redirect', 'case_study_template_redirect');


//require_once get_template_directory().'/template-parts/archive-city.php';
// require_once get_template_directory().'/template-parts/single-city.php';

