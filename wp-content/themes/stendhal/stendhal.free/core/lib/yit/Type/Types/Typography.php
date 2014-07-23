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
 * YIT Type: Typography
 * 
 * @since 1.0.0
 */
class YIT_Type_Typography {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value ) {
	   
        $std = yit_get_option( $value['id'] );
		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" class="yit_options rm_typography rm_option rm_input rm_number rm_text">
                <div class="option">
	                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?> <small><?php echo $value['desc'] ?> <?php printf( __( '(Default: %s)', 'yit' ), $value['std']['size'] .  $value['std']['unit'] . ', ' .  $value['std']['family'] . ', ' .  ucfirst( str_replace( '-', ' ', $value['std']['style'] ) ) . ', ' .  $value['std']['color'] ) ?></small></label>
	                
                    <!-- Size -->
                    <div class="spinner_container">
                    	<input class="number" type="text" name="<?php yit_field_name( $value['id'] ) ?>[size]" id="<?php echo $value['id'] ?>-size" value="<?php echo $std['size'] ?>" />
                    </div>
                    
                    <!-- Unit -->
                    <div class="select_wrapper font-unit">
                        <select name="<?php yit_field_name( $value['id'] ) ?>[unit]" id="<?php echo $value['id'] ?>-unit">
                            <option value="px" <?php selected( $std['unit'], 'px' ) ?>><?php _e( 'px', 'yit' ) ?></option>
                            <option value="em" <?php selected( $std['unit'], 'em' ) ?>><?php _e( 'em', 'yit' ) ?></option>
                            <option value="pt" <?php selected( $std['unit'], 'pt' ) ?>><?php _e( 'pt', 'yit' ) ?></option>
                            <option value="rem" <?php selected( $std['unit'], 'rem' ) ?>><?php _e( 'rem', 'yit' ) ?></option>
                        </select>
                    </div>
                    
                    <!-- Family -->
                    <div class="select_wrapper font-family">
                        <select name="<?php yit_field_name( $value['id'] ) ?>[family]" id="<?php echo $value['id'] ?>-family">
                        <?php
                        $web_fonts = yit_get_web_fonts();
                        $google_fonts = yit_get_google_fonts();
                        
                        if( !empty( $web_fonts ) ) {
                            echo '<optgroup label="' . __( 'Web fonts', 'yit' ) . '">';
                            
                            foreach( $web_fonts as $name => $rule ) {
                                ?>
                                <option value='<?php echo $rule ?>' <?php selected( stripslashes( $std['family'] ), $rule ) ?>><?php echo $name ?></option>
                                <?php
                            }
                            
                            echo '</optgroup>';
                        }
                        
                        if( !empty( $google_fonts ) ) {
                            echo '<optgroup label="' . __( 'Google fonts', 'yit' ) . '">';
                            
                            foreach( $google_fonts->items as $font ) {
//                                 $font_human = trim( stripslashes( end( array_slice( explode( ',', $font ), 0, 1 ) ) ), "'" );
//                                 $std_human = trim( stripslashes( end( array_slice( explode( ',', $std['family'] ), 0, 1 ) ) ), "'" );
                                
                            	//if( isset($font->family) ):
                                //Only me and god know what happen on this line...
                                ?>
                                <option value="<?php echo $font ?>" <?php selected( $std['family'], $font ) ?>><?php echo $font ?></option>
                                <?php
								//endif;
                            }
                            
                            echo '</optgroup>';
                        }
                        ?>
                        </select>
                    </div>
                    
                    <!-- Style -->
                    <div class="select_wrapper font-style">
                        <select name="<?php yit_field_name( $value['id'] ) ?>[style]" id="<?php echo $value['id'] ?>-style">
                            <option value="regular" <?php selected( $std['style'], 'regular' ) ?>><?php _e( 'Regular', 'yit' ) ?></option>
                            <option value="bold" <?php selected( $std['style'], 'bold' ) ?>><?php _e( 'Bold', 'yit' ) ?></option>
                            <option value="extra-bold" <?php selected( $std['style'], 'extra-bold' ) ?>><?php _e( 'Extra bold', 'yit' ) ?></option>
                            <option value="italic" <?php selected( $std['style'], 'italic' ) ?>><?php _e( 'Italic', 'yit' ) ?></option>
                            <option value="bold-italic" <?php selected( $std['style'], 'bold-italic' ) ?>><?php _e( 'Italic bold', 'yit' ) ?></option>
                        </select>
                    </div>
                    
                    <!-- Color -->
                    <div id="<?php echo $value['id'] ?>_container" class="colorpicker_container"><div style="background-color: <?php echo $std['color'] ?>"></div></div>
                    <input type="text" name="<?php yit_field_name( $value['id'] ) ?>[color]" id="<?php echo $value['id'] ?>-color" style="width:150px" value="<?php echo $std['color'] ?>" />
                     
                </div>
                <div class="clear"></div>
                <div class="font-preview">
                    <p>The quick brown fox jumps over the lazy dog</p>
                    <!-- Refresh -->
                    <div class="refresh_container"><button class="refresh"><img src="<?php echo YIT_CORE_ASSETS_URL ?>/images/search.png" title="<?php _e( 'Click to preview', 'yit' ) ?>" alt="" /><?php _e( 'Click to preview', 'yit' ) ?></button></div>
                </div>
            </div>
            
            <script type="text/javascript" charset="utf-8">
                jQuery(document).ready( function( $ ) {
                    var container = $( '#<?php echo $value['id_container'] ?>' );
                    var preview = container.children( '.font-preview' ).children( 'p' );
                    
                    $('#<?php echo $value['id'] ?>-size').spinner({
                		<?php if( isset($value['min'] )): ?>min: <?php echo $value['min'] ?>, <?php endif ?>
                		<?php if( isset($value['max'] )): ?>max: <?php echo $value['max'] ?>, <?php endif ?>
                		interval: 1
                	});
                    
                    $('#<?php echo $value['id'] ?>_container').ColorPicker({
    					color: '<?php echo $std['color'] ?>',
    					onShow: function (colpkr) {
    						$(colpkr).fadeIn(500);
    						return false;
    					},
    					onHide: function (colpkr) {
    						$(colpkr).fadeOut(500);
    						return false;
    					},
    					onChange: function (hsb, hex, rgb) {                            
    						$('#<?php echo $value['id'] ?>_container div').css('backgroundColor', '#' + hex);
    						$( '#<?php echo $value['id'] ?>_container' ).next( 'input' ).attr( 'value', '#' + hex );
                            
                            if( container.find( '.refresh' ).is( ':visible' ) ) { return; }
                            
                            //Preview color change
                            preview.css( 'color', '#' + hex );
    					}
    				});
                    
                    container.find( '.refresh' ).click( function( e ) {
                        e.preventDefault();
                        
                        $( this ).parent().fadeOut( 'slow' );
                        
                        //Set current value, before trigger change event
                    
                        //Color
                        preview.css( 'color', $('#<?php echo $value['id'] ?>-color').val() );
                        //Font size
                        var size = $( '#<?php echo $value['id'] ?>-size' ).val();
                        var unit = $( '#<?php echo $value['id'] ?>-unit' ).val();
                         
                        preview.css( 'font-size', size + unit );
                        preview.css( 'line-height', ( unit == 'em' || unit == 'rem' ? Number( size ) + 0.4 : Number ( size ) + 4 ) + unit );
                        //Font style
                        var style = $( '#<?php echo $value['id'] ?>-style' ).val();
                                                 
                        if( style == 'italic' ) {
                           preview.css({ 'font-weight' : 'normal', 'font-style' : 'italic' });
                        } else if( style == 'bold' ) {
                           preview.css({ 'font-weight' : 'bold', 'font-style' : 'normal' }); 
                        } else if( style == 'extra-bold' ) {
                           preview.css({ 'font-weight' : '800', 'font-style' : 'normal' }); 
                        } else if( style == 'bold-italic' ) {
                           preview.css({ 'font-weight' : 'bold', 'font-style' : 'italic' });
                        } else {
                           preview.css({ 'font-weight' : 'normal', 'font-style' : 'normal' });
                        }
                        
                        //Font Family
                        var group = $( '#<?php echo $value['id'] ?>-family' ).find( 'option:selected' ).parent().attr( 'label' );
                             
                        if( group == '<?php _e( 'Web fonts', 'yit' ) ?>' ) {
                            //Web font
                            preview.css( 'font-family', $( '#<?php echo $value['id'] ?>-family' ).val() );
                        } else {
                            //Google font
                            WebFontConfig = {
                               google: { families: [ $( '#<?php echo $value['id'] ?>-family :selected' ).text() ] },
                               fontactive: function( fontFamily, fontDescription ) {
                                   preview.css( 'font-family', fontFamily );
                               }
                            };
                            (function() {
                                var wf = document.createElement('script');
                                wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                                wf.type = 'text/javascript';
                                wf.async = 'true';
                                
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(wf, s);
                            })();
                        }
                        
                    } );
                    
                    //Font Size Change
                    $( '#<?php echo $value['id'] ?>-size, #<?php echo $value['id'] ?>-unit' ).change( function() {
                         if( container.find( '.refresh' ).is( ':visible' ) ) { return; }
                         
                         var size = $( '#<?php echo $value['id'] ?>-size' ).val();
                         var unit = $( '#<?php echo $value['id'] ?>-unit' ).val();
                         
                         preview.css( 'font-size', size + unit );
                         preview.css( 'line-height', ( unit == 'em' || unit == 'rem' ? Number( size ) + 0.4 : Number ( size ) + 4 ) + unit );
                         
                         preview.trigger( 'resize' );
                    });                    
                    
                    //Font Family Change
                    $( '#<?php echo $value['id'] ?>-family' ).change( function() {
                         if( container.find( '.refresh' ).is( ':visible' ) ) { return; }
                        
                         var group = $( this ).find( 'option:selected' ).parent().attr( 'label' );
                         
                         if( group == '<?php _e( 'Web fonts', 'yit' ) ?>' ) {
                             //Web font
                             preview.css( 'font-family', $( this ).val() );
                         } else {
                             //Google font
                             WebFontConfig = {
                                google: { families: [ $( this ).val() ] },
                                fontactive: function( fontFamily, fontDescription ) {
                                   preview.css( 'font-family', fontFamily );
                               }
                             };
                             (function() {
                                 var wf = document.createElement('script');
                                 wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
                                     '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
                                 wf.type = 'text/javascript';
                                 wf.async = 'true';
                                 var s = document.getElementsByTagName('script')[0];
                                 s.parentNode.insertBefore(wf, s);
                             })();
                         }
                         
                         preview.trigger( 'resize' );
                    });
                    
                    //Font Style Change
                    $( '#<?php echo $value['id'] ?>-style' ).change( function() {
                         if( container.find( '.refresh' ).is( ':visible' ) ) { return; }
                         
                         var style = $( this ).val();
                         
                         if( style == 'italic' ) {
                            preview.css({ 'font-weight' : 'normal', 'font-style' : 'italic' });
                         } else if( style == 'bold' ) {
                            preview.css({ 'font-weight' : 'bold', 'font-style' : 'normal' }); 
                         } else if( style == 'extra-bold' ) {
                           preview.css({ 'font-weight' : '800', 'font-style' : 'normal' }); 
                         } else if( style == 'bold-italic' ) {
                            preview.css({ 'font-weight' : 'bold', 'font-style' : 'italic' });
                         } else {
                            preview.css({ 'font-weight' : 'normal', 'font-style' : 'normal' });
                         }
                         
                         preview.trigger( 'resize' );
                    });
                    
                    preview.resize( function() {
                        var box  = $(this).parents('.yit-box');
    	                $(this).parents('form').height( box.height() );  
                    } );
                });
            </script>
        <?php
		return ob_get_clean();
	}
}