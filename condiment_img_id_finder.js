jQuery(function($) {
	if($('input.heroid').length != 0){ // test to see if the metabox is included on the page
		var $ishero = true;
		var	$hero_input = $('input.heroid');
		var $hlimit = 1;
		var	$images_input = $('input.imgids');
    var	$ilimit = 3;
    var $hval = $hero_input.val();
    var $ival = $images_input.val();
		var $offset = 0;
		var $path_to_images_file = '/wp-content/themes/Food-Safari-WP/';
		var $path_to_root = 'http://www.foodsafari.co.uk/';
	  $hids = $hval.split(' ');//prepare ids in an array
		$ids = $ival.split(' ');//prepare ids in an array
		$array_string = $hids.join(',') + ',' + $ids.join(',');
		$.get("../wp-content/plugins/img_finder/image_finder.php?array_string="+$array_string, function(data){
			$("#image_id_finder").prepend(data);//add images
			// add classes to images 
	    $('.choose_image').each(function() {//cycle through the images
				$(this).hide();
	    	$id = $(this).attr("id");
	      for(i=0; i< $ids.length; i++){
	      	if(($id == $ids[i])&&(!$(this).hasClass("active_image"))){
	        	$(this).addClass("active_image").show();
	        }
	      }
				for(i=0; i< $hids.length; i++){
	      	if(($id == $hids[i])&&(!$(this).hasClass("active_hero"))){
	        	$(this).addClass("active_hero").show();
	         }
	      }
	    });
		});
		// add classes to images 
		$('label.hero').click(function(){
			$ishero = true;
			$("label.active").removeClass("active");
			$(this).addClass("active");
		});
		$('label.images').click(function(){
			$ishero = false;
			$("label.active").removeClass("active");
			$(this).addClass("active");
		});
	  // add/remove image on click
	  $('.choose_image').live('click',function() {
			if($ishero){
	        	// below is a modified class toggle taking into account the $limit to prevent too many images
	        	if($(this).hasClass('active_hero')){
	            	$(this).removeClass('active_hero');
	        	}else if($('.choose_image.active_hero').length < $hlimit){
	            	$(this).addClass('active_hero');
	        	}
	        	$string = '';//reset the string variable
	        	$('.choose_image.active_hero').each(function() {
	            	$string += $(this).attr('id') + ' ';// for every active image add it's id to the string
	            	$hero_input.val($.trim($string));// set the hidden input's value to the list of active string ids
	        	});
	        	if($string == ''){
	            	$hero_input.val($string);
	        	}
	        	$numImg = $('.choose_image.active_hero').length;
			}else{
				// below is a modified class toggle taking into account the $limit to prevent too many images
	        	if($(this).hasClass('active_image')){
	            	$(this).removeClass('active_image');
	        	}else if($('.choose_image.active_image').length < $ilimit){
	            	$(this).addClass('active_image');
	        	}
	        	$string = '';//reset the string variable
	        	$('.choose_image.active_image').each(function() {
	            	$string += $(this).attr('id') + ' ';// for every active image add its id to the string
	            	$images_input.val($.trim($string));// set the hidden input's value to the list of active string ids
	        	});
	        	if($string == ''){
	            	$images_input.val($string);
	        	}
	        	$numImg = $('.choose_image.active_image').length;
			}
	  });
		$('.choose_image').live("mouseover mouseout", function(event) {
		  if ( event.type == "mouseover" ) {
		    $(this).find('.img_details').show();
		  } else {
		    $(this).find('.img_details').hide();
		  }
		});
		
		$("#show-all").live("click",function(){
			$.get("../wp-content/plugins/img_finder/image_finder.php?offset="+$offset, function(data){
				$("#image_id_finder").prepend(data);//add images
				$offset += 20;
			});
		});
		$("#search-criteria").keydown(function(event){
		  if(event.keyCode == 13){
				$criteria = $("#search-criteria").val();
				$.get($path_to_root+"?s="+$criteria+"&img_search=1", function(data){
					$("#image_id_finder").prepend(data);//add images
				});
				return false;
	    }
		});
		$("#search").live("click",function(){
			$criteria = $("#search-criteria").val();
			if($criteria === "") {
				alert('Please enter a search term');
				return false;
			} else {
				$path_array = window.location.pathname.split('/');
				$place_of_wp_admin = $.inArray('wp-admin',$path_array);
				$path_to_search = "";
				for(i=1;i<$place_of_wp_admin;i++){
					$path_to_search += $path_array[i] + '/';
				}
				$url = '//'+window.location.host+'/'+$path_to_search;

				$.get($url+"?s="+$criteria+"&img_search=1", function(data){
					$("#image_id_finder").prepend(data);//add images
				});
				return false;
			}
		});
	}
});