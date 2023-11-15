<?php
/**
 * Responsible for displaying settings fields.
 *
 * @since 2.12.15
 * @package SWPTLS
 */

namespace SWPTLS;

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

/**
 * Display settings fields.
 *
 * @since 2.12.15
 */
class Settings {

	/**
	 * Gets rows per page.
	 *
	 * @return array
	 */
	public function rowsPerPage(): array {
		$rowsPerPage = [
			'1'   => [
				'val'   => 1,
				'isPro' => false
			],
			'5'   => [
				'val'   => 5,
				'isPro' => false
			],
			'10'  => [
				'val'   => 10,
				'isPro' => false
			],
			'15'  => [
				'val'   => 15,
				'isPro' => false
			],
			'25'  => [
				'val'   => 25,
				'isPro' => true
			],
			'50'  => [
				'val'   => 50,
				'isPro' => true
			],
			'100' => [
				'val'   => 100,
				'isPro' => true
			],
			'all' => [
				'val'   => 'All',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_rows_per_page', $rowsPerPage );
	}

	/**
	 * Load select field html.
	 *
	 * @param  array $values The select options.
	 * @return null|void
	 */
	public function selectFieldHTML( array $values ) {
		if ( ! $values ) {
			return;
		}

		load_template( SWPTLS_BASE_PATH . 'app/templates/parts/select_values.php', false, $values );
	}

	/**
	 * Scroll height values.
	 *
	 * @return array
	 */
	public function scrollHeightArray(): array {
		$scrollHeights = [
			'200'  => [
				'val'   => '200px',
				'isPro' => true
			],
			'400'  => [
				'val'   => '400px',
				'isPro' => true
			],
			'500'  => [
				'val'   => '500px',
				'isPro' => true
			],
			'600'  => [
				'val'   => '600px',
				'isPro' => true
			],
			'700'  => [
				'val'   => '700px',
				'isPro' => true
			],
			'800'  => [
				'val'   => '800px',
				'isPro' => true
			],
			'900'  => [
				'val'   => '900px',
				'isPro' => true
			],
			'1000' => [
				'val'   => '1000px',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_table_scorll_height', $scrollHeights );
	}

	/**
	 * Display settings.
	 *
	 * @return array
	 */
	public function displaySettingsArray(): array {
		$settingsArray = [
			'table_title'          => [
				'feature_title' => __( 'Table Title', 'sheetstowptable' ),
				'feature_desc'  => __( 'Enable this to show the table title in <i>h3</i> tag above the table in your website front-end', 'sheetstowptable' ),
				'input_name'    => 'show_title',
				'checked'       => false,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			],
			'show_info_block'      => [
				'feature_title' => __( 'Show info block', 'sheetstowptable' ),
				'feature_desc'  => __( 'Show <i>Showing X to Y of Z entries</i>block below the table', 'sheetstowptable' ),
				'input_name'    => 'info_block',
				'checked'       => true,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			],
			'show_x_entries'       => [
				'feature_title' => __( 'Show X entries', 'sheetstowptable' ),
				'feature_desc'  => __( '<i>Show X entries</i> per page dropdown', 'sheetstowptable' ),
				'input_name'    => 'show_entries',
				'checked'       => true,
				'type'          => 'checkbox',
				'show_tooltip'  => true

			],
			'swap_filters'         => [
				'feature_title' => __( 'Swap Filters', 'sheetstowptable' ),
				'feature_desc'  => __( 'Swap the places of <i> X entries</i> dropdown & search filter input', 'sheetstowptable' ),
				'input_name'    => 'swap_filter_inputs',
				'checked'       => false,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			],
			'swap_bottom_elements' => [
				'feature_title' => __( 'Swap Bottom Elements', 'sheetstowptable' ),
				'feature_desc'  => __( 'Swap the places of <i>Showing X to Y of Z entries</i> with table pagination filter', 'sheetstowptable' ),
				'input_name'    => 'swap_bottom_options',
				'checked'       => false,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			],
			'responsive_style'     => [
				'feature_title' => __( 'Responsive Style', 'sheetstowptable' ),
				'feature_desc'  => __( 'Allow the table to collapse or scroll on mobile and tablet screen.', 'sheetstowptable' ),
				'input_name'    => 'responsive_style',
				'is_pro'        => true,
				'type'          => 'select',
				'values'        => $this->responsiveStyle(),
				'default_text'  => 'Collapsible Table',
				'default_value' => 'default_style',
				'show_tooltip'  => true
			],
			'rows_per_page'        => [
				'feature_title' => __( 'Rows per page', 'sheetstowptable' ),
				'feature_desc'  => __( 'This will show rows per page. The feature will allow you how many rows you want to show to your user by default.', 'sheetstowptable' ),
				'input_name'    => 'rows_per_page',
				'type'          => 'select',
				'values'        => $this->rowsPerPage(),
				'default_text'  => 'Rows Per Page',
				'default_value' => 10,
				'show_tooltip'  => true
			],
			'vertical_scrolling'   => [
				'feature_title' => __( 'Table Height', 'sheetstowptable' ),
				'feature_desc'  => __( 'Choose the height of the table to scroll vertically. Activating this feature will allow the table to behave as sticky header', 'sheetstowptable' ),
				'input_name'    => 'vertical_scrolling',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'select',
				'values'        => $this->scrollHeightArray(),
				'default_text'  => 'Choose Height',
				'default_value' => swptls()->helpers->isProActive() ? 'default' : null,
				'show_tooltip'  => false
			],
			'cell_format'          => [
				'feature_title' => __( 'Format Cell', 'sheetstowptable' ),
				'feature_desc'  => __( 'Format the table cell as like google sheet cell formatting. Format your cell as Wrap OR Expanded style', 'sheetstowptable' ),
				'input_name'    => 'cell_format',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'select',
				'values'        => $this->cellFormattingArray(),
				'default_text'  => 'Cell Format',
				'default_value' => swptls()->helpers->isProActive() ? 'expand' : null,
				'show_tooltip'  => true
			],
			'redirection_type'     => [
				'feature_title' => __( 'Link Type', 'sheetstowptable' ),
				'feature_desc'  => __( 'Choose the redirection type of all the links in this table.', 'sheetstowptable' ),
				'input_name'    => 'redirection_type',
				'is_pro'        => true,
				'type'          => 'select',
				'values'        => $this->redirectionTypeArray(),
				'default_text'  => 'Redirection Type',
				'default_value' => swptls()->helpers->isProActive() ? '_self' : null,
				'show_tooltip'  => true
			],
			'table_style'          => [
				'feature_title' => __( 'Table Style', 'sheetstowptable' ),
				'feature_desc'  => __( 'Choose your desired table style for this table. This will change the design & color of this table according to your selected table design', 'sheetstowptable' ),
				'input_name'    => 'table_style',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'custom-type',
				'default_text'  => 'Choose Style',
				'show_tooltip'  => false,
				'icon_url'      => SWPTLS_BASE_URL . 'assets/public/icons/table_style.svg'
			],
			'import_styles'        => [
				'feature_title' => __( 'Import Sheet Styles', 'sheetstowptable' ),
				'feature_desc'  => __( 'Import cell background color & cell font color from google sheet. If you activate this feature it will overrider <i>Table Style</i> setting', 'sheetstowptable' ),
				'input_name'    => 'import_styles',
				'is_pro'        => true,
				'type'          => 'checkbox',
				'checked'       => false,
				'show_tooltip'  => true
			]
		];

		return apply_filters( 'gswpts_display_settings_arr', $settingsArray );
	}

	/**
	 * Responsive styles.
	 *
	 * @return array
	 */
	public function responsiveStyle() {
		$responsiveStyles = [
			'default_style'  => [
				'val'   => 'Default Style',
				'isPro' => false
			],
			'collapse_style' => [
				'val'   => 'Collapsible Style',
				'isPro' => true
			],
			'scroll_style'   => [
				'val'   => 'Scrollable Style',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_responsive_styles', $responsiveStyles );
	}

	/**
	 * Set redirection type.
	 *
	 * @return mixed
	 */
	public function redirectionTypeArray(): array {
		$redirectionTypes = [
			'_blank' => [
				'val'   => 'Blank Type',
				'isPro' => true
			],
			'_self'  => [
				'val'   => 'Self Type',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_redirection_types', $redirectionTypes );
	}

	/**
	 * Cell formatting array.
	 *
	 * @return array
	 */
	public function cellFormattingArray(): array {
		$cellFormats = [
			'wrap'   => [
				'val'   => 'Wrap Style',
				'isPro' => true
			],
			'expand' => [
				'val'   => 'Expanded Style',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_cell_format', $cellFormats );
	}

	/**
	 * Display settings html.
	 *
	 * @return null
	 */
	public function displaySettingsHTML() {
		$settingsArray = $this->displaySettingsArray();

		if ( ! $settingsArray ) {
			return;
		}

		foreach ( $settingsArray as $key => $setting ) {
			load_template( SWPTLS_BASE_PATH . 'app/templates/parts/indiviual_feature.php', false, $setting );
		}
	}

	/**
	 * Sort and filter settings array.
	 *
	 * @return array
	 */
	public function sortAndFilterSettingsArray(): array {
		$settingsArray = [
			'allow_sorting' => [
				'feature_title' => __( 'Allow Sorting', 'sheetstowptable' ),
				'feature_desc'  => __( 'Enable this feature to sort table data for frontend.', 'sheetstowptable' ),
				'input_name'    => 'sorting',
				'checked'       => true,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			],
			'search_bar'    => [
				'feature_title' => __( 'Search Bar', 'sheetstowptable' ),
				'feature_desc'  => __( 'Enable this feature to show a search bar in for the table. It will help user to search data in the table', 'sheetstowptable' ),
				'input_name'    => 'search_table',
				'checked'       => true,
				'type'          => 'checkbox',
				'show_tooltip'  => true
			]
		];

		return apply_filters( 'gswpts_sortfilter_settings_arr', $settingsArray );
	}

	/**
	 * Sort and filter html.
	 *
	 * @return null
	 */
	public function sortAndFilterHTML() {
		$settingsArray = $this->sortAndFilterSettingsArray();

		if ( ! $settingsArray ) {
			return;
		}

		foreach ( $settingsArray as $key => $setting ) {
			load_template( SWPTLS_BASE_PATH . 'app/templates/parts/indiviual_feature.php', false, $setting );
		}
	}

	/**
	 * Table tools array.
	 *
	 * @return array
	 */
	public function tableToolsArray(): array {
		$settingsArray = [
			'table_export' => [
				'feature_title' => __( 'Table Exporting', 'sheetstowptable' ),
				'feature_desc'  => __( 'Enable this feature in order to allow your user to download your table content as various format.', 'sheetstowptable' ),
				'input_name'    => 'table_exporting',
				'is_pro'        => true,
				'type'          => 'multi-select',
				'values'        => $this->tableExportValues(),
				'default_text'  => 'Choose Type',
				'show_tooltip'  => true
			],
			'hide_column'  => [
				'feature_title' => __( 'Hide Column', 'sheetstowptable' ),
				'feature_desc'  => __( 'Hide your table columns based on multiple screen sizes.', 'sheetstowptable' ),
				'input_name'    => 'hide_column',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'custom-type',
				'default_text'  => 'Hide Column',
				'show_tooltip'  => false,
				'icon_url'      => SWPTLS_BASE_URL . 'assets/public/icons/hide_column.svg'
			],
			'hide_rows'    => [
				'feature_title' => __( 'Hide Row\'s', 'sheetstowptable' ),
				'feature_desc'  => __( 'Hide your table rows based on your custom selection', 'sheetstowptable' ),
				'input_name'    => 'hide_rows',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'custom-type',
				'default_text'  => 'Hide Row',
				'show_tooltip'  => false,
				'icon_url'      => SWPTLS_BASE_URL . 'assets/public/icons/hide_column.svg'
			],
			'hide_cell'    => [
				'feature_title' => __( 'Hide Cell', 'sheetstowptable' ),
				'feature_desc'  => __( 'Hide your specific table cell that is not going to visibile to your user\'s.', 'sheetstowptable' ),
				'input_name'    => 'hide_cell',
				'checked'       => false,
				'is_pro'        => true,
				'type'          => 'custom-type',
				'default_text'  => 'Hide Cell',
				'show_tooltip'  => false,
				'icon_url'      => SWPTLS_BASE_URL . 'assets/public/icons/hide_column.svg'
			]
		];

		return apply_filters( 'gswpts_table_tools_settings_arr', $settingsArray );
	}

	/**
	 * Table export values.
	 *
	 * @return array
	 */
	public function tableExportValues(): array {
		$exportValues = [
			'json'  => [
				'val'   => 'JSON',
				'isPro' => true
			],
			'pdf'   => [
				'val'   => 'PDF',
				'isPro' => true
			],
			'csv'   => [
				'val'   => 'CSV',
				'isPro' => true
			],
			'excel' => [
				'val'   => 'Excel',
				'isPro' => true
			],
			'print' => [
				'val'   => 'Print',
				'isPro' => true
			],
			'copy'  => [
				'val'   => 'Copy',
				'isPro' => true
			]
		];

		return apply_filters( 'gswpts_table_export_values', $exportValues );
	}

	/**
	 * Table tools HTML.
	 *
	 * @return null
	 */
	public function tableToolsHTML() {
		$settingsArray = $this->tableToolsArray();

		if ( ! $settingsArray ) {
			return;
		}

		foreach ( $settingsArray as $key => $setting ) {
			load_template( SWPTLS_BASE_PATH . 'app/templates/parts/indiviual_feature.php', false, $setting );
		}
	}

	/**
	 * General settings array.
	 *
	 * @return array
	 */
	public function generalSettingsArray(): array {
		$optionValues = $this->getOptionValues();

		$settingsArray = [
			'asynchronous_loading' => [
				'template_path'   => SWPTLS_BASE_PATH . 'app/templates/parts/general_settings.php',
				'setting_title'   => __( 'Asynchronous Loading', 'sheetstowptable' ),
				'setting_tooltip' => __( 'Enable this feature for loading table asynchronously', 'sheetstowptable' ),
				'is_checked'      => $optionValues['asynchronous_loading'],
				'input_name'      => 'asynchronous_loading',
				'setting_desc'    => __( "Enable this feature to load the table in the frontend after loading all content with a pre-loader.
				This will help your website load fast. If you don't want to enable this feature than the table will load with the reloading of browser every time.", 'sheetstowptable' ),
				'is_pro'          => false

			],
			'custom_css'           => [
				'template_path'   => SWPTLS_BASE_PATH . 'app/templates/parts/general_settings.php',
				'setting_title'   => __( 'Custom CSS', 'sheetstowptable' ),
				'setting_tooltip' => __( 'Write your own custom CSS to design the table.', 'sheetstowptable' ),
				'is_checked'      => $optionValues['custom_css'],
				'input_name'      => 'custom_css',
				'setting_desc'    => __( 'Write your own custom CSS to design the table or the page itself.
				Your custom written CSS will be applied to front-end of the website. Activate the Pro extension to enable custom CSS option', 'sheetstowptable' ),
				'is_pro'          => true
			]
		];

		return apply_filters( 'gswpts_general_settings', $settingsArray );
	}

	/**
	 * Get options values.
	 *
	 * @return array
	 */
	public function getOptionValues() {
		$optionValues = [];

		$generalSettingsOptions = $this->generalSettingsOptions();

		if ( ! $generalSettingsOptions ) {
			return [];
		}

		foreach ( $generalSettingsOptions as $key => $value ) {
			$optionValue = get_option( $value ) ? 'checked' : '';
			$optionValues[ $value ] = $optionValue;
		}

		return $optionValues;
	}

	/**
	 * General settings options.
	 *
	 * @return array
	 */
	public function generalSettingsOptions(): array {
		$generalSettingsOptions = [
			'asynchronous_loading',
			'custom_css',
			'css_code_value'
		];

		return $generalSettingsOptions;
	}

	/**
	 * Table styles array.
	 *
	 * @return mixed
	 */
	public function tableStylesArray(): array {
		$stylesArray = [
			'default-style' => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/default-style.png',
				'inputName' => 'tableStyle',
				'isPro'     => false,
				'isChecked' => swptls()->helpers->isProActive() ? false : true,
				'label'     => 'Default Style'
			],
			'style-1'       => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/style-2.png',
				'inputName' => 'tableStyle',
				'isPro'     => true,
				'isChecked' => false,
				'label'     => 'Style 1'
			],
			'style-2'       => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/style-3.png',
				'inputName' => 'tableStyle',
				'isPro'     => true,
				'isChecked' => false,
				'label'     => 'Style 2'
			],
			'style-3'       => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/style-4.png',
				'inputName' => 'tableStyle',
				'isPro'     => true,
				'isChecked' => false,
				'label'     => 'Style 3'
			],
			'style-4'       => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/style-1.png',
				'inputName' => 'tableStyle',
				'isPro'     => true,
				'isChecked' => false,
				'label'     => 'Style 4'
			],
			'style-5'       => [
				'imgUrl'    => SWPTLS_BASE_URL . 'assets/public/images/TableStyle/style-5.png',
				'inputName' => 'tableStyle',
				'isPro'     => true,
				'isChecked' => false,
				'label'     => 'Style 5'
			]
		];

		return apply_filters( 'gswpts_table_styles', $stylesArray );
	}

	/**
	 * Load the html markup for backend admin panel.
	 *
	 * @return void
	 */
	public function tableStylesHtml() {
		$stylesArray = $this->tableStylesArray();

		foreach ( $stylesArray as $key => $style ) {
			load_template(SWPTLS_BASE_PATH . 'app/templates/parts/table_style_template.php', false, [
				'isPro' => $style['isPro'],
				'style' => $style,
				'key'   => $key
			]);
		}
	}
}