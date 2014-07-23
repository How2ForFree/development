<?php
/**
 * Plugin Name: JW - Popular Posts, Recent Posts, Comments
 * Description: Displaying popular posts, recent posts and comments in tabs.
 * Version: 1.0
 */

add_action( 'widgets_init', 'jw_popular_recent_comments_load_widget' );

function jw_popular_recent_comments_load_widget() {
	register_widget( 'JW_Recent_Popular_Comments' );
}

class JW_Recent_Popular_Comments extends WP_Widget {

	function JW_Recent_Popular_Comments() {
		
		global $domain;
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'jw-popular-recent-comments', 'description' => __('Show popular posts, latest posts and latest comments from the blog. Location: Sidebar', $domain) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'jw-popular-recent-comments-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'jw-popular-recent-comments-widget', __('JW - Popular/Latest/Comments', $domain), $widget_ops, $control_ops );
		
	}

	function widget( $args, $instance ) {
		
		global $domain;
		
		include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';

		if($jw_image_load_animation == 'on'){ $image_animate_class = 'image-load-animate'; }else{ $image_animate_class = ''; }
		
		extract( $args );

		/* Our variables from the widget settings. */
		$amount = $instance['amount'];
	
		/* Before widget (defined by themes). */
		echo $before_widget;

		?>
		<div class="tabs-container">
			<ul class="tabs-nav col-clear">
				<li><a href="#widget-tab-popular"><?php _e('Popular', $domain); ?></a></li>
				<li><a href="#widget-tab-recent"><?php _e('Latest', $domain); ?></a></li>
				<li><a href="#widget-tab-comments"><?php _e('Comments', $domain); ?></a></li>
			</ul>
			<div class="clear"></div>
			<div id="widget-tab-popular" class="tab-content">
			
				<ul class="posts-listing">
					<?php
					
					/* Display Posts */
					$q_args=array(
					   'post_type' => 'post',
					   'showposts' => $instance['amount'],
					   'orderby' => 'comment_count',
					);
					$popular_posts_query = new WP_query();
					$popular_posts_query->query($q_args);
					
					if ($popular_posts_query->have_posts()) : while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post();
					
					?>
						
						<li class="col-clear">
							<a href="<?php the_permalink(); ?>">
								<span class="posts-listing-thumb <?php echo $image_animate_class; ?>"><?php the_post_thumbnail('jw_63', array('class' => 'wrapped-small')); ?></span>
								<div>
									<?php the_title(); ?>
									<small class="block"><?php the_time('F j, Y'); ?></small>
								</div>
							</a>
						</li>
					
					<?php
					
					endwhile; endif;
					wp_reset_query();
					
					?>
					
				</ul>
				
			</div> <!-- end tab 1 -->
			<div id="widget-tab-recent" class="tab-content">
				
				<ul class="posts-listing">
					<?php
					
					/* Display Posts */
					$q_args=array(
					   'post_type' => 'post',
					   'showposts' => $instance['amount'],
					);
					$recent_posts_query = new WP_query();
					$recent_posts_query->query($q_args);
					
					if ($recent_posts_query->have_posts()) : while ($recent_posts_query->have_posts()) : $recent_posts_query->the_post();
					
					?>
					
						<li class="col-clear">
							<a href="<?php the_permalink(); ?>">
								<span class="posts-listing-thumb" <?php echo $image_animate_class; ?>><?php the_post_thumbnail('jw_63', array('class' => 'wrapped-small align-left')); ?></span>
								<div>
									<?php the_title(); ?>
									<small class="block"><?php the_time('F j, Y'); ?></small>
								</div>
							</a>
						</li>
					
					<?php
					
					endwhile; endif;
					wp_reset_query();
					
					?>
					
				</ul>
			
			</div> <!-- end tab 2 -->
			<div id="widget-tab-comments" class="tab-content">
			
				<ul class="posts-listing">
					<?php
					
					$q_args = array(
						'number' => $instance['amount'],
						'status' => 'approve',
						'type' => 'comment'
					);
					$comments = get_comments($q_args);
					foreach($comments as $comment) :

					?>
					
						<li class="col-clear">
							<a href="<?php echo get_permalink($comment->comment_post_ID ); ?>">
								<span class="posts-listing-thumb <?php echo $image_animate_class; ?>"><?php echo get_avatar( $comment, 63 ); ?></span>
								<div>
									<?php echo $comment->comment_author; ?>
									<small class="block"><?php echo substr($comment->comment_content, 0, 80).'...'; ?></small>
								</div>
							</a>
						</li>
					
					<?php
					
					endforeach;
					
					?>
					
				</ul>
			
			</div> <!-- end tab 3 -->
		</div> <!-- end tabs -->
		
		<div class="hr noline"></div>
		
		<?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['amount'] = strip_tags( $new_instance['amount'] );

		return $instance;
	}

	function form( $instance ) {

		global $domain;
	
		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Recent Posts', $domain), 'amount' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'amount' ); ?>"><strong>-<?php _e('Amount:', $domain); ?>-</strong></label><br />
			<small>How many posts to show</small>
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