<?php 
	$interior_designs_custom_css ='';

	/*---------------------------Width Layout -------------------*/
	$interior_designs_theme_lay = get_theme_mod( 'interior_designs_width_options','Full Layout');
    if($interior_designs_theme_lay == 'Full Layout'){
		$interior_designs_custom_css .='body{';
			$interior_designs_custom_css .='max-width: 100%;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_theme_lay == 'Contained Layout'){
		$interior_designs_custom_css .='body{';
			$interior_designs_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_theme_lay == 'Boxed Layout'){
		$interior_designs_custom_css .='body{';
			$interior_designs_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$interior_designs_custom_css .='}';
	}

	/*------ Button Style -------*/
	$interior_designs_top_buttom_padding = get_theme_mod('interior_designs_top_button_padding');
	$interior_designs_left_right_padding = get_theme_mod('interior_designs_left_button_padding');
	if($interior_designs_top_buttom_padding != false || $interior_designs_left_right_padding != false ){
		$interior_designs_custom_css .='.service-btn a, #comments input[type="submit"].submit{';
			$interior_designs_custom_css .='padding-top: '.esc_attr($interior_designs_top_buttom_padding).'px; padding-bottom: '.esc_attr($interior_designs_top_buttom_padding).'px; padding-left: '.esc_attr($interior_designs_left_right_padding).'px; padding-right: '.esc_attr($interior_designs_left_right_padding).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_button_border_radius = get_theme_mod('interior_designs_button_border_radius');
	$interior_designs_custom_css .='.service-btn a, #comments input[type="submit"].submit{';
		$interior_designs_custom_css .='border-radius: '.esc_attr($interior_designs_button_border_radius).'px;';
	$interior_designs_custom_css .='}';

	/*-------------- Woocommerce Button  -------------------*/

	$interior_designs_woocommerce_button_padding_top = get_theme_mod('interior_designs_woocommerce_button_padding_top');
	if($interior_designs_woocommerce_button_padding_top != false){
		$interior_designs_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button{';
			$interior_designs_custom_css .='padding-top: '.esc_attr($interior_designs_woocommerce_button_padding_top).'px; padding-bottom: '.esc_attr($interior_designs_woocommerce_button_padding_top).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_button_padding_right = get_theme_mod('interior_designs_woocommerce_button_padding_right');
	if($interior_designs_woocommerce_button_padding_right != false){
		$interior_designs_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button{';
			$interior_designs_custom_css .='padding-left: '.esc_attr($interior_designs_woocommerce_button_padding_right).'px; padding-right: '.esc_attr($interior_designs_woocommerce_button_padding_right).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_button_border_radius = get_theme_mod('interior_designs_woocommerce_button_border_radius');
	if($interior_designs_woocommerce_button_border_radius != false){
		$interior_designs_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button{';
			$interior_designs_custom_css .='border-radius: '.esc_attr($interior_designs_woocommerce_button_border_radius).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_related_product = get_theme_mod('interior_designs_related_product',true);

	if($interior_designs_related_product == false){
		$interior_designs_custom_css .='.related.products{';
			$interior_designs_custom_css .='display: none;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_product_border = get_theme_mod('interior_designs_woocommerce_product_border',true);

	if($interior_designs_woocommerce_product_border == false){
		$interior_designs_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$interior_designs_custom_css .='border: none;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_product_padding_top = get_theme_mod('interior_designs_woocommerce_product_padding_top',10);
	{
		$interior_designs_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$interior_designs_custom_css .='padding-top: '.esc_attr($interior_designs_woocommerce_product_padding_top).'px; padding-bottom: '.esc_attr($interior_designs_woocommerce_product_padding_top).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_product_padding_right = get_theme_mod('interior_designs_woocommerce_product_padding_right',10);
	{
		$interior_designs_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$interior_designs_custom_css .='padding-left: '.esc_attr($interior_designs_woocommerce_product_padding_right).'px; padding-right: '.esc_attr($interior_designs_woocommerce_product_padding_right).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_product_border_radius = get_theme_mod('interior_designs_woocommerce_product_border_radius');
	if($interior_designs_woocommerce_product_border_radius != false){
		$interior_designs_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$interior_designs_custom_css .='border-radius: '.esc_attr($interior_designs_woocommerce_product_border_radius).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_woocommerce_product_box_shadow = get_theme_mod('interior_designs_woocommerce_product_box_shadow');
	if($interior_designs_woocommerce_product_box_shadow != false){
		$interior_designs_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$interior_designs_custom_css .='box-shadow: '.esc_attr($interior_designs_woocommerce_product_box_shadow).'px '.esc_attr($interior_designs_woocommerce_product_box_shadow).'px '.esc_attr($interior_designs_woocommerce_product_box_shadow).'px #aaa;';
		$interior_designs_custom_css .='}';
	}

	/*------ Slider show/hide -------*/
    $interior_designs_theme_color_first = get_theme_mod('interior_designs_theme_color_first');
	if(get_theme_mod('interior_designs_slider_arrows') == false){
		$interior_designs_custom_css .=' .page-template-custom-frontpage #header{';
			$interior_designs_custom_css .='position: static; margin: 0;';
		$interior_designs_custom_css .='}';
		$interior_designs_custom_css .=' .page-template-custom-frontpage header{';
			$interior_designs_custom_css .='border-bottom: 5px solid '.esc_attr($interior_designs_theme_color_first).';';
		$interior_designs_custom_css .='}';
	}

	/*------Slider height ---------*/
	$interior_designs_slider_height = get_theme_mod('interior_designs_slider_height');
	if($interior_designs_slider_height != false){
		$interior_designs_custom_css .='#slider img  {';
			$interior_designs_custom_css .='height: '.esc_attr($interior_designs_slider_height).'px;';
		$interior_designs_custom_css .='}';
		$interior_designs_custom_css .='@media screen and (max-width: 575px){		
			#slider img  {';
			$interior_designs_custom_css .='height: auto;';
		$interior_designs_custom_css .='} }';
	}

	/*------Shop page pagination ---------*/
	$interior_designs_shop_page_pagination = get_theme_mod('interior_designs_shop_page_pagination', true);
	if($interior_designs_shop_page_pagination == false){
		$interior_designs_custom_css .= '.woocommerce nav.woocommerce-pagination {';
			$interior_designs_custom_css .='display: none;';
		$interior_designs_custom_css .='}';
	}

	/*------------- Slider Opacity -------------------*/
	$interior_designs_slider_layout = get_theme_mod( 'interior_designs_slider_opacity','0.9');
	if($interior_designs_slider_layout == '0'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.1'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.1';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.2'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.2';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.3'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.3';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.4'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.4';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.5'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.5';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.6'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.6';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.7'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.7';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.8'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.8';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_slider_layout == '0.9'){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:0.9';
		$interior_designs_custom_css .='}';
	}

	/*------- Post into blocks ------*/
	$interior_designs_post_blocks = get_theme_mod('interior_designs_post_blocks', 'Within box');
	if($interior_designs_post_blocks == 'Without box' ){
		$interior_designs_custom_css .='.services-box{';
			$interior_designs_custom_css .=' border: none !important;';
		$interior_designs_custom_css .='}';
	}

	/*---- Preloader Color ----*/
	$interior_designs_preloader_color = get_theme_mod('interior_designs_preloader_color');
	$interior_designs_preloader_bg_color = get_theme_mod('interior_designs_preloader_bg_color');

	if($interior_designs_preloader_color != false){
		$interior_designs_custom_css .='.preloader-squares .square, .preloader-chasing-squares .square{';
			$interior_designs_custom_css .='background-color: '.esc_attr($interior_designs_preloader_color).';';
		$interior_designs_custom_css .='}';
	}
	if($interior_designs_preloader_bg_color != false){
		$interior_designs_custom_css .='.preloader{';
			$interior_designs_custom_css .='background-color: '.esc_attr($interior_designs_preloader_bg_color).';';
		$interior_designs_custom_css .='}';
	}

	/*---- Copyright css ----*/
	$interior_designs_copyright_fontsize = get_theme_mod('interior_designs_copyright_fontsize',16);
	if($interior_designs_copyright_fontsize != false){
		$interior_designs_custom_css .='#footer p{';
			$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_copyright_fontsize).'px; ';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_copyright_top_bottom_padding = get_theme_mod('interior_designs_copyright_top_bottom_padding',15);
	if($interior_designs_copyright_top_bottom_padding != false){
		$interior_designs_custom_css .='#footer {';
			$interior_designs_custom_css .='padding-top:'.esc_attr($interior_designs_copyright_top_bottom_padding).'px; padding-bottom: '.esc_attr($interior_designs_copyright_top_bottom_padding).'px; ';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_copyright_alignment = get_theme_mod( 'interior_designs_copyright_alignment','Center');
    if($interior_designs_copyright_alignment == 'Left'){
		$interior_designs_custom_css .='#footer p{';
			$interior_designs_custom_css .='text-align:start;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_copyright_alignment == 'Center'){
		$interior_designs_custom_css .='#footer p{';
			$interior_designs_custom_css .='text-align:center;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_copyright_alignment == 'Right'){
		$interior_designs_custom_css .='#footer p{';
			$interior_designs_custom_css .='text-align:end;';
		$interior_designs_custom_css .='}';
	}

	/*------- Wocommerce sale css -----*/
	$interior_designs_woocommerce_sale_top_padding = get_theme_mod('interior_designs_woocommerce_sale_top_padding');
	$interior_designs_woocommerce_sale_left_padding = get_theme_mod('interior_designs_woocommerce_sale_left_padding');
	$interior_designs_custom_css .=' .woocommerce span.onsale{';
		$interior_designs_custom_css .='padding-top: '.esc_attr($interior_designs_woocommerce_sale_top_padding).'px; padding-bottom: '.esc_attr($interior_designs_woocommerce_sale_top_padding).'px; padding-left: '.esc_attr($interior_designs_woocommerce_sale_left_padding).'px; padding-right: '.esc_attr($interior_designs_woocommerce_sale_left_padding).'px;';
	$interior_designs_custom_css .='}';

	$interior_designs_woocommerce_sale_border_radius = get_theme_mod('interior_designs_woocommerce_sale_border_radius', 50);
	$interior_designs_custom_css .='.woocommerce span.onsale{';
		$interior_designs_custom_css .='border-radius: '.esc_attr($interior_designs_woocommerce_sale_border_radius).'px;';
	$interior_designs_custom_css .='}';

	$interior_designs_sale_position = get_theme_mod( 'interior_designs_sale_position','right');
    if($interior_designs_sale_position == 'left'){
		$interior_designs_custom_css .='.woocommerce ul.products li.product .onsale{';
			$interior_designs_custom_css .='left: -10px; right: auto;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_sale_position == 'right'){
		$interior_designs_custom_css .='.woocommerce ul.products li.product .onsale{';
			$interior_designs_custom_css .='left: auto; right: 0;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_product_sale_font_size = get_theme_mod('interior_designs_product_sale_font_size', 15);
	$interior_designs_custom_css .='.woocommerce span.onsale {';
		$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_product_sale_font_size).'px;';
	$interior_designs_custom_css .='}';

	// footer background css
	$interior_designs_footer_background_color = get_theme_mod('interior_designs_footer_background_color');
	$interior_designs_custom_css .='.footertown{';
		$interior_designs_custom_css .='background-color: '.esc_attr($interior_designs_footer_background_color).';';
	$interior_designs_custom_css .='}';

	$interior_designs_footer_background_img = get_theme_mod('interior_designs_footer_background_img');
	if($interior_designs_footer_background_img != false){
		$interior_designs_custom_css .='.footertown{';
			$interior_designs_custom_css .='background: url('.esc_attr($interior_designs_footer_background_img).') no-repeat; background-size: cover; background-attachment: fixed;';
		$interior_designs_custom_css .='}';
	}

	/*---- Comment form ----*/
	$interior_designs_comment_width = get_theme_mod('interior_designs_comment_width', '100');
	$interior_designs_custom_css .='#comments textarea{';
		$interior_designs_custom_css .=' width:'.esc_attr($interior_designs_comment_width).'%;';
	$interior_designs_custom_css .='}';

	$interior_designs_comment_submit_text = get_theme_mod('interior_designs_comment_submit_text', 'Post Comment');
	if($interior_designs_comment_submit_text == ''){
		$interior_designs_custom_css .='#comments p.form-submit {';
			$interior_designs_custom_css .='display: none;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_comment_title = get_theme_mod('interior_designs_comment_title', 'Leave a Reply');
	if($interior_designs_comment_title == ''){
		$interior_designs_custom_css .='#comments h2#reply-title {';
			$interior_designs_custom_css .='display: none;';
		$interior_designs_custom_css .='}';
	}

	// Topbar padding
	$interior_designs_topbar_top_bottom = get_theme_mod('interior_designs_topbar_top_bottom', 5);
	$interior_designs_custom_css .='.top-header{';
		$interior_designs_custom_css .=' padding-top:'.esc_attr($interior_designs_topbar_top_bottom).'px; padding-bottom:'.esc_attr($interior_designs_topbar_top_bottom).'px;';
	$interior_designs_custom_css .='}';

	// Sticky Header padding
	$interior_designs_sticky_header_padding = get_theme_mod('interior_designs_sticky_header_padding');
	$interior_designs_custom_css .='.fixed-header{';
		$interior_designs_custom_css .=' padding-top:'.esc_attr($interior_designs_sticky_header_padding).'px; padding-bottom:'.esc_attr($interior_designs_sticky_header_padding).'px;';
	$interior_designs_custom_css .='}';

	// Navigation Font Size 
	$interior_designs_nav_font_size = get_theme_mod('interior_designs_nav_font_size');
	if($interior_designs_nav_font_size != false){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_nav_font_size).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_navigation_case = get_theme_mod('interior_designs_navigation_case', 'capitalize');
	if($interior_designs_navigation_case == 'uppercase' ){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .=' text-transform: uppercase;';
		$interior_designs_custom_css .='}';
	}elseif($interior_designs_navigation_case == 'capitalize' ){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .=' text-transform: capitalize;';
		$interior_designs_custom_css .='}';
	}

    // site title color option
	$interior_designs_site_title_color_setting = get_theme_mod('interior_designs_site_title_color_setting');
	$interior_designs_custom_css .=' .logo h1 a, .logo p a{';
		$interior_designs_custom_css .='color: '.esc_attr($interior_designs_site_title_color_setting).';';
	$interior_designs_custom_css .='} ';

	$interior_designs_tagline_color_setting = get_theme_mod('interior_designs_tagline_color_setting');
	$interior_designs_custom_css .=' .logo p.site-description{';
		$interior_designs_custom_css .='color: '.esc_attr($interior_designs_tagline_color_setting).';';
	$interior_designs_custom_css .='} ';  

	//Site title Font size
	$interior_designs_site_title_fontsize = get_theme_mod('interior_designs_site_title_fontsize');
	$interior_designs_custom_css .='.logo h1, .logo p.site-title{';
		$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_site_title_fontsize).'px;';
	$interior_designs_custom_css .='}';

	$interior_designs_site_description_fontsize = get_theme_mod('interior_designs_site_description_fontsize');
	$interior_designs_custom_css .='.logo p.site-description{';
		$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_site_description_fontsize).'px;';
	$interior_designs_custom_css .='}';

	/*----- Featured image css -----*/
	$interior_designs_featured_image_border_radius = get_theme_mod('interior_designs_featured_image_border_radius');
	if($interior_designs_featured_image_border_radius != false){
		$interior_designs_custom_css .='.inner-service .service-image img, .inner-service .service-image{';
			$interior_designs_custom_css .='border-radius: '.esc_attr($interior_designs_featured_image_border_radius).'px;';
		$interior_designs_custom_css .='}';
	}

	$interior_designs_featured_image_box_shadow = get_theme_mod('interior_designs_featured_image_box_shadow');
	if($interior_designs_featured_image_box_shadow != false){
		$interior_designs_custom_css .='.inner-service .service-image img, .inner-service .service-image{';
			$interior_designs_custom_css .='box-shadow: 8px 8px '.esc_attr($interior_designs_featured_image_box_shadow).'px #aaa;';
		$interior_designs_custom_css .='}';
	}

	//  ------------ Mobile Media Options ----------
	$interior_designs_responsive_topbar_hide = get_theme_mod('interior_designs_responsive_topbar_hide',false);
	if($interior_designs_responsive_topbar_hide == true && get_theme_mod('interior_designs_topbar_hide',false) == false){
		$interior_designs_custom_css .='@media screen and (min-width:575px){
			.top-header{';
			$interior_designs_custom_css .='display:none;';
		$interior_designs_custom_css .='} }';
	}

	if($interior_designs_responsive_topbar_hide == false){
		$interior_designs_custom_css .='@media screen and (max-width:575px){
			.top-header{';
			$interior_designs_custom_css .='display:none;';
		$interior_designs_custom_css .='} }';
	}

	$interior_designs_responsive_show_back_to_top = get_theme_mod('interior_designs_responsive_show_back_to_top',true);
	if($interior_designs_responsive_show_back_to_top == true && get_theme_mod('interior_designs_show_back_to_top',true) == false){
		$interior_designs_custom_css .='@media screen and (min-width:575px){
			.scrollup{';
			$interior_designs_custom_css .='visibility:hidden;';
		$interior_designs_custom_css .='} }';
	}

	if($interior_designs_responsive_show_back_to_top == false){
		$interior_designs_custom_css .='@media screen and (max-width:575px){
			.scrollup{';
			$interior_designs_custom_css .='visibility:hidden;';
		$interior_designs_custom_css .='} }';
	}

    $interior_designs_responsive_sticky_header = get_theme_mod('interior_designs_responsive_sticky_header',false);
	if($interior_designs_responsive_sticky_header == true && get_theme_mod('interior_designs_sticky_header',false) == false){
		$interior_designs_custom_css .='@media screen and (min-width:575px){
			.fixed-header{';
			$interior_designs_custom_css .='position:static !important;';
		$interior_designs_custom_css .='} }';
	}

	if($interior_designs_responsive_sticky_header == false){
		$interior_designs_custom_css .='@media screen and (max-width:575px){
			.fixed-header{';
			$interior_designs_custom_css .='position:static !important;';
		$interior_designs_custom_css .='} }';
	}	

	$interior_designs_slider = get_theme_mod( 'interior_designs_mobile_media_slider',false);
	if($interior_designs_slider == true && get_theme_mod( 'interior_designs_slider_arrows', false) == false){
    	$interior_designs_custom_css .='#slider{';
			$interior_designs_custom_css .='display:none;';
		$interior_designs_custom_css .='} ';
	}
    if($interior_designs_slider == true){
    	$interior_designs_custom_css .='@media screen and (max-width:575px) {';
		$interior_designs_custom_css .='#slider{';
			$interior_designs_custom_css .='display:block;';
		$interior_designs_custom_css .='} }';
	}else if($interior_designs_slider == false){
		$interior_designs_custom_css .='@media screen and (max-width:575px) {';
		$interior_designs_custom_css .='#slider{';
			$interior_designs_custom_css .='display:none;';
		$interior_designs_custom_css .='} }';
	}

	// slider overlay
	$interior_designs_home_slider_overlay = get_theme_mod('interior_designs_home_slider_overlay', true);
	if($interior_designs_home_slider_overlay == false){
		$interior_designs_custom_css .='#slider img{';
			$interior_designs_custom_css .='opacity:1;';
		$interior_designs_custom_css .='}';
	} 
	$interior_designs_home_slider_overlay_color = get_theme_mod('interior_designs_home_slider_overlay_color', true);
	if($interior_designs_home_slider_overlay != false){
		$interior_designs_custom_css .='#slider{';
			$interior_designs_custom_css .='background-color: '.esc_attr($interior_designs_home_slider_overlay_color).';';
		$interior_designs_custom_css .='}';
	}

	// menu font weight
	$interior_designs_theme_lay = get_theme_mod( 'interior_designs_font_weight_menu_option','Defalt');
    if($interior_designs_theme_lay == '300'){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .='font-weight:300;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_theme_lay == '400'){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .='font-weight: 400;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_theme_lay == 'Defalt'){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .='font-weight: 500;';
		$interior_designs_custom_css .='}';
	}else if($interior_designs_theme_lay == '700'){
		$interior_designs_custom_css .='.primary-navigation ul li a{';
			$interior_designs_custom_css .='font-weight: 700;';
		$interior_designs_custom_css .='}';
	}

	// menu color
	$interior_designs_menu_color = get_theme_mod('interior_designs_menu_color');

	$interior_designs_custom_css .='.primary-navigation a,.primary-navigation .current_page_item > a, .primary-navigation .current-menu-item > a, .primary-navigation .current_page_ancestor > a{';
			$interior_designs_custom_css .='color: '.esc_attr($interior_designs_menu_color).'!important;';
	$interior_designs_custom_css .='}';

	// menu hover color
	$interior_designs_menu_hover_color = get_theme_mod('interior_designs_menu_hover_color');
	$interior_designs_custom_css .='.primary-navigation a:hover, .primary-navigation ul li a:hover, .primary-navigation ul.sub-menu a:hover, .primary-navigation ul.sub-menu li a:hover{';
			$interior_designs_custom_css .='color: '.esc_attr($interior_designs_menu_hover_color).' !important;';
	$interior_designs_custom_css .='}';

	// Submenu color
	$interior_designs_submenu_menu_color = get_theme_mod('interior_designs_submenu_menu_color');
	$interior_designs_custom_css .='.primary-navigation ul.sub-menu a, .primary-navigation ul.sub-menu li a{';
			$interior_designs_custom_css .='color: '.esc_attr($interior_designs_submenu_menu_color).' !important;';
	$interior_designs_custom_css .='}';

	// social icons font size
	$interior_designs_social_icons_font_size = get_theme_mod('interior_designs_social_icons_font_size', 12);
	$interior_designs_custom_css .='.social-media i{';
		$interior_designs_custom_css .='font-size: '.esc_attr($interior_designs_social_icons_font_size).'px;';
	$interior_designs_custom_css .='}';

	/*-------- Copyright background css -------*/
	$interior_designs_copyright_background_color = get_theme_mod('interior_designs_copyright_background_color');
	$interior_designs_custom_css .='#footer{';
		$interior_designs_custom_css .='background: '.esc_attr($interior_designs_copyright_background_color).';';
	$interior_designs_custom_css .='}';

	// Logo padding
	$interior_designs_logo_padding = get_theme_mod('interior_designs_logo_padding');
	$interior_designs_custom_css .='.logo{';
		$interior_designs_custom_css .=' padding:'.esc_attr($interior_designs_logo_padding).'px;';
	$interior_designs_custom_css .='}';

    // Logo padding
	$interior_designs_logo_padding = get_theme_mod('interior_designs_logo_padding');
	$interior_designs_custom_css .='.logo{';
		$interior_designs_custom_css .=' padding:'.esc_attr($interior_designs_logo_padding).'px;';
	$interior_designs_custom_css .='}';