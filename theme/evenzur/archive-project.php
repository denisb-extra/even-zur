<?php
    // Template Name: Projects Page
?>

<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php
	$id = 10;
	setup_postdata($id);
	global $post;
	$post = get_post($id);
	global $wp_query;
	$wp_query -> queried_object = $post;
?>

<?php
	$cur_term = null;
?>
<?php
	get_template_part( 'template-parts/top-inner' ); 
?>

<?php require get_template_directory() . '/inc/projects.php'; ?>

<?php get_footer(); ?>