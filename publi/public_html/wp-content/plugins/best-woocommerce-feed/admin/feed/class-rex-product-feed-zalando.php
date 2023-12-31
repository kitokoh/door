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

use RexTheme\RexShoppingFeed\Containers\RexShopping;

class Rex_Product_Feed_Zalando extends Rex_Product_Feed_Abstract_Generator {

    private $product_data = array();

    /**
     * Create Feed for Google
     *
     * @return boolean
     * @author
     **/
    public function make_feed() {

        RexShopping::$container = null;
        RexShopping::title($this->title);
        RexShopping::link($this->link);
        RexShopping::description($this->desc);

        $this->generate_product_feed();

	    if ( $this->feed_format === 'csv' ) {
		    $this->feed = $this->returnFinalProduct();
	    }

        if ($this->batch >= $this->tbatch ) {
        	if ( $this->feed_format === 'csv' ) {
		        $this->save_feed($this->feed_format );
	        }
        	else {
		        $this->save_json_feed('json');
	        }
            return array(
                'msg' => 'finish'
            );
        }else {
	        if ( $this->feed_format === 'csv' ) {
		        return $this->save_feed($this->feed_format );
	        }
            return $this->save_json_feed('json');
        }
    }


    /**
     * Generate feed
     */
    protected function generate_product_feed(){
        $product_meta_keys = Rex_Feed_Attributes::get_attributes();
        $total_products = get_post_meta( $this->id, '_rex_feed_total_products', true );
        $total_products = $total_products ?: get_post_meta( $this->id, 'rex_feed_total_products', true );
        $simple_products = [];
        $variation_products = [];
        $group_products = [];
        $variable_parent = [];
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
                $variable_parent[] = $productId;
                $parent_atts = $this->get_product_data( $product, $product_meta_keys );
	            $item = RexShopping::createItem();

                if ( $this->exclude_hidden_products ) {
                    $variations = $product->get_visible_children();
                }else {
                    $variations = $product->get_children();
                }
                $atts = array();
                if( $variations ) {
                    foreach ($variations as $variation) {
                        if($this->variations) {
                            $variation_products[] = $variation;
                            $variation_product = wc_get_product( $variation );
                            $atts[] = $this->get_product_data( $variation_product, $product_meta_keys );
                        }
                    }
                }
                $json_array = $this->get_product_model($parent_atts);

                foreach ($atts as $att ) {
	                foreach ( $att as $key => $value ) {
		                if ( $this->rex_feed_skip_row && $this->feed_format === 'xml' ) {
			                if ( $value != '' ) {
				                $item->$key($value); // invoke $key as method of $item object.
			                }
		                }
		                else {
			                $item->$key($value); // invoke $key as method of $item object.
		                }
	                }
                    $json_array['product_model']['product_configs'][0]['product_simples'][] = $this->get_product_simples($att);
                }
                $this->feed[] = $json_array;
            }

            if ( $product->is_type( 'simple' )) {
	            $item = RexShopping::createItem();
                $simple_products[] = $productId;
                $atts = $this->get_product_data( $product, $product_meta_keys );
                foreach ( $atts as $key => $value ) {
	                if ( $this->rex_feed_skip_row && $this->feed_format === 'xml' ) {
		                if ( $value != '' ) {
			                $item->$key($value); // invoke $key as method of $item object.
		                }
	                }
	                else {
		                $item->$key($value); // invoke $key as method of $item object.
	                }
                }
                $json_array = $this->get_product_model($atts);
                $json_array['product_model']['product_configs'][0]['product_simples'][] = $this->get_product_simples($atts);
                $this->feed[] = $json_array;
            }

            if( $this->product_scope === 'all' || $this->product_scope =='product_filter' || $this->custom_filter_option) {
		        if ( $product->get_type() === 'variation' ) {
			        $variation_products[] = $productId;
			        $item = RexShopping::createItem();
			        $atts = $this->get_product_data($product, $product_meta_keys);
			        foreach ($atts as $key => $value) {
				        if ( $this->rex_feed_skip_row && $this->feed_format === 'xml' ) {
					        if ( $value != '' ) {
						        $item->$key($value); // invoke $key as method of $item object.
					        }
				        }
				        else {
					        $item->$key($value); // invoke $key as method of $item object.
				        }
			        }
		        }
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
     * @param $parent_atts
     * @return array
     */
    private function get_product_model($parent_atts) {
        $json_array = array();
        if($parent_atts) {
            foreach ($parent_atts as $key => $value) {
                if($key == 'outline') {
                    $json_array['outline'] = $value;
                }
                if($key == 'merchant_product_model_id') {
                    $json_array['product_model']['merchant_product_model_id'] = $value;
                }
                if($key == 'name') {
                    $json_array['product_model']['product_model_attributes']['name'] = $value;
                }
                if($key == 'brand_code') {
                    $json_array['product_model']['product_model_attributes']['brand_code'] = $value;
                }
                if($key == 'size') {
                    $json_array['product_model']['product_model_attributes']['size_group']['size'] = $value;
                }
                if($key == 'target_genders') {
                    $json_array['product_model']['product_model_attributes']['target_genders'] = explode("|",$value);
                }
                if($key == 'target_age_groups') {
                    $json_array['product_model']['product_model_attributes']['target_age_groups'] = explode("|",$value);
                }
                if($key == 'merchant_product_config_id') {
                    $json_array['product_model']['product_configs'][0]['merchant_product_config_id'] = $value;
                }
                if($key == 'description') {
                    $json_array['product_model']['product_configs'][0]['product_config_attributes']['description']['en'] = $value;
                }
                if($key == 'media_path') {
                    $json_array['product_model']['product_configs'][0]['product_config_attributes']['media']['media_path'] = $value;
                    $json_array['product_model']['product_configs'][0]['product_config_attributes']['media']['media_sort_key'] = 1;
                }
                if($key == 'season_code') {
                    $json_array['product_model']['product_configs'][0]['product_config_attributes']['season_code'] = $value;
                }
                if($key == 'supplier_color') {
                    $json_array['product_model']['product_configs'][0]['product_config_attributes']['supplier_color'] = $value;
                }
            }
        }
        return $json_array;
    }


    /**
     * @param $atts
     * @return array
     */
    private function get_product_simples($atts) {
        $json_array = array();
        foreach ($atts as $key=>$value) {
            if($key == 'merchant_product_simple_id') {
                $json_array['merchant_product_simple_id'] = $value;
            }
            if($key == 'ean') {
                $json_array['ean'] = $value;
            }
        }
        return $json_array;
    }


    /**
     * save feed
     *
     * @param $format
     * @return bool|string
     */
    public function save_json_feed($format) {
        $path  = wp_upload_dir();
        $baseurl = $path['baseurl'];
        $path  = $path['basedir'] . '/rex-feed';
        $file = trailingslashit($path) . "feed-{$this->id}.json";

        update_post_meta($this->id, '_rex_feed_xml_file', $baseurl . '/rex-feed' . "/feed-{$this->id}.json");
        update_post_meta($this->id, '_rex_feed_merchant', $this->merchant);

        if($this->batch == 1) {
            return file_put_contents($file, json_encode($this->feed)) ? 'true' : 'false';
        }
        else {
	        $languageCulture = 'de-CH';
            $request = wp_remote_get( "http://www.google.com/basepages/producttype/taxonomy." . $languageCulture . ".txt" );
            if( is_wp_error( $request ) ) {
                return false;
            }
            $inp = wp_remote_retrieve_body( $request );

            $tempArray = explode( '>', $inp );
            $result=array_merge($tempArray, $this->feed);
            $jsonData = json_encode($result);
            return file_put_contents($file, $jsonData) ? 'true' : 'false';
        }

    }

	/**
	 * Return Feed
	 *
	 * @return array|bool|string
	 */
	public function returnFinalProduct(){

		if ($this->feed_format === 'xml') {
			return RexShopping::asRss();
		} elseif ($this->feed_format === 'text' || $this->feed_format === 'tsv') {
			return RexShopping::asTxt();
		} elseif ($this->feed_format === 'csv') {
			return RexShopping::asCsv();
		}
		return RexShopping::asRss();
	}

    public function footer_replace() {}

}
