<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package adney
 */


get_header();
$content_class = 'col-md-12 col-sm-12';
$layout = esc_attr( get_theme_mod( 'adney_blog_layout', 'right_sidebar' ) );
if($layout == 'left_sidebar' || $layout == 'right_sidebar'){
	$content_class = 'col-md-9 col-sm-9';
}
?>
	<div class="row">
		<?php
		if($layout == 'left_sidebar'){ ?>
			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>
		<?php }
		?>
		<div class="<?php echo $content_class; ?>">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<?php
					if ( have_posts() ) : ?>

						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

						?>
						<div class="posts-pagination">
							<?php the_posts_pagination(); ?>
						</div>
						<?php

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->

		</div>
		<?php
		if($layout == 'right_sidebar'){ ?>
			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>
		<?php }
		?>
	</div>

<?php
get_footer();