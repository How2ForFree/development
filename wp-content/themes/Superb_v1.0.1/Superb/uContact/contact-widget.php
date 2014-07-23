<?php
class uContact extends WP_Widget {
	function uContact() {
		//Constructor
		$options = array(
			'description' => __('Displays Contact Form in a widget area', 'uds-textdomain')
		);
		parent::__construct(false, __('uContact', 'uds-textdomain'), $options);
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', isset($instance['title']) ? $instance['title'] : '');
		$name = $instance['name'];
		
		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
        	
		echo get_uds_contact_form($name);
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = esc_attr($instance['title']);
		$name = esc_attr($instance['name']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Contact form name:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></label></p>
		<?php
	}
}
?>