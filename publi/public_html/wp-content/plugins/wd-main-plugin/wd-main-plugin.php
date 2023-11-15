<?php
/**

 * Plugin Name: Webdevia main plugin

 * Plugin URI: http://www.themeforest.net/user/Mymoun

 * Description: Add features to Mymoun themes.

 * Version: 4.5.3

 * Author: Mymoun

 * Author URI: http://www.themeforest.net/user/Mymoun

 */


class WebdeviaMainPlugin {
	function __construct() {
		require_once( plugin_dir_path( __FILE__ ) . 'post-types.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'widgets/widget.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'widgets/adress.php' );
		require_once( plugin_dir_path( __FILE__ ) . '/import/wd-import.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/latsone.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_pricing_table.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_client.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_team.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_vc_portfolio.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_testimonial.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_single_post.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_countup.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_chartpie.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_icon_text.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_flip_image.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_recent_blog.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_google_map.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/progress_bars.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_hero_image.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_modal.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_headings.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_empty_spaces.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_text_icon.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_team_member.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd_image_with_text.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd-blog.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'shortcode/wd-button.php' );
		include_once( plugin_dir_path( __FILE__ ) . 'meta-box.php' );
        add_action( 'admin_enqueue_scripts', 'doors_plugin_script' );
        function doors_plugin_script(){
            wp_enqueue_script( 'doors-plugin-script', plugin_dir_url( __FILE__ ) . '/js/media-upload.js', array( 'jquery' ) );
            wp_enqueue_script( 'doors-plugin-import-script', plugin_dir_url( __FILE__ ) . '/js/import_script.js', array( 'jquery' ) );
        }

	}
}


new WebdeviaMainPlugin;

function image_from_url_relatives($image_url){
    $images=array();
    $images=explode('/',$image_url);
    $position=array_search('uploads',$images);
    $content=array();
    if($position){
        for($i=$position; $i<count($images);$i++) array_push($content,$images[$i]);
        $image_relative_link=get_site_url(). '/wp-content/'.implode('/',$content);
        if($image_url!=$image_relative_link) update_post_meta(get_the_ID(), 'pciture', $image_relative_link);
        return $image_relative_link;
    } else {
        return $image_url;
    }
}

function doors_getImageBySize($params){
	if (function_exists('wpb_getImageBySize')) {
		return wpb_getImageBySize($params);
	}{
		return false;
	}
}