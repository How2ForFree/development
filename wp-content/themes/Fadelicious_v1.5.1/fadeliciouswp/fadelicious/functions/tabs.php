<?php

class fadelicious_widget_tab extends WP_Widget {

	function fadelicious_widget_tab()
	{
		parent::WP_Widget(false, 'Tabs (Fadelicious)');
	}

	function widget($args, $instance)
	{
		$args['title'] = $instance['title'];
		fade_tabs();
	}

	function update($new_instance, $old_instance)
	{
		return $new_instance;
	}

	function form($instance)
	{
		echo '<p>this widget will display the tab in the sidebar</p>';
	}

}

function fade_tabs()
{
?>


<!-- Begin Tabbed Content -->
    <div id="tab">
      <ul class="nav">
        <li><a href="#recent" class="current">Recent<span></span></a></li>
        <li><a href="#popular">Popular<span></span></a></li>
        <li><a href="#comment">Comment<span></span></a></li>
      </ul>
      <div class="list-wrap">
        <ul id="recent">
          <?php getLatestPosts(); ?>
        </ul>
        <ul id="popular" class="hide">
          <?php getTopPosts(); ?>
        </ul>
        <ul id="comment" class="hide">
           <?php getRecentComments(); ?>
        </ul>
      </div>
    </div>
    <!-- End Tabbed Content -->

<?php
}

function getTopPosts()
{
	global $wpdb;
	$request = "SELECT ID, post_title, comment_count FROM $wpdb->posts WHERE comment_count > 0 AND post_status = 'publish' order by comment_count desc LIMIT 0, 7";
	$posts = $wpdb->get_results($request);
	$output = "";
	foreach ($posts as $post) {
		$output.="<li><a href='" . get_permalink($post->ID) . "'>" . trimText($post->post_title, 35) . " <span class='gray'>($post->comment_count)</span></a></li>";
	}
	echo $output;
}

function getRecentComments($src_count=4, $src_length=75)
{
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, comment_ID, comment_post_ID, comment_author, comment_date_gmt,
			comment_content AS com_excerpt
		FROM $wpdb->comments
		LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
		WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
		ORDER BY comment_date_gmt DESC
		LIMIT $src_count";
	$comments = $wpdb->get_results($sql);
	$output = "";
	foreach ($comments as $comment) {
		if (strlen($comment->comment_author) > 11) {
			$author_min = substr($comment->comment_author, 0, 35) . '...';
		} else {
			$author_min = $comment->comment_author;
		}
		$output .= "<li><span class='element'><a class='authorcom' href='" . get_permalink($comment->comment_post_ID) . "#comment-" . $comment->comment_ID . "'>" . $author_min . "</a>: <span class='textcom'>" . substr(strip_tags($comment->com_excerpt), 0, $src_length) . "... <a href='" . get_permalink($comment->comment_post_ID) . "' class='link'> 	&raquo;</a></span></span></li>";
	}
	echo $output;
}

function getLatestPosts()
{
	if (have_posts ()) :
		$latest_posts = new WP_Query('showposts=6');
	while ($latest_posts->have_posts()) : $latest_posts->the_post();
?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
<?php
	endwhile;
	endif;
}

?>