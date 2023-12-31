<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Rex_Product_Feed
 * @subpackage Rex_Product_Feed/includes
 * @author     RexTheme <info@rextheme.com>
 */
class Rex_Product_Feed_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$schedules = apply_filters(
			'wpfm_action_schedules',
			array(
				'hourly' => 60,
				'daily'  => 1440,
				'weekly' => 10080,
			)
		);
		foreach ( $schedules as $key => $value ) {
			if ( function_exists( 'as_next_scheduled_action' ) && as_next_scheduled_action( "wpfm_{$key}_schedule_update_hook" ) ) {
				as_unschedule_all_actions( "wpfm_{$key}_schedule_update_hook" );
			}
		}

		wp_clear_scheduled_hook( 'rex_feed_schedule_update' );
		wp_clear_scheduled_hook( 'rex_feed_weekly_update' );
		wp_clear_scheduled_hook( 'rex_feed_daily_update' );

		delete_option( 'rex_wpfm_feed_queue' );
		$args = array(
			'posts_per_page' => -1,
			'post_type'      => 'product-feed',
			'post_status'    => 'publish',
			'fields'         => 'ids',
		);

		$feeds = get_posts( $args );
		foreach ( $feeds as $feed_id ) {
			update_post_meta( $feed_id, '_rex_feed_status', 'completed' );
		}

		// https://stackoverflow.com/questions/55952451/wordpress-stop-process-for-wp-background-processing.
		global $wpdb;
		$sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
            FROM  {$wpdb->options}
            WHERE `option_name` LIKE %s
            ORDER BY `option_name`";

		$wild    = '%';
		$find    = 'wp_rex_product_feed_background_process_cron';
		$like    = $wild . $wpdb->esc_like( $find ) . $wild;
		$results = $wpdb->get_results( $wpdb->prepare( $sql, $like ) ); //phpcs:ignore

		foreach ( $results as $result ) {
			delete_option( $result->name );
		}

		$wp_background_process = new Rex_Product_Feed_Background_Process();
		$wp_background_process->cancel_process();
	}
}
