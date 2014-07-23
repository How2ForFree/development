<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>


<?php
			global $wp_query;
			$urlTemp = get_bloginfo('template_url');
?>


	<?php if ( have_comments() ) : ?> 
	<div id="comment_wrap">
    	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/commentsvalidate.js"></script>
        <h2 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses and Counting' );?></h2>
            <?php #if ( ! empty($comments_by_type['comment']) ) : ?>  
                <ul class="commentlist parent">
                	
                	<?php foreach ($comments as $comment) : ?>
							<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">
								<?php //Necessary for special styling for author's comments
								$isByAuthor = false;
								if($comment->comment_author_email == get_the_author_email()) {
								$isByAuthor = true;
								}
								?>
								<div class="vcard">
									<?php echo get_avatar($comment, 80, $default = $urlTemp . '/images/gravatar.jpg' ); ?>
									<a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a>
									<small><?php the_date('m.d.Y') ?> <br /> <?php edit_comment_link(__('Edit')) ?></small>
								</div>
																
								<div class="comment_text">
									<?php comment_text() ?>
								</div>
							</li>
							<?php endforeach; /* end for each comment */ ?>
							
                </ul>
                
                <?php $page_links = paginate_comments_links(array(
						'type' => 'array', 'echo' => false,
						'prev_text' => __('&lsaquo; Previous', 'tarski'),
						'next_text' => __('Next &rsaquo;', 'tarski')));
					
					if ($page_links) echo '<p id="comment-paging">' . join(' &middot; ', $page_links) . '</p>';
				?>
              
            <?php #endif; ?>
          
	</div>
    <?php else : // this is displayed if there are no comments so far ?>
        <?php if ('open' == $post->comment_status) : ?>
        
        <?php else : // comments are closed ?>
         	    
        <?php endif; ?>
    
    <?php endif; ?>
    
    
    <?php if ('open' == $post->comment_status) : ?>
    <div id="respond" class="<?php if ( $user_ID ) : ?>loggedin <?php endif; ?> <?php if ( !have_comments() ) : ?>nocomments<?php endif; ?>">
    <h2>Add your comment</h2>
    <?php if (get_option('comment_registration') && !$user_ID ) : ?>
    	<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
    <?php else : ?>
    
    <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
    
    <?php if ( $user_ID ) : ?>
    
    <p class="loggedin">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a> <?php cancel_comment_reply_link(__('Cancel your reply', '')); ?></p>
	<?php else: ?>
    <p class="marginhack"><?php cancel_comment_reply_link(__('Cancel your reply', '')); ?></p>
    <?php endif; ?>
    
    <div class="w350">
    	<?php if(!$user_ID) : ?>
        <!--<span id="label_author" class="comment_label">Name</span>-->
        <input class="nicestyle" type="text" name="author" id="author" rel="<?php echo $comment_author ? $comment_author : "Name"; ?>" value="<?php echo $comment_author ? $comment_author : "Name"; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
        <?php endif; ?>
    
    	<!--<span id="label_comment" class="comment_label">Your Message</span>-->
        <textarea class="nicestyle" name="comment" id="comment" rows="10" cols="10" tabindex="3">Your message</textarea>
    </div>
    
    <div class="w350">
	<?php if ( !$user_ID ) : ?>
    	<!--<span id="label_email" class="comment_label">Email</span>-->
	    <input class="nicestyle" type="text" name="email" id="email" rel="<?php echo $comment_author_email ? $comment_author_email : "Email"; ?>" value="<?php echo $comment_author_email ? $comment_author_email : "Email"; ?>" size="42" tabindex="4" <?php if ($req) echo "aria-required='true'"; ?> />
    
    	<!--<span id="label_url" class="comment_label">Website</span>-->
        <input class="nicestyle" type="text" name="url" id="url" rel="<?php echo $comment_author_url ? $comment_author_url : "Website (URL)"; ?>" value="<?php echo $comment_author_url ? $comment_author_url : "Website (URL)"; ?>" size="42" tabindex="5" />
	<?php endif; ?>
	</div>
	
	<input name="submit" type="submit" id="submit" class="button" tabindex="5" value="<?php esc_attr_e('Submit Comment'); ?>" />
	
	<!-- <button type="submit" name="submit" class="button" id="submit">Submit</button>	-->
					
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
    
    </form>
    
    <?php endif; // If registration required and not logged in ?>
    <div class="clear"></div>
</div>
<?php endif; // if you delete this the sky will fall on your head ?> 