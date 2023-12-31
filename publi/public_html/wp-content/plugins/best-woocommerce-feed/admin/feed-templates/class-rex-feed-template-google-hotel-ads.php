<?php
/**
 * The google hotel ads marketplace Feed Template class.
 *
 * @link       https://rextheme.com
 * @since      1.1.4
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/admin/feed-templates/
 */

/**
 * Defines the attributes and template for google hotel ads marketplace feed.
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/admin/feed-templates/Rex_Feed_Template_Google_hotel_ads
 * @author     RexTheme <info@rextheme.com>
 */
class Rex_Feed_Template_Google_hotel_ads extends Rex_Feed_Abstract_Template {

	/**
	 * Define merchant's required and optional/additional attributes
	 *
	 * @return void
	 */
	protected function init_atts() {
		$this->attributes = array(
			'Required Information'    => array(
				'name'         => 'Name',
				'id'           => 'Id',
				'city'         => 'City',
				'country'      => 'Country',
				'addr1'        => 'Addr1',
				'body'         => 'Body',
				'main_phone'   => 'Main Phone',
				'mobile_phone' => 'Mobile Phone',
				'photo_day'    => 'Photo Day',
				'photo_month'  => 'Photo Month',
				'photo_height' => 'Photo Height',
				'photo_type'   => 'Photo Type',
				'photo_url'    => 'Photo Url',
				'photo_width'  => 'Photo Width',
				'photo_year'   => 'Photo Year',
				'postal_code'  => 'Postal Code',
				'province'     => 'Province',
			),
			'Recommended Information' => array(
				'addr2'           => 'Addr2',
				'fax'             => 'Fax',
				'latitude'        => 'Latitude',
				'longitude'       => 'Longitude',
				'num_reviews'     => 'Num Reviews',
				'number_of_rooms' => 'Number Of Rooms',
				'photo_link'      => 'Photo link',
				'photo_title'     => 'Photo title',
				'rating'          => 'Rating',
				'star_rating'     => 'Star Rating',
				'tdd'             => 'Tdd',
				'tollfree'        => 'Toll Free',
			),
			'Optional Information'    => array(
				'air_conditioned'            => 'Air Conditioned',
				'all_inclusive_available'    => 'All Inclusive Available',
				'author'                     => 'Author',
				'category'                   => 'Category',
				'child_friendly'             => 'Child Friendly',
				'date_day'                   => 'Date Day',
				'date_month'                 => 'Date Month',
				'date_year'                  => 'Date Year',
				'has_free_breakfast'         => 'Has Free Breakfast',
				'has_affiliated_golf_course' => 'Has Affiliated Golf Course',
				'has_airport_shuttle'        => 'Has Airport Shuttle',
				'has_bar_or_lounge'          => 'Has Bar Or Lounge',
				'has_beach_access'           => 'Has Beach Access',
				'has_business_center'        => 'Has Business Center',
				'has_fitness_center'         => 'Has Fitness Center',
				'has_hot_tub'                => 'Has Hot Tub',
				'has_laundry_service'        => 'Has Laundry Service',
				'has_restaurant'             => 'Has Restaurant',
				'has_room_service'           => 'Has Room Service',
				'has_spa'                    => 'Has Spa',
				'kitchen_availability'       => 'Kitchen Availability',
				'link'                       => 'Link',
				'parking_type'               => 'Parking Type',
				'pets_allowed'               => 'Pets Allowed',
				'photo_author'               => 'Photo Author',
				'review_author'              => 'Review Author',
				'review_body'                => 'Review Body',
				'review_day'                 => 'Review Day',
				'review_link'                => 'Review Link',
				'review_month'               => 'Review Month',
				'review_rating'              => 'Review Rating',
				'review_title'               => 'Review Title',
				'review_type'                => 'Review Type',
				'review_year'                => 'Review Year',
				'smoke_free_property'        => 'Smoke Free Property',
				'swimming_pool_type'         => 'Swimming Pool Type',
				'title'                      => 'Title',
				'website'                    => 'Website',
				'wheelchair_accessible'      => 'Wheelchair Accessible',
				'wifi_type'                  => 'Wifi Type',
			),

		);
	}

	/**
	 * Define merchant's default attributes
	 *
	 * @return void
	 */
	protected function init_default_template_mappings() {
		$this->template_mappings = array(
			array(
				'attr'     => 'name',
				'type'     => 'meta',
				'meta_key' => 'title',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'id',
				'type'     => 'meta',
				'meta_key' => 'id',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'city',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'country',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'addr1',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'body',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'main_phone',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_day',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'mobile_phone',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_height',
				'type'     => 'meta',
				'meta_key' => 'id',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_month',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_type',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_url',
				'type'     => 'meta',
				'meta_key' => 'link',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_width',
				'type'     => 'meta',
				'meta_key' => 'width',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'photo_year',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'postal_code',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
			array(
				'attr'     => 'province',
				'type'     => 'static',
				'meta_key' => '',
				'st_value' => '',
				'prefix'   => '',
				'suffix'   => '',
				'escape'   => 'default',
				'limit'    => 0,
			),
		);
	}
}
