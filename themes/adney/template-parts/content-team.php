<?php
/**
 * Template part for displaying Team Members
 *
 * @package adney
 */

// WP_Query arguments
$args = array (
		'post_type'              => array( 'xylus-team' ),
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
		<!-- all Team Members -->
		<?php
		while ( $query->have_posts() ) {
			$query->the_post();
			$team_position = (get_post_meta(get_the_ID(),'team_position',true))?sanitize_text_field(get_post_meta(get_the_ID(),'team_position',true)):'';
			?>
			<!-- single member -->
			<div class="col-md-3 col-sm-6 col-xs-12">
				<div class="team_member wow fadeInUp">
					<?php
					if(has_post_thumbnail()){
						the_post_thumbnail();
					}else{
						echo '<img src="'.get_template_directory_uri().'/assets/img/no-user.png" alt="'. esc_attr( get_the_title() ) .'">';
					}
					?>
					<div class="team_member_hover">
						<div class="team_member_info">
							<div class="team_member_name"><?php the_title(); ?></div>
							<div class="team_member_job"><?php echo $team_position; ?></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end single member -->
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