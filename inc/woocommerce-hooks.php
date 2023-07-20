<?php

//remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
//remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
//
//add_action('woocommerce_before_main_content', function (){
//    echo "<div class='container test'>";
//});
//
//add_action('woocommerce_after_main_content', function (){
//    echo "</div>";
//});

//Отключение стилей woocommerce
add_filter ('woocommerce_enqueue_styles', '__return_empty_array');

//Список категорий товаров
remove_action ('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
add_action ('woocommerce_shop_loop_subcategory_title', function ($category) {
    echo "<h6>". esc_html ($category -> name). "</h6>";
    echo '<small class="text-body">'.$category -> count. __(' Products', 'woostudy').'</small>';
});


//Ссылка на товар в карточке товара
remove_action ('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action ('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
