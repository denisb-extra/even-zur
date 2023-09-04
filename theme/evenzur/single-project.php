<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	get_template_part( 'template-parts/top-inner' ); 
?>
 <section class="project">
	<div class="section-inner">
		<p class="section-title"><?php the_title();?>
		</p>
		<div class="content about">
			<?php the_content(); ?>
		</div>

		<div class="project-info">
			<?php if(get_field('architect-post')) : ?>
			
			
			<div class="line">
				<div class="item">
					<div class="icon">
						<img src="<?=$td?>/images/index/top-menu/arch.png">
					</div>
					<span>אדריכל: <?=get_field('architect-post')->post_title?></span>
				</div>
				<a href="<?=get_permalink(get_field('architect-post'));?>" class="button">
					<span class="sep">|</span>
					<span>לפרטים נוספים >></span>
				</a>
			</div>
			<?php endif; ?>
			
			<?php if(get_field('architect')) : ?>
			
			
			<div class="line">
				<div class="item">
					<div class="icon">
						<img src="<?=$td?>/images/index/top-menu/arch.png">
					</div>
					<span>אדריכל: <?=get_field('architect')?></span>
				</div>
			</div>
			<?php endif; ?>
			<?php if(get_field('photographer')) : ?>
			<div class="item">
				<div class="icon">
					<img src="<?=$td?>/images/icons/photo.png">
				</div>
				<span>צילום: <?=get_field('photographer')?></span>
			</div>
			<?php endif; ?>
		</div>


		<a href="<?=get_permalink(16);?>" class="button-regular">לקבלת הצעה</a>
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



<section class="projects inner">
	<div class="section-inner">
		<p class="section-title">פרוייקטים נוספים דומים</p>

		<div class="boxes">
			<?php 
				if(get_field("more-projects")) $posts = get_field("more-projects");
				else {
					$args = array(
						'post_type'             => 'project',
						'posts_per_page'        => 4,
						'post_status'           => 'publish',
						'ignore_sticky_posts'   => 1,
						'orderby'   => 'rand',
						'fields' => 'ids',
						'post__not_in'   => array( get_the_ID() ),
					);

					$posts = get_posts($args);
				}
				foreach($posts as $mpost) {
					template_project_box($mpost);
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
	
	
	window.localStorage.setItem("project_image", "<?=get_the_post_thumbnail_url($post, 'thumb-project')?>");
</script>
<?php get_footer(); ?>