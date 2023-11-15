<?php
if ( ! function_exists( 'doors_dsm' ) ) {
	function doors_dsm( $var ) {
		print "<pre>" . print_r( $var, true ) . "</pre>";
	}
}
/*---------------------- is blog ----------------------------*/
function doors_is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_tag() ) ) && ( $posttype == 'post' ) ) ? true : false;
}

/*------------image size------------*/
function doors_resize( $url, $width, $height = null, $crop = null, $single = true ) {

//validate inputs
	if ( ! $url OR ! $width ) {
		return false;
	}

//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir  = $upload_info['basedir'];
	$upload_url  = $upload_info['baseurl'];

//check if $img_url is local
	if ( strpos( $url, $upload_url ) === false ) {
		return false;
	}

//define path of image
	$rel_path = str_replace( $upload_url, '', $url );
	$img_path = $upload_dir . $rel_path;

//check if img path exists, and is an image indeed
	if ( ! file_exists( $img_path ) OR ! getimagesize( $img_path ) ) {
		return false;
	}

//get image info
	$info = pathinfo( $img_path );
	$ext  = $info['extension'];
	list( $orig_w, $orig_h ) = getimagesize( $img_path );

//get image size after cropping
	$dims  = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
	$dst_w = $dims[4];
	$dst_h = $dims[5];

//use this to check if cropped image already exists, so we can return that instead
	$suffix       = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

	if ( ! $dst_h ) {
//can't resize, so return original url
		$img_url = $url;
		$dst_w   = $orig_w;
		$dst_h   = $orig_h;
	} //else check if cache exists
	elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} //else, we resize the image and return the new resized image url
	else {

// Note: pre-3.5 fallback check 
		if ( function_exists( 'wp_get_image_editor' ) ) {

			$editor = wp_get_image_editor( $img_path );

			if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) ) {
				return false;
			}

			$resized_file = $editor->save();

			if ( ! is_wp_error( $resized_file ) ) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
				$img_url          = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		} else {

			$resized_img_path = wp_get_image_editor( $img_path, $width, $height, $crop );
			if ( ! is_wp_error( $resized_img_path ) ) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path );
				$img_url          = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		}
	}

//return the output
	if ( $single ) {
//str return
		$image = $img_url;
	} else {
//array return
		$image = array(
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}

	return $image;
}

/*----------------------------breadcrumb------------------------------*/

if ( ! function_exists( "doors_breadcrumb" ) ) {
	function doors_breadcrumb() {
		global $post;
		$post_type = get_post_type();
		echo '<ul class="breadcrumbs">';
		if ( ! is_home() ) {
			echo '<li><a href="';
			echo esc_url( home_url( '/' ) );
			echo '">';
			echo esc_html__( 'Home', 'doors' );
			echo '</a></li>';
			if ( is_category() ) {
				echo '<li>';
				the_category( ' </li><li> ' );
				if ( is_single() ) {
					echo '</li><li>';
					the_title();
					echo '</li>';
				}
			} elseif ( is_single() ) {
				echo '</li><li>';
                $post_link = get_post_type_archive_link($post_type);
                echo '<a href="' . $post_link . '">';
				echo esc_html( $post_type );
				echo '</a>';
				echo '</li>';
				echo '</li><li>';
				the_title();
				echo '</li>';
			} elseif ( is_page() ) {

				if ( $post->post_parent ) {
					$anc   = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$output = '<li><a href="' . esc_url( get_permalink( $ancestor ) ) . '" title="' . get_the_title( $ancestor ) . '">' . get_the_title( $ancestor ) . '</a></li> ';
					}
					echo html_entity_decode($output);
					echo '<strong title="' . esc_attr($title) . '"> ' . esc_html($title) . '</strong>';
				} else {
					echo '<li><strong> ' . get_the_title() . '</strong></li>';
				}
			}
		} elseif ( is_tag() ) {
			single_tag_title();
		} elseif ( is_day() ) {
			echo "<li>".esc_html__('Archive','doors')." </li>";
		} elseif ( is_month() ) {
			echo "<li>".esc_html__('Archive for','doors')." </li>";
		} elseif ( is_year() ) {
			echo "<li>".esc_html__('Archive for','doors')." </li>";
		} elseif ( is_author() ) {
			echo "<li>".esc_html__('Author Archive','doors')."</li>";

		} elseif ( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) {
			echo "<li>".esc_html__('Blog Archives','doors')."</li>";

		} elseif ( is_search() ) {
			echo "<li>".esc_html__('Search Results','doors')."</li>";

		}
		echo '</ul>';
	}
}
function doors_get_post_category() {
	$cat_name             = get_the_terms( get_the_ID(), 'category' );
	$nonprofit_class_name = '';
	if ( isset( $cat_name ) && $cat_name != null ) {
		foreach ( $cat_name as $cat ) {
			$nonprofit_class_name .= ' ' . $cat->slug;
		}
	}

	return $nonprofit_class_name;
}


function doors_pagination( $numpages = '', $pagerange = '', $paged = '' ) {

	if ( empty( $pagerange ) ) {
		$pagerange = 2;
	}

	/**
	 * This first part of our function is a fallback
	 * for custom pagination inside a regular loop that
	 * uses the global $paged and global $wp_query variables.
	 *
	 * It's good because we can now override default pagination
	 * in our theme, and use this function in default quries
	 * and custom queries.
	 */
	global $paged;
	if ( empty( $paged ) ) {
		$paged = 1;
	}
	if ( $numpages == '' ) {
		global $wp_query;
		$numpages = $wp_query->max_num_pages;
		if ( ! $numpages ) {
			$numpages = 1;
		}
	}

	/**
	 * We construct the pagination arguments to enter into our paginate_links
	 * function.
	 */
	$pagination_args = array(
		'base'         => get_pagenum_link( 1 ) . '%_%',
		'format'       => 'page/%#%',
		'total'        => $numpages,
		'current'      => $paged,
		'show_all'     => false,
		'end_size'     => 1,
		'mid_size'     => $pagerange,
		'prev_next'    => true,
		'prev_text'    => __( '« Previous', 'doors' ),
		'next_text'    => __( 'Next »', 'doors' ),
		'type'         => 'plain',
		'add_args'     => false,
		'add_fragment' => ''
	);

	$paginate_links = paginate_links( $pagination_args );

	if ( $paginate_links ) {
		echo "<nav class='custom-pagination text-center'>";
		echo htmlentities( $paginate_links );
		echo "</nav>";
	}

}

if (!function_exists('doors_check_if_empty')) {
	function doors_check_if_empty($propriete, $value)
	{
		$result = '';
		if ($value !== '' && !is_null($value)) {
			if ($propriete == 'background-image') {
				$result = $propriete . ': url(' . $value . ');';
			} else {
				$result = $propriete . ':' . $value . ';';
			}
		}
		return $result;
	}
}

/**
 * Get mobile menu ID
 */

if (!function_exists('doors_mobile_menu_id')) :
  function doors_mobile_menu_id()
  {
    echo 'mobile-menu';
  }
endif;