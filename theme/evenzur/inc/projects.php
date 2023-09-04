<?php 
	$tax_query = array();
	if($cur_term) {
		$all_terms = get_all_term_ids_of_post_in_tax('project', 'project_category', $cur_term->term_id);
		$tax_query = array(
			array(
				'taxonomy' => 'project_category',
				'field' => 'term_id', 
				'terms' => $cur_term->term_id
			)
		);
	}
	//$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$args = Array(
		'post_type' => 'project',
		'numberposts' => -1,
		//'paged' => $paged,
		'fields' => 'ids',
		'no_found_rows' => true,
		'update_post_term_cache' => false,
		'update_post_meta_cache' => false,
		'tax_query' => $tax_query,
	);
	
	$projects = get_posts($args);
	
?>

<div class="big-loader loading"></div>
<section class="projects">
	<div class="section-inner wide">
		<?php if($cur_term) : ?>
			<p class="section-title"><?=$cur_term->name ?></p>
		<?php else : ?>
			<p class="section-title"><?php the_title(); ?></p>
		<?php endif; ?>
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
				<div class="col filters">
					<?php 
						$taxes = get_object_taxonomies('project');
						foreach($taxes as $tax_slug):
						if($cur_term && $tax_slug == 'project_category') continue;
						$tax = get_taxonomy($tax_slug);

						$atts = array(
							'taxonomy' => $tax->name,
							'hide_empty' => false,
							
						);
						if($cur_term) $atts['include'] = $all_terms;
						$terms = get_terms($atts);
						if(!$terms) continue;
						
						if($tax->label == "קטגוריות פרויקטים") $tax->label = "סינון על פי פרוייקט";
						if($tax->label == "סוגי עיצוב") $tax->label = "סינון על פי עיצוב";
						if($tax->label == "סוגי מוצר") $tax->label = "סינון על פי מוצר";
					
					?>
					<div class="parameters-selector tax-select" taxonomy="<?=$tax->name?>">
						<p class="title"><?=$tax->label?></p>
						<div class="items">
							<?php 
								foreach($terms as $term):
								if(get_field("no-filter", $term)) continue;
								if($cur_term) {
									$t_query = array(
										array(
											'taxonomy'      => 'project_category',
											'field' => 'term_id',
											'terms'         => $cur_term -> term_id
										),
										array(
											'taxonomy'      => $tax->name,
											'field' => 'term_id',
											'terms'         => $term -> term_id
										),
									);
									$args = array(
										'post_type'             => 'project',
										'posts_per_page'        => -1,
										'tax_query'             => $t_query,
									);
									
									
									$posts = get_posts($args);
									$count = sizeof($posts);
								}
								else {
									$count = $term->count;
								}
							?>
							<div class="item" term-id="<?=$term->term_id?>">
								<span class="text"><?=$term->name?></span>
								<span class="num">(<?=$count?>)</span>
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					<?php endforeach; ?>

				</div>

				<div class="col results">
					<div class="inner">
						<p class="title">תוצאות: <span class="result-count"></span></p>
						<div class="tags-wrapper">
							<p class="caption">בחרת לסנן לפי:</p>
						</div>
					</div>
				</div>
				
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
						<?php if(false) : ?>
						<div class="col nav">
							<?php the_posts_pagination(); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				
			</div>
		</div>

		<div class="boxes projects">
			<?php
				foreach($projects as $project) {	
					template_project_box($project, true);
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
		
		
		$(".tax-select .item").on("click", function(){
			$(this).toggleClass('active');
			filterProducts();
			
			buildTagList();
		});

		
		var boxesCount = $(".box-project:visible").length;
		$(".result-count").text(boxesCount);
		
		
		
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
	
	function buildTagList() {
		$(".tags-wrapper .tag").remove();
		
		$(".tax-select .item.active").each(function(){
			var tag = $('<div class="tag" term-id="' + $(this).attr("term-id") + '"><span>' + $(".text", this).text() + '</span></div>');
			$(".tags-wrapper").append(tag);
		});
		
		$(".tags-wrapper .tag").on("click", function() {
			var tagId = $(this).attr('term-id');
			$(".tax-select .item[term-id='"+tagId+"']").click();
		});
	}
	
	var filtered = false;
	function filterProducts(time = 250) {
		if(!filtered) {
			filtered = true;
			load_all_projects();
			return;
		}
		var str = $(".search-field input").val();

		$(".boxes.projects").animate({'opacity': 0}, time, function(){
			var count = 0;
			$(".boxes.projects .box").each(function(){
				var box = this;
				var id = $(this).attr('product-id');
							
				var visible = true;	
				
				if(str) {
					var projectTitle = $(".line-1", this).text();
					if(!projectTitle.includes(str)) {
						visible = false;
					}
				}
				$(".tax-select").each(function(){
					if(!visible) return false;

					var tax = $(this).attr("taxonomy");
					var activeItems = $(this).find('.item.active');
					
					if(!activeItems.length) {
						return true;
					}

					var taxIsGood = false;
					activeItems.each(function(){
						if(taxIsGood) return false;
						if(!$(box).attr(tax)) {
							visible = false;
							return false;
						}
						var ids = $(box).attr(tax).split(',');
						if(!ids) {
							visible = false;
							return false;
						}
						
						var termId = $(this).attr('term-id');
						
						if(ids.includes(termId)) {
							taxIsGood = true;
							return false;
						}
					});
					
					if(!taxIsGood) visible = false;
				});
				
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
				$(".boxes.projects").append('<p class="no-products">לא נמצאו פרויקטים תואמים לתנאי החיפוש</p>');
			}
	
			$(".boxes.projects").animate({'opacity': 1}, time, function(){
				//hideEmptyTerms();
			});
			
			var boxesCount = $(".box-project:visible").length;
			$(".result-count").text(boxesCount);
		});
	}
	
	<?php 
		$cat_id = '0';
		if($cur_term) $cat_id = $cur_term -> term_id;
	?>
	
	function load_all_projects() {
		$.ajax({
			type: "POST",
			url: "<?php echo admin_url('admin-ajax.php'); ?>",
			data: {
				action: 'load_projects_by_cat_id',
				cat_id: '<?=$cat_id?>',
			},
			beforeSend: function(){
				$('.big-loader').fadeIn();
			},
			success: function(answer){
				$(".boxes.projects").html(answer);
				$('.big-loader').fadeOut();
				$(".nav-links").hide();
				filterProducts();
				
			},
			complete: function(answer){
				
			},
			eror: function() {console.log("error during ajax request");},
		});
	}
</script>