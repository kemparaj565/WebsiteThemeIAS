<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
				if ( have_posts() ) :

					/* Start the Loop */
					while ( have_posts() ) : the_post();

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
