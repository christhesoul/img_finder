<style type="text/css">
	.choose_image{ position:relative;width:80px;height:80px;margin:8px;padding:2px;float:left;cursor:pointer; background:#fff; border:4px solid #ccc; }
	.choose_image .title{display:none;}
	.choose_image img { width:60px;height:60px;padding:10px; }
	.active_hero{ border-top: 4px solid #67A7C9;border-left: 4px solid #67A7C9; }
	.active_image{ border-bottom:4px solid #E63F6E; border-right:4px solid #E63F6E; }
	.clear { clear:both; }
	label.hero, label.images { width:80px; margin:8px; padding:6px; background:#ccc; color:#fff; float:left;}
	label.hero.active{background:#67A7C9;}
	label.images.active{background:#E63F6E;}
	label#show-all, #search { width:80px; margin:8px; padding:6px; color:#fff; float:left; background:#00C047; text-decoration:none; font-weight:bold;}
	#search {background:pink;}
	#search-criteria{width:200px;margin:8px; padding:3px;float:left;}
	
	span.img_details { display:inline-block;background-color:yellow;position:absolute;top:50px;left:50px;z-index:4;padding:5px;color:#000;display:none; }
</style>
<div class="my_meta_control">
	<div class="container">
		<label class="hero active">Hero mode</label>
		<label class="images">Images mode</label>
		<input type="text" id="search-criteria">
		<a href="#" id="search">Search</a>
		<label href="#" id="show-all">Show me 20</label>
		<div class="clear"></div>	
	</div>
	<div class="container" id="image_id_finder">
    <div class="clear"></div>
	</div>	
	<?php $mb->the_field('hero'); ?>
	<input type="hidden" class="heroid" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
	<?php $mb->the_field('images'); ?>
	<input type="hidden" class="imgids" name="<?php $mb->the_name(); ?>" value="<?php $mb->the_value(); ?>" />
</div>