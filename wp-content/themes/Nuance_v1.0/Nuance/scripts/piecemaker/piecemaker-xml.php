<?php
require_once( '../../../../../wp-load.php' );

$post_id = $_GET['post_id'];
$post_custom = get_post_custom($post_id);

function getAttribute($attrib, $tag){
	//get attribute from html tag
	$re = '/' . preg_quote($attrib) . '=([\'"])?((?(1).+?|[^\s>]+))(?(1)\1)/is';
	if (preg_match($re, $tag, $match)) {
		return urldecode($match[2]);
	}
	return false;
}

$subject = $post_custom['jw_slider'][0];
$height = getAttribute('height', $subject);
if(empty($height)){ $height = 250; }

$controls_y = $height - 100;

$slider_width = 960; $controls_x = 480;

header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<Piecemaker>';
	echo '<Contents>';
		
		$jw_slider_content = preg_replace('/\[slide/', '[slide_piecemaker width='.$slider_width.'', $post_custom['jw_slider'][0]);		
		$jw_slider_content = preg_replace('/\[\/slide/', '[/slide_piecemaker', $jw_slider_content);		
		echo do_shortcode($jw_slider_content);
		
	echo '</Contents>';
	echo '<Settings ImageWidth="'.$slider_width.'" ImageHeight="'.$height.'" LoaderColor="0x333333" InnerSideColor="0x222222" SideShadowAlpha="0.8" DropShadowAlpha="0.4" DropShadowDistance="25" DropShadowScale="0.95" DropShadowBlurX="40" DropShadowBlurY="4" MenuDistanceX="20" MenuDistanceY="50" MenuColor1="0x999999" MenuColor2="0x333333" MenuColor3="0xFFFFFF" ControlSize="100" ControlDistance="20" ControlColor1="0x222222" ControlColor2="0xFFFFFF" ControlAlpha="0.8" ControlAlphaOver="0.95" ControlsX="'.$controls_x.'" ControlsY="'.$controls_y.'&#xD;&#xA;" ControlsAlign="center" TooltipHeight="30" TooltipColor="0x222222" TooltipTextY="5" TooltipTextStyle="P-Italic" TooltipTextColor="0xFFFFFF" TooltipMarginLeft="5" TooltipMarginRight="7" TooltipTextSharpness="50" TooltipTextThickness="-100" InfoWidth="400" InfoBackground="0xFFFFFF" InfoBackgroundAlpha="0.95" InfoMargin="15" InfoSharpness="0" InfoThickness="0" Autoplay="10" FieldOfView="45"></Settings>';
	echo '<Transitions>';
		echo '<Transition Pieces="9" Time="1.2" Transition="easeInOutBack" Delay="0.1" DepthOffset="300" CubeDistance="30"></Transition>';
		echo '<Transition Pieces="15" Time="3" Transition="easeInOutElastic" Delay="0.03" DepthOffset="200" CubeDistance="10"></Transition>';
		echo '<Transition Pieces="5" Time="1.3" Transition="easeInOutCubic" Delay="0.1" DepthOffset="500" CubeDistance="50"></Transition>';
		echo '<Transition Pieces="9" Time="1.25" Transition="easeInOutBack" Delay="0.1" DepthOffset="900" CubeDistance="5"></Transition>';
	echo '</Transitions>';
echo '</Piecemaker>';
?>
