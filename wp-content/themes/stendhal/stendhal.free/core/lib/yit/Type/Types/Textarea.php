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
 * YIT Type: Textarea
 * 
 * @since 1.0.0
 */
class YIT_Type_Textarea {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value ) {         
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" class="yit_options rm_option rm_input rm_text">
                <div class="option">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                <textarea name="<?php yit_field_name( $value['id'] ); ?>" id="<?php echo $value['id'] ?>" cols="" rows=""><?php echo yit_get_option( $value['id'] ) ?></textarea>
                </div>
                <div class="description">
				<?php echo $value['desc'] ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}