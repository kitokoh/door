<?php
/**
 * Represents as plugin base file.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS {

	// If direct access than exit the file.
	defined( 'ABSPATH' ) || exit;

	use \WPPOOL_Plugin;

	/**
	 * Represents as plugin base file.
	 *
	 * @since 2.12.15
	 */
	final class SWPTLS {

		/**
		 * Holds the instance of the plugin currently in use.
		 *
		 * @var SWPTLS\SWPTLS
		 */
		private static $instance = null;

		/**
		 * Contains the helpers methods.
		 *
		 * @var SWPTLS\Helpers
		 */
		public $helpers;

		/**
		 * Contains plugin notices.
		 *
		 * @var SWPTLS\Notices
		 */
		public $notices;

		/**
		 * Contains the plugin assets.
		 *
		 * @var SWPTLS\Assets
		 */
		public $assets;

		/**
		 * Contains the plugin multisite functionalities.
		 *
		 * @var SWPTLS\Multisite
		 */
		public $multisite;

		/**
		 * Contains the admin functionalities.
		 *
		 * @var SWPTLS\Admin
		 */
		public $admin;

		/**
		 * Contains the plugin settings.
		 *
		 * @var SWPTLS\Settings
		 */
		public $settings;

		/**
		 * Contains the plugin settings api.
		 *
		 * @var SWPTLS\SettingsApi
		 */
		public $settingsApi;

		/**
		 * Contains the plugin shortcode.
		 *
		 * @var SWPTLS\Shortcode
		 */
		public $shortcode;

		/**
		 * Contains the plugin database helpers.
		 *
		 * @var SWPTLS\Database
		 */
		public $database;

		/**
		 * Contains the plugin ajax endpoints.
		 *
		 * @var SWPTLS\Ajax
		 */
		public $ajax;

		/**
		 * Sets limits for generating tbody.
		 *
		 * @var int The maximum number of tbody elements that can be generated.
		 */
		const TBODY_MAX = 50;

		/**
		 * Main Plugin Instance.
		 *
		 * Insures that only one instance of the addon exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since  1.0.0
		 * @return SWPTLS\SWPTLS
		 */
		public static function getInstance() {
			if ( null === self::$instance || ! self::$instance instanceof self ) {
				self::$instance = new self();

				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Class constructor.
		 *
		 * @since 2.12.15
		 */
		public function init() {
			$this->includes();
			$this->loader();

			if ( swptls()->helpers->version_check() ) {
				return;
			}

			$this->appseroInit();
		}

		/**
		 * Load plugin classes.
		 *
		 * @since  2.12.15
		 * @return void
		 */
		private function loader() {
			add_action( 'admin_init', [ $this, 'redirection' ] );
			add_filter( 'plugin_action_links_' . plugin_basename( SWPTLS_PLUGIN_FILE ), [ $this, 'add_action_links' ] );

			register_activation_hook( SWPTLS_PLUGIN_FILE, [ $this, 'register_active_deactive_hooks' ] );

			$this->helpers     = new \SWPTLS\Helpers();
			$this->notices     = new \SWPTLS\Notices();
			$this->multisite   = new \SWPTLS\Multisite();
			$this->assets      = new \SWPTLS\Assets();
			$this->admin       = new \SWPTLS\Admin();
			$this->settings    = new \SWPTLS\Settings();
			$this->settingsApi = new \SWPTLS\SettingsApi();
			$this->shortcode   = new \SWPTLS\Shortcode();
			$this->database    = new \SWPTLS\Database();
			$this->ajax        = new \SWPTLS\Ajax();

			try {
				wppool_plugin_init( 'sheets_to_wp_table_live_sync' );
			} catch ( \Exception $e ) { // phpcs:ignore
				// Silence is golden.
			}
		}

		/**
		 * Instantiate plugin available classes.
		 *
		 * @since 2.12.15
		 */
		public function includes() {
			$dependencies = [
				'/vendor/autoload.php',
				'/lib/wppool/class-plugin.php',
				'/lib/appsero-client-extended/src/Client.php'
			];

			foreach ( $dependencies as $path ) {
				if ( ! file_exists( SWPTLS_BASE_PATH . $path ) ) {
					status_header( 500 );
					wp_die( esc_html__( 'Plugin is missing required dependencies. Please contact support for more information.', 'sheetstowptable' ) );
				}

				require SWPTLS_BASE_PATH . $path;
			}
		}

		/**
		 * Add plugin action links.
		 *
		 * @param array $links The plugin links.
		 * @return array
		 */
		public function add_action_links( $links ) {
			$plugin = [
				sprintf(
					'<a href="%s">%s</a>',
					esc_url( admin_url( 'admin.php?page=gswpts-dashboard' ) ),
					esc_html__( 'Dashboard', 'sheetstowptable' )
				),
				sprintf(
					'<a href="%s">%s</a>',
					esc_url( admin_url( 'admin.php?page=gswpts-general-settings' ) ),
					esc_html__( 'General Settings', 'sheetstowptable' )
				)
			];

			if ( ! $this->helpers->checkProPluginExists() ) {
				array_push(
					$plugin,
					sprintf(
						'<a style="font-weight: bold; color: #ff3b00; text-transform: uppercase; font-style: italic;"
							href="%s"
							target="blank">%s</a>',
						esc_url( 'https://go.wppool.dev/Si6' ),
						esc_html__( 'Get Pro', 'sheetstowptable' )
					)
				);
			}

			return array_merge( $links, $plugin );
		}

		/**
		 * Initialize appsero plugin.
		 *
		 * @since 2.12.15
		 */
		public function appseroInit() {
			$client = new \Appsero\Client(
				'e8bb9069-1a77-457b-b1e3-a961ce950e2f',
				__( 'Sheets To WP Table Live Sync', 'sheetstowptable' ),
				SWPTLS_PLUGIN_FILE
			);

			// Active insights.
			$client->insights()->init();
		}

		/**
		 * Redirect to admin page on plugin activation
		 *
		 * @since 1.0.0
		 */
		public function redirection() {
			$redirect_to_admin_page = absint( get_option( 'gswpts_activation_redirect', 0 ) );

			if ( 1 === $redirect_to_admin_page ) {
				delete_option( 'gswpts_activation_redirect' );
				wp_safe_redirect( admin_url( 'admin.php?page=gswpts-documentation' ) );
				exit;
			}
		}

		/**
		 * Registering activation and deactivation Hooks
		 *
		 * @param int $network_wide The network site ID.
		 * @return void
		 */
		public function register_active_deactive_hooks( $network_wide ) {
			swptls()->database->activation( $network_wide );

			add_option( 'gswpts_activation_redirect', 1 );

			if ( ! get_option( 'gswptsActivationTime' ) ) {
				add_option( 'gswptsActivationTime', time() );
			}

			// Review notice options.
			add_option( 'gswptsReviewNotice', false );

			add_option( 'deafaultNoticeInterval', ( time() + 7 * 24 * 60 * 60 ) );

			// Affiliate notice options.
			add_option( 'gswptsAffiliateNotice', false );
			add_option( 'deafaultAffiliateInterval', ( time() + 10 * 24 * 60 * 60 ) );

			// Make the async loading default.
			update_option( 'asynchronous_loading', 'on' );

			// Add manage tab option for managing table tab data.
			add_option( 'gswptsManageTabs', [] );

			flush_rewrite_rules();
		}
	}
}

namespace {
	// if direct access than exit the file.
	defined( 'ABSPATH' ) || exit;

	/**
	 * This function is responsible for running the main plugin.
	 *
	 * @since  2.12.15
	 * @return object SWPTLS\SWPTLS The plugin instance.
	 */
	function swptls() {
		return \SWPTLS\SWPTLS::getInstance();
	}
}