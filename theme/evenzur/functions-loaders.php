<?php

add_action('wp_ajax_load_projects_by_cat_id', 'wp_ajax_load_projects_by_cat_id_callback');
add_action('wp_ajax_nopriv_load_projects_by_cat_id', 'wp_ajax_load_projects_by_cat_id_callback');

function wp_ajax_load_projects_by_cat_id_callback() {
	$id = $_POST['cat_id'];
	$t_query = array();
	if($id != "0") {
		$t_query = array(
			array(
				'taxonomy'      => 'project_category',
				'field' => 'term_id',
				'terms'         => $id
			)
		);
	}
	$args = array(
		'post_type'             => 'project',
		'posts_per_page'        => -1,
		'tax_query'             => $t_query,
	);

	$projects = get_posts($args);
	foreach($projects as $project) {
		template_project_box($project->ID, true);
	}
	exit();
}
