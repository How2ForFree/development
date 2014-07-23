<?php
/**
 * Creates widget with posts
 */

class Posts_Popular_Widget extends WP_Widget {	
	/**
	 * Widget constructor 
     *
	 * @desc sets default options and controls for widget
	 */
	function Posts_Popular_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'widget_posts_popular',
			'description' => __('Display the most popular posts by comments')			
		);

		/* Create the widget */
		$this->WP_Widget('posts-popular-widget', __('Theme &rarr; Posts Popular'), $widget_ops);
	}
	
	/**
	 * Displaying the widget
	 *
	 * Handle the display of the widget
	 * @param array
	 * @param array
	 */
	function widget ( $args, $instance ) {
		extract ($args);
		global $wpdb;		
	    $sql = "SELECT id, post_title FROM {$wpdb->prefix}posts  WHERE post_status = 'publish' AND post_type = 'post' ORDER BY comment_count DESC LIMIT 0, " . $instance['limit'];
    	$popular_posts = $wpdb->get_results($sql);

		/* Before widget(defined by theme)*/
		echo $before_widget;

		/* START Widget body */
        if ( !empty( $instance['title'] ) )
            echo '<h3><span class="title-wrapper">' . $instance['title'] . '<span class="wd-icon"></span></span></h3>';

    	echo '<ul class="popular-posts">';
    	foreach ( $popular_posts as $post ) {
    		echo '<li><a href="' . get_permalink( $post->id ) . '">' . $post->post_title . '</a></li>';	
        }
    	echo '</ul>';       
		/* END Widget body*/
		
		/* After widget(defined by theme)*/
		echo $after_widget;
	}
	
	/**
	 * Update and save widget
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array New widget values
	 */
	function update ( $new_instance, $old_instance ) {
	    print_r($new_instance);
		$old_instance['title'] = strip_tags( $new_instance['title'] );
		
		$old_instance['limit'] = strip_tags( $new_instance['limit'] );		
		
		return $old_instance;
	}
	
	/**
	 * Creates widget controls or settings
	 *
	 * @param array Return widget options form
	 */
	function form ( $instance ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php echo __( 'Limit' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo $instance['limit']; ?>"class="widefat" style="width:100%;" />
        </p>

		<?php
	}
}
register_widget( 'Posts_Popular_Widget' );
