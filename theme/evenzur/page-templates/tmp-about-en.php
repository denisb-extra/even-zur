<?php
    // Template Name: About en Page
?>
<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	get_template_part( 'template-parts/top-inner' ); 
?>

<section class="about en">
	<div class="section-inner">
		<p class="section-title"><?=get_field('title')?></p>

		<div class="content about">
			<?=get_field('content')?>
		</div>
	</div>
</section>

<?php if(get_field('images')) : ?>
<section class="slider-top">
	<div class="bg">
		<div class="swiper-container slider-main">
			<div class="swiper-wrapper">
				<?php 
					$items = get_field('images');
					foreach($items as $item):
				?>
					<div class="swiper-slide">
						<?php $f = $item['image']; ?> 
						<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
						<?php if($item['description']) : ?>
							<p class="text"><?=$item['description']?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="pagination"></div>
			<div class="nav">
				<div class="arrow right">
					<img src="<?=$td?>/images/icons/arrow-right.png">
				</div>
				<div class="arrow left">
					<img src="<?=$td?>/images/icons/arrow-left.png">
				</div>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>

<script>
	$(document).ready(function ($) {
		var mySwiper = new Swiper('.slider-main', {
			slidesPerView: 5,
			spaceBetween: 50,
			loop: true,
			effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
			speed: 1000,
			navigation: {
				nextEl: '.arrow.right',
				prevEl: '.arrow.left',
			},
			pagination: {
				el: '.pagination',
				type: 'bullets',
				clickable: true,
			},
			breakpoints: {
				0: {
					spaceBetween: 35,
				},
				1360: {
					spaceBetween: 55,
				},
			}
		});
	});
</script>

<?php get_footer(); ?>