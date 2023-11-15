<?php

/**
 * The admin-specific functionality of the plugin.
 * @link       http://javmah.tk
 * @since      1.0.0
 * @package    Wootrello
 * @subpackage Wootrello/admin
 * @author     javmah <jaedmah@gmail.com>
*/
class Wootrello_Settings
{
    /**
     * The ID of this plugin.
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private  $plugin_name ;
    /**
     * The version of this plugin.
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $version ;
    /**
     * The version of this plugin.
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private  $active_plugins = array() ;
    /**
     * WooCommerce Order statuses .
     * @since    1.0.0
     * @access   private
     * @var      string    $key    trello Application key of this plugin.
     */
    private  $order_statuses = array(
        'new_order' => 'New checkout page order',
    ) ;
    /**
     * trello Application key of this plugin.
     * @since    1.0.0
     * @access   private
     * @var      string    $key    trello Application key of this plugin.
     */
    private  $key = '7385fea630899510fd036b6e89b90c60' ;
    /**
     * Initialize the class and set its properties.
     * @since      1.0.0
     * @param      string    $plugin_name   The name of this plugin.
     * @param      string    $version    	The version of this plugin.
     */
    public function __construct( $plugin_name, $version )
    {
        # plugin name
        $this->plugin_name = $plugin_name;
        # Plugin version
        $this->version = $version;
        # Active plugins
        $this->active_plugins = get_option( 'active_plugins' );
    }
    
    /**
     * This Function will create Custom post type for saving wpgsi integration and  save wpgsi_ log
     * @since    1.0.0
     */
    public function wootrello_CustomPostType()
    {
        register_post_type( 'wootrello' );
    }
    
    /**
     * Register the stylesheets for the admin area.
     * @since    1.0.0
     */
    public function settings_enqueue_styles( $hook )
    {
        # Load only WooTrello   ***  important it will stop cross Plugin contamination
        
        if ( get_current_screen()->id == $hook ) {
            # Plugin CSS link from include folder
            wp_enqueue_style(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'css/wootrello-admin.css',
                array(),
                $this->version,
                'all'
            );
            # Multi select CSS file
            wp_enqueue_style(
                'cssForSelect',
                plugin_dir_url( __FILE__ ) . 'css/multiselect.css',
                array(),
                $this->version,
                'all'
            );
        }
        
        # freemius ends
    }
    
    /**
     * Register the JavaScript for the admin area.
     * @since    1.0.0
     */
    public function settings_enqueue_scripts( $hook )
    {
        # Load only WooTrello only TWO Page OR Admin & Order Edit *** important it will stop cross Plugin contamination
        
        if ( get_current_screen()->id == $hook or get_current_screen()->id == 'shop_order' ) {
            # Multi Select JS File
            wp_enqueue_script(
                'multiSelectMin',
                plugin_dir_url( __FILE__ ) . 'js/multiselect.min.js',
                array( 'jquery' ),
                $this->version,
                TRUE
            );
            # Default Plugin Scripts
            wp_enqueue_script(
                $this->plugin_name,
                plugin_dir_url( __FILE__ ) . 'js/wootrello.js',
                array( 'jquery', 'multiSelectMin' ),
                $this->version,
                TRUE
            );
            $wootrello_data = array(
                'wootrelloAjaxURL' => admin_url( 'admin-ajax.php' ),
                'currentPageID'    => get_current_screen()->id,
                'orderID'          => ( isset( $_GET['post'] ) ? $_GET['post'] : FALSE ),
                'security'         => wp_create_nonce( 'wootrello-ajax-nonce' ),
            );
            # Passing Data to the Script
            wp_localize_script( $this->plugin_name, 'wootrello_data', $wootrello_data );
        }
    
    }
    
    /**
     * Menu page.
     * @since    1.0.0
     */
    public function Wootrello_menu_pages( $value = '' )
    {
        add_menu_page(
            __( 'WooTrello', 'wootrello' ),
            __( 'WooTrello', 'wootrello' ),
            'manage_options',
            'wootrello',
            array( $this, 'Wootrello_settings_view' ),
            'dashicons-upload'
        );
    }
    
    /**
     * Menu view Page, URL Router , Log view function , log delete function 
     * This is one of the Most Important function; 
     * @since    2.0.0
     */
    public function Wootrello_settings_view( $value = '' )
    {
        # WooTrello Log Status
        $wootrelloLogStatus = get_option( "wootrelloLogStatus" );
        # Wootrello Enable or Disable Logs
        
        if ( isset( $_GET['action'] ) and $_GET['action'] == 'logStatus' ) {
            
            if ( $wootrelloLogStatus == 'Enable' ) {
                update_option( "wootrelloLogStatus", "Disable" );
            } else {
                update_option( "wootrelloLogStatus", "Enable" );
            }
            
            # Then redirect to the Log page Admin with Different URL
            wp_redirect( admin_url( 'admin.php?page=wootrello&action=log' ) );
            exit;
        }
        
        # if delete log is set than Delete tha Logs
        
        if ( isset( $_GET['action'] ) and $_GET['action'] == 'deleteLog' ) {
            # Delete the logs
            $wootrello_log = get_posts( array(
                'post_type'      => 'wootrello_log',
                'posts_per_page' => -1,
            ) );
            # Counting Current log
            foreach ( $wootrello_log as $key => $log ) {
                wp_delete_post( $log->ID, TRUE );
            }
            # Then redirect to the Log page Admin with Different URL
            wp_redirect( admin_url( 'admin.php?page=wootrello&action=log' ) );
            exit;
        }
        
        # Remove all integrations
        
        if ( isset( $_GET['action'] ) and $_GET['action'] == 'removeInt' ) {
            # getting integrations
            $wootrello_integrations = get_posts( array(
                'post_type'      => 'wootrello',
                'posts_per_page' => -1,
            ) );
            # Counting Current log
            foreach ( $wootrello_integrations as $key => $log ) {
                wp_delete_post( $log->ID, TRUE );
            }
            # Then redirect to the Log page Admin with Different URL
            wp_redirect( admin_url( 'admin.php?page=wootrello' ) );
            exit;
        }
        
        # This Page will Lord Depends on User Request;
        
        if ( isset( $_GET['action'] ) and $_GET['action'] == 'log' ) {
            # For Log Page
            ?>
				<div class="wrap">
					<h1 class="wp-heading-inline"> Wootrello Log Page 
						<code>last 100 log </code> 
						<?php 
            
            if ( $wootrelloLogStatus == 'Enable' ) {
                echo  " <code><a href='" . admin_url( 'admin.php?page=wootrello&action=logStatus' ) . "' style='opacity: 0.5; color: red;'  >Disable log!</a></code> " ;
            } else {
                echo  " <code><a href='" . admin_url( 'admin.php?page=wootrello&action=logStatus' ) . "' style='opacity: 0.5; color: green;'  >Enable log</a></code> " ;
            }
            
            ?>
						<code><a style="opacity: 0.5; color: red;" href="<?php 
            echo  admin_url( 'admin.php?page=wootrello&action=deleteLog' ) ;
            ?>">remove logs</a></code> 
					</h1>
					<?php 
            if ( $wootrelloLogStatus == 'Disable' ) {
                echo  "<h3 style='color:red;' > <span class='dashicons dashicons-dismiss'></span> Log is Disabled ! </h3>" ;
            }
            $wootrello_log = get_posts( array(
                'post_type'      => 'wootrello_log',
                'order'          => 'DESC',
                'posts_per_page' => -1,
            ) );
            $i = 1;
            foreach ( $wootrello_log as $key => $log ) {
                
                if ( $log->post_title == 200 ) {
                    echo  "<div class='notice notice-success inline'>" ;
                } else {
                    echo  "<div class='notice notice-error inline'>" ;
                }
                
                echo  "<p><span class='automail-circle'>" . $log->ID ;
                echo  " .</span>" ;
                echo  "<code>" . $log->post_title . "</code>" ;
                echo  "<code>" ;
                if ( isset( $log->post_excerpt ) ) {
                    echo  $log->post_excerpt ;
                }
                echo  "</code>" ;
                echo  $log->post_content ;
                echo  " <code>" . $log->post_date . "</code>" ;
                echo  "</p>" ;
                echo  "</div>" ;
                $i++;
            }
            ?>
				</div>
			<?php 
        } else {
            # if POST to Log include the Log Page
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wootrello-settings-display.php';
        }
        
        # Delete log after 100; starts
        $wootrello_log = get_posts( array(
            'post_type'      => 'wootrello_log',
            'posts_per_page' => -1,
        ) );
        # Counting Current log
        if ( count( $wootrello_log ) > 100 ) {
            foreach ( $wootrello_log as $key => $log ) {
                if ( $key > 100 ) {
                    wp_delete_post( $log->ID, TRUE );
                }
            }
        }
        # Delete log after 100; ends
    }
    
    /**
     * Admin notice function;
     * @since    1.0.0
     */
    public function wootrello_settings_notice()
    {
        if ( isset( get_current_screen()->base ) and get_current_screen()->base == 'toplevel_page_wootrello' ) {
            
            if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', $this->active_plugins ) ) ) {
                echo  "<div class='notice notice-error'>" ;
                echo  " <p> <b> <a style='text-decoration: none;' href='https://wordpress.org/plugins/woocommerce'> WooCommerce </a> </b> is not Activate, <a style='text-decoration: none;' href='https://wordpress.org/plugins/wootrello'> WooTrello </a> is for connecting  Woocommerce with Trello ! </p>" ;
                echo  "</div>" ;
                # ERROR log
                $this->wootrello_log( 'wootrello_settings_notice', 701, 'ERROR: woocommerce is not installed.' );
            }
        
        }
        # testing is in Here
        // echo"<pre>";
        // echo"</pre>";
    }
    
    /**
     * Getting WooCommerce Order Meta Keys 
     * This is a Mysql Query 
     * @since    3.1.0
     */
    public function wootrello_wooCommerce_order_metaKeys()
    {
        # Global Db object
        global  $wpdb ;
        # Query
        $query = "\r\n\t\t\tSELECT DISTINCT({$wpdb->postmeta}.meta_key) \r\n\t\t\tFROM {$wpdb->posts} \r\n\t\t\tLEFT JOIN {$wpdb->postmeta} \r\n\t\t\tON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id \r\n\t\t\tWHERE {$wpdb->posts}.post_type = 'shop_order' \r\n\t\t\tAND {$wpdb->postmeta}.meta_key != '' \r\n\t\t";
        # execute Query
        $meta_keys = $wpdb->get_col( $query );
        # return Depend on the Query result
        
        if ( empty($meta_keys) ) {
            return array( FALSE, 'Empty ! No Meta key exist of the Post type X' );
        } else {
            return array( TRUE, $meta_keys );
        }
    
    }
    
    /**
     * getting Open Boards
     * @since    2.0.0s
     */
    public function wootrello_trello_boards( $token = '' )
    {
        # is there a Token ?
        if ( empty($token) ) {
            return array( 0, "ERROR: Empty trello token" );
        }
        # Constructed URL
        $url = 'https://api.trello.com/1/members/me/boards?&filter=open&key=' . $this->key . '&token=' . $token . '';
        # Remote request
        $trello_returns = wp_remote_get( $url, array() );
        # Boards Holder
        $boards = array();
        # Check & Balance
        
        if ( !is_wp_error( $trello_returns ) and isset( $trello_returns['response']['code'], $trello_returns['body'] ) and $trello_returns['response']['code'] == 200 ) {
            foreach ( json_decode( $trello_returns['body'], TRUE ) as $key => $value ) {
                $boards[$value['id']] = $value['name'];
            }
            # # return array with two value first one is Bool and second one is data array about boards
            return array( $trello_returns['response']['code'], $boards );
        } else {
            # ERROR Log
            $this->wootrello_log( 'wootrello_trello_boards', 702, 'ERROR: ' . json_encode( $trello_returns, TRUE ) );
            # return two thing First one is Bool and second one is Empty []
            return array( 410, array() );
        }
    
    }
    
    /**
     * Getting Lists calling func
     * @since    2.0.0
     */
    public function wootrello_board_lists( $token = '', $board_id = '', $callingFunc = '' )
    {
        if ( empty($token) or empty($board_id) ) {
            return array( 420, 'ERROR: Token or Board id is Empty!' );
        }
        # URL
        $url = 'https://api.trello.com/1/boards/' . $board_id . '/lists?filter=open&key=' . $this->key . '&token=' . $token . '';
        # Remote request
        $trello_returns = wp_remote_get( $url, array() );
        $lists = array();
        # Check and Balance
        
        if ( isset( $trello_returns['response']['code'], $trello_returns['body'] ) and $trello_returns['response']['code'] == 200 ) {
            foreach ( json_decode( $trello_returns['body'], TRUE ) as $key => $value ) {
                $lists[$value['id']] = $value['name'];
            }
        } else {
            # ERROR Log
            $this->wootrello_log( 'wootrello_board_lists >> ' . $callingFunc, 703, 'ERROR: ' . json_encode( $trello_returns, TRUE ) );
        }
        
        # return array with two value first one is Bool and second one is data array about board's list
        return array( $trello_returns['response']['code'], $lists );
    }
    
    /**
     * WooCommerce Order  HOOK's callback function
     * woocommerce_order_status_changed hook callback function 
     * @since    1.0.0
     * @param     int     $order_id     Order ID
     */
    public function wootrello_woocommerce_order_status_changed( $order_id, $this_status_transition_from, $this_status_transition_to )
    {
        # Getting Order Details by Order ID
        $order = wc_get_order( $order_id );
        # Order Data Holder;
        $order_data = array();
        $order_data['orderID'] = ( (method_exists( $order, 'get_id' ) and is_int( $order->get_id() )) ? $order->get_id() : "" );
        $order_data['cart_tax'] = ( (method_exists( $order, 'get_cart_tax' ) and is_string( $order->get_cart_tax() )) ? $order->get_cart_tax() : "" );
        $order_data['currency'] = ( (method_exists( $order, 'get_currency' ) and is_string( $order->get_currency() )) ? $order->get_currency() : "" );
        $order_data['discount_tax'] = ( (method_exists( $order, 'get_discount_tax' ) and is_string( $order->get_discount_tax() )) ? $order->get_discount_tax() : "" );
        $order_data['discount_total'] = ( (method_exists( $order, 'get_discount_total' ) and is_string( $order->get_discount_total() )) ? $order->get_discount_total() : "" );
        $order_data['fees'] = ( (method_exists( $order, 'get_fees' ) and !empty($order->get_fees()) and is_array( $order->get_fees() )) ? json_encode( $order->get_fees() ) : "" );
        $order_data['shipping_method'] = ( (method_exists( $order, 'get_shipping_method' ) and is_string( $order->get_shipping_method() )) ? $order->get_shipping_method() : "" );
        $order_data['shipping_tax'] = ( (method_exists( $order, 'get_shipping_tax' ) and is_string( $order->get_shipping_tax() )) ? $order->get_shipping_tax() : "" );
        $order_data['shipping_total'] = ( (method_exists( $order, 'get_shipping_total' ) and is_string( $order->get_shipping_total() )) ? $order->get_shipping_total() : "" );
        $order_data['subtotal'] = ( (method_exists( $order, 'get_subtotal' ) and is_float( $order->get_subtotal() )) ? $order->get_subtotal() : "" );
        $order_data['subtotal_to_display'] = ( (method_exists( $order, 'get_subtotal_to_display' ) and is_string( $order->get_subtotal_to_display() )) ? $order->get_subtotal_to_display() : "" );
        $order_data['tax_totals'] = ( (method_exists( $order, 'get_tax_totals' ) and !empty($order->get_tax_totals()) and is_array( $order->get_tax_totals() )) ? json_encode( $order->get_tax_totals() ) : "" );
        $order_data['taxes'] = ( (method_exists( $order, 'get_taxes' ) and !empty($order->get_taxes()) and is_array( $order->get_taxes() )) ? json_encode( $order->get_taxes() ) : "" );
        $order_data['total'] = ( (method_exists( $order, 'get_total' ) and is_string( $order->get_total() )) ? $order->get_total() : "" );
        $order_data['total_discount'] = ( (method_exists( $order, 'get_total_discount' ) and is_float( $order->get_total_discount() )) ? $order->get_total_discount() : "" );
        $order_data['total_tax'] = ( (method_exists( $order, 'get_total_tax' ) and is_string( $order->get_total_tax() )) ? $order->get_total_tax() : "" );
        $order_data['total_refunded'] = ( (method_exists( $order, 'get_total_refunded' ) and is_float( $order->get_total_refunded() )) ? $order->get_total_refunded() : "" );
        $order_data['total_tax_refunded'] = ( (method_exists( $order, 'get_total_tax_refunded' ) and is_int( $order->get_total_tax_refunded() )) ? $order->get_total_tax_refunded() : "" );
        $order_data['total_shipping_refunded'] = ( (method_exists( $order, 'get_total_shipping_refunded' ) and is_int( $order->get_total_shipping_refunded() )) ? $order->get_total_shipping_refunded() : "" );
        $order_data['item_count_refunded'] = ( (method_exists( $order, 'get_item_count_refunded' ) and is_int( $order->get_item_count_refunded() )) ? $order->get_item_count_refunded() : "" );
        $order_data['total_qty_refunded'] = ( (method_exists( $order, 'get_total_qty_refunded' ) and is_int( $order->get_total_qty_refunded() )) ? $order->get_total_qty_refunded() : "" );
        $order_data['remaining_refund_amount'] = ( (method_exists( $order, 'get_remaining_refund_amount' ) and is_string( $order->get_remaining_refund_amount() )) ? $order->get_remaining_refund_amount() : "" );
        # Order Item process Starts
        
        if ( is_array( $order->get_items() ) ) {
            $items = array();
            $cart_items_weight = array();
            foreach ( $order->get_items() as $item_id => $item_data ) {
                $items[$item_id]['product_id'] = ( (method_exists( $item_data, "get_product_id" ) and is_int( $item_data->get_product_id() )) ? $item_data->get_product_id() : "" );
                $items[$item_id]['variation_id'] = ( (method_exists( $item_data, "get_variation_id" ) and is_int( $item_data->get_variation_id() )) ? $item_data->get_variation_id() : "" );
                $items[$item_id]['product_sku'] = ( empty($items[$item_id]['variation_id']) ? get_post_meta( $items[$item_id]['product_id'], '_sku', true ) : get_post_meta( $items[$item_id]['variation_id'], '_sku', true ) );
                $items[$item_id]['product_name'] = ( (method_exists( $item_data, "get_name" ) and is_string( $item_data->get_name() )) ? $item_data->get_name() : "" );
                $items[$item_id]['qty'] = ( (method_exists( $item_data, "get_quantity" ) and is_int( $item_data->get_quantity() )) ? $item_data->get_quantity() : "" );
                $items[$item_id]['product_qty_price'] = ( (method_exists( $item_data, "get_total" ) and is_string( $item_data->get_total() )) ? $item_data->get_total() : "" );
                $items[$item_id]['product_weight'] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
                # getting total weight
                $cart_items_weight[] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
            }
        }
        
        # Order Item process Ends
        $order_data['items'] = ( $items ? $items : "" );
        $order_data['cart_items_weight'] = array_sum( $cart_items_weight );
        $order_data['item_count'] = ( (method_exists( $order, 'get_item_count' ) and is_int( $order->get_item_count() )) ? $order->get_item_count() : "" );
        $order_data['downloadable_items'] = ( (method_exists( $order, 'get_downloadable_items' ) and !empty($order->get_downloadable_items()) and is_array( $order->get_downloadable_items() )) ? json_encode( $order->get_downloadable_items() ) : "" );
        // Need To Change
        #
        $order_data['date_created'] = ( (method_exists( $order, 'get_date_created' ) and !empty($order->get_date_created()) and is_string( $order->get_date_created()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_created()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_modified'] = ( (method_exists( $order, 'get_date_modified' ) and !empty($order->get_date_modified()) and is_string( $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_completed'] = ( (method_exists( $order, 'get_date_completed' ) and !empty($order->get_date_completed()) and is_string( $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_paid'] = ( (method_exists( $order, 'get_date_paid' ) and !empty($order->get_date_paid()) and is_string( $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) : "" );
        #
        $order_data['user'] = ( (method_exists( $order, 'get_user' ) and !empty($order->get_user()) and is_object( $order->get_user() )) ? $order->get_user()->user_login . " - " . $order->get_user()->user_email : "" );
        $order_data['customer_id'] = ( (method_exists( $order, 'get_customer_id' ) and is_int( $order->get_customer_id() )) ? $order->get_customer_id() : "" );
        $order_data['user_id'] = ( (method_exists( $order, 'get_user_id' ) and is_int( $order->get_user_id() )) ? $order->get_user_id() : "" );
        $order_data['customer_ip_address'] = ( (method_exists( $order, 'get_customer_ip_address' ) and is_string( $order->get_customer_ip_address() )) ? $order->get_customer_ip_address() : "" );
        $order_data['customer_user_agent'] = ( (method_exists( $order, 'get_customer_user_agent' ) and is_string( $order->get_customer_user_agent() )) ? $order->get_customer_user_agent() : "" );
        $order_data['created_via'] = ( (method_exists( $order, 'get_created_via' ) and is_string( $order->get_created_via() )) ? $order->get_created_via() : "" );
        $order_data['customer_note'] = ( (method_exists( $order, 'get_customer_note' ) and is_string( $order->get_customer_note() )) ? $order->get_customer_note() : "" );
        $order_data['billing_first_name'] = ( (method_exists( $order, 'get_billing_first_name' ) and is_string( $order->get_billing_first_name() )) ? $order->get_billing_first_name() : "" );
        $order_data['billing_last_name'] = ( (method_exists( $order, 'get_billing_last_name' ) and is_string( $order->get_billing_last_name() )) ? $order->get_billing_last_name() : "" );
        $order_data['billing_company'] = ( (method_exists( $order, 'get_billing_company' ) and is_string( $order->get_billing_company() )) ? $order->get_billing_company() : "" );
        $order_data['billing_address_1'] = ( (method_exists( $order, 'get_billing_address_1' ) and is_string( $order->get_billing_address_1() )) ? $order->get_billing_address_1() : "" );
        $order_data['billing_address_2'] = ( (method_exists( $order, 'get_billing_address_2' ) and is_string( $order->get_billing_address_2() )) ? $order->get_billing_address_2() : "" );
        $order_data['billing_city'] = ( (method_exists( $order, 'get_billing_city' ) and is_string( $order->get_billing_city() )) ? $order->get_billing_city() : "" );
        $order_data['billing_state'] = ( (method_exists( $order, 'get_billing_state' ) and is_string( $order->get_billing_state() )) ? $order->get_billing_state() : "" );
        $order_data['billing_postcode'] = ( (method_exists( $order, 'get_billing_postcode' ) and is_string( $order->get_billing_postcode() )) ? $order->get_billing_postcode() : "" );
        $order_data['billing_country'] = ( (method_exists( $order, 'get_billing_country' ) and is_string( $order->get_billing_country() )) ? $order->get_billing_country() : "" );
        $order_data['billing_email'] = ( (method_exists( $order, 'get_billing_email' ) and is_string( $order->get_billing_email() )) ? $order->get_billing_email() : "" );
        $order_data['billing_phone'] = ( (method_exists( $order, 'get_billing_phone' ) and is_string( $order->get_billing_phone() )) ? $order->get_billing_phone() : "" );
        $order_data['shipping_first_name'] = ( (method_exists( $order, 'get_shipping_first_name' ) and is_string( $order->get_shipping_first_name() )) ? $order->get_shipping_first_name() : "" );
        $order_data['shipping_last_name'] = ( (method_exists( $order, 'get_shipping_last_name' ) and is_string( $order->get_shipping_last_name() )) ? $order->get_shipping_last_name() : "" );
        $order_data['shipping_company'] = ( (method_exists( $order, 'get_shipping_company' ) and is_string( $order->get_shipping_company() )) ? $order->get_shipping_company() : "" );
        $order_data['shipping_address_1'] = ( (method_exists( $order, 'get_shipping_address_1' ) and is_string( $order->get_shipping_address_1() )) ? $order->get_shipping_address_1() : "" );
        $order_data['shipping_address_2'] = ( (method_exists( $order, 'get_shipping_address_2' ) and is_string( $order->get_shipping_address_2() )) ? $order->get_shipping_address_2() : "" );
        $order_data['shipping_city'] = ( (method_exists( $order, 'get_shipping_city' ) and is_string( $order->get_shipping_city() )) ? $order->get_shipping_city() : "" );
        $order_data['shipping_state'] = ( (method_exists( $order, 'get_shipping_state' ) and is_string( $order->get_shipping_state() )) ? $order->get_shipping_state() : "" );
        $order_data['shipping_postcode'] = ( (method_exists( $order, 'get_shipping_postcode' ) and is_string( $order->get_shipping_postcode() )) ? $order->get_shipping_postcode() : "" );
        $order_data['shipping_country'] = ( (method_exists( $order, 'get_shipping_country' ) and is_string( $order->get_shipping_country() )) ? $order->get_shipping_country() : "" );
        $order_data['address'] = ( (method_exists( $order, 'get_address' ) and is_array( $order->get_address() )) ? json_encode( $order->get_address() ) : "" );
        $order_data['shipping_address_map_url'] = ( (method_exists( $order, 'get_shipping_address_map_url' ) and is_string( $order->get_shipping_address_map_url() )) ? $order->get_shipping_address_map_url() : "" );
        $order_data['formatted_billing_full_name'] = ( (method_exists( $order, 'get_formatted_billing_full_name' ) and is_string( $order->get_formatted_billing_full_name() )) ? $order->get_formatted_billing_full_name() : "" );
        $order_data['formatted_shipping_full_name'] = ( (method_exists( $order, 'get_formatted_shipping_full_name' ) and is_string( $order->get_formatted_shipping_full_name() )) ? $order->get_formatted_shipping_full_name() : "" );
        $order_data['formatted_billing_address'] = ( (method_exists( $order, 'get_formatted_billing_address' ) and is_string( $order->get_formatted_billing_address() )) ? $order->get_formatted_billing_address() : "" );
        $order_data['formatted_shipping_address'] = ( (method_exists( $order, 'get_formatted_shipping_address' ) and is_string( $order->get_formatted_shipping_address() )) ? $order->get_formatted_shipping_address() : "" );
        #
        $order_data['payment_method'] = ( (method_exists( $order, 'get_payment_method' ) and is_string( $order->get_payment_method() )) ? $order->get_payment_method() : "" );
        $order_data['payment_method_title'] = ( (method_exists( $order, 'get_payment_method_title' ) and is_string( $order->get_payment_method_title() )) ? $order->get_payment_method_title() : "" );
        $order_data['transaction_id'] = ( (method_exists( $order, 'get_transaction_id' ) and is_string( $order->get_transaction_id() )) ? $order->get_transaction_id() : "" );
        #
        $order_data['checkout_payment_url'] = ( (method_exists( $order, 'get_checkout_payment_url' ) and is_string( $order->get_checkout_payment_url() )) ? $order->get_checkout_payment_url() : "" );
        $order_data['checkout_order_received_url'] = ( (method_exists( $order, 'get_checkout_order_received_url' ) and is_string( $order->get_checkout_order_received_url() )) ? $order->get_checkout_order_received_url() : "" );
        $order_data['cancel_order_url'] = ( (method_exists( $order, 'get_cancel_order_url' ) and is_string( $order->get_cancel_order_url() )) ? $order->get_cancel_order_url() : "" );
        $order_data['cancel_order_url_raw'] = ( (method_exists( $order, 'get_cancel_order_url_raw' ) and is_string( $order->get_cancel_order_url_raw() )) ? $order->get_cancel_order_url_raw() : "" );
        $order_data['cancel_endpoint'] = ( (method_exists( $order, 'get_cancel_endpoint' ) and is_string( $order->get_cancel_endpoint() )) ? $order->get_cancel_endpoint() : "" );
        $order_data['view_order_url'] = ( (method_exists( $order, 'get_view_order_url' ) and is_string( $order->get_view_order_url() )) ? $order->get_view_order_url() : "" );
        $order_data['edit_order_url'] = ( (method_exists( $order, 'get_edit_order_url' ) and is_string( $order->get_edit_order_url() )) ? $order->get_edit_order_url() : "" );
        #
        $order_data['status'] = ( empty($this_status_transition_to) ? $order->get_status() : $this_status_transition_to );
        
        if ( $order_id ) {
            $r = $this->wootrello_create_trello_card( $this_status_transition_to, $order_data );
            return $r;
        }
    
    }
    
    /**
     * woocommerce_new_orders New Order  HOOK's callback function
     * I'M USE THIS FOR ADMIN FRONT -> woocommerce_thankyou HOOK for FRONT END
     * @since     1.0.0
     * @param     int     $order_id     Order ID
     */
    public function wootrello_woocommerce_new_order_admin( $order_id )
    {
        # Getting Order Details by Order ID
        $order = wc_get_order( $order_id );
        # if not admin returns
        if ( $order->get_created_via() != 'admin' ) {
            return;
        }
        # Order Data Holder;
        $order_data = array();
        $order_data['orderID'] = ( (method_exists( $order, 'get_id' ) and is_int( $order->get_id() )) ? $order->get_id() : "" );
        $order_data['cart_tax'] = ( (method_exists( $order, 'get_cart_tax' ) and is_string( $order->get_cart_tax() )) ? $order->get_cart_tax() : "" );
        $order_data['currency'] = ( (method_exists( $order, 'get_currency' ) and is_string( $order->get_currency() )) ? $order->get_currency() : "" );
        $order_data['discount_tax'] = ( (method_exists( $order, 'get_discount_tax' ) and is_string( $order->get_discount_tax() )) ? $order->get_discount_tax() : "" );
        $order_data['discount_total'] = ( (method_exists( $order, 'get_discount_total' ) and is_string( $order->get_discount_total() )) ? $order->get_discount_total() : "" );
        $order_data['fees'] = ( (method_exists( $order, 'get_fees' ) and !empty($order->get_fees()) and is_array( $order->get_fees() )) ? json_encode( $order->get_fees() ) : "" );
        $order_data['shipping_method'] = ( (method_exists( $order, 'get_shipping_method' ) and is_string( $order->get_shipping_method() )) ? $order->get_shipping_method() : "" );
        $order_data['shipping_tax'] = ( (method_exists( $order, 'get_shipping_tax' ) and is_string( $order->get_shipping_tax() )) ? $order->get_shipping_tax() : "" );
        $order_data['shipping_total'] = ( (method_exists( $order, 'get_shipping_total' ) and is_string( $order->get_shipping_total() )) ? $order->get_shipping_total() : "" );
        $order_data['subtotal'] = ( (method_exists( $order, 'get_subtotal' ) and is_float( $order->get_subtotal() )) ? $order->get_subtotal() : "" );
        $order_data['subtotal_to_display'] = ( (method_exists( $order, 'get_subtotal_to_display' ) and is_string( $order->get_subtotal_to_display() )) ? $order->get_subtotal_to_display() : "" );
        $order_data['tax_totals'] = ( (method_exists( $order, 'get_tax_totals' ) and !empty($order->get_tax_totals()) and is_array( $order->get_tax_totals() )) ? json_encode( $order->get_tax_totals() ) : "" );
        $order_data['taxes'] = ( (method_exists( $order, 'get_taxes' ) and !empty($order->get_taxes()) and is_array( $order->get_taxes() )) ? json_encode( $order->get_taxes() ) : "" );
        $order_data['total'] = ( (method_exists( $order, 'get_total' ) and is_string( $order->get_total() )) ? $order->get_total() : "" );
        $order_data['total_discount'] = ( (method_exists( $order, 'get_total_discount' ) and is_float( $order->get_total_discount() )) ? $order->get_total_discount() : "" );
        $order_data['total_tax'] = ( (method_exists( $order, 'get_total_tax' ) and is_string( $order->get_total_tax() )) ? $order->get_total_tax() : "" );
        $order_data['total_refunded'] = ( (method_exists( $order, 'get_total_refunded' ) and is_float( $order->get_total_refunded() )) ? $order->get_total_refunded() : "" );
        $order_data['total_tax_refunded'] = ( (method_exists( $order, 'get_total_tax_refunded' ) and is_int( $order->get_total_tax_refunded() )) ? $order->get_total_tax_refunded() : "" );
        $order_data['total_shipping_refunded'] = ( (method_exists( $order, 'get_total_shipping_refunded' ) and is_int( $order->get_total_shipping_refunded() )) ? $order->get_total_shipping_refunded() : "" );
        $order_data['item_count_refunded'] = ( (method_exists( $order, 'get_item_count_refunded' ) and is_int( $order->get_item_count_refunded() )) ? $order->get_item_count_refunded() : "" );
        $order_data['total_qty_refunded'] = ( (method_exists( $order, 'get_total_qty_refunded' ) and is_int( $order->get_total_qty_refunded() )) ? $order->get_total_qty_refunded() : "" );
        $order_data['remaining_refund_amount'] = ( (method_exists( $order, 'get_remaining_refund_amount' ) and is_string( $order->get_remaining_refund_amount() )) ? $order->get_remaining_refund_amount() : "" );
        # Order Item process Starts
        
        if ( is_array( $order->get_items() ) ) {
            $items = array();
            $cart_items_weight = array();
            foreach ( $order->get_items() as $item_id => $item_data ) {
                $items[$item_id]['product_id'] = ( (method_exists( $item_data, "get_product_id" ) and is_int( $item_data->get_product_id() )) ? $item_data->get_product_id() : "" );
                $items[$item_id]['variation_id'] = ( (method_exists( $item_data, "get_variation_id" ) and is_int( $item_data->get_variation_id() )) ? $item_data->get_variation_id() : "" );
                $items[$item_id]['product_sku'] = ( empty($items[$item_id]['variation_id']) ? get_post_meta( $items[$item_id]['product_id'], '_sku', true ) : get_post_meta( $items[$item_id]['variation_id'], '_sku', true ) );
                $items[$item_id]['product_name'] = ( (method_exists( $item_data, "get_name" ) and is_string( $item_data->get_name() )) ? $item_data->get_name() : "" );
                $items[$item_id]['qty'] = ( (method_exists( $item_data, "get_quantity" ) and is_int( $item_data->get_quantity() )) ? $item_data->get_quantity() : "" );
                $items[$item_id]['product_qty_price'] = ( (method_exists( $item_data, "get_total" ) and is_string( $item_data->get_total() )) ? $item_data->get_total() : "" );
                $items[$item_id]['product_weight'] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
                # getting total weight
                $cart_items_weight[] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
            }
        }
        
        # Order Item process Ends
        $order_data['items'] = ( $items ? $items : "" );
        $order_data['cart_items_weight'] = array_sum( $cart_items_weight );
        $order_data['item_count'] = ( (method_exists( $order, 'get_item_count' ) and is_int( $order->get_item_count() )) ? $order->get_item_count() : "" );
        $order_data['downloadable_items'] = ( (method_exists( $order, 'get_downloadable_items' ) and !empty($order->get_downloadable_items()) and is_array( $order->get_downloadable_items() )) ? json_encode( $order->get_downloadable_items() ) : "" );
        // Need To Change
        #
        $order_data['date_created'] = ( (method_exists( $order, 'get_date_created' ) and !empty($order->get_date_created()) and is_string( $order->get_date_created()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_created()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_modified'] = ( (method_exists( $order, 'get_date_modified' ) and !empty($order->get_date_modified()) and is_string( $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_completed'] = ( (method_exists( $order, 'get_date_completed' ) and !empty($order->get_date_completed()) and is_string( $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_paid'] = ( (method_exists( $order, 'get_date_paid' ) and !empty($order->get_date_paid()) and is_string( $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) : "" );
        #
        $order_data['user'] = ( (method_exists( $order, 'get_user' ) and !empty($order->get_user()) and is_object( $order->get_user() )) ? $order->get_user()->user_login . " - " . $order->get_user()->user_email : "" );
        $order_data['customer_id'] = ( (method_exists( $order, 'get_customer_id' ) and is_int( $order->get_customer_id() )) ? $order->get_customer_id() : "" );
        $order_data['user_id'] = ( (method_exists( $order, 'get_user_id' ) and is_int( $order->get_user_id() )) ? $order->get_user_id() : "" );
        $order_data['customer_ip_address'] = ( (method_exists( $order, 'get_customer_ip_address' ) and is_string( $order->get_customer_ip_address() )) ? $order->get_customer_ip_address() : "" );
        $order_data['customer_user_agent'] = ( (method_exists( $order, 'get_customer_user_agent' ) and is_string( $order->get_customer_user_agent() )) ? $order->get_customer_user_agent() : "" );
        $order_data['created_via'] = ( (method_exists( $order, 'get_created_via' ) and is_string( $order->get_created_via() )) ? $order->get_created_via() : "" );
        $order_data['customer_note'] = ( (method_exists( $order, 'get_customer_note' ) and is_string( $order->get_customer_note() )) ? $order->get_customer_note() : "" );
        $order_data['billing_first_name'] = ( (method_exists( $order, 'get_billing_first_name' ) and is_string( $order->get_billing_first_name() )) ? $order->get_billing_first_name() : "" );
        $order_data['billing_last_name'] = ( (method_exists( $order, 'get_billing_last_name' ) and is_string( $order->get_billing_last_name() )) ? $order->get_billing_last_name() : "" );
        $order_data['billing_company'] = ( (method_exists( $order, 'get_billing_company' ) and is_string( $order->get_billing_company() )) ? $order->get_billing_company() : "" );
        $order_data['billing_address_1'] = ( (method_exists( $order, 'get_billing_address_1' ) and is_string( $order->get_billing_address_1() )) ? $order->get_billing_address_1() : "" );
        $order_data['billing_address_2'] = ( (method_exists( $order, 'get_billing_address_2' ) and is_string( $order->get_billing_address_2() )) ? $order->get_billing_address_2() : "" );
        $order_data['billing_city'] = ( (method_exists( $order, 'get_billing_city' ) and is_string( $order->get_billing_city() )) ? $order->get_billing_city() : "" );
        $order_data['billing_state'] = ( (method_exists( $order, 'get_billing_state' ) and is_string( $order->get_billing_state() )) ? $order->get_billing_state() : "" );
        $order_data['billing_postcode'] = ( (method_exists( $order, 'get_billing_postcode' ) and is_string( $order->get_billing_postcode() )) ? $order->get_billing_postcode() : "" );
        $order_data['billing_country'] = ( (method_exists( $order, 'get_billing_country' ) and is_string( $order->get_billing_country() )) ? $order->get_billing_country() : "" );
        $order_data['billing_email'] = ( (method_exists( $order, 'get_billing_email' ) and is_string( $order->get_billing_email() )) ? $order->get_billing_email() : "" );
        $order_data['billing_phone'] = ( (method_exists( $order, 'get_billing_phone' ) and is_string( $order->get_billing_phone() )) ? $order->get_billing_phone() : "" );
        $order_data['shipping_first_name'] = ( (method_exists( $order, 'get_shipping_first_name' ) and is_string( $order->get_shipping_first_name() )) ? $order->get_shipping_first_name() : "" );
        $order_data['shipping_last_name'] = ( (method_exists( $order, 'get_shipping_last_name' ) and is_string( $order->get_shipping_last_name() )) ? $order->get_shipping_last_name() : "" );
        $order_data['shipping_company'] = ( (method_exists( $order, 'get_shipping_company' ) and is_string( $order->get_shipping_company() )) ? $order->get_shipping_company() : "" );
        $order_data['shipping_address_1'] = ( (method_exists( $order, 'get_shipping_address_1' ) and is_string( $order->get_shipping_address_1() )) ? $order->get_shipping_address_1() : "" );
        $order_data['shipping_address_2'] = ( (method_exists( $order, 'get_shipping_address_2' ) and is_string( $order->get_shipping_address_2() )) ? $order->get_shipping_address_2() : "" );
        $order_data['shipping_city'] = ( (method_exists( $order, 'get_shipping_city' ) and is_string( $order->get_shipping_city() )) ? $order->get_shipping_city() : "" );
        $order_data['shipping_state'] = ( (method_exists( $order, 'get_shipping_state' ) and is_string( $order->get_shipping_state() )) ? $order->get_shipping_state() : "" );
        $order_data['shipping_postcode'] = ( (method_exists( $order, 'get_shipping_postcode' ) and is_string( $order->get_shipping_postcode() )) ? $order->get_shipping_postcode() : "" );
        $order_data['shipping_country'] = ( (method_exists( $order, 'get_shipping_country' ) and is_string( $order->get_shipping_country() )) ? $order->get_shipping_country() : "" );
        $order_data['address'] = ( (method_exists( $order, 'get_address' ) and !empty($order->get_address()) and is_array( $order->get_address() )) ? json_encode( $order->get_address() ) : "" );
        $order_data['shipping_address_map_url'] = ( (method_exists( $order, 'get_shipping_address_map_url' ) and is_string( $order->get_shipping_address_map_url() )) ? $order->get_shipping_address_map_url() : "" );
        $order_data['formatted_billing_full_name'] = ( (method_exists( $order, 'get_formatted_billing_full_name' ) and is_string( $order->get_formatted_billing_full_name() )) ? $order->get_formatted_billing_full_name() : "" );
        $order_data['formatted_shipping_full_name'] = ( (method_exists( $order, 'get_formatted_shipping_full_name' ) and is_string( $order->get_formatted_shipping_full_name() )) ? $order->get_formatted_shipping_full_name() : "" );
        $order_data['formatted_billing_address'] = ( (method_exists( $order, 'get_formatted_billing_address' ) and is_string( $order->get_formatted_billing_address() )) ? $order->get_formatted_billing_address() : "" );
        $order_data['formatted_shipping_address'] = ( (method_exists( $order, 'get_formatted_shipping_address' ) and is_string( $order->get_formatted_shipping_address() )) ? $order->get_formatted_shipping_address() : "" );
        #
        $order_data['payment_method'] = ( (method_exists( $order, 'get_payment_method' ) and is_string( $order->get_payment_method() )) ? $order->get_payment_method() : "" );
        $order_data['payment_method_title'] = ( (method_exists( $order, 'get_payment_method_title' ) and is_string( $order->get_payment_method_title() )) ? $order->get_payment_method_title() : "" );
        $order_data['transaction_id'] = ( (method_exists( $order, 'get_transaction_id' ) and is_string( $order->get_transaction_id() )) ? $order->get_transaction_id() : "" );
        #
        $order_data['checkout_payment_url'] = ( (method_exists( $order, 'get_checkout_payment_url' ) and is_string( $order->get_checkout_payment_url() )) ? $order->get_checkout_payment_url() : "" );
        $order_data['checkout_order_received_url'] = ( (method_exists( $order, 'get_checkout_order_received_url' ) and is_string( $order->get_checkout_order_received_url() )) ? $order->get_checkout_order_received_url() : "" );
        $order_data['cancel_order_url'] = ( (method_exists( $order, 'get_cancel_order_url' ) and is_string( $order->get_cancel_order_url() )) ? $order->get_cancel_order_url() : "" );
        $order_data['cancel_order_url_raw'] = ( (method_exists( $order, 'get_cancel_order_url_raw' ) and is_string( $order->get_cancel_order_url_raw() )) ? $order->get_cancel_order_url_raw() : "" );
        $order_data['cancel_endpoint'] = ( (method_exists( $order, 'get_cancel_endpoint' ) and is_string( $order->get_cancel_endpoint() )) ? $order->get_cancel_endpoint() : "" );
        $order_data['view_order_url'] = ( (method_exists( $order, 'get_view_order_url' ) and is_string( $order->get_view_order_url() )) ? $order->get_view_order_url() : "" );
        $order_data['edit_order_url'] = ( (method_exists( $order, 'get_edit_order_url' ) and is_string( $order->get_edit_order_url() )) ? $order->get_edit_order_url() : "" );
        #s
        $order_data['status'] = $order->get_status();
        # if Order had ID;
        
        if ( $order_id ) {
            $r = $this->wootrello_create_trello_card( $order_data['status'], $order_data );
            // return $r;
        }
    
    }
    
    /**
     * woocommerce_thankyou  Order  HOOK's callback function
     * I"M USE THIS FOR  Checkout page -> woocommerce_thankyou HOOK for FRONT END
     * @since    1.0.0
     * @param     int     $order_id     Order ID
     */
    public function wootrello_woocommerce_new_order_checkout( $order_id )
    {
        # Getting Order Details by Order ID
        $order = wc_get_order( $order_id );
        # if not checkout returns
        if ( $order->get_created_via() != 'checkout' ) {
            return;
        }
        # Order Data Holder;
        $order_data = array();
        $order_data['orderID'] = ( (method_exists( $order, 'get_id' ) and is_int( $order->get_id() )) ? $order->get_id() : "" );
        $order_data['cart_tax'] = ( (method_exists( $order, 'get_cart_tax' ) and is_string( $order->get_cart_tax() )) ? $order->get_cart_tax() : "" );
        $order_data['currency'] = ( (method_exists( $order, 'get_currency' ) and is_string( $order->get_currency() )) ? $order->get_currency() : "" );
        $order_data['discount_tax'] = ( (method_exists( $order, 'get_discount_tax' ) and is_string( $order->get_discount_tax() )) ? $order->get_discount_tax() : "" );
        $order_data['discount_total'] = ( (method_exists( $order, 'get_discount_total' ) and is_string( $order->get_discount_total() )) ? $order->get_discount_total() : "" );
        $order_data['fees'] = ( (method_exists( $order, 'get_fees' ) and is_array( $order->get_fees() )) ? json_encode( $order->get_fees() ) : "" );
        $order_data['shipping_method'] = ( (method_exists( $order, 'get_shipping_method' ) and is_string( $order->get_shipping_method() )) ? $order->get_shipping_method() : "" );
        $order_data['shipping_tax'] = ( (method_exists( $order, 'get_shipping_tax' ) and is_string( $order->get_shipping_tax() )) ? $order->get_shipping_tax() : "" );
        $order_data['shipping_total'] = ( (method_exists( $order, 'get_shipping_total' ) and is_string( $order->get_shipping_total() )) ? $order->get_shipping_total() : "" );
        $order_data['subtotal'] = ( (method_exists( $order, 'get_subtotal' ) and is_float( $order->get_subtotal() )) ? $order->get_subtotal() : "" );
        $order_data['subtotal_to_display'] = ( (method_exists( $order, 'get_subtotal_to_display' ) and is_string( $order->get_subtotal_to_display() )) ? $order->get_subtotal_to_display() : "" );
        $order_data['tax_totals'] = ( (method_exists( $order, 'get_tax_totals' ) and !empty($order->get_tax_totals()) and is_array( $order->get_tax_totals() )) ? json_encode( $order->get_tax_totals() ) : "" );
        $order_data['taxes'] = ( (method_exists( $order, 'get_taxes' ) and !empty($order->get_taxes()) and is_array( $order->get_taxes() )) ? json_encode( $order->get_taxes() ) : "" );
        $order_data['total'] = ( (method_exists( $order, 'get_total' ) and is_string( $order->get_total() )) ? $order->get_total() : "" );
        $order_data['total_discount'] = ( (method_exists( $order, 'get_total_discount' ) and is_float( $order->get_total_discount() )) ? $order->get_total_discount() : "" );
        $order_data['total_tax'] = ( (method_exists( $order, 'get_total_tax' ) and is_string( $order->get_total_tax() )) ? $order->get_total_tax() : "" );
        $order_data['total_refunded'] = ( (method_exists( $order, 'get_total_refunded' ) and is_float( $order->get_total_refunded() )) ? $order->get_total_refunded() : "" );
        $order_data['total_tax_refunded'] = ( (method_exists( $order, 'get_total_tax_refunded' ) and is_int( $order->get_total_tax_refunded() )) ? $order->get_total_tax_refunded() : "" );
        $order_data['total_shipping_refunded'] = ( (method_exists( $order, 'get_total_shipping_refunded' ) and is_int( $order->get_total_shipping_refunded() )) ? $order->get_total_shipping_refunded() : "" );
        $order_data['item_count_refunded'] = ( (method_exists( $order, 'get_item_count_refunded' ) and is_int( $order->get_item_count_refunded() )) ? $order->get_item_count_refunded() : "" );
        $order_data['total_qty_refunded'] = ( (method_exists( $order, 'get_total_qty_refunded' ) and is_int( $order->get_total_qty_refunded() )) ? $order->get_total_qty_refunded() : "" );
        $order_data['remaining_refund_amount'] = ( (method_exists( $order, 'get_remaining_refund_amount' ) and is_string( $order->get_remaining_refund_amount() )) ? $order->get_remaining_refund_amount() : "" );
        # Order Item process Starts
        
        if ( is_array( $order->get_items() ) ) {
            $items = array();
            $cart_items_weight = array();
            foreach ( $order->get_items() as $item_id => $item_data ) {
                $items[$item_id]['product_id'] = ( (method_exists( $item_data, "get_product_id" ) and is_int( $item_data->get_product_id() )) ? $item_data->get_product_id() : "" );
                $items[$item_id]['variation_id'] = ( (method_exists( $item_data, "get_variation_id" ) and is_int( $item_data->get_variation_id() )) ? $item_data->get_variation_id() : "" );
                $items[$item_id]['product_sku'] = ( empty($items[$item_id]['variation_id']) ? get_post_meta( $items[$item_id]['product_id'], '_sku', true ) : get_post_meta( $items[$item_id]['variation_id'], '_sku', true ) );
                $items[$item_id]['product_name'] = ( (method_exists( $item_data, "get_name" ) and is_string( $item_data->get_name() )) ? $item_data->get_name() : "" );
                $items[$item_id]['qty'] = ( (method_exists( $item_data, "get_quantity" ) and is_int( $item_data->get_quantity() )) ? $item_data->get_quantity() : "" );
                $items[$item_id]['product_qty_price'] = ( (method_exists( $item_data, "get_total" ) and is_string( $item_data->get_total() )) ? $item_data->get_total() : "" );
                $items[$item_id]['product_weight'] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
                # getting total weight
                $cart_items_weight[] = ( (method_exists( $item_data->get_product(), 'get_weight' ) and !empty($item_data->get_product()->get_weight())) ? $item_data->get_product()->get_weight() * $items[$item_id]['qty'] : "" );
            }
        }
        
        # Order Item process Ends
        $order_data['items'] = ( $items ? $items : "" );
        $order_data['cart_items_weight'] = array_sum( $cart_items_weight );
        $order_data['item_count'] = ( (method_exists( $order, 'get_item_count' ) and is_int( $order->get_item_count() )) ? $order->get_item_count() : "" );
        $order_data['downloadable_items'] = ( (method_exists( $order, 'get_downloadable_items' ) and !empty($order->get_downloadable_items()) and is_array( $order->get_downloadable_items() )) ? json_encode( $order->get_downloadable_items() ) : "" );
        // Need To Change
        #
        $order_data['date_created'] = ( (method_exists( $order, 'get_date_created' ) and !empty($order->get_date_created()) and is_string( $order->get_date_created()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_created()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_modified'] = ( (method_exists( $order, 'get_date_modified' ) and !empty($order->get_date_modified()) and is_string( $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_modified()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_completed'] = ( (method_exists( $order, 'get_date_completed' ) and !empty($order->get_date_completed()) and is_string( $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_completed()->date( "F j, Y, g:i:s A T" ) : "" );
        $order_data['date_paid'] = ( (method_exists( $order, 'get_date_paid' ) and !empty($order->get_date_paid()) and is_string( $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) )) ? $order->get_date_paid()->date( "F j, Y, g:i:s A T" ) : "" );
        #
        $order_data['user'] = ( (method_exists( $order, 'get_user' ) and !empty($order->get_user()) and is_object( $order->get_user() )) ? $order->get_user()->user_login . " - " . $order->get_user()->user_email : "" );
        $order_data['customer_id'] = ( (method_exists( $order, 'get_customer_id' ) and is_int( $order->get_customer_id() )) ? $order->get_customer_id() : "" );
        $order_data['user_id'] = ( (method_exists( $order, 'get_user_id' ) and is_int( $order->get_user_id() )) ? $order->get_user_id() : "" );
        $order_data['customer_ip_address'] = ( (method_exists( $order, 'get_customer_ip_address' ) and is_string( $order->get_customer_ip_address() )) ? $order->get_customer_ip_address() : "" );
        $order_data['customer_user_agent'] = ( (method_exists( $order, 'get_customer_user_agent' ) and is_string( $order->get_customer_user_agent() )) ? $order->get_customer_user_agent() : "" );
        $order_data['created_via'] = ( (method_exists( $order, 'get_created_via' ) and is_string( $order->get_created_via() )) ? $order->get_created_via() : "" );
        $order_data['customer_note'] = ( (method_exists( $order, 'get_customer_note' ) and is_string( $order->get_customer_note() )) ? $order->get_customer_note() : "" );
        $order_data['billing_first_name'] = ( (method_exists( $order, 'get_billing_first_name' ) and is_string( $order->get_billing_first_name() )) ? $order->get_billing_first_name() : "" );
        $order_data['billing_last_name'] = ( (method_exists( $order, 'get_billing_last_name' ) and is_string( $order->get_billing_last_name() )) ? $order->get_billing_last_name() : "" );
        $order_data['billing_company'] = ( (method_exists( $order, 'get_billing_company' ) and is_string( $order->get_billing_company() )) ? $order->get_billing_company() : "" );
        $order_data['billing_address_1'] = ( (method_exists( $order, 'get_billing_address_1' ) and is_string( $order->get_billing_address_1() )) ? $order->get_billing_address_1() : "" );
        $order_data['billing_address_2'] = ( (method_exists( $order, 'get_billing_address_2' ) and is_string( $order->get_billing_address_2() )) ? $order->get_billing_address_2() : "" );
        $order_data['billing_city'] = ( (method_exists( $order, 'get_billing_city' ) and is_string( $order->get_billing_city() )) ? $order->get_billing_city() : "" );
        $order_data['billing_state'] = ( (method_exists( $order, 'get_billing_state' ) and is_string( $order->get_billing_state() )) ? $order->get_billing_state() : "" );
        $order_data['billing_postcode'] = ( (method_exists( $order, 'get_billing_postcode' ) and is_string( $order->get_billing_postcode() )) ? $order->get_billing_postcode() : "" );
        $order_data['billing_country'] = ( (method_exists( $order, 'get_billing_country' ) and is_string( $order->get_billing_country() )) ? $order->get_billing_country() : "" );
        $order_data['billing_email'] = ( (method_exists( $order, 'get_billing_email' ) and is_string( $order->get_billing_email() )) ? $order->get_billing_email() : "" );
        $order_data['billing_phone'] = ( (method_exists( $order, 'get_billing_phone' ) and is_string( $order->get_billing_phone() )) ? $order->get_billing_phone() : "" );
        $order_data['shipping_first_name'] = ( (method_exists( $order, 'get_shipping_first_name' ) and is_string( $order->get_shipping_first_name() )) ? $order->get_shipping_first_name() : "" );
        $order_data['shipping_last_name'] = ( (method_exists( $order, 'get_shipping_last_name' ) and is_string( $order->get_shipping_last_name() )) ? $order->get_shipping_last_name() : "" );
        $order_data['shipping_company'] = ( (method_exists( $order, 'get_shipping_company' ) and is_string( $order->get_shipping_company() )) ? $order->get_shipping_company() : "" );
        $order_data['shipping_address_1'] = ( (method_exists( $order, 'get_shipping_address_1' ) and is_string( $order->get_shipping_address_1() )) ? $order->get_shipping_address_1() : "" );
        $order_data['shipping_address_2'] = ( (method_exists( $order, 'get_shipping_address_2' ) and is_string( $order->get_shipping_address_2() )) ? $order->get_shipping_address_2() : "" );
        $order_data['shipping_city'] = ( (method_exists( $order, 'get_shipping_city' ) and is_string( $order->get_shipping_city() )) ? $order->get_shipping_city() : "" );
        $order_data['shipping_state'] = ( (method_exists( $order, 'get_shipping_state' ) and is_string( $order->get_shipping_state() )) ? $order->get_shipping_state() : "" );
        $order_data['shipping_postcode'] = ( (method_exists( $order, 'get_shipping_postcode' ) and is_string( $order->get_shipping_postcode() )) ? $order->get_shipping_postcode() : "" );
        $order_data['shipping_country'] = ( (method_exists( $order, 'get_shipping_country' ) and is_string( $order->get_shipping_country() )) ? $order->get_shipping_country() : "" );
        $order_data['address'] = ( (method_exists( $order, 'get_address' ) and !empty($order->get_address()) and is_array( $order->get_address() )) ? json_encode( $order->get_address() ) : "" );
        $order_data['shipping_address_map_url'] = ( (method_exists( $order, 'get_shipping_address_map_url' ) and is_string( $order->get_shipping_address_map_url() )) ? $order->get_shipping_address_map_url() : "" );
        $order_data['formatted_billing_full_name'] = ( (method_exists( $order, 'get_formatted_billing_full_name' ) and is_string( $order->get_formatted_billing_full_name() )) ? $order->get_formatted_billing_full_name() : "" );
        $order_data['formatted_shipping_full_name'] = ( (method_exists( $order, 'get_formatted_shipping_full_name' ) and is_string( $order->get_formatted_shipping_full_name() )) ? $order->get_formatted_shipping_full_name() : "" );
        $order_data['formatted_billing_address'] = ( (method_exists( $order, 'get_formatted_billing_address' ) and is_string( $order->get_formatted_billing_address() )) ? $order->get_formatted_billing_address() : "" );
        $order_data['formatted_shipping_address'] = ( (method_exists( $order, 'get_formatted_shipping_address' ) and is_string( $order->get_formatted_shipping_address() )) ? $order->get_formatted_shipping_address() : "" );
        #
        $order_data['payment_method'] = ( (method_exists( $order, 'get_payment_method' ) and is_string( $order->get_payment_method() )) ? $order->get_payment_method() : "" );
        $order_data['payment_method_title'] = ( (method_exists( $order, 'get_payment_method_title' ) and is_string( $order->get_payment_method_title() )) ? $order->get_payment_method_title() : "" );
        $order_data['transaction_id'] = ( (method_exists( $order, 'get_transaction_id' ) and is_string( $order->get_transaction_id() )) ? $order->get_transaction_id() : "" );
        #
        $order_data['checkout_payment_url'] = ( (method_exists( $order, 'get_checkout_payment_url' ) and is_string( $order->get_checkout_payment_url() )) ? $order->get_checkout_payment_url() : "" );
        $order_data['checkout_order_received_url'] = ( (method_exists( $order, 'get_checkout_order_received_url' ) and is_string( $order->get_checkout_order_received_url() )) ? $order->get_checkout_order_received_url() : "" );
        $order_data['cancel_order_url'] = ( (method_exists( $order, 'get_cancel_order_url' ) and is_string( $order->get_cancel_order_url() )) ? $order->get_cancel_order_url() : "" );
        $order_data['cancel_order_url_raw'] = ( (method_exists( $order, 'get_cancel_order_url_raw' ) and is_string( $order->get_cancel_order_url_raw() )) ? $order->get_cancel_order_url_raw() : "" );
        $order_data['cancel_endpoint'] = ( (method_exists( $order, 'get_cancel_endpoint' ) and is_string( $order->get_cancel_endpoint() )) ? $order->get_cancel_endpoint() : "" );
        $order_data['view_order_url'] = ( (method_exists( $order, 'get_view_order_url' ) and is_string( $order->get_view_order_url() )) ? $order->get_view_order_url() : "" );
        $order_data['edit_order_url'] = ( (method_exists( $order, 'get_edit_order_url' ) and is_string( $order->get_edit_order_url() )) ? $order->get_edit_order_url() : "" );
        #
        $order_data['status'] = 'new_order';
        # If Order had Order ID
        
        if ( $order_id ) {
            $r = $this->wootrello_create_trello_card( $order_data['status'], $order_data );
            // return $r;
        }
    
    }
    
    /**
     * new create trello card;
     * @since    1.0.0
     * @param     string     $order_status     order_status
     * @param     array     $order_info        order_info
     */
    public function wootrello_create_trello_card( $order_status = "", $order_info = array() )
    {
        # stop repetition starts OR don't Create Duala Card ;-)
        $wootrello_status = get_post_meta( $order_info['orderID'], 'wootrello_status', TRUE );
        
        if ( $wootrello_status and isset( $wootrello_status[$order_status] ) ) {
            # getting current timeStamp
            $timestamp = current_time( 'timestamp' );
            # if WP timeStamp is Empty
            if ( empty($timestamp) or !is_numeric( $timestamp ) ) {
                $timestamp = time();
            }
            # checking the Thing
            
            if ( $timestamp - end( $wootrello_status[$order_status] ) < 40 ) {
                $this->wootrello_log( 'wootrello_create_trello_card', 704, "ERROR: Already created a card on order " . $order_info['orderID'] . " !  Stop duplicate card for new order form checkout page orders. " );
                return array( FALSE, "Stop duplicate card  !" );
            }
        
        }
        
        # Getting Trello API key
        $wootrello_trello_API = get_option( "wootrello_trello_API" );
        # Getting Related Connection form WP Custom  POST, database Global instance
        global  $wpdb ;
        # run Query # Getting saved integrations by there title
        $savedIntegration = $wpdb->get_results( "SELECT * FROM `" . $wpdb->posts . "` WHERE post_title  = 'wootrello_" . $order_status . "' AND post_type = 'wootrello';", OBJECT );
        # Check status , trello_board , trello_list have or not OR Decoding Saved Data
        $settings = ( isset( $savedIntegration[0]->post_excerpt ) ? json_decode( $savedIntegration[0]->post_excerpt, TRUE ) : "" );
        # Check card
        $card = ( isset( $savedIntegration[0]->post_excerpt ) ? json_decode( $savedIntegration[0]->post_content, TRUE ) : "" );
        # Check API key Empty or NOt
        
        if ( empty($wootrello_trello_API) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 705, "ERROR: No API key  of the User " );
            return array( FALSE, "No API key  of the User !" );
        }
        
        # Check is There Any Saved Data or Not
        if ( !isset( $savedIntegration, $savedIntegration[0], $savedIntegration[0]->post_status ) or empty($savedIntegration) ) {
            return array( FALSE, "No data saved on this Status ! " );
        }
        # check status
        
        if ( !$settings or empty($settings) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 707, "ERROR: settings Maybe empty. wootrello_" . $order_status );
            return array( FALSE, " settings , card  Maybe empty ! " );
        }
        
        # Check card is
        
        if ( !$card or empty($card) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 708, "ERROR: card  Maybe empty." );
            return array( FALSE, " settings , card  is empty ! " );
        }
        
        # check settings, trello_board, trello_list is set or not
        
        if ( !isset( $settings['trello_board'], $settings['trello_list'] ) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 709, "ERROR: status , trello_board , trello_list Maybe  not set !" );
            return array( FALSE, " status , trello_board , trello_list Maybe  not set." );
        }
        
        # intermigration status aka saved post status
        if ( $savedIntegration[0]->post_status != "publish" ) {
            return array( FALSE, "Post status is pending, Not publish" );
        }
        # Check settings trello_board is empty or not
        
        if ( empty($settings['trello_board']) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 711, "ERROR: trello_board is empty." );
            return array( FALSE, "trello_board is empty !" );
        }
        
        # Check settings trello_list is empty or not
        
        if ( empty($settings['trello_list']) ) {
            $this->wootrello_log( 'wootrello_create_trello_card', 712, "ERROR: trello_list is empty." );
            return array( FALSE, "trello_list is empty !" );
        }
        
        # if Not Professional Stop creating card for Other Event
        if ( !wootrello_freemius()->can_use_premium_code() and $order_status != 'new_order' ) {
            return array( FALSE, "Sorry status change card creation is Professional version only." );
        }
        # trello card title
        $title = ( isset( $order_info['orderID'] ) ? $order_info['orderID'] : "" );
        $title .= ( $card["date"] ? ' # ' . date( "Y/m/d" ) : "" );
        $description = ' ** Order ID :** ' . urlencode( $order_info["orderID"] );
        $description .= ' %0A ** Order status :** ' . urlencode( $order_info["status"] );
        $description .= ( (isset( $card["customer_name"] ) and $card["customer_name"]) ? ' %0A ** Customer name :** ' . urlencode( $order_info["billing_first_name"] ) . " " . urlencode( $order_info["billing_last_name"] ) : "" );
        # billing address
        $description .= ( $card["billing_address"] ? ' %0A ** Billing address :**  %0A ' . urlencode( $order_info["billing_address_1"] ) : '' );
        $description .= ( ($card["billing_address"] and isset( $order_info["billing_address_2"] ) and !empty($order_info["billing_address_2"])) ? '  %0A ' . urlencode( $order_info["billing_address_2"] ) : '' );
        $description .= ( ($card["billing_address"] and isset( $order_info["billing_city"] ) and !empty($order_info["billing_city"])) ? '  %0A ' . urlencode( $order_info["billing_city"] ) : '' );
        $description .= ( ($card["billing_address"] and isset( $order_info["billing_state"] ) and !empty($order_info["billing_state"])) ? '  %0A ' . urlencode( $order_info["billing_state"] ) : '' );
        $description .= ( ($card["billing_address"] and isset( $order_info["billing_postcode"] ) and !empty($order_info["billing_postcode"])) ? '  %0A ' . urlencode( $order_info["billing_postcode"] ) : '' );
        $description .= ( ($card["billing_address"] and isset( $order_info["billing_country"] ) and !empty($order_info["billing_country"])) ? '  %0A ' . urlencode( $order_info["billing_country"] ) : '' );
        # shipping address
        $description .= ( $card["shipping_address"] ? ' %0A ** Shipping address :**   %0A ' . urlencode( $order_info["shipping_address_1"] ) : '' );
        $description .= ( ($card["shipping_address"] and isset( $order_info["shipping_address_2"] ) and !empty($order_info["shipping_address_2"])) ? '  %0A ' . urlencode( $order_info["shipping_address_2"] ) : '' );
        $description .= ( ($card["shipping_address"] and isset( $order_info["shipping_city"] ) and !empty($order_info["shipping_city"])) ? '  %0A ' . urlencode( $order_info["shipping_city"] ) : '' );
        $description .= ( ($card["shipping_address"] and isset( $order_info["shipping_state"] ) and !empty($order_info["shipping_state"])) ? '  %0A ' . urlencode( $order_info["shipping_state"] ) : '' );
        $description .= ( ($card["shipping_address"] and isset( $order_info["shipping_postcode"] ) and !empty($order_info["shipping_postcode"])) ? '  %0A ' . urlencode( $order_info["shipping_postcode"] ) : '' );
        $description .= ( ($card["shipping_address"] and isset( $order_info["shipping_country"] ) and !empty($order_info["shipping_country"])) ? '  %0A ' . urlencode( $order_info["shipping_country"] ) : '' );
        # Payment Details
        $description .= ( (isset( $card["payment_method"] ) and $card["payment_method"]) ? ' %0A ** Payment method :** ' . urlencode( $order_info["payment_method"] ) : '' );
        $description .= ( (isset( $card["order_total"] ) and $card["order_total"]) ? ' %0A ** Order total  :** ' . urlencode( $order_info["total"] ) . " " . urlencode( $order_info['currency'] ) : "" );
        #  Order Meta Information And Previous order History ends
        #3rd party orders starts  "Checkout Field Editor (Checkout Manager) for WooCommerce" | "https://wordpress.org/plugins/woo-checkout-field-editor-pro/"
        $woo_checkout_field_editor_fields = $this->wootrello_woo_checkout_field_editor_pro_fields();
        #3rd party orders ends  "Checkout Field Editor ( Checkout Manager ) for WooCommerce"
        # URL
        $card_url = 'https://api.trello.com/1/cards?name=' . urlencode( $title ) . '&desc=' . $description . '&pos=top&idList=' . $settings['trello_list'] . '&keepFromSource=all&key=' . $this->key . '&token=' . $wootrello_trello_API . '';
        # Execute Remote request
        $trello_response = wp_remote_post( $card_url, array() );
        
        if ( !is_wp_error( $trello_response ) and isset( $trello_response['response']['code'], $trello_response['body'] ) and $trello_response['response']['code'] == 200 ) {
            # Request is successful
            # Getting the New Created Card Id ;
            $trello_response_body = json_decode( $trello_response['body'], TRUE );
            # check and balance
            
            if ( isset( $trello_response_body['id'] ) and $trello_response_body['id'] ) {
                # URL builder
                $check_list_url = 'https://api.trello.com/1/cards/' . $trello_response_body['id'] . '/checklists?name=Order Items&pos=top&key=' . $this->key . '&token=' . $wootrello_trello_API . '';
                # Remote request for trello check list
                $trello_checklist_response = wp_remote_post( $check_list_url, array() );
                # if request has error or body is not set
                
                if ( is_wp_error( $trello_checklist_response ) or !isset( $trello_checklist_response['body'] ) ) {
                    # keeping log
                    $this->wootrello_log( 'wootrello_create_trello_card', 714, "ERROR: trello_checklist_response has error or response body is not set. " );
                    # return false
                    return array( "FALSE", "ERROR: trello_checklist_response has error or response body is not set" );
                }
                
                # JSON Decode the trello check list body
                $trello_checklist_response_body = json_decode( $trello_checklist_response['body'], TRUE );
                # Now Creating Product Check list Items;
                
                if ( isset( $trello_checklist_response_body['id'] ) and $trello_checklist_response_body['id'] and !empty($order_info['items']) ) {
                    # Insert The Checklist Items trello_checklist_response
                    $i = 1;
                    foreach ( $order_info['items'] as $order_item ) {
                        # URL builder
                        $url = '(' . get_edit_post_link( $order_item["product_id"] ) . ')';
                        $product = "";
                        $product .= ( $card["product_serial_number"] ? $i . ' - ' : "" );
                        $product .= ( $card["product_id"] ? $order_item["product_id"] . ' - ' : "" );
                        # product name
                        $product .= '[' . urlencode( $order_item["product_name"] ) . '](' . get_permalink( $order_item["product_id"] ) . ')';
                        # Product QTY
                        $product .= ( $card["product_qty"] ? ' qty - ' . $order_item["qty"] . ',' : "" );
                        // Here will be Custom Code Stats
                        // Get Prodcts Extra Information from Other DB Table
                        // Appand That To [$product .=] variable
                        //
                        # URL
                        $trello_list_item_url = 'https://api.trello.com/1/checklists/' . $trello_checklist_response_body['id'] . '/checkItems?name=' . $product . '&pos=top&checked=false&key=' . $this->key . '&token=' . $wootrello_trello_API . '';
                        # Requesting
                        wp_remote_post( $trello_list_item_url, array() );
                        $i++;
                    }
                } else {
                    # inserting log OR if array or object convert to JSON
                    
                    if ( is_array( $trello_checklist_response ) or is_object( $trello_checklist_response ) ) {
                        $this->wootrello_log( 'wootrello_create_trello_card', 714, 'ERROR: trello_checklist_response_body-id is not set or Empty. or  order_info - items are empty. ' . json_encode( $trello_checklist_response ) );
                    } else {
                        $this->wootrello_log( 'wootrello_create_trello_card', 714, 'ERROR: trello_checklist_response_body-id is not set or Empty. or  order_info - items are empty. ' . $trello_checklist_response );
                    }
                
                }
                
                # write order status ok and Current timestamp on the order meta
                $this->wootrello_write_status_on_order_meta( $order_info['orderID'], $order_info["status"] );
                # SuccessFully Card Created
                $this->wootrello_log( 'wootrello_create_trello_card', 200, 'SUCCESS: card created successfully!' );
                # return true
                return array( 'TRUE', "it seems everything is okay! " );
            } else {
                # Inserting Log
                $this->wootrello_log( 'wootrello_create_trello_card', 715, 'ERROR: Trello response is Empty' );
                # return true
                return array( 'FALSE', "Trello response is Empty!" );
            }
        
        } else {
            # New Code Starts
            $this->wootrello_write_status_on_order_meta( $order_info['orderID'], "wootrello_error" );
            # New Code ends
            $this->wootrello_log( 'wootrello_create_trello_card', 716, 'ERROR: ' . json_encode( $trello_response ) );
            # return true
            return array( 'FALSE', "Trello wootrello_error!" );
        }
    
    }
    
    /**
     * wootrello_user_previous_orders, Current order user Previous order history ;
     * @param    string     $billing_email     User email Address 
     * @since    2.0.0
     */
    public function wootrello_user_previous_orders( $billing_email = '' )
    {
        # Check and balance Bro
        
        if ( empty($billing_email) or !filter_var( $billing_email, FILTER_VALIDATE_EMAIL ) ) {
            # inserting log
            $this->wootrello_log( 'wootrello_user_previous_orders', 717, 'ERROR: EMPTY Billing address or INVALID EMAIL address ' );
            #
            return array( FALSE, 'ERROR: EMPTY Billing address or INVALID EMAIL address ' );
        }
        
        # Getting all orders
        $orders = wc_get_orders( array(
            'limit'    => -1,
            'return'   => 'objects',
            'orderby'  => 'date',
            'customer' => $billing_email,
        ) );
        # Counting the Number of Orders of that user OR Check and Balance
        if ( !count( $orders ) ) {
            return array( FALSE, "There is no orders of this user" );
        }
        # Orders Status Holder; aka empty array()
        $order_statuses = array();
        foreach ( $orders as $key => $value ) {
            $order_statuses[$value->get_status()][] = $value->get_id();
        }
        # Holder Empty;
        $status_numbers = array();
        $txt = "";
        foreach ( $order_statuses as $key => $order_ids ) {
            $status_numbers[$key] = count( $order_ids );
            $txt .= $key . " - " . count( $order_ids ) . ", ";
        }
        # return array with two parameters one for bool and other is data;
        return array( TRUE, $status_numbers, $txt );
    }
    
    /**
     * wootrello_ajax
     * @since    1.0.0
     */
    public function wootrello_ajax()
    {
        # Security Check Bro; No way !
        
        if ( wp_verify_nonce( $_POST['security'], 'wootrello-ajax-nonce' ) ) {
            # WordPress sanitize_text_field for security
            $boardID = sanitize_text_field( $_POST['boardID'] );
            # Getting Trello API key of the User for Request
            $trello_access_code = get_option( "wootrello_trello_API" );
            # Check and Balance
            
            if ( empty($boardID) or empty($trello_access_code) ) {
                # Inserting Log
                $this->wootrello_log( 'wootrello_ajax', 718, "ERROR: boardID : " . $boardID . " OR access token : " . $trello_access_code . " is empty !" );
                # printing json string
                echo  json_encode( array( FALSE, "boardID : " . $boardID . " OR access token : " . $trello_access_code . " is empty !" ) ) ;
                exit;
            }
            
            # getting Trello Boards
            $lists = $this->wootrello_board_lists( $trello_access_code, $boardID, 'wootrello_ajax' );
            
            if ( $lists[0] == 200 ) {
                # Printing Json
                echo  json_encode( array( TRUE, $lists[1] ), TRUE ) ;
            } else {
                # Inserting Log
                $this->wootrello_log( 'wootrello_ajax', 719, 'ERROR: ' . json_encode( $lists ) );
                # Printing JSON
                echo  json_encode( array( FALSE, "ERROR: Check the log page." ), TRUE ) ;
            }
        
        }
        
        # End the AJAX request
        exit;
    }
    
    /**
     *  WooCommerce Orders List Column for letting the User about trello card Status 
     *  @since  3.2.0
     */
    public function wootrello_card_status( $columns )
    {
        # if $columns is grater than 5 tha add the item in the number 4 position OR add at the End;
        
        if ( count( $columns ) > 5 ) {
            return array_slice(
                $columns,
                0,
                4,
                TRUE
            ) + array(
                'wootrello_card' => 'Trello Info',
            ) + array_slice(
                $columns,
                4,
                count( $columns ) - 1,
                TRUE
            );
        } else {
            $columns['wootrello_card'] = 'Trello Info';
            return $columns;
        }
    
    }
    
    /**
     *  Trello card Status Callback function 
     *  @since  3.2.0
     */
    public function wootrello_card_status_callback( $column, $post_id )
    {
        
        if ( 'wootrello_card' === $column ) {
            # getting order meta information
            $metaValue = get_post_meta( $post_id, 'wootrello_status', TRUE );
            
            if ( $metaValue ) {
                # if professional version OR it's an Onclick event
                # echo"<span  data-tip='Click here to create a Trello card for this order.' style='cursor: alias; color: #396b89;'  class='thickbox createCard tips dashicons dashicons-cloud-upload'> </span> ";
                # if error
                
                if ( isset( $metaValue['wootrello_error'] ) ) {
                    # if there is an error
                    echo  " <span data-tip='ERROR: this order &#39; s card is not created in Trello. For more information see the log.' style='cursor: default; color: #FF0038;'  class='tips dashicons dashicons-info-outline'> </span> " ;
                    # unset the element
                    unset( $metaValue['wootrello_error'] );
                }
                
                # if there is a Successfully card Created
                
                if ( count( $metaValue ) ) {
                    $total = array_sum( array_map( "count", $metaValue ) );
                    echo  " <span data-tip='Trello card created. " . $total . "' style='cursor: default; color: #61B329' class='tips dashicons dashicons-cloud-saved'> </span> " ;
                }
            
            } else {
                # if professional version OR it's an Onclick event
                # echo"<span data-tip='Click here to create a Trello card for this order.' style='cursor: alias; color: #396b89;'  class='tips dashicons dashicons-cloud-upload'> </span>";
            }
        
        }
    
    }
    
    /**
     *  wootrello_write_card_status_on_order_meta
     *  @since  3.2.0
     */
    public function wootrello_write_status_on_order_meta( $order_id, $order_status )
    {
        # Empty check
        if ( empty($order_id) ) {
            return array( FALSE, "Order id is Empty!" );
        }
        # Empty check
        if ( empty($order_status) ) {
            return array( FALSE, "Order status is Empty!" );
        }
        # getting current timeStamp
        $timestamp = current_time( 'timestamp' );
        # if WP timeStamp is Empty
        if ( empty($timestamp) or !is_numeric( $timestamp ) ) {
            $timestamp = time();
        }
        # getting meta vale
        $metaValue = get_post_meta( $order_id, 'wootrello_status', TRUE );
        # if Meta value is not empty
        
        if ( $metaValue ) {
            $metaValue[$order_status][] = $timestamp;
            update_post_meta( $order_id, 'wootrello_status', $metaValue );
        } else {
            $data = array();
            $data[$order_status][] = $timestamp;
            add_post_meta( $order_id, 'wootrello_status', $data );
        }
        
        return array( TRUE, "status updated!" );
    }
    
    /**
     *  Meta Box inside order detail.
     * @since    3.2.0
     */
    public function wootrello_adding_custom_meta_boxes( $post_type, $post )
    {
        # getting order Trello statuses
        $postID = $post->ID;
        $Trello_status = get_post_meta( $postID, 'wootrello_status', TRUE );
        # if Trello_status is not empty Or Professional version
        
        if ( $Trello_status or wootrello_freemius()->can_use_premium_code() ) {
            add_meta_box(
                'wootrello-adding-custom-meta-boxes',
                __( 'Trello Actions', 'wcchpo' ),
                array( $this, 'wootrello_render_custom_meta_boxes' ),
                'shop_order',
                'side',
                'core'
            );
        } else {
            # if No order History OR Professional user Display Noting
        }
    
    }
    
    /**
     * WooTrello; Display meta_box inside single order Page.
     * @since      3.2.0
     * @param      string    $post_info        Post detail info
     * @param      string    $meta_box_info    meta box info
     */
    public function wootrello_render_custom_meta_boxes( $post_info, $meta_box_info )
    {
        # Getting Order ID and Trello Order send Status
        $order_id = $post_info->ID;
        $Trello_status = get_post_meta( $order_id, 'wootrello_status', TRUE );
        
        if ( $Trello_status ) {
            echo  "<div class='yeplol' style='background: #efefef; padding: 10px 10px 10px 10px;' >" ;
            echo  " <p style='text-align: center;' ><b> Trello card History </b></p> <br>" ;
            echo  "<span id='trelloHistoryContent'>" ;
            foreach ( $Trello_status as $statuses => $time_stamps ) {
                
                if ( $statuses == 'wootrello_error' ) {
                    echo  "<b style='color: #FF0038;'>ERROR: card is not created.</b>" ;
                } else {
                    echo  "<b>" . $statuses . "</b>" ;
                }
                
                echo  "<br>" ;
                foreach ( $time_stamps as $time ) {
                    echo  '&nbsp;' . date( 'd/m/Y h:i A', $time ) ;
                    echo  "<br>" ;
                }
            }
            echo  "<p id='wooTrelloDeleteHistory' style='text-align: center; opacity: 0.4; cursor: default;' ><i> Remove History </i></p>" ;
            echo  "</span>" ;
            echo  "</div>" ;
        }
    
    }
    
    /**
     * This is for Processing the Single order page AJAX request 
     * @since     3.2.0
     */
    public function wootrello_ajax_single_order()
    {
        # Security Check Bro; No way !
        if ( wp_verify_nonce( $_POST['security'], 'wootrello-ajax-nonce' ) ) {
            # Testing is set POST items or not;
            
            if ( isset( $_POST['orderID'], $_POST['relatedSettings'] ) ) {
                # getting the AJAX value
                $orderID = sanitize_text_field( trim( $_POST['orderID'] ) );
                $relatedSettings = sanitize_text_field( trim( $_POST['relatedSettings'] ) );
                # if order id and related settings is not empty;
                
                if ( $orderID and $relatedSettings ) {
                    $ret = $this->wootrello_woocommerce_order_status_changed( $orderID, "none", $relatedSettings );
                    
                    if ( is_array( $ret ) and isset( $ret[0] ) and $ret[0] ) {
                        echo  json_encode( $ret, TRUE ) ;
                    } else {
                        echo  json_encode( $ret, TRUE ) ;
                    }
                
                }
            
            } else {
                echo  json_encode( array( FALSE, "orderID or relatedSettings is not set." ), TRUE ) ;
            }
        
        }
        # exit from AJAX query
        exit;
    }
    
    /**
     * This is for Processing the Single order page AJAX request 
     * @since     3.2.0
     */
    public function wootrello_ajax_delete_history()
    {
        # Security Check Bro; No way !
        if ( wp_verify_nonce( $_POST['security'], 'wootrello-ajax-nonce' ) ) {
            # Testing is set POST items or not;
            
            if ( isset( $_POST['orderID'] ) and is_numeric( $_POST['orderID'] ) ) {
                # remove meta of that order;
                delete_post_meta( $_POST['orderID'], 'wootrello_status' );
                $this->wootrello_log( 'wootrello_ajax_delete_history', 200, 'SUCCESS: ' . $_POST['orderID'] . " This order trello history is deleted." );
                echo  json_encode( array( TRUE, "This orders trello history is deleted." ), TRUE ) ;
            } else {
                echo  json_encode( array( FALSE, "orderID or relatedSettings is not set." ), TRUE ) ;
            }
        
        }
        # exit from AJAX query
        exit;
    }
    
    /**
     * LOG ! For Good, This the log Method 
     * @since      1.0.0
     * @param      string    $function_name     Function name.	 [  __METHOD__  ]
     * @param      string    $status_code       The name of this plugin.
     * @param      string    $status_message    The version of this plugin.
     */
    public function wootrello_log( $function_name = '', $status_code = '', $status_message = '' )
    {
        # WooTrello Log Status
        $wootrelloLogStatus = get_option( "wootrelloLogStatus" );
        # check and balances
        if ( $wootrelloLogStatus == 'Disable' ) {
            return array( FALSE, "WooTrello log is Disable! enable it to keep the Log." );
        }
        # Check and Balance Bro
        if ( empty($status_code) or empty($status_message) ) {
            return array( FALSE, "status_code or status_message is Empty" );
        }
        # inserting custom log by using custom post type
        $r = wp_insert_post( array(
            'post_content' => $status_message,
            'post_title'   => $status_code,
            'post_status'  => "publish",
            'post_excerpt' => $function_name,
            'post_type'    => "wootrello_log",
        ) );
        # if Successfully inserted its Okay
        if ( $r ) {
            return array( TRUE, "Successfully inserted to the Log" );
        }
    }
    
    /**
     * date initials to Due date conversion.
     * @since    2.0.0
     * @param    string    $date initials.
     */
    public function DueDateCalc( $selected = '' )
    {
        
        if ( $selected == "1d" ) {
            $date = date( "Y-m-d", time() + 86400 );
        } elseif ( $selected == "2d" ) {
            $date = date( "Y-m-d", time() + 86400 * 2 );
        } elseif ( $selected == "3d" ) {
            $date = date( "Y-m-d", time() + 86400 * 3 );
        } elseif ( $selected == "5d" ) {
            $date = date( "Y-m-d", time() + 86400 * 5 );
        } elseif ( $selected == "1w" ) {
            $date = date( "Y-m-d", time() + 86400 * 7 );
        } elseif ( $selected == "2w" ) {
            $date = date( "Y-m-d", time() + 86400 * 14 );
        } elseif ( $selected == "1m" ) {
            $date = date( "Y-m-d", time() + 86400 * 30 );
        } elseif ( $selected == "3m" ) {
            $date = date( "Y-m-d", time() + 86400 * 90 );
        } elseif ( $selected == "6m" ) {
            $date = date( "Y-m-d", time() + 86400 * 180 );
        } else {
            $date = date( "Y-m-d", time() );
        }
        
        return $date;
    }
    
    /**
     * Third party plugin :
     * Checkout Field Editor ( Checkout Manager ) for WooCommerce
     * BETA testing;
     * Important Pro Version of this Plugin has Changed; So Mark it for Update ***
     * @since    2.0.0
     */
    public function wootrello_woo_checkout_field_editor_pro_fields()
    {
        # Getting Active Plugins;
        $active_plugins = get_option( 'active_plugins' );
        $woo_checkout_field_editor_pro = array();
        # Checking Plugin installed or Not
        
        if ( in_array( 'woo-checkout-field-editor-pro/checkout-form-designer.php', $active_plugins ) ) {
            $a = get_option( "wc_fields_billing" );
            $b = get_option( "wc_fields_shipping" );
            $c = get_option( "wc_fields_additional" );
            if ( $a ) {
                foreach ( $a as $key => $field ) {
                    
                    if ( isset( $field['custom'] ) and $field['custom'] == 1 ) {
                        $woo_checkout_field_editor_pro[$key]['type'] = ( isset( $field['type'] ) ? $field['type'] : "" );
                        $woo_checkout_field_editor_pro[$key]['name'] = ( isset( $field['name'] ) ? $field['name'] : "" );
                        $woo_checkout_field_editor_pro[$key]['label'] = ( isset( $field['label'] ) ? $field['label'] : "" );
                    }
                
                }
            }
            if ( $b ) {
                foreach ( $b as $key => $field ) {
                    
                    if ( isset( $field['custom'] ) and $field['custom'] == 1 ) {
                        $woo_checkout_field_editor_pro[$key]['type'] = ( isset( $field['type'] ) ? $field['type'] : "" );
                        $woo_checkout_field_editor_pro[$key]['name'] = ( isset( $field['name'] ) ? $field['name'] : "" );
                        $woo_checkout_field_editor_pro[$key]['label'] = ( isset( $field['label'] ) ? $field['label'] : "" );
                    }
                
                }
            }
            if ( $c ) {
                foreach ( $c as $key => $field ) {
                    
                    if ( isset( $field['custom'] ) and $field['custom'] == 1 ) {
                        $woo_checkout_field_editor_pro[$key]['type'] = ( isset( $field['type'] ) ? $field['type'] : "" );
                        $woo_checkout_field_editor_pro[$key]['name'] = ( isset( $field['name'] ) ? $field['name'] : "" );
                        $woo_checkout_field_editor_pro[$key]['label'] = ( isset( $field['label'] ) ? $field['label'] : "" );
                    }
                
                }
            }
        } else {
            return array( FALSE, "Checkout Field Editor aka Checkout Manager for WooCommerce is not INSTALLED." );
        }
        
        # Do or not
        
        if ( empty($woo_checkout_field_editor_pro) ) {
            # Insert Log
            $this->wootrello_log( 'wootrello_woo_checkout_field_editor_pro_fields', 720, 'ERROR: Checkout Field Editor aka Checkout Manager for WooCommerce is EMPTY no Custom Field !' );
            # return
            return array( FALSE, "ERROR: Checkout Field Editor aka Checkout Manager for WooCommerce is EMPTY no Custom Field. " );
        } else {
            return array( TRUE, $woo_checkout_field_editor_pro );
        }
    
    }

}
// ==================   Notice : this part is for programmers Not for joe's   ==================
// Hello, What are you doing here ? copying code or changing code or What? Looking for Trello API implementation ?
// What about the code quality?  let me know, if possible leave a 5 star review
// I am from Dhaka, Bangladesh.
// What i know !
// I kow  golang, python, PHP and wordpress and javascript too
// How may you contact me! my email is jaedmah@gmail.com
// Beautiful Code  is changed by freemius code formatter. sorry for that !
//===============================================================================================