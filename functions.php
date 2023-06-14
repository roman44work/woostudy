<?php
function woostudy_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'woostudy_add_woocommerce_support' );

require_once get_template_directory() . '/inc/woocommerce-hooks.php';