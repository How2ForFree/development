<?php
/**
 * Plugin Name: JW - Contact Form
 * Description: Displaying contact form.
 * Version: 1.0
 */

add_action( 'widgets_init', 'contact_form_load_widget' );

function contact_form_load_widget() {
	register_widget( 'JW_Contact_Form' );
}

class JW_Contact_Form extends WP_Widget {

	function JW_Contact_Form() {
		
		global $domain;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-contact-form', 'description' => __('Show contact form. Location: Anywhere', $domain) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-contact-form-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-contact-form-widget', __('JW - Contact Form', $domain), $widget_ops, $control_ops );
		
	}

	function widget( $args, $instance ) {
		
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
	
		/* Before widget (defined by themes). */
		echo $before_widget;
		
		/* Display the widget title if one was input (before and after defined by themes). */
		echo $before_title.$title.$after_title;
		
		echo do_shortcode('[contact_form]');
		
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
		

		return $instance;
	}

	function form( $instance ) {

		global $domain;
	
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Contact Us', 'lifeline'));
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget settings output -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><strong>-<?php _e('Title:', $domain); ?>-</strong></label><br />
			<small>Title will show up as "heading" for the widget in the sidebar</small>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<br />
		
		
	<?php
	}
}

?>