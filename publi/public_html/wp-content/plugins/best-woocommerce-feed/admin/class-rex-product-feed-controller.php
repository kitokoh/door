<?php
/**
 * Class Rex_Product_Feed_Controller
 *
 * @link       https://rextheme.com
 * @since      2.0.0
 *
 * @package    Rex_Product_Feed_Controller
 * @subpackage Rex_Product_Feed/admin
 */

/**
 * The Rex_Product_Feed_Controller class file that
 * control the feed
 *
 * @link       https://rextheme.com
 * @since      2.0.0
 *
 * @package    Rex_Product_Feed_Controller
 * @subpackage Rex_Product_Feed/admin
 */
class Rex_Product_Feed_Controller {

	/**
	 * Returns the current feed queue
	 *
	 * @return array
	 */
	public static function get_feed_queue() {
		return null !== get_option( 'rex_wpfm_feed_queue' ) ? get_option( 'rex_wpfm_feed_queue' ) : array();
	}

	/**
	 * Add feed id to feed queue
	 *
	 * @param string|int $feed_id Feed ID.
	 */
    public static function add_id_to_feed_queue( $feed_id ) {
        $feed_queue_ids   = self::get_feed_queue();
        $feed_queue_ids[] = $feed_id;
        update_option( 'rex_wpfm_feed_queue', $feed_queue_ids );
    }

	/**
	 * Remove feed id from feed queue
	 *
	 * @param string $feed_id Feed ID.
	 */
	public static function remove_id_from_feed_queue( $feed_id ) {
		$feed_queue_ids = self::get_feed_queue();

		$key = array_search( $feed_id, $feed_queue_ids );

		if ( false !== $key ) {
			unset( $feed_queue_ids[ $key ] );
			$feed_queue = array_values( $feed_queue_ids ); // resort after unset
			update_option( 'rex_wpfm_feed_queue', $feed_queue );
		}
	}

	/**
	 * Empties the feed queue
	 */
	public static function clear_feed_queue() {
		update_option( 'rex_wpfm_feed_queue', array() );
	}

	/**
	 * Check feed id is present in the queue
	 *
	 * @param string|int $feed_id Feed ID.
	 */
	public static function check_feed_id_in_queue( $feed_id ) {
		$feed_queue_ids = self::get_feed_queue();
		return !empty( $feed_queue_ids ) && in_array( $feed_id, $feed_queue_ids );
	}

	/**
	 * Update feed status
	 *
	 * @param string $feed_id Feed ID.
	 * @param string $status Feed status.
	 */
	public static function update_feed_status( $feed_id, $status ) {
		update_post_meta( $feed_id, '_rex_feed_status', $status );
	}
}


