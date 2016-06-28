<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );
?>
<div class="about-author clearfix">
	<div class="media">
		<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="pull-left">
			<?php
				echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'hippo_author_bio_avatar_size', 100 ) );
			?>
		</a>

		<div class="media-body">
			<div class="author-info media-heading">
				<h2><?php esc_html_e( 'About', 'industrix' ) ?><?php echo esc_html( get_the_author() ) ?></h2>
				<p><?php echo esc_html( get_the_author_meta( 'description' ) ) ?></p>
			</div>
		</div>
	</div>
</div>