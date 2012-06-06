<?php
require_once("../../../wp-blog-header.php"); 
header("HTTP/1.0 200 OK");
	$array_string = $_GET['array_string'];
	$offset = $_GET['offset'];
	$selected_images_array = explode(',',$array_string);
	if($array_string != '') {
		$args = array(
			'post_type' => 'attachment',
			'post__in' => $selected_images_array,
			'post_status' => null,
			'post_parent' => null, // any parent
		);
	} else {
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => 20,
			'offset' => $offset,
			'post_status' => null,
			'post_parent' => null, // any parent
		);
	}
	$attachments = get_posts($args);
	if ($attachments) {
		foreach ($attachments as $post) {
			$image_meta = wp_get_attachment_metadata($post->ID);
			$img_width = $image_meta['width'];
			$img_height = $image_meta['height'];
			$img_filename = $image_meta['file'];
			$img_title_a = explode(".",$img_filename);
			$img_title_b = explode("/",$img_title_a[0]);
			$image = wp_get_attachment_image($post->ID);
			if($image) { echo '<div class="choose_image '.$size.'" id="' . $post->ID . '">' . $image . '<span class="title">' . $img_title_b[count($img_title_b) -1] .'</span><span class="img_details">' . $img_filename . '<br />' .$img_width . 'px x '. $img_height . 'px</span></div>'; }
		}
	}
?>