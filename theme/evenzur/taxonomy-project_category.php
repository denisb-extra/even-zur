<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php
	$cur_term = get_queried_object();
?>
<?php
	get_template_part( 'template-parts/top-inner' ); 
?>

<?php require get_template_directory() . '/inc/projects.php'; ?>

<?php get_footer(); ?>