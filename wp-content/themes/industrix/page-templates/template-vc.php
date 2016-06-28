<?php
	/*
	Template name: Visual Composer Page
	*/
	get_header(); ?>
	<section class="page-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php while ( have_posts() ): ?>
						<?php the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer();