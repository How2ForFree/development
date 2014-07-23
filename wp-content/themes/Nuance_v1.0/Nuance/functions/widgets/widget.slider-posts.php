<?php
/**
 * Plugin Name: JW - Slider posts
 * Description: Displaying posts in a slider from blog or portfolio.
 * Version: 1.0
 */

add_action( 'widgets_init', 'jw_slider_posts_load_widget' );

function jw_slider_posts_load_widget() {
	register_widget( 'JW_Slider_Posts' );
}

class JW_Slider_Posts extends WP_Widget {

	function JW_Slider_Posts() {
	
		global $domain;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-slider-posts', 'description' => __('Show blog or portfolio post in a slider. Location: Anywhere', $domain) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 650, 'height' => 350, 'id_base' => 'jw-slider-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-slider-posts-widget', __('JW - Slider Posts', $domain), $widget_ops, $control_ops );
		
	}

	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$amount = $instance['amount'];
		$tag = $instance['tag'];
		$post_type = $instance['post_type'];
		$show_thumbnail = $instance['show_thumbnail'];
		$show_title = $instance['show_title'];
		$show_excerpt = $instance['show_excerpt'];
		
		$dontshow = '';
		
		if($show_thumbnail != 'yes'){
			$dontshow .= 'thumbnail="no" ';
		}
		
		if($show_title != 'yes'){
			$dontshow .= 'title="no" ';
		}
		
		if($show_excerpt != 'yes'){
			$dontshow .= 'excerpt="no" ';
		}
	
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		echo $before_title.$title.'<a href="#" class="previous"></a><a href="#" class="next"></a>'.$after_title;

		$content = '[slider_posts post_type='.$post_type.' amount='.$amount.' tag='.$tag.' '.$dontshow.']';
		
		echo do_shortcode($content);
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['amount'] = strip_tags( $new_instance['amount'] );
		$instance['tag'] = strip_tags( $new_instance['tag'] );
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );
		$instance['show_thumbnail'] = strip_tags( $new_instance['show_thumbnail'] );
		$instance['show_title'] = strip_tags( $new_instance['show_title'] );
		$instance['show_excerpt'] = strip_tags( $new_instance['show_excerpt'] );

		return $instance;
	}

	function form( $instance ) {

		global $domain;
	
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'amount' => 5, 'post_type' => 'post', 'tag' => '', 'show_thumbnail' => 'yes', 'show_title' => 'yes', 'show_excerpt' => 'yes');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget settings output -->
		<div class="jw-widget-half first">
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong>-<?php _e('Title:', $domain); ?>-</strong></label><br />
				<small>"Heading" for the widget when used in a sidebar or in footer. Leave blank if used inside content.</small>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
			</p>
	
		</div>
		
		<div class="jw-widget-half">

			<p>
				<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><strong>-<?php _e('Post Type:', $domain); ?>-</strong></label><br />
				<small>Do you want to show "posts" from blog or portfolio? Most recent will be shown.</small>
			</p>
			<p>
				<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat" style="width:100%;">
					<option value="post" <?php if ( 'post' == $instance['post_type'] ) echo 'selected="selected"'; ?>>Blog</option>
					<option value="portfolio" <?php if ( 'portfolio' == $instance['post_type'] ) echo 'selected="selected"'; ?>>Portfolio</option>
				</select>
			</p>
		
		</div>
		
		<div class="jw-widget-clear"></div>
		
		<div class="jw-widget-half first">
		
			<p>
				<label for="<?php echo $this->get_field_id( 'tag' ); ?>"><strong>-<?php _e('Tag/Category:', $domain); ?>-</strong></label><br />
				<small>If you're showing blog posts set the tag here, if you're showing portfolio posts set the category slug here. <strong>Notice:</strong> For portfolio posts this works only with WordPress 3.1+.</small>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id( 'tag' ); ?>" name="<?php echo $this->get_field_name( 'tag' ); ?>" value="<?php echo $instance['tag']; ?>" class="widefat" />
			</p>
			
		</div>
		
		<div class="jw-widget-half">
		
			<p>
				<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><strong>-<?php _e('Amount:', $domain); ?>-</strong></label><br />
				<small>How many posts to show?</small>
			</p>
			<p>
				<select id="<?php echo $this->get_field_id( 'amount' ); ?>" name="<?php echo $this->get_field_name( 'amount' ); ?>" class="widefat" style="width:100%;">
					<?php
					for ($i = 1; $i <= 15; $i++) {
						?><option <?php if ( $i == $instance['amount'] ) echo 'selected="selected"'; ?>><?php echo $i; ?></option><?php
					}
					?>
				</select>
			</p>
		
		</div>
		
		<div class="jw-widget-clear"></div>
		
		<div class="jw-widget-half first">
		
			<p>
				<label><strong>-<?php _e('Other options:', $domain); ?>-</strong></label><br />
				<small>What do you want to show?</small>
			</p>
			<p>
				<span><input id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" value="yes" type="checkbox" <?php if($instance['show_thumbnail'] == 'yes'){ echo 'checked'; } ?> /> <small>Show Thumbnail</small></span><br />
				<span><input id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" value="yes" type="checkbox" <?php if($instance['show_title'] == 'yes'){ echo 'checked'; } ?> /> <small>Show Title</small></span><br />
				<span><input id="<?php echo $this->get_field_id( 'show_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'show_excerpt' ); ?>" value="yes" type="checkbox" <?php if($instance['show_excerpt'] == 'yes'){ echo 'checked'; } ?> /> <small>Show Excerpt</small></span><br />
			</p>
		
		</div>
		
		<div class="jw-widget-clear"></div>
		
	<?php
	}
}

?>