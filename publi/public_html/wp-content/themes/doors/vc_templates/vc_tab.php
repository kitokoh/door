<?php
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $tab_id
 * @var $title
 * @var $content - shortcode content
 * Shortcode class
 * @var WPBakeryShortCode_Vc_Tab $this
 */
$tab_id = $title = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'jquery_ui_tabs_rotate' );
$img_size  = "";
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_tab ui-tabs-panel wpb_ui-tabs-hide vc_clearfix', $this->settings['base'], $atts );

$output = '<div id="tab-' . ( empty( $tab_id ) ? sanitize_title( $title ) : esc_attr( $tab_id ) ) . '" class="' . esc_attr( $css_class ) . '"> ';
if ( isset( $doors_bg_image ) ) {
	if ( $doors_bg_image != "" ) {
		$img_id                   = preg_replace( '/[^\d]/', '', $doors_bg_image );
		$img                      = wpb_getImageBySize( array(
			'attach_id'  => $img_id,
			'full_size'  => $img_size,
			'thumb_size' => 'thumbnail'
		) );
		$img_path                 = $img['p_img_large'][0];
		$doors_bg_position_string = "";
		$doors_bg_repeat_string   = "";
		if ( $doors_bg_position_h != "" && $doors_bg_position_v != "" ) {
			$doors_bg_position_string = "background-position : " . $doors_bg_position_h . " " . $doors_bg_position_v . ";";
		}
		if ( $doors_bg_repeat != "" ) {
			$doors_bg_repeat_string = "background-repeat : " . $doors_bg_repeat . ";";
		}
		$output .= ' style="background-image: url(' . $img_path . ');' . $doors_bg_position_string . ";" . $doors_bg_repeat_string . ";" . '
			"';
	}
}
$output .= ( ( '' === trim( $content ) ) ? esc_html__( 'Empty tab. Edit page to add content here.', 'doors' ) : wpb_js_remove_wpautop( $content ) ) ;
$output .=	'</div>';

return $output;
