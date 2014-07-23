<?php
/* Update Grace field */
function updateGraceField($post_id, $field) {
  $current_data = get_post_meta($post_id, $field, true);
	$new_data = $_POST[$field];
	
  if($current_data !== false) {
    if($new_data == '') {
    	delete_post_meta($post_id, $field);
    } elseif ($new_data != $current_data) {
    	update_post_meta($post_id, $field, $new_data);
    }
  }	elseif($new_data != '') {
  	add_post_meta($post_id, $field, $new_data, true);
  }
}

/* Update Grace options */
function graceUpdateOptions($post_id) {
  /* Update fields */
  $optionFields = array('_grace-videoW', '_grace-videoH', '_grace-vimeo', '_grace-youtube', '_grace-custom', '_grace-autoplay', '_grace-showGrace', '_grace-slideW', '_grace-slideH', '_grace-slideTime', '_grace-showSlides', '_grace-showTimer');
  foreach($optionFields AS $m) {
    updateGraceField($post_id, $m);
	}
	
	/* Remove old slides */
	for($i = 1; get_post_meta($post_id, '_grace-type_' . $i, true); $i++) {
		delete_post_meta($post_id, '_grace-type_' . $i);
	  delete_post_meta($post_id, '_grace-img_' . $i);
	  delete_post_meta($post_id, '_grace-nr_' . $i);
	  delete_post_meta($post_id, '_grace-delay_' . $i);
	  delete_post_meta($post_id, '_grace-time_' . $i);
	  delete_post_meta($post_id, '_grace-easing_' . $i);
	  delete_post_meta($post_id, '_grace-invert_' . $i);
	  delete_post_meta($post_id, '_grace-directionx_' . $i);
	  delete_post_meta($post_id, '_grace-directiony_' . $i);
	  delete_post_meta($post_id, '_grace-fade_' . $i);
	  delete_post_meta($post_id, '_grace-title_' . $i);
	  delete_post_meta($post_id, '_grace-text_' . $i);
	  delete_post_meta($post_id, '_grace-link_' . $i);
	}
	
	/* Save new slides */
  for($i = 1; isset($_POST['_grace-type_' . $i]); $i++) {
    updateGraceField($post_id, '_grace-type_' . $i);
    updateGraceField($post_id, '_grace-img_' . $i);
    if($_POST['_grace-nr_' . $i] > 100) { $_POST['_grace-nr_' . $i] = 100; }
    updateGraceField($post_id, '_grace-nr_' . $i);
    updateGraceField($post_id, '_grace-delay_' . $i);
    updateGraceField($post_id, '_grace-time_' . $i);
    updateGraceField($post_id, '_grace-easing_' . $i);
    updateGraceField($post_id, '_grace-invert_' . $i);
    updateGraceField($post_id, '_grace-directionx_' . $i);
    updateGraceField($post_id, '_grace-directiony_' . $i);
    updateGraceField($post_id, '_grace-fade_' . $i);
    updateGraceField($post_id, '_grace-title_' . $i);
    $_POST['_grace-text_' . $i] = shorten($_POST['_grace-text_' . $i], 250);
    updateGraceField($post_id, '_grace-text_' . $i);
    $_POST['_grace-link_' . $i] = checkLinkForHttp($_POST['_grace-link_' . $i]);
	  updateGraceField($post_id, '_grace-link_' . $i);
	}
}

/* Display Grace options */
function placeGraceOptions() {
  global $post, $jQueryLoaded;
  
  /* General options */
  $showGrace = get_post_meta($post->ID, '_grace-showGrace', true);
  $slideW = 960; //get_post_meta($post->ID, '_grace-slideW', true);
  $slideH = get_post_meta($post->ID, '_grace-slideH', true);
  $slideTime = get_post_meta($post->ID, '_grace-slideTime', true);
  $showSlides = get_post_meta($post->ID, '_grace-showSlides', true);
  $showTimer = get_post_meta($post->ID, '_grace-showTimer', true);
	?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/grace.css" type="text/css" media="screen" />
<div class="grace-showGrace_div">
    <div class="grace-showGrace_title">
        Grace this page:
    </div>
    <div class="grace-showGrace_select">
        <select id="grace-showGrace" name="_grace-showGrace" onchange="showGraceFields();"><option value="false"<?php
          if($showGrace == "false") { echo " selected"; }
          ?>>no</option><option<?php
          if($showGrace == "slides") { echo " selected"; }
          ?>>slides</option><option<?php
          if($showGrace == "video") { echo " selected"; }
          ?>>video</option>
        </select>
    </div>
</div>

<?php /*
  <table cellpadding="0" cellspacing="5">
    <tr>
      <td width="150">Grace this page:</td>
      <td><select id="grace-showGrace" name="_grace-showGrace" onchange="showGraceFields();"><option value="false"<?php
      if($showGrace == "false") { echo " selected"; }
      ?>>no</option><option<?php
      if($showGrace == "slides") { echo " selected"; }
      ?>>slides</option><option<?php
      if($showGrace == "video") { echo " selected"; }
      ?>>video</option></select></td>
    </tr>
  </table>
 */
  ?>
    <div id="grace-slides-options"<?php
  /* Grace slide options */
  if($showGrace != 'slides') { echo ' style="display:none;"'; }
  ?>>

        <div class="slides_div">
            <div class="slides_div_title">Slides options</div>
            <div class="slide_options_block">
                <div class="slide_options">Slide width:</div>
                <div class="options_values"><input type="text" id="grace-slideW" name="_grace-slideW" value="<?php echo $slideW; ?>" style="width:70px;" readonly /> px</div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Slide height:</div>
                <div class="options_values"><input type="text" id="grace-slideH" name="_grace-slideH" value="<?php echo $slideH; ?>" style="width:70px;" /> px</div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Time between slides:</div>
                <div class="options_values"><input type="text" id="grace-slideTime" name="_grace-slideTime" value="<?php echo $slideTime; ?>" style="width:70px;" /> ms</div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Show slides:</div>
                <div class="options_values">
                    <select id="grace-showSlides" name="_grace-showSlides"><option value="thumbnails"<?php
                      if($showSlides == "thumbnails") { echo " selected"; }
                      ?>>as thumbnails</option><option value="squares"<?php
                      if($showSlides == "squares") { echo " selected"; }
                      ?>>as squares</option><option value="false"<?php
                      if($showSlides == "false") { echo " selected"; }
                      ?>>no</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Show time indicator:</div>
                <div class="options_values">
                    <select id="grace-showTimer" name="_grace-showTimer"><option value="true"<?php
                      if($showTimer == "true") { echo " selected"; }
                      ?>>yes</option><option value="false"<?php
                      if($showTimer == "false") { echo " selected"; }
                      ?>>no</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Select slide to edit:</div>
                <div class="options_values">
                    <select id="grace-slides" name="grace-slides" onchange="toggleGraceSlide();">
                      <?php
                      $i = 1;
                      while(get_post_meta($post->ID, '_grace-type_' . $i, true)) {
                        echo '<option value="' . $i . '">Slide #' . $i . '</option>';
                        $i++;
                      }
                      ?>
                    </select>
                </div>
            </div>
            <div class="slide_options_block">
                <input type="button" id="grace-addNewSlide" name="grace-addNewSlide" value="Add new slide" />
            </div>
        </div>
  
  <div id="grace-slidetables">
  <?php
  /* Slide options */
$i = 0;
while($i == 0 || get_post_meta($post->ID, '_grace-type_' . $i, true)) {
  $type = $img = $nr = $delay = $time = $easing = $invert = $directionx = $directiony = $fade = $title = $text = $hide = '';
  if($i > 0) {
    $type = get_post_meta($post->ID, '_grace-type_' . $i, true);
    $img = get_post_meta($post->ID, '_grace-img_' . $i, true);
    $nr = get_post_meta($post->ID, '_grace-nr_' . $i, true);
    $delay = get_post_meta($post->ID, '_grace-delay_' . $i, true);
    $time = get_post_meta($post->ID, '_grace-time_' . $i, true);
    $easing = get_post_meta($post->ID, '_grace-easing_' . $i, true);
    $invert = get_post_meta($post->ID, '_grace-invert_' . $i, true);
    $directionx = get_post_meta($post->ID, '_grace-directionx_' . $i, true);
    $directiony = get_post_meta($post->ID, '_grace-directiony_' . $i, true);
    $fade = get_post_meta($post->ID, '_grace-fade_' . $i, true);
    $title = get_post_meta($post->ID, '_grace-title_' . $i, true);
    $text = get_post_meta($post->ID, '_grace-text_' . $i, true);
    $link = get_post_meta($post->ID, '_grace-link_' . $i, true);
  } 
  if($i != 1) {
    $hide = ' display:none;"';
  }
  ?>
        <div class="slides_div" style="<?php echo $hide;?>" id="grace-slidetable_<?php echo $i; ?>">
            <div class="slides_div_title">Slide #<span id="grace-slide-number"><?php echo $i; ?></span></div>
            <div class="slides_div_title"><input type="button" id="grace-removeSlide_<?php echo $i; ?>" name="grace-removeSlide_<?php echo $i; ?>" value="Remove this slide" /></div>
            <div class="slide_options_block">
                <div class="slide_options">Transition type:</div>
                <div class="options_values">
                    <select id="grace-type_<?php echo $i; ?>" name="_grace-type_<?php echo $i; ?>" onchange="updateGraceFields(this.id);"><option value="vertical"<?php
                      if($type == "vertical") { echo " selected"; }
                      ?>>Move vertical</option><option value="horizontal"<?php
                      if($type == "horizontal") { echo " selected"; }
                      ?>>Move horizontal</option><option value="fade"<?php
                      if($type == "fade") { echo " selected"; }
                      ?>>Fade in</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Image:</div>
                <div class="options_values"><input type="text" id="grace-img_<?php echo $i; ?>" name="_grace-img_<?php echo $i; ?>" value="<?php echo $img; ?>" style="width:350px; margin:0 0 5px 0;" /><br /><span style="color:#999; font-size:10px;">Enter the full URL of your slide image (e.g. http://www.yoursite.com/images/slide.jpg)</span></div>
            </div>
            <div class="slide_options_block" id="grace-tr-nr_<?php echo $i; ?>">
                <div class="slide_options">Number of slices:</div>
                <div class="options_values"><input type="text" id="grace-nr_<?php echo $i; ?>" name="_grace-nr_<?php echo $i; ?>" value="<?php echo $nr; ?>" style="width:70px;"/><span style="color:#999; margin:5px 0 0 5px;">max. 50</span></div>
            </div>
            
            <div class="slide_options_block" id="grace-tr-delay_<?php echo $i; ?>">
                <div class="slide_options">Delay between slices:</div>
                <div class="options_values"><input type="text" id="grace-delay_<?php echo $i; ?>" name="_grace-delay_<?php echo $i; ?>" value="<?php echo $delay; ?>" style="width:70px;" /> ms</div>
            </div>
            
            <div class="slide_options_block">
                <div class="slide_options">Transition time:</div>
                <div class="options_values">
                    <input type="text" id="grace-time_<?php echo $i; ?>" name="_grace-time_<?php echo $i; ?>" value="<?php echo $time; ?>" style="width:70px; margin:0 0 5px 0;" /> ms<br />
                    <div style="margin-left:150px;color:#999; font-size:10px; line-height:16px;">
                        For a smooth animation, make sure the time between slides exceeds the number of slices times the
                        <br />
                        delay per slice, plus the slice transition time.
                        <br /> (e.g. 10 slices x (50 ms delay + 450 ms transition time) = a minimum of 5000 ms time between slides.
                    </div>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Transition easing:</div>
                <div class="options_values">
                    <select id="grace-easing_<?php echo $i; ?>" name="_grace-easing_<?php echo $i; ?>"><option<?php
                      if($easing == "linear") { echo " selected"; }
                      ?>>linear</option><option<?php
                      if($easing == "easeInCubic") { echo " selected"; }
                      ?>>easeInCubic</option><option<?php
                      if($easing == "easeOutCubic") { echo " selected"; }
                      ?>>easeOutCubic</option><option<?php
                      if($easing == "easeInExpo") { echo " selected"; }
                      ?>>easeInExpo</option><option<?php
                      if($easing == "easeOutExpo") { echo " selected"; }
                      ?>>easeOutExpo</option><option<?php
                      if($easing == "easeInElastic") { echo " selected"; }
                      ?>>easeInElastic</option><option<?php
                      if($easing == "easeOutElastic") { echo " selected"; }
                      ?>>easeOutElastic</option><option<?php
                      if($easing == "easeInBack") { echo " selected"; }
                      ?>>easeInBack</option><option<?php
                      if($easing == "easeOutBack") { echo " selected"; }
                      ?>>easeOutBack</option><option<?php
                      if($easing == "easeInBounce") { echo " selected"; }
                      ?>>easeInBounce</option><option<?php
                      if($easing == "easeOutBounce") { echo " selected"; }
                      ?>>easeOutBounce</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block" id="grace-tr-invert_<?php echo $i; ?>">
                <div class="slide_options">Invert <span id="grace-labelx-invert_<?php echo $i; ?>" style="display:none;">x</span><span id="grace-labely-invert_<?php echo $i; ?>">y</span>-axis:</div>
                <div class="options_values">
                    <select id="grace-invert_<?php echo $i; ?>" name="_grace-invert_<?php echo $i; ?>"><option value="false"<?php
                      if($invert == "false") { echo " selected"; }
                      ?>>no</option><option value="true"<?php
                      if($invert == "true") { echo " selected"; }
                      ?>>yes</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block" id="grace-tr-direction_<?php echo $i; ?>">
                <div class="slide_options">Transition direction:</div>
                <div class="options_values">
                    <select id="grace-directionx_<?php echo $i; ?>" name="_grace-directionx_<?php echo $i; ?>"><option value="fromleft"<?php
                      if($directionx == "fromleft") { echo " selected"; }
                      ?>>From left</option><option value="fromright"<?php
                      if($directionx == "fromright") { echo " selected"; }
                      ?>>From right</option><option value="frommiddle"<?php
                      if($directionx == "frommiddle") { echo " selected"; }
                      ?>>From middle</option><option value="tomiddle"<?php
                      if($directionx == "tomiddle") { echo " selected"; }
                      ?>>To middle</option><option value="random"<?php
                      if($directionx == "random") { echo " selected"; }
                      ?>>Random</option>
                    </select>
                    <select id="grace-directiony_<?php echo $i; ?>" name="_grace-directiony_<?php echo $i; ?>" style="display:none;"><option value="fromtop"<?php
                      if($directiony == "fromtop") { echo " selected"; }
                      ?>>From top</option><option value="frombottom"<?php
                      if($directiony == "frombottom") { echo " selected"; }
                      ?>>From bottom</option><option value="frommiddle"<?php
                      if($directiony == "frommiddle") { echo " selected"; }
                      ?>>From middle</option><option value="tomiddle"<?php
                      if($directiony == "tomiddle") { echo " selected"; }
                      ?>>To middle</option><option value="random"<?php
                      if($directiony == "random") { echo " selected"; }
                      ?>>Random</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block" id="grace-tr-fade_<?php echo $i; ?>">
                <div class="slide_options">Fade in slices:</div>
                <div class="options_values">
                    <select id="grace-fade_<?php echo $i; ?>" name="_grace-fade_<?php echo $i; ?>"><option value="true"<?php
                      if($fade == "true") { echo " selected"; }
                      ?>>yes</option><option value="false"<?php
                      if($fade == "false") { echo " selected"; }
                      ?>>no</option>
                    </select>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Overlay title: <span style="color:#ccc;">(optional)</span></div>
                <div class="options_values"><input type="text" id="grace-title_<?php echo $i; ?>" name="_grace-title_<?php echo $i; ?>" value="<?php echo $title; ?>" style="width:350px;" /></div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Overlay text: <span style="color:#ccc; line-height:18px;">(optional)</span></div>
                <div class="options_values">
                    <textarea class="td-panel" id="grace-text_<?php echo $i; ?>" name="_grace-text_<?php echo $i; ?>" style="height:120px; width:350px;"><?php echo $text; ?></textarea>
                    <div style="color:#999; margin:5px 0 0 150px;">
                        <strong id="grace-text_<?php echo $i; ?>-count">250</strong> characters left
                    </div>
                </div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Overlay link: <span style="color:#ccc;">(optional)</span></div>
                <div class="options_values"><input type="text" id="grace-link_<?php echo $i; ?>" name="_grace-link_<?php echo $i; ?>" value="<?php echo $link; ?>" style="width:350px;" /></div>
            </div>
        </div>
<?php $i++;
    }
  ?>
  </div>
  </div><?php
  /* Grace video options */
  $videoW = 960; //get_post_meta($post->ID, '_grace-videoW', true);
  $videoH = get_post_meta($post->ID, '_grace-videoH', true);
  $vimeo = get_post_meta($post->ID, '_grace-vimeo', true);
  $youtube = get_post_meta($post->ID, '_grace-youtube', true);
  $custom = get_post_meta($post->ID, '_grace-custom', true);
  $autoplay = get_post_meta($post->ID, '_grace-autoplay', true);
  ?><div id="grace-video-options"<?php
  if($showGrace != 'video') { echo ' style="display:none;"'; }
  ?>>


      <div class="slides_div">
            <div class="slides_div_title">Video options</div>
            <div class="slide_options_block">
                <div class="slide_options">Video width:</div>
                <div class="options_values"><input type="text" id="grace-videoW" name="_grace-videoW" value="<?php echo $videoW; ?>" style="width:70px;" readonly /> px</div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Video height:</div>
                <div class="options_values"><input type="text" id="grace-videoH" name="_grace-videoH" value="<?php echo $videoH; ?>" style="width:70px;" /> px</div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Vimeo:</div>
                <div class="options_values">www.vimeo.com/<br/><input type="text" id="grace-vimeo" name="_grace-vimeo" value="<?php echo $vimeo; ?>" style="width:240px;" /></div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">YouTube:</div>
                <div class="options_values">www.youtube.com/watch?v=<input type="text" id="grace-youtube" name="_grace-youtube" value="<?php echo $youtube; ?>" style="width:168px;" /></div>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Custom:</div>
                <div class="options_values"><input type="text" id="grace-custom" name="_grace-custom" value="<?php echo $custom; ?>" style="width:350px;" /><br />
                    <div style="margin-left:150px;color:#999; font-size:10px; line-height:14px;">Enter the full URL of your background video<br />(e.g. http://www.yoursite.com/videos/video.flv)<br />Supported file types: flv, f4v, mp4, mov</div></div>
                <script type="text/javascript">
                        jQuery('#grace-vimeo').blur(checkGraceVideoHeight);
                        jQuery('#grace-youtube').blur(checkGraceVideoHeight);
                        jQuery('#grace-custom').blur(checkGraceVideoHeight);

                        function checkGraceVideoHeight(){
                                if( this.value == '' ) return;

                                var hInput = jQuery('#grace-videoH');

                                var width  = jQuery('#grace-videoW').val();
                                var height = hInput.val();
                                if( height == '' ) {
                                        alert('Enter the height of the video');
                                        hInput.animate({"background-color": 'red'}, 500, function() {jQuery('#grace-videoH').animate({"background-color": 'white'}, 500);});
                                        hInput.focus();
                                } else if( height < (width * 8 / 16) ) {
                                        if( confirm('Height of the video is too small.\nDo you want to change this value?') ) {
                                                //hInput.val( width * 8 / 16 );
                                                hInput.animate({"background-color": 'red'}, 500, function() {jQuery('#grace-videoH').animate({"background-color": 'white'}, 500);});
                                                hInput.focus();
                                        }
                                }
                        }
                </script>
            </div>
            <div class="slide_options_block">
                <div class="slide_options">Autoplay:</div>
                <div class="options_values">
                    <select id="grace-autoplay" name="_grace-autoplay"><option value="false"<?php
                      if($autoplay == "false") { echo " selected"; }
                      ?>>no</option><option value="true"<?php
                      if($autoplay == "true") { echo " selected"; }
                      ?>>yes</option>
                    </select>
                </div>
            </div>
        </div>
  </div>
  <?php
  /* Check whether jQuery was already loaded */
  if(!isset($jQueryLoaded) || !$jQueryLoaded) { ?><script type="text/javascript" src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-1.4.2.min.js"></script><?php }
  ?>
  <script type="text/javascript">
    var nrOfSlides = <?php echo ($i - 1); ?>;
    jQuery(document).ready(function() {
      jQuery('#grace-addNewSlide').css('cursor', 'pointer');
      jQuery('#grace-addNewSlide').click(addNewGraceSlide);
      for(var i = 1; i <= nrOfSlides; i++) {
        jQuery('#grace-removeSlide_' + i).css('cursor', 'pointer');
        jQuery('#grace-removeSlide_' + i).click(function() { removeGraceSlide(this.id); jQuery(this).unbind('click'); });
        if(jQuery('#grace-type_' + i).val() == 'fade') {
          jQuery('#grace-tr-nr_' + i).fadeOut(200);
          jQuery('#grace-tr-delay_' + i).fadeOut(200);
          jQuery('#grace-tr-invert_' + i).fadeOut(200);
          jQuery('#grace-tr-direction_' + i).fadeOut(200);
          jQuery('#grace-tr-fade_' + i).fadeOut(200);
        }
        jQuery('#grace-text_' + i).keyup(function() { updateGraceCharCounter('#' + jQuery(this).attr('id'), 250); } );
        updateGraceCharCounter('#grace-text_' + i, 250);
      }
    });
    function updateGraceCharCounter(id, max) {
      var l = max - jQuery(id).val().length;
      var c = '';
      if(l < 10) {
        c = '#be0000';
      } else if(l < 25) {
        c = '#ac4c4c';
      } else {
        c = '#999';
      }
      jQuery(id + '-count').html(l).css('color', c);
    }
    function showGraceFields() {
      switch(jQuery('#grace-showGrace').val()) {
        case 'slides':
          jQuery('#grace-video-options').fadeOut(200);
          jQuery('#grace-slides-options').fadeIn();
          break;
        case 'video':
          jQuery('#grace-slides-options').fadeOut(200);
          jQuery('#grace-video-options').fadeIn();
          break;
        default:
          jQuery('#grace-slides-options').fadeOut(200);
          jQuery('#grace-video-options').fadeOut(200);
          break;
      }
    }
    function removeGraceSlide(id) {
      var i = Number(id.replace('grace-removeSlide_', ''));
      jQuery('#grace-slidetable_' + i).animate({'opacity':0}, {queue:false, duration:600, complete:function() {
        jQuery(this).remove();
        jQuery('#grace-slides option[value="' + nrOfSlides + '"]').remove();
        jQuery('#grace-slides').val(1);
        nrOfSlides--;
        toggleGraceSlide();
      }});
      for(var j = (i + 1); j <= nrOfSlides; j++) {
        var obj = document.getElementById('grace-slidetable_' + j);
        fixGraceSlideNumber(obj, j, (j - 1));
      }
    }
    function fixGraceSlideNumber(node, oldI, newI) {
      var n = node.name;
      if(n) {
        node.setAttribute('name', n.replace('_' + oldI, '_' + newI));
      }
      var id = node.id;
      if(id) {
        node.setAttribute('id', id.replace('_' + oldI, '_' + newI));
        if(id == 'grace-slide-number') {
          node.innerHTML = newI;
        }
      }
      if(node.hasChildNodes()) {
        for(var j = 0; j < node.childNodes.length && node.childNodes[j] != undefined; j++) {
          fixGraceSlideNumber(node.childNodes[j], oldI, newI);
        }
      }
    };
    function addNewGraceSlide() {
      if(jQuery('#grace-slidetable_0').length > 0) {
        nrOfSlides++
        jQuery('#grace-slidetable_0').clone().appendTo('#grace-slidetables').css('display', '').attr('id', 'grace-slidetable_' + nrOfSlides);
		
		try{setAllSelectEventHandlers();}catch(err){}
		
        fixGraceSlideNumber(document.getElementById('grace-slidetable_' + nrOfSlides), 0, nrOfSlides);
        jQuery('#grace-slides').append('<option value="' + nrOfSlides + '">Slide #' + nrOfSlides + '</option>');
        jQuery('#grace-slides').val(nrOfSlides);
        toggleGraceSlide();
        for(var i = 1; i <= nrOfSlides; i++) {
          jQuery('#grace-removeSlide_' + i).css('cursor', 'pointer');
          jQuery('#grace-removeSlide_' + i).click(function() { removeGraceSlide(this.id); });
        }
      }
    };
    function toggleGraceSlide() {
      for(var i = 1; i <= nrOfSlides; i++) {
        jQuery('#grace-slidetable_' + i).css('display', 'none');
      }
      jQuery('#grace-slidetable_' + jQuery('#grace-slides').val()).css('display', 'block');
    }
    function updateGraceFields(id) {
      var i = id.replace('grace-type_', '');
      switch(jQuery('#grace-type_' + i).val()) {
        case 'vertical':
          jQuery('#grace-labelx-invert_' + i).hide();
          jQuery('#grace-labely-invert_' + i).show();
          jQuery('#grace-directionx_' + i).show();
          jQuery('#grace-directiony_' + i).hide();
          
          jQuery('#grace-tr-nr_' + i).fadeIn();
          jQuery('#grace-tr-delay_' + i).fadeIn();
          jQuery('#grace-tr-invert_' + i).fadeIn();
          jQuery('#grace-tr-direction_' + i).fadeIn();
          jQuery('#grace-tr-fade_' + i).fadeIn();
          break;
        case 'horizontal':
          jQuery('#grace-labelx-invert_' + i).show();
          jQuery('#grace-labely-invert_' + i).hide();
          jQuery('#grace-directionx_' + i).hide();
          jQuery('#grace-directiony_' + i).show();
          
          jQuery('#grace-tr-nr_' + i).fadeIn();
          jQuery('#grace-tr-delay_' + i).fadeIn();
          jQuery('#grace-tr-invert_' + i).fadeIn();
          jQuery('#grace-tr-direction_' + i).fadeIn();
          jQuery('#grace-tr-fade_' + i).fadeIn();
          break;
        case 'fade':
          jQuery('#grace-tr-nr_' + i).fadeOut(200);
          jQuery('#grace-tr-delay_' + i).fadeOut(200);
          jQuery('#grace-tr-invert_' + i).fadeOut(200);
          jQuery('#grace-tr-direction_' + i).fadeOut(200);
          jQuery('#grace-tr-fade_' + i).fadeOut(200);
          break;
      }
    }
  </script>
  <?php
}
?>