<?php
/* To make sure the footer include knows this is a gallery */
$_SESSION['isGallery'] = true;
$_SESSION['template_url'] =  get_bloginfo('template_url') . '/';
$_SESSION['galleryInfo'] = array();

$cat = get_the_category();
$galleryCategories = get_option('_screen-galleryCategories');
$galleryCategories = explode(';', $galleryCategories);

$galleryFade = get_option('_screen-galleryFade');
$galleryFade = isset($galleryFade) ? $galleryFade : 1;

$galleryDiaInterval = get_option('_screen-galleryDiaInterval');
$galleryDiaInterval =  $galleryDiaInterval ? $galleryDiaInterval : 3;


$catIndex = 0;
foreach($galleryCategories AS $gc) {
  $catIndex++;
  if($gc == $cat[0]->cat_ID) {
    break;
  }
}


$_SESSION['galleryItems'] = $numberofitems;
$_SESSION['galleryFade'] =  $galleryFade;



$thumbnails = array();
$numberofitems = 0;
for($i = 1; have_posts(); $i++) { the_post();
  $title = get_the_title();
  $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
  $content = strip_tags(preg_replace('/[\n\r]/', '', nl2br($content)));
  if(strlen($content) > 200) {
   $content = shorten($content, 200) . '<br /><br /><a href="' . get_permalink() . '">' . trnslt('read more') . ' &raquo;</a>';
  }
  $img = get_post_meta($post->ID, '_screen-gallery-img', true);
  $video = get_post_meta($post->ID, '_screen-gallery-video', true);
  $website = get_post_meta($post->ID, '_screen-gallery-website', true);
  //new code starts here
  /*
  $_SESSION['galleryData'][$i-1]["image"] = makePathAbsolute($img);
  $_SESSION['galleryData'][$i-1]["video"] = $video;
  $_SESSION['galleryData'][$i-1]["thumbnail"] = get_bloginfo("template_directory")."img.php?f=$img"."&w=48&h=48&a=c";
  $_SESSION['galleryData'][$i-1]["website"] = $website;
  $_SESSION['galleryData'][$i-1]["content"] = $content;
  $_SESSION['galleryData'][$i-1]["js_object"] = "{ image: '".$_SESSION['galleryData'][$i-1]["image"]."'".
                                                ", video: '".$_SESSION['galleryData'][$i-1]["video"]."'".
                                                ", thumbnail: '".$_SESSION['galleryData'][$i-1]["thumbnail"]."'".
                                                ", website: '".$_SESSION['galleryData'][$i-1]["website"]."'".
                                                ", content: '".$_SESSION['galleryData'][$i-1]["content"]."'".
                                                " }";
  */
  //new code ends here
  $thumbnails[] = $img;
  $_SESSION['galleryInfo'][] = "'" . $title . "', '" . $content . "', '" . makePathAbsolute($img) . "', '" . $video . "', '" . $website . "'";
  if($i == 1) {
    $_SESSION['galleryFirst'] = array($title, $img, $video, $website);
  }
  $numberofitems = $i;
}
                                                                                                                                                            
$_SESSION['galleryDiaInterval'] =  $numberofitems;
                                                                                                                                                            
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
<?php require_once(TEMPLATEPATH . '/head.php'); ?>
</head>

<body>

  <div id="container">
    
    <?php the_post(); ?>
    <div id="gallery-holder">
      <div id="gallery">
        <div id="gallery-main">
          <div class="gallery-hide-all" title="<?php echo trnslt('Toggle fullscreen'); ?>"></div>
          <div class="gallery-toggle" title="<?php echo trnslt('Toggle gallery info'); ?>"></div>
          <div class="gallery-slideshow play" onclick="slideShowToggle()">play</div>
          
            <div class="gallery-category-position" title="<?php echo trnslt('Previous category'); ?>">
              <a href="<?php
              $catI = $catIndex - 2;
              if($catI < 0) {
                $catI = count($galleryCategories) - 1;
              }
              echo get_category_link($galleryCategories[$catI]);
              ?>" class="gallery-category-prev">&nbsp;</a>
              <span class="gallery-category-main"><?php echo $catIndex; ?>/<?php echo count($galleryCategories); ?></span>
              <a href="<?php
              $catI = $catIndex;
              if($catI > count($galleryCategories) - 1) {
                $catI = 0;
              }
              echo get_category_link($galleryCategories[$catI]);
              ?>" class="gallery-category-next" title="<?php echo trnslt('Next category'); ?>">&nbsp;</a>
            </div>
            
            <div class="gallery-category"><?php echo $cat[0]->name; ?></div>
          <div class="floatfix"></div>
          <div class="gallery-number-of-items"><?php echo $numberofitems . ' ' . trnslt('items'); ?></div>
          <div class="floatfix"></div>
          <div class="gallery-thumbnails-prev" title="<?php echo trnslt('Previous thumbnails'); ?>"></div>
          <div class="gallery-thumbnails">
            <div class="gallery-thumbnails-holder">
            <?php
            $i = 0;
            foreach($thumbnails AS $img) {
              if($img != '' && $img !== false) {
            ?>
              <img src="<?php echo $_SESSION['template_url']; ?>img.php?f=<?php echo $img; ?>&w=48&h=48&a=c" onclick="loadGalleryItem(<?php echo $i; ?>)" alt="<?php echo trnslt('View this item'); ?>" title="<?php echo trnslt('View this item'); ?>" />
            <?php
              } else {
            ?>
              <img src="<?php echo $_SESSION['template_url']; ?>images/gallery-thumb.jpg" alt="" />
            <?php
              }
              $i++;
            }
            while($i % 5 != 0) {
            ?>
              <img src="<?php echo $_SESSION['template_url']; ?>images/gallery-thumb.jpg" alt="" />
            <?php
              $i++;
            }
            ?>
            </div>
          </div>
          <div class="gallery-thumbnails-next" title="<?php echo trnslt('Next thumbnails'); ?>"></div>
          <h2><?php the_title(); ?></h2>
          <p><?php
          $content = str_replace(']]>', ']]&gt;', apply_filters('the_content', get_the_content()));
          $content = strip_tags(preg_replace('/[\n\r]/', '', nl2br($content)));
          if(strlen($content) > 200) {
           echo $content = shorten($content, 200) . '<br /><br /><a href="' . get_permalink() . '">' . trnslt('read more') . ' &raquo;</a>';
          }
          ?></p>
        </div>
      </div>
    </div>
    
  </div>
  
<?php get_header(); ?>
  
<?php get_footer(); ?>

</body>
</html>