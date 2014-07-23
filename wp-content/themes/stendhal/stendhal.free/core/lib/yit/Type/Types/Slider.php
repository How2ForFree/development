<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yourinspirationthemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * YIT Type: Slider
 * 
 * @since 1.0.0
 */
class YIT_Type_Slider {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value ) {
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" class="yit_options rm_option rm_input slider_control slider">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>

				<?php $labels = ( isset( $value['label'] ) ) ? ' ' . $value['label'] : '' ?>
                <div class="ui-slider">
                    <span class="minCaption"><?php echo $value['min'] . $labels ?></span>
                    <span class="maxCaption"><?php echo $value['max'] . $labels ?></span>
                    <span id="<?php echo $value['id']; ?>-feedback" class="feedback"><strong><?php echo yit_get_option( $value['id'], $value['std'] ) . $labels ?></strong></span>
                    
                    <div id="<?php echo $value['id']; ?>-div" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                        <input id="<?php echo $value['id'] ?>" type="hidden" name="<?php yit_field_name( $value['id'] ); ?>" value="<?php echo yit_get_option( $value['id'], $value['std'] ); ?>" />
                    </div> 
                </div> 

                </div>
                <div class="description">
				<?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), $value['std'] ) ?>
                </div>
                <div class="clear"></div>
            </div>

            <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#<?php echo $value['id']; ?>-div').each(function(e){
                    var val = <?php echo yit_get_option( $value['id'], $value['std'] ); ?>; 
                    var minValue = <?php echo $value['min'] ?>; 
                    var maxValue = <?php echo $value['max'] ?>; 
                    
                    $(this).slider({
                        value: val,
                        min: minValue,
                        max: maxValue,
                        range: 'min',
                        <?php if ( isset( $value['step'] ) ) : ?>
                        step: <?php echo $value['step'] ?>,
                        <?php endif ?>
                        slide: function( event, ui ) {
                			$( 'input#<?php echo $value['id']; ?>' ).val( ui.value );
                			$( '#<?php echo $value['id']; ?>-feedback strong' ).text( ui.value + '<?php echo $labels ?>' );
                        }
                    });
                });
            });
            </script>

        <?php
		return ob_get_clean();
	}
}