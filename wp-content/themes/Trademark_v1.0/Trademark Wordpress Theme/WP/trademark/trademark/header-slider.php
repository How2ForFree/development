<?php 
/* Get page ID */
$queried_object = $wp_query->get_queried_object(); 
if ( $queried_object->ID == get_option( 'page_for_posts' ) ) {
    $current_id = get_option( 'page_for_posts' ); 
}
else { 
    $current_id = $wp_query->post->ID; 
}

/* Slider type*/
$style = get_post_meta( $current_id, 'slider_style' ); 
/* Get all info about slider */
$slides = array();
for ($i = 1; $i <= 5; $i++) {
    /* Image URL */
    $url = get_post_meta( $current_id, 'slider_image_name_' . $i );
    if ( isset( $url['0'] ) )
        $slides[$i]['name'] = $url['0'];    
        
    /* Image link */
    $link = get_post_meta( $current_id, 'slider_image_desc_' . $i );
    if ( isset( $link['0'] ) )
        $slides[$i]['desc'] = $link['0'];    

    /* Image link */
    $link = get_post_meta( $current_id, 'slider_image_link_' . $i );
    if ( isset( $link['0'] ) )
        $slides[$i]['link'] = $link['0'];
                
    /* Image description */
    $desc = get_post_meta( $current_id, 'slider_image_url_' . $i );
    if ( isset( $desc['0'] ) )
        $slides[$i]['url'] = $desc['0'];

    /* Description short */
    $desc = get_post_meta( $current_id, 'slider_image_desc_small_' . $i );
    if ( isset( $desc['0'] ) )
        $slides[$i]['desc_small'] = $desc['0'];        
        
    /* Icon */
    $desc = get_post_meta( $current_id, 'slider_image_icon_' . $i );
    if ( isset( $desc['0'] ) )
        $slides[$i]['icon'] = $desc['0'];             
}
//if (!sizeof($slides)) return;

if ( isset( $_GET['slider'] ) ) $style['0'] = $_GET['slider'];
?>

<?php if ( $style['0'] == 'promote' ) : ?>
	<?php if ( is_single() || is_page() || ($queried_object->ID == get_option( 'page_for_posts' ) ) || is_front_page() ): ?>
		<!-- PROMOTE -->
		<div id="slider" class="promote clearfix">
			<ul id="feature-list-tabs">
				<?php foreach ( $slides as $key => $slide ) : ?>
				<li>
						<span class="icon">
							<?php if ( !empty( $slide['link'] ) ) : ?><a href="<?php echo $slide['link']; ?>"><?php endif;?>
								<img src="<?php echo link_to( $slide['icon'] ); ?>" alt="<?php echo $slide['title']; ?>" title="<?php echo $slide['desc_long']; ?>"/>
							<?php if ( !empty( $slide['link'] ) ) : ?></a><?php endif;?>
						</span><!-- /.icon -->
						
						<div class="text">    
							<h3><a href="<?php echo $slide['link']; ?>"><?php echo $slide['name']; ?></a></h3>
							
							<p><?php echo $slide['desc_small']; ?></p>
						</div>
				</li>
				<?php endforeach; ?>                  
			</ul>        
			
			<ul id="feature-list-output">
				<?php foreach ( $slides as $key => $slide ) : ?>
					<li>
						<?php if ( !empty( $slide['link'] ) ) :  ?>
						  <a href="<?php echo $slide['link']; ?>">
						<?php endif; ?>                      
						<img src="<?php echo link_to(($slide['url'])); ?>" alt="<?php echo $slide['name']; ?>" title="<?php echo htmlentities($slide['name']); ?>" />
						<span class="description" style="display:none;"><?php echo htmlentities($slide['desc']); ?></span>
						
						<?php if ( !empty( $slide['link'] ) ) :  ?>
							</a>
						<?php endif; ?>
					</li>           
				<?php endforeach; ?>       
			</ul>
			
			<div id="feature-list-nav">
			</div>
			<script type="text/javascript">    
				<?php $effect = get_post_meta( $current_id, 'slider_cycle_effect' ); ?>
				<?php $timeout = get_post_meta( $current_id, 'slider_cycle_timeout' ); ?>
				<?php $speed = get_post_meta( $current_id, 'slider_cycle_speed' ); ?>
				<?php $delay = get_post_meta( $current_id, 'slider_cycle_delay' ); ?>
				$j(document).ready(function() {
				  $j('#feature-list-output').cycle({
					<?php if (!empty($effect['0'])): ?>fx: '<?php echo $effect['0']; ?>', <?php endif; ?>
					<?php if (!empty($timeout['0'])): ?>timeout: '<?php echo $timeout['0']; ?>', <?php endif; ?>
					<?php if (!empty($speed['0'])): ?>timeout: '<?php echo $speed['0']; ?>', <?php endif; ?>
					<?php if (!empty($delay['0'])): ?>timeout: '<?php echo $delay['0']; ?>', <?php endif; ?>
					prev:   '#arrows .prev',
					next:   '#arrows .next',
					pager:  '#feature-list-nav',
					before: function(currSlideElement, nextSlideElement, options, forwardFlag) {
							  var title = $j(nextSlideElement).find('.description').text();
							  $j('#descriptions').empty().html(title);
							}
				  });
				  
				  
				});
			</script>
		</div><!-- /#slider -->
		
		<div id="toolbar">
			<div id="arrows">
				<div class="prev"></div>
				<div class="next"></div>
			</div><!-- /#arrows -->

			<div id="descriptions">
				  <?php echo $slides['1']['desc']; ?>
			</div><!-- /#descriptions -->
			
			<?php get_search_form(); ?>
		</div><!-- /#toolbar --> 
    <?php else: ?>
	   <div id="toolbar">
        <div id="home">
          <a href="<?php echo home_url(); ?>">
          </a>
        </div><!-- /#home -->

        <?php if (function_exists('yoast_breadcrumb') && ( is_page() || is_single() || have_posts() ) && ( !is_front_page()) ): ?>
            <div id="breadcrumb">
                    <?php yoast_breadcrumb('', '', true ); ?>
            </div><!-- /.breadcrumb -->
        <?php endif; ?>
        
        <?php get_search_form(); ?>
		</div><!-- /#toolbar -->
	<?php endif; ?>   
<?php elseif ( $style['0'] == 'cycle' ) : ?>
	<?php if ( is_single() || is_page() || ($queried_object->ID == get_option( 'page_for_posts' ) ) || is_front_page() ): ?>
		<?php 
		$first = $_SERVER["DOCUMENT_ROOT"]."/".$slides[1]['url']; 
		if (file_exists($first)) { 
			if (is_readable($first)) { @$size = getimagesize($first); }
		} else { 
			$first = dirname(__FILE__)."/../../../".$slides[1]['url']; 
			if (file_exists($first)) { 
					if (is_readable($first)) { @$size = getimagesize($first); }
			}
		}
		?>
			<!-- SLIDER CYCLE -->
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/files/js/jquery.cycle.js"></script>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/files/js/jquery.easing.js"></script>
			<script type="text/javascript">

			$j('.cycle ul li').each(function(){$(this).css("height","<?php echo $size[1]; ?>px");});
			
			$j('.cycle ul').cycle({
				<?php $effect = get_post_meta( $current_id, 'slider_cycle_effect' ); ?>
				<?php $timeout = get_post_meta( $current_id, 'slider_cycle_timeout' ); ?>
				<?php $speed = get_post_meta( $current_id, 'slider_cycle_speed' ); ?>
				<?php $delay = get_post_meta( $current_id, 'slider_cycle_delay' ); ?>
				
				<?php if ( !empty( $effect['0'] ) ) : ?>
					<?php if ($effect['0'] == 'cover') : ?>
						fx: '<?php echo $effect['0']; ?>',   
						direction:  'down',
						easeIn:     'easeOutBounce', 
					<?php else: ?>
						fx: '<?php echo $effect['0']; ?>',   
					<?php endif; ?>             
				<?php endif; ?> 
				
				<?php if ( !empty( $timeout['0'] ) ) : ?>
					timeout: <?php echo $timeout['0']; ?>,
				<?php endif; ?>

				<?php if ( !empty( $speed['0'] ) ) : ?>
					speed: <?php echo $speed['0']; ?>,            
				<?php endif; ?>
				
				<?php if ( !empty( $delay['0'] ) ) : ?>
					delay: <?php echo $delay['0']; ?>,
				<?php endif; ?>            
				prev:   '#arrows .prev',
				next:   '#arrows .next',
				pager:  '#feature-list-nav',
				before: function(currSlideElement, nextSlideElement, options, forwardFlag) {
						  var title = $j(nextSlideElement).find('.description').text();
						  $j('#descriptions').empty().html(title);
						  //$j(currSlideElement).css("display","block");
						}
			});

			</script>
		  <div id="slider" class="cycle clearfix">
			<div id="slider-wrap" <?php if($size[1]) { echo 'style="max-height: '.$size[1].'px; height: '.$size[1].'px;"'; } ?>>
			  <ul class="clearfix" <?php if($size[1]) { echo 'style="max-height: '.$size[1].'px; height: '.$size[1].'px;"'; } ?>>
				  <?php foreach ($slides as $key => $slide ) : ?>
					<li>
						<?php if ( !empty( $slide['link'] ) ) :  ?>
						  <a href="<?php echo $slide['link']; ?>">
						<?php endif; ?>                      
						
						<img src="<?php echo link_to(($slide['url'])); ?>" alt="<?php echo $slide['title']; ?>" title=""/>
						<span class="description" style="display: none;"><?php echo htmlentities($slide['desc']); ?></span>
						
						<?php if ( !empty( $slide['link'] ) ) :  ?>
							</a>
						<?php endif; ?>
					</li>           
				  <?php endforeach; ?>
				</ul>
			  <div id="feature-list-nav"></div>
			</div><!-- /#slider-wrap -->
		  </div><!-- /#slider -->
			
		  <div id="toolbar">
			<div id="arrows">
			  <div class="prev"></div>
			  <div class="next"></div>
			</div><!-- /#arrows -->

			<div id="descriptions">
			  <?php echo $slides['1']['desc']; ?>
			</div><!-- /#descriptions -->
			  
			<?php get_search_form(); ?>
		  </div><!-- /#toolbar -->
		  
	<?php else: ?>
	   <div id="toolbar">
        <div id="home">
          <a href="<?php echo home_url(); ?>">
          </a>
        </div><!-- /#home -->

        <?php if (function_exists('yoast_breadcrumb') && ( is_page() || is_single() || have_posts() ) && ( !is_front_page()) ): ?>
            <div id="breadcrumb">
                    <?php yoast_breadcrumb('', '', true ); ?>
            </div><!-- /.breadcrumb -->
        <?php endif; ?>
        
        <?php get_search_form(); ?>
		</div><!-- /#toolbar -->
	<?php endif; ?>     
<?php elseif ( $style['0'] == 'custom'): ?>
	<?php if ( is_single() || is_page() || ($queried_object->ID == get_option( 'page_for_posts' ) ) || is_front_page() ): ?>
		<!-- CUSTOM IMAGE -->                   
		<div id="slider" class="clearfix custom">
		  <?php if ( !empty( $slides['1']['link'] ) ) : ?>
			 <a href="<?php echo $slides['1']['link']; ?>">
		  <?php endif; ?>
			 <img src="<?php echo link_to($slides['1']['url']); ?>" alt="" />
		  <?php if ( !empty( $slides['1']['link'] ) ) : ?>
			 </a>
		  <?php endif; ?>                          
		</div><!-- /#slider -->        
		 
		<?php if ( !empty( $slides['1']['name'] ) || !empty( $slides['1']['desc'] )) : ?>
		  <div id="toolbar" class="custom">
			<div id="info">
			</div><!-- /#info -->
			
			<?php if ( !empty( $slides['1']['name'] ) ) : ?>
				<h2><?php echo $slides['1']['name']; ?></h2>
			<?php endif; ?>
			
			<?php if ( !empty( $slides['1']['desc'] ) ) : ?>
			  <div class="description">
				<?php echo $slides['1']['desc']; ?>
			  </div>
			<?php endif; ?>
			
			<?php get_search_form(); ?>        
		  </div><!-- /#toolbar -->          
		<?php endif; ?>
	<?php else: ?>
	   <div id="toolbar">
        <div id="home">
          <a href="<?php echo home_url(); ?>">
          </a>
        </div><!-- /#home -->

        <?php if (function_exists('yoast_breadcrumb') && ( is_page() || is_single() || have_posts() ) && ( !is_front_page()) ): ?>
            <div id="breadcrumb">
                    <?php yoast_breadcrumb('', '', true ); ?>
            </div><!-- /.breadcrumb -->
        <?php endif; ?>
        
        <?php get_search_form(); ?>
		</div><!-- /#toolbar -->
	<?php endif; ?>                
<?php else: ?>
    <div id="toolbar">
        <div id="home">
          <a href="<?php echo home_url(); ?>">
          </a>
        </div><!-- /#home -->

        <?php if (function_exists('yoast_breadcrumb') && ( is_page() || is_single() || have_posts() ) && ( !is_front_page()) ): ?>
            <div id="breadcrumb">
                    <?php yoast_breadcrumb('', '', true ); ?>
            </div><!-- /.breadcrumb -->
        <?php endif; ?>
        
        <?php get_search_form(); ?>
    </div><!-- /#toolbar --> 
<?php endif; ?>
