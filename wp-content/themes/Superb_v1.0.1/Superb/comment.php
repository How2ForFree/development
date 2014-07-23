<div <?php comment_class();?> id="comment-<?php comment_ID(); ?>">
	<?php echo get_avatar($comment, '80', get_template_directory_uri().'/images/avatar.jpg')?>
	<div class="comment-meta">
		<p class="comment-author"><?php _e('By', 'uds-textdomain') ?> <a href="<?php comment_author_url() ?>"><?php comment_author(); ?> </a>&nbsp</p>
		<p class="comment-date" title="<?php comment_date() ?> <?php comment_time() ?>">
			<?php echo printf(__('%s ago', 'uds-textdomain'), human_time_diff(get_comment_time('U'), current_time('timestamp'))); ?>
		</p>
		<div class="clear"></div>
	</div>
	<div class="comment-text">
		<?php comment_text(); ?>
	</div>
	<div class="clear"></div>
	<p class="comment-action reply"><?php comment_reply_link(array_merge(  $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])))  ?></p>
	<p class="comment-action edit"><?php edit_comment_link(__('(Edit)', 'uds-textdomain'),'','') ?></p>
	
	<div class="clear"></div>