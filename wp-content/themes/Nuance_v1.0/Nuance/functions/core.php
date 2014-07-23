<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Core
	
	Description: Functions that are not likely to be different on theme to theme basis.
	
	Table of contents:
		1) jw_pagination
		2) jw_remove_wpautop
		3) jw_resize
		4) jw_text_excerpt
		5) jw_get_attachment_id
		6) jw_get_post_id
		7) jw_breadcrumbs
		8) jw_remove_autop
	
------------------------------------------------------------------------------------------------------------ */

	/* -----------------------------------------------------------------
	
		Name: jw_pagination
1)		
		Numbered pagination originally made by Kriesi.
		http://www.kriesi.at/archives/how-to-build-a-wordpress-post-pagination-without-plugin
	
	----------------------------------------------------------------- */
	function jw_pagination($pages = '', $range = 2){  
		
		$showitems = ($range * 2)+1;  

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}   

		if(1 != $pages){
			echo '
			<div id="pagination">
				<ul class="col-clear">';
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
				if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

				for ($i=1; $i <= $pages; $i++){
					if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems)){
					echo ($paged == $i)? "<li class='current'><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
					}
				}

				if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";  
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
			echo '
				</ul>
			</div><!-- #pagination -->';
		}
	
	} /* jw_pagination() END */
	
	
	/* -----------------------------------------------------------------
	
		Name: jw_remove_wpautop
2)		
		Clearing the automatic paragraphs and breaks on shortcodes that
		WordPress is adding automatically when filtering content.
	
	----------------------------------------------------------------- */
	function jw_remove_wpautop($content) { 
	
		$content = do_shortcode(shortcode_unautop($content)); 
		$content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
		$content = str_replace('<br />', '', $content);
		$content = str_replace('<p><div', '<div', $content);
		return $content;
		
	}
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_resize
3)		
		Resizing images. Return array (url, width and height).
		Original code by Victor Teixeira.
	
	------------------------------------------------------------------ */
	function jw_resize($attach_id = null, $img_url = null, $width, $height, $crop = false) {

		// this is an attachment, so we have the ID
		if($attach_id) {
		
			$image_src = wp_get_attachment_image_src($attach_id, 'full');
			$file_path = get_attached_file($attach_id);
		
		// this is not an attachment, let's use the image url
		}else if($img_url){
			
			$file_path = parse_url($img_url);
			$file_path = $_SERVER['DOCUMENT_ROOT'] . $file_path['path'];
			
			$orig_size = getimagesize($file_path);
			
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		
		$file_info = pathinfo($file_path);
		$extension = '.'. $file_info['extension'];

		// the image path without the extension
		$no_ext_path = $file_info['dirname'].'/'.$file_info['filename'];

		$cropped_img_path = $no_ext_path.'-'.$width.'x'.$height.$extension;

		// checking if the file size is larger than the target size
		// if it is smaller or the same size, stop right here and return
		if ($image_src[1] > $width || $image_src[2] > $height) {

			// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
			if (file_exists($cropped_img_path)) {

				$cropped_img_url = str_replace(basename($image_src[0]), basename($cropped_img_path), $image_src[0]);
				
				$vt_image = array (
					'url' => $cropped_img_url,
					'width' => $width,
					'height' => $height
				);
				
				return $vt_image;
			}

			// $crop = false
			if ($crop == false) {
			
				// calculate the size proportionaly
				$proportional_size = wp_constrain_dimensions($image_src[1], $image_src[2], $width, $height);
				$resized_img_path = $no_ext_path.'-'.$proportional_size[0].'x'.$proportional_size[1].$extension;			

				// checking if the file already exists
				if (file_exists($resized_img_path)) {
				
					$resized_img_url = str_replace(basename($image_src[0]), basename($resized_img_path), $image_src[0]);

					$vt_image = array (
						'url' => $resized_img_url,
						'width' => $proportional_size[0],
						'height' => $proportional_size[1]
					);
					
					return $vt_image;
				}
			}

			// no cache files - let's finally resize it
			$new_img_path = image_resize($file_path, $width, $height, $crop);
			$new_img_size = getimagesize($new_img_path);
			$new_img = str_replace(basename($image_src[0]), basename($new_img_path), $image_src[0]);

			// resized output
			$vt_image = array (
				'url' => $new_img,
				'width' => $new_img_size[0],
				'height' => $new_img_size[1]
			);
			
			return $vt_image;
		}

		// default output - without resizing
		$vt_image = array (
			'url' => $image_src[0],
			'width' => $image_src[1],
			'height' => $image_src[2]
		);
		
		return $vt_image;
		
	} /* jw_resize() */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_text_excerpt
4)		
		Including JavaScript files in the WordPress admin
	
	------------------------------------------------------------------ */
	function jw_text_excerpt($content, $limit = 30){

		$sub = '';
		$len = 0;
	
		foreach (explode(' ', $content) as $word){
			$part = (($sub != '') ? ' ' : '') . $word;
			$sub .= $part;
			$len += strlen($part);

			if (strlen($sub) >= $limit){
				break;
			}
		}

		return $sub . (($len < strlen($content)) ? '...' : '');
		
	} /* jw_text_exceprt() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_get_attachment_id
5)		
		Get attachement id by url, title, filename
	
	------------------------------------------------------------------ */
	function jw_get_attachment_id($by, $needle){
		
		global $wpdb;
		
		if($by == 'url'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE guid = '".$needle."'"); }
		
		if($by == 'title'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$needle."'"); }
		
		if($by == 'url'){ return $wpdb->get_var("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE '%".$needle."'"); }
		
	} /* jw_get_attachment_id() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_get_post_id
6)		
		Get post/page id by name, title, template
	
	------------------------------------------------------------------ */
	function jw_get_post_id($by, $needle){
		
		global $wpdb;
		
		if($by == 'name'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$needle."'"); }
		
		if($by == 'title'){ return $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$needle."'"); }
		
		if($by == 'template'){ $pages = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value='".$needle."'", ARRAY_A); return $pages['post_id']; }
		
	} /* jw_get_post_id() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_breadcrumbs
7)		
		Show breadcrumbs
	
	------------------------------------------------------------------ */
	function jw_breadcrumbs(){
		
		wp_reset_query();
		
		global $post;
		
		global $domain;
		
		$delimiter = '/';
		
		?>
		
			<div id="breadcrumb">
				<ul class="col-clear">
					<li><?php _e('You are here:', $domain); ?> </li>
					<li><a href="<?php echo home_url(); ?>"><?php _e('Home', $domain); ?></a></li>
				
		<?php

			if (is_category() || is_single() || is_author()) {
				
				if(get_post_type() == 'post'){
				
					$blog_page_id = jw_get_post_id('template', 'template-blog.php');
					$blog_link = get_permalink($blog_page_id);
					$blog_title = get_the_title($blog_page_id);
					echo '<li class="sep">/</li><li><a href="'.$blog_link.'">'.$blog_title.'</a></li>';
					
				}
				
				if(is_category()){
					if(get_post_type() == 'post'){
						$ID = get_query_var('cat');
						echo '<li class="sep">'.$delimiter.'</li><li>'.get_category_parents($ID, TRUE, '</li><li class="sep">'.$delimiter.'</li><li>').'</li>';
					}
				}else if(is_author()){
					echo '<li class="sep">'.$delimiter.'</li><li>'.get_the_author().'</li>';
				}
				
			}
			
			if(is_page() && $post->post_parent){ 
				$anc = get_post_ancestors( $post->ID );
				$anc = array_reverse($anc);
				foreach ( $anc as $ancestor ) {
						echo '<li class="sep">'.$delimiter.'</li><li><a href="'.get_permalink($ancestor).'"><span>'.get_the_title($ancestor).'</span></a></li>'; 
				}
			}
			
			if(is_single()){
				$ID = get_query_var('cat');
				//echo '<li class="sep">'.$delimiter.'</li><li>'.get_category_parents($ID, TRUE, '</li><li class="sep">'.$delimiter.'</li><li>').'</li>';
				echo '<li><span>'.get_the_title().'</span></li>';
			}
			
			if((is_page()) && (!is_front_page() && !is_home())) { echo '<li class="sep">'.$delimiter.'</li><li><span>'.get_the_title().'</span></li>'; }
			if(is_tag()){ echo '<li class="sep">'.$delimiter.'</li><li><span>Tag: '.single_tag_title('',FALSE).'</span></li>'; }
			if(is_404()){ echo '<li class="sep">'.$delimiter.'</li><li><span>404 - Page not Found</span></li>'; }
			if(is_search()){ echo '<li class="sep">'.$delimiter.'</li><li><span>Search</span></li>'; }
			if(is_year()){ echo '<li class="sep">'.$delimiter.'</li><li><span>'.get_the_time('Y').'</span></li>'; }
		
		?>
			
			</ul>
		</div><!-- end #breadcrumb -->
		
		<?php
		
	}/* jw_breadcrumbs() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_remove_autop
8)		
		Used in shortcodes to remove the default paragraphs WordPress adds
	
	------------------------------------------------------------------ */
	function jw_remove_autop($content) { 
		$content = do_shortcode( shortcode_unautop($content) ); 
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		return $content;
	}
	
?>