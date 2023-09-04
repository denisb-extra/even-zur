<?php $td = get_template_directory_uri(); ?>

<!DOCTYPE html>
<html dir="rtl" lang="he-IL">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='shortcut icon' type='image/x-icon' href='<?=$td?>/images/favicon.ico' />
	
	<link rel="stylesheet" href="<?=$td?>/fonts/font-awesome.min.css">
	<script src="<?=$td?>/js/jquery-3.2.0.min.js"></script>
	<script src="<?=$td?>/js/main.js"></script>

	<link rel="stylesheet" href="<?=$td?>/plugins/swiper/swiper.css">
	<script src="<?=$td?>/plugins/swiper/swiper.js"></script> 
	
	<link rel="stylesheet" href="<?=$td?>/plugins/fancybox/jquery.fancybox.css">
	<script src="<?=$td?>/plugins/fancybox/jquery.fancybox.js"></script> 
	
	<script src="<?=$td?>/plugins/scrollreveal/scrollreveal.js"></script> 
	
	<script src="<?=$td?>/plugins/mmenu/jquery-simple-mobilemenu.js"></script>
	<link rel="stylesheet" href="<?=$td?>/plugins/mmenu/styles/jquery-simple-mobilemenu-slide.css">
	
	<link rel="stylesheet" href="<?=$td?>/css/style.css">
	
	<?php wp_head(); ?> 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5VQ66JW');</script>
<!-- End Google Tag Manager -->
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '517495912335698');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=517495912335698&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</head>


<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VQ66JW"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header>
	<div class="header-inner">
		<div class="part-right">
			<div class="ham-button"></div>
			<a href="#" class="icon">
				<img src="<?=$td?>/images/icons/disabled.png">
			</a>
			<div class="lang-select">
				<a href="<?=get_permalink(270);?>" class="item">EN</a>
			</div>
			<a href="<?=get_permalink(16);?>" class="button-regular">לקבלת הצעה</a>
		</div>
		
		<div class="part-middle">
			<?php
				$args = array(
					'theme_location'  => 'top-menu',
					'container_class' => 'menu-cont',
					'menu_class'      => 'main-menu',
					'walker' => new myMenuWalker
				);
				wp_nav_menu( $args );
			?>
		</div>
		
		<div class="part-left">
			<div class="social">
				<div class="items">
					<?php 
						$items = get_field('header', 'options')['social']['links'];
						foreach($items as $item):
					?>
						<a href="<?=$item["url"];?>" class="item" target="_blank">
							<?php $f = $item['icon']; ?> 
							<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
						</a>
					<?php endforeach; ?>
				</div>
				<p class="title"><?=get_field('header', 'options')['social']['title']?></p>
			</div>
			<a class="logo" href="<?=get_home_url();?>">
				<?php $f = get_field('header', 'options')['logo']; ?> 
				<img src="<?=$f["url"]?>" alt="<?=$f["alt"]?>" title="<?=$f["title"]?>">
			</a>
		</div>

		<?php
			$args = array(
				'theme_location'  => 'mobile-menu',
				'container_class' => 'mobile-menu-cont',
				'menu_class'      => 'mobile_menu',
			);
			wp_nav_menu( $args );
		?>
	</div>
</header>