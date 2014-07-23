<?php

/* ------------------------------------------------------------------------------------------------------------

	Functions - Common
	
	Description: Here are the functions that are common for all themes but some parts are probably different on 
	theme to theme basis such as html layout or scripts included.
	
	Table of contents:
		1) jw_comment_layout
		2) jw_include_js
		3) jw_include_admin_js
		4) jw_about_author
		5) jw_include_admin_css
		6) jw_post_meta
		7) jw_portfolio_meta
		8) jw_excerpt_more
		10) jw_slider_layout
	
------------------------------------------------------------------------------------------------------------ */

	/* Actions */
	add_action('wp_print_scripts', 'jw_include_js'); /* Include JavaScript files */
	add_action('admin_print_scripts', 'jw_include_admin_js'); /* Include JavaScript files in admin */
	add_action('admin_print_styles', 'jw_include_admin_css'); /* Include CSS files in the admin */
	add_filter('get_the_excerpt', 'jw_excerpt_more');
	

	/* -----------------------------------------------------------------
		
		Name: jw_comment_layout
1)		
		Used to format the comment layout. There is no
		closing li tag because WordPress will close it for us (because 
		of threaded comments).
		
	----------------------------------------------------------------- */
	function jw_comment_layout($comment, $args, $depth) {
		
		global $domain; /* The unique string used for translation */
		
		$GLOBALS['comment'] = $comment;
	
		?>
		
		<li <?php comment_class('commentWrap'); ?> id="comment-<?php comment_ID() ?>">
			<?php echo get_avatar($comment, $size = '56'); ?>
			<div class="comment-main">
				<div class="comment-meta"><?php comment_author_link(); ?> <small>on <?php comment_date(); ?></small></div>
				<div class="comment-content">
					<?php if ($comment->comment_approved == '0'){ /* If comment is awaing moderation */ ?>
						<p><em><?php _e('Your comment is awaiting moderation', $domain); ?></em></p>
					<?php } ?>
					<?php comment_text(); ?>
					<?php comment_reply_link(array_merge(array('reply_text' => __('Reply', $domain)), array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div><!-- .comment-content -->
			</div><!-- .comment-main -->
			
			<!-- comment layout ends here -->
		
	<?php 
	} /* jw_comment_layout() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_include_js
2)		
		Including JavaScript files in the theme (not in admin)
	
	------------------------------------------------------------------ */
	function jw_include_js(){
	
		if (!is_admin()) {
		
			// Deregister scripts
			wp_deregister_script('jquery');
			
			// Register scripts
			wp_register_script('jquery', get_template_directory_uri().'/js/jquery.js', false);
			wp_register_script('js_combined', get_template_directory_uri().'/js/plugins.combined.js', false);
			wp_register_script('js_custom', get_template_directory_uri().'/js/custom.js', false);
		
			// Enqueue scripts
			wp_enqueue_script('jquery');
			wp_enqueue_script('js_combined');
			wp_enqueue_script('js_custom');
			
			
		}
	
	} /* jw_include_js() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_include_admin_js
3)		
		Including JavaScript files in the WordPress admin
	
	------------------------------------------------------------------ */
	function jw_include_admin_js(){
				
		// Register scripts
		wp_register_script('js_admin_custom', get_template_directory_uri().'/js/admin.js', false);
		wp_register_script('js_admin_colorpicker', get_template_directory_uri().'/js/colorpicker.js', false);
		
		// Enqueue scripts
		wp_enqueue_script('js_admin_colorpicker');
		wp_enqueue_script('js_admin_custom');
		
	} /* jw_include_admin_js() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_about_author
4)		
		Info about the author on blog posts
	
	------------------------------------------------------------------ */
	
	add_filter('get_avatar','jw_avatar_class');
	function jw_avatar_class($class) {
		$class = str_replace("class='avatar", "class='author_gravatar wrapped-small align-left ", $class) ;
		return $class;
	}
	
	function jw_about_author(){
		
		global $domain; /* The unique string used for translation */
		
		?>
		
		<div class="separator"></div>
		
		<div id="about-the-author">
			
			<h6><?php _e('About the author', $domain); ?></h6>
			<div>
				<?php echo get_avatar(get_the_author_meta('user_email'), $size = '80'); ?>
				<?php if(get_the_author_meta('description') != ''){ the_author_meta('description'); }else{ _e('Currently there is no additional info about this author.', $domain); } ?><br />
				<div class="clear"></div>
			</div>
			
		</div><!-- #about-the-author -->
		<?php
		
		
	} /* jw_about_author() END */
	
	
	/* ------------------------------------------------------------------
	
		Name: jw_include_admin_css
5)		
		Include stylesheets in the admin
	
	------------------------------------------------------------------ */
	function jw_include_admin_css(){
	
		/* Register styles */
		wp_register_style('jw_admin_css', get_template_directory_uri().'/css/admin.css');
		wp_register_style('jw_admin_font_droid_serif', 'http://fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold');
		wp_register_style('jw_admin_font_droid_sans', 'http://fonts.googleapis.com/css?family=Droid+Sans');
		wp_register_style('jw_admin_meta_style', get_template_directory_uri().'/functions/meta-style.css');
		
		/* Enqueue styles */
		wp_enqueue_style( 'jw_admin_css');
		wp_enqueue_style( 'jw_admin_font_droid_serif');
		wp_enqueue_style( 'jw_admin_font_droid_sans');
		wp_enqueue_style( 'jw_admin_meta_style');
        
	
	} /* jw_include_admin_css() END */
	
	/* ------------------------------------------------------------------
	
		Name: jw_post_meta
6)		
		Show the blog post information
	
	------------------------------------------------------------------ */
	function jw_post_meta(){
		
		global $domain; /* The unique string used for translation */
		
		?>
		<div class="post-meta"><?php the_category(' / '); ?></div>
		<?php
		
	} /* jw_post_meta() END */
	

	/* ------------------------------------------------------------------
	
		Name: jw_portfolio_meta
7)		
		Show the blog post information
	
	------------------------------------------------------------------ */
	function jw_portfolio_meta(){
		
		global $domain; /* The unique string used for translation */
		global $post;
		?>
		
		<div class="entry-meta">
			<span class="post-date"><span class="day"><?php the_time('j'); ?></span><span class="month"><?php the_time('M'); ?></span></span> 
			<span class="post-author"><?php the_author_posts_link(); ?></span> 
			<span class="post-tags">
				<?php
				$portfolio_cats = get_the_terms($post->ID, 'jw_portfolio_categories');
				$p_count = 0;
				foreach($portfolio_cats as $portfolio_cat){
					$p_count++;
					if($p_count > 1){ echo ', '.$portfolio_cat->name; }else{ echo $portfolio_cat->name; }
				}
				?>
			</span> 
		</div>
		
		<?php
		
	} /* jw_portfolio_meta() END */
	
	
	/* -----------------------------------------------------------------
		
		Name: jw_excerpt more
8)		
		Change [...] with something else
		
	----------------------------------------------------------------- */
	function jw_excerpt_more($text) {
		return str_replace('[...]', '...', $text);
	}
	
	/* -----------------------------------------------------------------
		
		Name: jw_slider_output
8)		
		Outputs the slider
		
	----------------------------------------------------------------- */
	function jw_slider_output(){
		global $post;
		$post_custom = get_post_custom($post->ID);
		if($post_custom['jw_slider_type'][0] == 'piecemaker'){
			?><div class="wrap960"><div id="piecemaker"></div></div><?php
		}else{
			?>
			<div id="slider">
				<div id="slider-slides">
					<?php
						//Only the first one should show by default (no js fix)
						$jw_slider_content = preg_replace('/\[slide/', '[slide show="yes"', $post_custom['jw_slider'][0], 1);
						echo do_shortcode($jw_slider_content);
					?>
				</div><!-- #slider-slides -->
				<a href="#" id="slider-prev"></a>
				<a href="#" id="slider-next"></a>
				<div id="slide-caption"></div>
				<ul id="slider-pager"></ul>
				<div class="clear"></div>
			</div><!-- #slider -->
			<?php
		}
	}
?>