<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Interior Designs
 */
?>

<header>
	<h2 class="entry-title"><?php echo esc_html( get_theme_mod('interior_designs_no_result_title',__('Nothing Found', 'interior-designs' )) ); ?></h2>
</header>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( esc_html__( 'Ready to publish your first post? Get started here.', 'interior-designs' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
	<?php elseif ( is_search() ) : ?>
		<p><?php echo esc_html( get_theme_mod('interior_designs_no_result_text',__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'interior-designs' )) ); ?></p><br />
		<?php if (get_theme_mod('interior_designs_show_search_form',true) != '') {
			get_search_form();
		}?>
	<?php else : ?>
		<p><?php esc_html_e( 'Dont worry&hellip it happens to the best of us.', 'interior-designs' ); ?></p><br />
		<div class="read-moresec my-3">
			<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right py-2 px-4"><?php esc_html_e( 'Back to Home Page', 'interior-designs' ); ?><span class="screen-reader-text"><?php esc_html_e( 'Back to Home Page','interior-designs' );?></span></a>
		</div>
<?php endif; ?>