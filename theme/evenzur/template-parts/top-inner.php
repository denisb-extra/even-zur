<?php $td = get_template_directory_uri(); ?>

<section class="top-inner">
	<div class="section-inner">
		<div class="breadcrumbs">
			<?php
				if ( function_exists('yoast_breadcrumb')) {
					yoast_breadcrumb( '' );
				}
			?>
		</div>
	</div>
</section>