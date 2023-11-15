<?php
if (!function_exists('doors_image_with_text')) {
	function doors_image_with_text($atts)
	{
		$css_animation = $title = $image = $extra_classes = $text = $url = "";
		extract(shortcode_atts(array(
			'title' => 'Block title',
			'text' => 'Some text should be hrre...',
			'layout' => '1',
			'extra_classes' => '',
			'url' => '',
			'image_checkbox' => '',
			'image' => '',
			'css_animation' => 'no',
		), $atts));
		$img_size = "doors_small-thumb";
		$thumb_size = "thumbnail";
		$post_thumbnail = "";
		$animation_classes = "";
		$data_animated = "";
		if (($css_animation != 'no')) {
			$animation_classes = " animated ";
			$data_animated = "data-animated=$css_animation";
		}
		ob_start(); ?>
		<?php if (isset($layout) && $layout == 1) { ?>
			<section class="wd-image-text style-2">
				<div class="<?php echo esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
					<?php
					$img_id = preg_replace('/[^\d]/', '', $image);
					$img = doors_getImageBySize(array(
						'attach_id'  => $img_id,
						'full_size'  => $img_size,
						'thumb_size' => 'thumbnail'
					));
					$img_path = $img['p_img_large'][0];
					?>
					<img src="<?php echo $img_path ?>" alt="icon" />
					<?php if ($url != "") {
						echo "<a href=$url>";
					} ?>
					<h4 class="wd-title-element"><?php echo $title; ?></h4>
					<?php if ($url != "") {
						echo "</a>";
					} ?>
					<p>
						<?php echo $text; ?>
					</p>
				</div>
			</section>
		<?php } elseif (isset($layout) && $layout == 2) { ?>
			<div class="wd-section-blog-services style-3">
				<article class="layout-<?php echo esc_attr($layout) . ' ' . esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
					<div class="wd-blog-post">
						<div class="svg-wrapper">
							<svg width="172" height="172" xmlns="http://www.w3.org/2000/svg">
								<rect height="166" width="166" class="shape"></rect>
							</svg>
							<div class="img-wrapper">
								<?php
								$img_id = preg_replace('/[^\d]/', '', $image);
								$img = doors_getImageBySize(array(
									'attach_id'  => $img_id,
									'full_size'  => $img_size,
									'thumb_size' => 'thumbnail'
								));
								$img_path = $img['p_img_large'][0]; ?>
								<img src="<?php echo $img_path ?>" alt="icon" />
							</div>
						</div>
						<?php if ($url != "") {
							echo "<a href=$url>";
						} ?>
						<h4 class="wd-title-element"><?php echo $title; ?></h4>
						<?php if ($url != "") {
							echo "</a>";
						} ?>
						<p>
							<?php echo $text; ?>
						</p>
					</div>
				</article>
			</div>
		<?php } else { ?>
			<section class="wd-image-text style-4">
				<div class="<?php echo esc_attr($animation_classes) . ' ' . esc_attr($extra_classes); ?>" <?php echo esc_attr($data_animated); ?>>
					<?php
					$img_id = preg_replace('/[^\d]/', '', $image);
					$img = doors_getImageBySize(array(
						'attach_id'  => $img_id,
						'full_size'  => $img_size,
						'thumb_size' => 'thumbnail'
					));
					$img_path = $img['p_img_large'][0];
					?>
					<img src="<?php echo $img_path ?>" alt="icon" />
					<?php if ($url != "") {
						echo "<a href=$url>";
					} ?>
					<h4 class="wd-title-element"><?php echo $title; ?></h4>
					<svg xmlns="http://www.w3.org/2000/svg" width="42" height="36" viewBox="0 0 42 36">
						<g id="Group_1522" data-name="Group 1522" transform="translate(-669 -2474)">
							<line id="Line_417" data-name="Line 417" x1="12.691" transform="translate(683.954 2491.5) " fill="none" stroke="#707070" stroke-width="1" />
							<g id="Polygon_1" data-name="Polygon 1" transform="translate(669 2474) " fill="none">
								<path d="M21,0,42,36H0Z" stroke="none" />
								<path class="next1" d="M 11.07437133789063 1 L 1.157703399658203 18 L 11.07437133789063 35 L 30.92562866210938 35 L 40.8422966003418 18 L 30.92562866210938 1 L 11.07437133789063 1 M 10.5 0 L 31.5 0 L 42 18 L 31.5 36 L 10.5 36 L 0 18 L 10.5 0 Z" stroke="none" fill="#707070" />
							</g>
							<line id="Line_418" data-name="Line 418" x1="4.835" y2="4.835" transform="translate(691.63 2491.5)" fill="none" stroke="#707070" stroke-width="1" />
							<line id="Line_419" data-name="Line 419" x1="4.835" y1="4.835" transform="translate(691.63 2486.665)" fill="none" stroke="#707070" stroke-width="1" />
						</g>
					</svg>
					<?php if ($url != "") {
						echo "</a>";
					} ?>
					<p>
						<?php echo $text; ?>
					</p>
				</div>
			</section>
		<?php } ?>
<?php return ob_get_clean();
	}
	add_shortcode('doors_image_with_text', 'doors_image_with_text');
}
?>