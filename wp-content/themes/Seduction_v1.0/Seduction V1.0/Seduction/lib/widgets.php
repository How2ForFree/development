<?php
/* Register custom sidebars */
if(function_exists('register_sidebar')) {
  /* Sidebars */
  $sidebars = get_option('_screen-sidebars');
  if(is_string($sidebars)) {
    $sidebars = unserialize($sidebars);
  } else {
    $sidebars = array();
  }
  if($sidebars) {
    foreach($sidebars AS $sb) {
      register_sidebar(array('name' => 'S: ' . $sb, 'id' => 'theme-dutch-sidebar-' . $sb, 'before_widget' => '', 'after_widget' => '', 'before_title' => '<h3>', 'after_title' => '</h3>'));
    }
  }
  
  /* Footer sidebars */
  $footersidebars = get_option('_screen-footersidebars');
  if(is_string($footersidebars)) {
    $footersidebars = unserialize($footersidebars);
  } else {
    $footersidebars = array();
  }
  if($footersidebars) {
    foreach($footersidebars AS $f) {
      register_sidebar(array('name' => 'F: ' . $f, 'id' => 'theme-dutch-footersidebar-' . $f, 'before_widget' => '<div class="widget">', 'after_widget' => '</div>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
    }
  }
}
add_filter('widget_text', 'do_shortcode');
?>