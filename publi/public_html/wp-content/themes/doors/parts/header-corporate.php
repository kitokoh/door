<?php
$menu_style = isset($_GET['menustyle']) ? $_GET['menustyle'] : doors_get_option('doors_menu_style', 'corporate');
$doors_menu_sticky = doors_get_option('doors_menu_sticky','');

  ?>
<header class="l-header <?php echo esc_attr($menu_style); ?>-layout">
                    <div class="contain-to-grid  <?php if($doors_menu_sticky == '1')  echo "sticky-nav"; ?> clearfix" >
                        <div class="top-bar " id="responsive-menu" data-topbar data-sticky>
                            <section class="header-info clearfix">
                               <div class="row">
                                <div class="top-bar-left">
                                    <ul class="title-bar" data-responsive-toggle="responsive-menu">
                                        <li class="name">
                                            <?php if (doors_get_option('doors_show_logo') == '1'): ?>
                                                <?php $image = doors_get_option('doors_logo', get_template_directory_uri() . "/images/logo2.png");
                                                if (!empty($image)) {
                                                    ?>
                                                    <h1><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                                                           title="<?php echo bloginfo('name') ?>" class="active">
                                                            <img src="<?php echo esc_url($image) ?>"
                                                                 alt="<?php echo bloginfo('name') ?>"/></a></h1>
                                                    <?php
                                                }
                                            endif; ?>
                                            <?php if (doors_get_option('doors_show_title', '1') == '1'): ?>
                                                <a href="<?php echo esc_url(home_url('/')); ?>"><h2
                                                        class="p-t-20"><?php echo bloginfo('name') ?></h2></a>
                                            <?php endif ?>
                                        </li>
                                    </ul>
                                </div>
                                <div class="top-bar-right larg-up text-right">
                                    <?php if (doors_get_option('adress') != "") { ?>
                                        <div class="address_bar">
                                            <div class="address_icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19.515" height="30.223"
                                                     viewBox="0 0 19.515 30.223">
                                                    <g transform="translate(-183.6 -10)">
                                                        <path
                                                            d="M366.049,187.8c-2.562,0-4.649,2.666-4.649,5.94s2.086,5.94,4.649,5.94,4.649-2.666,4.649-5.94S368.611,187.8,366.049,187.8Zm0,10.586c-2.006,0-3.639-2.087-3.639-4.65s1.633-4.65,3.639-4.65,3.639,2.087,3.639,4.65S368.054,198.386,366.049,198.386Z"
                                                            transform="translate(-172.691 -173.722)" fill="#005fff"/>
                                                        <path
                                                            d="M193.358,10a9.758,9.758,0,0,0-7.991,15.358l7.96,14.865,7.8-14.559a9.668,9.668,0,0,0,1.992-5.906A9.769,9.769,0,0,0,193.358,10Zm7,15.127-.025.031-7.01,13.1-6.754-12.616-.389-.737a8.825,8.825,0,1,1,14.177.225Z"
                                                            fill="#005fff"/>
                                                    </g>
                                                </svg>
                                            </div>
                                            <ul class="bar">
                                                <li class="address"><?php echo esc_html__('Address', 'doors') ?></li>
                                                <li
                                                    class="text_add"><?php echo esc_html(doors_get_option('adress', '547, San Diego')); ?></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <?php if (doors_get_option('work') != "") { ?>
                                        <div class="address_bar">
                                            <div class="address_icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="28.574" height="28.574"
                                                     viewBox="0 0 28.574 28.574">
                                                    <path
                                                        d="M14.287,0A14.287,14.287,0,1,0,28.574,14.287,14.3,14.3,0,0,0,14.287,0Zm0,27.622A13.335,13.335,0,1,1,27.622,14.287,13.35,13.35,0,0,1,14.287,27.622Z"
                                                        fill="#005fff"/>
                                                    <path
                                                        d="M24.191,20.185v-4.83a.476.476,0,0,0-.952,0v4.83a1.9,1.9,0,0,0-1.361,1.361h-3.4a.476.476,0,0,0,0,.952h3.4a1.9,1.9,0,1,0,2.314-2.314Zm-.476,2.79a.952.952,0,1,1,.952-.952A.953.953,0,0,1,23.715,22.975Z"
                                                        transform="translate(-9.428 -7.793)" fill="#005fff"/>
                                                    <path
                                                        d="M29.476,8.308a.476.476,0,0,0,.476-.476V7.355a.476.476,0,0,0-.952,0v.476A.476.476,0,0,0,29.476,8.308Z"
                                                        transform="translate(-15.189 -3.603)" fill="#005fff"/>
                                                    <path
                                                        d="M29.476,49.879a.476.476,0,0,0-.476.476v.476a.476.476,0,1,0,.952,0v-.476A.476.476,0,0,0,29.476,49.879Z"
                                                        transform="translate(-15.189 -26.125)" fill="#005fff"/>
                                                    <path
                                                        d="M50.952,28.879h-.476a.476.476,0,0,0,0,.952h.476a.476.476,0,1,0,0-.952Z"
                                                        transform="translate(-26.188 -15.126)" fill="#005fff"/>
                                                    <path
                                                        d="M7.952,28.879H7.476a.476.476,0,1,0,0,.952h.476a.476.476,0,1,0,0-.952Z"
                                                        transform="translate(-3.666 -15.126)" fill="#005fff"/>
                                                    <path
                                                        d="M44.325,13.462l-.337.337a.476.476,0,1,0,.673.673L45,14.135a.476.476,0,0,0-.673-.673Z"
                                                        transform="translate(-22.966 -6.978)" fill="#005fff"/>
                                                    <path
                                                        d="M13.92,43.868l-.337.337a.476.476,0,1,0,.673.673l.337-.337a.476.476,0,0,0-.673-.673Z"
                                                        transform="translate(-7.041 -22.903)" fill="#005fff"/>
                                                    <path
                                                        d="M44.662,43.867a.476.476,0,1,0-.673.673l.337.337A.476.476,0,0,0,45,44.2Z"
                                                        transform="translate(-22.966 -22.903)" fill="#005fff"/>
                                                    <path
                                                        d="M14.257,13.461a.476.476,0,0,0-.673.673l.337.337a.476.476,0,1,0,.673-.673Z"
                                                        transform="translate(-7.041 -6.977)" fill="#005fff"/>
                                                </svg>
                                            </div>
                                            <ul class="bar">
                                                <li class="address"><?php echo esc_html__('Work Time', 'doors') ?></li>
                                                <li class="text_add"><?php
                                                    $work_time = doors_get_option('work');
                                                    if (empty($work_time)) {
                                                        echo esc_html('09:00-17:00');
                                                    } else {
                                                        echo esc_html(doors_get_option('work'));
                                                    }
                                                    ?></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                    <?php if (doors_get_option('phone') != "") { ?>
                                        <div class="address_bar">
                                            <div class="address_icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="27.997" height="28"
                                                     viewBox="0 0 27.997 28">
                                                    <path
                                                        d="M15.564-502.037c1.2.2,2.463,1.27,3.683,3.109,1.231,1.866,1.412,3.284.58,4.57a10.669,10.669,0,0,1-.952,1.095c-.837.865-.87.936-.717,1.494.35,1.264,1.79,3.114,4.417,5.7a23.13,23.13,0,0,0,3.678,3.12,3.172,3.172,0,0,0,2.036.739,4.686,4.686,0,0,0,.761-.646,4.792,4.792,0,0,1,2.31-1.522c1.177-.274,2.665.312,4.482,1.768,1.981,1.587,2.577,3.081,1.866,4.69a7.559,7.559,0,0,1-1.757,2.2c-.936.941-1.078,1.062-1.45,1.237-1.138.542-2.517.553-4.515.044a24.857,24.857,0,0,1-8.872-4.794,41.16,41.16,0,0,1-6.026-6.048c-3.836-4.821-5.8-10.015-4.854-12.856.192-.575.383-.837,1.3-1.784a6.311,6.311,0,0,1,2.857-2.047A3.115,3.115,0,0,1,15.564-502.037Zm-1.2,1.133a4.423,4.423,0,0,0-1.095.69c-.164.142-.181.17-.1.219a12.643,12.643,0,0,1,1.691,1.418,13.247,13.247,0,0,1,2.824,4.274c.109.285.225.542.241.564a6.074,6.074,0,0,0,1.2-1.385,2.111,2.111,0,0,0,.027-1.954,10.048,10.048,0,0,0-2.627-3.442A2.061,2.061,0,0,0,14.36-500.9Zm-2.846,2.452c-1.215,1.51-.279,5.506,2.244,9.567,4.2,6.765,11.832,12.741,17.514,13.715a5.275,5.275,0,0,0,2.78-.192,9,9,0,0,0,.914-.788l.712-.684-.137-.252a12.424,12.424,0,0,0-1.456-1.894,11.036,11.036,0,0,0-4.2-2.709l-.433-.142-.235.219a1.361,1.361,0,0,1-1.095.411c-1.056.005-2.4-.733-4.406-2.419-.837-.706-3.393-3.251-4.126-4.115-1.7-1.981-2.49-3.4-2.5-4.439a1.724,1.724,0,0,1,.312-.98l.142-.175-.1-.279a12.952,12.952,0,0,0-4.214-5.747l-.493-.367-.515.509C11.952-498.94,11.629-498.595,11.514-498.453Zm19.615,15.231c-.4.2-1.324.941-1.242,1.012a2.666,2.666,0,0,0,.4.164,11.087,11.087,0,0,1,5.336,4.241c.208.3.383.558.394.569.022.033.2-.186.482-.6.969-1.4.476-2.676-1.636-4.263a4.953,4.953,0,0,0-3.071-1.341A2.553,2.553,0,0,0,31.129-483.221Z"
                                                        transform="translate(-10 502.065)" fill="#005fff"/>
                                                </svg>
                                            </div>
                                            <ul class="bar">
                                                <li class="address"><?php echo esc_html__('Call Us Today', 'doors') ?></li>
                                                <li class="text_add"><?php echo esc_html(doors_get_option('phone', '458-362-1258')); ?></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>
                                </div>
                            </section>

                            <section class="<?php echo esc_attr($menu_style); ?> top-bar-section">
                              <div class="row">
                                <?php
                                if ($menu_style == "corporate") {
                                    $defaults = array(
                                        'theme_location' => 'primary',
                                        'menu' => '',
                                        'container' => 'div',
                                        'container_class' => 'menu-menu-container',
                                        'container_id' => '',
                                        'menu_class' => 'menu left',
                                        'menu_id' => 'menu-menu',
                                        'echo' => true,
                                        'fallback_cb' => 'doors_main_menu_fallback',
                                        'before' => '',
                                        'after' => '',
                                        'link_before' => '',
                                        'link_after' => '',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth' => 0,
                                        'walker' => new doors_top_bar_walker,
                                    );
                                    wp_nav_menu($defaults);?>
                                    <div class="icon-header">
	                                    <?php
                                    get_template_part('parts/search-icon');
                                    get_template_part('parts/card-icon'); ?>
                                    <div class="languages_section right">
                                        <?php
                                        if (doors_get_option('doors_language_area_html') != "" && doors_get_option('doors_show_wpml_widget') != "on") {
                                            echo html_entity_decode(doors_get_option('doors_language_area_html'));
                                        }
                                        if (doors_get_option('doors_show_wpml_widget') == "on") {
                                            if (do_action('icl_language_selector')) {
                                                do_action('icl_language_selector');
                                            }
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    $text_button_header = doors_get_option('button');
                                    ?>
                                    <div class="request-quote" <?php if (empty($text_button_header)) {
                                        echo ' style = "display: none" ';
                                    } ?>>
                                        <a href="<?php echo esc_url(doors_get_option('doors_button_link')); ?>"
                                           class="has-icon"><?php echo esc_html($text_button_header); ?></a>
                                    </div>
                                    </div>
                                <?php } ?>
                              </div>
                            </section>
                        </div>
                        <!-- menu mobile-->
                        <nav class="mobile-menu vertical menu" id="<?php esc_attr(doors_mobile_menu_id()); ?>">
                            <ul class="title-bar" data-responsive-toggle="responsive-menu">
                                <li data-hide-for="medium-up" class="toggle-topbar menu-icon">
                                    <div class="title-bar-title"><?php echo esc_html__('Menu', 'doors') ?></div>
                                </li>
                                <?php doors_mobile_nav(); ?>
                            </ul>
                        </nav>
                        <div class="request-quote right" style="display: none;">
                            <a href="<?php echo esc_url(doors_get_option('doors_button_link')); ?>"
                               class="has-icon"><?php echo esc_html($text_button_header); ?></a>
                        </div>
                    </div>
                    <!--/.top-Menu -->
                </header>