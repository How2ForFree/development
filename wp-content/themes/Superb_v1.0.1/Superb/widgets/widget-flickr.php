<?php
class UDS_Flickr extends WP_Widget {
	var $error;
	
	function UDS_Flickr() {
		//Constructor
		$options = array(
			'description' => __('Displays photos from a Flickr Feed', 'uds-textdomain')
		);
		parent::__construct(false, __('UDS Flickr', 'uds-textdomain'), $options);
		$this->error = '';
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);
		$flickr_id = apply_filters('widget_flickr_id', $instance['flickr_id']);
		$flickr_ids = apply_filters('widget_flickr_ids', $instance['flickr_ids']);
		$flickr_tags = apply_filters('widget_flickr_tags', $instance['flickr_tags']);
		$flickr_tagmode = apply_filters('widget_flickr_tagmode', $instance['flickr_tagmode']);
		
		$photos = uds_flickr_public($flickr_id, $flickr_ids, $flickr_tags, $flickr_tagmode);

		echo $before_widget;
		if ( $title )
        	echo $before_title . "<a href='http://flickr.com/$flickr_id'>" . $title . '</a>' . $after_title;
        
		$photos = $photos['items'];
		?>
			<div class="uds-flickr-widget">
				<?php if(!is_wp_error($photos)): ?>
					<?php foreach($photos as $key => $photo): ?>
						<?php if( $key > 8) break; ?>
						<?php $class = (($key+1) % 3 == 0 ? 'last' : '') ?>
						<a href="<?php echo $photo['url'] ?>" class="<?php echo $class ?>"><img src="<?php echo $photo['t_url'] ?>" alt="<?php echo $photo['title'] ?>" /></a>
						
					<?php endforeach; ?>
					<div class="clear"></div>
				<?php else: ?>
					<?php if(is_wp_error($photos)): ?>
						<p class="error"><?php echo $photos->get_error_message() ?></p>
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
		$flickr_id = esc_attr($instance['flickr_id']);
		$flickr_ids = esc_attr($instance['flickr_ids']);
		$flickr_tags = esc_attr($instance['flickr_tags']);
		$flickr_tagmode = esc_attr($instance['flickr_tagmode']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Flickr ID:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('flickr_ids'); ?>"><?php _e('Flickr IDs:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_ids'); ?>" name="<?php echo $this->get_field_name('flickr_ids'); ?>" type="text" value="<?php echo $flickr_ids; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('flickr_tags'); ?>"><?php _e('Flickr Tags:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_tags'); ?>" name="<?php echo $this->get_field_name('flickr_tags'); ?>" type="text" value="<?php echo $flickr_tags; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('flickr_tagmode'); ?>"><?php _e('Flickr Tagmode (any or all):', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_tagmode'); ?>" name="<?php echo $this->get_field_name('flickr_tagmode'); ?>" type="text" value="<?php echo $flickr_tagmode; ?>" /></label></p>
		<?php
	}
}
?>