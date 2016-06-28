<?php
	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

?>

<div class="row">
	<form action="<?php esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>" method="post">
		<div class="col-lg-12">
			<?php esc_html_e( "To view this protected post, enter the password below:", 'industrix' ) ?>
			<div class="input-group">
				<input class="form-control" name="post_password" placeholder="<?php esc_html_e( "Password:", 'industrix' ) ?>" id="<?php echo esc_attr( $label ) ?>" type="password"/><span
					class="input-group-btn">
					<button class="btn btn-info" type="submit" name="Submit"><?php esc_html_e( "Submit", 'industrix' ) ?></button></span>
			</div><!-- /input-group -->
		</div><!-- /.col-lg-12 -->
	</form>
</div>
