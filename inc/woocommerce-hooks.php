

<?php

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action('woocommerce_before_main_content', function (){
    echo "<div class='container test'>";
});

add_action('woocommerce_after_main_content', function (){
    echo "</div>";
});