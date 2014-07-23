<?php
//Varibles
$video_string = '';
$fancybox_type = '';
$fancybox_class = '';

//Fancybox video
if(!empty($c_post_custom['jw_portfolio_video'][0])){
	
	//Get the video url
	$video_string = $c_post_custom['jw_portfolio_video'][0];
	
	//Fancybox yotutube video
	if(strpos($video_string, 'youtube') !== false){
		
		$fancybox_type = 'video';
		$fancybox_class = 'youtube';
	
	//Fancybox vimeo video
	}else if(strpos($video_string, 'vimeo') !== false){
		
		$fancybox_type = 'video';
		$fancybox_class = 'vimeo';
	
	//None of the above
	}else{
	
		$fancybox_type = 'blank';
		$fancybox_class = 'blank';
		
	}

//Fancybox image gallery
}elseif(!empty($c_post_custom['jw_portfolio_images'][0])){
	
	$fancybox_type = 'image';
	$fancybox_class = 'image';
	
//None of the above
}else{
	
	$fancybox_type = 'blank';
	$fancybox_class = 'blank';
	
}
?>