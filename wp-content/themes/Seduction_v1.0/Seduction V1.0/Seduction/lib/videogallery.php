<html>
<head>
	<title>Video</title>
</head>
<body>
<?php

$src = $_GET['src'];
$themeDir = $_GET['theme'];

if ( strpos($src, 'youtube.com') !== false || strpos($src, 'vimeo.com') !== false ) {
	echo <<<HTML

<object width="100%" height="100%">
	<param name="movie" value="$src"/>
	<param name="wmode" value="transparent"/>
	<embed src="$src" type="application/x-shockwave-flash" wmode="opaque" width="100%" height="100%"></embed>
</object>

HTML;

} else {
echo <<<HTML
	<object data="$themeDir/tdplayer.swf"  type="application/x-shockwave-flash"  width="100%" height="100%">
    			<param name="movie" value="$themeDir/tdplayer.swf?moviefile=$src&autoplay=0" />
				<param value="$src" name="moviefile"/>
    			<param name="wmode" value="opaque"/>
				<param value="0" name="autoplay"/>
				<param value="moviefile=$src&autoplay=0&wmode=transparent" name="flashvars"/>
    			<embed src="$themeDir/tdplayer.swf?moviefile=$src&autoplay=0" type="application/x-shockwave-flash" wmode="opaque" width="100%" height="100%"></embed>
    			</object>
HTML;
/*
	echo <<<HTML

<object data='$themeDir/tdplayer.swf' type='application/x-shockwave-flash' width='100%' height='100%'>
	<param value='$src' name='moviefile'/>
	<param value='0' name='autoplay'/>
	<param value='transparent' name='wmode'/>
	<param value='moviefile=$src&autoplay=0&wmode=transparent' name='flashvars'/>
</object>

HTML;*/
}
?>
</body>
</html>
		