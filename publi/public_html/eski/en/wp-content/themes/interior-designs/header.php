<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content-ma">
 *
 * @package Interior Designs
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
	
	<?php if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}?>
	<?php if(get_theme_mod('interior_designs_preloader_hide',true)){ ?>
	    <?php if(get_theme_mod( 'interior_designs_preloader_type','center-square') == 'center-square'){ ?>
		    <div class='preloader'>
			    <div class='preloader-squares'>
					<div class='square'></div>
					<div class='square'></div>
					<div class='square'></div>
					<div class='square'></div>
			    </div>
			</div>
	    <?php }else if(get_theme_mod( 'interior_designs_preloader_type') == 'chasing-square') {?>    
	        <div class='preloader'>
				<div class='preloader-chasing-squares'>
					<div class='square'></div>
					<div class='square'></div>
					<div class='square'></div>
					<div class='square'></div>
				</div>
			</div>
	    <?php }?>
	<?php }?>
	<header role="banner" class="full-header">
		<a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'interior-designs' ); ?></a>
		<?php if( get_theme_mod('interior_designs_topbar_hide',false) != '' || get_theme_mod('interior_designs_responsive_topbar_hide',false) != ''){ ?>
		  	<div class="top-header">
			  	<div class="container">
			    	<div class="row">
			      		<div class="col-lg-7 col-md-7">
			        		<div class="site-text">
			          			<?php if( get_theme_mod( 'interior_designs_text','' ) != '') { ?>
			            			<span class="phone"><?php echo esc_html( get_theme_mod('interior_designs_text','' )); ?></span>
			           			<?php } ?>
			        		</div>
			      		</div>
			      		<div class="col-lg-5 col-md-5">
			        		<div class="social-media">
			          			<?php if( get_theme_mod( 'interior_designs_facebook_url' ) != '' && get_theme_mod('interior_designs_facebook_icon') != 'None') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'interior_designs_facebook_url','' ) ); ?>"><i class="<?php echo esc_html(get_theme_mod('interior_designs_facebook_icon','fab fa-facebook-f')); ?> py-1 ps-1 pe-3"></i>
										<span class="screen-reader-text"><?php esc_html_e( 'Facebook','interior-designs' );?></span>
									</a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'interior_designs_twitter_url') != '' && get_theme_mod('interior_designs_twitter_icon') != 'None') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'interior_designs_twitter_url','' ) ); ?>"><i class="<?php echo esc_html(get_theme_mod('interior_designs_twitter_icon','fab fa-twitter')); ?> py-1 ps-1 pe-3"></i>
										<span class="screen-reader-text"><?php esc_html_e( 'Twitter','interior-designs' );?></span>
									</a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'interior_designs_insta_url' ) != '' && get_theme_mod('interior_designs_instagram_icon') != 'None') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'interior_designs_insta_url','' ) ); ?>"><i class="<?php echo esc_html(get_theme_mod('interior_designs_instagram_icon','fab fa-instagram')); ?> py-1 ps-1 pe-3"></i>
										<span class="screen-reader-text"><?php esc_html_e( 'Instagram','interior-designs' );?></span>
									</a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'interior_designs_linkdin_url') != '' && get_theme_mod('interior_designs_linkedin_icon') != 'None') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'interior_designs_linkdin_url','' ) ); ?>"><i class="<?php echo esc_html(get_theme_mod('interior_designs_linkedin_icon','fab fa-linkedin-in')); ?> py-1 ps-1 pe-3"></i>
										<span class="screen-reader-text"><?php esc_html_e( 'Linkedin','interior-designs' );?></span>
									</a>
			          			<?php } ?>
			          			<?php if( get_theme_mod( 'interior_designs_youtube_url' ) != '' && get_theme_mod('interior_designs_youtube_icon') != 'None') { ?>
			            			<a href="<?php echo esc_url( get_theme_mod( 'interior_designs_youtube_url','' ) ); ?>"><i class="<?php echo esc_html(get_theme_mod('interior_designs_youtube_icon','fab fa-youtube')); ?> py-1 ps-1 pe-3"></i>
										<span class="screen-reader-text"><?php esc_html_e( 'Youtube','interior-designs' );?></span>
									</a>
			          			<?php } ?>
			        		</div>
			      		</div>
			      		<div class="clearfix"></div>
			    	</div>
			  	</div>
			</div>
		<?php }?>
	  	<div class="site_header py-2">
		  	<div class="container">
		  		<div class="row">
				    <div class="col-lg-4 col-md-3 align-self-center">
				    	<div class="logo align-self-center">
							<?php if ( has_custom_logo() ) : ?>
				     	    	<div class="site-logo"><?php the_custom_logo(); ?></div>
				            <?php endif; ?>
				            <?php if( get_theme_mod( 'interior_designs_site_title',true) != '') { ?>
					            <?php $blog_info = get_bloginfo( 'name' ); ?>
					            <?php if ( ! empty( $blog_info ) ) : ?>
						            <?php if ( is_front_page() && is_home() ) : ?>
						              	<h1 class="site-title p-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						            <?php else : ?>
						              	<p class="site-title m-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						            <?php endif; ?>
					            <?php endif; ?>
					        <?php }?>
					        <?php if( get_theme_mod( 'interior_designs_site_tagline',true) != '') { ?>
					            <?php
					            $description = get_bloginfo( 'description', 'display' );
					            if ( $description || is_customize_preview() ) :
					            ?>
						            <p class="site-description mb-0">
						              	<?php echo esc_html($description); ?>
						            </p>
					            <?php endif; ?>
					        <?php }?>
					    </div>
				    </div>
				    <div class="col-lg-8 col-md-9 row align-self-center">
				        <div class="call col-lg-4 col-md-4 my-lg-0 my-2">
				          	<?php if( get_theme_mod( 'interior_designs_call','' ) != '') { ?>
				          		<div class="row">
				          			<?php if(get_theme_mod('interior_designs_phone_icon') != 'None'){?>
					            		<div class="col-lg-2 col-md-2 col-4 ps-0"><i class="<?php echo esc_attr(get_theme_mod('interior_designs_phone_icon','fas fa-phone')); ?>"></i></div>
					            	<?php }?>
				            		<div class="<?php if(get_theme_mod('interior_designs_phone_icon') != 'None'){?>col-lg-10 col-md-10 col-8<?php } else {?> col-lg-12 col-md-12 col-12 <?php }?> ">
					             		<p class="infotext mb-1"><?php echo esc_html( get_theme_mod('interior_designs_call_text','') ); ?></p>
					              		<p class="mb-1"><a href="tel:<?php echo esc_attr( get_theme_mod('interior_designs_call','')); ?>"><?php echo esc_html( get_theme_mod('interior_designs_call','') ); ?><span class="screen-reader-text"><?php esc_html_e( 'Phone Number','interior-designs' );?></span></a></p>
					            	</div>
					            </div>
				          	<?php } ?>
				        </div>
				        <div class="location col-lg-4 col-md-4 my-lg-0 my-2 align-self-center">
				         	<?php if( get_theme_mod( 'interior_designs_location','' ) != '') { ?>
				         		<div class="row">
				         			<?php if(get_theme_mod('interior_designs_location_icon') != 'None'){?>
						            	<div class="col-lg-2 col-md-2 col-4 ps-0"><i class="<?php echo esc_attr(get_theme_mod('interior_designs_location_icon','fas fa-location-arrow')); ?>"></i></div>
						            <?php }?>
						            <div class="<?php if(get_theme_mod('interior_designs_location_icon') != 'None'){?>col-lg-10 col-md-10 col-8<?php } else {?> col-lg-12 col-md-12 col-12 <?php }?> ">
						              	<p class="infotext mb-1"><?php echo esc_html( get_theme_mod('interior_designs_location_text','') ); ?></p>
						              	<p class="mb-1"><?php echo esc_html( get_theme_mod('interior_designs_location','') ); ?></p>
						            </div>
						        </div>
				          	<?php } ?>
				        </div>
				        <div class="time col-lg-4 col-md-4 my-lg-0 my-2 align-self-center">
				         	<?php if( get_theme_mod( 'interior_designs_day','' ) != '') { ?>
				         		<div class="row">
				         			<?php if(get_theme_mod('interior_designs_time_icon') != 'None'){?>
						            	<div class="col-lg-2 col-md-2 col-4 ps-0"><i class="<?php echo esc_attr(get_theme_mod('interior_designs_time_icon','far fa-clock')); ?>"></i></div>
						            <?php }?>
						            <div class="<?php if(get_theme_mod('interior_designs_time_icon') != 'None'){?>col-lg-10 col-md-10 col-8<?php } else {?> col-lg-12 col-md-12 col-12 <?php }?>">
						              	<p class="infotext mb-1"><?php echo esc_html( get_theme_mod('interior_designs_time','') ); ?></p>
						              	<p class="mb-1"><?php echo esc_html( get_theme_mod('interior_designs_day','') ); ?></p>
						            </div>
						        </div>
				          	<?php } ?>
				        </div>
			      	</div>
				</div>
		    </div>		
		</div>	
		<div class="<?php if( get_theme_mod( 'interior_designs_sticky_header', false) != '' || get_theme_mod('interior_designs_responsive_sticky_header',false) != '') { ?> sticky-header<?php } else { ?>close-sticky <?php } ?>">
			<div class="container">
				<div id="header" class="row">
					<div class="menubox nav p-lg-0 p-2 col-lg-11 col-md-11 col-10">
						<?php if(has_nav_menu('primary')){ ?>
						    <div class="toggle-menu responsive-menu py-1 px-2">
				              <button role="tab" onclick="interior_designs_menu_open()"><i class="<?php echo esc_html(get_theme_mod('interior_designs_responsive_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','interior-designs'); ?></span></button>
				            </div>
				        <?php }?>
			            <div id="menu-sidebar" class="nav side-menu pt-lg-0 pt-5">
				            <nav id="primary-site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'interior-designs' ); ?>">
				                <?php if(has_nav_menu('primary')){
				                  wp_nav_menu( array( 
				                    'theme_location' => 'primary',
				                    'container_class' => 'main-menu-navigation clearfix' ,
				                    'menu_class' => 'clearfix',
				                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0">%3$s</ul>',
				                    'fallback_cb' => 'wp_page_menu',
				                  ) ); 
				                } ?>
				                <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="interior_designs_menu_close()"><i class="<?php echo esc_html(get_theme_mod('interior_designs_responsive_close_menu_icon','fas fa-times'));?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','interior-designs'); ?></span></a>
				            </nav>
			            </div>
						<div class="clear"></div>
					</div>
					<div class="search-box col-lg-1 col-md-1 col-2 align-self-center">
						<?php if(get_theme_mod('interior_designs_search_icon') != 'None') {?>
		       		<span class="search-icon"><button type="button" onclick="interior_designs_search_show()"><i class="<?php echo esc_html(get_theme_mod('interior_designs_search_icon','fas fa-search')); ?>"></i></button></span>
		       	<?php }?>
			    </div>
					<div class="search-outer">
            <div class="serach_inner">
            	<?php get_search_form(); ?>
            </div>
          	<button type="button" class="closepop" onclick="interior_designs_search_hide()">X</span></button>
	        </div>
				</div>
			</div>
		</div>
	</header>