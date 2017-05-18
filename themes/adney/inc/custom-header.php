<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package adney
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses adney_header_style()
 */
function adney_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'adney_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/img/site-hero2.jpg',
		'default-text-color'     => 'ffffff',
		'width'                  => 1920,
		'height'                 => 600,
		'flex-height'            => true,
		'wp-head-callback'       => 'adney_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'adney_custom_header_setup' );

if ( ! function_exists( 'adney_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see adney_custom_header_setup().
 */
function adney_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		#masthead,
		.site-title a,
		.site-description,
		.site-hero_2 .page-title a,
		.menu #site-navigation a
		{
			color: #<?php echo esc_attr( $header_text_color ); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
