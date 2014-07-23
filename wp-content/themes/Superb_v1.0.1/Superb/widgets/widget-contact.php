<?php
class UDS_Contact extends WP_Widget {
	var $error;
	
	function UDS_Contact() {
		//Constructor
		$options = array(
			'description' => __('Displays contact info in a styled fashion', 'uds-textdomain')
		);
		parent::__construct(false, __('Contact Info', 'uds-textdomain'), $options);
		$this->error = '';
	}

	function widget($args, $instance) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		if ( $title )
        	echo $before_title . $title . $after_title;
        
		echo '<div class="uds-flickr-widget">';
		echo uds_contact_info($instance);
		echo '</div>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		$title = 	esc_attr(isset($instance['title'	]) ? $instance['title'		] : '');
		$name = 	esc_attr(isset($instance['name'		]) ? $instance['name'		] : '');
		$email = 	esc_attr(isset($instance['email'	]) ? $instance['email'		] : '');
		$phone = 	esc_attr(isset($instance['phone'	]) ? $instance['phone'		] : '');
		$address = 	esc_attr(isset($instance['address'	]) ? $instance['address'	] : '');
		$address1 = esc_attr(isset($instance['address1'	]) ? $instance['address1'	] : '');
		$address2 = esc_attr(isset($instance['address2'	]) ? $instance['address2'	] : '');
		
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo $name; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('E-mail:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" type="text" value="<?php echo $email; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('tel'); ?>"><?php _e('Phone:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php echo $this->get_field_name('tel'); ?>" type="text" value="<?php echo $tel; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address Line 1:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" type="text" value="<?php echo $address; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('address1'); ?>"><?php _e('Address Line 2:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('address1'); ?>" name="<?php echo $this->get_field_name('address1'); ?>" type="text" value="<?php echo $address1; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('address2'); ?>"><?php _e('Address Line 3:', 'uds-textdomain'); ?> <input class="widefat" id="<?php echo $this->get_field_id('address2'); ?>" name="<?php echo $this->get_field_name('address2'); ?>" type="text" value="<?php echo $address2; ?>" /></label></p>
		<?php
	}
}
?>