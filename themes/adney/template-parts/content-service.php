<?php
/**
 * Template part for displaying Services
 *
 * @package adney
 */

// WP_Query arguments
$args = array (
		'post_type'              => array( 'xylus-service' ),
		'post_status'            => array( 'publish' ),
		'posts_per_page'		 => -1,
		'orderby'				 => array( 'post_date' => 'ASC')
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	?>
	<section id="services">
		<div class="container">
			<?php
			$service_title = esc_attr( get_theme_mod( 'service_title' , '' ) );
			$service_desc  = wp_kses_post( get_theme_mod( 'service_desc' , '' ) );			
			if($service_title != ''  || $service_desc != ''  ){ ?>
				<div class="row">
					<div class="section-title">
						<?php if($service_title != ''){
							echo '<span>'.$service_title.'</span>';
						}
						?>
						<p><?php echo $service_desc; ?></p>
					</div>
				</div>
			<?php } ?>
			<div class="row text-center">
				<!-- all Services -->
				<?php
				$i = 1;
				while ( $query->have_posts() ) {
					$query->the_post();
					$team_position = (get_post_meta(get_the_ID(),'team_position',true))?sanitize_text_field(get_post_meta(get_the_ID(),'team_position',true)):'';
					?>
					<!-- single member -->
					<div class="col-md-3">
						<div class="service_img">
							<?php
							if(has_post_thumbnail()){
								the_post_thumbnail();
							}else{
								echo '<img src="'.get_template_directory_uri().'/assets/img/no-image.png" alt="' . esc_attr( get_the_title() ) . '">';
							}
							?>
						</div>
						<h4 class="service-heading">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h4>
						<p class="text-muted">
							<?php the_content(); ?>
						</p>
					</div>
					<!-- end single member -->
					<?php
					if($i%4 == 0 && $i >0){
						echo '<div style="clear: both;"></div>';
					}
					$i++;
				}
				?>
			</div>
		</div>
	</section>
	<?php
} else {
	// no posts found
}
// Restore original Post Data
wp_reset_postdata();
?>