<?php
/**
 * Created by PhpStorm.
 * User: randman
 * Date: 1/24/19
 * Time: 6:46 PM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // disable direct access
}

/**
 * Register meta boxes
 */

if (! function_exists('tmcpt_register_meta_boxes')) {
	function tmcpt_register_meta_boxes () {
		add_meta_box('tmcpt-1', 'Team Member Information', 'tmcpt_demographic_info', 'team_members', 'normal', 'high');
	}
}

add_action('add_meta_boxes', 'tmcpt_register_meta_boxes');

/**
 * Display meta box content
 */

if (! function_exists('tmcpt_demographic_info')) {
	function tmcpt_demographic_info ($post) {
		include plugin_dir_path(__FILE__) . './demographics.php';
	}
}

/**
 * Save meta box field values
 */


if (! function_exists('tmcpt_save_meta_field_values')) {
	function tmcpt_save_meta_field_values ($post_id) {
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
		if ($parent_id = wp_is_post_revision($post_id)) {
			$post_id = $parent_id;
		}
		$fields = [
			'tmcpt_pro_title',
            'tmcpt_pro_email',
            'tmcpt_pro_phone'
		];
		foreach ($fields as $field) {
			if (array_key_exists($field, $_POST)) {
				update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
			}
		}
	}
}

add_action('save_post', 'tmcpt_save_meta_field_values');

if (! function_exists('tmcpt_edit_form_top')) {
	function tmcpt_edit_form_top () {
		$scr = get_current_screen();
		if ($scr->post_type === 'team_members') {
			echo "<h1 class='wp-heading-inline'>Team Member's Name:</h1>";
		}
	}
}

add_action('edit_form_top', 'tmcpt_edit_form_top');

if (! function_exists('tmcpt_edit_form_after_title')) {
	function tmcpt_edit_form_after_title () {
		$scr = get_current_screen();
		if ($scr->post_type === 'team_members') {
		echo "<p>(Enter Team Member's Name above as Post Title)</p>";
		echo "<h1 class='wp-heading-inline'>Team Member Biography:</h1>";
		}
	}
}

add_action('edit_form_after_title', 'tmcpt_edit_form_after_title');

if (! function_exists('tmcpt_edit_form_after_editor')) {
	function tmcpt_edit_form_after_editor () {
		$scr = get_current_screen();
		if ($scr->post_type === 'team_members') {
			echo "<p>(Enter Team Member's Bio above as Post Content)</p>";
		}
	}
}

add_action('edit_form_after_editor', 'tmcpt_edit_form_after_editor');

if (! function_exists('tmcpt_add_html_post_thumbnail')) {
	function tmcpt_add_html_post_thumbnail ($content, $post_id=null, $thumbnail_id=null) {
		$scr = get_current_screen();
		if ($scr->post_type === 'team_members') {
			$msg = "<h2 style='padding: 8px 0;'>Upload Team Member's photo as Featured Image</h2>";
			$msg .= "<p>Best image size is a square 600 x 600 image.</p>";
			return $content .= $msg;
		} else {
			return $content;
		}
	}
}

add_filter('admin_post_thumbnail_html','tmcpt_add_html_post_thumbnail', 10, 2);