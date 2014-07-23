/***************************************************************************
 *
 * 	----------------------------------------------------------------------
 * 						DO NOT EDIT THIS FILE
 *	----------------------------------------------------------------------
 *                      Theme Customizer Scripts
 *  				    Copyright (C) Themify
 *
 *	----------------------------------------------------------------------
 *
 ***************************************************************************/

(function($){

	// Google Font Loader
	var wf = document.createElement( 'script' );
		wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js';
		wf.type = 'text/javascript';
		wf.async = 'true';
		var s = document.getElementsByTagName( 'script' )[0];
		s.parentNode.insertBefore( wf, s );

	// Convert hexadecimal color to RGB. Receives string and returns object
	function hexToRgb(hex) {
	    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
	    return result ? {
	        r: parseInt(result[1], 16),
	        g: parseInt(result[2], 16),
	        b: parseInt(result[3], 16)
	    } : null;
	}

	// Set color in hexadecimal format and also rgba if opacity is set.
	function setColor( $selector, property, values ) {
		if ( 'undefined' !== typeof values.transparent && 'transparent' == values.transparent) {
			$selector.css(property, 'transparent' );
		} else {
			if ( 'undefined' !== typeof values.color && '' != values.color ) {
				var rgb = hexToRgb( values.color ),
					alpha = values.opacity ? values.opacity : '1';
				$selector.css(property, '#' + ( values.color ) );
				$selector.css(property, 'rgba( ' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + alpha + ' )' );
			}
		}
	}

	// Set dimension by side, like padding or margin.
	function setDimension( $selector, property, side ) {
		// Check if auto was set
		if ( side.auto && 'auto' == side.auto ) {
			$selector.css( property, side.auto );
		} else {
			// Prepare unit
			var unit = 'px';
			if ( side.unit && 'px' != side.unit ) {
				unit = side.unit;
			}

			// Dimension Width
			if ( side.width && '' != side.width ) {
				$selector.css( property, side.width + unit );
			}
		}
	}

	// Set border properties. @uses setColor().
	function setBorder( $selector, property, borderSide ) {
		if ( borderSide.style && 'none' != borderSide.style ) {
			// Border Style
			if ( '' != borderSide.style ) {
				$selector.css( property + '-style', borderSide.style );
			}
			// Border Width
			if ( borderSide.width && '' != borderSide.width ) {
				$selector.css( property + '-width', borderSide.width + 'px' );
			}
			// Border Color
			setColor( $selector, property + '-color', borderSide );
		} else {
			$selector.css( property, 'none' );
		}
	}

	// Setup general variables
	var api = wp.customize,
		$body = $('body');

	api( 'header_textcolor', function( value ) {
		value.bind( function( newval ) {
			$('#header a, .site-title a, .site-description').css('color', newval );
		});
	});

	api( 'link_color', function( value ) {
		value.bind( function( newval ) {
			$('a').css('color', newval );
		});
	});

	api( 'text_color', function( value ) {
		value.bind( function( newval ) {
			$body.css('color', newval );
		});
	});

	// If the themifyCustomizer object is not defined, exit
	if ( ! themifyCustomizer ) {
		return;
	}

	// Setup font family, styles, size and eveything
	function setFont( $selector, font ) {
		$selector.css( {
			'font-family'  : '',
			'font-weight'  : '',
			'font-style' : '',
			'text-decoration' : '',
			'text-align' : '',
			'line-height' : ''
		} );

		if ( font ) {

			if ( font.family && '' != font.family ) {
				var family = font.family;
				if ( family.fonttype && 'google' == family.fonttype ) {
					var googleFont = family.name;
					if ( family.variant ) {
						googleFont =  family.name + ':' + family.variant
					}
					WebFont.load({
						google: {
							families: [googleFont]
						}
					});
				}
				$selector.css( 'font-family', family.name );
			}

			if ( ! font.nostyle || '' == font.nostyle ) {
				if ( font.bold && '' != font.bold ) {
					$selector.css( 'font-weight', 'bold' );
				}

				if ( font.italic && '' != font.italic ) {
					$selector.css( 'font-style', 'italic' );
				}

				if ( font.linethrough && '' != font.linethrough ) {
					$selector.css( 'text-decoration', 'line-through' );
				}

				if ( font.underline && '' != font.underline ) {
					$selector.css( 'text-decoration', 'underline' );
				}
			} else {
				$selector.css( {
					'font-weight' : 'normal',
					'font-style' : 'normal',
					'text-decoration' : 'none'
				} );
			}

			if ( ! font.noalign || '' == font.noalign ) {
				if ( font.align && '' != font.align ) {
					$selector.css( 'text-align', font.align );
				}
			} else {
				if ( '' == themifyCustomizer.isRTL ) {
					$selector.css( 'text-align', 'left' );
				} else {
					$selector.css( 'text-align', 'right' );
				}
			}

			if ( font.sizenum && '' != font.sizenum ) {
				var unit = ( font.sizeunit && '' != font.sizeunit ) ? font.sizeunit : 'px';
				$selector.css( 'font-size', font.sizenum + unit );
			}

			if ( font.linenum && '' != font.linenum ) {
				var unit = ( font.lineunit && '' != font.lineunit ) ? font.lineunit : 'px';
				$selector.css( 'line-height', font.linenum + unit );
			}
		}
	}

	////////////////////////////////////////////////////////////////////////////
	// Font Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.fontControls ) {
		$.each(themifyCustomizer.fontControls, function(index, selector){
			api( index, function( value ) {
				value.bind( function( fontData ) {
					var values = $.parseJSON( fontData ),
						$selector = $( selector );
					setFont( $selector, values );
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Font Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Logo Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.logoControls ) {
		$.each(themifyCustomizer.logoControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( imageData ) {
					var values = $.parseJSON( imageData ),
						$selector = $( selector );

					setFont( $selector, values );

					if ( values ) {

						if ( values.mode && 'none' == values.mode ) {

							$selector.css( 'display', 'none' );

						} else if ( 'none' != values.mode ) {

							$selector.css( 'display', 'block' );

							var $img = $('img', $selector);
							if ( $img.length > 0 ) {
								$img.remove();
							}
							if ( '' != values.src && 'image' == values.mode ) {
								$($selector).find('span').hide();
								if ( $('a', $selector).length > 0 ) {
									$selector.find('a').prepend('<img src="' + values.src + '" />');
									if ( values.link && '' != values.link ) {
										$selector.find('a').attr('href', values.link);
									}
								} else {
									$selector.prepend('<img src="' + values.src + '" />');
								}
								var imgwidth = values.imgwidth && '' != values.imgwidth ? values.imgwidth : '';
								var imgheight = values.imgheight && '' != values.imgheight ? values.imgheight : '';
								$selector.find('img').css({
									'width': imgwidth,
									'height': imgheight
								});
							} else {
								$($selector).find('span').show();
								if ( $('a', $selector).length > 0 ) {
									if ( values.link && '' != values.link ) {
										$selector.find('a').attr('href', values.link);
									}
									setColor( $selector, 'color', values );
									setColor( $selector.find('a'), 'color', values );
								}

								$.post(
									themifyCustomizer.ajaxurl,
									{
										'action': 'themify_customizer_get_option',
										'option': 'blogname',
										'nonce' : themifyCustomizer.nonce
									},
									function(data) {
										if ( 'notfound' != data ) {
											$selector.find('span').text( data );
										}
									}
								);
							}
						}
					}

				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Logo Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Tagline Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.taglineControls ) {
		$.each(themifyCustomizer.taglineControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( imageData ) {
					var values = $.parseJSON( imageData ),
						$selector = $( selector );

					setFont( $selector, values );

					if ( values ) {

						if ( values.mode && 'none' == values.mode ) {

							$selector.css( 'display', 'none' );

						} else if ( 'none' != values.mode ) {

							$selector.css( 'display', 'block' );

							var $img = $('img', $selector);
							if ( $img.length > 0 ) {
								$img.remove();
							}
							if ( '' != values.src && 'image' == values.mode ) {
								$($selector).find('span').hide();
								$selector.prepend('<img src="' + values.src + '" />');
								var imgwidth = values.imgwidth && '' != values.imgwidth ? values.imgwidth : '';
								var imgheight = values.imgheight && '' != values.imgheight ? values.imgheight : '';
								$selector.find('img').css({
									'width': imgwidth,
									'height': imgheight
								});
							} else {
								$($selector).find('span').show();
								setColor( $selector, 'color', values );

								$.post(
									themifyCustomizer.ajaxurl,
									{
										'action': 'themify_customizer_get_option',
										'option': 'blogdescription',
										'nonce' : themifyCustomizer.nonce
									},
									function(data) {
										if ( 'notfound' != data ) {
											$selector.find('span').text( data );
										}
									}
								);
							}
						}
					}

				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Tagline Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Background Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.backgroundControls ) {
		$.each(themifyCustomizer.backgroundControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( backgroundData ) {
					var values = $.parseJSON( backgroundData ),
						$selector = $( selector );

					$selector.css( {
						'background-image'  : '',
						'background-color'  : 'transparent',
						'background-repeat' : '',
						'background-size'   : ''
					} );

					if ( values && 'noimage' == values.noimage ) {
						$selector.css( {
							'background-image' : 'none'
						} );
					} else if ( 'undefined' !== typeof values.src ) {
						$selector.css('background-image', 'url(' + values.src + ')' );
					}
					if ( 'undefined' !== typeof values.style && '' != values.style ) {
						if ( 'fullcover' == values.style ) {
							$selector.css( {
								'background-size': 'cover',
								'background-repeat': 'no-repeat'
							} );
						} else {
							$selector.css( {
								'background-size': 'auto',
								'background-repeat': values.style
							} );
						}
					}
					setColor( $selector, 'background-color', values );

				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Background Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Color Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.colorControls ) {
		$.each(themifyCustomizer.colorControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( colorData ) {
					var values = $.parseJSON( colorData ),
						$selector = $( selector );

					$selector.css( {
						'color'  : ''
					} );

					setColor( $selector, 'color', values );
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Color Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Image Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.imageControls ) {
		$.each(themifyCustomizer.imageControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( imageData ) {
					var values = $.parseJSON( imageData ),
						$selector = $( selector );

					if ( values ) {
						var $img = $('img', $selector);
						if ( $img.length > 0 ) {
							$img.remove();
						}
						if ( '' != values.src ) {
							$($selector).prepend('<img src="' + values.src + '" />');
						}
					}
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Image Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Border Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.borderControls ) {
		$.each(themifyCustomizer.borderControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( borderData ) {
					var values = $.parseJSON( borderData ),
						$selector = $( selector );

					$selector.css( {
						'border-width' : '',
						'border-color' : 'transparent',
						'border-style' : ''
					} );

					if ( values && 'disabled' == values.disabled ) {
						$selector.css( {
							'border'  : 'none'
						} );
					} else if ( values && 'disabled' != values.disabled ) {
						if ( 'same' != values.same ) {
							_.each(['top', 'left', 'bottom', 'right'], function(side){
								if ( values[side] ) {
									setBorder( $selector, 'border-' + side, values[side] );
								}
							});
						} else if ( 'same' == values.same ) {
							setBorder( $selector, 'border', values );
						}
					}
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Border Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Margin Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.marginControls ) {
		$.each(themifyCustomizer.marginControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( marginData ) {
					var values = $.parseJSON( marginData ),
						$selector = $( selector );

					$selector.css( {
						'margin-top' : '',
						'margin-right' : '',
						'margin-bottom' : '',
						'margin-left' : ''
					} );

					if ( values ) {
						if ( 'same' != values.same ) {
							_.each(['top', 'left', 'bottom', 'right'], function(side){
								if ( values[side] ) {
									setDimension( $selector, 'margin-' + side, values[side] );
								}
							});
						} else if ( 'same' == values.same ) {
							setDimension( $selector, 'margin', values );
						}
					}
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Margin Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Padding Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.paddingControls ) {
		$.each(themifyCustomizer.paddingControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( paddingData ) {
					var values = $.parseJSON( paddingData ),
						$selector = $( selector );

					$selector.css( {
						'padding-top' : '',
						'padding-right' : '',
						'padding-bottom' : '',
						'padding-left' : ''
					} );

					if ( values && 'disabled' == values.disabled ) {
						$selector.css( {
							'padding'  : '0'
						} );
						$selector.css( 'padding', '0' );
					} else if ( values && 'disabled' != values.disabled ) {
						if ( 'same' != values.same ) {
							_.each(['top', 'left', 'bottom', 'right'], function(side){
								if ( values[side] ) {
									setDimension( $selector, 'padding-' + side, values[side] );
								}
							});
						} else if ( 'same' == values.same ) {
							setDimension( $selector, 'padding', values );
						}
					}
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Padding Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Width Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.widthControls ) {
		$.each(themifyCustomizer.widthControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( widthData ) {

					var values = $.parseJSON( widthData ),
						$selector = $( selector );

					$selector.css( 'width', '' );

					setDimension( $selector, 'width', values );
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Width Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Height Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.heightControls ) {
		$.each(themifyCustomizer.heightControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( heightData ) {
					var values = $.parseJSON( heightData ),
						$selector = $( selector );

					$selector.css( 'height', '' );

					setDimension( $selector, 'height', values );
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Height Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Position Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.positionControls ) {
		$.each(themifyCustomizer.positionControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( positionData ) {
					var values = $.parseJSON( positionData ),
						$selector = $( selector );

					$selector.css( {
						'position' : 'inherit',
						'top' : '',
						'right' : '',
						'bottom' : '',
						'left' : ''
					} );

					if ( values && '' != values.position ) {
						$selector.css( 'position', values.position );
					}

					_.each(['vertical', 'horizontal'], function(axis){
						if ( values[axis] ) {
							var side = 'top';
							if ( 'horizontal' == values[axis] ) {
								side = 'left';
							}
							if ( values[axis].side && 'top' != values[axis].side && 'left' != values[axis].side ) {
								side = values[axis].side;
							}
							setDimension( $selector, side, values[axis] );
						}
					});

				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Position Control End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Image Select Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.imageselectControls ) {
		$.each(themifyCustomizer.imageselectControls, function( index, selector ) {
			api( index, function( value ) {
				value.bind( function( data ) {
					var values = $.parseJSON( data ),
						$selector = $( selector );
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Image Select End
	////////////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////////////
	// Custom CSS Control Start
	////////////////////////////////////////////////////////////////////////////
	if ( themifyCustomizer.customcssControls ) {
		$.each(themifyCustomizer.customcssControls, function(index, selector){
			api( index, function( value ) {
				value.bind( function( customcssData ) {
					var customcss = $.parseJSON( customcssData );
					if ( customcss.css ) {
						var stylesheet = 'themify-custom-css';
						if ( $('#'+stylesheet).length > 0 ) {
							$('#'+stylesheet).remove();
						}
						$('head').append( '<style id="' + stylesheet + '">' + customcss.css + '</div>' );
					}
				});
			});
		});
	}
	////////////////////////////////////////////////////////////////////////////
	// Custom CSS Control End
	////////////////////////////////////////////////////////////////////////////

})(jQuery);