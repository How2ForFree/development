<?php
class UDS_RecentPopularPosts extends WP_Widget {
	function UDS_RecentPopularPosts() {
		//Constructor
		$options = array(
			'description' => __('Similar to Popular Posts, but prefers newer posts over older ones', 'uds-textdomain')
		);
		parent::__construct(false, __('UDS Recent Popular Posts', 'uds-textdomain'), $options);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$count = (int)$instance['count'];
		
		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
		
		add_filter('posts_orderby', 'uds_time_popular_filter_orderby');
		echo uds_render_posts(array(
			'orderby' => 'comment_count',
			'order' => 'DESC',
			'posts_per_page' => $count
		), array(
			'thumb_width' => '40px',
			'thumb_height' => '40px',
			'title_tag' => 'h6',
			'read_more'  => 'false',
			'author'  => 'false',
			'comment_count'  => 'false',
		), 'uds-recent-posts');
		remove_filter('posts_orderby', 'uds_time_popular_filter_orderby');
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {		
		return $new_instance;
	}

	function form($instance) {
		$images = maybe_unserialize(get_option($this->id));
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$count = isset($instance['count']) ? esc_attr($instance['count']) : 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Post Count:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
		<?php
	}
}
?>