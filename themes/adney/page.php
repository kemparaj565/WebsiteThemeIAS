<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package adney
 */

get_header();

$content_class = 'col-md-12 col-sm-12';
$layout = esc_attr( get_theme_mod( 'adney_page_layout', 'full' ) );
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
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
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
