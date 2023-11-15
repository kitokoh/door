<?php
function word_teaser($string, $count){
  $words = explode(' ',$string);
  $string = implode(' ', array_splice($words,0,$count));
  return  $string;
}


function wd_vc_portfolio($atts)
{

  extract(shortcode_atts(array(
    'itemperpage' => '10',
    'number' => '4',
    'margin' => '10',
    'category' => '',
    'layout' => '1',
    'style' => 'lily',
    'columns' => '3',
    'show_pagination' => ''
  ), $atts));

  ob_start();

  if ($layout == '2') {
    $styel_ss = 'carousel_portfolio';
  } else {
    $styel_ss = 'masque large-up-' . $columns . ' medium-up small-up';
    /*$wd_large = wd_div_large($columns);
    $col='large-'.$wd_large.' columns ';*/
  }

  ?>

  <ul class="content <?php echo $styel_ss ?> " data-numberitem="<?php echo $number ?>"
      data-margin="<?php echo $margin ?>">
    <?php
    if (!empty($show_pagination)) {
      $show_pagination = false;
    } else {
      $show_pagination = true;
    };
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $loop = new WP_Query(array('post_type' => 'portfolio', 'paged' => $paged, 'posts_per_page' => $itemperpage, 'cat' => $category, 'no_found_rows'=> $show_pagination));
    while ($loop->have_posts()) : $loop->the_post(); ?>
      <li class="grid_hover column column-block" >
        <figure class="effect-<?php echo $style ?> ">
          <?php the_post_thumbnail('doors_portfolio') ?>
          <figcaption>
            <div>
              <h2><?php the_title(); ?></h2>
              <p><?php
                echo wp_trim_words( get_the_content(), 5 ); ?></p>
            </div>
            <a href="<?php the_permalink(); ?>">View more</a>
          </figcaption>
        </figure>
      </li>

    <?php endwhile; ?>
  </ul>
  <?php
  if (function_exists('doors_pagination')) {
    doors_pagination($loop->max_num_pages, "", $paged);
  }
  ?>




  <?php return ob_get_clean();

}

add_shortcode('wd_vc_portfolio', 'wd_vc_portfolio'); ?>