<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see      https://docs.woocommerce.com/document/template-structure/
 * @author    WooThemes
 * @package  WooCommerce/Templates
 * @version     3.9.0
 */
if (!defined('ABSPATH')) {
    exit;
}
get_header('shop');
?>
    <section class="titlebar">
        <div class="row">
            <div class="large-8 columns">
                <h1 id="page-title" class="title"><?php echo woocommerce_page_title(); ?></h1>
            </div>
        </div>
    </section>
    <div class="row content-wrapper">

        <?php if (is_active_sidebar('shop-widgets')) { ?>
            <div class="sidebar shop-sidebar large-3 columns">
                <?php get_sidebar('shop'); ?>
            </div>
        <?php } ?>

        <div class="main-content large-<?php if ( is_active_sidebar( 'shop-widgets' ) ) { echo "9";}else{ echo "12";} ?> columns">
            <?php
            if (have_posts()) {
                /**
                 * Hook: woocommerce_before_shop_loop.
                 *
                 * @hooked wc_print_notices - 10
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                ?>
                <div class='clearfix filter-options'>
                    <div class="filter-flex">
                        <?php do_action('woocommerce_before_shop_loop'); ?>
                    </div>
                </div>
                <?php
                woocommerce_product_loop_start();
                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
                        the_post();
                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
                    }
                }
                woocommerce_product_loop_end();
                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action('woocommerce_after_shop_loop');
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action('woocommerce_no_products_found');
            }
            /**
             * Hook: woocommerce_after_main_content.
             *
             * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)

            //do_action('woocommerce_after_main_content');
             */
            /**
             * Hook: woocommerce_sidebar.
             *
             * @hooked woocommerce_get_sidebar - 10
             */
            do_action('woocommerce_sidebar');
            ?>

        </div>
    </div>
<?php
get_footer('shop');
