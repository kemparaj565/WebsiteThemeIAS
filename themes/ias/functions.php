<?php 

function loadStyles(){

wp_enqueue_style('style',get_stylesheet_uri());

}
add_action('wp_enqueue_scripts','loadStyles');


//register nav menu

register_nav_menus(array(
'primary' => __('Primary Menu'),
'footer' => __('Footer Menu'),
));

?>