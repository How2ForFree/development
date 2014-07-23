<?php
class UDS_Twitter extends WP_Widget {
	var $error;
	
	function UDS_Twitter() {
		//Constructor
		parent::__construct(false, __('UDS Twitter', 'uds-textdomain'));
		$this->error = '';
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$twitter_user = apply_filters('widget_twitter_user', $instance['twitter_user']);
		$twitter_count = apply_filters('widget_twitter_count', $instance['twitter_count']);
		
		$statuses = uds_twitter_statuses($twitter_user, $twitter_count);
		
		echo $before_widget;
		if ( $title )
        	echo $before_title . "<a href='http://twitter.com/$twitter_user'>" . $title . '</a>' . $after_title;
        
		//d($statuses);
		?>
			<div class="uds-twitter-widget">
				<?php if(!is_wp_error($statuses)): ?>
				<ul>
					<?php foreach($statuses as $key => $status): ?>
						<?php if($key == $twitter_count) break; ?>
						<li class="tweet">
							<div class="tweet-footer-top"></div>
							<div class="text"><?php echo $status->text ?>
							<p class="source">
								<span title="<?php echo esc_attr($status->created_at) ?>"><?php echo esc_html($status->created_at) ?> ago</span>
							</p>
							</div>
							<div class="tweet-footer-bottom"></div>
						</li>
					<?php endforeach; ?>
				</ul>
				<?php echo "<a class='twit-follow-footer' href='http://twitter.com/$twitter_user'>".__('follow us on twitter', 'uds-textdomain')."</a>" ?>
				<?php else: ?>
					<?php if(is_wp_error($statuses)): ?>
						<p class="error"><?php echo is_object($statuses->get_error_message()) ? $statuses->get_error_message()->error : $statuses->get_error_message() ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$twitter_user = esc_attr($instance['twitter_user']);
		$twitter_count = esc_attr($instance['twitter_count']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_user'); ?>"><?php _e('Twitter Screen Name:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_user'); ?>" name="<?php echo $this->get_field_name('twitter_user'); ?>" type="text" value="<?php echo $twitter_user; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('twitter_count'); ?>"><?php _e('Tweet count:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>" type="text" value="<?php echo $twitter_count; ?>" /></label></p>
		<?php
	}
}
?>