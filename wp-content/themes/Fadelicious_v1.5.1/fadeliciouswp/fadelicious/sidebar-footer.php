<?php
/**
 * The Footer widget areas.
 */
?>
<div id="footer-wrapper">
<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'first-footer-widget-area'  )
	)
		return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="footer">
<?php if ( is_active_sidebar( 'first-footer-widget-area' ) ) : ?>
			<div class="footer-content">
    <div class="col3-wrap">
						<?php dynamic_sidebar( 'first-footer-widget-area' ); ?>
					</div></div>
<?php endif; ?>

