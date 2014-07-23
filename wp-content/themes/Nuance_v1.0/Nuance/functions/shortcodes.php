<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Shortcodes

------------------------------------------------------------------------------------------------------------ */
	
	/* Columns */
	add_shortcode('one_fourth', 'jw_one_fourth');
	add_shortcode('one_fourth_last', 'jw_one_fourth_last');
	add_shortcode('one_third', 'jw_one_third');
	add_shortcode('one_third_last', 'jw_one_third_last');
	add_shortcode('two_third', 'jw_two_third');
	add_shortcode('two_third_last', 'jw_two_third_last');
	add_shortcode('one_half', 'jw_one_half');
	add_shortcode('one_half_last', 'jw_one_half_last');
	add_shortcode('three_fourth', 'jw_three_fourth');
	add_shortcode('three_fourth_last', 'jw_three_fourth_last');
	
	/* Notifications */
	add_shortcode('error', 'jw_error_box');
	add_shortcode('notification', 'jw_notification_box');
	add_shortcode('information', 'jw_information_box');
	add_shortcode('download', 'jw_download_box');
	
	/* Quoteboxes */
	add_shortcode('quote', 'jw_quote');
	
	/* Buttons */
	add_shortcode('button', 'jw_button');
	
	/* Other */
	add_shortcode('slider_posts', 'jw_slider_posts');
	add_shortcode('recent_tweets', 'jw_recent_tweets');
	add_shortcode('recent_posts', 'jw_recent_posts');
	add_shortcode('separator', 'jw_separator');
	add_shortcode('highlight', 'jw_highlight');
	add_shortcode('toggle', 'jw_toggle');
	add_shortcode('toggles', 'jw_toggles');
	add_shortcode('galleria', 'jw_galleria');
	add_shortcode('galleria_slide', 'jw_galleria_slide');
	add_shortcode('contact_form', 'jw_contact_form');
	add_shortcode('stars_list', 'jw_stars_list');
	add_shortcode('stars_list_item', 'jw_stars_list_item');
	add_shortcode('styled_list', 'jw_styled_list');
	add_shortcode('box', 'jw_box');
	add_shortcode('tab', 'jw_tab');
	add_shortcode('tabs', 'jw_tabs');
	
	/* Images */
	add_shortcode('slide', 'jw_slide');
	add_shortcode('slide_piecemaker', 'jw_slide_piecemaker');
	add_shortcode('slide_admin', 'jw_slide_admin');
	add_shortcode('portfolio_image', 'jw_portfolio_image');
	add_shortcode('portfolio_image_admin', 'jw_portfolio_image_admin');
	add_shortcode('img', 'jw_image');
	
	/* Blank (from the composer) */
	add_shortcode('blank', 'jw_blank');
	
	add_shortcode('ltweet', 'jw_ltweet');
	add_shortcode('service', 'jw_service');
	
	/* Posts */
	add_shortcode('portfolio_posts', 'jw_portfolio_posts');
	add_shortcode('blog_posts', 'jw_blog_posts');
	add_shortcode('related_posts', 'jw_related_posts');
	add_shortcode('testimonials', 'jw_testimonials');
	
	
	/* -----------------------------------------------------------------
	
		Columns shortcodes
	
	----------------------------------------------------------------- */
	
	function jw_one_fourth($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 202;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-fourth">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_one_fourth_last($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 202;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-fourth last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_one_third($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 280;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-third">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_one_third_last($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 280;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-third last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_two_third($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 590;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="two-third">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_two_third_last($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 590;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="two-third last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function jw_one_half($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 435;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-half">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_one_half_last($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 435;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="one-half last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	function jw_three_fourth($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 590;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="three-fourth">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}

	function jw_three_fourth_last($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$width = 590;
		$content = preg_replace('/\[galleria/', '[galleria width="'.$width.'"', $content);
		
		$output = '<div class="three-fourth last">' . $content . '</div>';
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
	
		Posts Slider
	
	----------------------------------------------------------------- */
	function jw_slider_posts($atts, $content = null) {
		
		/* The attributes */
		extract(shortcode_atts(array(
			'post_type' => 'post',
			'amount' => 5,
			'tag' => '',
			'thumbnail' => 'yes',
			'title' => 'yes',
			'excerpt' => 'yes',
		), $atts));
		
		if($post_type == 'portfolio'){ $post_type = 'jw_portfolio'; }
		if($post_type == 'blog'){ $post_type = 'post'; };
		
		if($post_type == 'jw_portfolio' && !empty($tag)){
			$portfolio_tags = explode(',', $tag);
		}
		
		/* Get the posts */
		if($post_type == 'post' || empty($tag)){
			$args=array(
			   'post_type' => $post_type,
			   'showposts' => $amount,
			   'tag' => $tag,
			);
		}elseif($post_type == 'jw_portfolio'){
			$args=array(
			   'post_type' => $post_type,
			   'showposts' => $amount,
			   'tax_query' => array(
					array(
						'taxonomy' => 'jw_portfolio_categories',
						'field' => 'slug',
						'terms' => $portfolio_tags
					)
				),
			);
		}
		$jw_query = new WP_Query($args);

		/* The output */
		$output = '<div class="container portfolio-listing">
				<ul class="slides">';
					if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post();
						
						if($thumbnail == 'yes' && has_post_thumbnail()){
							$post_thumb = '<a href="'.get_permalink().'">'.get_the_post_thumbnail(get_the_ID(), 'jw_portfolio_listing', array('class' => 'wrapped')).'</a>';
						}else{
							$post_thumb = '';
						}
						
						if($title == 'yes'){
							$post_title = '<span class="portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
						}else{
							$post_title = '';
						}
						
						if($excerpt == 'yes'){
							$post_excerpt = '<p>'.get_the_excerpt().'</p>';
						}else{
							$post_excerpt = '';
						}
						
						$output .= '
						<li>
							'.$post_thumb.'
							'.$post_title.'
							'.$post_excerpt.'
						</li>';
					endwhile; endif;
				$output .= '
				</ul>
			</div>';
		
		/* Reset Query */
		wp_reset_query();
		
		return do_shortcode($output);
	
	} /* jw_slider_posts() END */
	
	
	/* -----------------------------------------------------------------
	
		Recent Posts
	
	----------------------------------------------------------------- */
	function jw_recent_posts($atts, $content = null) {
	
		/* The attributes */
		extract(shortcode_atts(array(
			'post_type' => 'blog',
			'amount' => 5
		), $atts));
		
		include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';

		if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; }
			
		if($post_type == 'portfolio'){ $post_type = 'jw_portfolio'; }	
		if($post_type == 'blog'){ $post_type = 'post'; }	
		
		/* Get the posts */
		$args=array(
		   'post_type' => $post_type,
		   'posts_per_page' => $amount
		);
		$jw_query = new WP_Query($args);

		/* The Output */
		$output = '
			<ul class="posts-listing">';
				
				if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post();
					
					if(has_post_thumbnail()){ $output_img = '<span class="posts-listing-thumb '.$image_animate_class.'">'.get_the_post_thumbnail(get_the_ID(), 'jw_63', array('class' => 'wrapped-small')).'</span>'; }else{ $output_img = ''; }
					
					$output .= '
					<li class="col-clear">
						<a href="'.get_permalink().'">
							'.$output_img.'
							<div>
								'.get_the_title().'
								<small>'.get_the_time('F j, Y').'</small>
							</div>
						</a>
					</li>';
					
				endwhile;
				
				else :
				// do stuff for no results
				endif;
			
			$output .= '
			</ul>';
		
		/* Reset Query */
		wp_reset_query();
			
		return do_shortcode($output);
		
	} /* jw_recent_posts() END */
	
	
	/* -----------------------------------------------------------------
	
		Recent Tweets
	
	----------------------------------------------------------------- */
	function jw_recent_tweets($atts, $content = null) {
		
		global $domain;
		
		/* The attributes */
		extract(shortcode_atts(array(
			'profile' => 'jvanoel',
			'amount' => 5
		), $atts));
		
		$output = '<div class="message">';
		
			include_once (TEMPLATEPATH . "/functions/twitter.php");
			$obj_twitter = new Twitter($profile); 
			$tweets = $obj_twitter->get($amount);

			foreach($tweets as $tweet){
				
				if(get_class($tweet[2]) == 'SimpleXMLElement'){									
					$tweet_link = $tweet[2][0];
				}else{
					$tweet_link_arr = get_object_vars($tweet[2]);
					$tweet_link = $tweet_link_arr[0];
				}
				
				if(isset($tweet[0])){
					$output .= '<p>'.$tweet[0].' - <a href="'.$tweet_link.'">'.$tweet[1].'</a><p>';
				}
				
			}
		
		$output .= '</div>';
		
		return do_shortcode($output);
		
	} /* jw_recent_posts() END */
	
	
	/* -----------------------------------------------------------------
	
		Separator
	
	----------------------------------------------------------------- */
	function jw_separator($atts, $content = null) {
	
		extract(shortcode_atts(array(
			'line' => 'no',
		), $atts));
		
		if($line == 'no'){ $line_output = ' noline'; }else{ $line_output = ''; }
		
		$output = '<div class="separator'.$line_output.'"></div>';
		
		return do_shortcode($output);
		
	}/* jw_separator() END */
	
	
	/* -----------------------------------------------------------------
	
		Notifications
	
	----------------------------------------------------------------- */
	function jw_download_box($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="success">'.$content.'</div><!-- .box.success -->';
		
		return do_shortcode($output);
		
	}
	
	function jw_information_box($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="information">'.$content.'</div><!-- .box.info -->';
		
		return do_shortcode($output);
		
	}
	
	function jw_notification_box($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="notification">'.$content.'</div><!-- .box.notification -->';
		
		return do_shortcode($output);
		
	}
	
	function jw_error_box($atts, $content = null) {
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="error">'.$content.'</div><!-- .box.alert -->';
		
		return do_shortcode($output);

	}
	
	function jw_box($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title' => '',
			'color' => 'yellow'
		), $atts));
		
		$content = jw_remove_autop($content);
		
		if($title != ''){
		
		$output = '<div class="box with-title">
			<div class="box-title '.$color.'">
				'.$title.'
			</div>
			<div class="box-content">
				'.$content.'
			</div>
		</div>';
		
		}else{
		
			$output = '<div class="box">
				<div class="box-content">
					'.$content.'
				</div>
			</div>';
		
		}
		
		return do_shortcode($output);

	}
	
	function jw_tab($atts, $content = null){
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="tab-content">'.$content.'</div>';
		
		return $output;
		
	}
	
	function jw_tabs($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title_1' => '',
			'title_2' => '',
			'title_3' => '',
			'title_4' => '',
			'title_5' => '',
			'title_6' => '',
			'title_7' => '',
			'title_8' => '',
			'title_9' => '',
			'title_10' => '',
			'title_11' => '',
			'title_12' => '',
			'title_13' => '',
			'title_14' => '',
			'title_15' => '',
			'color' => 'yellow'
		), $atts));
		
		$content = jw_remove_autop($content);
		
		$output = '<div class="tabs-container '.$color.'">
			<ul class="tabs-nav col-clear">';
				
				for ( $i = 1; $i <= 15; $i++) {
					
					$title_var = 'title_'.$i;
					$real_title = $$title_var;
					
					if($real_title != ''){
						$output .= '<li><a href="#">'.$real_title.'</a></li>';
					}
					
				}
			
			$output .= '</ul>
			<div class="tabs-nav-bellow"></div>
			<div class="tabs-content">
				'.$content.'
			</div>
		</div>';
		
		return do_shortcode($output);

	}
	
	
	/* -----------------------------------------------------------------
	
		Quoteboxes
	
	----------------------------------------------------------------- */
	function jw_quote($atts, $content = null) {
	
		extract(shortcode_atts(array(
			'align' => 'left'
		), $atts));
		
		$content = jw_remove_autop($content);
		
		$output = '<span class="quotebox-'.$align.'">' . $content . '</span>';
		
		return do_shortcode($output);
		
	}/* jw_quote() END */
	
	
	/* -----------------------------------------------------------------
	
		Slider
	
	----------------------------------------------------------------- */
	function jw_slide($atts, $img = null){
		
		global $domain;
		
		extract(shortcode_atts(array(
			'link' => '',
			'title' => '',
			'description' => '',
			'height' => 250,
			'show' => 'no',
			'type' => 'regular',
			'in_layout' => 'layout_c',
			'link_type' => 'small_graphic'
		), $atts));
		
		$width = 920;
		
		$img_id = jw_get_attachment_id('url', $img);
		$resized = jw_resize( $img_id, '', $width, $height, true );
		$img = $resized['url'];
		
		if($show == 'no'){ $display = 'display-none'; }else{ $display = ''; }
		
		$output = '<div class="slide '.$display.'">';
						
						if(!empty($link)){
							$output .= '<a href="'.$link.'"><img src="'.$img.'" /></a>';
						}else{
							$output .= '<img src="'.$img.'" />';
						}
						
						if(!empty($description) || !empty($title)){ $output .= '<div class="slide-caption"><span class="slide-caption-title">'.$title.'</span><span class="slide-caption-description">'.$description.'</span></div>'; }
						
		$output .= '</div>';
		
		return do_shortcode($output);
	}
	
	
	/* -----------------------------------------------------------------
	
		Slider Piecemaker
	
	----------------------------------------------------------------- */
	function jw_slide_piecemaker($atts, $img = null){
		
		global $domain;
		
		extract(shortcode_atts(array(
			'link' => '',
			'title' => '',
			'description' => '',
			'height' => 250,
			'show' => 'no',
			'width' => 960
		), $atts));
		
		
		
		$img_id = jw_get_attachment_id('url', $img);
		$resized = jw_resize( $img_id, '', $width, $height, true );
		$img = $resized['url'];
		
		if($show == 'no'){ $show = 'display:none;'; }else{ $show = ''; }
		
		$output  = '<Image Source="'.$img.'" Title="'.$title.'">';
		
			if(!empty($description) && !empty($description)){ $output .= '<Text>&lt;h1&gt;'.$title.'&lt;/h1&gt;&lt;p&gt;'.$description.'</Text>'; }
			if(!empty($link)){ $output .= '<Hyperlink URL="'.$link.'" Target="_blank" />'; }
		
		$output .= '</Image>';			
		
		return do_shortcode($output);
	}
	
	
	/* -----------------------------------------------------------------
	
		Slider ADMIN
	
	----------------------------------------------------------------- */
	function jw_slide_admin($atts, $img = null){
		
		extract(shortcode_atts(array(
			'link' => '',
			'title' => '',
			'description' => ''
		), $atts));
		
		$img_id = jw_get_attachment_id('url', $img);
		
		$thumb_src = wp_get_attachment_image_src($img_id, 'jw_100');
		$thumb_src = $thumb_src[0];
		
		$output = '
		<li>
			<img src="'.$thumb_src.'" alt="'.$img.'" />
			<a class="metabox-slider-show-edit"></a><a class="metabox-slider-remove-slide"></a>
			<input type="hidden" class="slider-title" value="'.esc_attr($title).'" />
			<input type="hidden" class="slider-link" value="'.$link.'" />
			<input type="hidden" class="slider-description" value="'.esc_attr($description).'" />
		</li>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Portfolio images
	
	----------------------------------------------------------------- */
	function jw_portfolio_image($atts, $img = null){
		
		extract(shortcode_atts(array(
			'show' => 'yes',
			'post_id' => 0
		), $atts));
		
		if($show == 'yes'){
			$output = '<a class="display-none" rel="prettyPhoto[pp_gal_'.$post_id.']" href="'.$img.'"></a>';
		}else{
			$output = '';
		}
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
	
		Portfolio images ADMIN
	
	----------------------------------------------------------------- */
	function jw_portfolio_image_admin($atts, $img = null){
		
		$img_id = jw_get_attachment_id('url', $img);
		
		$thumb_src = wp_get_attachment_image_src($img_id, 'jw_100');
		$thumb_src = $thumb_src[0];
		
		$output = '
		<li>
			<img src="'.$thumb_src.'" alt="'.$img.'" />
			<a class="metabox-slider-remove-slide"></a>
		</li>';
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
	
		Blank
	
	----------------------------------------------------------------- */
	function jw_blank($atts, $content){
		
		extract(shortcode_atts(array(
			'width' => 'one-third',
			'last' => 'false',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content = jw_remove_autop($content);
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		if($last == 'true'){ $last = '_last'; }else{ $last = ''; }
		
		$content = $content_before.$content.$content_after;
		
		switch ($width) {
			
			case 'full-width':
				$output = '<div>'.$content.'</div>';
				break;
			case 'two-third':
				$output = '[two_third'.$last.']'.$content.'[/two_third'.$last.']';
				break;
			case 'one-half':
				$output = '[one_half'.$last.']'.$content.'[/one_half'.$last.']';
				break;
			case 'one-third':
				$output = '[one_third'.$last.']'.$content.'[/one_third'.$last.']';
				break;
			case 'one-fourth':
				$output = '[one_fourth'.$last.']'.$content.'[/one_fourth'.$last.']';
				break;
			case 'three-fourth':
				$output = '[three_fourth'.$last.']'.$content.'[/three_fourth'.$last.']';
				break;

		}
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Latest Tweet
	
	----------------------------------------------------------------- */
	function jw_ltweet($atts, $content = null){
		
		global $domain;
		
		extract(shortcode_atts(array(
			'width' => 'one-third',
			'last' => 'false',
			'profile' => 'jvanoel',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		if($last == 'true'){ $last = ' last'; }else{ $last = ''; }
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }

		include_once (TEMPLATEPATH . "/functions/twitter.php");
		$obj_twitter = new Twitter($profile); 
		$tweets = $obj_twitter->get(1);
		
		if(!empty($tweets)){
			
			$output = '
				<div class="twitterfeed big">
					<div class="message">
						<div class="twitterStatus">';
							
							foreach($tweets as $tweet){
								
								if(get_class($tweet[2]) == 'SimpleXMLElement'){									
									$tweet_link = $tweet[2][0];
								}else{
									$tweet_link_arr = get_object_vars($tweet[2]);
									$tweet_link = $tweet_link_arr[0];
								}
								
								if(isset($tweet[0])){
									$output .= $tweet[0].' - <a href="'.$tweet_link.'">'.$tweet[1].'</a> - by <a href="http://twitter.com/'.$profile.'">@'.$profile.'</a>';
								}
								
							}
			
						$output .= '
						</div>
					</div>
				   <!-- Twitter --> 
				</div>';
			
		}
		
		
		$output = $content_before.'<div class="'.$width.$last.'">'.$output.'</div>'.$content_after;
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Services
	
	----------------------------------------------------------------- */
	function jw_service($atts, $content){
		
		extract(shortcode_atts(array(
			'width' => 'one-third',
			'last' => 'false',
			'icon' => 'books-01',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		$class = '';
		if($last == 'true'){ $last = ' last'; }else{ $last = ''; }
		$class .= ' '.$icon;
		
		switch ($width) {
			
			case 'full-width':
				$output = $content_before.'<div class="service">'.$content.'</div>'.$content_after;
				break;
			case 'two-third':
				$output = '<div class="two-third'.$last.'">'.$content_before.'<div class="service'.$class.'">'.$content.'</div>'.$content_after.'</div>';
				break;
			case 'one-half':
				$output = '<div class="one-half'.$last.'">'.$content_before.'<div class="service'.$class.'">'.$content.'</div>'.$content_after.'</div>';
				break;
			case 'one-third':
				$output = '<div class="one-third'.$last.'">'.$content_before.'<div class="service'.$class.'">'.$content.'</div>'.$content_after.'</div>';
				break;
			case 'one-fourth':
				$output = '<div class="one-fourth'.$last.'">'.$content_before.'<div class="service'.$class.'">'.$content.'</div>'.$content_after.'</div>';
				break;
			case 'three-fourth':
				$output = '<div class="three-fourth'.$last.'">'.$content_before.'<div class="service'.$class.'">'.$content.'</div>'.$content_after.'</div>';
				break;

		}
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Button
	
	----------------------------------------------------------------- */
	function jw_button($atts, $content){
		
		extract(shortcode_atts(array(
			'color' => 'black',
			'tooltip' => '',
			'link' => '#'
		), $atts));
		
		$ttip_class = '';
		
		if($tooltip != ''){ $ttip_class = ' ttip'; $tooltip = 'title="'.$tooltip.'"'; }
		
		$output = '<a class="button '.$color.$ttip_class.'" '.$tooltip.' href="'.$link.'">'.$content.'</a>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Highlight
	
	----------------------------------------------------------------- */
	function jw_highlight($atts, $content){
		
		$output = '<span class="highlight">'.$content.'</span>';
		
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Toggle
	
	----------------------------------------------------------------- */
	function jw_toggle($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'title' => 'Unnamed',
			'color' => 'yellow'
		), $atts));
		
		$output = '<div class="toggle-container">
			<div class="toggle-title '.$color.'">'.$title.'<a href="#" class="toggle-action"></a></div>
			<div class="toggle-content">'.jw_remove_wpautop($content).'</div>
		</div>';
			
		return do_shortcode($output);
		
	}
	
	
	/* -----------------------------------------------------------------
	
		Toggles container
	
	----------------------------------------------------------------- */
	function jw_toggles($atts, $content = null) {
		
		return jw_remove_wpautop($content);
		
	}
	
	/* -----------------------------------------------------------------
	
		Portfolio posts
	
	----------------------------------------------------------------- */
	function jw_portfolio_posts($atts, $content = null) {
		
		global $domain; /* The unique string used for translation */
		
		include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';
		
		if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; }
		
		extract(shortcode_atts(array(
			'amount' => 5,
			'item_width_value' => 'one_third',
			'show_thumbnail' => 'yes',
			'show_title' => 'no',
			'show_excerpt' => 'no',
			'show_meta' => 'no',
			'width' => 'two-third',
			'type' => 'grid_1',
			'category' => 'all',
			'last' => 'false',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		$parent_size = $width;
		
		if($last == 'true') { $last_class = ' last'; }else{ $last_class = ''; }
		
		if($parent_size == 'full-width'){
			$count_last = 3;
		}else if($parent_size == 'two-third'){
			$count_last = 2;
		}else if($parent_size == 'one-third'){
			$count_last = 1;
		}else if($parent_size == 'one-half'){
			$count_last = 1;
		}else if($parent_size == 'one-fourth'){
			$count_last = 1;
		}else if($parent_size == 'three-fourth'){
			$count_last = 2;
		}
		
		if($category == 'all'){
		
			$args = array(
				'post_type'			=> 'jw_portfolio',
				'posts_per_page'	=> $amount,
			);
		
		}else{
			
			$args = array(
				'post_type'			=> 'jw_portfolio',
				'posts_per_page'	=> $amount,
				'tax_query' => array(
					array(
						'taxonomy' => 'jw_portfolio_categories',
						'field' => 'id',
						'terms' => $category
					)
				)
			);
			
		}
		
		$jw_query = new WP_Query($args); 
		
		$count = 0;
		
		if($type == 'grid_1'){
		
			if($item_width_value == 'one_fourth'){
				$item_class = 'one-fourth';
				if($parent_size == 'full-width'){
					$count_last = 4;
				}else if($parent_size == 'two-third'){
					$count_last = 2;
				}else if($parent_size == 'one-third'){
					$count_last = 1;
				}else if($parent_size == 'one-half'){
					$count_last = 2;
				}else if($parent_size == 'one-fourth'){
					$count_last = 1;
				}else if($parent_size == 'three-fourth'){
					$count_last = 3;
				}
				$item_thumbnail_id = 'jw_portfolio_listing_fourth';
			}else{
				$item_class = 'one-third';
				$item_thumbnail_id = 'jw_portfolio_listing';
			}
			
			$real_count = 0;
			
			$output = '
			<div class="'.$width.$last_class.'">
				'.$content_before.'
				<ul class="portfolio-listing">';
				
					if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; $real_count++; /* Loop the posts */
						
						$c_post_custom = get_post_custom(get_the_ID());					
						
							$li_class = '';
							$li_clear = false;
							
							/* Add the last class to every 3rd */
							if($count == $count_last){ $li_class .= 'last '; $count = 0; $li_clear = true;  }
					
						if($real_count <= $count_last){ $margin_class = ' no-margin-top'; }else{ $margin_class = ''; }
					
						$output .= '<li class="'.$item_class.' '.$li_class.' '.$margin_class.'">';
							
							if(has_post_thumbnail(get_the_ID()) && $show_thumbnail == 'yes'){
								
								if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p2 == 'on'){
									
									if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; $lightbox_class = 'lightbox-video'; }
									if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; $lightbox_class = 'lightbox-image'; }
									
									$output .= '<a href="'.$real_link.'" class="'.$image_animate_class.' '.$lightbox_class.'" rel="prettyPhoto[pp_gal_'.get_the_ID().']">'.get_the_post_thumbnail(get_the_ID(), $item_thumbnail_id, array('class' => 'wrapped')).'</a>';
									
									if(isset($c_post_custom['jw_portfolio_images'][0])){
										$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
										$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.get_the_ID().'"', $jw_portfolio_images);
										$output .= do_shortcode($jw_portfolio_images);
									}
									
								}else{
									$output .= '<a href="'.get_permalink().'" class="'.$image_animate_class.' lightbox-none">'.get_the_post_thumbnail(get_the_id(), $item_thumbnail_id, array('class' => 'wrapped')).'</a>';
								}
							
							}/* Post thumbnail */
							
							if($show_title == 'yes'){
								$output .= '<span class="portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
							}
							if($show_excerpt == 'yes'){
								$output .= jw_text_excerpt(get_the_excerpt(), 90);
							}
							
						$output .= '</li>';
					
						if($li_clear == true){ $output .= '<div class="clear"></div>'; }
					
					endwhile; else: /* If no posts found */
						
						$output .= '<p>'.__('The portfolio is empty', $domain).'</p>';
					
					endif; /* End if have posts */
				
				$output .= '
				</ul>
				'.$content_after.'
			</div><!-- .portfolio.grid-2 -->';
		
		}elseif($type == 'grid_2'){
			
			$output = 
			$content_before.'<div class="portfolio-popup">
				<ul class="portfolio-ul col-clear">';
				
					if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; /* Loop the posts */
					
						$c_post_custom = get_post_custom(get_the_ID());
					
						include TEMPLATEPATH.'/functions/fancybox-type.php';
					
						$output .= '<li class="'.$image_animate_class.'">';
							
							$c_post_custom = get_post_custom(get_the_ID()); 
							
							if(has_post_thumbnail(get_the_ID())){
								$output .= get_the_post_thumbnail(get_the_ID(), 'jw_portfolio_grid', array('class' => 'grid-img'));
							}
							
							$output .= '<div class="portfolio-popup-info">';
							
								/* Title */
								$output .= '<span class="portfolio-popup-info-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
								
								/* Description */
								$output .= '<span class="portfolio-popup-info-description">'.jw_text_excerpt(get_the_excerpt(), 120).'</span>';
								
								/* Client */
								if(isset($c_post_custom['jw_portfolio_client'][0])){
									$output .= '<span><strong>'.__('Client').'</strong> &#92;&#92; '.$c_post_custom['jw_portfolio_client'][0].'</span>';
								}
								
								/* Categories */
								$portfolio_cats = get_the_terms(get_the_ID(), 'jw_portfolio_categories');
								if(!empty($portfolio_cats)){
									
									$output .= '<span><strong>'.__('What we did').'</strong> &#92;&#92; ';
										
										foreach($portfolio_cats as $portfolio_cat){
											$output .= $portfolio_cat->name.', ';
										}
									
									$output .= '</span>';
								
								}
								
								/* Author */
								if(isset($c_post_custom['jw_portfolio_author'][0])){
									$output .= '<span><strong>'.__('Author').'</strong> &#92;&#92; '.$c_post_custom['jw_portfolio_author'][0].'</span>';
								}
								
								/* Date */
								$output .= '<span><strong>'.__('Date').'</strong> &#92;&#92; '.get_the_time('F j Y').'</span>';
								
								/* Actions */
								$output .= '<span class="portfolio-popup-info-actions">';
									
									if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p1 == 'on'){
										if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; }
										if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; }
										$output .= '<a href="'.$real_link.'" class="portfolio-popup-info-zoom" rel="prettyPhoto[pp_gal_'.get_the_ID().']">zoom</a>';
										if(isset($c_post_custom['jw_portfolio_images'][0])){
											$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
											$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.get_the_ID().'"', $jw_portfolio_images);
											$output .= do_shortcode($jw_portfolio_images);
										}
									}
									
									$output .= '<a href="'.get_permalink().'" class="portfolio-popup-info-more">more</a>';
								
								$output .= '</span>';
								
							$output .= '</div><!-- .portfolio-popup-info -->';
							
						$output .= '</li>';
					
					endwhile; else: /* If no posts found */
						
						$output .= '<p>'.__('The portfolio is empty', $domain).'</p>';
					
					endif; /* End if have posts */
				
				$output .= '
				</ul>
				
			</div><!-- .portfolio-popup -->'.$content_after;
			
		}
		
		return do_shortcode($output);
		
	}
	
	/* -----------------------------------------------------------------
	
		Portfolio posts
	
	----------------------------------------------------------------- */
	function jw_blog_posts($atts, $content = null) {
		
		global $domain; /* The unique string used for translation */
		
		include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';
		
		if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; }
		
		extract(shortcode_atts(array(
			'type' => 'list',
			'amount' => 5,
			'item_width_value' => 'one_third',
			'show_thumbnail' => 'yes',
			'show_title' => 'no',
			'show_excerpt' => 'no',
			'show_meta' => 'no',
			'width' => 'two-third',
			'last' => 'false',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		$parent_size = $width;
		
		if($last == 'true') { $last_class = ' last'; }else{ $last_class = ''; }
		
		if($parent_size == 'full-width'){
			$count_last = 3;
		}else if($parent_size == 'two-third'){
			$count_last = 2;
		}else if($parent_size == 'one-third'){
			$count_last = 1;
		}else if($parent_size == 'one-half'){
			$count_last = 1;
		}else if($parent_size == 'one-fourth'){
			$count_last = 1;
		}else if($parent_size == 'three-fourth'){
			$count_last = 2;
		}
		
		if($type == 'grid'){
		
			$args = array(
				'post_type'			=> 'post',
				'posts_per_page'	=> $amount,
			);
			$jw_query = new WP_Query($args); 
			
			$count = 0;
			
			if($item_width_value == 'one_fourth'){
				$item_class = 'one-fourth';
				if($parent_size == 'full-width'){
					$count_last = 4;
				}else if($parent_size == 'two-third'){
					$count_last = 2;
				}else if($parent_size == 'one-third'){
					$count_last = 1;
				}else if($parent_size == 'one-half'){
					$count_last = 2;
				}else if($parent_size == 'one-fourth'){
					$count_last = 1;
				}else if($parent_size == 'three-fourth'){
					$count_last = 3;
				}
				$item_thumbnail_id = 'jw_portfolio_listing_fourth';
			}else{
				$item_class = 'one-third';
				$item_thumbnail_id = 'jw_portfolio_listing';
			}
			
			$real_count = 0;
		
			$output = '
			<div class="'.$width.$last_class.'">
				'.$content_before.'
				<ul class="portfolio-listing">';
				
					if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; $real_count++; /* Loop the posts */
						
						$c_post_custom = get_post_custom(get_the_ID());					
					
						$li_class = '';
						$li_clear = false;
						
						/* Add the last class to every 3rd */
						if($count == $count_last){ $li_class .= 'last '; $count = 0; $li_clear = true;  }
					
						if($real_count <= $count_last){ $margin_class = ' no-margin-top'; }else{ $margin_class = ''; }
					
						$output .= '<li class="'.$item_class.' '.$li_class.$margin_class.'">';
						
							if(has_post_thumbnail(get_the_ID()) && $show_thumbnail == 'yes'){
								
								$output .= '<a href="'.get_permalink().'" class="'.$image_animate_class.'">'.get_the_post_thumbnail(get_the_id(), $item_thumbnail_id, array('class' => 'wrapped')).'</a>';
							
							}/* Post thumbnail */
							
							if($show_title == 'yes'){
								$output .= '<span class="portfolio-title"><a href="'.get_permalink().'">'.get_the_title().'</a></span>';
							}
							if($show_excerpt == 'yes'){
								$output .= jw_text_excerpt(get_the_excerpt(), 90);
							}
							
						$output .= '</li>';
					
						if($li_clear == true){ $output .= '<div class="clear"></div>'; }
					
					endwhile; else: /* If no posts found */
						
						$output .= '<p>'.__('The blog is empty', $domain).'</p>';
					
					endif; /* End if have posts */
				
				$output .= '
				</ul>
				'.$content_after.'
			</div><!-- .portfolio.grid-2 -->';
		
		}else{
			
			$output = '<div class="'.$width.$last_class.'">'.$content_before.do_shortcode('[recent_posts amount="'.$amount.'" post_type="blog"]').$content_after.'</div>';
			
		}
		
		return do_shortcode($output);
		
	}

	
	/* -----------------------------------------------------------------
	
		Galleria
	
	----------------------------------------------------------------- */
	function jw_galleria($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'width' => 900,
			'height' => '',
			'autoplay' => 'false'
		), $atts));
		
		$galleria_classes = '';
		
		if($autoplay == 'true'){ $galleria_classes .= 'galleria-autoplay '; }
		
		include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';
		
		//Only the first one should show by default (no js fix)
		$content = preg_replace('/\[galleria_slide/', '[galleria_slide show="yes"', $content, 1);
		
		$style_attr = 'style="';
		
		if($height != ''){
			$height = str_replace('px', '', $height);
			$content = preg_replace('/\[galleria_slide/', '[galleria_slide height="'.$height.'"', $content);
			$height += 70;
			$style_attr .= 'height: '.$height.'px;';
		}
		
		$style_attr .= '"';
		
		$output = '
		<div class="galleria '.$galleria_classes.'" '.$style_attr.'>
			'.do_shortcode($content).'
		</div>';
		
		return do_shortcode($output);
			
	}
	
	
	/* -----------------------------------------------------------------
	
		Galleria Slide
	
	----------------------------------------------------------------- */
	function jw_galleria_slide($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'caption' => '',
			'show' => 'no',
			'width' => '',
			'height' => ''
		), $atts));		
		
		$image_url = $content;
		
		if($width != '' || $height != ''){
		
			$image_url = jw_resize('', $image_url, $width, $height, true);
			$image_url = $image_url['url'];
		
		}
			
		$output = '<img src="'.$image_url.'" alt="'.$caption.'" style="'.$show.'" />';
		
		return do_shortcode($output);
			
	}
	
	
	/* -----------------------------------------------------------------
	
		Image
	
	----------------------------------------------------------------- */
	function jw_image($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'width' => '',
			'height' => '',
			'crop' => true,
			'tooltip' => '',
			'alt' => ''
		), $atts));
		
		$image_url = $content;
		
		/* Resize */
		if($width != '' || $height != ''){
			
			$image_url = jw_resize('', $image_url, $width, $height, $crop);
			$image_url = $image_url['url'];
			
		}
		
		$output = '<img'; 
		
		$output .= ' src = '.$image_url;
		
		if($tooltip != ''){
			$output .= ' class="ttip" title="'.$tooltip.'"';
		}
		
		if($alt != ''){
			$output .= ' alt="'.$alt.'"';
		}
		
		$output .= ' />';
		
		return do_shortcode($output);
			
	}
	
	
	/* -----------------------------------------------------------------
	
		Testimonials
	
	----------------------------------------------------------------- */
	function jw_testimonials($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'amount' => 5,
			'type' => 'scroller',
			'columns' => 3,
			'width' => 'one-third',
			'last' => 'false',
			'category' => 'all',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		if($last == 'true'){ $last = ' last'; }else{ $last = ''; }
		
		if($category == 'all'){
			$args = array(
				'post_type' => 'jw_testimonials',
				'posts_per_page' => $amount
			);
		}else{
			$args = array(
				'post_type' => 'jw_testimonials',
				'posts_per_page' => $amount,
				'tax_query' => array(
						array(
							'taxonomy' => 'jw_testimonials_categories',
							'field' => 'id',
							'terms' => $category
						)
					),
			);
		}
		$jw_query_testimonials = new WP_Query($args); 
		
		if($type == 'scroller'){
		
			$output = '<div class="'.$width.$last.'">'.$content_before.'<ul class="testimonials">';
				
				if ($jw_query_testimonials->have_posts()) : while ($jw_query_testimonials->have_posts()) : $jw_query_testimonials->the_post(); /* Loop the posts */
					
					$c_post_custom = get_post_custom(get_the_ID());
					$output .= '<li><blockquote><p>&#8220;'.$c_post_custom['jw_testimonial_content'][0].'&#8221; <cite>&ndash; '.$c_post_custom['jw_testimonial_author'][0].'</cite></p></blockquote></li>';
				
				endwhile; endif;
				
			$output .= '</ul>'.$content_after.'</div>';
		
		}else if($type == 'list'){
			
			switch ($columns) {
				case 4:
					$column = 'one-fourth';
					break;
				case 3:
					$column = 'one-third';
					break;
				case 2:
					$column = 'one-half';
					break;
				case 1:
					$column = '';
			}
			
			$count = 0;
			
			$output = '<div class="'.$width.$last.'">'.$content_before.'<div class="clear"></div>';
			
			if ($jw_query_testimonials->have_posts()) : while ($jw_query_testimonials->have_posts()) : $jw_query_testimonials->the_post(); $count++; /* Loop the posts */
				
				if($width == 'full-width'){
					if($column == 'one-half'){ $count_max = 2; }
					elseif($column == 'one-third'){ $count_max = 3; }
					elseif($column == 'one-fourth'){ $count_max = 4; }
					elseif($column == ''){ $count_max = 1; }
				}else if($width == 'two-third'){
					if($column == 'one-half'){ $count_max = 1; }
					elseif($column == 'one-third'){ $count_max = 2; }
					elseif($column == 'one-fourth'){ $count_max = 1; }
					elseif($column == ''){ $count_max = 1; }
				}else if($width == 'one-half'){
					if($column == 'one-half'){ $count_max = 1; }
					elseif($column == 'one-third'){ $count_max = 1; }
					elseif($column == 'one-fourth'){ $count_max = 2; }
					elseif($column == ''){ $count_max = 1; }
				}else if($width == 'one-third'){
					if($column == 'one-half'){ $count_max = 1; }
					elseif($column == 'one-third'){ $count_max = 1; }
					elseif($column == 'one-fourth'){ $count_max = 1; }
					elseif($column == ''){ $count_max = 1; }
				}else if($width == 'one-fourth'){
					if($column == 'one-half'){ $count_max = 1; }
					elseif($column == 'one-third'){ $count_max = 1; }
					elseif($column == 'one-fourth'){ $count_max = 1; }
					elseif($column == ''){ $count_max = 1; }
				}else if($width == 'three-fourth'){
					if($column == 'one-half'){ $count_max = 1; }
					elseif($column == 'one-third'){ $count_max = 2; }
					elseif($column == 'one-fourth'){ $count_max = 3; }
					elseif($column == ''){ $count_max = 1; }
				}
				
				if($count == $count_max){ $last = ' last'; $count = 0; }else{ $last = ''; }
					$output .= '<div class="'.$column.$last.'">';
						$output .= '<blockquote>';
							$c_post_custom = get_post_custom(get_the_ID());
							$output .= '<h6 class="no-margin-bottom">'.$c_post_custom['jw_testimonial_author'][0].'</h6>';
							if(isset($c_post_custom['jw_testimonial_author_position'][0])){
								$output .= '<div><small>'.$c_post_custom['jw_testimonial_author_position'][0].'</small></div>';
							}
							$output .= '<p class="no-margin-bottom">'.$c_post_custom['jw_testimonial_content'][0].'</p>';
						$output .= '</blockquote>';
					$output .= '</div>';
				
				if($last == ' last'){ $output .= '<div class="hr noline"></div>'; }
			
			endwhile; endif;
			
			$output .= '<div class="clear"></div>'.$content_after.'</div>';
			
		}
		
		wp_reset_query();
		
		return do_shortcode($output);
		
	}
	

	/* -----------------------------------------------------------------
	
		Contact Form
	
	----------------------------------------------------------------- */
	function jw_contact_form($atts, $content = null) {
		
		global $domain;
		
		extract(shortcode_atts(array(
			'width' => 'one-third',
			'last' => 'false',
			'content_before' => '',
			'content_after' => ''
		), $atts));
		
		$content_before = do_shortcode($content_before);
		$content_after = do_shortcode($content_after);
		
		if($content_before == 'undefined'){ $content_before = ''; }
		if($content_after == 'undefined'){ $content_after = ''; }
		
		if($last == 'true'){ $last_class = ' last'; }else{ $last_class = ''; }
		
		$output = '
		<div class="'.$width.$last_class.'">
		'.$content_before.'
		<form class="cmxform contactForm" id="contactForm" method="post" action="'.get_bloginfo('template_url').'/content-parts/contact-send.php">
			<fieldset>
				<p>
					<input type="text" onfocus="if(this.value==\''.__('Name', $domain).'\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.__('Name', $domain).'\';" name="cname" class="required" value="'.__('Name', $domain).'" id="cname" />
				</p>
				<p>
					<input type="text" onfocus="if(this.value==\''.__('Email', $domain).'\')this.value=\'\';" onblur="if(this.value==\'\')this.value=\''.__('Email', $domain).'\';" name="cemail" class="required email" value="'.__('Email', $domain).'" id="cemail" />
				</p>
				<p>
					<textarea cols="30" rows="10" class="required" name="ccomment" id="ccomment"></textarea>
				</p>
			</fieldset>
			<p><button class="submit btn skin" type="submit" name="sendmail">Send</button></p>
		</form>
		'.$content_after.'
		</div>
		<script type="text/javascript">
			//<![CDATA[
			var cname = new LiveValidation(\'cname\', {onlyOnSubmit: false, validMessage: " "});
			var cemail = new LiveValidation(\'cemail\', {onlyOnSubmit: false, validMessage: " "});
			var ccomment = new LiveValidation(\'ccomment\', {onlyOnSubmit: false, validMessage: " "});

			cname.add( Validate.Presence,{failureMessage: " "});
			cname.add( Validate.Exclusion, { within: [ \'First Name\' ] } );
			cemail.add( Validate.Email,{failureMessage: " "});
			cemail.add( Validate.Presence,{failureMessage: " "});							  					  
			ccomment.add( Validate.Presence,{failureMessage: " "});
			ccomment.add( Validate.Exclusion, { within: [ \'Message\' ] } );
			//]]>
		</script>';
		
		return do_shortcode($output);
			
	}
	
	
	/* -----------------------------------------------------------------
	
		Stars List
	
	----------------------------------------------------------------- */
	function jw_stars_list($atts, $content = null) {
		
		$output = '<ul class="stars-list">'.$content.'</ul>';
		
		return do_shortcode($output);
			
	}
	
	function jw_stars_list_item($atts, $content = null) {
		
		extract(shortcode_atts(array(
			'stars' => '5',
		), $atts));
		
		$output = '<li class="stars-'.$stars.'">'.$content.'</li>';
		
		return do_shortcode($output);
			
	}
	
	function jw_styled_list($atts, $content = null) {
		
		$content = do_shortcode($content);
		
		$output = '<div class="styled-list"'.$content.'</div>';
		
		return do_shortcode($output);
			
	}
		
	/* -----------------------------------------------------------------
	
		Related Posts
	
	----------------------------------------------------------------- */
	function jw_related_posts($atts, $contnet = null){
	
		global $domain;
	
		extract(shortcode_atts(array(
			'type' => 'blog'
		), $atts));
		
		$output = '';
	
		if($type == 'blog'){
		
			$tags = wp_get_post_tags(get_the_ID());
			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array(get_the_ID()),
				'showposts'=>2
				);
				$jw_related_query = new WP_Query($args);
				if( $jw_related_query->have_posts() ) {
					$output .= '<div class="portfolio-listing">';
						$count = 0;
						$output .= '<div class="separator"></div><h6>'.__("Similar Posts", $domain).'</h6>';
						while ($jw_related_query->have_posts()) : $jw_related_query->the_post(); $count++;
							if($count == 2){ $last_class = ' last'; $count = 0; }else{ $last_class = ''; }
							$output .= 
							'<div class="one-third'.$last_class.'">
								<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'jw_blog_third', array('class' => 'wrapped')).'</a>
								<span class="portfolio-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></span>
								'.jw_text_excerpt(get_the_excerpt(), 90).'
							</div>';
						endwhile;
					$output .= '</div>';
				}
			}
		
		}else{
	
			$tags = get_the_terms(get_the_ID(), 'jw_portfolio_tags');
			
			$output = '';
			
			if ($tags) {
				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'post_type' => 'jw_portfolio',
					'post__not_in' => array(get_the_ID()),
					'posts_per_page' => 2,
					'tax_query' => array(
							array(
								'taxonomy' => 'jw_portfolio_tags',
								'field' => 'id',
								'terms' => $tag_ids
							)
						),
				);
				$jw_related_query = new WP_Query($args);
				
				if( $jw_related_query->have_posts() ) {
				
					$output .= '<div class="portfolio-listing">';
				
						$count = 0;
						$output .= '<div class="separator"></div>
						<h6>'.__("Similar Projects", $domain).'</h6>';
						while ($jw_related_query->have_posts()) : $jw_related_query->the_post(); $count++;
							
							if($count == 2){ $last_class = ' last'; $count = 0; }else{ $last_class = ''; }
							
							$output .= 
							'<div class="one-third'.$last_class.'">
								<a href="'.get_permalink(get_the_ID()).'">'.get_the_post_thumbnail(get_the_ID(), 'jw_portfolio_listing', array('class' => 'wrapped')).'</a>
								<span class="portfolio-title"><a href="'.get_permalink(get_the_ID()).'">'.get_the_title(get_the_ID()).'</a></span>
								'.jw_text_excerpt(get_the_excerpt(), 90).'
							</div>';
							
						endwhile;
					
					$output .= '</div>';
					
				}
				
			}
		
		}
		
		return $output;
		
	}
?>