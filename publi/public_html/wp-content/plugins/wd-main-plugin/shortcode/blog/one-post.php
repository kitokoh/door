<?php 
$doors_post_by_id = '';
if($doors_blog_affichage_one_post == 'doors_blog_Post_from_list') {
	$doors_post_by_id = $doors_blog_post_list ;
}

$loop = new WP_Query( array( 'post_type' => 'post' ,'posts_per_page'=>1,'page_id' => $doors_post_by_id) );
    while ( $loop->have_posts() ) : $loop->the_post(); 
	
	$doors_one_post_format = get_post_format();
	
     switch ($doors_one_post_format) {
     	
         case 'gallery':
              include( plugin_dir_path( __FILE__ ).'wd-content-gallery.php');
             break;
			 
         case 'video':
             ?>
             
             <?php
             break;
		case 'quote':
			
             include( plugin_dir_path( __FILE__ ).'wd-content-quote.php');
        break;
			case 'sound':
             ?>
             
             <?php
        break;
         default:
             include( plugin_dir_path( __FILE__ ).'wd-content.php');
             break;
     }
    ?>
		
		 <?php endwhile;
		 ?>
		<?php wp_reset_query(); 	
?>