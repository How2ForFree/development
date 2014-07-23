<?php

/**
 *	UDS Flickr Fetch Public
 *	Fetches Flickr Photos from public feed. 
 *
 *	@see http://www.flickr.com/services/feeds/docs/photos_public/
 *	@param string $id A single user ID. This specifies a user to fetch for.
 *	@param string $ids A comma delimited list of user IDs. This specifies a list of users to fetch for.
 *	@param string $tags A comma delimited list of tags to filter the feed by.
 *	@param string $tagmode Control whether items must have ALL the tags (tagmode=all), or ANY (tagmode=any) of the tags. Default is ALL.
 *
 *	@return array|WP_Error Retrieved photos
 */
function uds_flickr_fetch_public($id = '', $ids = '', $tags = '', $tagmode = '')
{
	if(!empty($id)) $id = "&id=$id";
	if(!empty($ids)) $ids = "&ids=$ids";
	if(!empty($tags)) $tags = "&tags=$tags";
	if(!empty($tagmode)) $tagmode = "&tagmode=$tagmode";
	
	if(!empty($tagmode) && !in_array($tagmode, array('all', 'any'))) $tagmode = 'all';
	
	$url = "http://api.flickr.com/services/feeds/photos_public.gne?format=php_serial{$id}{$ids}{$tags}{$tagmode}";
	
	$photos = @file_get_contents($url);
	if(empty($photos)) {
		return new WP_Error('uds_flickr', __("Failed to download from feed", 'uds-textdomain'));
	}
	
	$photos = unserialize($photos);
	
	if(empty($photos)) {
		return new WP_Error('uds_flickr', __("Failed to download from feed", 'uds-textdomain'));
	}
	
	return $photos;
}

/**
 *	UDS Flickr Public
 *	Transients fetched Flickr Photos from public feed. 
 *
 *	@see http://www.flickr.com/services/feeds/docs/photos_public/
 *	@param string $id A single user ID. This specifies a user to fetch for.
 *	@param string $ids A comma delimited list of user IDs. This specifies a list of users to fetch for.
 *	@param string $tags A comma delimited list of tags to filter the feed by.
 *	@param string $tagmode Control whether items must have ALL the tags (tagmode=all), or ANY (tagmode=any) of the tags. Default is ALL.
 *
 *	@return array|WP_Error Retrieved photos
 */
function uds_flickr_public($id = '', $ids = '', $tags = '', $tagmode = '')
{
	$photos = get_transient("uds-flickr-public-cache-$id-$ids-$tags-$tagmode");
	if(false === $photos || empty($photos) || !is_array($photos)) {
		$photos = uds_flickr_fetch_public($id, $ids, $tags, $tagmode);
		if(!is_wp_error($photos) && !empty($photos) && is_array($photos)) {
			set_transient("uds-flickr-public-cache-$id-$ids-$tags-$tagmode", $photos, 15 * 60);
		}
	}
	
	return $photos;
}

?>