<div id="comments-wrapper">
<?php if(have_comments()): ?>
	<div id="comments">
		<h3><?php _e('Comments', 'uds-textdomain') ?></h3>
		<?php 
		wp_list_comments(array(
			'avatar_size'=>128,
			'style'=> 'div',
			'callback'=>'uds_comment'
		)); 
		?>
	</div>
	<div>
		<div class="align-left"><?php previous_comments_link() ?></div>
		<div class="align-right"><?php next_comments_link() ?></div>
	</div>
	<div class="clear"></div>
<?php else: ?>	
	<?php if(comments_open()): ?>
		<p class="comment-info"><?php _e('There are no comments yet', 'uds-textdomain') ?></p>
	<?php else: ?>
		<!-- <p class="comment-info">Comments are closed</p> -->
	<?php endif; ?>
<?php endif; //have comments?>		
	<hr class="comment-divider" />
<?php if(comments_open()): ?>
	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>
			<a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Log in', 'uds-textdomain') ?></a> <?php wp_register(' or ', '');?> <?php _e('to post a comment', 'uds-textdomain') ?>.
		</p>
		<?php do_action( 'comment_form_must_log_in_after' ); ?>
	<?php else : ?>
		<?php if ( is_user_logged_in() ) : ?>
			<p><?php _e('Logged in as', 'uds-textdomain') ?>
				<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. 
				<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e('Log out of this account', 'uds-textdomain') ?>"><?php _e('Log out &raquo;', 'uds-textdomain') ?></a>
			</p>
		<?php endif; ?>
		<?php do_action('comment_form_before') ?>
		<div id="respond">
			<h3><?php comment_form_title(__('Leave a comment', 'uds-textdomain'), __('Reply to %s', 'uds-textdomain')) ?></h3>
			<form method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" id="add-comment">
    			<fieldset>
    				<?php do_action( 'comment_form_top' ); ?>
    				<?php comment_id_fields(); ?>
    				<?php if( is_user_logged_in() ): ?>
						<?php global $current_user; ?>
	    				<?php wp_get_current_user(); ?>
	    				<input type="hidden" name="author" value="<?php echo $current_user->display_name ?>" />
	    				<input type="hidden" name="email" value="<?php echo $current_user->user_email ?>" />
	    				<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
   			 		<?php else: ?>
   			 			<?php do_action( 'comment_form_before_fields' ); ?>
    					<div>
    						<label><?php _e('Your name', 'uds-textdomain') ?>:</label>
    						<input type="text" class="input-text" name="author" />
    					</div>
    					<div>
    						<label><?php _e('Your email', 'uds-textdomain') ?>:</label>
    						<input type="text" class="input-text" name="email" />
   				 		</div>
   				 		<?php do_action( 'comment_form_after_fields' ); ?>
   			 		<?php endif; ?>
    				<div>
    					<label><?php _e('Comment', 'uds-textdomain') ?>:</label>
    					<textarea rows="3" cols="54" name="comment" class="comment-text" id="comment"></textarea>
    				</div>
    				<div class="buttons">
    					<button type="reset"><?php _e('Reset', 'uds-textdomain') ?></button>
    					<button type="submit"><?php _e('Submit', 'uds-textdomain') ?></button>
    					<div class="cancel-comment-reply">
						<small><?php cancel_comment_reply_link(); ?></small>
						</div>
    				</div>
    				<?php do_action('comment_form') ?>
    			</fieldset>
			</form>
		</div>
		<?php do_action( 'comment_form_after' ); ?>
	<?php endif; // If registration required and not logged in ?>
<?php else: ?>
	<?php do_action( 'comment_form_comments_closed' ); ?>
<?php endif; ?>
</div>
<div class="clear"></div>