<?php
	/*
	Template name: Home Shadowless
	*/

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	get_header();
?>

	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php the_content(); ?>

			<?php endwhile; endif; ?>
	</div>

<?php get_footer();