<?php

function template_cat_box($id, $class = "") {
	$term = get_term($id);
	$thumbnail_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 
	$image = wp_get_attachment_image_src( $thumbnail_id, 'full')[0];
	if(!$image) $image = get_field("general", 'options')['image-placeholder']['url'];
?>	

<a class="box" href="<?=get_term_link($term);?>">
	<div class="inner">
		<div class="image">
			<img src="<?=$image ?>" alt="<?=$term->name;?>" title="<?=$term->name;?>">
		</div>
		<div class="text">
			<span><?=$term->name;?></span>
		</div>
	</div>
</a>

<?php
}


function template_post_box($id) {
	$item = get_post($id);
	$image = get_the_post_thumbnail_url($item, 'thumb-post');
	if(!$image) $image = get_field("general", 'options')['image-placeholder']['sizes']['thumb-post'];
?>

<a class="box box-post" href="<?=get_permalink($item)?>">
	<div class="inner">
		<div class="info">
			<p class="title"><?=$item -> post_title?></p>
			<div class="description">
				<p><?=make_short($item->post_content, 30)?></p>
			</div>
			<div class="button">
				<span>קרא עוד >></span>
			</div>
		</div>

		<div class="image">
			<img src="<?=$image?>" alt="<?=$item -> post_title?>" title="<?=$item -> post_title?>">
		</div>
	</div>
</a>
<?php 
}




function template_project_box($id, $show_atts=false) {
	$item = get_post($id);
	$image = get_the_post_thumbnail_url($item, 'thumb-project');
	if(!$image) $image = get_field("general", 'options')['image-placeholder']['sizes']['thumb-project'];
	
	if($show_atts) {
		$tax_list = Array('project_category', 'design', 'product');
		$atts = "";
		foreach($tax_list as $tax) {
			$terms = get_the_terms(get_post($id), $tax);
			if($terms) {
				$terms_ids = [];
				foreach($terms as $term) {
					$terms_ids[] = $term->term_id;
				}
				$tn = $tax;
				$str = $tn . "='" . implode(",",$terms_ids) . "' ";
				$atts .= $str;
			}
		}
	}
?>

<a class="box box-project" href="<?=get_permalink($item)?>" <?php if($show_atts) echo $atts;?>>
	<div class="inner">
		<img src="<?=$image?>" alt="<?=$item -> post_title?>" title="<?=$item -> post_title?>">
		<div class="caption">
			<p class="line-1"><?=$item -> post_title?></p>
			<?php if(get_field('architect', $item)) : ?>
			<p class="line-2"><?=get_field('architect', $item)?></p>
			<?php endif; ?>
			<div class="desc">
				<p><?=$item -> post_excerpt?></p>
			</div>
		</div>
	</div>
</a>
<?php 
}


function template_architect_box($id) {
	$item = get_post($id);
	$image = get_the_post_thumbnail_url($item, 'thumb-project');
	if(!$image) $image = get_field("general", 'options')['image-placeholder']['sizes']['thumb-project'];
?>

<a class="box box-project" href="<?=get_permalink($item)?>">
	<div class="inner">
		<img src="<?=$image?>" alt="<?=$item -> post_title?>" title="<?=$item -> post_title?>">
		<div class="caption">
			<p class="line-1"><?=$item -> post_title?></p>
			<?php if(get_field('office', $item)) : ?>
			<p class="line-2"><?=get_field('office', $item)?></p>
			<?php endif; ?>
		</div>
	</div>
</a>
<?php 
}



