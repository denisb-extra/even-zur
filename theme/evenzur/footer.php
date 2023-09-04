<?php $td = get_template_directory_uri(); ?>

<footer>
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
			<div class="sep-line"></div>
			<div class="col">
				<?=do_shortcode('[contact-form-7 id="'.get_field('footer', 'options')['contact-form'].'" title="טופס יצירת קשר בתחתית עמוד"]');?>
			</div>
			<div class="sep-line"></div>
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
</body>
</html>