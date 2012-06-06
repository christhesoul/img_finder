<?php

/* Get The Hero Image
		a function to get the 'hero' image for a post
		
		get_the_hero_image($id,$size,$class,$first_active,$permalink)
		
		ALL PARAMETERS ARE OPTIONAL i.e. get_the_hero_images(); should work fine!
		$id = [INTEGER] – page id, defaults to the current page
		$size = [STRING] – defaults to full
		$class = [STRING] – wrap the img in a div with this class
		$first_active = [BOOLEAN] – if true, gives the first img a class of 'active'
		$permalink = [INTEGER] or [STRING] if integer the img will link to that post id, if string will link to that URL
*/	

function get_the_hero_image($id = "page ID", $size = "full", $class = false,$first_active = false,$permalink = false)
{
	$string = "";
	
	if($id == "page ID"){ $id = get_the_ID();	}
	
	$tempvarname = get_post_meta($id,'_img_finder_meta'); //find the img meta details
	$images = $tempvarname[0]['hero']; //stores a string of attachment ids
	
	if($images != ""){
	  if($class) { $string .= '<div class="'.$class.' cf">'; } //adds div.gallery_wrap unless third parameter is false
	  $images = explode(' ',$images); //turns $images into an array
	  foreach($images as $image) {
			if($permalink) {
				if(is_numeric($permalink)) { 
					$string.= '<a href="'.get_permalink($permalink).'">';
				} else { 
					$string.= '<a href="'.$permalink.'">';
				}
			}
			$the_image = wp_get_attachment_image_src($image,$size);
			if($first_active != false) { $the_class = 'active'; } else { $the_class = ''; }
			$string.= '<img class="'.$the_class.'" src="'.$the_image[0].'" />';
			if($permalink) { $string.= '</a>'; }
	  }
	  if($class) { $string .= '</div>'; } //closes div.gallery_wrap unless third parameter is false
	  return $string;
	}
}

function the_hero_image($id = "page ID", $size = "hero", $class = false,$first_active = false,$permalink = false){
	echo get_the_hero_image($id, $size, $class,$first_active,$permalink);
}

/* Get The Supporting Images
		a function to get the supporting image for a post
		
		get_the_sidekick_images($id,$size,$class,$first_active,$permalink)
		
		ALL PARAMETERS ARE OPTIONAL i.e. get_the_sidekick_images(); should work fine!
		$id = [INTEGER] – page id, defaults to the current page
		$size = [STRING] – defaults to full
		$class = [STRING] – wrap the img in a div with this class
		$first_active = [BOOLEAN] – if true, gives the first img a class of 'active'
		$permalink = [INTEGER] or [STRING] if integer the img will link to that post id, if string will link to that URL
*/

function get_the_sidekick_images($id = "page ID", $size = "thumb", $class= "sidekick", $first_active = true, $permalink = false){
	$string = "";
	
	if($id == "page ID"){ $id = get_the_ID();	}
	
	$tempvarname = get_post_meta($id,'_img_finder_meta');
	$images = $tempvarname[0]['images'];
	
	if($images != ""){
		if($class) { $string .= '<div class="'.$class.'_wrap">';	}
	  $images = explode(' ',$images);
		$i = 1;
    foreach($images as $image) {
			if($class) {
				if($i == 1 && $first_active == true) { $newclass = $class .' active'; } else { $newclass = $class; }
				$string.= '<div class="'.$newclass.'">'.wp_get_attachment_image($image,$size).'</div>';
			} else {
				if($i == 1 && $first_active == true) { $newclass = 'active'; } else { $newclass = ''; }
				$the_image = wp_get_attachment_image_src($image,$size);
				$string.= '<img class="'.$newclass.'" src="'.$the_image[0].'" />';
			}
		$i++;
    }
		if($class) { $string .= '</div>'; }
		return $string;
	}
}

function the_sidekick_images($id = "page ID", $size = "supporter", $class= "sidekick", $first_active = false, $permalink = false){
	echo get_the_sidekick_images($id, $size, $class, $first_active);
}