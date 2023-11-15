<?php

/**
 * Created by PhpStorm.
 * Author:   @Neah Plugins
 * Date: 1/27/2016
 * Time: 4:07 PM
 */


if (!class_exists('GPLS_Woo_RFQ_Settings')) {

    class GPLS_Woo_RFQ_Settings extends WC_Settings_Page
    {


        public function __construct()
        {
            parent::__construct();

            $this->id = 'settings_gpls_woo_rfq';
            add_filter('woocommerce_settings_tabs_array', array($this, 'add_settings_tab'), 50);
            add_action('woocommerce_sections_' . $this->id, array($this, 'output_sections'));
            add_action('woocommerce_settings_' . $this->id, array($this, 'output'));
            add_action('woocommerce_settings_save_' . $this->id, array($this, 'save'));
            add_action('woocommerce_admin_field_gpls_woo_options', array(__CLASS__, 'gpls_woo_rfq_more_options'), 100000, 1);


        }


        public function get_sections()
        {

            if (class_exists('GPLS_WOO_RFQ_PLUS')) {
                $sections = array(
                    '' => __('General', 'woo-rfq-for-woocommerce'),
                    'translations' => __('Labels', 'woo-rfq-for-woocommerce'),
                    'links' => __('Links', 'woo-rfq-for-woocommerce'),
                    'rfq_page' => __('Quote Request Page', 'woo-rfq-for-woocommerce'),
                    'add-to-quote' => __('Quote Button', 'woo-rfq-for-woocommerce'),
                );
            } else {
                $sections = array(
                    '' => __('General', 'woo-rfq-for-woocommerce'),
                    'translations' => __('Labels', 'woo-rfq-for-woocommerce'),
                    'links' => __('Links', 'woo-rfq-for-woocommerce'),
                    'rfq_page' => __('Quote Request Page', 'woo-rfq-for-woocommerce'),
                    'add-to-quote' => __('Quote Button', 'woo-rfq-for-woocommerce'),


                );


            }
            if (!class_exists('GPLS_WOO_RFQ_FIELD') && !class_exists('GPLS_WOO_RFQ_PLUS')
                && !class_exists('GPLS_WOO_PDF') && !class_exists('GPLS_WOO_RFQ_UPLOAD')
            ) {
                $sections['npoptions'] = __('More Options', 'rfqtk');
            }
            return apply_filters('woocommerce_get_sections_' . $this->id, $sections);
        }

        public function output()
        {
            global $current_section;
            $settings = $this->get_settings($current_section);
            WC_Admin_Settings::output_fields($settings);
        }


        public function add_settings_tab($settings_tabs)
        {
            $settings_tabs[$this->id] = 'RFQ-ToolKit';
            return $settings_tabs;
        }


        public function save()
        {
            global $current_section;
            $settings = $this->get_settings($current_section);
            WC_Admin_Settings::save_fields($settings);
        }


        public static function gpls_woo_rfq_more_options($value)
        {

            $option_value = get_option($value['id'], $value['default']);

            ?>



            <tr valign="top" 

                <td class="forminp forminp-<?php echo sanitize_title($value['type']) ?>">


                    <table style="background:white; width:100%; min-width:800px">


                        <tr valign="top">

                            <td class="forminp">
                                <div>
                                    <table style="background:#3d363614;margin-top:1em">

                                        <tr>
                                            <td>
                                                <div class="plus_options" style=" ">

                                                    <ul class="plus_options_ul">

                                                        <li class="plus_options_li" style="margin-top: 15px;">
                                                            <div>
                                                                <span class="plus_options-header"> <?php echo __('Available in the Plus Version:', 'woo-rfq-for-woocommerce'); ?></span>
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
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Use Google ReCAPTCHA for quote request:', 'woo-rfq-for-woocommerce') ?></strong>

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

                                                    </ul>
                                                </div>
                                                <div class="clear_narrow">&nbsp;</div>
                                                <div class="plus_narrow">

                                                </div>
                                            </td>

                                        </tr>


                                    </table>
                                </div>

                            </td>
                        </tr>

                        <tr valign="top">

                            <td class="forminp">
                                <div>
                                    <table style="background:#3d363614;margin-top:1em">

                                        <tr>
                                            <td>
                                                <div class="plus_options" style=" ">

                                                    <ul class="plus_options_ul">


                                                        <li class="plus_options_li" style="margin-top: 15px;">
                                                            <div>
                                                                <span class="plus_options-header"> <?php echo __('Available in the Cart & Quote to PDF:', 'woo-rfq-for-woocommerce'); ?></span>
                                                            </div>

                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('PDF Attachments', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('Include a PDF version of the quote to in the quote email', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('WooCommerce cart to Quote', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('Export the cart to a PDF download and optionally create a quote request.', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Include a custom form with the WooCommerce cart to Quote:', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('Collect needed information to prepare a quote for the customer.', 'woo-rfq-for-woocommerce') ?>

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
                                                                                                      href="https://neahplugins.com/product/np-quote-request-woocommerce-email-cart-pdf/"><?php echo __('Try cart & quote to PDF for free!', 'woo-rfq-for-woocommerce'); ?></a></span>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="clear_narrow">&nbsp;</div>
                                                <div class="plus_narrow">

                                                </div>
                                            </td>

                                        </tr>


                                    </table>
                                </div>

                            </td>
                        </tr>


                        <tr valign="top">

                            <td class="forminp">
                                <div>
                                    <table style="background:#3d363614;margin-top:1em">

                                        <tr>
                                            <td>
                                                <div class="plus_options" style=" ">

                                                    <ul class="plus_options_ul">


                                                        <li class="plus_options_li" style="margin-top: 15px;">
                                                            <div>
                                                                <span class="plus_options-header"> <?php echo __('Available in File Upload Add-on:', 'woo-rfq-for-woocommerce'); ?></span>
                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('File Uploads:', 'woo-rfq-for-woocommerce') ?></strong>:
                                                                <?php _e('Allow your customers to upload documents that are linked to quote requests or orders.', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Google ReCAPTCHA:', 'woo-rfq-for-woocommerce') ?></strong>: <?php _e('Optionally enable Google ReCAPTCHA for file uploads.', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Allow upload in multiple places:', 'woo-rfq-for-woocommerce') ?>
                                                                </strong>: <?php _e('Quote Request page, checkout page, my accounts page, thank you page or at product level.', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>
                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Centralized File Repository:', 'woo-rfq-for-woocommerce') ?>
                                                                </strong>: <?php _e('File repository to view and manage the uploaded files.', 'woo-rfq-for-woocommerce') ?>

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
                                                                                                      href="https://neahplugins.com/product/woocommerce-quote-request-upload-files/"><?php echo __('GET File Upload!', 'woo-rfq-for-woocommerce'); ?></a></span>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="clear_narrow">&nbsp;</div>
                                                <div class="plus_narrow">

                                                </div>
                                            </td>

                                        </tr>


                                    </table>
                                </div>

                            </td>
                        </tr>







                        <tr valign="top">

                            <td class="forminp">
                                <div>
                                    <table style="background:#3d363614;margin-top:1em">

                                        <tr>
                                            <td>
                                                <div class="plus_options" style=" ">

                                                    <ul class="plus_options_ul">

                                                        <li class="plus_options_li" style="margin-top: 15px;">
                                                            <div>
                                                                <span class="plus_options-header"> <?php echo __('Available in WooCommerce – QuickBooks Desktop Assistant:', 'woo-rfq-for-woocommerce'); ?></span>
                                                            </div>
                                                        </li>

                                                        <li class="plus_options_li">
                                                            <div>
                                                                <span class="bulletpoint">&#8226;</span>&nbsp;<strong> <?php _e('Save time and reduce tedious data entry!', 'woo-rfq-for-woocommerce') ?></strong>
                                                                <?php _e('WooCommerce – QuickBooks Desktop Assistant is a flexible and powerful solution for syncing your data with QuickBooks!', 'woo-rfq-for-woocommerce') ?>

                                                            </div>
                                                        </li>

                                                    </ul>
                                                    <ul class="plus_options_ul">
                                                        <li class="plus_options_li plus_large">
                                                            <div style="margin-bottom:20px"><span> <a target="_blank"
                                                                                                      class="get_plus"
                                                                                                      href="https://neahplugins.com/product/woocommerce-quickbooks-assistant/"><?php echo __('Try for 30 days risk free!', 'woo-rfq-for-woocommerce'); ?></a></span>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                                <div class="clear_narrow">&nbsp;</div>
                                                <div class="plus_narrow">

                                                </div>
                                            </td>

                                        </tr>


                                    </table>
                                </div>

                            </td>
                        </tr>


                    </table>


                </td>
            </tr>
            <?php
        }


        public function get_settings($section = null)
        {
            $settings = array();

            switch ($section) {
                case '' :
                    $settings =

                        array(

                            'general_section_title' => array(
                                'name' => __('RFQ-ToolKit General Options', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('RFQ-ToolKit general options ', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_general_section_title'
                            ),
                            'checkout_option' => array(
                                'name' => '1- ' . __('Checkout Option', 'woo-rfq-for-woocommerce'),
                                'type' => 'select',
                                'options' => array(
                                    'normal_checkout' => __('Normal Checkout', 'woo-rfq-for-woocommerce'),
                                    'rfq' => __('RFQ', 'woo-rfq-for-woocommerce')),
                                'desc' => '<h4>' .
                                    __('RFQ turns WooCommerce shopping cart into a request for quote. In premium version there are additional options to buy or request a quote the whole cart at WooCommerce checkout. RFQ option provides very high compatibility with other third party plugins and products. Normal option allows checking out normally or request a quote using a quote cart.', 'woo-rfq-for-woocommerce') .
                                    '</h4>' . __('Normal Checkout: If normal checkout, prices will be shown except for selected products (managed in product setup-advanced tab) and customer can only inquire about the products that you specify in product setup in the advanced tab.<br />
<br>RFQ Checkout: In RFQ mode the plugin is integrated with the WooCommerce cart and the entire cart is submitted as a quote request.<br /> All the prices are hidden and at checkout the option is to submit a quote request.<br />
<div class="hoveroverlink"><p><a href="https://neahplugins.com/woocommerce-quote-request-more-options/" target="_blank">More Information</a></p></div>
', 'woo-rfq-for-woocommerce') . '</h4>',

                                'default' => 'normal_checkout',
                                'id' => 'settings_gpls_woo_rfq_checkout_option'
                            ),

                            'settings_gpls_woo_rfq_show_prices' => array(
                                'name' => '2- ' . __('Always Show Product Prices With RFQ Checkout', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Applicable to RFQ checkout option only.<br /> Prices are shown for products but checkout is still a request for quote. Premium version show prices in the email and thank you page also.', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_prices'
                            ),

                            'settings_gpls_woo_rfq_normal_checkout_show_prices' => array(
                                'name' => '3- ' . __('Show Prices With Normal Checkout', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Applicable to normal checkout option only.<br /> Prices are shown on the site but customer can inquire or checkout with selected products.< br />
                            This allows customers to checkout using the published prices or to request a personalized quote.  Premium version show prices in the email and thank you page also', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_normal_checkout_show_prices'
                            ),
                            'settings_gpls_woo_rfq_allow_out_of_stock' => array(
                                'name' => '3-0 ' . __('Allow quote items when they are out of stock', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('<br />.Allow quote items when they are out of stock', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_allow_out_of_stock'
                            ),
                            'rfq_cart_wordings_outofstock_text' => array(
                                'name' => '3-01- Normal & RFQ Checkout-' . __('sold-out Message', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'If 3-0 above is selected,<br />
                                     this message(not blank) will show if customer is viewing a sold-out quote item',
                                'default' => '',
                                'id' => 'rfq_cart_wordings_outofstock_text',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_hide_visitor_prices' => array(
                                'name' => '4- ' . __('Hide Prices from Visitors', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => __('Hide Prices From Visitor. Visitors who are not logged in can only submit a quotes request. <br />Enable guest checkout so the customers can submit requests as guest', 'woo-rfq-for-woocommerce'),
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_hide_visitor_prices'
                            ),


                            'general_section_end345' => array(
                                'type' => 'sectionend',
                                'id' => 'settings_gpls_woo_rfq_general_section_end345'
                            ),
                            'rfq_cart_sc_section_plus_options' => array(
                                'name' => '',
                                'type' => 'plus_options',
                                'id' => 'rfq_cart_sc_section_plus_options',


                            ),


                        );
                    break;

                case 'translations':
                    $settings =

                        array(

                            'rfq_cart_wordings_section_title' => array(
                                'name' => __('Custom Labels', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('Manage labels and wordings', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_section_title'
                            ),


                            'rfq_cart_wordings_add_to_cart' => array(
                                'name' => '1- RFQ Checkout-' . __('Add To Cart Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Add to Cart" - (Change to Add To Quote in RFQ Checkout)', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add to Cart', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_add_to_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_in_cart' => array(
                                'name' => '2- RFQ Checkout-' . __('Add To Cart Again Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Already in the Cart"- (Change to Add To Quote in RFQ Checkout) ', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add to Cart', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_in_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_add_to_rfq' => array(
                                'name' => '3- Normal Checkout-' . __('Add To Quote Request Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal Checkout Only. Choose the text for "Request Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add To Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_add_to_rfq',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_in_rfq' => array(
                                'name' => '4- Normal Checkout-' . __('Add To Quote Request Again Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal Checkout Only. Choose the text for "Already In Quote Request"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Add To Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_in_rfq',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_proceed_to_rfq' => array(
                                'name' => '5- ' . __('RFQ Checkout- Proceed To Submit Your Quote Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('RFQ Checkout- Choose the text for "Proceed To Submit Your Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Proceed To Submit Your Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_proceed_to_rfq',
                                'css' => 'width:400px'
                            ),


                            'rfq_cart_wordings_submit_your_rfq_text' => array(
                                'name' => '6- ' . __('Normal & RFQ Checkout - Submit Your Quote Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Normal & RFQ Checkout- Choose the text for "Submit Your Request For Quote"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Proceed To Submit Your Quote', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_submit_your_rfq_text',
                                'css' => 'width:400px'
                            ),


                            'rfq_cart_wordings_view_rfq_cart' => array(
                                'name' => '7- Normal & RFQ Checkout- ' . __('View List', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "View Your Quote Cart"', 'woo-rfq-for-woocommerce'),
                                'default' => __('View List', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_view_rfq_cart',
                                'css' => 'width:400px'
                            ),

                            'rfq_cart_wordings_rfq_cart_is_empty' => array(
                                'name' => '8- Normal Checkout- ' . __('Quote Request List Is Empty Label', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "You Quote cart is empty and was not submitted"', 'woo-rfq-for-woocommerce'),
                                'default' => __('You quote request list is empty and was not submitted', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_rfq_cart_is_empty',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_return_to_shop' => array(
                                'name' => '9- Normal Checkout- ' . __('Return To Shop In Quote Request Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Return To Shop In Quote Request Page"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Return To Shop', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_return_to_shop',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_product_was_added_to_quote_request' => array(
                                'name' => '10- Normal & RFQ Checkout- ' . __('Product Was Added To The Quote Request', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Choose the text for "Added to Quote List"', 'woo-rfq-for-woocommerce'),
                                'default' => __('Product was successfully added to quote request.', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_product_was_added_to_quote_request',
                                'css' => 'width:400px'
                            ),
                            'gpls_woo_rfq_quote_submit_confirm_message' => array(
                                'name' => '11- Normal & RFQ Checkout- ' . __('Your Request Has Been Submitted', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Your quote request has been successfully submitted!', 'woo-rfq-for-woocommerce'),
                                'default' => __('Your request has been successfully submitted!', 'woo-rfq-for-woocommerce'),
                                'id' => 'gpls_woo_rfq_quote_submit_confirm_message',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_quote_request_currently_empty' => array(
                                'name' => '12- Normal Checkout- ' . __('Your Quote Request List Is Currently Empty', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => '',
                                'default' => __('Your Quote Request List is Currently Empty.', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_quote_request_currently_empty',
                                'css' => 'width:400px'
                            ),
                            'rfq_cart_wordings_gpls_woo_rfq_update_rfq_cart_button' => array(
                                'name' => '13- Normal Checkout-' . __('Update Quote Request', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'Button Text to update Quest Request List in Quote Request Page',
                                'default' => __('Update Quote Request', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_wordings_gpls_woo_rfq_update_rfq_cart_button',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_customer_info_label' => array(
                                'name' => '14- Normal Checkout-' . __('Customer Information', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'Section title for customer information in the quote request page',
                                'default' => __('Customer Information', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_customer_info_label',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_read_more' => array(
                                'name' => '15-  Normal & RFQ Checkout-' . __('Read more', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'label for products with options or no prices',
                                'default' => __('Read more', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_read_more',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_Select_Options' => array(
                                'name' => '16-  Normal & RFQ Checkout-' . __('Select Options', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => 'label for products with options or no prices',
                                'default' => __('Select options', 'woo-rfq-for-woocommerce'),
                                'id' => 'settings_gpls_woo_rfq_Select_Options',
                                'css' => 'width:400px'
                            ),


                            'general_section_end' => array(
                                'type' => 'sectionend',
                                'id' => 'settings_gpls_woo_rfq_general_section_end'
                            ),


                        );
                    break;

                case 'links':
                    $settings =

                        array(
                            'rfq_cart_section_title' => array(
                                'name' => __('Show links to Quote Request Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('Manage links to "Request Quote Page" - (normal checkout)', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_section_title'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_archive_top' => array(
                                'name' => '1- ' . __('Show Link To Quote Request Page At The Top of the Product Archives Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_archive_top'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_archive_end' => array(
                                'name' => '2- ' . __('Show Link To Quote Request Page At The Bottom of the Product Archives Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_archive_end'
                            ),
                            'settings_gpls_woo_rfq_show_cart_link_cart' => array(
                                'name' => '3- ' . __('Show Link To Quote Request Page in WooCommerce Cart Page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_link_cart'
                            ),


                            'settings_gpls_woo_rfq_show_cart_single_page' => array(
                                'name' => '4- ' . __('Show Link To Quote Request Page in the Single Product Description', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_single_page'
                            ),

                            'settings_gpls_woo_rfq_show_cart_thank_you_page' => array(
                                'name' => '5- ' . __('Show Link To Quote Request Page in the Thank you page', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_show_cart_thank_you_page'
                            ),

                            'rfq_cart_section_title_end' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_section_title_end'
                            ),
                        );
                    break;

                case 'rfq_page':
                    $settings =

                        array(

                            'rfq_cart_sc_section_title' => array(
                                'name' => __('Default Request for Quote Page: Applicable In Normal Checkout Mode', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => __('<p>In the Normal Checkout mode, a default page called <i>Quote Request</i> is created to view the quote list. This page
                                            is only needed if in the Normal Checkout mode. (In RFQ mode, the WooCommerce cart
                                           is used to display the items requested for quote.)</p>
                                           <p><b>Exclude this page from page caching.      You can read more <a href="https://neahplugins.com/how-to-make-the-np-quote-plugin-work-with-page-caching/" target="_blank" >How to make the NP Quote Plugin work with page caching plugins</a> </b></p>
                                           </b> You can modify the <i>Quote Request</i> page by using the template in "plugins/woo-rfq-for-woocommerce/woocommerce/woo-rfq/rfq-cart.php".
                                           Copy the folder to the WooCommerce directory in your theme directory and modify it if you wish. 
                                           <b>You can read more <a href="https://neahplugins.com/how-to-customize-the-quote-request-page/" target="_blank" >How to customize the quote request page</a></b>  <br /><br />
                                           You can also use the short code <b>[gpls_woo_rfq_get_cart_sc]</b>  in your own page.</p>
                                          
                                           
                                           
                                           
                                             ', 'woo-rfq-for-woocommerce'),
                                'id' => 'rfq_cart_sc_section_title',
                                'css' => 'width:600px'
                            ),


                            'rfq_cart_sc_section_show_link_to_rfq_page' => array(
                                'name' => __('Request for Quote Page URL', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Request for Quote Page URL.Use the same domain/subdomain name as your site.<br />'
                                    , 'woo-rfq-for-woocommerce'),
                                'default' => '/quote-request/',
                                'id' => 'rfq_cart_sc_section_show_link_to_rfq_page',
                                'css' => 'width:400px;'
                            ),

                            'rfq_cart_sc_section_title_end' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_sc_section_title_end'
                            ),

                            'general_section_title451441' => array(
                                'name' => 'Session Cookie',
                                'type' => 'title',
                                'desc' => '<hr width="100%" size="2" />',
                                'id' => 'general_section_title451441'
                            ),

                            'settings_gpls_woo_rfq_cookie_or_phpsession' => array(
                                'name' => __('Choose Session method', 'woo-rfq-for-woocommerce'),
                                'type' => 'select',
                                'options' => array(
                                    'rfq_cookie' => __('Cookie', 'woo-rfq-for-woocommerce'),
                                    'php_session' => __('PHP Sessions', 'woo-rfq-for-woocommerce')
                                ),
                                'desc' => "<br />" . __('Some Hosting providers do not allow PHP sessions.<br />
                                 If there is a problem with items showing in the quote request page,<br /> changing the session method could help.', 'woo-rfq-for-woocommerce'),
                                'default' => 'rfq_cookie',
                                'id' => 'settings_gpls_woo_rfq_cookie_or_phpsession')
                        ,

                            'settings_gpls_woo_rfq_cookie_prepend' => array(
                                'name' => __('Cookie Name Starting Characters', 'woo-rfq-for-woocommerce'),
                                'type' => 'text',
                                'desc' => __('Some caching platforms use this to avoid caching cookies.', 'woo-rfq-for-woocommerce'),
                                'default' => '',
                                'id' => 'settings_gpls_woo_rfq_cookie_prepend',
                                'css' => 'width:400px'
                            ),
                            'settings_gpls_woo_rfq_cookie_days_keep' => array(
                                'name' => __('Days to keep items in quote cart(greater than 0)', 'woo-rfq-for-woocommerce'),
                                'type' => 'number',
                                'custom_attributes' => array(
                                    'step' => '1',
                                    'min' => '1',
                                ),
                                'desc' => __('Number of days to keep items in the quote cart.<br /> Should be greater than 0.  Default is 1 day(24 hours). <br />
                                Increase this if you want to keep items in the quote cart longer.<br /> Larger numbers take up more room in the database', 'woo-rfq-for-woocommerce'),
                                'default' => 30,
                                'id' => 'settings_gpls_woo_rfq_cookie_days_keep',
                                'css' => 'width:400px'
                            ),
                            'general_section_end34451441' => array(
                                'type' => 'sectionend',
                                'id' => 'general_section_end34451441'
                            ),


                        );
                    break;

                case 'add-to-quote':
                    $settings =

                        array(
                            'rfq_cart_short_redirect_title' => array(
                                'name' => __('Add to Quote Button', 'woo-rfq-for-woocommerce'),
                                'type' => 'title',
                                'desc' => '',
                                'id' => 'rfq_cart_short_redirect_title',
                                'css' => 'width:600px'
                            ),
                            'settings_gpls_woo_rfq_normal_checkout_quote_position' => array(
                                'name' => __('Choose the position of "add to quote" in the shop and archive', 'woo-rfq-for-woocommerce'),
                                'type' => 'select',
                                'options' => array(
                                    'woocommerce_after_shop_loop_item' => __('At the bottom', 'woo-rfq-for-woocommerce'),
                                    'woocommerce_before_shop_loop_item' => __('At the top', 'woo-rfq-for-woocommerce'),
                                    'woocommerce_before_shop_loop_item_title' => __('Before the title', 'woo-rfq-for-woocommerce'),
                                    'woocommerce_shop_loop_item_title' => __('After title', 'woo-rfq-for-woocommerce')
                                ),
                                'desc' => "<br />" . __('Default position is at the bottom.".', 'woo-rfq-for-woocommerce'),
                                'default' => 'woocommerce_after_shop_loop_item',
                                'id' => 'settings_gpls_woo_rfq_normal_checkout_quote_position'),


                          /*  'settings_gpls_woo_rfq_allow_zero_variable' => array(
                                'name' => __('Allow variable products with blank prices to be added to cart for quote requests', 'woo-rfq-for-woocommerce'),
                                'type' => 'checkbox',
                                'desc' => '<br /><b>This might not work with some product option builders.<br /> Please test after checking this option</b>',
                                'default' => 'no',
                                'id' => 'settings_gpls_woo_rfq_allow_zero_variable'
                            ),*/

                            'rfq_cart_sc_redirect_title_end245' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_sc_redirect_title_end245'
                            ),
                        );
                    break;

                case 'npoptions':
                    $settings =

                        array(

                            'rfq_cart_sc_section_title' => array(
                                'name' => '',
                                'type' => 'title',
                                'desc' => '',
                                'id' => 'rfq_cart_sc_section_title',
                                'css' => 'width:600px'
                            ),

                            'rfq_cart_sc_section_more_options' => array(
                                'name' => '',
                                'type' => 'gpls_woo_options',
                                'id' => 'rfq_cart_sc_section_more_options',


                            ),

                            'rfq_cart_sc_section_title_end' => array(
                                'type' => 'sectionend',
                                'id' => 'rfq_cart_sc_section_title_end'
                            ),

                        );
                    break;


            }

            $settings = apply_filters('wc_settings_gpls_woo_rfq_settings', $settings, $section);

            return $settings;

        }


        public function ad_filter_menu($sorted_menu_objects, $args)
        {

            if ($args->theme_location != 'primary')
                return $sorted_menu_objects;


            foreach ($sorted_menu_objects as $key => $menu_object) {


                $rfq_page = pls_woo_rfq_get_link_to_rfq();
                if ($menu_object->title == $rfq_page) {
                    unset($sorted_menu_objects[$key]);
                    break;
                }
            }

            return $sorted_menu_objects;
        }


        public function get_page_by_name($pagename)
        {
            if (get_page_by_title($pagename)) return true;

            return false;
        }


    }

}

if (!isset($GLOBALS["GPLS_Woo_RFQ_Settings"])) {

    $GLOBALS["GPLS_Woo_RFQ_Settings"] = new GPLS_Woo_RFQ_Settings();
}

return $GLOBALS["GPLS_Woo_RFQ_Settings"];


?>
