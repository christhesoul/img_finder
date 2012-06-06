<?php
function get_the_meta_images($id = "page ID", $size = "supporter", $class= "supporter",$first_active = false){
	$string = "";
	if($id == "page ID"){
	    $id = get_the_ID();
	}
	$tempvarname = get_post_meta($id,'_img_id_finder_meta');
	$images = $tempvarname[0]['images'];
	if($images != ""){
			if($class != false) {
				$string .= '<div class="'.$class.'_wrap">';
			}
	    $images = explode(' ',$images);
			$i = 1;
	    foreach($images as $image) {
				if($class != false) {
					if($i == 1 && $first_active == true) { $newclass = $class .' active'; } else { $newclass = $class; }
					$string.= '<div class="'.$newclass.'">'.wp_get_attachment_image($image,$size).'</div>';
				} else {
					if($i == 1 && $first_active == true) { $newclass = 'active'; } else { $newclass = ''; }
					$the_image = wp_get_attachment_image_src($image,$size);
					$string.= '<img class="'.$newclass.'" src="'.$the_image[0].'" />';
				}
			$i++;
	    }
	    $string .= '<div class="clearboth"></div>';
			if($class != false) {
				$string .= '</div>';
			}
		    return $string;
	}
    }
    function the_meta_images($id = "page ID", $size = "supporter", $class= "metaimages",$first_active = false){
		echo get_the_meta_images($id, $size, $class, $first_active);
    }
function get_the_meta_hero($id = "page ID", $size = "hero", $class= "metaimages",$first_active = false,$permalink = "")
{
	$string = "";
	if($id == "page ID"){
		$id = get_the_ID();
	}
	$tempvarname = get_post_meta($id,'_img_id_finder_meta');
	$images = $tempvarname[0]['hero'];
	if($images != ""){
	  if($class != "metaimages") { $string .= '<div class="'.$class.'">'; }
	  $images = explode(' ',$images);
	  foreach($images as $image) {
			if($permalink != "") { $string.= '<a href="'.get_permalink($permalink).'">'; }
			$the_image = wp_get_attachment_image_src($image,$size);
			if($first_active != false) { $the_class = 'active'; } else { $the_class = ''; }
			$string.= '<img class="'.$the_class.'" src="'.$the_image[0].'" />';
			if($permalink != "") { $string.= '</a>'; }
	  }
	  if($class != "metaimages") { $string .= '<div class="clearboth"></div></div>'; }
	  return $string;
	}
    }

    function the_meta_hero($id = "page ID", $size = "hero", $class= "metaimages",$first_active = false,$permalink = ""){
	echo get_the_meta_hero($id, $size, $class,$first_active,$permalink);
    }