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
 * YIT Type: Title
 * 
 * @since 1.0.0
 */
class YIT_Type_Title {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value ) {            
        ob_start(); ?>
			<div class="yit_options rm_option rm_input rm_text">
                <h3><?php echo $value['name'] ?></h3>
                <p><?php echo $value['desc'] ?></p>
            </div>
        <?php
		return ob_get_clean();
	}
}