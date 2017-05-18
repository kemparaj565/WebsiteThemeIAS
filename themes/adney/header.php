<?php
/**
 * The header for the theme.
 *
 * @package adney
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site animsition">

	<!-- HEADER  -->
	<header id="masthead" class="site-header main-header" role="banner">
		<div class="container">
			<div class="logo">
				<?php
				$adney_logo_id = get_theme_mod( 'custom_logo' );
				$adney_logo = wp_get_attachment_image_src( $adney_logo_id , 'full' );
				if( !empty( $adney_logo ) && "" != $adney_logo[0] ){
					?>
					<div class='site-logo'>
						<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name') ); ?>' rel='home'>
							<img src='<?php echo esc_url( $adney_logo[0] ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>'>
						</a>
					</div>
				<?php }else{?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description"><?php echo $description; ?></p>
						<?php
					endif; ?>
				<?php } ?>

			</div><!-- .site-branding -->

			<div class="menu">
				<!-- desktop navbar -->
				<nav id="site-navigation" class="main-navigation desktop-nav" role="navigation">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu','container'=>'ul', 'menu_class'=>'first-level','depth'=>'2' ) );
					} ?>
				</nav>
				<!-- mobile navbar -->
				<nav class="mobile-nav"></nav>
				<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<div class="menu-icon">
						<div class="line"></div>
						<div class="line"></div>
						<div class="line"></div>
					</div>
				<?php } ?>
			</div>
		</div>
	</header><!-- #masthead -->

	<?php
		$url = '';
		if(is_home() && is_front_page()) {
			if( get_header_image() ){
				$url = get_header_image();
			}
		}elseif(is_page()){
			if ( has_post_thumbnail() ) {
				$url = wp_get_attachment_url( get_post_thumbnail_id() );
			}else{
				if( get_header_image() ){
					$url = get_header_image();
				}
			}
		}else{
			if( get_header_image() ){
				$url = get_header_image();
			}
		}
	?>
	<!-- HERO SECTION  -->
	<?php
	if( is_front_page()){

		// WP_Query arguments
		$args = array (
				'post_type'              => array( 'xylus-slider' ),
				'post_status'            => array( 'publish' ),
				'posts_per_page'		 => -1,
				'orderby'				 => array( 'post_date' => 'ASC')
		);
		// The Query
		$query = new WP_Query( $args );
		// The Loop
		if ( $query->have_posts() ) {
			?>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- all Sliders -->
				<div class="carousel-inner" role="listbox">
					<?php
					$i = 0;
					while ( $query->have_posts() ) {
						$query->the_post();
						$sbutton_text = (get_post_meta(get_the_ID(),'slider_button_text',true))?sanitize_text_field(get_post_meta(get_the_ID(),'slider_button_text',true)):'';
						$sbutton_link = (get_post_meta(get_the_ID(),'slider_button_link',true))?esc_url(get_post_meta(get_the_ID(),'slider_button_link',true)):'#';
						?>
						<!-- single member -->
						<div class="item <?php if($i==0){echo "active";} ?>">
							<?php
							if(has_post_thumbnail()){
								the_post_thumbnail();
							}else{
								echo '<img class="slide" src="'.get_template_directory_uri().'/assets/img/no-image.png" alt="'. esc_attr( get_the_title() ).'">';
							}
							?>
							<div class="fill_overlay">
								<div class="container">
									<div class="carousel-caption">
										<h1 class="main-title"><?php the_title();?></h1>
										<div class="sub_title"><?php the_content();?></div>
										<p><a class="btn green" href="<?php echo $sbutton_link;?>" role="button"><?php echo $sbutton_text;?></a></p>
									</div>
								</div>
							</div>
						</div>

					<?php
						$i++;
						}

						echo '<ol class="carousel-indicators">';
						for($j=0; $j<$i; $j++){
							echo '<li data-target="#myCarousel" data-slide-to="'.$j.'"'; if($j==0){ echo 'class="active"';} echo '></li>';
						}
						echo '</ol>';
					?>
				</div>
			</div>

			<?php
		} else { ?>
			<div class="site-hero_2" style="background: url('<?php echo $url; ?>') no-repeat;background-size: cover;">
				<div class="header_back">
					<div class="page-title">
						<div class="big-title montserrat-text uppercase">
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<?php bloginfo('name'); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	<?php
		if(!adney_check_plugin_active() || 'posts' == get_option('show_on_front')){
		?>
		<section>
			<div class="container">
			<?php
			}
	}else{ ?>
		<div class="site-hero_2" style="background: url('<?php echo $url; ?>') no-repeat;background-size: cover;">
			<div class="header_back">
				<div class="page-title">
				<?php
				if(is_page()){
					?>
					<div class="big-title montserrat-text uppercase">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</div>
					<?php
				}elseif( is_single()){ ?>
					<div class="big-title montserrat-text uppercase">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</div>
				<?php }elseif(is_home() && !is_front_page()){
					?>
					<div class="big-title montserrat-text uppercase">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php _e( 'Blog', 'adney' ); ?>
						</a>
					</div>
				<?php }elseif(is_front_page()){
					?>
					<div class="big-title montserrat-text uppercase">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					</div>
				<?php }elseif(is_404()){
					?>
					<div class="big-title montserrat-text uppercase">
						<h1>
							<a><?php _e( 'Oops!', 'adney' );?></a><br>
							<?php _e( 'Page Not Found', 'adney' );?>
						</h1>
					</div>
					<?php
				}elseif(is_archive()){
					?>
					<div class="big-title montserrat-text uppercase">
						<?php
						if(is_author()):
							printf( __( 'All posts by %s', 'adney' ), get_the_author() );

						elseif(is_category()):
							printf( __( 'Category Archives: %s', 'adney' ), single_cat_title( '', false ) );

						elseif(is_tag()):
							printf( __( 'Tag Archives: %s', 'adney' ), single_tag_title( '', false ) );

						elseif( is_day() ) :
							printf( __( 'Daily Archives: %s', 'adney' ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'adney' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'adney' ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'adney' ), get_the_date( _x( 'Y', 'yearly archives date format', 'adney' ) ) );
						else :
							_e( 'Archives', 'adney' );

						endif;
						the_archive_description( '<div class="small-title montserrat-text uppercase">', '</div>' );
						?>
					</div>
					<?php

				}elseif( is_search()){ ?>
					<div class="big-title montserrat-text uppercase">
						<?php printf( esc_html__( 'Search Results for: %s', 'adney' ), '<span>' . get_search_query() . '</span>' ); ?>
					</div>
					<?php
				}else{ ?>
					<div class="big-title montserrat-text uppercase">
						<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					</div>
				<?php
				}
				?>
			</div>
			</div>
		</div>

	<section>
		<div class="container">
	<?php } ?>
