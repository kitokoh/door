<!doctype html>
<!--[if IE 9]>
<html class="lt-ie10" lang="en"> <![endif]-->
<html class="no-js" <?php language_attributes(); ?> >
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<?php wp_head() ?>
</head>


<body <?php body_class(); ?>>

<div class="corp">
  <div class="row">
    <section class="oops">
      <h2><?php echo esc_html__( 'Oops!!', 'doors' ) ?></h2>
    </section>
    <section>
      <p class="message">
				<?php echo esc_html__( 'It looks like that page no longer exists. Would you like to go to ', 'doors' ); ?><a
          href="<?php echo esc_url( home_url( '/' ) ); ?>"><strong><?php echo esc_html__( 'Homepage', 'doors' ); ?></strong></a> <?php echo esc_html__( 'instead?', 'doors' ); ?>
      </p>
    </section>
    <section class="large-6 columns">
      <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="serch" method="get">
        <input type="text" class="text-input" id="s" name="s" value="<?php echo esc_html__( 'Search ...', 'doors' ) ?>"
               onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
        <input type="submit" class="submit-input" value="Serch">
      </form>
    </section>
    <section class="large-6 columns"></section>
  </div>
</div>
<div class="oops-footer">
  <ul class="social-icons accent inline-list">
		<?php if ( doors_get_option( 'flickr' ) != "" ): ?>
      <li class="flickr">
        <a href="http://www.flickr.com/<?php echo esc_url( doors_get_option( 'flickr' ) ); ?>"><i
            class="fa fa-flickr"></i></a>
      </li>
		<?php endif ?>
		<?php if ( doors_get_option( 'facebook' ) != "" ): ?>
      <li class="facebook">
        <a href="https://www.facebook.com/<?php echo esc_url( doors_get_option( 'facebook' ) ); ?>"><i
            class="fa fa-facebook"></i></a>
      </li>
		<?php endif ?>
		<?php if ( doors_get_option( 'twitter' ) != "" ): ?>
      <li class="twitter">
        <a href="https://twitter.com/<?php echo esc_url( doors_get_option( 'twitter' ) ); ?>"><i
            class="fa fa-twitter"></i></a>
      </li>
		<?php endif ?>
		<?php if ( doors_get_option( 'vimeo' ) != "" ): ?>
      <li class="vimeo">
        <a href="https://vimeo.com/<?php echo esc_url( doors_get_option( 'vimeo' ) ); ?>"><i
            class="fa fa-vimeo-square"></i></a>
      </li>
		<?php endif ?>
  </ul>
</div>

<?php wp_footer(); ?>
</body>
</html>