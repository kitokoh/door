<?php
/**
 * Responsible for enqueuing assets.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Responsible for enqueuing assets.
 *
 * @since 2.12.15
 * @package SWPTLS
 */
class Assets {

	/**
	 * Class constructor.
	 *
	 * @since 2.12.15
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'backendFiles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'frontendFiles' ] );

		add_action( 'enqueue_block_editor_assets', [ $this, 'gutenbergFiles' ] );
	}

	/**
	 * Enqueue backend files.
	 *
	 * @since 2.12.15
	 */
	public function backendFiles() {
		$current_screen = get_current_screen();
		$valid_screens  = [
			'sheets-to-table_page_gswpts-recommendation',
			'toplevel_page_gswpts-dashboard',
			'sheets-to-table_page_gswpts-manage-tab',
			'sheets-to-table_page_gswpts-general-settings',
			'sheets-to-table_page_gswpts-documentation',
			'sheets-to-table_page_sheets_to_wp_table_live_sync_pro_settings'
		];

		if ( in_array( $current_screen->id, $valid_screens, true ) || $current_screen->is_block_editor() ) {
			$this->semanticFiles();
			$this->dataTableStyles();
			$this->dataTableScripts();

			do_action( 'gswpts_export_dependency_backend' );

			/* CSS Files */
			wp_enqueue_style(
				'GSWPTS-alert-css',
				SWPTLS_BASE_URL . 'assets/public/package/alert.min.css',
				[],
				SWPTLS_VERSION,
				'all'
			);

			wp_enqueue_style(
				'GSWPTS-fontawesome',
				SWPTLS_BASE_URL . 'assets/public/icons/fontawesome/css/all.min.css',
				[],
				SWPTLS_VERSION,
				'all'
			);

			wp_enqueue_style(
				'GSWPTS-admin-css',
				SWPTLS_BASE_URL . 'assets/public/styles/admin.min.css',
				[],
				SWPTLS_VERSION,
				'all'
			);

			$this->tableStylesCss();

			/* Javascript Files */
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-draggable' );
			wp_enqueue_script( 'jquery-ui-droppable' );
			wp_enqueue_script(
				'GSWPTS-fontawesome',
				SWPTLS_BASE_URL . 'assets/public/icons/fontawesome/css/all.min.js',
				[],
				SWPTLS_VERSION,
				true
			);

			wp_enqueue_script(
				'GSWPTS-admin-js',
				SWPTLS_BASE_URL . 'assets/public/scripts/backend/admin.min.js',
				[ 'jquery', 'jquery-ui-draggable', 'jquery-ui-droppable' ],
				SWPTLS_VERSION,
				true
			);

			$iconsURLs = apply_filters( 'export_buttons_logo_backend', false );

			wp_localize_script( 'GSWPTS-admin-js', 'file_url', [
				'admin_ajax'   => esc_url( admin_url( 'admin-ajax.php' ) ),
				'iconsURL'     => $iconsURLs,
				'isProActive'  => swptls()->helpers->isProActive(),
				'tableStyles'  => swptls()->settings->tableStylesArray(),
				'renameIcon'   => SWPTLS_BASE_URL . 'assets/public/icons/rename.svg',
				'dasboardURL'  => esc_url( admin_url( 'admin.php?page=gswpts-dashboard' ) ),
				'manageTabURL' => esc_url( admin_url( 'admin.php?page=gswpts-manage-tab' ) )
			]);
		}

		if ( 'sheets-to-table_page_gswpts-general-settings' === $current_screen->id ) {
			wp_enqueue_script(
				'GSWPTS-cssCodeEditor',
				SWPTLS_BASE_URL . 'assets/public/common/editor/ace.js',
				[],
				SWPTLS_VERSION,
				true
			);

			wp_enqueue_script(
				'GSWPTS-modeCSS',
				SWPTLS_BASE_URL . 'assets/public/common/editor/mode-css.js',
				[],
				SWPTLS_VERSION,
				true
			);

			wp_enqueue_script(
				'GSWPTS-workerCSS',
				SWPTLS_BASE_URL . 'assets/public/common/editor/worker-css.js',
				[],
				SWPTLS_VERSION,
				true
			);

			wp_enqueue_script(
				'GSWPTS-vibrantCSS',
				SWPTLS_BASE_URL . 'assets/public/common/editor/vibrant-ink.js',
				[],
				SWPTLS_VERSION,
				true
			);
		}

		$headway_screens = [
			'toplevel_page_gswpts-dashboard',
			'sheets-to-table_page_gswpts-manage-tab',
			'sheets-to-table_page_gswpts-general-settings',
			'sheets-to-table_page_gswpts-documentation',
			'sheets-to-table_page_gswpts-recommendation'
		];

		if ( in_array( $current_screen->id, $headway_screens, true ) ) {
			wp_enqueue_script(
				'headway-app',
				'https://cdn.headwayapp.co/widget.js',
				'',
				SWPTLS_VERSION,
				true
			);

			wp_add_inline_script(
				'headway-app',
				'var HW_config = { selector: ".gswpts_changelogs", account: "7kPL5J" }',
				'before'
			);
		}
	}

	/**
	 * Enqueue frontend files.
	 *
	 * @since 2.12.15
	 */
	public function frontendFiles() {
		wp_enqueue_script( 'jquery' );

		$this->frontendTablesAssets();

		do_action( 'gswpts_export_dependency_frontend' );

		wp_enqueue_style(
			'GSWPTS-frontend-css',
			SWPTLS_BASE_URL . 'assets/public/styles/frontend.min.css',
			[],
			SWPTLS_VERSION,
			'all'
		);
		$this->tableStylesCss();

		wp_enqueue_script(
			'GSWPTS-frontend-js',
			SWPTLS_BASE_URL . 'assets/public/scripts/frontend/frontend.min.js',
			[ 'jquery', 'jquery-ui-draggable' ],
			SWPTLS_VERSION,
			true
		);

		$iconsURLs = apply_filters( 'export_buttons_logo_frontend', false );

		wp_localize_script('GSWPTS-frontend-js', 'front_end_data', [
			'admin_ajax'           => esc_url( admin_url( 'admin-ajax.php' ) ),
			'asynchronous_loading' => get_option( 'asynchronous_loading' ) === 'on' ? 'on' : 'off',
			'isProActive'          => swptls()->helpers->isProActive(),
			'iconsURL'             => $iconsURLs
		]);
	}

	/**
	 * Enqueue semantic files.
	 *
	 * @since 2.12.15
	 */
	public function semanticFiles() {
		wp_enqueue_style(
			'GSWPTS-semanticui-css',
			SWPTLS_BASE_URL . 'assets/public/common/semantic/semantic.min.css',
			[],
			SWPTLS_VERSION,
			'all'
		);

		wp_enqueue_script(
			'GSWPTS-semantic-js',
			SWPTLS_BASE_URL . 'assets/public/common/semantic/semantic.min.js',
			[ 'jquery' ],
			SWPTLS_VERSION,
			false
		);
	}

	/**
	 * Enqueue semantic files.
	 *
	 * @since 2.12.15
	 */
	public function frontendTablesAssets() {
		wp_enqueue_script(
			'GSWPTS-frontend-table',
			SWPTLS_BASE_URL . 'assets/public/common/datatables/tables/js/jquery.datatables.min.js',
			[ 'jquery' ],
			SWPTLS_VERSION,
			false
		);

		wp_enqueue_script(
			'GSWPTS-frontend-semantic',
			SWPTLS_BASE_URL . 'assets/public/common/datatables/tables/js/datatables.semanticui.min.js',
			[ 'jquery' ],
			SWPTLS_VERSION,
			false
		);
	}

	/**
	 * Enqueue data tables scripts.
	 *
	 * @since 2.12.15
	 */
	public function dataTableScripts() {
		wp_enqueue_script(
			'GSWPTS-jquery-dataTable-js',
			SWPTLS_BASE_URL . 'assets/public/common/datatables/tables/js/jquery.datatables.min.js',
			[ 'jquery' ],
			SWPTLS_VERSION,
			true
		);

		wp_enqueue_script(
			'GSWPTS-dataTable-semanticui-js',
			SWPTLS_BASE_URL . 'assets/public/common/datatables/tables/js/datatables.semanticui.min.js',
			[ 'jquery' ],
			SWPTLS_VERSION,
			true
		);
	}

	/**
	 * Enqueue data tables styles.
	 *
	 * @since 2.12.15
	 */
	public function dataTableStyles() {
		wp_enqueue_style(
			'GSWPTS-semanticui-css',
			SWPTLS_BASE_URL . 'assets/public/common/semantic/semantic.min.css',
			[],
			SWPTLS_VERSION,
			'all'
		);

		wp_enqueue_style(
			'GSWPTS-dataTable-semanticui-css',
			SWPTLS_BASE_URL . 'assets/public/common/datatables/tables/css/datatables.semanticui.min.css',
			[],
			SWPTLS_VERSION,
			'all'
		);
	}

	/**
	 * Enqueue gutenberg files.
	 *
	 * @since 2.12.15
	 */
	public function gutenbergFiles() {
		wp_enqueue_style(
			'GSWPTS-gutenberg-css',
			SWPTLS_BASE_URL . 'assets/public/styles/gutenberg.min.css',
			[],
			SWPTLS_VERSION,
			'all'
		);

		wp_enqueue_script(
			'gswpts-gutenberg',
			SWPTLS_BASE_URL . 'assets/public/scripts/backend/gutenberg/gutenberg.min.js',
			[ 'wp-blocks', 'wp-i18n', 'wp-editor', 'wp-element', 'wp-components', 'jquery' ],
			SWPTLS_VERSION,
			true
		);

		register_block_type(
			'gswpts/google-sheets-to-wp-tables',
			[
				'description'   => __( 'Display Google Spreadsheet data to WordPress table in just a few clicks
				and keep the data always synced. Organize and display all your spreadsheet data in your WordPress quickly and effortlessly.', 'sheetstowptable' ),
				'title'         => __( 'Sheets To WP Table Live Sync', 'sheetstowptable' ),
				'editor_script' => 'gswpts-gutenberg',
				'editor_style'  => 'GSWPTS-gutenberg-css'
			]
		);

		$this->semanticFiles();
		$this->dataTableStyles();
		$this->dataTableScripts();
		$this->tableStylesCss();

		wp_localize_script(
			'gswpts-gutenberg',
			'gswpts_gutenberg_block',
			[
				'admin_ajax'       => esc_url( admin_url( 'admin-ajax.php' ) ),
				'table_details'    => swptls()->database->fetchTables(),
				'isProActive'      => swptls()->helpers->isProActive(),
				'tableStyles'      => swptls()->settings->tableStylesArray(),
				'scrollHeights'    => swptls()->settings->scrollHeightArray(),
				'responsiveStyles' => swptls()->settings->responsiveStyle(),
				'nonce'            => wp_create_nonce( 'gswpts_sheet_nonce_action' ),
				'create_nonce'     => wp_create_nonce( 'swptls_sheet_creation_nonce' )
			]
		);
	}

	/**
	 * Enqueue table style css.
	 *
	 * @return null
	 */
	public function tableStylesCss() {
		$stylesArray = swptls()->settings->tableStylesArray();
		$stylesArray = apply_filters( 'gswpts_table_styles_path', $stylesArray );

		if ( ! $stylesArray ) {
			return;
		}

		foreach ( $stylesArray as $key => $style ) {
			$tableStyleFileURL  = isset( $style['cssURL'] ) ? $style['cssURL'] : '';
			$tableStyleFilePath = isset( $style['cssPath'] ) ? $style['cssPath'] : '';

			if ( file_exists( $tableStyleFilePath ) ) {
				wp_enqueue_style( 'gswptsProTable_' . $key . '', $tableStyleFileURL, [], SWPTLS_VERSION, 'all' );
			}
		}
	}
}