<?php
function woostudy_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'woostudy_add_woocommerce_support' );

require_once get_template_directory() . '/inc/woocommerce-hooks.php';

add_action('wp_enqueue_scripts', 'woostudy_scripts');
function woostudy_scripts (){
    wp_enqueue_style('woostudy-google-fonts', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
    wp_enqueue_style('woostudy-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css');
    wp_enqueue_style('woostudy-animate', get_template_directory_uri() .'/assets/lib/animate/animate.min.css');
    wp_enqueue_style('woostudy-owlcarousel-css', get_template_directory_uri() .'/assets/lib/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('woostudy-main-css', get_template_directory_uri() .'/assets/css/style.css');
    wp_enqueue_style('woostudy-custom-css', get_template_directory_uri() .'/assets/css/custom.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('woostudy-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', [], false, true);
    wp_enqueue_script('woostudy-easing', get_template_directory_uri() .'/assets/lib/easing/easing.min.js', [], false, true);
    wp_enqueue_script('woostudy-owlcarousel-js', get_template_directory_uri() .'/assets/lib/owlcarousel/owl.carousel.min.js', [], false, true);
    wp_enqueue_script('woostudy-main-js', get_template_directory_uri() .'/assets/js/main.js', [], false, true);


}
