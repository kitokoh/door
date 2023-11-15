<?php

add_action('woocommerce_product_options_pricing', 'wd_woo_custom_price_field');
/**
 * Add weekly, monthly and with operator prices field
 **/
function wd_woo_custom_price_field()
{

    $day_field = array(
        'id' => '_weekly_price',
        'label' => esc_html__('Weekly Price ' . get_woocommerce_currency_symbol(), 'doors'),
        'data_type' => 'price' //Let WooCommerce formats our field as price field
    );
    $month_field = array(
        'id' => '_monthly_price',
        'label' => esc_html__('Monthly Price ' . get_woocommerce_currency_symbol(), 'doors'),
        'data_type' => 'price' //Let WooCommerce formats our field as price field
    );

    $withoperator_field = array(
        'id' => '_with_operator_price',
        'label' => esc_html__('With Operator Price ' . get_woocommerce_currency_symbol(), 'doors'),
        'data_type' => 'price' //Let WooCommerce formats our field as price field
    );

    woocommerce_wp_text_input($day_field);
    woocommerce_wp_text_input($month_field);
    woocommerce_wp_text_input($withoperator_field);
}


// Save custom prices fields
add_action('woocommerce_process_product_meta', 'wd_woo_product_custom_fields_save');

function wd_woo_product_custom_fields_save($post_id)
{

    // Custom Product Number Field
    $_daily_price = $_POST['_weekly_price'];
    if (!empty($_daily_price))
        update_post_meta($post_id, '_weekly_price', esc_attr($_daily_price));


    $_monthly_price = $_POST['_monthly_price'];
    if (!empty($_monthly_price))
        update_post_meta($post_id, '_monthly_price', esc_attr($_monthly_price));

    $_monthly_price = $_POST['_with_operator_price'];
    if (!empty($_monthly_price))
        update_post_meta($post_id, '_with_operator_price', esc_attr($_monthly_price));

}


if (function_exists('is_woocommerce')) {


    if (!function_exists('woocommerce_template_loop_product_link_open')) {
        /**
         * Insert the opening anchor tag for products in the loop.
         */
        function woocommerce_template_loop_product_link_open()
        {
            global $product;

            $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);
        }
    }


    if (!function_exists('woocommerce_template_loop_product_link_close')) {
        /**
         * Insert the opening anchor tag for products in the loop.
         */
        function woocommerce_template_loop_product_link_close()
        {

        }
    }


    if (!function_exists('woocommerce_get_product_thumbnail')) {

        /**
         * Get the product thumbnail, or the placeholder if not set.
         *
         * @param string $size (default: 'woocommerce_thumbnail').
         * @param int $deprecated1 Deprecated since WooCommerce 2.0 (default: 0).
         * @param int $deprecated2 Deprecated since WooCommerce 2.0 (default: 0).
         * @return string
         */
        function woocommerce_get_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0)
        {
            global $product;

            $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

            $output = "<div class='product-image-wrapper'>";
            if ($product) {
                $output .= '<a href="' . get_the_permalink() . '">' . $product->get_image($image_size) . '</a>';
            }
            $output .= "</div>";

            return $output;
        }
    }


    if (!function_exists('woocommerce_template_loop_product_title')) {

        /**
         * Show the product title in the product loop. By default this is an H2.
         */
        function woocommerce_template_loop_product_title()
        {
            echo '<div class="product-details-wrapper">
              <h2 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">
                <a href="' . get_the_permalink() . '">' . get_the_title() . ' </a>
              </h2>';
        }
    }

    if (!function_exists('woocommerce_template_loop_add_to_cart')) {

        /**
         * Get the add to cart template for the loop.
         *
         * @param array $args Arguments.
         */
        function woocommerce_template_loop_add_to_cart($args = array())
        {
            global $product;

            if ($product) {
                $defaults = array(
                    'quantity' => 1,
                    'class' => implode(
                        ' ',
                        array_filter(
                            array(
                                'button',
                                'product_type_' . $product->get_type(),
                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                            )
                        )
                    ),
                    'attributes' => array(
                        'data-product_id' => $product->get_id(),
                        'data-product_sku' => $product->get_sku(),
                        'aria-label' => $product->add_to_cart_description(),
                        'rel' => 'nofollow',
                    ),
                );

                $args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

                if (isset($args['attributes']['aria-label'])) {
                    $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
                }

                wc_get_template('loop/add-to-cart.php', $args);

                echo "</div>";
            }
        }
    }


    /**
     * Change number of related products output
     */

    add_filter('woocommerce_output_related_products_args', 'doors__related_products_args', 20);

    function doors__related_products_args($args) {
        $args['posts_per_page'] = 4; // 4 related products
        $args['columns'] = 4; // arranged in 4 columns
        return $args;
    }


    /**
     * Sets up the content width value based on the theme's design and stylesheet.
     */
    if (!isset($content_width)) {
        $content_width = 625;
    }

    /*---------wooocomerce---------*/
    //Reposition WooCommerce breadcrumb
    function doors_woocommerce_remove_breadcrumb() {
        remove_action(
            'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }

    add_action(
        'woocommerce_before_main_content', 'doors_woocommerce_remove_breadcrumb'
    );

    function doors_woocommerce_custom_breadcrumb()
    {
        woocommerce_breadcrumb();
    }

    add_action('woo_custom_breadcrumb', 'doors_woocommerce_custom_breadcrumb');


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
    add_filter('woocommerce_add_to_cart_fragments', 'doors_woocommerce_header_add_to_cart_fragment');

    function doors_woocommerce_header_add_to_cart_fragment($fragments)
    {
        ob_start();
        ?>
        <a class="cart-contents" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"
           title="<?php echo esc_attr__('View your shopping cart', 'doors'); ?>"><?php echo sprintf(esc_html__('%d item', 'doors', WC()->cart->cart_contents_count), WC()->cart->cart_contents_count); ?>
            - <?php echo WC()->cart->get_cart_total(); ?></a>
        <?php

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }


    /**
     * --------------- Number of Products to dispaly per page (9) -----------
     */
    add_filter('loop_shop_per_page', 'doors_loop_shop_per_page', 20);

    function doors_loop_shop_per_page($cols) {
        // $cols contains the current number of product
        $cols = doors_get_option('products_per_page', 12);
        return $cols;
    }


// Enable Woocommerce LightBox

    add_action('after_setup_theme', 'doors_woocommcere_setup');
    function doors_woocommcere_setup()
    {
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
    }

    /*
   * Remove 'Product Description' heading
   */
    add_filter('woocommerce_product_description_heading', '__return_null');

}

