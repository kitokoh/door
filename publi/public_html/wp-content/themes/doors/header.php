<!doctype html>
<!--[if IE 9]>
<html class="lt-ie10" lang="en"> <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php if (!function_exists('has_site_icon')) {
    if (doors_get_option('doors_favicon', '') != '') { ?>
      <link rel="shortcut icon" href="<?php echo esc_url(doors_get_option('doors_favicon')); ?>" />
  <?php }
  } ?>
  <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open() ?>

  <?php $menu_style = isset($_GET['menustyle']) ? $_GET['menustyle'] : doors_get_option('doors_menu_style', 'corporate'); ?>

  <div id="spaces-main" class="pt-perspective ">
    <section class="page-section home-page" id="page-content">
      <?php get_template_part('parts/header', $menu_style); ?>