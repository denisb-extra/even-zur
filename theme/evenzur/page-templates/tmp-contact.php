<?php
    // Template Name: Contact Page
?>
<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php 
	get_template_part( 'template-parts/top-inner' ); 
?>

<section class="contact">
	<div class="section-inner">
		<p class="section-title"><?=get_field('title')?></p>
		<div class="message">
			<p><?=get_field('subtitle')?></p>
		</div>
	</div>
	<div style="border-top: 1px solid #000; margin-top:25px"></div>
	<div class="section-inner">
		<div class="wrapper-form">
			<?=do_shortcode('[contact-form-7 id="'.get_field('contact-form').'" title="טופס יצירת קשר בעמוד צור קשר"]');?>
			
			<div class="project-image">
				<img src="" id="project-image">
			</div>
		</div>
	</div>
</section>


<footer class="contact-page">
	<div class="footer-inner">
		<div class="cols">
			<div class="col">
				<div class="content">
					<p><?=get_field('footer', 'options')['tel']['text']?></p>
				</div>
				<a href="tel:<?=get_field('footer', 'options')['tel']['number']?>" class="tel">
					<img src="<?=$td?>/images/index/top-menu/tel.png">
					<span><?=get_field('footer', 'options')['tel']['number']?></span>
				</a>
			</div>

			<div class="col">
				<div class="contacts">
					<div class="line">
						<?php 
							$i=0;
							$items = get_field('footer', 'options')['contacts'];
							foreach($items as $item):
							$i++;
						?>
							<?php if($item['url']) : ?>
								<a href="<?=$item['url']?>"><?=$item['text']?></a>
							<?php else : ?>
								<p><?=$item['text']?></p>
							<?php endif; ?>
							<div class="sep">|</div>
						<?php if($i % 2 == 0) : ?>
							</div>
							<div class="line">
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>


				<div class="social">
					<div class="items">
						<?php 
							$items = get_field('footer', 'options')['social']['links'];
							foreach($items as $item):
						?>
							<a href="<?=$item["url"];?>" class="item" target="_blank">
								<?php $f = $item['icon']; ?> 
								<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
							</a>
						<?php endforeach; ?>
					</div>
					<p class="title"><?=get_field('footer', 'options')['social']['title']?></p>
				</div>
			</div>

		</div>
		
		<div class="col menu">
			<?php
				$args = array(
					'theme_location'  => 'footer-menu',
					'container_class' => 'menu-cont',
					'menu_class'      => 'menu',
				);
				wp_nav_menu( $args );
			?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<script>
	$(document).ready(function ($) {
		var projectImage = window.localStorage.getItem("project_image");
		if(projectImage) {
			$('input[name="project-image"]').val(projectImage);
			$("#project-image").attr("src", projectImage);
		}
	});
</script>
</body>
</html>