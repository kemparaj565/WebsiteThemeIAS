<?php
/**
 * Template part for displaying Testimonials
 *
 * @package adney
 */

// WP_Query arguments
$args = array (
		'post_type'              => array( 'xylus-testimonial' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'		 => -1
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	?>

<div class="testimonials wow fadeInUp">
	<ul class="slides">
		<!-- all testimonials -->
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			$author_name = get_post_meta(get_the_ID(),'author_name',true);
			?>
			<!-- single testimonial -->
			<li class="testimonials_single">
				<div class="author_pic">
					<?php
					if(has_post_thumbnail()){
						the_post_thumbnail();
					}else{
						echo '<img src="'.get_template_directory_uri().'/assets/img/no-user.png" alt="' . esc_attr( get_the_title() ) . '">';
					}
					?>
				</div>
				<p><?php the_content(); ?></p>
				<?php
				if($author_name!=''){
					echo '<div class="author_name">'.$author_name.'</div>';
				}
				?>
			</li>
			<!-- end single testimonial -->
			<?php
		}
		?>
	</ul>
</div>
	<?php
} else {
	// no posts found
}
// Restore original Post Data
wp_reset_postdata();
?>
