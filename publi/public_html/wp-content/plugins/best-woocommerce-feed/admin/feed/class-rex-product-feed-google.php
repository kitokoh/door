<?php

/**
 * The file that generates xml feed for Google.
 *
 * A class definition that includes functions used for generating xml feed.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Feed_Google
 * @subpackage Rex_Product_Feed_Google/includes
 * @author     RexTheme <info@rextheme.com>
 */

use LukeSnowden\GoogleShoppingFeed\Containers\GoogleShopping;

class Rex_Product_Feed_Google extends Rex_Product_Feed_Abstract_Generator {

    /**
     * Create Feed for Google
     *
     * @return boolean
     * @author
     **/
    public function make_feed() {

        //putting data in xml file
        GoogleShopping::$container = null;
        GoogleShopping::title($this->title);
        GoogleShopping::link($this->link);
        GoogleShopping::description($this->desc);

        $this->generate_product_feed();
	    $this->feed = $this->returnFinalProduct();

        if ($this->batch >= $this->tbatch ) {
            $this->save_feed($this->feed_format);
            return array(
                'msg' => 'finish'
            );
        }else {
            return $this->save_feed($this->feed_format);
        }
    }

    /**
     * Generate feed
     */
    protected function generate_product_feed(){
        $product_meta_keys = Rex_Feed_Attributes::get_attributes();
        $total_products = get_post_meta($this->id, '_rex_feed_total_products', true);
        $total_products = $total_products ?: get_post_meta($this->id, 'rex_feed_total_products', true);
        $simple_products = [];
        $variation_products = [];
        $variable_parent = [];
        $group_products = [];
        $total_products = $total_products ?: array(
            'total' => 0,
            'simple' => 0,
            'variable' => 0,
            'variable_parent' => 0,
            'group' => 0,
        );

        if($this->batch == 1) {
            $total_products = array(
                'total' => 0,
                'simple' => 0,
                'variable' => 0,
                'variable_parent' => 0,
                'group' => 0,
            );
        }

        foreach( $this->products as $productId ) {
            $product = wc_get_product( $productId );

            if ( ! is_object( $product ) ) {
                continue;
            }
            if ( $this->exclude_hidden_products ) {
                if ( !$product->is_visible() ) {
                    continue;
                }
            }

            if ( ( !$this->include_out_of_stock )
                && ( !$product->is_in_stock()
                    || $product->is_on_backorder()
                    || (is_integer($product->get_stock_quantity()) && 0 >= $product->get_stock_quantity())
                )
            ) {
                continue;
            }

            if( !$this->include_zero_priced ) {
                $product_price = rex_feed_get_product_price($product);
                if( 0 == $product_price || '' == $product_price ) {
                    continue;
                }
            }

            if ( $product->is_type( 'variable' ) && $product->has_child() ) {
                if($this->variable_product) {
                    $variable_parent[] = $productId;
                    $variable_product = new WC_Product_Variable($productId);
                    $this->add_to_feed( $variable_product, $product_meta_keys );
                }

                if( $this->product_scope === 'product_cat' || $this->product_scope === 'product_tag' || $this->custom_filter_var_exclude || $this->custom_filter_var_exclude ) {
                    if ( $this->exclude_hidden_products ) {
                        $variations = $product->get_visible_children();
                    }
                    else {
                        $variations = $product->get_children();
                    }

                    if( $variations ) {
                        foreach ($variations as $variation) {
                            if($this->variations) {
                                $variation_products[] = $variation;
                                $variation_product = wc_get_product( $variation );
                                if ( ( !$this->include_out_of_stock )
                                    && ( !$variation_product->is_in_stock()
                                        || $variation_product->is_on_backorder()
                                        || (is_integer($variation_product->get_stock_quantity()) && 0 >= $variation_product->get_stock_quantity())
                                    )
                                ) {
                                    continue;
                                }
                                $this->add_to_feed( $variation_product, $product_meta_keys, 'variation' );
                            }
                        }
                    }
                }
            }

            if ( $product->is_type( 'simple' ) || $product->is_type( 'external' ) || $product->is_type( 'composite' ) || $product->is_type( 'bundle' )) {
                $simple_products[] = $productId;
                $this->add_to_feed( $product, $product_meta_keys );
            }

            if( $this->product_scope === 'all' || $this->product_scope === 'product_filter' || $this->custom_filter_option) {
                if ( $product->get_type() === 'variation' ) {
                    $variation_products[] = $productId;
                    $this->add_to_feed( $product, $product_meta_keys, 'variation' );
                }
            }

            if( $product->is_type( 'grouped' ) && $this->parent_product || $product->is_type( 'woosb' )){
                $group_products[] = $productId;
                $this->add_to_feed( $product, $product_meta_keys );
            }
            
        }

        $total_products = array(
            'total' => (int) $total_products['total'] + (int) count($simple_products) + (int) count($variation_products) + (int) count($group_products) + (int) count($variable_parent),
            'simple' => (int) $total_products['simple'] + (int) count($simple_products),
            'variable' => (int) $total_products['variable'] + (int) count($variation_products),
            'variable_parent' => (int) $total_products['variable_parent'] + (int) count($variable_parent),
            'group' => (int) $total_products['group'] + (int) count($group_products),
        );

        update_post_meta( $this->id, '_rex_feed_total_products', $total_products );
	    if ( $this->tbatch === $this->batch ) {
		    update_post_meta( $this->id, '_rex_feed_total_products_for_all_feed', $total_products[ 'total' ] );
	    }
    }


    /**
     * Adding items to feed
     *
     * @param $product
     * @param $meta_keys
     * @param string $product_type
     * @since 7.0.1
     */
    private function add_to_feed( $product, $meta_keys, $product_type = '' ) {
        $attributes = $this->get_product_data( $product, $meta_keys );
        $attributes = $this->process_attributes_for_shipping_tax( $attributes );

        if( ( $this->rex_feed_skip_product && empty( array_keys($attributes, '') ) ) || !$this->rex_feed_skip_product ) {
            $item = GoogleShopping::createItem();
            $shipping_labels = array( 'shipping_1', 'shipping_2', 'shipping_3', 'shipping_4' );

            if ( $product_type === 'variation' ) {
                $check_item_group_id = 0;
            }

            foreach ( $attributes as $key => $value ) {
                if( 'shipping' === $key ) {
                    if ( is_array( $value ) && !empty( $value ) ) {
                        foreach ( $value as $shipping ) {
                            $shipping_country = isset( $shipping[ 'country' ] ) ? $shipping[ 'country' ] : '';
                            $shipping_region = isset($shipping['region']) ? $shipping['region'] : '';
                            $shipping_service = isset( $shipping[ 'service' ] ) ? $shipping[ 'service' ] : '';
                            $shipping_price = isset( $shipping[ 'price' ] ) ? $shipping[ 'price' ] : '';

                            $item->$key( $shipping_country, $shipping_region, $shipping_service, $shipping_price ); // invoke $key as method of $item object.
                        }
                    }
                }
                elseif ( $key === 'tax' ) {
                    if ( is_array( $value ) && !empty( $value ) ) {
                        foreach ( $value as $tax ) {
                            $tax_country = isset( $tax->tax_rate_country ) ? $tax->tax_rate_country : '';
                            $tax_region = isset( $tax->tax_rate_state ) ? $tax->tax_rate_state : '';
                            $tax_postcode = isset( $tax->postcode ) && !empty( $tax->postcode ) ? implode( ', ', $tax->postcode ) : '';
                            $tax_rate = isset( $tax->tax_rate ) ? $tax->tax_rate : '';
                            $tax_ship = isset( $tax->tax_rate_shipping ) && $tax->tax_rate_shipping === '1' ? 'yes' : 'no';
                            $item->$key( $tax_country,$tax_region, $tax_postcode, $tax_rate, $tax_ship ); // invoke $key as method of $item object.
                        }
                    }
                }
                else {
                    if ( $this->rex_feed_skip_row && $this->feed_format === 'xml' ) {
                        if ( $value != '' ) {
                            $item->$key($value); // invoke $key as method of $item object.
                        }
                    }
                    else {
                        $item->$key($value); // invoke $key as method of $item object.
                    }
                }

                if( $product_type === 'variation' && 'item_group_id' == $key ) {
                    $check_item_group_id = 1;
                }
            }

            if( $product_type === 'variation' && $check_item_group_id === 0){
                $item->item_group_id($product->get_parent_id());
            }
        }
    }


    /**
     * @param $attributes
     * @return array
     */
    private function process_attributes_for_shipping_tax( $attributes ) {
        $shipping_attr = array( 'shipping_country', 'shipping_region', 'shipping_service', 'shipping_price' );
        $backup_attr = array();

        foreach ( $attributes as $key => $value ) {
            $count = 1;
            if( in_array( $key, $shipping_attr ) ) {
                if ( is_array( $value ) && ! empty( $value ) ) {
                    foreach ( $value as $val ) {
                        $attributes[ 'shipping_' . $count++ ] = array();
                    }
                }
                else {
                    $attributes['shipping'][$key] = $value;
                }
                $backup_attr[ $key ] = $value;
                unset( $attributes[ $key ] );
            }
        }

        if( in_array( $key, $shipping_attr ) ) {
            for ( $i = 0; $i <= count( $backup_attr ); $i++ ) {
                if ( isset( $backup_attr[ 'shipping_country' ][ $i ] ) ) {
                    $attributes[ 'shipping_' . ( $i + 1 ) ][ 'shipping_country' ] = $backup_attr[ 'shipping_country' ][ $i ];
                }
                if ( isset( $backup_attr[ 'shipping_region' ][ $i ] ) ) {
                    $attributes[ 'shipping_' . ( $i + 1 ) ][ 'shipping_region' ] = $backup_attr[ 'shipping_region' ][ $i ];
                }
                if ( isset( $backup_attr[ 'shipping_service' ][ $i ] ) ) {
                    $attributes[ 'shipping_' . ( $i + 1 ) ][ 'shipping_service' ] = $backup_attr[ 'shipping_service' ][ $i ];
                }
                if ( isset( $backup_attr[ 'shipping_price' ][ $i ] ) ) {
                    $attributes[ 'shipping_' . ( $i + 1 ) ][ 'shipping_price' ] = $backup_attr[ 'shipping_price' ][ $i ];
                }
            }
        }
        return $attributes;
    }


    /**
     * Return Feed
     *
     * @return array|bool|string
     */
    public function returnFinalProduct()
    {
        if ($this->feed_format === 'xml') {
            return GoogleShopping::asRss();
        } elseif ($this->feed_format === 'text' || $this->feed_format === 'tsv') {
            return GoogleShopping::asTxt();
        } elseif ($this->feed_format === 'csv') {
            return GoogleShopping::asCsv();
        }
        return GoogleShopping::asRss();
    }

    public function footer_replace() {
        $this->feed = str_replace('</channel></rss>', '', $this->feed);

    }

}
