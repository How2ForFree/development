<?php
/**
 * Plugin Name: JW - Recent Tweets
 * Description: Displaying recent tweets.
 * Version: 1.0
 */

add_action('widgets_init', 'jw_recent_tweets_load_widget');

function jw_recent_tweets_load_widget(){
	register_widget('JW_Recent_Tweets');
}

class JW_Recent_Tweets extends WP_Widget {

	function JW_Recent_Tweets(){
	
		global $domain;
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'jw-recent-tweets', 'description' => __('Show recent tweets.', $domain));

		/* Widget control settings. */
		$control_ops = array('width' => 650, 'height' => 350, 'id_base' => 'jw-recent-tweets-widget');

		/* Create the widget. */
		$this->WP_Widget('jw-recent-tweets-widget', __('JW - Recent Tweets', $domain), $widget_ops, $control_ops);
		
	}

	function widget($args, $instance){
		
		extract($args);

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$amount = $instance['amount'];
		$profile = $instance['profile'];
		
		/* Before widget (defined by themes). */
		echo $before_widget.'<div class="twitterfeed">';
		
		echo $before_title.$title.$after_title;

		$content = '[recent_tweets amount="'.$amount.'" profile="'.$profile.'"]';
		
		echo do_shortcode($content);
		
		/* After widget (defined by themes). */
		echo '</div>'.$after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update($new_instance, $old_instance){
		
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['amount'] = strip_tags($new_instance['amount']);
		$instance['profile'] = strip_tags($new_instance['profile']);

		return $instance;
		
	}

	function form($instance){
		
		global $domain;
		
		/* Set up some default widget settings. */
		$defaults = array('title' => '', 'amount' => 5, 'profile' => 'jvanoel');
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<!-- Widget settings output -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><strong>-<?php _e('Title:', $domain); ?>-</strong></label><br />
			<small>"Heading" for the widget when used in a sidebar or in footer.</small>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		
		<br />
		
		<p>
			<label for="<?php echo $this->get_field_id('profile'); ?>"><strong>-<?php _e('Profile:', $domain); ?>-</strong></label><br />
			<small>"Heading" for the widget when used in a sidebar or in footer.</small>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('profile'); ?>" name="<?php echo $this->get_field_name('profile'); ?>" value="<?php echo $instance['profile']; ?>" class="widefat" />
		</p>
		
		<br />
		
		<p>
			<label for="<?php echo $this->get_field_id('amount'); ?>"><strong>-<?php _e('Amount:', $domain); ?>-</strong></label><br />
			<small>How many tweets to show?</small>
		</p>
		<p>
			<select id="<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('amount'); ?>" class="widefat" style="width:100%;">
				<?php
				for ($i = 1; $i <= 15; $i++){
					?><option <?php if ($i == $instance['amount']) echo 'selected="selected"'; ?>><?php echo $i; ?></option><?php
				}
				?>
			</select>
		</p>		
		
	<?php
	}
}

?>