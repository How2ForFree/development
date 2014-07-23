<?php
/**
 * Creates widget with flickr images
 */

class Flickr_Widget extends WP_Widget {	

/**
 * Widget constructor 
 *
 * @desc sets default options and controls for widget
 */
	function Flickr_Widget () {
		/* Widget settings */
		$widget_ops = array (
			'classname' => 'widget_flickr',
			'description' => __('Display flickr images')			
		);

		/* Create the widget */
		$this->WP_Widget('flickr-widget', __('Theme &rarr; Flickr'), $widget_ops);
	}

/**
 * Displaying the widget
 *
 * Handle the display of the widget
 * @param array
 * @param array
 */
	function widget ( $args, $instance ) {
		extract ($args);		
		/* Before widget(defined by theme) http://api.flickr.com/services/feeds/photos_public.gne?id=41068918@N05&lang=de-de&format=rss_200*/
		echo $before_widget;

		$photos = $this->getFlickrPhotosRss( $instance['rss'], $instance['number_of_images'], 0 );
		?>
		
		<?php if ( !empty( $instance['title'] ) ) : ?>		
		<h3 class="widget-title"><span class="title-wrapper"><?php echo $instance['title']; ?><span class="wd-icon"></span></span></h3>
		<?php endif; ?>
		<ul>
		<?php
    foreach ($photos as $photo) {
      ?>
      <li class="thumb">
        <a href="<?php echo $photo['url_big']; ?>" title="<?php echo $photo['title']; ?>" rel="group_flickr">
          <img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['alt']; ?>" width="<?php echo $instance['thumbnail_width']; ?>" height="<?php echo $instance['thumbnail_height']; ?>" />
        </a>  
      </li>      
      <?php
    }
    ?>
    </ul>
    <?php
		/* After widget(defined by theme)*/
		echo $after_widget;
	}		

/**
 * Get images from flickr
 *
 * @param string RSS channel
 * @param int limit
 */
  function getFlickrPhotosRss($rss, $limit) {
  	$aryPhotos = array();
  	if( file_exists(ABSPATH . WPINC . '/rss.php') ) {
  		require_once(ABSPATH . WPINC . '/rss.php');
  	} else {
  		require_once(ABSPATH . WPINC . '/rss-functions.php');
  	}	
  	
  	$aryRss = fetch_rss($rss);
  	if(is_array($aryRss->items)) {
  		$aryItems = array_slice($aryRss->items, 0, $limit );
  		$intCounter = 0;
  		while(list($strKey, $strPhoto) = each($aryItems)) {
  			preg_match_all("/<IMG.+?SRC=[\"']([^\"']+)/si",$strPhoto['description'],$aryResult, PREG_SET_ORDER);
  			$strPhotoUrl = $aryResult[0][1];
  			$strPhotoUrlBig = str_replace( "_m.jpg", "_b.jpg", $strPhotoUrl);
  			
  		  $strPhotoUrl = str_replace( "_m.jpg", "_t.jpg", $strPhotoUrl);

  
        $aryPhotos[$intCounter]['url'] = $strPhotoUrl;
        $aryPhotos[$intCounter]['url_big'] = $strPhotoUrlBig;
        $aryPhotos[$intCounter]['alt'] = esc_html($strPhoto['title']);
        $aryPhotos[$intCounter]['title'] = esc_html($strPhoto['title']);
        $aryPhotos[$intCounter]['link'] = esc_html($strPhoto['link']);
        $aryPhotos[$intCounter]['morelink'] = $aryRss->channel['link'];
        
        $intCounter++;
  		}
  	}
  	
  	return $aryPhotos;
  }
	
/**
 * Update and save widget
 *
 * @param array $new_instance
 * @param array $old_instance
 * @return array New widget values
 */
	function update ( $new_instance, $old_instance ) {
		$old_instance['title'] = strip_tags( $new_instance['title'] );
		$old_instance['number_of_images'] = $new_instance['number_of_images'];
		$old_instance['rss'] = $new_instance['rss'];
		$old_instance['thumbnail_width'] = $new_instance['thumbnail_width'];
		$old_instance['thumbnail_height'] = $new_instance['thumbnail_height'];
		
		return $old_instance;
	}
	
/**
 * Creates widget controls or settings
 *
 * @param array Return widget options form
 */
	function form ( $instance ) { ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" style="width:100%;" />
    </p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php echo __( 'RSS' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php echo $instance['rss']; ?>" class="widefat" style="width:100%;" />
    </p>
        
		<p>
			<label for="<?php echo $this->get_field_id( 'number_of_images' ); ?>"><?php echo __( 'Number of posts' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'number_of_images' ); ?>" name="<?php echo $this->get_field_name( 'number_of_images' ); ?>" value="<?php echo $instance['number_of_images']?>" size="2" />
    </p>
		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>"><?php echo __( 'Thumbnail width' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_width' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_width' ); ?>" value="<?php echo $instance['thumbnail_width']; ?>" size="3" />px
    </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>"><?php echo __( 'Thumbnail height' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'thumbnail_height' ); ?>" name="<?php echo $this->get_field_name( 'thumbnail_height' ); ?>" value="<?php echo $instance['thumbnail_height']; ?>" size="3"/>px
    </p>
		<?php
	}
	
}

register_widget( 'Flickr_Widget' );
