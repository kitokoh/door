<?php

function doors_style_customizer() {

	$doors_thePageID = get_the_ID();


	$doors_style       = get_post_meta( $doors_thePageID, 'doors_page_title_area_style', true );
	$doors_page_bg_img = get_post_meta( $doors_thePageID, 'doors_page_title_area_bg_img', true );


	//********* inline style ***************/
	$doors_custom_css    = "";
	$doors_custom_css    .= "";
	$doors_custom_css    .= ".l-footer-columns { background-color: " . doors_get_option( 'footer_bg_color' ) . "}";
	$doors_custom_css    .= ".l-footer-columns, .l-footer-columns .block-title , .l-footer-columns ul li a { color: " . doors_get_option( 'footer_text_color' ) . "}";
	$doors_custom_css    .= ".l-footer { background-color: " . doors_get_option( 'copyright_bg_color' ) . "; color: " . doors_get_option( 'copyright_text_color' ) . ";}";
	$doors_footer_bg_img = doors_get_option( 'doors_footer_bg_image' );
	$doors_blog_bg_image = doors_get_option( 'doors_blog_bg_image' );
	$doors_row_width = doors_get_option( 'doors_row_width', '1200' );



	$doors_custom_css .= "
    :root {
      --primary-color:            " . esc_html(doors_get_option('primary_color','#265FB4')) . ";
      --secondary-color:          " . esc_html(doors_get_option('secondary_color','#265FB4')) . ";
      /*--accent-color:             " . esc_html(doors_get_option('accent_color', "#ff6a00")) . ";*/

      --headings-color:           " . esc_html(doors_get_option('headings_color', "#0d1d4e")) . ";
      
      --header-color:             " . esc_html(doors_get_option('header_text_color')) . ";
      --body-background-color:    " . esc_html(doors_get_option('body_bg_color')) . ";
      
      --topbar-background:        " . esc_html(doors_get_option('header_bg_color')) . ";
      --topbar-text:              " . esc_html(doors_get_option('navigation_text_color')) . ";
      --topbar-sticky-bg:         " . esc_html(doors_get_option('sticky_nav_bg_color')) . ";
      --topbar-sticky-text:       " . esc_html(doors_get_option('sticky_nav_text_color')) . ";
      --topbar-hover-sticky-text: " . esc_html(doors_get_option('hover_sticky_nav_text_color')) . ";
      --topbar-hover-text:        " . esc_html(doors_get_option('hover_nav_text_color')) . ";
   
      --footer-background:        " . esc_html(doors_get_option('footer_bg_color')) . ";
      --footer-background-image: url(" . esc_html(doors_get_option('footer_bg_img')) . ");
      --footer-text-color:        " . esc_html(doors_get_option('footer_text_color')) . ";
      --copyright-background:     " . esc_html(doors_get_option('copyright_bg_color')) . ";
      --copyright-text:           " . esc_html(doors_get_option('copyright_text_color')) . ";  
	  

	  
    }";





	if ( isset( $doors_row_width ) && $doors_row_width != 'default') {
		$doors_custom_css .= "
            .row { 
              max-width: ".$doors_row_width."px; 
            }";
	}

	if ( isset( $doors_footer_bg_img ) && $doors_footer_bg_img != '' ) {
		$doors_custom_css .= "
            .l-footer-columns {
              background-image: url('$doors_footer_bg_img');
              background-size: cover;

            }";
	}

	if ( isset( $doors_blog_bg_image ) && $doors_blog_bg_image != '' ) {
		$doors_custom_css .= "
            .titlebar {
              background-image: url('$doors_blog_bg_image');
              background-size: cover; 
            }";
	}

	if ( is_page() & ( $doors_style != 'standard' ) ) {
		//-------------title page--------------
		$doors_custom_css .= "
      .titlebar {";
		if ( $doors_page_bg_img != "" ) {
			$doors_custom_css .= "background-image: url($doors_page_bg_img) " . get_post_meta( $doors_thePageID, 'doors_page_title_area_bg_color', true ) . ";";
		}
		$doors_custom_css .= "width:100%;
        text-align:" . get_post_meta( $doors_thePageID, 'doors_page_title_position', true ) . ";
        background-size: cover;
      }
      #page-title,.breadcrumbs a{
        color:" . get_post_meta( $doors_thePageID, 'doors_page_title_color', true ) . ";
      }";
	}

	$doors_custom_css .= "
	  .contain-to-grid .top-bar .text-right  {
			background : " . doors_get_option( 'adress_bar_bgcolor' ) . ";
		}
	 
	  .contain-to-grid .top-bar .text-right .address_bar .bar .address, 
	  .contain-to-grid .top-bar .text-right .address_bar .bar .text_add, 
	  .contain-to-grid .top-bar .text-right .address_bar .address_icon i {
			color : " . doors_get_option( 'adress_bar_color' ) . ";
		}
		";




	if ( ( doors_get_option( 'doors_body_font_familly' ) != 'default' ) && ( doors_get_option( 'doors_body_font_familly' ) != false ) ) {
		$doors_custom_css .= "body, body p {
				font-family :'" . doors_get_option( 'doors_body_font_familly', 'Lato' ) . "';
				font-weight :" . doors_get_option( 'doors_font-weight-style' ) . ";
				font-style:'" . doors_get_option( 'doors_body_font_style' ) . "';
				font-size :'" . doors_get_option( 'doors_body_font_size' ) . "';
			}";
		if ( doors_get_option( 'doors_main_text_lettre_spacing' ) != false && doors_get_option( 'doors_main_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= "body, body p {
					letter-spacing :" . doors_get_option( 'doors_main_text_lettre_spacing' ) . ";
				}";
		}

	} else {
		$doors_custom_css .= "body, body p {
				font-family: 'lato';
				font-weight :" . doors_get_option( 'doors_font-weight-style' ) . ";
			}";
		if ( doors_get_option( 'doors_main_text_lettre_spacing' ) != false && doors_get_option( 'doors_main_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= "body, body p {
					letter-spacing :" . doors_get_option( 'doors_main_text_lettre_spacing' ) . ";
				}";
		}
	}
	if ( ( doors_get_option( 'doors_head_font_familly' ) != 'default' ) && ( doors_get_option( 'doors_head_font_familly' ) != false ) ) {
		$doors_custom_css .= "h1, h2, h3, h4, h5, h6, .menu-list a {
				font-family :'" . doors_get_option( 'doors_head_font_familly', 'Archivo Narrow' ) . "';
				font-weight :" . doors_get_option( 'doors_heading-font-weight-style' ) . ";
				font-style :'" . doors_get_option( 'doors_head_font_style' ) . "';
				font-size :'" . doors_get_option( 'doors_head_font_size' ) . "';
			}";
		if ( doors_get_option( 'doors_heading_text_lettre_spacing' ) != false && doors_get_option( 'doors_heading_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= "h1, h2, h3, h4, h5, h6, .menu-list a {
					letter-spacing :" . doors_get_option( 'doors_heading_text_lettre_spacing' ) . ";
				}";
		}
	} else {
		$doors_custom_css .= "h1, h2, h3, h4, h5, h6, .menu-list a {
				font-family: 'Archivo Narrow';
				font-weight :" . doors_get_option( 'doors_heading-font-weight-style', '700' ) . ";
				font-style :'" . doors_get_option( 'doors_head_font_style', 'normal' ) . "';
				font-size :'" . doors_get_option( 'doors_head_font_size', '12px' ) . "';
			}";
		if ( doors_get_option( 'doors_heading_text_lettre_spacing' ) != false && doors_get_option( 'doors_heading_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= "h1, h2, h3, h4, h5, h6, .menu-list a {
					letter-spacing :" . doors_get_option( 'doors_heading_text_lettre_spacing' ) . ";
				}";
		}
	}

	if ( ( doors_get_option( 'doors_navigation_font_familly' ) != 'default' ) && ( doors_get_option( 'doors_navigation-font-weight-style' ) != false ) ) {
		$doors_custom_css .= ".top-bar-section ul.menu > li > a:not(.button) {
					font-family : '" . doors_get_option( 'doors_navigation_font_familly', 'Archivo Narrow' ) . "';
					font-weight : " . doors_get_option( 'doors_navigation-font-weight-style' ) . ";
		font-style : " . doors_get_option( 'doors_navigation_font_style' ) . ";
				font-size :" . doors_get_option( 'doors_navigation_font_size' ) . ";
				}";
		if ( doors_get_option( 'doors_navigation_text_lettre_spacing' ) != false && doors_get_option( 'doors_navigation_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= ".top-bar-section ul li > a {
						letter-spacing :" . doors_get_option( 'doors_navigation_text_lettre_spacing' ) . ";
					}";
		}
	} else {
		$doors_custom_css .= ".top-bar-section ul li > a {
						font-family: 'Archivo Narrow';
						font-weight : " . doors_get_option( 'doors_navigation-font-weight-style', '400' ) . ";
						font-style : '" . doors_get_option( 'doors_navigation_font_style', 'normal' ) . "';
						font-size :'" . doors_get_option( 'doors_navigation_font_size', '12' ) . "';
					}";
		if ( doors_get_option( 'doors_navigation_text_lettre_spacing' ) != false && doors_get_option( 'doors_navigation_text_lettre_spacing' ) != "" ) {
			$doors_custom_css .= ".top-bar-section ul li > a {
							letter-spacing :" . doors_get_option( 'doors_navigation_text_lettre_spacing' ) . ";
						}";
		}
	}
	
	$doors_custom_css .= "
		.blog-post .sticky .blog-info {
			background: " . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . " repeating-linear-gradient(-55deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0) 10px, rgba(0, 0, 0, 0) 20px) repeat scroll 0 0;
		}

		.sidebar #s:active,
    .sidebar #s:focus, .boxes.layout-3 .box-icon, div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
    div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a {
      border-color :    " . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . ";
    }
    div.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab > a {
      border-bottom-color :    " . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . ";
    }
     .wd-image-text h4:after, .wd-title-element:after {
     background-color :    " . doors_get_option( 'primary_color', '' ) . " !important;
     }
    .blog-info .arrow {
      border-color: transparent " . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . ";
		}

		.primary-color_color, h1, h2, h3, h4, h5, h6, .layout-4 .box-container h3.box-title-4, .wd-title-element, .wd-image-text h4, a, a:focus, a.active, a:active, a:hover,section.corporate .menu-item a i,
		 .box-container:hover .box-title, .blog-posts i, div.boxes.small.layout-3 .box-icon i {
				colorrrr : 	" . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . " ;
		}
		 .boxes.small.layout-3 .box-icon i,
		  div.boxes.small.layout-3:hover .box-icon i {
		   color: rgba(255,255,255,1);
		 }

		.blog-posts h2 a {
			color : " . doors_get_option( 'secondary_color' ) . "
		}
		.corporate-layout .top-bar-section ul li:hover {
			border-color : " . doors_get_option( 'secondary_color' ) . "
		}
		.request-quote.right{
		  color : 	" . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . " ;
		}

		.corporate-layout .top-bar-section ul.menu > li > a,
		.creative-layout .top-bar-section ul li > a {
      color :    " . doors_get_option( 'navigation_text_color', '#000' ) . ";
    }
     .contain-to-grid.sticky-nav.sticky{
			background-color:" . doors_get_option( 'navigation_bg_color_sticky', '#FFF' ) . ";
		}

		.l-footer-columns, .l-footer-columns .block-title , .l-footer-columns ul li a {
			color: " . doors_get_option( 'footer_text_color' ) . "
		}

		.l-footer {
			background-color : " . doors_get_option( 'copyright_bg' ) . "
		}

		.contain-to-grid.sticky.fixed , .top-bar , .corporate-layout .contain-to-grid.sticky, header.l-header,.corporate-layout .contain-to-grid {
			background-color : " . doors_get_option( 'header_bg' ) . "
		}

		#spaces-main {
			background-color : " . doors_get_option( 'container_bg' ) . "
		}";


	$doors_custom_css .= html_entity_decode( doors_get_option( 'doors_theme_custom_css' ) );
	$doors_custom_css .= "
											.blog-info .arrow {
    									border-left-color:" . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . " ;
												}
												.ui-accordion-header-active, .ui-tabs-active, .box-icon {
													border-top-color:" . doors_get_option( 'primary_color', 'rgba(38,95,180,1)' ) . "
												}

												";

	wp_enqueue_style( 'doors_custom_styler', get_template_directory_uri() . "/css/custom_styler.css" );
	wp_add_inline_style( 'doors_custom_styler', $doors_custom_css );
}

add_action( 'wp_enqueue_scripts', 'doors_style_customizer' );