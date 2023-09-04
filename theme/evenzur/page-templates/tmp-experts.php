<?php
    // Template Name: Experts Page
?>
<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	global $page_title_h1;
	$page_title_h1 = true;
	get_template_part( 'template-parts/top-inner' ); 
?>

<section class="experts-top">
	<div class="section-inner">
		<p class="section-title"><?=get_field('title')?></p>

		<div class="parts">
			<div class="part">
				<div class="image">
					<?php $f = get_field('image'); ?> 
					<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
				</div>
			</div>
			<div class="part">
				<div class="content about colored">
					<?=get_field('text')?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="experst-info">
	<div class="section-inner">
		<div class="parts">
			<?php 
				$i = 0;
				$items = get_field('steps');
				foreach($items as $item):
				$i++;
			?>
				<div class="part">
					<div class="box-expert">
						<div class="image numbers">
							<?php $f = $item['image-circles']; ?> 
							<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
						</div>
						<div class="image main">
							<?php $f = $item['image-main']; ?> 
							<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
						</div>
						<div class="info">
							<p class="title"><?=$item['title']?></p>
							<div class="content about">
								<?=$item['text']?>
							</div>
						</div>
					</div>
				</div>
			<?php if($i % 2 == 0) : ?>
			</div>
			<div class="parts">
			<?php endif; ?>
			<?php endforeach; ?>			
		</div>

	</div>
</section>

<?php get_footer(); ?>