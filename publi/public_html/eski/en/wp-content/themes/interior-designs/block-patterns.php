<?php
/**
 * Interior Designs: Block Patterns
 *
 * @package Interior Designs
 * @since   1.0.0
 */

/**
 * Register Block Pattern Category.
 */
if ( function_exists( 'register_block_pattern_category' ) ) {

	register_block_pattern_category(
		'interior-designs',
		array( 'label' => __( 'Interior Designs', 'interior-designs' ) )
	);
}

/**
 * Register Block Patterns.
 */
if ( function_exists( 'register_block_pattern' ) ) {
	register_block_pattern(
		'interior-designs/banner-section',
		array(
			'title'      => __( 'Banner Section', 'interior-designs' ),
			'categories' => array( 'interior-designs' ),
			'content'    => "<!-- wp:cover {\"url\":\"" . esc_url(get_template_directory_uri()) . "/images/Banner-image.png\",\"id\":2797,\"dimRatio\":0,\"minHeight\":430,\"minHeightUnit\":\"px\",\"align\":\"full\",\"className\":\"interior-designs-banner-section\"} -->\n<div class=\"wp-block-cover alignfull interior-designs-banner-section\" style=\"min-height:430px\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim-0 has-background-dim\"></span><img class=\"wp-block-cover__image-background wp-image-2797\" alt=\"\" src=\"" . esc_url(get_template_directory_uri()) . "/images/Banner-image.png\" data-object-fit=\"cover\"/><div class=\"wp-block-cover__inner-container\"><!-- wp:paragraph {\"align\":\"center\",\"placeholder\":\"Write title…\",\"fontSize\":\"large\"} -->\n<p class=\"has-text-align-center has-large-font-size\"></p>\n<!-- /wp:paragraph --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'interior-designs/discover-section',
		array(
			'title'      => __( 'Discover Section', 'interior-designs' ),
			'categories' => array( 'interior-designs' ),
			'content'    => "<!-- wp:cover {\"customOverlayColor\":\"#372b2b\",\"minHeight\":50,\"minHeightUnit\":\"px\",\"align\":\"full\",\"className\":\"interior-designs-discover-section\"} -->\n<div class=\"wp-block-cover alignfull interior-designs-discover-section\" style=\"min-height:50px\"><span aria-hidden=\"true\" class=\"wp-block-cover__background has-background-dim-100 has-background-dim\" style=\"background-color:#372b2b\"></span><div class=\"wp-block-cover__inner-container\"><!-- wp:columns {\"align\":\"wide\",\"className\":\"interior-designs-discover-section1 ps-lg-5 mx-lg-5 mb-0\"} -->\n<div class=\"wp-block-columns alignwide interior-designs-discover-section1 ps-lg-5 mx-lg-5 mb-0\"><!-- wp:column {\"verticalAlignment\":\"top\",\"width\":\"66.66%\",\"className\":\"interior-designs-discover-section-text mx-lg-4\"} -->\n<div class=\"wp-block-column is-vertically-aligned-top interior-designs-discover-section-text mx-lg-4\" style=\"flex-basis:66.66%\"><!-- wp:heading {\"level\":1,\"style\":{\"typography\":{\"fontSize\":\"30px\"},\"color\":{\"text\":\"#f8b742\"}}} -->\n<h1 class=\"has-text-color\" style=\"color:#f8b742;font-size:30px\">LIVE THE BEST OF YOUR INTERIOR</h1>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph -->\n<p>simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"verticalAlignment\":\"center\",\"width\":\"33.33%\",\"className\":\"interior-designs-discover-section-button\"} -->\n<div class=\"wp-block-column is-vertically-aligned-center interior-designs-discover-section-button\" style=\"flex-basis:33.33%\"><!-- wp:buttons {\"layout\":{\"type\":\"flex\",\"justifyContent\":\"left\"}} -->\n<div class=\"wp-block-buttons\"><!-- wp:button {\"style\":{\"border\":{\"radius\":\"0px\"},\"color\":{\"background\":\"#f8b742\",\"text\":\"#372b2b\"}},\"className\":\"is-style-fill\",\"fontSize\":\"small\"} -->\n<div class=\"wp-block-button has-custom-font-size is-style-fill has-small-font-size\"><a class=\"wp-block-button__link has-text-color has-background\" style=\"border-radius:0px;background-color:#f8b742;color:#372b2b\">DISCOVER MORE</a></div>\n<!-- /wp:button --></div>\n<!-- /wp:buttons --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div></div>\n<!-- /wp:cover -->",
		)
	);

	register_block_pattern(
		'interior-designs/service-section',
		array(
			'title'      => __( 'Service Section', 'interior-designs' ),
			'categories' => array( 'interior-designs' ),
			'content'    => "<!-- wp:group {\"className\":\"interior-designs-service-section pt-5\"} -->\n<div class=\"wp-block-group interior-designs-service-section pt-5\"><!-- wp:heading {\"textAlign\":\"center\"} -->\n<h2 class=\"has-text-align-center\">SERVICES WE OFFERED</h2>\n<!-- /wp:heading -->\n\n<!-- wp:paragraph {\"align\":\"center\"} -->\n<p class=\"has-text-align-center\">loream ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the </p>\n<!-- /wp:paragraph -->\n\n<!-- wp:columns {\"className\":\"interior-designs-service-section-colum pt-lg-3\"} -->\n<div class=\"wp-block-columns interior-designs-service-section-colum pt-lg-3\"><!-- wp:column {\"className\":\"interior-designs-service-img-section\"} -->\n<div class=\"wp-block-column interior-designs-service-img-section\"><!-- wp:image {\"id\":2819,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-full mb-2\"><img src=\"" . esc_url(get_template_directory_uri()) . "/images/services-image1.png\" alt=\"\" class=\"wp-image-2819\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#372b2b\"},\"typography\":{\"fontSize\":\"15px\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#372b2b;font-size:15px\">LOREM IPSUM</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"interior-designs-service-img-section\"} -->\n<div class=\"wp-block-column interior-designs-service-img-section\"><!-- wp:image {\"id\":2821,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-full mb-2\"><img src=\"" . esc_url(get_template_directory_uri()) . "/images/services-image2.png\" alt=\"\" class=\"wp-image-2821\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#372b2b\"},\"typography\":{\"fontSize\":\"15px\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#372b2b;font-size:15px\">LOREM IPSUM</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"interior-designs-service-img-section\"} -->\n<div class=\"wp-block-column interior-designs-service-img-section\"><!-- wp:image {\"id\":2822,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-full mb-2\"><img src=\"" . esc_url(get_template_directory_uri()) . "/images/services-image3.png\" alt=\"\" class=\"wp-image-2822\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#372b2b\"},\"typography\":{\"fontSize\":\"15px\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#372b2b;font-size:15px\">LOREM IPSUM</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column -->\n\n<!-- wp:column {\"className\":\"interior-designs-service-img-section\"} -->\n<div class=\"wp-block-column interior-designs-service-img-section\"><!-- wp:image {\"id\":2820,\"sizeSlug\":\"full\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-full mb-2\"><img src=\"" . esc_url(get_template_directory_uri()) . "/images/services-image4.png\" alt=\"\" class=\"wp-image-2820\"/></figure>\n<!-- /wp:image -->\n\n<!-- wp:paragraph {\"align\":\"center\",\"style\":{\"color\":{\"text\":\"#372b2b\"},\"typography\":{\"fontSize\":\"15px\"}}} -->\n<p class=\"has-text-align-center has-text-color\" style=\"color:#372b2b;font-size:15px\">LOREM IPSUM</p>\n<!-- /wp:paragraph --></div>\n<!-- /wp:column --></div>\n<!-- /wp:columns --></div>\n<!-- /wp:group -->",
		)
	);
}