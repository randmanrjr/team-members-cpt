<?php

/*
Plugin Name: Team Members
Description: Team Members Custom Post Type
Version: 1.0
Author: randmanrjr
Author URI: https://github.com/randmanrjr
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // disable direct access
}

// Testimonials custom post type
add_action('init','team_members_post_type');

if (! function_exists('team_members_post_type')) {

    function team_members_post_type() {
        $labels = array(
            'name'              => 'Team Members',
            'singular_name'     => 'Team Member',
            'menu_name'         => 'Team Members',
            'name_admin_bar'    => 'Team Members',
            'add_new'           => 'New Team Member',
            'add_new_item'      => 'Add New Team Member'
        );
        $options = array(
            'labels'            => $labels,
            'public'            => false,
            'show_ui'           => true,
            'menu_position'     => 22,
            'menu_icon'         => 'dashicons-groups',
            'capability_type'   => 'post',
            'has_archive'       => false,
            'hierarchical'      => true,
            'show_in_menu'      => true,
            'rewrite'           => array('slug' => 'team-members'),
            'supports'          => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions', 'page-attributes', 'custom-fields')
        );

        register_post_type('team_members',$options);
    }

}

//add additional columns in wp-admin to Team Members Custom Post Type

add_filter('manage_team_members_posts_columns', 'add_team_members_columns');
if ( ! function_exists('add_team_members_columns')) {
    function add_triplus_team_columns($columns) {
        $columns = array(
            'cb'            => '<input type="checkbox" />',
            'thumbnail'     => 'Thumbnail',
            'title'         => 'Title',
            'date'          => 'Date'
        );
        return $columns;
    }
}

add_action('manage_team_members_posts_custom_column', 'team_members_columns');
if ( ! function_exists('team_members_columns')) {
    function team_members_columns($column, $post_id) {
        global $post;
        switch ($column) {
            case 'thumbnail':
                echo get_the_post_thumbnail($post, array(100,100));
                break;
            /* Just break out of the switch statement for everything else. */
            default :
                break;
        }
    }
}