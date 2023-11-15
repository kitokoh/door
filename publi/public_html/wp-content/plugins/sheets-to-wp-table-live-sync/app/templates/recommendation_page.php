<?php
/**
 * Displays recommendation page template.
 *
 * @package SWPTLS
 */

// If direct access than exit the file.
defined( 'ABSPATH' ) || exit;

?>
<div
	class="gswpts_dashboard_container"
	id="toplevel_page_gswpts-dashboard"
	data-nonce="<?php echo esc_attr( wp_create_nonce( 'swptls_fetch_products_nonce_action' ) ); ?>"
>
	<div class="ui segment gswpts_loader">
		<div class="ui active inverted dimmer">
			<div class="ui massive text loader"></div>
		</div>
		<p></p>
		<p></p>
		<p></p>
	</div>

	<div class="child_container mt-4 dashboard_content transition hidden">
		<div class="row mt-3 dash_boxes pb-3 pt-3" style="background: transparent;">
			<div class="col-sm-12 p-0 m-0">
				<h2 class="text-center text-capitalize">
					<?php esc_html_e( 'Our Other Products', 'sheetstowptable' ); ?>
				</h2>
				<p class="text-center">
					<?php
						esc_html_e( 'Experience remarkable WordPress products with a new level of power, beauty, and human-centered designs.
							Think you know WordPress products? Think Deeper!', 'sheetstowptable' );
						?>
				</p>
			</div>
		</div>

		<!-- Our other product section -->
		<div class="row mt-3 other_products_section"></div>
		<!-- End of our other product section -->
	</div>
</div>