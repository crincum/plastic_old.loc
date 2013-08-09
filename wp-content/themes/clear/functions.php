<?php if ( function_exists('register_sidebar') ) {
    register_sidebar();
    register_sidebar();
}
add_filter( 'show_admin_bar', '__return_false' );
?>