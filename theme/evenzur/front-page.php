<?php
    // Template Name: Home Page
?>
<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<section class="slider-top">
	<div class="bg">
		<div class="swiper-container slider-main">
			<div class="swiper-wrapper">
				<?php 
					$items = get_field('section-top')['slider-desktop'];
					if(wp_is_mobile() && get_field('section-top')['slider-mobile']) $items = get_field('section-top')['slider-mobile'];
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

<?php if(get_field('section-top')['banner']['image-desktop']) : ?>
<section class="banner">
	<a class="image" href="<?=get_field('section-top')['banner']['url']?>">
		<?php 
			$f = get_field('section-top')['banner']['image-desktop']; 
			if(wp_is_mobile() && get_field('section-top')['banner']['image-mobile']) $f = get_field('section-top')['banner']['image-mobile'];
		?> 
			<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
	</a>
</section>
<?php endif; ?>

<section class="info">
	<div class="section-inner">
		<p class="title-regular centered "><?=get_field('section-about')['title']?></p>
		<div class="content narrow centered about">
			<?=get_field('section-about')['text']?>
		</div>
	</div>
</section>

<section class="projects">
	<div class="section-inner wide">
		<div class="part-top">
			<p class="section-title"><?=get_field('section-projects')['title']?></p>
			<a href="<?=get_permalink(10);?>" class="button">
				<span>לכל הפרוייקטים >></span>
			</a>
		</div>

		<div class="boxes">
			<?php 
				$items = get_field('section-projects')['projects'];
				foreach($items as $item) {
					template_project_box($item);
				}
			?>
		</div>
	</div>
</section>

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