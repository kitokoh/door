<?php
if ($doors_blog_category != '' && $doors_blog_display_filter != 'doors_blog_show_filter') {
  $doors_blog_category = $doors_blog_category;
}
if ($doors_blog_item_perpage != '') {
  $doors_blog_item_perpage = $doors_blog_item_perpage;
}
if ($doors_blog_columns != '') {
  $doors_blog_columns = $doors_blog_columns;
}
if ($doors_blog_style == 'doors_grid_blog') {
  $doors_blog_grid_style = 'fitRows';
} else {

  $doors_blog_grid_style = 'masonry';
}
if ($doors_blog_display_filter == 'doors_blog_show_filter') {
  $terms = get_terms(array('category'), array('hide_empty' => FALSE));

  ?>
  <div class="filters">
    <a href="#" data-filter=".all">All</a>
    <?php foreach ($terms as $key => $term) { ?>
      <a href="#" class="<?php echo esc_attr($term->slug) ?>"
         data-filter=".<?php echo esc_attr($term->slug) ?>"> <?php echo esc_attr($term->name); ?> </a>
    <?php } ?>
  </div>
<?php }
?>
  <ul class="doors_isotop large-up-<?php echo esc_attr($doors_blog_columns) ?>"
      data-wdgrid="<?php echo esc_attr($doors_blog_grid_style) ?>">

<?php

//global $wp_query;
//$temp = $wp_query;
//$wp_query = null;
//$wp_query = new WP_Query();
if (!empty($show_pagination)) {
  $show_pagination = false;
} else {
  $show_pagination = true;
}
;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$loop = new WP_Query(array(
  'post_type' => 'post',
  'posts_per_page' => $doors_blog_item_perpage,
  'paged' => $paged,
  'category_name' => $doors_blog_category,
  'no_found_rows' => $show_pagination
));


while ($loop->have_posts()) : $loop->the_post();


  $doors_one_post_format = get_post_format();
  switch ($doors_one_post_format) {
    case 'gallery':

      include(plugin_dir_path(__FILE__) . 'wd-content-gallery.php');
      break;

    case 'video':
      include(plugin_dir_path(__FILE__) . 'wd-content-video.php');
      break;
    case 'quote':

      include(plugin_dir_path(__FILE__) . 'wd-content-quote.php');
      break;
    case 'audio':
      include(plugin_dir_path(__FILE__) . 'wd-content-sound.php');
      break;
    default:
      include(plugin_dir_path(__FILE__) . 'wd-content.php');
      break;
  }
endwhile;

?></ul>
<?php
if (function_exists('doors_pagination')) {
  doors_pagination($loop->max_num_pages, "", $paged);
}

wp_reset_query();
?>