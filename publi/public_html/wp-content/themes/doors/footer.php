<?php if ( doors_get_option( 'doors_footer_columns','three_columns' ) == 'tow_a_columns' or doors_get_option( 'doors_footer_columns' ,'three_columns' ) == 'four_columns' or doors_get_option( 'doors_footer_columns','three_columns' ) == 'three_columns' or doors_get_option( 'doors_footer_columns','three_columns' ) == 'tow_b_columns' or doors_get_option( 'doors_footer_columns','three_columns' ) == 'tow_c_columns' ) { ?>
  <section class="l-footer-columns">
    <div class="row">
      <section class="block">
				<?php
				if ( doors_get_option( 'doors_footer_columns' ) == 'one_columns' ) {
					$column_one   = 12;
					$column_tow   = '';
					$column_three = '';
					$column_four  = '';

				} elseif ( doors_get_option( 'doors_footer_columns' ) == 'tow_a_columns' ) {
					$column_one   = 4;
					$column_tow   = 8;
					$column_three = '';
					$column_four  = '';
				} elseif ( doors_get_option( 'doors_footer_columns' ) == 'tow_b_columns' ) {
					$column_one   = 8;
					$column_tow   = 4;
					$column_three = '';
					$column_four  = '';
				} elseif ( doors_get_option( 'doors_footer_columns' ) == 'tow_c_columns' ) {
					$column_one   = 6;
					$column_tow   = 6;
					$column_three = '';
					$column_four  = '';

				} elseif ( doors_get_option( 'doors_footer_columns' ) == 'three_columns' ) {
					$column_one   = 4;
					$column_tow   = 4;
					$column_three = 4;
					$column_four  = '';
				} else {
					$column_one   = 3;
					$column_tow   = 3;
					$column_three = 3;
					$column_four  = 3;
				}
				?>
        <div class="large-<?php echo esc_attr( $column_one ) ?> columns">
					<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer' ) ) : ?><?php endif; ?>
        </div>
				<?php if ( doors_get_option( 'doors_footer_columns' ) == 'tow_a_columns' or doors_get_option( 'doors_footer_columns' ) == 'four_columns' or doors_get_option( 'doors_footer_columns' ) == 'three_columns' or doors_get_option( 'doors_footer_columns' ) == 'tow_b_columns' or doors_get_option( 'doors_footer_columns' ) == 'tow_c_columns' ) { ?>
          <div class="large-<?php echo esc_attr( $column_tow ) ?> columns">
						<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer_columns_tow' ) ) : ?><?php endif; ?>
          </div>
				<?php }
				?>

				<?php if ( doors_get_option( 'doors_footer_columns' ) == 'three_columns' or doors_get_option( 'doors_footer_columns' ) == 'four_columns' ) { ?>

          <div class="large-<?php echo esc_attr( $column_three ) ?> columns">

						<?php

						if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer_columns_three' ) ) : ?><?php endif;

						?>
          </div>
				<?php } ?>

				<?php if ( doors_get_option( 'doors_footer_columns' ) == 'four_columns' ) { ?>

          <div class="large-<?php echo esc_attr( $column_four ) ?> columns">

						<?php

						if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar( 'footer_columns_four' ) ) : ?><?php endif;

						?>
          </div>
				<?php } ?>
      </section>
    </div>
 </section>
<?php } ?>
<footer class="l-footer">
  <div class="row">
    <div class="footer large-4 small-12 columns">
      <section class="block">
        <?php if(doors_get_option( 'doors_poweredby' ) != '')  { ?>
        <span><?php echo esc_html__('Powered by','doors') ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html(doors_get_option( 'doors_poweredby', 'doors' )) ?></a></span>
        <?php } ?>
      </section>
    </div>

    <div class="copyright large-4 small-12 columns text-center ">
      <p>
				<?php echo esc_html(doors_get_option( 'doors_copyright', '&copy; 2020 Windows & Doors All rights reserved. ' )); ?>
      </p>
    </div>
    <div class="large-4 small-12 columns"></div>
  </div>
</footer>

<!-- end offcanvas -->
<?php

wp_footer(); ?>


</section>
</div>

</body>
</html>