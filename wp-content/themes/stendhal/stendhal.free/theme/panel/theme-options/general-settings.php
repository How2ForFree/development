<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Add more items to the menu in the Theme Options panel
 * 
 * @param array $items
 * @return array
 */
function yit_item_menu_theme_options( $items ) {
    return array_merge( $items, array( 
        'panel_import' => __( 'Panel Import', 'yit' ),
        'custom_style' => __( 'Custom style', 'yit' ),
        'custom_script' => __( 'Custom script', 'yit' ),
    ) );
}
//add_filter( 'yit_admin_menu_theme_options', 'yit_item_menu_theme_options' );

function yit_item_submenu_theme_options( $items ) {
    return array_merge( $items, array( 
        'testimonials' => array(
            'settings' => __( 'Settings', 'yit' ),
        )
    ) );
}
//add_filter( 'yit_admin_submenu_theme_options', 'yit_item_submenu_theme_options' );

/**
 * Add specific fields to the tab General -> Settings
 * 
 * @param array $fields
 * @return array
 */ 
function yit_tab_general_settings( $fields ) {
	$fields[95] = array(
        'id'   => 'responsive-menu',
        'type' => 'select',
        'name' => __( 'Responsive menu type', 'yit' ),
        'desc' => __( 'Choose if you want to show menu .', 'yit' ),
        'options' => array(
        	'arrow'   => __( 'Arrow Menu', 'yit' ),
            'select' => __( 'Select Menu', 'yit' ),
        ),
        'std'  => 'arrow',
        'deps' => array(
        	'ids' => 'responsive-enabled',
        	'values' => 1
		)
    );
    
    return $fields;
}
add_filter( 'yit_submenu_tabs_theme_option_general_settings', 'yit_tab_general_settings' ); 

add_filter( 'yit_background-style_std', create_function( '', "return array( 'image' => 'custom', 'color' => '#ffffff' );" ) );