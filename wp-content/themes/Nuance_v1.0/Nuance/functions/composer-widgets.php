<?php
/* ------------------------------------------------------------------------------------------------------------

	Composer Widget Layouts
	
------------------------------------------------------------------------------------------------------------ */
	
	define('WP_USE_THEMES', false);
	require('../../../../wp-load.php');
	
	/* -----------------------------------------------------------------
	
		Widget layouts
	
	----------------------------------------------------------------- */
	
	$widget = $_GET['widget_name'];
	
	if($widget == 'blank'){
		
		?>
		
		<li class="one-half">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/2</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Blank</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-half" />
					<input type="hidden" class="composer-widget-name-value" value="blank" />
					<input type="hidden" class="composer-widget-content" value="" />
			
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}elseif($widget == 'separator'){
		
		?>
		<li class="full-width">
			
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget title -->
					Separator
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<span class="composer-widget-edit-direct"><small>With line?</small> <input type="checkbox" class="composer-widget-separator-line" value="checked" /></span>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="full-width" />
					<input type="hidden" class="composer-widget-name-value" value="separator" />
			
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}elseif($widget == 'ltweet'){
		
		?>
		
		<li class="one-half">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/2</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Latest Tweet</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-half" />
					<input type="hidden" class="composer-widget-name-value" value="ltweet" />
					<input type="hidden" class="composer-widget-content" value="" />
				
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}elseif($widget == 'service'){
		
		?>
		
		<li class="one-half">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/2</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Service</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-half" />
					<input type="hidden" class="composer-widget-name-value" value="service" />
					<input type="hidden" class="composer-widget-content" value="" />
					
					<!-- special values -->
					<input type="hidden" class="service-icon-value" />
			
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}elseif($widget == 'testimonials'){
		
		?>
		
		<li class="one-half">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/2</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Testimonials</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-half" />
					<input type="hidden" class="composer-widget-name-value" value="testimonials" />
					<input type="hidden" class="composer-widget-content" value="" />
					
					<!-- special values -->
					<input type="hidden" class="testimonial-type-value" />
					<input type="hidden" class="testimonial-amount-value" />
					<input type="hidden" class="testimonial-columns-value" />
					<input type="hidden" class="testimonial-category-value" />

				</div><!-- inner-2 -->
			</div><!-- .inner -->
					
		</li>
		
		<?php
		
	}elseif($widget == 'portfolio_posts'){
		
		?>
		
		<li class="one-third">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/3</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Portfolio</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-third" />
					<input type="hidden" class="composer-widget-name-value" value="portfolio_posts" />
					<input type="hidden" class="composer-widget-content" value="" />
					
					<!-- special values -->
					<input type="hidden" class="portfolio_posts-type-value" />
					<input type="hidden" class="portfolio_posts-amount-value" />
					<input type="hidden" class="portfolio_posts-item-width-value" />
					<input type="hidden" class="portfolio_posts-show-thumbnail-value" />
					<input type="hidden" class="portfolio_posts-show-title-value" />
					<input type="hidden" class="portfolio_posts-show-excerpt-value" />
					<input type="hidden" class="portfolio_posts-show-meta-value" />
					<input type="hidden" class="portfolio_posts-type-value" />
					<input type="hidden" class="portfolio_posts-category-value" />

				</div><!-- inner-2 -->
			</div><!-- .inner -->
				
		</li>
		
		<?php
		
	}elseif($widget == 'blog_posts'){
		
		?>
		
		<li class="one-third">
		
			<div class="inner">
				<div class="inner-2">
			
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/3</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Blog</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-edit"></a>
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-third" />
					<input type="hidden" class="composer-widget-name-value" value="blog_posts" />
					<input type="hidden" class="composer-widget-content" value="" />
					
					<!-- special values -->
					<input type="hidden" class="blog_posts-type-value" />
					<input type="hidden" class="blog_posts-amount-value" />
					<input type="hidden" class="blog_posts-item-width-value" />
					<input type="hidden" class="blog_posts-show-thumbnail-value" />
					<input type="hidden" class="blog_posts-show-title-value" />
					<input type="hidden" class="blog_posts-show-excerpt-value" />
					<input type="hidden" class="blog_posts-type-value" />
			
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}elseif($widget == 'contact_form'){
		
		?>
		
		<li class="one-third">
		
			<div class="inner">
				<div class="inner-2">
					
					<!-- widget size manage -->
					<span class="composer-widget-width">
						<a href="#" class="composer-widget-width-less"></a>
						<span class="composer-widget-width-current">1/3</span>
						<a href="#" class="composer-widget-width-more"></a>
					</span>
					
					<!-- widget title -->
					<span class="composer-widget-title">Contact Form</span>
					
					<!-- widget actions -->
					<span class="composer-widget-actions">
						<a href="#" class="composer-widget-remove-ask"></a>
					</span>
					
					<!-- delete confirmation -->
					<span class="composer-widget-remove-container">
						Are you sure? <a href="#" class="composer-widget-remove-cancel">Cancel</a> - <a href="#" class="composer-widget-remove">Delete</a>
					</span>
					
					<!-- widget values -->
					<input type="hidden" class="composer-widget-content-before" />
					<input type="hidden" class="composer-widget-content-after" />
					<input type="hidden" class="composer-widget-width-value" value="one-third" />
					<input type="hidden" class="composer-widget-name-value" value="contact_form" />
					<input type="hidden" class="composer-widget-content" value="" />
			
				</div><!-- inner-2 -->
			</div><!-- .inner -->
			
		</li>
		
		<?php
		
	}
	
	/* ---------------------------------------------------------------------------------------- 
	
		Edit layouts
	
	---------------------------------------------------------------------------------------- */
	
	if($widget == 'blank_edit'){
		
		?>
			<div class="blank-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
				<div class="metabox-field">
					<label><span>Content</span></label>
					<textarea class="metabox-new-field-content"></textarea>
					<div class="clear"></div>
					<small>What you type in here will be shown in the page content.</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}elseif($widget == 'ltweet_edit'){
		
		?>
			<div class="ltweet-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
				<div class="metabox-field">
					<label><span>Profile</span></label>
					<input type="text" class="metabox-new-field-content" />
					<div class="clear"></div>
					<small>Type in your twitter profile name.</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}elseif($widget == 'service_edit'){
		
		?>
			<div class="service-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
				<div class="metabox-field">
					<label><span>Icon</span></label>
					<small>Select the icon.</small>
					<div class="clear"></div>
					
					<ul class="metabox-service-icons">
						
						<?php for ($i = 1; $i <= 26; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-books service-icons-regular" alt="books-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/books_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 27; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-drives service-icons-regular" alt="drives-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/drives_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 21; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-hardware service-icons-regular" alt="hardware-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/hardware_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 10; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-keys service-icons-regular" alt="keys-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/keys_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 35; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-misc service-icons-regular" alt="misc-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/misc_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 16; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img class="metabox-service-icons-weather service-icons-regular" alt="weather-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/weather_<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
						<?php for ($i = 1; $i <= 90; $i++) { ?>
							<?php if($i < 10){ $num = '0'.$i; }else{ $num = $i; } ?>
							<li><img alt="blackandwhite-<?php echo $num; ?>" src="<?php echo get_template_directory_uri(); ?>/images/icons/black_and_white/blackandwhite-<?php echo $num; ?>.png" /></li>
						<?php } ?>
						
					</ul>
					
				</div>
				<div class="metabox-field">
					<label><span>Content</span></label>
					<textarea class="metabox-new-field-content"></textarea>
					<small>What you type in here will be shown in the page content.</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}elseif($widget == 'testimonials_edit'){
		
		?>
			<div class="testimonials-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
				<div class="metabox-field">
					<label><span>Type</span></label>
					<select class="testimonial-type-value-new">
						<option value="scroller">Scroller</option>
						<option value="list">List</option>
					</select>
					<div class="clear"></div>
					<small>There are 2 types you can choose from, scroller and list.</small>
				</div>
				<div class="metabox-field">
					<label><span>Amount</span></label>
					<select class="testimonial-amount-value-new">
						<?php
						for ($i = 1; $i <= 15; $i++) {
							?><option><?php echo $i; ?></option><?php
						}
						?>
					</select>
					<div class="clear"></div>
					<small>Amount of posts to show.</small>
				</div>
				<div class="metabox-field">
					<label><span>Columns</span></label>
					<select class="testimonial-columns-value-new">
						<option value="4">1/4 (one fourth)</option>
						<option value="3">1/3 (one_third)</option>
						<option value="2">1/2 (one_half)</option>
						<option value="1">1/1 (full width)</option>
					</select>
					<div class="clear"></div>
					<small><em>Notice: Only for list type.</em> Select how wide each testimonial will be.</small>
				</div>
				<div class="metabox-field">
					<label><span>Category</span></label>
					<select class="testimonial-category-value-new">
						<option value="all">All</option>
						<?php
						$categories =  get_categories('taxonomy=jw_testimonials_categories'); 
						foreach($categories as $cat){
							?><option value="<?php echo $cat->term_id ?>"><?php echo $cat->name; ?></option><?php
						}
						?>
					</select>
					<div class="clear"></div>
					<small>If you want to show testimonials from specific category choose it here. Leave blank to include all categories.</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}elseif($widget == 'portfolio_posts_edit'){
		
		?>
			<div class="portfolio_posts-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
				<div class="metabox-field">
					<label><span>Type</span></label>
					<select class="portfolio_posts-type-value-new">
						<option value="grid_1">Grid 1</option>
						<option value="grid_2">Grid 2</option>
					</select>
					<div class="clear"></div>
					<small>There are 2 types you can choose from, "Grid 1" and "Grid 2". <strong>Notice:</strong> Grid 2 can only be used in full width.</small>
				</div>
				<div class="metabox-field">
					<label><span>Amount</span></label>
					<select class="portfolio_posts-amount-value-new">
						<?php
						for ($i = 1; $i <= 15; $i++) {
							?><option><?php echo $i; ?></option><?php
						}
						?>
					</select>
					<div class="clear"></div>
					<small>Amount of posts to show.</small>
				</div>
				<div class="metabox-field">
					<label><span>Item Width</span></label>
					<select class="portfolio_posts-item-width-value-new">
						<option value="one_third">One Third</option>
						<option value="one_fourth">One Fourth</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid 1 only.</strong> Width of an item, one third or one fourth?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Thumbnail</span></label>
					<select class="portfolio_posts-show-thumbnail-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid 1 only.</strong> Should the thumbnail be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Title</span></label>
					<select class="portfolio_posts-show-title-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid 1 only.</strong> Should the title be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Excerpt</span></label>
					<select class="portfolio_posts-show-excerpt-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid 1 only.</strong> Should the excerpt be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Meta</span></label>
					<select class="portfolio_posts-show-meta-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid 1 only.</strong> Should the meta be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Category</span></label>
					<select class="portfolio_posts-category-value-new">
						<option value="all">All</option>
						<?php
						$categories =  get_categories('taxonomy=jw_portfolio_categories');
						if(!empty($categories)){
							foreach($categories as $cat){
								?><option value="<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option><?php
							}
						}
						?>
					</select>
					<div class="clear"></div>
					<small>From which category do you want to show the portfolio posts?</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}elseif($widget == 'blog_posts_edit'){
		
		?>
			<div class="blog_posts-edit">
				
				<div class="composer-edit-actions top-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				<div class="metabox-field">
					<label><span>Title</span></label>
					<input type="text" class="metabox-new-field-title" />
					<div class="clear"></div>
					<small>Shown in the drag&amp;drop part, for your own descriptional purposes.</small>
				</div>
					<div class="metabox-field">
					<label><span>Type</span></label>
					<select class="blog_posts-type-value-new">
						<option value="grid">Grid</option>
						<option value="list">List</option>
					</select>
					<div class="clear"></div>
					<small>There are 2 types you can choose from, "Grid" and "List".</small>
				</div>
				<div class="metabox-field">
					<label><span>Amount</span></label>				
					<select class="blog_posts-amount-value-new">
						<?php
						for ($i = 1; $i <= 15; $i++) {
							?><option><?php echo $i; ?></option><?php
						}
						?>
					</select>
					<div class="clear"></div>
					<small>Amount of posts to show.</small>
				</div>
				<div class="metabox-field">
					<label><span>Item Width</span></label>
					<select class="blog_posts-item-width-value-new">
						<option value="one_third">One Third</option>
						<option value="one_fourth">One Fourth</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid only. </strong>Width of an item, one third or one fourth?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Thumbnail</span></label>
					<select class="blog_posts-show-thumbnail-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid only. </strong>Should the thumbnail be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Title</span></label>
					<select class="blog_posts-show-title-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid only. </strong>Should the title be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Show Excerpt</span></label>
					<select class="blog_posts-show-excerpt-value-new">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
					<div class="clear"></div>
					<small><strong>Grid only. </strong>Should the excerpt be shown?</small>
				</div>
				<div class="metabox-field">
					<label><span>Before</span></label>
					<textarea class="metabox-new-field-content-before"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown before the actual content of the module.</small>
				</div>
				<div class="metabox-field">
					<label><span>After</span></label>
					<textarea class="metabox-new-field-content-after"></textarea>
					<div class="clear"></div>
					<small>The content you type in here will be shown after the actual content of the module.</small>
				</div>
				<div class="composer-edit-actions bottom-actions">
					<a href="#" class="composer-edit-save button-primary">Save</a><a href="#" class="composer-edit-cancel button-secondary">Cancel</a>
				</div>
				
			</div>
		<?php
		
	}
?>