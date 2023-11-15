<?php
/**
 * Functions used by plugins
 */


add_filter('woocommerce_valid_order_statuses_for_payment_complete', 'rfqtk_statuses_for_payment', 100, 2);
add_filter('woocommerce_valid_order_statuses_for_payment', 'rfqtk_statuses_for_payment', 100, 2);
//apply_filters( 'woocommerce_data_get_stock_quantity', $value, 'WC_Data' );

add_filter('woocommerce_product_get_price', 'gpls_woo_rfq_woocommerce_data_get_price', 1000, 2);
add_filter('woocommerce_variation_prices_price', 'gpls_woo_rfq_woocommerce_data_variation_get_price', 1000, 3);

add_action('woocommerce_payment_complete', 'gpls_woo_rfq_woocommerce_pre_payment_complete', 100, 1);

add_filter('woocommerce_can_reduce_order_stock', 'rfqtk_can_reduce_order_stock', 1000, 2);


if (!function_exists('rfqtk_can_reduce_order_stock')) {
    function rfqtk_can_reduce_order_stock($flag, $order)
    {


        $statuses = array('wc-gplsquote-sent', 'gplsquote-sent', 'wc-gplsquote-req', 'gplsquote-req');

        $status = $order->get_status();

        $status = 'wc-' === substr($status, 0, 3) ? substr($status, 3) : $status;

        if (in_array($status, $statuses)) {
            return false;
        }

        return $flag;

    }
}

if (!function_exists('np_check_array_element')) {
    function np_check_array_element($array, $key)
    {

        return is_array($array) && isset($array[$key]) && $array[$key] != null;
    }
}

if (!function_exists('rfqtk_first_main')) {

    function rfqtk_first_main()
    {


        // if (isset($_REQUEST['pay_for_order']) && strpos($_REQUEST['key'], 'wc_order_', 0) === 0) {

        if (isset($_REQUEST['pay_for_order']) && strpos($_REQUEST['key'], 'wc_order_', 0) === 0) {
            $GLOBALS["gpls_woo_rfq_show_prices"] = "yes";
            $GLOBALS["hide_for_visitor"] = "no";

            return true;
        }


        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $has_string = strpos($url, 'order-received');

        if ($has_string !== false && strpos($_REQUEST['key'], 'wc_order_', 0) === 0) {

            global $wpdb;
            $order_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM {$wpdb->prefix}postmeta WHERE meta_key = '_order_key' AND meta_value = %s", $_REQUEST['key']));

            $post_status = $wpdb->get_var($wpdb->prepare("SELECT post_status FROM {$wpdb->prefix}posts WHERE ID = %s", $order_id));

            if ($post_status !== 'wc-gplsquote-req') {
                $GLOBALS["gpls_woo_rfq_show_prices"] = "yes";
                $GLOBALS["hide_for_visitor"] = "no";
                return true;
            }
        }


    }


    if (!function_exists('URL_Has_string')) {

        function UR_LHas_string($needle)
        {
            $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            $has_string = strpos($url, $needle);
            return $has_string;
        }
    }
}

if (!function_exists('gpls_woo_get_rfq_enable')) {
    function gpls_woo_get_rfq_enable($product)
    {
        if(!$product)return "no";

        $product_id=$product->get_id();

        $rfq_enable = "no";

        $rfq_enable = get_post_meta($product_id, '_gpls_woo_rfq_rfq_enable', true);

        if($rfq_enable != "yes" || empty($rfq_enable)) {
            if (class_exists('GPLS_WOO_RFQ_PLUS') && function_exists('gpls_woo_plus_get_rfqc_enable')) {
                $rfq_enable = gpls_woo_plus_get_rfqc_enable($product_id);
            }
        }

        $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product_id);

        if(empty($rfq_enable)){
            $rfq_enable="no";
        }
        return $rfq_enable;
    }
}


if (!function_exists('gpls_woo_rfq_get_hide_price')) {
    function gpls_woo_rfq_get_hide_price($product)
    {
        $product_id=$product->get_id();

        $hide_price = get_post_meta($product_id, '_gpls_woo_rfq_hide_price', true);

        if($hide_price != "yes" || empty($hide_price)) {
            if (class_exists('GPLS_WOO_RFQ_PLUS') && function_exists('gpls_woo_plus_get_gpls_woo_plus_getc_hide_price')) {
                $hide_price = gpls_woo_plus_get_gpls_woo_plus_getc_hide_price($product_id);
            }
        }

        $hide_price = apply_filters('gpls_hide_product_price', $hide_price, $product_id);

        if(empty($hide_price)){
            $hide_price="no";
        }

        return $hide_price;
    }
}









if (!function_exists('np_check_array_element')) {
    function np_check_array_element($array, $key)
    {

        return is_array($array) && isset($array[$key]) && $array[$key] != null;
    }
}

function gpls_woo_rfq_woocommerce_pre_payment_complete($orderid)
{

    $order = WC_Order_Factory::get_order($orderid);

    if ($order->get_payment_method() == 'gpls-rfq' && $order->get_status() != 'wc-gplsquote-req'
        && $order->get_status() != 'gplsquote-req'
    ) {
        $order->update_status('wc-gplsquote-req', __('RFQ', 'woo-rfq-for-woocommerce'));
        $order->save();
    }
}


function gpls_woo_rfq_woocommerce_data_get_price($base_price, $_product)
{

    if (!is_admin()) {

        $rfq_enable = 'no';
        $quote = "no";

        $checkout_option = "normal_checkout";
        if (isset($GLOBALS["gpls_woo_rfq_checkout_option"]) && !empty($GLOBALS["gpls_woo_rfq_checkout_option"])) {
            $checkout_option = $GLOBALS["gpls_woo_rfq_checkout_option"];
        }

        if ($checkout_option == "rfq") {
            $quote = "yes";
        }

        if ($checkout_option == "normal_checkout") {

            //$rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            // $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

            $rfq_enable = gpls_woo_get_rfq_enable($_product);
            //echo $product->id.' '.$rfq_enable.'<br />';
            if ($rfq_enable == 'yes') {
                $quote = "yes";
            } else {
                $quote = "no";
            }


        }

        if (empty($base_price) && $quote == "yes") {
            return 0;
        }
    }
    return $base_price;
}

function gpls_woo_rfq_woocommerce_data_variation_get_price($base_price, $variation, $product)
{


    if (!is_admin()) {

        $rfq_enable = 'no';
        $quote = "no";

        $checkout_option = "normal_checkout";
        if (isset($GLOBALS["gpls_woo_rfq_checkout_option"]) && !empty($GLOBALS["gpls_woo_rfq_checkout_option"])) {
            $checkout_option = $GLOBALS["gpls_woo_rfq_checkout_option"];
        }

        if ($checkout_option == "rfq") {
            $quote = "yes";
        }

        if ($checkout_option == "normal_checkout") {

            //$rfq_enable = get_post_meta($product->get_id(), '_gpls_woo_rfq_rfq_enable', true);
            // $rfq_enable = apply_filters('gpls_rfq_enable', $rfq_enable, $product->get_id());

            $rfq_enable = gpls_woo_get_rfq_enable($product);
            //echo $product->id.' '.$rfq_enable.'<br />';
            if ($rfq_enable == 'yes') {
                $quote = "yes";
            } else {
                $quote = "no";
            }


        }

        if (empty($base_price) && $quote == "yes") {
            return 0;
        }
    }

    return $base_price;
}


if (!function_exists('rfqtk_statuses_for_payment')) {

    function rfqtk_statuses_for_payment($array, $order)
    {

        array_push($array, 'gplsquote-sent');
        array_push($array, 'wc-gplsquote-sent');
        return $array;
    }
}


if (!function_exists('gpls_woo_rfq_get_mode')) {
    function gpls_woo_rfq_get_mode(&$rfq_check, &$normal_check)
    {
        $rfq_check = false;
        $normal_check = false;

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {
            add_filter('woocommerce_cart_needs_payment', 'gpls_woo_rfq_cart_needs_payment', 1000, 2);
            $rfq_check = true;
            $normal_check = false;
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
            $rfq_check = false;
            $normal_check = true;
        }

        if (function_exists('is_user_logged_in')) {
            if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !is_user_logged_in()) {
                $rfq_check = true;
                $normal_check = false;

            }
        }

    }
}

//add_filter( 'woocommerce_get_price_html','gpls_woo_rfq_woocommerce_empty_price_html',10,2 );

if (!function_exists('gpls_woo_rfq_woocommerce_empty_price_html')) {
    function gpls_woo_rfq_woocommerce_empty_price_html($html, $product)
    {

        if (isset($product) && is_object($product)) {

            if ($GLOBALS["gpls_woo_rfq_checkout_option"] == "rfq") {


                $data = $product->get_data();

                $this_price = $data["price"];

                if (trim($data["sale_price"]) != '') {
                    $this_price = $data["sale_price"];
                }

                $type = $product->get_type();
                if ($type == 'simple' || $type == 'variable') {
                    if (trim($this_price) === '') {

                        //  return false;
                    }
                }


            }
        }
        return $html;
    }
}


if (!function_exists('gpls_woo_rfq_plus_startsWith')) {
    function gpls_woo_rfq_plus_startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
}

if (!function_exists('gpls_woo_rfq_plus_endsWith')) {
    function gpls_woo_rfq_plus_endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if (!$length) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}

if (!function_exists('gpls_empty')) {
    function gpls_empty($var)
    {
        if (!isset($var) || $var == false) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('gpls_woo_rfq_add_notice')) {
    function gpls_woo_rfq_add_notice($message, $type = 'info')
    {
        //$all_notices  = array();
        $notice = array('message' => $message, 'type' => $type, 'expired' => false);

        $gpls_woo_rfq_cart_notices = gpls_woo_rfq_get_item('gpls_woo_rfq_cart_notices');

        if (is_array($gpls_woo_rfq_cart_notices)) {
            array_push($gpls_woo_rfq_cart_notices, $gpls_woo_rfq_cart_notices);
        }

        gpls_woo_rfq_cart_set(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart_notices', $notice);

    }
}

if (!function_exists('gpls_woo_rfq_print_notices')) {
    function gpls_woo_rfq_print_notices()
    {

        $notice = gpls_woo_rfq_get_item('gpls_woo_rfq_cart_notices');


        if (isset($notice['type']) && trim($notice['message']) != "") {
            ?>

            <?php if ($notice['type'] == 'error') : ?>
                <div class="woocommerce-error">
                    <?php echo trim(wp_kses_post($notice['message'])); ?>
                </div>
            <?php endif; ?>
            <?php if ($notice['type'] == 'info') : ?>
                <div class="woocommerce-info">
                    <?php echo trim(wp_kses_post($notice['message'])); ?>
                </div>
            <?php endif; ?>
            <?php if ($notice['type'] == 'notice') : ?>
                <div class="woocommerce-notice">
                    <?php echo trim(wp_kses_post($notice['message'])); ?>
                </div>
            <?php endif; ?>


            <?php

        }
        gpls_woo_rfq_cart_delete(gpls_woo_rfq_cart_tran_key() . '_' . 'gpls_woo_rfq_cart_notices');

    }
}

if (!function_exists('rfq_cart_get_item_data')) {
    function rfq_cart_get_item_data($cart_item, $flat = false)
    {
        $item_data = array();


        if ($cart_item['data']->is_type('variation') && is_array($cart_item['variation'])) {
            foreach ($cart_item['variation'] as $name => $value) {
                if (is_array($name)) continue;


                $taxonomy = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', urldecode($name)));

                if (taxonomy_exists($taxonomy)) {

                    $term = get_term_by('slug', $value, $taxonomy);
                    if (!is_wp_error($term) && $term && $term->name) {
                        $value = $term->name;
                    }
                    $label = wc_attribute_label($taxonomy);
                } else {

                    $value = apply_filters('woocommerce_variation_option_name', $value, null, $taxonomy, $cart_item['data']);
                    $label = wc_attribute_label(str_replace('attribute_', '', $name), $cart_item['data']);
                }


                if ('' === $value || wc_is_attribute_in_product_name($value, $cart_item['data']->get_name())) {
                    // continue;
                }

                $item_data[] = array(
                    'key' => $label,
                    'value' => $value,
                );
            }
        }


        $item_data = apply_filters('woocommerce_get_item_data', $item_data, $cart_item);

        foreach ($item_data as $key => $data) {
            // Set hidden to true to not display meta on cart.
            if (!empty($data['hidden'])) {
                unset($item_data[$key]);
                continue;
            }

            $item_data[$key]['key'] = !empty($data['key']) ? $data['key'] : $data['name'];
            $item_data[$key]['display'] = !empty($data['display']) ? $data['display'] : $data['value'];
        }


        if (count($item_data) > 0) {
            ob_start();

            if ($flat) {
                foreach ($item_data as $data) {
                    echo esc_html($data['key']) . ': ' . wp_kses_post($data['display']) . "\n";
                }
            } else {
                wc_get_template('cart/cart-item-data.php',
                    array('item_data' => $item_data)
                );
            }

            return ob_get_clean();
        }

        return '';
    }

}

if (!function_exists('rfq_cart_get_item_data_old')) {
    function rfq_cart_get_item_data_old($cart_item, $flat = false)
    {
        $item_data = array();

        // Variation data
        if (isset($cart_item['data']->variation_id) && is_array($cart_item['variation'])) {

            foreach ($cart_item['variation'] as $name => $value) {

                if ('' === $value)
                    continue;

                $taxonomy = wc_attribute_taxonomy_name(str_replace('attribute_pa_', '', urldecode($name)));

                // If this is a term slug, get the term's nice name
                if (taxonomy_exists($taxonomy)) {
                    $term = get_term_by('slug', $value, $taxonomy);
                    if (!is_wp_error($term) && $term && $term->name) {
                        $value = $term->name;
                    }
                    $label = wc_attribute_label($taxonomy);

                    // If this is a custom option slug, get the options name
                } else {
                    $value = apply_filters('woocommerce_variation_option_name', $value);
                    $label = wc_attribute_label(str_replace('attribute_', '', $name), $cart_item['data']);
                }

                $item_data[] = array(
                    'key' => $label,
                    'value' => $value
                );
            }
        }

        // Filter item data to allow 3rd parties to add more to the array
        $item_data = apply_filters('woocommerce_get_item_data', $item_data, $cart_item);


        // Format item data ready to display
        foreach ($item_data as $key => $data) {
            // Set hidden to true to not display meta on cart.
            if (isset($data['hidden'])) {
                unset($item_data[$key]);
                continue;
            }

            $item_data[$key]['key'] = isset($data['key']) && $data['key'] != "" ? $data['key'] : $data['name'];
            $item_data[$key]['display'] = isset($data['display']) && $data['display'] != "" ? $data['display'] : $data['value'];
        }

        // Output flat or in list format
        if (sizeof($item_data) > 0) {
            //ob_start();

            if ($flat) {
                foreach ($item_data as $data) {

                    echo esc_html($data['key']) . ': ' . wp_kses_post($data['display']) . "\n";
                }
            } else {
                wc_get_template('cart/cart-item-data.php',
                    array('item_data' => $item_data)
                );

                return;
            }

            //return ob_get_clean();
        }

        return '';


    }
}

add_action('woocommerce_before_calculate_totals', 'gpls_woo_rfq_remove_warnings', -1000);
add_action('woocommerce_remove_cart_item', 'gpls_woo_rfq_remove_cart_item_warnings', -1000, 2);
if (!function_exists('gpls_woo_rfq_remove_warnings')) {

    function gpls_woo_rfq_remove_warnings()
    {
        ini_set('display_errors', 'Off');


    }
}
if (!function_exists('gpls_woo_rfq_remove_cart_item_warnings')) {

    function gpls_woo_rfq_remove_cart_item_warnings($cart_item_key, $cart)
    {
        ini_set('display_errors', 'Off');


    }
}


if (!function_exists('gpls_woo_rfq_order_needs_shipping')) {
    function gpls_woo_rfq_order_needs_shipping($order_id)
    {

        $order = new WC_Order($order_id);
        foreach ($order->get_items() as $order_item) {

            $product = wc_get_product($order_item->get_product_id());

            if ($product->get_type() == 'variable') {
                $variation_id = $order_item->get_variation_id();

                $variation = new WC_Product_Variation($variation_id);
                if ($variation->needs_shipping() && !$variation->is_virtual() && !$variation->is_downloadable()) {
                    return true;

                }
            } else {
                if ($product->needs_shipping() && !$product->is_virtual() && !$product->is_downloadable()) {
                    return true;
                }
            }

        }

        return false;
    }
}
if (!function_exists('gpls_woo_rfq_get_rfq_cart_quantity')) {
    function gpls_woo_rfq_get_rfq_cart_quantity()
    {
        $wp_session = gpls_woo_get_session();

        $gpls_woo_rfq_cart = gpls_woo_rfq_get_item('gpls_woo_rfq_cart');
        $total_quantity = 0;
        if (is_array($gpls_woo_rfq_cart)) {
            foreach ($gpls_woo_rfq_cart as $cart_item_key => $cart_item) {
                $total_quantity = $total_quantity + $cart_item['quantity'];
            }
        }


        return $total_quantity;
    }
}

if (!function_exists('pls_woo_rfq_get_link_to_rfq')) {

    function pls_woo_rfq_get_link_to_rfq()
    {

        $home = home_url() . '/quote-request/';

        $rfq_page = get_option('rfq_cart_sc_section_show_link_to_rfq_page', $home);

        if (is_ssl()) {

            $rfq_page = preg_replace("/^http:/i", "https:", $rfq_page);

        }

        return $rfq_page;


    }
}
if (!function_exists('gpls_woo_rfq_show_order_status_for_reports')) {
    function gpls_woo_rfq_show_order_status_for_reports($order_statuses)
    {
        unset($order_statuses['wc-gplsquote-req']);
        unset($order_statuses['gplsquote-req']);
        unset($order_statuses['wc-gplsquote-sent']);
        unset($order_statuses['gplsquote-sent']);

        return $order_statuses;

    }
}


if (!function_exists('init_gpls_rfq_payment_gateway')) {
    function init_gpls_rfq_payment_gateway()
    {
        require(gpls_woo_rfq_DIR . 'includes/classes/gateway/wc-gateway-gpls-request-quote.php');


    }
}

if (!function_exists('add_gpls_woo_rfq_class')) {
//normal to rfq checkout
    function add_gpls_woo_rfq_class($methods)
    {

        $methods[] = 'WC_Gateway_GPLS_Request_Quote';

        return $methods;
    }
}
if (!function_exists('gpls_rfq_remove_other_payment_gateways')) {
    function gpls_rfq_remove_other_payment_gateways($available_gateways)
    {

        if (is_admin()) {
            return $available_gateways;
        }

        if (isset($_GET['pay_for_order'])) {
            unset($available_gateways['gpls-rfq']);
            return $available_gateways;
        }


        $can_ask_quote = false;

        foreach ($available_gateways as $gateway_id => $gateway) {

            if ($gateway_id != 'gpls-rfq') {
                unset($available_gateways[$gateway_id]);
            } else {
                $can_ask_quote = true;
            }
        }

        if ($can_ask_quote && !WC()->session) {
            WC()->initialize_session();
        }

        if ($can_ask_quote && WC()->session != null) {
            WC()->session->set('chosen_payment_method', 'gpls-rfq');
        }

        return $available_gateways;
    }
}


function gpls_woo_rfq_footer_admin($default)
{


    if (is_admin() && isset($_REQUEST['tab']) && $_REQUEST['tab'] == 'settings_gpls_woo_rfq') {
        ob_start();
        ?>

        <div style="clear:both"></div>
        <div style="position: absolute;left:0">
            <table>
                <tr valign="top">

                    <td class="forminp">
                        <table style="background:white;">


                            <tr>
                                <td>
                                    <div class="plus_options" style=" ">

                                        <ul class="plus_options_ul">

                                            <li class="plus_options_li" style="margin-top: 15px;">
                                                <div>
                                                    <span class="plus_options-header"> <?php echo __('Available in Premium Version:', 'woo-rfq-for-woocommerce'); ?></span>
                                                </div>
                                            </li>

                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Buy or request a quote at woocommerce checkout', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('Allow the choice to purchase or request a quote at WooCommerce checkout.', 'woo-rfq-for-woocommerce') ?>

                                                </div>
                                            </li>

                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Buy or request a quote based on items in the cart', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('If the cart contains a "quote item", then customer can only request a quote.', 'woo-rfq-for-woocommerce') ?>

                                                </div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Enable role based price visibility and checkout options at WooCommerce checkout:', 'woo-rfq-for-woocommerce') ?></strong>

                                                </div>
                                            </li>


                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Bulk action for stores with large number of products:', 'woo-rfq-for-woocommerce') ?></strong>

                                                    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php _e('Bulk enable/disable quote items, "Hide Add to Cart", "Hide Price"  by category.', 'woo-rfq-for-woocommerce'); ?>

                                                </div>
                                            </li>


                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Use google recaptcha for quote request:', 'woo-rfq-for-woocommerce') ?></strong>

                                                </div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Allow visitors to pay for an order without having to log on first (guest pay).', 'woo-rfq-for-woocommerce') ?></strong>

                                                </div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Enable price visibility by IP address.', 'woo-rfq-for-woocommerce') ?></strong>


                                                </div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('And more!', 'woo-rfq-for-woocommerce') ?></strong>

                                                </div>
                                            </li>


                                        </ul>
                                        <ul class="plus_options_ul">
                                            <li class="plus_options_li plus_large">
                                                <div style="margin-bottom:20px"><span> <a target="_blank"
                                                                                          class="get_plus"
                                                                                          href="https://neahplugins.com/product/woocommerce-quote-request-plus/"><?php echo __('Get Quote Request Plus!', 'woo-rfq-for-woocommerce'); ?></a></span>
                                                </div>
                                            </li>
                                            <li class="plus_options_li plus_small">
                                                <div style="margin-bottom:20px"><span> <a target="_blank"
                                                                                          class="get_plus"
                                                                                          href="https://neahplugins.com/product/woocommerce-quote-request-plus/"><?php echo __('Get Premium!', 'woo-rfq-for-woocommerce'); ?></a></span>
                                                </div>
                                            </li>

                                            <li>
                                                <div>&nbsp;</div>
                                            </li>
                                            <li>
                                                <div>&nbsp;</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clear_narrow">&nbsp;</div>
                                    <div class="plus_narrow">
                                        <ul class="plus_options_ul">
                                            <li class="plus_options_li" style="margin-top: 15px;">
                                                <div>
                                                    <span class="plus_options-header"> <?php echo __('Other Quote Request Plugins:', 'woo-rfq-for-woocommerce'); ?></span>
                                                </div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('PDF Plugin for Quote Request:', 'woo-rfq-for-woocommerce') ?></strong><?php _e('Send PDF attachments of the quote email to the customer.', 'woo-rfq-for-woocommerce') ?>

                                                </div>
                                            </li>
                                            <li>
                                                <div>&nbsp;</div>
                                            </li>
                                            <li>
                                                <div>&nbsp;</div>
                                            </li>
                                            <li class="plus_options_li">
                                                <div>
                                                    <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('File Upload Plugin for Quote Request:', 'woo-rfq-for-woocommerce') ?></strong><?php _e('Allow customers to upload files along with their quote request.', 'woo-rfq-for-woocommerce') ?>

                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>

                        </table>


                    </td>
                </tr>
            </table>
            <p>
        </div>

        <?php
        $footer = ob_get_clean();
        return $footer;
    }
    return $default;
}


if (!function_exists('gpls_woo_rfq_main_after_setup_theme')) {
    function gpls_woo_rfq_main_after_setup_theme()
    {
        if (get_option('settings_gpls_woo_rfq_show_cart_thank_you_page') == "yes") {

            add_action('woocommerce_thankyou', 'gpls_woo_rfq_woocommerce_thankyou', 1000, 1);

        }

        add_filter('woocommerce_reports_order_statuses', 'gpls_woo_rfq_show_order_status_for_reports', 100, 1);

        if (function_exists('is_user_logged_in')) {

            if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !is_user_logged_in()) {

                $GLOBALS["gpls_woo_rfq_show_prices"] = "no";
                $GLOBALS["gpls_woo_rfq_checkout_option"] = "rfq";
                $GLOBALS["hide_for_visitor"] = "yes";

            } else {
                $GLOBALS["hide_for_visitor"] = "no";
            }
        } else {
            $GLOBALS["hide_for_visitor"] = "no";
        }

        if (isset($GLOBALS["gpls_woo_rfq_checkout_option"]) && $GLOBALS["gpls_woo_rfq_checkout_option"] == 'rfq') {
            add_filter('woocommerce_payment_gateways', 'add_gpls_woo_rfq_class', 1, 1);

            add_action('init', 'init_gpls_rfq_payment_gateway');

            add_filter('woocommerce_available_payment_gateways', 'gpls_rfq_remove_other_payment_gateways', 1000, 1);
        }


        add_action("woocommerce_add_to_cart", "gpls_woo_rfq_woocommerce_add_to_cart", 1000, 6);


        add_action('woocommerce_order_status_changed', function ($order_id, $status_from, $status_to) {

            //   add_filter('woocommerce_new_order_email_allows_resend', '__return_true' );

            $order = wc_get_order($order_id);

            // if (empty($order->get_meta('_is_admin')))
            {

                $email_already_sent = $order->get_meta('_gpls_new_order_email_sent');


                if ('true' === $email_already_sent && !apply_filters('woocommerce_new_order_email_allows_resend', false)) {
                    return;
                }

                $current_order_status = 'wc-' . $status_to;


                if (in_array($current_order_status, array('wc-processing')) &&
                    in_array($status_from, array('gplsquote-sent', 'gplsquote-req'))) {

                    $np_email = WC()->mailer()->emails['WC_Email_Customer_Processing_Order'];
                    if ($np_email) {

                        $np_email->trigger($order_id);
                        update_post_meta($order_id, '_gpls_new_order_email_sent', 'yes');
                        //     remove_filter('woocommerce_new_order_email_allows_resend', '__return_true' );

                    }

                }
            }

        }, 100, 3);


    }

}
add_action('after_setup_theme', 'gpls_woo_rfq_main_after_setup_theme', 100);


if (!function_exists('gpls_woo_rfq_empty_price')) {
    function gpls_woo_rfq_empty_price($return, $price, $args, $unformatted_price, $original_price)
    {

        if (is_admin()) return $return;

        if (is_checkout() && !empty(is_wc_endpoint_url('order-received'))) {
            if (trim($original_price) == "" || trim($original_price) == "0") {
                return 0;
            }
        } else {
            if (trim($original_price) == "") {
                return 0;
            }
        }
        return $return;
    }
}


if (!function_exists('gpls_woo_rfq_main_after_loaded')) {
    function gpls_woo_rfq_main_after_loaded()
    {
        // add_filter( 'wc_price', 'gpls_woo_rfq_empty_price',10000,5);

        // add_filter('admin_footer_text', 'gpls_woo_rfq_footer_admin');

        if (is_admin()
            && isset($_REQUEST['tab'])
            && $_REQUEST['tab'] == 'settings_gpls_woo_rfq'
            && isset($_REQUEST['section']) && $_REQUEST['section'] == 'npoptions'
        ) {
            $url_js = gpls_woo_rfq_URL . 'gpls_assets/js/rfq_admin_misc.js';
            $url_js_path = gpls_woo_rfq_DIR . 'gpls_assets/js/rfq_admin_misc.js';
            wp_enqueue_script('rfq_admin_misc', $url_js, array('jquery'), rand(10, 100000), true);

        }
    }


    /*
     add_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s &times; %s', $cart_item['quantity'], $product_price) .
      '</span>', $cart_item, $cart_item_key);
 */

    add_action('gpls_woo_create_an_account', 'gpls_woo_create_an_account_function', 10);




    function gpls_woo_rfq_woocommerce_widget_hide($product_id): bool
    {

        $hide = false;

        if (function_exists('is_user_logged_in')) {

            if (get_option('settings_gpls_woo_rfq_hide_visitor_prices', 'no') == 'yes' && !is_user_logged_in()) {
                $hide = true;

            }
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "normal_checkout") {
            $hide = false;

        }

        if (class_exists('GPLS_WOO_RFQ_PLUS') && function_exists('gpls_woo_plus_get_hide_price')) {
            $product = wc_get_product($product_id);
            if (gpls_woo_plus_get_hide_price($product) == "yes")
            {
                $hide = true;

            }
        }

        if (get_option('settings_gpls_woo_rfq_checkout_option', 'normal_checkout') == "rfq") {

            if (get_option('settings_gpls_woo_rfq_show_prices', 'no') === 'no') {
                $hide = true;

            }

            if (get_option('settings_gpls_woo_rfq_show_prices', 'no') === 'yes')
            {

                $product = wc_get_product($product_id);
                $rfq_enabled = gpls_woo_get_rfq_enable($product);

                if (class_exists('GPLS_WOO_RFQ_PLUS') && function_exists('gpls_woo_plus_is_rfq5c_hidden'))
                {

                    if (gpls_woo_plus_is_rfq5c_hidden() == true)
                    {

                        if ($rfq_enabled == 'yes') {
                              $hide = true;

                        }

                    }
                }
            } else {
                 $hide = true;

            }

        }

        return $hide;
    }


    function gpls_woo_rfq_woocommerce_widget_cart($html, $cart_item, $cart_item_key)
    {

        $hide = gpls_woo_rfq_woocommerce_widget_hide($cart_item['product_id']);


        if ($hide==1) {
            return '<span class="quantity">' . $cart_item['quantity'] . '  </span>';
        }

        return $html;
    }

    function gpls_woo_rfq_woocommerce_widget_cart_init()
    {

        add_filter('woocommerce_widget_cart_item_quantity', 'gpls_woo_rfq_woocommerce_widget_cart', 100, 3);

    }

   add_action('init', 'gpls_woo_rfq_woocommerce_widget_cart_init');


}

add_action('wp_loaded', 'gpls_woo_rfq_main_after_loaded', 100);

