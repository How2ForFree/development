<?php

define('WP_USE_THEMES', false);
require('../../../../wp-load.php');

global $domain;

include TEMPLATEPATH.'/functions/jwpanel/jwpanel-get.php';

$p_cat_id = $_GET['cat_id'];
$last = $_GET['last'];
$type = $_GET['type'];

if($p_cat_id != '' && strpos($p_cat_id, ',') === false){ 

	$catdetails = get_term_by('id', $p_cat_id, 'jw_portfolio_categories');
	$catid = $catdetails->term_id;
	$catids = get_objects_in_term($catid, 'jw_portfolio_categories');
	
}else if($p_cat_id != '' && strpos($p_cat_id, ',') !== false){
	
	$catids = get_objects_in_term(explode(",", $p_cat_id), 'jw_portfolio_categories');
	
}else{

	$catids = '';
	
}

?>

<?php 

$args = array(
	'post_type'			=> 'jw_portfolio',
	'showposts'			=> '-1',
	'post__in'			=> $catids
);
//Query the portfolio posts (custom post type named jw_portfolio).
$jw_query = new WP_Query($args); 

$count = 0;

?>

<?php if($type == 'layout_p1'){ ?>

	<ul class="portfolio-listing">		
		
		<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; /* Loop the posts */ ?>
			
			<?php $c_post_custom = get_post_custom($post->ID); ?>
					
			<li data-id="quicksand-id-<?php echo $post->ID; ?>">
				<?php if(has_post_thumbnail()){ ?>
					<?php the_post_thumbnail('jw_portfolio_grid', array('class' => 'grid-img')); ?>
				<?php } ?>
				<div class="portfolio-popup-info">
					
					<!-- Title -->
					<span class="portfolio-popup-info-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					
					<!-- Description -->
					<span class="portfolio-popup-info-description"><?php echo jw_text_excerpt(get_the_excerpt(), 120); ?></span>
					
					<!-- Client -->
					<?php if(isset($c_post_custom['jw_portfolio_client'][0])){ ?>
						<span><strong><?php _e('Client', $domain); ?></strong> \\ <?php echo $c_post_custom['jw_portfolio_client'][0]; ?></span>
					<?php } ?>
					
					<!-- Categories -->
					<?php 
					$portfolio_cats = get_the_terms($post->ID, 'jw_portfolio_categories');
					if(!empty($portfolio_cats)){
					?>
						<span><strong><?php _e('What we did', $domain); ?></strong> \\ 
							
							<?php 
								foreach($portfolio_cats as $portfolio_cat){
									echo $portfolio_cat->name.', ';
								}
							
							?>
						
						</span>
					
					<?php } ?>
					
					<!-- Author -->
					<?php if(isset($c_post_custom['jw_portfolio_author'][0])){ ?>
						<span><strong><?php _e('Author', $domain); ?></strong> \\ <?php echo $c_post_custom['jw_portfolio_author'][0]; ?></span>
					<?php } ?>
					
					<!-- Date -->
					<span><strong><?php _e('Date', $domain); ?></strong> \\ <?php the_time('F j Y'); ?></span>
					
					<!-- Actions -->
					<span class="portfolio-popup-info-actions">
						<?php if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p1 == 'on'){ ?>
							<?php if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; } ?>
							<?php if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; } ?>
							<a href="<?php echo $real_link; ?>" class="portfolio-popup-info-zoom" rel="prettyPhoto[pp_gal_<?php echo $post->ID; ?>]">zoom</a>
							<?php
								if(isset($c_post_custom['jw_portfolio_images'][0])){
									$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
									$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.$post->ID.'"', $jw_portfolio_images);
									echo do_shortcode($jw_portfolio_images);
								}
							?>
						<?php } ?>
						<a href="<?php the_permalink(); ?>" class="portfolio-popup-info-more">more</a>
					</span>
					
				</div><!-- .portfolio-popup-info -->
					
			</li> <!-- end portfolio item -->
		
		<?php endwhile; else: /* If no posts found */ ?>
			
			<p><?php _e('The portfolio is empty', $domain); ?></p>
		
		<?php endif; /* End if have posts */ ?>

	</ul>

<?php }elseif($type == 'layout_p2' || $type == 'layout_p3' || $type == 'layout_p4'){ ?>

	<ul class="portfolio-listing">
	
		<?php if($type == 'layout_p3' || $type == 'layout_p4'){ $max_count = 2; }else{ $max_count = 3; } ?>
		
		<?php $real_count = 0; ?>
		
		<?php if ($jw_query->have_posts()) : while ($jw_query->have_posts()) : $jw_query->the_post(); $count++; $real_count++; /* Loop the posts */ ?>
							
			<?php $c_post_custom = get_post_custom($post->ID); ?>
				
			<li class="one-third<?php if($count == $max_count){ ?> last<?php $count = 0; } if($real_count <= $max_count){ ?> no-margin-top<?php }  ?>" data-id="quicksand-id-<?php echo $post->ID; ?>">
				<?php if(has_post_thumbnail()){ ?>
					
					<?php if((isset($c_post_custom['jw_portfolio_images']) || isset($c_post_custom['jw_portfolio_video'])) && $jw_portfolio_thickbox_p2 == 'on'){ ?>
						<?php if(isset($c_post_custom['jw_portfolio_video'])){ $real_link = $c_post_custom['jw_portfolio_video'][0]; $lightbox_class = 'lightbox-video'; } ?>
						<?php if(isset($c_post_custom['jw_portfolio_images'])){ preg_match('!http://.+\.(?:jpe?g|png|gif)!Ui', $c_post_custom['jw_portfolio_images'][0],$matches); $real_link = $matches[0]; $lightbox_class = 'lightbox-image'; } ?>
						<a href="<?php echo $real_link; ?>" class="<?php echo $lightbox_class; ?>" rel="prettyPhoto[pp_gal_<?php echo $post->ID; ?>]"><?php the_post_thumbnail('jw_portfolio_listing', array('class' => 'wrapped')); ?></a>
						<?php
							if(isset($c_post_custom['jw_portfolio_images'][0])){
								$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image show="no"', $c_post_custom['jw_portfolio_images'][0], 1);
								$jw_portfolio_images = preg_replace('/\[portfolio_image/', '[portfolio_image post_id="'.get_the_ID().'"', $jw_portfolio_images);
								echo do_shortcode($jw_portfolio_images);
							}
						?>
					<?php }else{ ?>
						<a href="<?php the_permalink(); ?>"  class="lightbox-none"><?php the_post_thumbnail('jw_portfolio_listing', array('class' => 'wrapped')); ?></a>
					<?php } ?>
					
				<?php } ?>
				<span class="portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
				<?php echo jw_text_excerpt(get_the_excerpt(), 90); ?>
			</li>
		
		<?php endwhile; else: /* If no posts found */ ?>
			
			<p><?php _e('The portfolio is empty', $domain); ?></p>
		
		<?php endif; /* End if have posts */ ?>

	</ul>

<?php } ?>