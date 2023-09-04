<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	get_template_part( 'template-parts/top-inner' ); 
?>

<section class="post">
	<div class="section-inner">
		<div class="img-main">
			<?php $image = get_the_post_thumbnail_url($post, 'big-post'); ?>
			
			<?php if(!wp_is_mobile()) : ?>
				<img src="<?=$image?>" alt="<?=$post -> post_title?>" title="<?=$post -> post_title?>" class="main">
			<?php endif; ?>
		</div>
		
		<div class="content about">
			<p class="section-title"><?php the_title();?></p>
			<?php if(wp_is_mobile()) : ?>
				<div class="img-main mobile">
					<img src="<?=$image?>" alt="<?=$post -> post_title?>" title="<?=$post -> post_title?>" class="main">
				</div>
			<?php endif; ?>
			<?php the_content(); ?>
		</div>
	</div>
</section>


	
<?php get_footer(); ?>