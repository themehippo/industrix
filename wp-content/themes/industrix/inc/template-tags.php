<?php

	defined( 'ABSPATH' ) or die( 'Keep Silent' );

	//----------------------------------------------------------------------
	//  Single Post navigation link. <- Previous post  |   Next Post ->
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_post_navigation' ) ) :

		function industrix_post_navigation() {
			get_template_part( 'template-parts/post', 'navigation' );
		}
	endif;

	//----------------------------------------------------------------------
	//  Login Popup Modal
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_login_modal' ) ):

		function industrix_login_modal() {
			get_template_part( 'template-parts/modal-login' );
		}
	endif;

	add_action( 'wp_footer', 'industrix_login_modal', 999 );

	//----------------------------------------------------------------------
	// Display <!--nextpage--> pagination
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_link_pages' ) ) :

		function industrix_link_pages( $args = array() ) {
			$defaults = array(
				'before'           => '<div class="pagination-wrap clearfix">',
				'after'            => '</div>',
				'link_before'      => '',
				'link_after'       => '',
				'next_or_number'   => 'number',
				'nextpagelink'     => esc_html__( 'Next page', 'industrix' ),
				'previouspagelink' => esc_html__( 'Previous page', 'industrix' ),
				'pagelink'         => '%',
				'echo'             => 1
			);

			$args = apply_filters( 'wp_link_pages_args', wp_parse_args( $args, $defaults ) );

			global $page, $numpages, $multipage, $more, $pagenow;

			$output = '';
			if ( $multipage ) {
				if ( 'number' == $args[ 'next_or_number' ] ) {
					$output .= $args[ 'before' ] . '<ul class="pagination">';
					$laquo = $page == 1 ? 'class="disabled"' : '';
					$output .= '<li ' . $laquo . '>' . _wp_link_page( $page - 1 ) . ' <i class="zmdi zmdi-chevron-left"></i></a></li>';
					for (
						$i = 1;
						$i < ( $numpages + 1 );
						$i = $i + 1
					) {
						$j = str_replace( '%', $i, $args[ 'pagelink' ] );

						if ( ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) ) ) {
							$output .= '<li>';
							$output .= _wp_link_page( $i );
						} else {
							$output .= '<li class="active">';
							$output .= _wp_link_page( $i );
						}
						$output .= $args[ 'link_before' ] . $j . $args[ 'link_after' ];

						$output .= '</a></li>';
					}
					$raquo = $page == $numpages ? 'class="disabled"' : '';
					$output .= '<li ' . $raquo . '>' . _wp_link_page( $page + 1 ) . ' <i class="zmdi zmdi-chevron-right"></i> </a></li>';
					$output .= '</ul>' . $args[ 'after' ];
				} else {
					if ( $more ) {
						$output .= $args[ 'before' ] . '<ul class="pager">';
						$i = $page - 1;
						if ( $i && $more ) {
							$output .= '<li class="previous">' . _wp_link_page( $i );
							$output .= $args[ 'link_before' ] . $args[ 'previouspagelink' ] . $args[ 'link_after' ] . '</li>';
						}
						$i = $page + 1;
						if ( $i <= $numpages && $more ) {
							$output .= '<li class="next">' . _wp_link_page( $i );
							$output .= $args[ 'link_before' ] . $args[ 'nextpagelink' ] . $args[ 'link_after' ] . '</a></li>';
						}
						$output .= '</ul>' . $args[ 'after' ];
					}
				}
			}

			if ( $args[ 'echo' ] ) {
				echo $output;
			} else {
				return $output;
			}
		}
	endif;


	//----------------------------------------------------------------------
	//  Posts navigation link. <- Older post  |   Newer Post ->
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_posts_navigation' ) ) :

		function industrix_posts_navigation() {
			if ( $GLOBALS[ 'wp_query' ]->max_num_pages > 1 ) {
				get_template_part( 'template-parts/posts', 'navigation' );
			}
		}
	endif;


	//----------------------------------------------------------------------
	//  Blog Pagination
	//----------------------------------------------------------------------


	if ( ! function_exists( 'industrix_posts_pagination' ) ) {
		function industrix_posts_pagination() { ?>

			<div class="blog-pagination">

				<?php global $wp_query;
					if ( $wp_query->max_num_pages > 1 ) {
						$big   = 999999999; // need an unlikely integer
						$items = paginate_links( array(
							                         'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							                         'format'    => '?paged=%#%',
							                         'prev_next' => TRUE,
							                         'current'   => max( 1, get_query_var( 'paged' ) ),
							                         'total'     => $wp_query->max_num_pages,
							                         'type'      => 'array',
							                         'prev_text' => __( 'Previous', 'industrix' ),
							                         'next_text' => __( 'Next', 'industrix' )
						                         ) );

						$pagination = "<ul class=\"pagination\">\n\t<li>";
						$pagination .= join( "</li>\n\t<li>", $items );
						$pagination .= "</li>\n</ul>\n";

						echo $pagination;
					} ?>

			</div>

			<?php return;

		}
	}


	//------------------------------------------------------------------------------------
	//  Prints HTML with meta information for the current post-date/time, author & others.
	//------------------------------------------------------------------------------------

	if ( ! function_exists( 'industrix_posted_on' ) ) {
		function industrix_posted_on( $hide_list = array() ) {

			// $all_hideable_option_arrays =  array('author', 'category', 'tag','comment', 'view', 'like' );

			?>

			<ul>

				<li><?php printf( '<time class="date entry-date published" datetime="%1$s"><i
                        class="fa fa-calendar"></i> %2$s</time>',
				                  esc_attr( get_the_date( 'c' ) ),
				                  esc_html( get_the_date( get_option( 'date_format' ) ) )
					) ?>
				</li>

				<li>
                    <span class="author vcard"><i
		                    class="fa fa-user"></i><?php printf( '<a class="url fn n" href="%1$s">%2$s</a>',
                                                                 esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                                                 esc_html( get_the_author() )
	                    ) ?>
                    </span>
				</li>

				<?php if ( get_the_category_list() ) { ?>
					<li>
                        <span class="category"><i
		                        class="fa fa-folder-open-o"></i><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'industrix' ) ); ?>
                        </span>
					</li>
				<?php } ?>


				<li>
                    <span class="comments">
                        <i class="fa fa-comments"></i> <?php comments_popup_link( '0', '1', '%' ); ?>
                    </span>
				</li>

				<?php if ( function_exists( 'hippo_get_post_views' ) ) { ?>
					<li>
                        <span class="hits"
                              title="<?php printf( __( 'Hits: %d', 'industrix' ), hippo_get_post_views() ) ?>">
                            <i class="fa fa-eye"></i><?php echo hippo_get_post_views(); ?>
                        </span>
					</li>
				<?php } ?>


				<?php echo edit_post_link( __( "Edit Post", 'industrix' ), '<li><i class="fa fa-pencil"></i>', "</li>" ) ?>
			</ul>


			<?php
		}
	}


	//------------------------------------------------------------------------------------
	//  Returns true if a blog has more than 1 category.
	//------------------------------------------------------------------------------------

	if ( ! function_exists( 'industrix_categorized_blog' ) ):

		function industrix_categorized_blog() {

			if ( FALSE === ( $all_the_cool_cats = get_transient( 'industrix_categories' ) ) ) {
				// Create an array of all the categories that are attached to posts.
				$all_the_cool_cats = get_categories( array(
					                                     'fields'     => 'ids',
					                                     'hide_empty' => 1,

					                                     // We only need to know if there is more than one category.
					                                     'number'     => 2,
				                                     ) );

				// Count the number of categories that are attached to the posts.
				$all_the_cool_cats = count( $all_the_cool_cats );

				set_transient( 'industrix_categories', $all_the_cool_cats );
			}

			if ( $all_the_cool_cats > 1 ) {
				// This blog has more than 1 category so hippo_categorized_blog should return true.
				return TRUE;
			} else {
				// This blog has only 1 category so hippo_categorized_blog should return false.
				return FALSE;
			}
		}
	endif;

	//------------------------------------------------------------------------------------
	//  Flush out the transients used in hippo_categorized_blog.
	//------------------------------------------------------------------------------------
	if ( ! function_exists( 'industrix_category_transient_flusher' ) ):

		function industrix_category_transient_flusher() {
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}
			// Like, beat it. Dig?
			delete_transient( 'industrix_categories' );
		}

		add_action( 'edit_category', 'industrix_category_transient_flusher' );
		add_action( 'save_post', 'industrix_category_transient_flusher' );

	endif;


	//----------------------------------------------------------------------
	// Read More link
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_blog_more_link' ) ) {

		function industrix_blog_more_link( $link ) {
			$more_link = str_replace( 'more-link', 'more-link readmore', $link );

			return '<div class="readmore">' . $more_link . '</div>';
		}

		add_filter( 'the_content_more_link', 'industrix_blog_more_link' );
	}


	//----------------------------------------------------------------------
	// Display recent post thumbnail.
	//----------------------------------------------------------------------


	if ( ! function_exists( 'industrix_post_thumbnail' ) ) {

		function industrix_post_thumbnail( $placeholder = 'http://placehold.it/845x400' ) {

			$bool_return = FALSE;

			if ( is_bool( $placeholder ) and $placeholder == TRUE ) {
				$bool_return = TRUE;
			}

			global $post;

			$post_format = get_post_format();
			$post_format = ( FALSE === $post_format ) ? 'standard' : $post_format;
			$has_thumb   = FALSE;
			$post_id     = get_the_ID();
			$extra_class = '';


			switch ( $post_format ) {

				case 'standard':
				case 'image':
				case 'quote':
				case 'link':
				case 'chat':
				case 'aside':

					$extra_class .= ' standard-post-format ';

					if ( has_post_thumbnail() ) {
						$has_thumb = TRUE;
					}
					break;

				case 'video':

					$embed_video = get_post_meta( $post_id, 'post_video_embed', TRUE );
					$embed_webm  = get_post_meta( $post_id, 'post_featured_webm', TRUE );
					$embed_ogv   = get_post_meta( $post_id, 'post_featured_ogv', TRUE );
					$embed_mp4   = get_post_meta( $post_id, 'post_featured_mp4', TRUE );

					if ( has_post_thumbnail() ) {
						$has_thumb = TRUE;
					} elseif ( ! empty( $embed_video ) or ! empty( $embed_webm ) or ! empty( $embed_ogv ) or ! empty( $embed_mp4 ) ) {
						$has_thumb = TRUE;
					}

					break;

				case 'audio':

					$embed_audio = get_post_meta( $post_id, 'post_audio_embed', TRUE );
					$embed_mp3   = get_post_meta( $post_id, 'post_featured_mp3', TRUE );
					$embed_ogg   = get_post_meta( $post_id, 'post_featured_ogg', TRUE );

					if ( has_post_thumbnail() ) {
						$has_thumb = TRUE;
					} elseif ( ! empty( $embed_audio ) or ! empty( $embed_mp3 ) or ! empty( $embed_ogg ) ) {
						$has_thumb = TRUE;
					}

					break;

				case 'gallery':

					$gallery_items = get_post_meta( $post_id, 'post_featured_gallery', TRUE );

					if ( has_post_thumbnail() ) {
						$has_thumb = TRUE;
					} elseif ( ! empty( $gallery_items ) ) {
						$has_thumb = TRUE;
					}
					break;
			}

			if ( post_password_required() ) {
				$has_thumb = FALSE;
			}

			if ( $bool_return ) {
				return $has_thumb;
			}

			if ( $has_thumb ) { ?>

				<div class="entry-thumbnail post-thumbnail element <?php echo $post_format ?>">
					<?php
						do_action( 'before_hippo_post_thumbnail', array(
							'post_format' => $post_format,
							'has_thumb'   => $has_thumb,
							'post_id'     => $post_id
						) );

						if ( $post_format == 'standard'
						     || $post_format == 'image'
						     || $post_format == 'quote'
						     || $post_format == 'link'
						     || $post_format == 'chat'
						     || $post_format == 'aside'
						) {

							if ( get_the_post_thumbnail() ) {

								if ( is_single() ) {
									the_post_thumbnail( apply_filters( 'hippo_post_thumbnail_image_size', 'blog-thumbnail' ), array(
										'class' => 'img-responsive',
										'alt'   => get_the_title()
									) );
								} else {
									the_post_thumbnail( apply_filters( 'hippo_post_thumbnail_image_size', 'blog-thumbnail' ), array(
										'class' => 'img-responsive',
										'alt'   => get_the_title()
									) );
								}
							} else {

								if ( is_single() ) {
									echo apply_filters( 'hippo_post_thumbnail_placeholder', '<img src="' . $placeholder . '" class="img-responsive wp-post-image" alt="' . get_the_title() . '">' );
								} else {
									echo apply_filters( 'hippo_post_thumbnail_placeholder', '<img src="' . $placeholder . '" class="img-responsive wp-post-image" alt="' . get_the_title() . '">' );
								}
							}
						} elseif ( $post_format == 'video' ) {

							if ( $embed_video and ( empty( $embed_webm ) or empty( $embed_ogv ) or empty( $embed_mp4 ) ) ) {
								echo wp_oembed_get( $embed_video );
							} elseif ( ! empty( $embed_webm ) or ! empty( $embed_ogv ) or ! empty( $embed_mp4 ) ) {
								?>

								<video style="width: 100%" class="featured-video wp-video-shortcode" preload="auto"
								       controls="controls">
									<?php if ( ! empty( $embed_webm ) ) { ?>
										<source src="<?php echo wp_get_attachment_url( $embed_webm ) ?>"
										        type="video/webm"/>
									<?php } ?>
									<?php if ( ! empty( $embed_ogv ) ) { ?>
										<source src="<?php echo wp_get_attachment_url( $embed_ogv ) ?>" type="video/ogg"/>
									<?php } ?>

									<?php if ( ! empty( $embed_mp4 ) ) { ?>
										<source src="<?php echo wp_get_attachment_url( $embed_mp4 ) ?>" type="video/mp4"/>
									<?php } ?>
								</video>
								<?php
							}
						} elseif ( $post_format == 'audio' ) {

							if ( $embed_audio and ( empty( $embed_mp3 ) or empty( $embed_ogg ) ) ) {
								echo wp_oembed_get( $embed_audio );
							} elseif ( ! empty( $embed_mp3 ) or ! empty( $embed_ogg ) ) {
								?>
								<audio style="width: 100%" class="featured-audio wp-audio-shortcode"
								       controls="controls" preload="none">
									<?php if ( ! empty( $embed_mp3 ) ) { ?>
										<source src="<?php echo wp_get_attachment_url( $embed_mp3 ) ?>"
										        type="audio/mpeg"/>
									<?php } ?>
									<?php if ( ! empty( $embed_ogg ) ) { ?>
										<source src="<?php echo wp_get_attachment_url( $embed_ogg ) ?>" type="audio/ogg"/>
									<?php } ?>
								</audio>
								<?php
							}
						} elseif ( $post_format == 'gallery' ) {

							if ( has_post_thumbnail() ) {
								if ( get_the_post_thumbnail() ) {

									if ( is_single() ) {
										the_post_thumbnail( apply_filters( 'hippo_post_thumbnail_image_size', 'blog-thumbnail' ), array(
											'class' => 'img-responsive',
											'alt'   => get_the_title()
										) );
									} else {

										the_post_thumbnail( apply_filters( 'hippo_post_thumbnail_image_size', 'blog-thumbnail' ), array(
											'class' => 'img-responsive',
											'alt'   => get_the_title()
										) );
									}

								} else {

									if ( is_single() ) {
										echo apply_filters( 'hippo_post_thumbnail_placeholder', '<img src="' . $placeholder . '" class="img-responsive wp-post-image" alt="' . get_the_title() . '">' );
									} else {
										echo apply_filters( 'hippo_post_thumbnail_placeholder', '<img src="' . $placeholder . '" class="img-responsive wp-post-image" alt="' . get_the_title() . '">' );
									}
								}
							} else {

								if ( is_array( $gallery_items ) ) {
									?>
									<div class="carousel slide blog-carousel" data-ride="carousel">

										<!-- Wrapper for slides -->
										<div class="carousel-inner">

											<?php $increment = 0;
												foreach ( $gallery_items as $gallery_item_id ) {
													$large_image_url = wp_get_attachment_image_src( $gallery_item_id, 'large' );
													?>
													<div
														class="item <?php echo ( $increment < 1 ) ? 'active' : '' ?>">
														<img class="img-responsive"
														     src="<?php echo $large_image_url[ 0 ] ?>"
														     alt="<?php echo trim( strip_tags( get_post_meta( $gallery_item_id, '_wp_attachment_image_alt', TRUE ) ) ) ?>"/>
													</div>
													<?php $increment ++;
												} ?>

										</div>

										<!-- Controls -->
										<a class="left carousel-control" href=".blog-carousel" data-slide="prev">
											<i class="fa fa-angle-left"></i>
										</a>

										<a class="right carousel-control" href=".blog-carousel" data-slide="next">
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
									<?php
								}
							}
						}

						do_action( 'after_hippo_post_thumbnail', array(
							'post_format' => $post_format,
							'has_thumb'   => $has_thumb,
							'post_id'     => $post_id
						) );
					?>
				</div>
				<?php
			} else {
				return FALSE;
			}
		}
	}


	//----------------------------------------------------------------------
	//  Post Password form
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_post_password_form' ) ) :

		function industrix_post_password_form() {

			ob_start();
			get_template_part( 'template-parts/post-password-form' );

			return ob_get_clean();
		}

		add_filter( 'the_password_form', 'industrix_post_password_form' );
	endif;


	//----------------------------------------------------------------------
	// Breadcrumb
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_breadcrumbs' ) ) {

		function industrix_breadcrumbs() {
			$active_class  = apply_filters( 'hippo_breadcrumb_active_class', 'active' );
			$wrapper_class = apply_filters( 'hippo_breadcrumb_wrapper_class', 'breadcrumb' );

			/* === OPTIONS === */
			$text[ 'home' ]     = __( 'Home', 'industrix' ); // text for the 'Home' link
			$text[ 'category' ] = __( 'Archive by Category "%s"', 'industrix' ); // text for a category page
			$text[ 'search' ]   = __( 'Search Results for "%s" Query', 'industrix' ); // text for a search results page
			$text[ 'tag' ]      = __( 'Posts Tagged "%s"', 'industrix' ); // text for a tag page
			$text[ 'author' ]   = __( 'Posted by %s', 'industrix' ); // text for an author page
			$text[ '404' ]      = __( 'Error 404', 'industrix' ); // text for the 404 page

			$show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show
			$show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
			$show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
			$show_title     = 1; // 1 - show the title for the links, 0 - don't show
			$delimiter      = ''; // delimiter between crumbs
			$before         = '<li class="' . $active_class . '">'; // tag before the current crumb
			$after          = '</li>'; // tag after the current crumb
			/* === END OF OPTIONS === */

			global $post;
			$home_link          = home_url( '/' );
			$link_before        = '<li typeof="v:Breadcrumb">';
			$active_link_before = '<li class="' . $active_class . '">';
			$link_after         = '</li>';
			$link_attr          = ' rel="v:url" property="v:title"';
			$active_link        = $active_link_before . '%2$s' . $link_after;
			$link               = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
			$parent_id          = $parent_id_2 = isset( $post->post_parent ) ? $post->post_parent : '';
			$frontpage_id       = get_option( 'page_on_front' );
			$query              = get_queried_object();

			do_action( 'hippo_before_breadcrumbs' );

			if ( is_home() and ! is_front_page() ) {

				if ( $show_on_home == 1 ) {
					echo '<ul class="' . $wrapper_class . '">';
					printf( $link, $home_link, $text[ 'home' ] );
					if ( isset( $query ) ) {
						printf( $active_link, get_permalink( $query->ID ), esc_attr( $query->post_title ) );
					}
					echo '</ul>';
				}
			} elseif ( is_home() || is_front_page() ) {

				if ( $show_on_home == 1 ) {
					echo '<ul class="' . $wrapper_class . '">
                        <li class="' . $active_class . '">
                            <a href="' . $home_link . '">' . $text[ 'home' ] . '</a>
                        </li>
                    </ul>';
				}

			} else {
				echo '<ul class="' . $wrapper_class . '" xmlns:v="http://rdf.data-vocabulary.org/#">';
				if ( $show_home_link == 1 ) {
					echo '<li><a href="' . $home_link . '" rel="v:url" property="v:title">' . $text[ 'home' ] . '</a></li>';
					if ( $frontpage_id == 0 || $parent_id != $frontpage_id ) {
						echo $delimiter;
					}
				}

				// category

				if ( is_category() ) {
					$this_cat = get_category( get_query_var( 'cat' ), FALSE );
					if ( $this_cat->parent != 0 ) {
						$cats = get_category_parents( $this_cat->parent, TRUE, $delimiter );
						if ( $show_current == 0 ) {
							$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
						}
						$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
						$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
						if ( $show_title == 0 ) {
							$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
						}
						echo $cats;
					}
					if ( $show_current == 1 ) {
						echo $before . sprintf( $text[ 'category' ], apply_filters( 'hippo_breadcrumb_title', single_cat_title( '', FALSE ), single_cat_title( '', FALSE ) ) ) . $after;
					}

				} // search

				elseif ( is_search() ) {
					echo $before . sprintf( $text[ 'search' ], apply_filters( 'hippo_breadcrumb_title', get_search_query(), get_search_query() ) ) . $after;

				} // archive - day

				elseif ( is_day() ) {
					echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
					echo sprintf( $link, get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ), get_the_time( 'F' ) ) . $delimiter;
					echo $before . get_the_time( 'd' ) . $after;

				} // archive - month

				elseif ( is_month() ) {
					echo sprintf( $link, get_year_link( get_the_time( 'Y' ) ), get_the_time( 'Y' ) ) . $delimiter;
					echo $before . get_the_time( 'F' ) . $after;

				} // archive - year

				elseif ( is_year() ) {
					echo $before . get_the_time( 'Y' ) . $after;

				} // single post

				elseif ( is_single() && ! is_attachment() ) {

					// custom post type

					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object( get_post_type() );
						$slug      = $post_type->rewrite;


						if ( $show_current == 1 ) {
							echo $delimiter . $before . apply_filters( 'hippo_breadcrumb_title', get_the_title(), get_the_title() ) . $after;
						}
					} else {
						$cat  = get_the_category();
						$cat  = $cat[ 0 ];
						$cats = get_category_parents( $cat, TRUE, $delimiter );
						if ( $show_current == 0 ) {
							$cats = preg_replace( "#^(.+)$delimiter$#", "$1", $cats );
						}
						$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
						$cats = str_replace( '</a>', '</a>' . $link_after, $cats );
						if ( $show_title == 0 ) {
							$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
						}
						echo $cats;
						if ( $show_current == 1 ) {
							echo $before . apply_filters( 'hippo_breadcrumb_title', get_the_title(), get_the_title() ) . $after;
						}
					}

				} elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() ) {
					$post_type = get_post_type_object( get_post_type() );
					echo $before . apply_filters( 'hippo_breadcrumb_title', $post_type->labels->singular_name, $post_type->labels->singular_name ) . $after;

				} elseif ( is_attachment() ) {
					$parent = get_post( $parent_id );
					$cat    = get_the_category( $parent->ID );

					if ( ! empty( $cat ) ) {
						$cat  = $cat[ 0 ];
						$cats = get_category_parents( $cat, TRUE, $delimiter );
						$cats = str_replace( '<a', $link_before . '<a' . $link_attr, $cats );
						$cats = str_replace( '</a>', '</a>' . $link_after, $cats );

						if ( $show_title == 0 ) {
							$cats = preg_replace( '/ title="(.*?)"/', '', $cats );
						}
						echo $cats;
						printf( $link, get_permalink( $parent ), $parent->post_title );
					}
					if ( $show_current == 1 ) {
						echo $delimiter . $before . apply_filters( 'hippo_breadcrumb_title', get_the_title(), get_the_title() ) . $after;
					}

				} elseif ( is_page() && ! $parent_id ) {
					if ( $show_current == 1 ) {
						echo $before . apply_filters( 'hippo_breadcrumb_title', get_the_title(), get_the_title() ) . $after;
					}

				} elseif ( is_page() && $parent_id ) {
					if ( $parent_id != $frontpage_id ) {
						$breadcrumbs = array();
						while ( $parent_id ) {
							$page = get_post( $parent_id );
							if ( $parent_id != $frontpage_id ) {
								$breadcrumbs[] = sprintf( $link, get_permalink( $page->ID ), get_the_title( $page->ID ) );
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse( $breadcrumbs );
						for ( $i = 0; $i < count( $breadcrumbs ); $i ++ ) {
							echo $breadcrumbs[ $i ];
							if ( $i != count( $breadcrumbs ) - 1 ) {
								echo $delimiter;
							}
						}
					}
					if ( $show_current == 1 ) {
						if ( $show_home_link == 1 || ( $parent_id_2 != 0 && $parent_id_2 != $frontpage_id ) ) {
							echo $delimiter;
						}
						echo $before . apply_filters( 'hippo_breadcrumb_title', get_the_title(), get_the_title() ) . $after;
					}

				} elseif ( is_tag() ) {
					echo $before . sprintf( $text[ 'tag' ], apply_filters( 'hippo_breadcrumb_title', single_tag_title( '', FALSE ), single_tag_title( '', FALSE ) ) ) . $after;

				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata( $author );
					echo $before . sprintf( $text[ 'author' ], apply_filters( 'hippo_breadcrumb_title', $userdata->display_name, $userdata->display_name ) ) . $after;

				} elseif ( is_404() ) {
					echo $before . $text[ '404' ] . $after;
				}

				if ( get_query_var( 'paged' ) ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
						echo ' (';
					}
					echo __( 'Page', 'industrix' ) . ' ' . get_query_var( 'paged' );
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
						echo ')';
					}
				}

				echo '</ul><!-- .breadcrumbs -->';

			}

			do_action( 'hippo_after_breadcrumbs' );
		}
	}


	//----------------------------------------------------------------------
	// Sub title text
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_title_text' ) ) {
		function industrix_title_text() {

			$query = get_queried_object();

			if ( is_archive() ) {
				if ( is_day() ) {
					$archive_title = get_the_time( 'd F, Y' );
					$title         = sprintf( __( 'Archive of: %s', 'industrix' ), $archive_title );
				} elseif ( is_month() ) {
					$archive_title = get_the_time( 'F Y' );
					$title         = sprintf( __( 'Archive of: %s', 'industrix' ), $archive_title );
				} elseif ( is_year() ) {
					$archive_title = get_the_time( 'Y' );
					$title         = sprintf( __( 'Archive of: %s', 'industrix' ), $archive_title );
				}
			}

			if ( is_404() ) {
				$title = __( '404 Not Found', 'industrix' );
			}

			if ( is_search() ) {
				$title = sprintf( __( 'Search result for: "%s"', 'industrix' ), get_search_query() );
			}

			if ( is_category() ) {
				$title = sprintf( __( 'Category: %s', 'industrix' ), $query->name );
			}

			if ( is_tag() ) {
				$title = sprintf( __( 'Tag: %s', 'industrix' ), $query->name );
			}

			if ( is_author() ) {
				$title = sprintf( __( 'Posts of: %s', 'industrix' ), $query->display_name );
			}

			if ( is_page() ) {
				$title = $query->post_title;
			}

			if ( is_home() or is_single() ) {
				$title = industrix_option( 'blog-title' );
			}

			if ( is_singular( 'project' ) ) {
				$title = get_the_title();
			}

			if ( is_singular( 'portfolio' ) ) {
				$title = get_the_title();
			}

			if ( is_singular( 'service' ) ) {
				$title = get_the_title();
			}

			if ( is_singular( 'team' ) ) {
				$title = get_the_title();
			}

			if ( is_singular( 'job' ) ) {
				$title = get_the_title();
			}

			if ( is_singular( 'product' ) ) {
				$title = get_the_title();
			}

			if ( is_post_type_archive( 'product' ) ) {

				$title = post_type_archive_title( '', FALSE );

			}

			if ( class_exists( 'WooCommerce' ) ) {

				if ( is_shop() || is_singular( 'product' ) ) {
					$title = industrix_option( 'shop-title' );
				}

				if ( is_product_category() ) {
					$title = sprintf( __( '%s', 'industrix' ), $query->name );
				}

				if ( is_product_tag() ) {
					$title = sprintf( __( '%s', 'industrix' ), $query->name );
				}
			}

			$title = apply_filters( 'hippo_title_text', $title, $title );

			if ( empty( $title ) ) {
				$title = get_bloginfo( 'name' );
			}

			return $title;
		}
	}


	//----------------------------------------------------------------------
	// Title Image used in Archive, Search, 404,
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_title_image' ) ) {

		function industrix_title_image( $placeholder = 'http://placehold.it/1400x400' ) {
			$query = get_queried_object();

			$image = FALSE;

			if ( is_archive() ) {
				$image = industrix_option( 'title-archive-image', 'url' );
			}

			if ( is_404() ) {
				$image = industrix_option( 'title-404-image', 'url' );
			}

			if ( is_search() ) {
				$image = industrix_option( 'title-search-image', 'url' );
			}

			if ( is_category() ) {
				$image = industrix_option( 'title-category-image', 'url' );
			}

			if ( is_tag() ) {
				$image = industrix_option( 'title-tag-image', 'url' );
			}

			if ( is_author() ) {
				$image = industrix_option( 'title-author-image', 'url' );
			}

			if ( is_page() ) {

				$image = industrix_option( 'title-page-image', 'url' );

				$indivisual_image = get_post_meta( $query->ID, 'page_header_image', TRUE );

				$indivisual_image = ( $indivisual_image ) ? wp_get_attachment_url( $indivisual_image ) : FALSE;

				if ( $indivisual_image ) {
					$image = $indivisual_image;
				}

			}


			if ( is_single() ) {

				$image = industrix_option( 'title-single-image', 'url' );

				$indivisual_image = get_post_meta( $query->ID, 'page_header_image', TRUE );

				$indivisual_image = ( $indivisual_image ) ? wp_get_attachment_url( $indivisual_image ) : FALSE;

				if ( $indivisual_image ) {
					$image = $indivisual_image;
				}
			}


			if ( empty ( $indivisual_image ) ) {

				if ( is_singular( 'team' ) ) {
					$image = industrix_option( 'title-team-image', 'url' );
				}

				if ( is_singular( 'project' ) ) {
					$image = industrix_option( 'title-project-image', 'url' );
				}

				if ( is_singular( 'portfolio' ) ) {
					$image = industrix_option( 'title-portfolio-image', 'url' );
				}

				if ( is_singular( 'service' ) ) {
					$image = industrix_option( 'title-service-image', 'url' );
				}

				if ( is_singular( 'job' ) ) {
					$image = industrix_option( 'title-job-image', 'url' );
				}
			}


			if ( is_home() ) {
				$image = industrix_option( 'title-blog-image', 'url' );
			}

			if ( ! $image ) {
				$image = industrix_option( 'title-blog-image', 'url' );
			}

			if ( class_exists( 'WooCommerce' ) ) {

				if ( is_shop() || is_singular( 'product' ) ) {
					$image = industrix_option( 'title-shop-image', 'url' );
				}
			}

			$link = apply_filters( 'industrix_title_image', $image, $image );

			if ( empty( $link ) ) {
				return $placeholder;
			} else {
				return $link;
			}
		}

	}

	//----------------------------------------------------------------------
	// Get Post Type Link
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_get_post_type_link' ) ) {

		function industrix_get_post_type_link( $post_type ) {

			global $wp_rewrite;

			if ( ! $post_type_obj = get_post_type_object( $post_type ) ) {
				return FALSE;
			}

			if ( get_option( 'permalink_structure' ) && is_array( $post_type_obj->rewrite ) ) {

				$struct = $post_type_obj->rewrite[ 'slug' ];
				if ( $post_type_obj->rewrite[ 'with_front' ] ) {
					$struct = $wp_rewrite->front . $struct;
				} else {
					$struct = $wp_rewrite->root . $struct;
				}

				$link = home_url( user_trailingslashit( $struct, 'post_type_archive' ) );

			} else {
				$link = home_url( '?post_type=' . $post_type );
			}

			return $link;
		}
	}

	//----------------------------------------------------------------------
	// Comment form
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_comment_form' ) ) {

		function industrix_comment_form( $args = array(), $post_id = NULL ) {
			if ( NULL === $post_id ) {
				$post_id = get_the_ID();
			} else {
				$id = $post_id;
			}

			$commenter     = wp_get_current_commenter();
			$user          = wp_get_current_user();
			$user_identity = $user->exists() ? $user->display_name : '';

			if ( ! isset( $args[ 'format' ] ) ) {
				$args[ 'format' ] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
			}

			$req      = get_option( 'require_name_email' );
			$aria_req = ( $req ? " aria-required='true'" : '' );
			$html5    = 'html5' === $args[ 'format' ];
			$fields   = array(
				'author' => '
                <div class="form-group">
                    <div class="col-sm-6 comment-form-author">
                        <input   class="form-control"  id="author"
                        placeholder="' . __( 'Name', 'industrix' ) . '" name="author" type="text"
                        value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $aria_req . ' />
                    </div>',
				'email'  => '<div class="col-sm-6 comment-form-email">
                    <input id="email" class="form-control" name="email"
                    placeholder="' . __( 'Email', 'industrix' ) . '" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . '
                    value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" ' . $aria_req . ' />
                </div>
            </div>',
				'url'    => '<div class="form-group">
            <div class=" col-sm-12 comment-form-url">' .
				            '<input  class="form-control" placeholder="' . __( 'Website', 'industrix' ) . '"  id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"  />
            </div></div>',

			);

			$required_text = sprintf( ' ' . __( 'Required fields are marked %s', 'industrix' ), '<span class="required">*</span>' );
			$defaults      = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field'        => '
                <div class="form-group comment-form-comment">
                    <div class="col-sm-12">
                        <textarea class="form-control" id="comment" name="comment" placeholder="' . _x( 'Comment', 'noun', 'industrix' ) . '" rows="8" aria-required="true"></textarea>
                    </div>
                </div>
                ',
				'must_log_in'          => '
                <div class="alert alert-danger must-log-in">'
				                          . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'industrix' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) )
				                          . '</div>',
				'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'industrix' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</div>',
				'comment_notes_before' => '<div class="alert alert-info comment-notes">' . __( 'Your email address will not be published.', 'industrix' ) . ( $req ? $required_text : '' ) . '</div>',
				'comment_notes_after'  => '<div class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'industrix' ), ' <code>' . allowed_tags() . '</code>' ) . '</div>',
				'id_form'              => 'commentform',
				'id_submit'            => 'submit',
				'title_reply'          => __( 'Leave a Reply', 'industrix' ),
				'title_reply_to'       => __( 'Leave a Reply to %s', 'industrix' ),
				'cancel_reply_link'    => __( 'Cancel reply', 'industrix' ),
				'label_submit'         => __( 'Submit Comment', 'industrix' ),
				'format'               => 'xhtml',
			);

			$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

			if ( comments_open( $post_id ) ) {
				?>
				<?php do_action( 'comment_form_before' ); ?>
				<div id="respond" class="comment-respond">
					<h2 id="reply-title" class="comment-reply-title">
						<?php comment_form_title( $args[ 'title_reply' ], $args[ 'title_reply_to' ] ); ?>
						<small><?php cancel_comment_reply_link( $args[ 'cancel_reply_link' ] ); ?></small>
					</h2>

					<?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) { ?>
						<?php echo $args[ 'must_log_in' ]; ?>
						<?php do_action( 'comment_form_must_log_in_after' ); ?>
					<?php } else { ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post"
						      id="<?php echo esc_attr( $args[ 'id_form' ] ); ?>"
						      class="form-horizontal comment-form"<?php echo $html5 ? ' novalidate' : ''; ?>
						      role="form">
							<?php do_action( 'comment_form_top' ); ?>
							<?php if ( is_user_logged_in() ) { ?>
								<?php echo apply_filters( 'comment_form_logged_in', $args[ 'logged_in_as' ], $commenter, $user_identity ); ?>
								<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
							<?php } else { ?>
								<?php echo $args[ 'comment_notes_before' ]; ?>
								<?php
								do_action( 'comment_form_before_fields' );
								foreach ( (array) $args[ 'fields' ] as $name => $field ) {
									echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
								}
								do_action( 'comment_form_after_fields' );
							}

								echo apply_filters( 'comment_form_field_comment', $args[ 'comment_field' ] );

								echo $args[ 'comment_notes_after' ]; ?>

							<div class="form-submit">
								<input class="btn btn-danger btn-lg" name="submit" type="submit"
								       id="<?php echo esc_attr( $args[ 'id_submit' ] ); ?>"
								       value="<?php echo esc_attr( $args[ 'label_submit' ] ); ?>"/>
								<?php comment_id_fields( $post_id ); ?>
							</div>
							<?php do_action( 'comment_form', $post_id ); ?>
						</form>
					<?php } ?>
				</div><!-- #respond -->
				<?php do_action( 'comment_form_after' ); ?>
			<?php } else { ?>
				<?php do_action( 'comment_form_comments_closed' ); ?>
			<?php } ?>
			<?php
		}
	}

	//----------------------------------------------------------------------
	// Comments list
	//----------------------------------------------------------------------

	if ( ! function_exists( "industrix_comments_list" ) ) {
		function industrix_comments_list( $comment, $args, $depth ) {

			$GLOBALS[ 'comment' ] = $comment;
			switch ( $comment->comment_type ) {

				// Display trackbacks differently than normal comments.
				case 'pingback' :
				case 'trackback' :
					?>

					<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
					<p><?php _e( 'Pingback:', 'industrix' ); ?><?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'industrix' ), '<span class="edit-link">', '</span>' ); ?></p>

					<?php
					break;

				default :
					// Proceed with normal comments.
					global $post;
					?>
				<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div id="comment-<?php comment_ID(); ?>" class="comment media">
						<div class="pull-left comment-author vcard">
							<?php
								$get_avatar = get_avatar( $comment, apply_filters( 'hippo_post_comment_avatar_size', 48 ) );
								$avatar_img = industrix_get_avatar_url( $get_avatar );
								//Comment author avatar
							?>
							<img class="avatar" src="<?php echo $avatar_img ?>" alt="">
						</div>

						<div class="media-body">

							<div class="comment-wrapper">

								<div class="comment-meta media-heading">
                                    <span class="author-name">
                                        <?php _e( 'By', 'industrix' ); ?>
	                                    <strong><?php echo get_comment_author(); ?></strong>
                                    </span>
									-
									<time datetime="<?php echo get_comment_date(); ?>">
										<?php echo get_comment_date(); ?><?php echo get_comment_time(); ?>
										<?php edit_comment_link( __( 'Edit', 'industrix' ), '<small class="edit-link">', '</small>' ); //edit link
										?>
									</time>

                                    <span class="reply pull-right">
                                        <?php comment_reply_link( array_merge( $args, array(
	                                        'reply_text' => sprintf( __( '%s Reply', 'industrix' ), '' ),
	                                        'depth'      => $depth,
	                                        'max_depth'  => $args[ 'max_depth' ]
                                        ) ) ); ?>
                                    </span><!-- .reply -->
								</div>

								<?php if ( '0' == $comment->comment_approved ) { //Comment moderation ?>
									<div
										class="alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'industrix' ); ?></div>
								<?php } ?>

								<div class="comment-content comment">
									<?php comment_text(); //Comment text
									?>
								</div>
								<!-- .comment-content -->

							</div>
							<!-- .well -->


						</div>
					</div>
					<!-- #comment-## -->
					<?php
					break;
			} // end comment_type check

		}
	}

	//----------------------------------------------------------------------
	// Search form
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_blog_search_form' ) ) {

		function industrix_blog_search_form( $form ) {
			$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '">
            <input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="Search"/>
            <input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search', 'industrix' ) . '" />
            <input type="hidden" value="post" name="post_type" id="post_type" />
        </form>';

			return $form;
		}

		add_filter( 'get_search_form', 'industrix_blog_search_form' );
	}

	//----------------------------------------------------------------------
	// Fetching Avatar URL
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_get_avatar_url' ) ) {

		function industrix_get_avatar_url( $get_avatar ) {
			preg_match( "/src='(.*?)'/i", $get_avatar, $matches );

			return $matches[ 1 ];
		}
	}

	//----------------------------------------------------------------------
	// Excerpt support in page
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_custom_excerpt_page' ) ) :

		function industrix_custom_excerpt_page() {
			add_post_type_support( 'page', 'excerpt' );
			add_post_type_support( 'portfolio', 'excerpt' );
		}

		//add_action( 'init', 'industrix_custom_excerpt_page' );
	endif;

	//----------------------------------------------------------------------
	// Previous Item Featured Image
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_get_previous_featured_image' ) ) :

		function industrix_get_previous_featured_image( $size = 'thumbnail' ) {
			$post = get_previous_post();

			if ( ! empty( $post ) ) {
				$id = $post->ID;
				if ( has_post_thumbnail() ) {
					return get_the_post_thumbnail( $id, $size );
				}
			}
		}
	endif;

	//----------------------------------------------------------------------
	// Next Item Featured Image
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_get_next_featured_image' ) ) :
		function industrix_get_next_featured_image( $size = 'thumbnail' ) {
			$post = get_next_post();
			if ( ! empty( $post ) ) {
				$id = $post->ID;
				if ( has_post_thumbnail() ) {
					return get_the_post_thumbnail( $id, $size );
				}
			}
		}
	endif;


	//----------------------------------------------------------------------
	// Get Default Custom Logo
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_get_default_logo' ) ) :

		function industrix_get_default_logo( $html = '' ) {

			if ( empty( $html ) ) :

				$html = sprintf( '<a href="%1$s" class="custom-logo-link" rel="home" itemprop="url">%2$s</a>',
				                 esc_url( home_url( '/' ) ),
				                 '<img class="custom-logo"
							src="' . esc_url( get_template_directory_uri() . '/img/logo.png' ) . '"
							alt="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>'
				);

			endif;

			return $html;

		}

		add_filter( 'get_custom_logo', 'industrix_get_default_logo' );
	endif;

	//----------------------------------------------------------------------
	// Custom Logo Option
	//----------------------------------------------------------------------

	if ( ! function_exists( 'industrix_custom_logo' ) ) :

		function industrix_custom_logo() {
			if ( function_exists( 'the_custom_logo' ) ) :
				the_custom_logo();
			else:
				echo industrix_get_default_logo();
			endif;
		}
	endif;