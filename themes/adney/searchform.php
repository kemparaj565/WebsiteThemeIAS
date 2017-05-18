<?php
/**
 * The template for displaying search Form.
 *
 * @package adney
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="input_2">
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder','adney' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label','adney' ) ?>" />
		<button type="submit"><i class="icon ion-search"></i></button>
	</div>
</form>
