<?php   
  
/* 
Plugin Name: Image Finder
Plugin URI: http://www.wearecondiment.com
Description: For picking loads of images
Version: 1.0 
Author: Chris Waters
Author URI: http://www.wearecondiment.com
*/

function ImgFinder_Metabox() {
	
	$img_finder_options = get_option('img_finder_options');
	$img_finder_post_types = $img_finder_options['post_type'];

	$img_finder_mb = new WPAlchemy_MetaBox(array
	(
		'id' => '_img_finder_meta',
		'title' => 'Image Finder Meta',
		'template' => dirname(__FILE__) . '/img_id_finder_meta.php',
		'types' => $img_finder_post_types
	));
	
	global $pagenow, $typenow;
	$dir = get_bloginfo('template_directory');
	
	if (is_admin() && $pagenow=='post-new.php' OR $pagenow=='post.php') {
		wp_enqueue_script('admin-img-finder', plugins_url('/condiment_img_id_finder.js',__FILE__), 'jquery');
	}
	
	include_once dirname(__FILE__) . '/helpers.php';
	
}

add_action('init','ImgFinder_Metabox');

function img_finder_admin_add_page() {
	add_options_page('Image Finder Options', 'Image Finder', 'manage_options', 'condiment_img_finder', 'img_finder_options_page');
}

add_action('admin_menu', 'img_finder_admin_add_page');

function img_finder_options_page() {
?>
	<div class="wrap">
		<h2>Posts Types To Use Image Finder</h2>
		<form action="options.php" method="post">
			<?php settings_fields('img_finder_options'); ?>
			<?php do_settings_sections('condiment_img_finder'); ?>
			<input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	</div>
<?php }

add_action('admin_init', 'img_finder_admin_init');

function img_finder_admin_init(){
	register_setting('img_finder_options', 'img_finder_options', 'img_finder_options_validate' );
	add_settings_section('img_finder_main', 'Image Finder Settings', 'img_finder_section_text', 'condiment_img_finder');
	add_settings_field('img_finder_settings_field', 'Image Finder Field', 'img_finder_setting_string', 'condiment_img_finder', 'img_finder_main');
}

function img_finder_section_text() {
	echo '<p>Main description of this section here.</p>';
}

function img_finder_setting_string() {
	$options = get_option('img_finder_options');
	$post_types=get_post_types('','names'); 
	foreach ($post_types as $post_type ) {
		$checked = $options[$post_type] == 1 ? ' checked=checked' : '';
	  echo '<input type="checkbox" id="'.$post_type.'_cb" name="img_finder_options['.$post_type.']" value="1"'.$checked.'><label for="'.$post_type.'_cb">'.$post_type.'</label><br>';
	}
}

function img_finder_options_validate($input) {
	$options = get_option('img_finder_options');
	$post_types=get_post_types('','names'); 
	foreach ($post_types as $post_type) {
		$options[$post_type] = $input[$post_type];
		if($options[$post_type] == 1) {
			$array[] = $post_type;
		}
	}
	$options['post_type'] = $array;
	$options['text_string'] = trim($input['text_string']);
	return $options;
}