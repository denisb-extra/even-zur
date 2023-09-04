<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	global $page_title_h1;
	$page_title_h1 = true;
	get_template_part( 'template-parts/top-inner' ); 
?>

<?php
	$cur_term = get_queried_object();
?>


<?php 
	$tax_query = array(
		array(
			'taxonomy' => 'design',
			'field' => 'term_id', 
			'terms' => $cur_term->term_id
		)
	);
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = Array(
		'post_type' => 'project',
		'numberposts' => 8,
		'paged' => $paged,
		'fields' => 'ids',
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'tax_query' => $tax_query,
	);
	
	$projects = get_posts($args);
	
?>

<div class="big-loader loading"></div>
<section class="projects">
	<div class="section-inner">
		<p class="section-title"><?=$cur_term->name ?></p>
		<?php if(term_description($cur_term)) : ?>
		<br>
		<div class="content">
			<?=term_description($cur_term);?>
		</div>
		<?php endif; ?>
		<div class="boxes projects">
			<?php
				foreach($projects as $project) {	
					template_project_box($project, true);
				}
			?>
		</div>
	</div>
</section>

<?php get_footer(); ?>