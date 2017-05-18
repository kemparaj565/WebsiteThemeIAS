<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package adney
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function adney_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'adney_body_classes' );


if( ! function_exists("adney_comments_list") ){

	/**
	 * Comments link
	 *
	 */
	function adney_comments_list($comment, $args, $depth) {

		switch ( $comment->comment_type ) {
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'adney' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'adney' ), '<span class="edit-link">', '</span>' ); ?></p>
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
						$get_avatar = get_avatar( $comment, 48 );
						$avatar_img = adney_get_avatar_url($get_avatar);
						//Comment author avatar
						?>
						<img class="avatar img-circle" src="<?php echo esc_url($avatar_img); ?>" alt="">
					</div>

					<div class="media-body">

						<div class="well">

							<div class="comment-meta media-heading">
                                <span class="author-name">
                                    <?php _e('By', 'adney'); ?> <strong><?php echo esc_attr( get_comment_author() ); ?></strong>
                                </span>
								-
								<time datetime="<?php echo get_comment_date(); ?>">
									<?php echo get_comment_date(); ?> <?php echo get_comment_time(); ?>
									<?php edit_comment_link( __( 'Edit', 'adney' ), '<small class="edit-link">', '</small>' ); //edit link ?>
								</time>

                                <span class="reply pull-right">
                                    <?php comment_reply_link( array_merge( $args, array( 'reply_text' =>  sprintf( __( '%s Reply', 'adney' ), '<i class="icon-repeat"></i> ' ) , 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                                </span><!-- .reply -->
							</div>

							<?php if ( '0' == $comment->comment_approved ) {  //Comment moderation ?>
								<div class="alert alert-info"><?php _e( 'Your comment is awaiting moderation.', 'adney' ); ?></div>
							<?php } ?>

							<div class="comment-content comment">
								<?php comment_text(); //Comment text ?>
							</div><!-- .comment-content -->

						</div><!-- .well -->


					</div>
				</div><!-- #comment-## -->
				<?php
				break;
		} // end comment_type check

	}

}

if( ! function_exists('adney_get_avatar_url') ){
	/**
	 * Get avatar url
	 */
	function adney_get_avatar_url($get_avatar){
		preg_match("/src='(.*?)'/i", $get_avatar, $matches);
		return $matches[1];
	}
}

if( ! function_exists('adney_get_post_navigation') ){
function adney_get_post_navigation(){
	$navigation = '';
	$previous   = get_previous_post_link( '<i class="icon ion-arrow-left-c prev"></i> %link ', '<span>%title</span>', true );
	$next       = get_next_post_link( '%link <i class="icon ion-arrow-right-c next"></i>', '<span>%title</span>', true );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		if($previous && !$next){
			$navigation = _navigation_markup( $previous , 'post-navigation' );
		}elseif(!$previous && $next){
			$navigation = _navigation_markup( $next, 'post-navigation' );
		}else{
			$navigation = _navigation_markup( $previous .'<span class="divisor">/</span>'. $next, 'post-navigation' );
		}

	}

	echo $navigation;
}
}


function adney_check_plugin_active(){
	if( class_exists( 'Xylus_Toolkit' ) ){
		return true;
	}else{
		return false;
	}
}

/**
 * Filter the theme page templates.
 *
 * @param array    $page_templates Page templates.
 * @param WP_Theme $this           WP_Theme instance.
 * @param WP_Post  $post           The post being edited, provided for context, or null.
 * @return array (Maybe) modified page templates array.
 */
function adney_filter_theme_page_templates( $page_templates, $this, $post ) {
    
    if ( !adney_check_plugin_active() ) {
        if ( isset( $page_templates['template-portfolio.php'] ) ) {
            unset( $page_templates['template-portfolio.php'] );
        }
    }
    return $page_templates;
}
add_filter( 'theme_page_templates', 'adney_filter_theme_page_templates', 20, 3 );