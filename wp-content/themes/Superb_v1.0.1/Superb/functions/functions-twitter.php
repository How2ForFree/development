<?php
/**
 *	UDS Twitter Fetch
 *	Fetches last $count statuses from $user's Twitter account and returns them as an array
 *
 *	@param string $user Twitter username
 *	@param int $count How many statuses to fetch
 *
 *	@return array|WP_Error Twitter statuses or WP_Error on error
 */
function uds_twitter_fetch($user, $count = 5)
{	
	if(!function_exists('curl_init')){
		return new WP_Error('uds_twitter_curl_not_installed', __("cURL is not installed", 'uds-textdomain'));
	}
	
	$c = curl_init();
	curl_setopt($c, CURLOPT_URL, 'http://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$user.'&count='.(int)$count);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($c, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($c, CURLOPT_TIMEOUT, 5);
	$response = curl_exec($c);
	$responseInfo = curl_getinfo($c);
	curl_close($c);

	if (intval($responseInfo['http_code']) != 200) {
		if(intval($responseInfo['http_code']) == 400){
			$error = json_decode($response);
		} else {
			$error = __("Failed to retrieve tweets", 'uds-textdomain');
		}
		return new WP_Error('uds_twitter_fails', $error);
	}
 	//d($response);
	return json_decode($response);
}

/**
 *	UDS Twitter statuses
 *	Returns an array of $count Twitter statuses by $user similarly to the uds_twitter_fetch(),
 *	but also then parses the statuses replacing mentions, hashtags and URL's with actual links.
 *	This function also caches it's results using Wordpress's Transient API
 *	
 *	@param string $user Twitter username
 *	@param int $count How many statuses to fetch
 *
 *	@return array|WP_Error Twitter statuses or WP_Error on error
 */
function uds_twitter_statuses($user, $count)
{
	if(empty($user)) return new WP_Error('uds_twitter_user_empty', __('Twitter username missing', 'uds-textdomain'));
	if(!is_numeric($count) || (int)$count < 1) $count = 5;
	
	$statuses = get_transient("uds-twitter-cache-$user-$count");
	if($statuses === false || empty($statuses)) {
		$statuses = uds_twitter_fetch($user, $count);
		if($statuses !== false && !empty($statuses)){
			set_transient("uds-twitter-cache-$user-$count", $statuses, 15 * 60);
		}
	}
	
	//d($statuses);
	if(!empty($statuses)) {
		foreach($statuses as $status) {
			if(!is_object($status)) break;
			
			$description = $status->text;
			$description = preg_replace("#(^|[\n ])@([^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://www.twitter.com/\\2\" >@\\2</a>'", $description);
			$description = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1<a href=\"\\2\" >\\2</a>'", $description);
			$description = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1<a href=\"http://\\2\" >\\2</a>'", $description);
			$status->text = $description;
			$status->created_at = human_time_diff(strtotime($status->created_at));
		}
	}
		
	return $statuses;
}

?>