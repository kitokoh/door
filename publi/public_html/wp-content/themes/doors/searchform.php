<?php
/**
 * The template for displaying search forms in Doors
 *
 */
?>

<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="searchform" id="searchform" method="get" role="search">
  <div>
    <input class="bacha" type="text" id="s" name="s" value="">
    <input type="submit" value="<?php echo esc_html__( 'Search', 'doors' ) ?>" id="searchsubmit">
  </div>
</form>


