<section class="titlebar">
  <div class="row">
      <div class="large-8 columns">
          <h1 id="page-title" class="title">
              <?php
              if (doors_is_blog()) {
                  $doors_blog_id = get_option('page_for_posts');
                  if ($doors_blog_id == false) {
                      if (!is_archive()) {
                          echo esc_html__('Blog', 'doors');
                      } elseif (is_category()) {
                          echo esc_html__('Category Archives', 'doors');
                          echo "  " . strip_tags(category_description());
                      } elseif (is_tag()) {
                          echo esc_html__('Tag Archives', 'doors');
                      } elseif (is_year()) {
                          echo esc_html__('Yearly Archives', 'doors');
                      } elseif (is_month()) {
                          echo esc_html__('Monthly Archives', 'doors');
                      } elseif (is_date()) {
                          echo esc_html__('Daily Archives', 'doors');
                      } elseif (is_author()) {
                          echo esc_html__('Author Archives', 'doors');
                      }
                  } else {
                      echo get_the_title($doors_blog_id);
                  }
              } elseif ( is_search() ) { ?>
                  <?php echo esc_html__( 'Search Result of', 'doors' ) . ': ' . esc_html( get_search_query( false ) ) ?>
                  <?php
              }else {
                  the_title();
              }
              ?>
          </h1>
      </div>
    <div class="large-4 columns">
			<?php doors_breadcrumb(); ?>
    </div>

  </div>
</section>