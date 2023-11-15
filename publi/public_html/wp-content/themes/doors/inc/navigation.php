<?php

// This theme uses wp_nav_menu() in two locations.
//____________navigation____________

register_nav_menus( array(
	'primary' => esc_html__( 'Primary Navigation', 'doors' ),
) );

/**
 * Desktop navigation - right top bar
 *
 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
if ( ! function_exists( 'doors_top_bar_primary' ) ) {
	function doors_top_bar_primary() {
		$primarymenu = "primary";
		wp_nav_menu(
			array(
				'container'      => false,
				'menu_class'     => 'desktop-menu menu',
				'theme_location' => $primarymenu,
				'depth'          => 4,
				'fallback_cb'    => 'doors_main_menu_fallback',
				'walker'         => new doors_top_bar_walker(),
			)
		);
	}
}

/**
 * Mobile navigation - topbar (default) or offcanvas
 */


if (!class_exists('doors_mobile_walker')) :
	class doors_mobile_walker extends Walker_Nav_Menu
	{
		function start_lvl(&$output, $depth = 0, $args = array())
		{
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<ul class=\"sub-menu dropdown \">\n";
		}
	}
endif;

if ( ! function_exists( 'doors_mobile_nav' ) ) {
	function doors_mobile_nav() {
		wp_nav_menu(
			array(
				'container'      => false,                         // Remove nav container
				'menu'           => esc_html__( 'mobile-nav', 'doors' ),
				'menu_class'     => 'vertical menu',
				'theme_location' => 'primary',
				'items_wrap'     => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
				'fallback_cb'    => false,
				'walker'         => new doors_mobile_walker(),
			)
		);
	}
}


/**
 * Get title bar responsive toggle attribute
 */

if ( ! function_exists( 'doors_title_bar_responsive_toggle' ) ) {
	function doors_title_bar_responsive_toggle() {

		echo 'data-responsive-toggle="mobile-menu"';

	}
}
