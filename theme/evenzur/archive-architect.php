<?php
    // Template Name: Architects Page
?>

<?php $td = get_template_directory_uri(); ?>
<?php get_header(); ?>

<?php
	$id = 12;
	setup_postdata($id);
	global $post;
	$post = get_post($id);
	global $wp_query;
	$wp_query -> queried_object = $post;
?>
<?php
	get_template_part( 'template-parts/top-inner' ); 
?>
<section class="projects">
	<div class="section-inner">
		<p class="section-title"><?=get_field('title')?></p>
		<div class="button-open-filters">
			<div class="inner">
				<img src="<?=$td?>/images/icons/filter.png">
				<span>סינונן וחיפוש</span>
			</div>
		</div>
		<div class="panel-projects">
			<div class="close">
				<img src="<?=$td?>/images/icons/close-dark.svg">
			</div>
			<div class="cols">
				<div class="col placeholder"></div>
				<div class="col part-left">
					<div class="inner">
						<div class="col search">
							<div class="search-field">
								<input type="text" name="" id="" placeholder="חיפוש">
							</div>
						</div>
	
						<div class="col display-mode">
							<p class="caption">תצוגה</p>
							<div class="item button-grid-3">
								<img src="<?=$td?>/images/icons/display-1.png">
							</div>
							<div class="item button-grid-4">
								<img src="<?=$td?>/images/icons/display-2.png">
							</div>
						</div>

					</div>
				</div>
				
			</div>
		</div>

		<div class="boxes projects">
			<?php 
				$args = Array(
					'post_type' => 'architect',
					'numberposts' => -1,
					'fields' => 'ids',
					'no_found_rows' => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
				);
				
				$posts = get_posts($args);
				
				foreach($posts as $apost) {	
					template_architect_box($apost);
				}

			?>
			
		</div>
	</div>

</section>

<script>
	$(document).ready(function ($) {
		$(".button-open-filters").on("click", function(){
			$(".panel-projects").toggleClass("open");
		});

		$(".panel-projects .close").on("click", function(){
			$(".panel-projects").toggleClass("open");
		});

		var curGrid = "grid-4";
		$(".button-grid-3").on("click", function() {
			$("section.projects .boxes").addClass("grid-3");
			$("section.projects .box").addClass("grid-3");
			curGrid = "grid-3";
		});

		$(".button-grid-4").on("click", function() {
			$("section.projects .boxes").removeClass("grid-3");
			$("section.projects .box").removeClass("grid-3");
			curGrid = "grid-4";
		});
		
		
		$(".search-field input").on("keyup", function(){
			var str = $(this).val();
			if(str.length > 2 || !str) startCounting();
			else stopCounting();
		});
	});
	
	
	var ticks = 0;
	var myTimer = setInterval(count, 100);
	clearInterval(myTimer);
	
	function startCounting() {
		ticks = 0;
		clearInterval(myTimer);
		myTimer = setInterval(count, 100);
	}
	function count() {
		ticks ++;
		if(ticks >= 5) {
			stopCounting();
			filterProducts();
		}
	}
	function stopCounting() {
		clearInterval(myTimer);
		ticks = 0;
	}
	
	
	function filterProducts(time = 250) {
		var str = $(".search-field input").val();

		$(".boxes.projects").animate({'opacity': 0}, time, function(){
			var count = 0;
			$(".boxes.projects .box").each(function(){
				var box = this;
			
				var visible = true;	
				
				if(str) {
					var projectTitle = $(".line-1", this).text();
					if(!projectTitle.includes(str)) {
						visible = false;
					}
				}
				

				
				if(visible) {
					$(this).show();
					count ++;
				}
				else {
					$(this).hide();
				}
			});
			
			$(".no-products").remove();
			if(count < 1) {
				$(".boxes.projects").append('<p class="no-products">לא נמצאו אדריכלים תואמים לתנאי החיפוש</p>');
			}
	
			$(".boxes.projects").animate({'opacity': 1}, time, function(){
				//hideEmptyTerms();
			});
			
		});
	}
</script>
<?php get_footer(); ?>