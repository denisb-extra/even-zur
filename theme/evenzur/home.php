<?php
    // Template Name: Blog Page
?>
<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php
	if(is_home()) {
		$id = get_option( 'page_for_posts' );
		setup_postdata($id);
		global $post;
		$post = get_post($id);
	}
?>

<?php 
	get_template_part( 'template-parts/top-inner' ); 
?>

<section class="blog">
	<div class="section-inner">
		<p class="section-title"><?=get_field('title')?></p>

		<div class="boxes">
			<?php
				
				
				$tax_query = array();
				if(get_field("cat-to-display")) {
					$tax_query =  array(
						array(
							'taxonomy' => 'category',
							'field' => 'term_id', 
							'terms' => get_field("cat-to-display")
						)
					);
				}
				
				$args = array(
					'post_type'             => 'post',
					'posts_per_page'        => -1,
					'post_status'           => 'publish',
					'ignore_sticky_posts'   => 1,
					'tax_query' => $tax_query
				);
			
				$items = get_posts($args);
				foreach($items as $item) {
					template_post_box($item->ID);
				}
			?>
		</div>
	</div>
</section>


<?php get_footer(); ?>