<?php
/**
 * Responsible for managing plugin admin area.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Responsible for registering admin menus.
 *
 * @since 2.12.15
 * @package SWPTLS
 */
class Admin {

	/**
	 * Class constructor.
	 *
	 * @since 2.12.15
	 */
	public function __construct() {
		add_action( 'admin_menu', [ $this, 'admin_menus' ] );
	}

	/**
	 * Registers admin menus.
	 *
	 * @since 2.12.15
	 */
	public function admin_menus() {
		add_menu_page(
			__( 'Sheets To Table', 'sheetstowptable' ),
			__( 'Sheets To Table', 'sheetstowptable' ),
			'manage_options',
			'gswpts-dashboard',
			[ $this, 'dashboardPage' ],
			SWPTLS_BASE_URL . 'assets/public/images/logo_20_20.svg'
		);

		add_submenu_page(
			'gswpts-dashboard',
			__( 'Dashboard', 'sheetstowptable' ),
			__( 'Dashboard', 'sheetstowptable' ),
			'manage_options',
			'gswpts-dashboard',
			[ $this, 'dashboardPage' ]
		);

		if ( swptls()->helpers->checkProPluginExists() && swptls()->helpers->isProActive() && function_exists( 'swptlspro' ) ) {
			add_submenu_page(
				'gswpts-dashboard',
				__( 'Manage Tab', 'sheetstowptable' ),
				__( 'Manage Tab', 'sheetstowptable' ),
				'manage_options',
				'gswpts-manage-tab',
				[ swptlspro()->admin, 'tabPage' ]
			);
		}

		add_submenu_page(
			'gswpts-dashboard',
			__( 'General Settings', 'sheetstowptable' ),
			__( 'General Settings', 'sheetstowptable' ),
			'manage_options',
			'gswpts-general-settings',
			[ $this, 'generalSettingsPage' ]
		);

		add_submenu_page(
			'gswpts-dashboard',
			__( 'Documentation', 'sheetstowptable' ),
			__( 'Documentation', 'sheetstowptable' ),
			'manage_options',
			'gswpts-documentation',
			[ $this, 'documentationPage' ]
		);

		add_submenu_page(
			'gswpts-dashboard',
			__( 'Recommended Plugins', 'sheetstowptable' ),
			__( 'Recommended Plugins', 'sheetstowptable' ),
			'manage_options',
			'gswpts-recommendation',
			[ $this, 'pluginRecommendationPage' ]
		);

		if ( ! swptls()->helpers->checkProPluginExists() ) {
			add_submenu_page(
				'gswpts-dashboard',
				__( 'Sheets To WP Table Live Sync Pro', 'sheetstowptable' ),
				__( "<span style='color: #ff3b00; font-weight: 900; font-size: 14px; letter-spacing: 1.2px'>Upgrade To Pro</span>", 'sheetstowptable' ),
				'manage_options',
				'https://go.wppool.dev/fu4'
			);
		}
	}

	/**
	 * Displays admin page.
	 *
	 * @return void
	 */
	public static function dashboardPage() {
		load_template( SWPTLS_BASE_PATH . 'app/templates/manage_tables.php', true );
	}

	/**
	 * Displays general settings page.
	 *
	 * @return void
	 */
	public static function generalSettingsPage() {
		load_template( SWPTLS_BASE_PATH . 'app/templates/general_settings.php', true );
	}

	/**
	 * Displays documentation pages.
	 *
	 * @return void
	 */
	public static function documentationPage() {
		load_template( SWPTLS_BASE_PATH . 'app/templates/documentation_page.php', true );
	}

	/**
	 * Displays plugin recommendation page.
	 *
	 * @return void.
	 */
	public static function pluginRecommendationPage() {
		load_template( SWPTLS_BASE_PATH . 'app/templates/recommendation_page.php', true );
	}
}