<?php
/**
 * Template part for displaying portfolio items.
 *
 * @package adney
 */

	// WP_Query arguments
	$args = array (
			'post_type'              => array( 'xylus-portfolio' ),
			'post_status'            => array( 'publish' ),
			'posts_per_page'		 => -1
	);

	// The Query
	$query = new WP_Query( $args );

	// The Loop
	if ( $query->have_posts() ) {
		?>
		<section class="portfolio">
			<div class="container">
				<div class="row">
					<!-- categories  -->
					<div class="col-md-3">
						<div class="row categories-grid wow fadeInLeft">
							<span class="montserrat-text uppercase">choose category</span>

							<nav class="categories">
								<ul class="portfolio_filter">
									<li><a href="#" class="active" data-filter="*">all</a></li>
									<?php
									$terms = get_terms( 'portfolio_category');
									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
										foreach ( $terms as $term ) {
											echo '<li><a href="#" data-filter=".'.$term->slug.'">' . $term->name . '</a></li>';
										}
									}
									?>
								</ul>
							</nav>
						</div>
					</div>

					<!-- all works -->
					<div class="col-md-9">
						<div class="row portfolio_container">
							<?php
							while ( $query->have_posts() ) {
								$query->the_post();
								$port_terms = get_the_terms( get_the_ID(), 'portfolio_category' );
								$portfolio_terms = '';
								if(!empty($port_terms)){
									foreach ( $port_terms as $port_term ) {
										$portfolio_terms .= ' '.$port_term->slug;
									}
								}
								?>
								<!-- single work -->
								<div class="col-md-4 <?php echo $portfolio_terms?>">
									<a href="<?php the_permalink(); ?>" class="portfolio_item work-grid wow fadeInUp">
										<?php
										if(has_post_thumbnail()){
											the_post_thumbnail();
										}else{
											echo '<img src="'.get_template_directory_uri().'/assets/img/no-image.png" alt="'.esc_attr( get_the_title() ).'">';
										}
										?>
										<div class="portfolio_item_hover">
											<div class="item_info">
												<span><?php the_title(); ?></span>
												<em><?php if(!empty($port_terms)){ echo $port_terms[0]->slug; } ?></em>
											</div>
										</div>
									</a>
								</div>
								<!-- end single work -->
								<?php
							}
							?>
						</div>
						<!-- end row -->
					</div>
					<!-- all works end -->
				</div>
			</div>
			<!-- end container -->
		</section>
		<!-- portfolio -->
		<?php
	} else {
		// no posts found
	}

	// Restore original Post Data
	wp_reset_postdata();
?>