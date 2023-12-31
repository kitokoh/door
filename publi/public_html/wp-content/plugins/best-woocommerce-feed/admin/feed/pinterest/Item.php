<?php

namespace Rex\Pinterest;

use Rex\Pinterest\Node;
use Rex\Pinterest\Containers\Pinterest;
use Rex\Pinterest\Exceptions\MissingIdentifierException;

class Item
{

    const INSTOCK         = 'in stock';

    const OUTOFSTOCK      = 'out of stock';

    const PREORDER        = 'preorder';

    const BRANDNEW        = 'new';

    const USED            = 'used';

    const REFURBISHED     = 'refurbished';

    const MALE            = 'male';

    const FEMALE          = 'female';

    const UNISEX          = 'unisex';

    const NEWBORN         = 'newborn';

    const INFANT          = 'infant';

    const TODDLER         = 'toddler';

    const KIDS            = 'kids';

    const ADULT           = 'adult';

    const EXTRASMALL      = 'XS';

    const SMALL           = 'S';

    const MEDIUM          = 'M';

    const LARGE           = 'L';

    const EXTRALARGE      = 'XL';

    const EXTRAEXTRALARGE = 'XXL';

    /**
     * Stores all of the product nodes
     * @var Node
     */
    private $nodes = array();

    /**
     * Item index
     * @var string
     */
    private $index = null;

    /**
     * @var Feed
     */
    private $googleShoppingFeed = null;

    /**
     * [$namespace - (g:) namespace definition]
     * @var string
     */
    protected $namespace = 'http://base.google.com/ns/1.0';

    public function __construct($googleShoppingFeed)
    {
        $this->googleShoppingFeed = $googleShoppingFeed;
    }

    /**
     * @param $id
     */
    public function id($id)
    {
        
        $node = new Node('id');
        $this->nodes['id'] = $node->value($id)->_namespace($this->namespace);
    }

    /**
     * @param $title
     */
    public function title($title)
    {
        $node = new Node('title');
        $title = $this->safeCharEncodeText($title);
	    $this->nodes['title'] = $node->value($title)->_namespace($this->namespace);
    }

    /**
     * @param $link
     */
    public function link($link)
    {
        $node = new Node('link');
        $this->nodes['link'] = $node->value($link)->_namespace($this->namespace);
    }

    /**
     * @param $price
     */
    public function price($price)
    {
        /** @var $price - Added hack in for when the variants are being created it passes over the new ISO currency code which breaks number_format */


        $node = new Node('price');
        $this->nodes['price'] = $node->value($price)->_namespace($this->namespace);
    }

    /**
     * @param $salePrice
     */
    public function sale_price($salePrice)
    {
        /** @var $salePrice - Added hack in for when the variants are being created it passes over the new ISO currency code which breaks number_format */
        $node = new Node('sale_price');
        $this->nodes['sale_price'] = $node->value($salePrice)->_namespace($this->namespace);
    }

    /**
     * @param $description
     */
    public function description($description)
    {
        $description = preg_replace( "#<iframe[^>]+>[^<]?</iframe>#is", '', $description );
        $node = new Node('description');
        $description = $this->safeCharEncodeText($description);
        $this->nodes['description'] = $node->value(substr($description, 0, 5000))->_namespace($this->namespace);
    }

    /**
     * @param $condition
     */
    public function condition($condition)
    {
        $node = new Node('condition');
        $this->nodes['condition'] = $node->value($condition)->_namespace($this->namespace);
    }

    /**
     * @param $expirationDate
     */
    public function expiration_date($expirationDate)
    {
        $node = new Node('expiration_date');
        $this->nodes['expiration_date'] = $node->value($expirationDate)->_namespace($this->namespace);
    }

    /**
     * @param $imageLink
     */
    public function image_link($imageLink)
    {
        $node = new Node('image_link');
        $imageLink = $this->safeCharEncodeURL(urldecode($imageLink));
        $this->nodes['image_link'] = $node->value($imageLink)->_namespace($this->namespace);
    }

    /**
     * @param $brand
     */
    public function brand($brand)
    {
        $node = new Node('brand');
        $brand = $this->safeCharEncodeText($brand);
        $this->nodes['brand'] = $node->value($brand)->_namespace($this->namespace);
    }

    /**
     * @param $mpn
     */
    public function mpn($mpn)
    {
        $node = new Node('mpn');
        $this->nodes['mpn'] = $node->value($mpn)->_namespace($this->namespace);
    }

    /**
     * @param $gtin
     */
    public function gtin($gtin)
    {
        $node = new Node('gtin');
        $this->nodes['gtin'] = $node->value($gtin)->_namespace($this->namespace);
    }

    /**
     * @param $bundle
     */
    public function is_bundle($bundle)
    {
        $node = new Node('is_bundle');
        $this->nodes['is_bundle'] = $node->value($bundle)->_namespace($this->namespace);
    }

    /**
     * @param $identifier
     */
    public function identifier_exists($identifier)
    {
        $node = new Node('identifier_exists');
        $this->nodes['identifier_exists'] = $node->value($identifier)->_namespace($this->namespace);
    }

    /**
     * @param $productType
     */
    public function product_type($productType)
    {
        $node = new Node('product_type');
        $productType = $this->safeCharEncodeText($productType);
        $this->nodes['product_type'] = $node->value($productType)->_namespace($this->namespace);
    }

    /**
     * @param $googleProductCategory
     */
    public function google_product_category($googleProductCategory)
    {
        $node = new Node('google_product_category');
        $this->nodes['google_product_category'] = $node->value($googleProductCategory)->_namespace($this->namespace);
    }

    /**
     * @param $availability
     */
    public function availability($availability)
    {
        $node = new Node('availability');
        $this->nodes['availability'] = $node->value($availability)->_namespace($this->namespace);
    }

    /**
     * @param $availabilityDate
     */
    public function availability_date($availabilityDate)
    {
        $node = new Node('availability_date');
        $this->nodes['availability_date'] = $node->value($availabilityDate)->_namespace($this->namespace);
    }

    /**
     * @param $code
     * @param $service
     * @param $cost
     * @param null $region
     */
    public function shipping($code, $service, $cost, $region = null)
    {
        $node = new Node('shipping');
        $value = "<g:country>{$code}</g:country><g:service><![CDATA[{$service}]]></g:service><g:price>{$cost}</g:price>";

        if($region) {
          $value .= "<g:region>{$region}</g:region>";
        }

        if (! isset($this->nodes['shipping'])) {
            $this->nodes['shipping'] = array();
        }
        $this->nodes['shipping'][] = $node->value($value)->_namespace($this->namespace);
    }


    /**
     * @param $code
     * @param $service
     * @param $cost
     * @param null $region
     */
    public function tax($code, $ship, $rate, $region = null)
    {
        $node = new Node('tax');
        $value = "<g:country>{$code}</g:country><g:tax_ship><![CDATA[{$ship}]]></g:tax_ship><g:rate>{$rate}</g:rate>";

        if($region) {
            $value .= "<g:region>{$region}</g:region>";
        }

        if (! isset($this->nodes['tax'])) {
            $this->nodes['tax'] = array();
        }
        $this->nodes['tax'][] = $node->value($value)->_namespace($this->namespace);
    }

    /**
     * @param $weight
     */
    public function shipping_weight($weight)
    {
        $node = new Node('shipping_weight');
        $weight = $this->safeCharEncodeText($weight);
        $this->nodes['shipping_weight'] = $node->value($weight)->_namespace($this->namespace);
    }

    /**
     * @param $size
     */
    public function size($size)
    {
        $node = new Node('size');
        $this->nodes['size'] = $node->value($size)->_namespace($this->namespace);
    }

    /**
     * @param $gender
     */
    public function gender($gender)
    {
        $node = new Node('gender');
        $this->nodes['gender'] = $node->value($gender)->_namespace($this->namespace);
    }

    /**
     * @param $ageGroup
     */
    public function age_group($ageGroup)
    {
        $node = new Node('age_group');
        $this->nodes['age_group'] = $node->value($ageGroup)->_namespace($this->namespace);
    }

    /**
     * @param $color
     */
    public function color($color)
    {
        $node = new Node('color');
        $this->nodes['color'] = $node->value($color)->_namespace($this->namespace);
    }

    /**
     * @param $id
     */
    public function item_group_id($id)
    {
        $node = new Node('item_group_id');
        $this->nodes['item_group_id'] = $node->value($id)->_namespace($this->namespace);
    }

    /**
     * @param string $customLabel
     */
    public function custom_label_0($customLabel)
    {
        $node = new Node('custom_label_0');
        $this->nodes['custom_label_0'] = $node->value($customLabel)->_namespace($this->namespace);
    }

    /**
     * @param string $customLabel
     */
    public function custom_label_1($customLabel)
    {
        $node = new Node('custom_label_1');
        $this->nodes['custom_label_1'] = $node->value($customLabel)->_namespace($this->namespace);
    }

    /**
     * @param string $customLabel
     */
    public function custom_label_2($customLabel)
    {
        $node = new Node('custom_label_2');
        $this->nodes['custom_label_2'] = $node->value($customLabel)->_namespace($this->namespace);
    }

    /**
     * @param string $customLabel
     */
    public function custom_label_3($customLabel)
    {
        $node = new Node('custom_label_3');
        $this->nodes['custom_label_3'] = $node->value($customLabel)->_namespace($this->namespace);
    }

    /**
     * @param string $customLabel
     */
    public function custom_label_4($customLabel)
    {
        $node = new Node('custom_label_4');
        $this->nodes['custom_label_4'] = $node->value($customLabel)->_namespace($this->namespace);
    }

    /**
     * Adds a custom attribute to the shopping feed.
     *
     * @param string $name
     * @param string $value
     */
    public function custom($name, $value)
    {
        $node = new Node($name);
        $this->nodes[$name] = $node->value($value);
    }

    /**
     * Adds a custom attribute to the shopping feed with namespace.
     *
     * @param string $name
     * @param string $value
     */
    public function customWithNamespace($name, $value)
    {
        $node = new Node($name);
        $this->nodes[$name] = $node->value($value)->_namespace($this->namespace);
    }

    /**
     * Returns item nodes
     * @return array
     */
    public function nodes()
    {
        return $this->nodes;
    }

    /**
     * Sets item index
     * @param $index
     */
    public function setIndex($index)
    {
        $this->index = $index;
    }

    /**
     * Delete an item
     */
    public function delete()
    {
        $this->googleShoppingFeed->removeItemByIndex($this->index);
    }

    /**
     * @return string
     * @throws MissingIdentifierException
     */
    protected function getGroupIdentifier()
    {
        if( ! isset( $this->nodes['mpn'] ) && ! isset( $this->nodes['gtin'] ) ) {
            throw new MissingIdentifierException("Please define a GTIN or MPN value before creating a variant.");
        }
        if( isset( $this->nodes['mpn'] ) ) return $this->nodes['mpn']->get('value') . '_group';
        return $this->nodes['gtin']->get('value') . '_group';
    }

    /**
     * Clones an item
     * @return Item
     */
    public function cloneIt()
    {
       $groupIdentifiers = $this->getGroupIdentifier();
        /** @var Item $item */
        $item = $this->googleShoppingFeed->createItem();
        $this->item_group_id( $groupIdentifiers );
        foreach ($this->nodes as $node) {
            if (is_array($node)) {
                // multiple accepted values..
                $name = $node[0]->get('name');
                foreach ($node as $_node) {
                    if ($name == 'shipping') {
                        // Shipping has another layer so we are going to have to do a little hack
                        $xml = simplexml_load_string('<foo>' . trim(str_replace('g:', '', $_node->get('value'))) . '</foo>');
                        $item->{$_node->get('name')}($xml->country, $xml->service, $xml->price);
                    } else {
                        $item->{$name}($_node->get('value'));
                    }
                }
            } elseif ($node->get('name') !== 'shipping') {
                $item->{$node->get('name')}($node->get('value'));
            }
        }
        return $item;
    }

    /**
     * Create an item variant
     * @return mixed
     */
    public function variant()
    {
        /** @var Item $item */
        $item = $this->cloneIt();
        $item->item_group_id( $this->getGroupIdentifier() );
        return $item;
    }

    /**
     * @param string $string
     * @return string
     */
    private function safeCharEncodeURL($string)
    {
        return str_replace(
            array('%', '[', ']', '{', '}', '|', ' ', '"', '<', '>', '#', '\\', '^', '~', '`'),
            array('%25', '%5b', '%5d', '%7b', '%7d', '%7c', '%20', '%22', '%3c', '%3e', '%23', '%5c', '%5e', '%7e', '%60'),
        $string);
    }

    /**
     * @param string $string
     * @return string
     */
    private function safeCharEncodeText($string)
    {
        return str_replace(
            array('•', '”', '“', '’', '‘', '™', '®', '°', "\n"),
            array('&#8226;', '&#8221;', '&#8220;', '&#8217;', '&#8216;', '&trade;', '&reg;', '&deg;', ''),
        $string);
    }

    /**
     * @param $material
     */
    public function material($material)
    {
        $node = new Node('material');
        $this->nodes['material'] = $node->value($material)->_namespace($this->namespace);
    }

     /**
     * @param $pattern
     */
    public function pattern($pattern)
    {
        $node = new Node('pattern');
        $this->nodes['pattern'] = $node->value($pattern)->_namespace($this->namespace);
    }

    /**
     * Add one additional image (string) or multiple images (array).
     *
     * @param $imagesLink
     */
    public function additional_image_link($imagesLink)
    {
        $this->nodes['additional_image_link'] = [];
        if (is_array($imagesLink)) {
            foreach ($imagesLink as $imageLink) {
                $node = new Node('additional_image_link');
                $imageLink = $this->safeCharEncodeURL(urldecode($imageLink));
                array_push($this->nodes['additional_image_link'], $node->value($imageLink)->_namespace($this->namespace));
            }
        } else {
            $node = new Node('additional_image_link');
            $imageLink = $this->safeCharEncodeURL(urldecode($imagesLink));
            array_push($this->nodes['additional_image_link'], $node->value($imagesLink)->_namespace($this->namespace));
        }
    }


    /**
     * @param string $name
     * @param array $arguments
     */
    public function __call($name, $arguments)
    {
        // check if additional_image_link attributes
        if ( 0 === strpos( $name, 'additional_image_link_' ) ) {
            $name = 'additional_image_link';
            $node = new Node($name);
            $this->nodes[$name][] = $node->value($arguments[0])->_namespace($this->namespace);
        }else{ // other attributes
            $node = new Node($name);
            $this->nodes[$name] = $node->value($arguments[0])->_namespace($this->namespace);
        }
    }
}
