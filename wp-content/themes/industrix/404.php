<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
	get_header();
?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="not-found box-wrapper">

					<h1><?php esc_html_e( 'Error 404 - Not Found', 'industrix' ) ?></h1>

					<p><?php esc_html_e( 'Whoops! Whatever you are looking for cannot be found.', 'industrix' ) ?></p>

					<div class="readmore">
						<a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php esc_html_e( 'HOME PAGE', 'industrix' ) ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer();