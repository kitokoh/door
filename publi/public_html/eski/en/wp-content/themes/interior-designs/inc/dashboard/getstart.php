<?php
//about theme info
add_action( 'admin_menu', 'interior_designs_gettingstarted' );
function interior_designs_gettingstarted() {    	
	add_theme_page( esc_html__('Get Started', 'interior-designs'), esc_html__('Get Started', 'interior-designs'), 'edit_theme_options', 'interior_designs_guide', 'interior_designs_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function interior_designs_admin_theme_style() {
   wp_enqueue_style('interior-designs-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/dashboard/getstart.css');
   wp_enqueue_script('tabs', esc_url(get_template_directory_uri()) . '/inc/dashboard/js/tab.js');
}
add_action('admin_enqueue_scripts', 'interior_designs_admin_theme_style');

//guidline for about theme
function interior_designs_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'interior-designs' );
?>

<div class="wrapper-info">  
    <div class="tab-sec">
		<div class="tab">
			<div class="logo">
				<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/logo.png" alt="" />
			</div>
			<button role="tab" class="tablinks home" onclick="interior_designs_openCity(event, 'tc_index')"><?php esc_html_e( 'Free Theme Information', 'interior-designs' ); ?></button>
		  	<button role="tab" class="tablinks" onclick="interior_designs_openCity(event, 'tc_pro')"><?php esc_html_e( 'Premium Theme Information', 'interior-designs' ); ?></button>
		  	<button role="tab" class="tablinks" onclick="interior_designs_openCity(event, 'tc_create')"><?php esc_html_e( 'Theme Support', 'interior-designs' ); ?></button>				
		</div>

		<div  id="tc_index" class="tabcontent">
			<h2><?php esc_html_e( 'Welcome to Interior Designs Theme', 'interior-designs' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
			<hr>
			<div class="info-link">
				<a href="<?php echo esc_url( INTERIOR_DESIGNS_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'interior-designs' ); ?></a>
				<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'interior-designs'); ?></a>
				<a class="get-pro" href="<?php echo esc_url( INTERIOR_DESIGNS_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'interior-designs'); ?></a>
			</div>
			<div class="col-tc-6">
				<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/screenshot.png" alt="" />
			</div>
			<div class="col-tc-6">
				<P><?php esc_html_e( 'Interior Designs WordPress Theme is an aesthetically designed modern WordPress theme. It finds its application in Interior Designsing sites, home decor sites, architectural firms, electrician, industries, Decoration, Small kitchens, baby proofing, Electrical fittings, Small bedroom, Front doors, Garden, Shed Double Garage, Prefabricated Garage, Front yard, Garden Pond, Country house.. Rock Garden. Bungalows, Glass doors, Carport, architecture, business, consultant, finance, real estate, architect, carpet, cleaning, carpenter, consulting, plumbing, maintenance services, ac reair, construction, archealogical surveys, corporate, education, color scheme, online furniture stores and for an Interior Design company. The theme can be also be used by fashion designers, home decors, creative websites and art decors. It has a stylish approach to its design. The colour scheme of the theme is decided keeping in mind the purpose of the theme. The theme is beautiful to make your products and ideas look even more beautiful. You can use this theme as a blog or as a portfolio to showcase your work. The Interior Design theme is fully responsive, has grid layout options and translation ready to serve many demographics. You can customize it to change its colour, background, font etc. without writing a single line of code. The theme has user-friendly and interactive interface to let easy navigation through the site. It is SEO-friendly to help locate your site easily in search results. Its pages load faster. The theme uses banner to show your prominent work and give a glimpse of what your site contains. It implements shortcodes. The clean and secure code prevents it from any security breach. You can extend the site’s functionalities using third party plugins. It has social media icons to make your site content shareable across various social networking sites. You can translate this theme into different languages such as Arabic, German, Spanish, French, Italian, Russian, Turkish and Chinese.', 'interior-designs' ); ?></P>
			</div>
    	</div>

		<div id="tc_pro" class="tabcontent">
			<h3><?php esc_html_e( 'Interior Designs Theme Information', 'interior-designs' ); ?></h3>
			<hr>
			<div class="pro-image">
				<img role="img" src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/dashboard/images/resize.png" alt="" />
			</div>
			<div class="info-link-pro">
				<p><a href="<?php echo esc_url( INTERIOR_DESIGNS_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Buy Now', 'interior-designs' ); ?></a></p>
				<p><a href="<?php echo esc_url( INTERIOR_DESIGNS_LIVE_DEMO ); ?>" target="_blank"> <?php esc_html_e( 'Live Demo', 'interior-designs' ); ?></a></p>
				<p><a href="<?php echo esc_url( INTERIOR_DESIGNS_PRO_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Pro Documentation', 'interior-designs' ); ?></a></p>
			</div>
			<div class="col-pro-5">
				<h4><?php esc_html_e( 'Interior Designs Pro Theme', 'interior-designs' ); ?></h4>
				<P><?php esc_html_e( 'The premium interior design WordPress theme is stuffed with amazing features and functionality to make your site stand apart from others of the like. It has a modern and stylish yet classic look that will never be over the top. The theme can be used for interior designing, home decors, furnishing and decoration, furniture store, architecture, interior decorating company and so on. Growing and established businesses can equally reap benefits from it. This interior design responsive theme is also cross-browser compatible and translation ready. The SEO-friendly Interior Design WordPress Theme is optimized for speed and will give a higher rank to your site in search engine results. The customizability can be extended to change its color, background, images, header, footer, logo and other things to personalize the site according to your requirements. It is WooCommerce compatible and supports third party plugins effortlessly. Add widgets to your theme to organize the site content more precisely. Unlimited slides, multiple page layouts, 100+ Font families and unlimited colors will open more options to change the look of the theme. Enable/disable sections according to your wish. We have added a separate testimonial and newsletter section. Other than these features, a stunning look and good experience add to the fine quality of this interior design theme.', 'interior-designs' ); ?></P>		
			</div>
			<div class="col-pro-6">				
				<h4><?php esc_html_e( 'Theme Features', 'interior-designs' ); ?></h4>
				<ul>
					<li><?php esc_html_e( 'Theme Options using Customizer API', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Responsive design', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Favicon, Logo, title and tagline customization', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Advanced Color options', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( '100+ Font Family Options', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Background Image Option', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Simple Menu Option', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Additional section for products', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Enable-Disable options on All sections', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Home Page setting for different sections', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Advance Slider with unlimited slides', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Partner Section', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Promotional Banner Section for Products', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Seperate Newsletter Section', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Text and call to action button for each slides', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Pagination option', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Custom CSS option', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Translations Ready', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Custom Backgrounds, Colors, Headers, Logo & Menu', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Customizable Home Page', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Full-Width Template', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Footer Widgets & Editor Style', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Banner & Post Type Plugin Functionality', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Woo Commerce Compatible', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Multiple Inner Page Templates', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Product Sliders', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Testimonial Slider', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Testimonial Posttype', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Testimonial Listing With Shortcode', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Contact page template', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Contact Widget', 'interior-designs' ); ?></li>
					<li><?php esc_html_e( 'Advance Social Media Feature', 'interior-designs' ); ?></li>
				</ul>				
			</div>
		</div>	

		<div id="tc_create" class="tabcontent">
			<h3><?php esc_html_e( 'Support', 'interior-designs' ); ?></h3>
			<hr>
			<div class="tab-cont">
		  		<h4><?php esc_html_e( 'Need Support?', 'interior-designs' ); ?></h4>				
				<div class="info-link-support">
					<P><?php esc_html_e( 'Our team is obliged to help you in every way possible whenever you face any type of difficulties and doubts.', 'interior-designs' ); ?></P>
					<a href="<?php echo esc_url( INTERIOR_DESIGNS_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support Forum', 'interior-designs' ); ?></a>
				</div>
			</div>
			<div class="tab-cont">	
				<h4><?php esc_html_e('Reviews', 'interior-designs'); ?></h4>				
				<div class="info-link-support">
					<P><?php esc_html_e( 'It is commendable to have such a theme inculcated with amazing features and robust functionalities. I feel grateful to recommend this theme to one and all.', 'interior-designs' ); ?></P>
					<a href="<?php echo esc_url( INTERIOR_DESIGNS_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'interior-designs'); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>