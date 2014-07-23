<?php
/**
 * Plugin Name: JW - Recent Posts
 * Description: Displaying recent posts.
 * Version: 1.0
 */

add_action( 'widgets_init', 'jw_recent_posts_load_widget' );

function jw_recent_posts_load_widget() {
	register_widget( 'JW_Recent_Posts' );
}

class JW_Recent_Posts extends WP_Widget {

	function JW_Recent_Posts() {
	
		global $domain;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-recent-posts', 'description' => __('Show latest posts from blog or portfolio.', $domain) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-recent-posts-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-recent-posts-widget', __('JW - Latest Posts', $domain), $widget_ops, $control_ops );
		
	}

	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$amount = $instance['amount'];
		$post_type = $instance['post_type'];
	
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		echo $before_title.$title.$after_title;
		
		$content = '[recent_posts amount="'.$amount.'" post_type="'.$post_type.'"]';
		
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
		$instance['post_type'] = strip_tags( $new_instance['post_type'] );

		return $instance;
	}

	function form( $instance ) {
	
		global $domain;
	
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Recent Posts', $domain), 'amount' => 5, 'post_type' => 'post');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget settings output -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong>-<?php _e('Title:', $domain); ?>-</strong></label><br />
			<small><?php _e('Title will show up as "heading" for the widget in the sidebar', $domain); ?></small>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<br />
		
		<p>
			<label for="<?php echo $this->get_field_id( 'post_type' ); ?>"><strong>-<?php _e('Post type:', $domain); ?>-</strong></label><br />
			<small><?php _e('What do you want to show posts from, blog or portfolio?', $domain); ?></small>
		</p>
		<p>
			<select id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>" class="widefat" style="width:100%;">
				<option value="post" <?php if ( 'post' == $instance['post_type'] ) echo 'selected="selected"'; ?>>Blog</option>
				<option value="portfolio" <?php if ( 'portfolio' == $instance['post_type'] ) echo 'selected="selected"'; ?>>Portfolio</option>
			</select>
		</p>
		
		<br />
		
		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><strong>-<?php _e('Amount:', $domain); ?>-</strong></label><br />
			<small><?php _e('How many posts to show', $domain); ?></small>
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
		
	<?php
	}
}

?>