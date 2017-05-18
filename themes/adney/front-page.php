<?php
if('posts' == get_option('show_on_front')){
    get_template_part( 'index' );
}else{
    if(adney_check_plugin_active()){
        get_template_part('home','template');
    }else{
        get_template_part( 'page' );
    }
}
?>
