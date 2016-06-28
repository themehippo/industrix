<?php
/*
Template name: Home Three
*/

defined( 'ABSPATH' ) or die( 'Keep Silent' );

?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class() ?>>
<div class="wrapper" id="wrapper">
	<?php do_action( 'hippo_theme_before_inner_wrapper' ); ?>
	<!-- content push wrapper -->
	<div class="inner-wrapper pusher">
		<?php do_action( 'hippo_theme_start_inner_wrapper' ); ?>
		<!-- this is the wrapper for the content -->
		<div class="contents">
			<section id="navigation">
				<div class="container">
					<div class="navbar navbar-default mainnav box-wrapper">
						<div class="navbar-header">
							<!-- offcanvas-trigger-effects -->
							<div id="offcanvas-trigger-effects" class="column">
								<button type="button" class="navbar-toggle visible-xs" data-toggle="offcanvas"
								        data-target="navbar-collapse" data-placement="right"
								        data-effect="offcanvas-effect">
									<i class="fa fa-bars"></i>
								</button>
							</div>
							<!-- offcanvas-trigger-effects -->

							<div class="logo pull-left">

								<a href="<?php echo esc_url( home_url( '/' ) ) ?>" title="<?php echo get_bloginfo( 'name' ) ?>">
									<?php
										$home3_logo = industrix_option( 'home3-logo', 'url', FALSE );

										if ( industrix_option( 'home3-logo', 'url', FALSE ) ): ?>
											<img src="<?php echo esc_url( $home3_logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"/>
										<?php else:
											industrix_custom_logo() ?>
										<?php endif; ?>
								</a>

							</div><!-- .logo -->
						</div> <!-- .navbar-header -->

						<div class="head-search pull-right">
							<form role="search" method="get" id="searchform" class="form-search"
							      action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<div class="search">
									<i class="fa fa-search"></i>
									<input type="search" size="20" class="form-control " maxlength="20"
									       value="<?php the_search_query(); ?>" name="s" id="s"/>
								</div>
							</form>
						</div> <!-- .head-search -->

						<nav class="navbar-collapse collapse" role="navigation">
							<?php wp_nav_menu( array(
								                   'container'      => FALSE,
								                   'theme_location' => 'primary',
								                   'items_wrap'     => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
								                   'walker'         => new Industrix_Menu_Walker(),
								                   'fallback_cb'    => 'Industrix_Menu_Walker::fallback'
							                   )
							);
							?>
						</nav>
					</div> <!-- .navbar -->
				</div> <!-- .container -->
			</section> <!-- #navigation -->

			<?php
				get_header( 'page' );
			?>

			<div class="container">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php the_content(); ?>

					<?php endwhile; endif; ?>
			</div>

<?php get_footer();