<?php
/**
 * Template part for displaying Clients
 *
 * @package adney
 */

// WP_Query arguments
$args = array (
		'post_type'              => array( 'xylus-client' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'		 => -1,
		'orderby'				 => array( 'post_date' => 'ASC')
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	?>

	<div class="row">
		<!-- all testimonials -->
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			$client_link = (get_post_meta(get_the_ID(),'client_link',true))?esc_url(get_post_meta(get_the_ID(),'client_link',true)):'#';
			?>
			<!-- single client -->
			<div class="col-md-4 col-sm-6 col-xs-12 wow fadeInUp" data-wow-delay=".1s">
				<div class="clients_single">
					<a href="<?php echo $client_link; ?>">
						<?php
						if(has_post_thumbnail()){
							the_post_thumbnail();
						}else{
							echo '<img src="'.get_template_directory_uri().'/assets/img/no-image.png" alt="'.esc_attr( get_the_title() ).'">';
						}
						?>
					</a>
				</div>
			</div>
			<!-- end single client -->
			<?php
		}
		?>
	</div>
	<?php
} else {
	// no posts found
}
// Restore original Post Data
wp_reset_postdata();
?>
