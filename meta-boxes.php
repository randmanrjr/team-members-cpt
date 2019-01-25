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
			'tmcpt_pro_title'
		];
		foreach ($fields as $field) {
			if (array_key_exists($field, $_POST)) {
				update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
			}
		}
	}
}

add_action('save_post', 'tmcpt_save_meta_field_values');