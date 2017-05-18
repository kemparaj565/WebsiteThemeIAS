<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package adney
 */

?>
<div class="blog_post">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="post_media">
		<?php
		if(has_post_thumbnail()){
			the_post_thumbnail();
		}
		?>
	</div>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				// added in header.php
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<?php
		if ( 'post' === get_post_type() ) : ?>
		<div class="post_info">
			<?php adney_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_single() ) {
			the_content( sprintf(
			/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'adney' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'adney' ),
					'after'  => '</div>',
			) );
		} else {
			the_excerpt();
			?>
			<a href="<?php echo esc_url( get_the_permalink() );?>" class="link montserrat-text uppercase"><?php _e('continue reading','adney'); ?> <i class="icon ion-arrow-right-c"></i></a>
		<?php
		}

		?>
	</div><!-- .entry-content -->

	<?php
	if ( is_single() ) { ?>
		<footer class="entry-footer">
			<?php adney_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php } ?>

</article><!-- #post-## -->
</div>
