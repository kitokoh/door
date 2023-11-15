<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Interior Designs
 */
get_header(); ?>

<main id="main" role="main" class="content-aa">
	<div class="container space-top">
        <div class="page-content text-center py-5">		
			<?php if(get_theme_mod('interior_designs_404_title','404 Not Found')){ ?>	
				<h1><?php echo esc_html( get_theme_mod('interior_designs_404_title',__('404 Not Found', 'interior-designs' )) ); ?></h1>
			<?php }?>
			<?php if(get_theme_mod('interior_designs_404_text','Looks like you have taken a wrong turn. Dont worry it happens to the best of us.')){ ?>
				<p class="text-404"><?php echo esc_html( get_theme_mod('interior_designs_404_text',__('Looks like you have taken a wrong turn. Dont worry it happens to the best of us.', 'interior-designs' )) ); ?></p>
			<?php }?>
			<?php if(get_theme_mod('interior_designs_404_button_text','Return to Home Page')){ ?>
				<div class="read-moresec my-3">
	           		<a href="<?php echo esc_url( home_url() ); ?>" class="button hvr-sweep-to-right py-2 px-4"><?php echo esc_html( get_theme_mod('interior_designs_404_button_text',__('Return to Home Page', 'interior-designs' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('interior_designs_404_button_text',__('Return to Home Page', 'interior-designs' )) ); ?></span></a>
				</div>
				<div class="clearfix"></div>
			<?php }?>
        </div>
	</div>
</main>

<?php get_footer(); ?>