<?php
/**
 * Registering WordPress settings api for the plugin.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Responsible for managing settings api for the plugin.
 *
 * @since 2.12.15
 * @package SWPTLS
 */
class SettingsApi {

	/**
	 * Class constructor.
	 *
	 * @since 2.12.15
	 */
	public function __construct() {
		add_action( 'admin_init', [ $this, 'add_settings' ] );
	}

	/**
	 * Add settings.
	 *
	 * @return void
	 */
	public function add_settings() {
		$settings_options = swptls()->settings->generalSettingsOptions();

		foreach ( $settings_options as $setting ) {
			register_setting(
				'gswpts_general_setting',
				$setting,
				[
					'default' => 'asynchronous_loading' === $setting ? 'on' : false
				]
			);

		}
		self::add_section_and_fields();
	}

	/**
	 * Add section and fields
	 *
	 * @return void
	 */
	public static function add_section_and_fields() {
		add_settings_section(
			'gswpts_general_section_id',
			'',
			null,
			'gswpts-general-settings'
		);

		add_settings_field(
			'gswpts_general_settings_field_id',
			'',
			[ get_called_class(), 'fields' ],
			'gswpts-general-settings',
			'gswpts_general_section_id'
		);
	}

	/**
	 * Display settings fields.
	 *
	 * @return null
	 */
	public static function fields() {
		$settingsArray = swptls()->settings->generalSettingsArray();

		if ( ! $settingsArray ) {
			return;
		}

		echo '<div class="general_cards_container">';
		foreach ( $settingsArray as $setting ) {

			if ( isset( $setting['template_path'] ) ) {
				load_template( $setting['template_path'], false, $setting );
			}
		}
		echo '</div>';

	}
}