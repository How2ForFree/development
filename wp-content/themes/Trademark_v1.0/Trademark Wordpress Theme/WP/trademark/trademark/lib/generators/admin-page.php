<?php
$boxes = get_yaml_options('admin-page.yml');

/**
 * Adds custom boxes to post types
 */
function add_custom_box() {
	global $boxes;
	
	if ( function_exists( 'add_meta_box' ) ) {
		foreach ( $boxes as $box_key => $box_name ) {
		    // add_meta_box(‘id’, ‘title’, ‘callback’, ‘page’, ‘context’, ‘priority’)
		    // context - normal, advanced, and side.
			add_meta_box( $box_key, __( $box_name['options']['name'], 'sp' ), 'post_custom_box', 'post', $box_name['options']['context'], $box_name['options']['priority'] );
			add_meta_box( $box_key, __( $box_name['options']['name'], 'sp' ), 'post_custom_box', 'page', $box_name['options']['context'], $box_name['options']['priority'] );
		}
	}
}
add_action( 'admin_menu', 'add_custom_box' );

/**
 * Create fields for all boxes
 */
function post_custom_box ( $obj, $box ) {
	global $boxes;
	static $nonce_flag = false;
	
	if ( ! $nonce_flag ) echo_nonce();
	foreach ( $boxes[$box['id']] as $key => $value ) {
	    if ($key != 'options') {
    	    $value['id'] = $key;
    	    $value['id_parent'] = $box['id'];
    	    echo create_field( $value );
        }
	}
	
	echo '<div style="clear:both"></div>';

}



function create_field ( $args ) {
    if ( ! is_array( $args ) ) return;
    
	switch ( $args['type'] ) {
	    case 'header': $result = field_header( $args ); break;
	    
	    case 'select': $result = field_select( $args ); break;
	    case 'text': $result = field_text( $args ); break;
	    case 'textarea': $result = field_textarea( $args ); break;
	}
	
	return $result;
}

/**
 * Field: header
 */
function field_header( $args ) {
    $field .= '<div class="custom-field field-header"><h4>' . $args['name'] . '</h4></div>';
    return $field;
}

/**
 * Field: select
 */
function field_select( $args ) {
    global $post;

    $field_id = $args['id_parent'] . '_' .$args['id']; 
	$option_value = get_post_meta($post->ID, $field_id, true);
    if ( empty( $option_value ) ) $option_value = $args['default'];
	  
    $field .= '<div class="custom-field field-select ' . $args['class'] . '">';
    $field .= '<div class="label">';
    $field .= '<label for="' . $field_id . '">' . $args['name'] . '</label>';
    $field .= '</div><!-- /.label -->';
    
    $field .= '<div class="value"><select id="' . $field_id . '" name="' . $args['id_parent'] . '[' . $args['id'] . ']">';
    foreach ( $args['options'] as $key => $value ) {
        $selected = '';
        if ($option_value == $key) 
            $selected = 'selected="selected"'; 
            
        $field .= '<option ' . $selected . ' value=' . $key . '>' . $value . '</option>';
    }
        
    $field .= '</select></div><!-- /.value -->';
    $field .= '</div><!--/.custom-field -->';
        
    return $field;
}

/**
 * Field: text
 */
function field_text( $args ) {
   global $post; 
   
   $field_id = $args['id_parent'] . '_' .$args['id']; 
   $option_value = get_post_meta($post->ID, $field_id, true);   
   if ( empty( $option_value ) ) $option_value = $args['default'];
   
   $field .= '<div class="custom-field field-' . $args['id'] . ' field-text ' . $args['class'] . '">';
   $field .= '<div class="label">';
   $field .= '<label for="' . $field_id . '">' . $args['name'] . '</label>';
   $field .= '</div><!-- /.label -->';

   $field .= '<div class="value">';
   $field .= '<input type="text" id="' . $field_id . '" value="' . $option_value . '" name="' . $args['id_parent'] . '[' . $args['id'] . ']"/>';
   $field .= '</div><!-- /.value -->';
   $field .= '</div><!--/.custom-field -->'; 
   
   return $field;
}

/**
 * Field: textarea
 */
function field_textarea( $args ) {
   global $post; 
   
   $field_id = $args['id_parent'] . '_' .$args['id']; 
   $option_value = get_post_meta($post->ID, $field_id, true);   
   if ( empty( $option_value ) ) $option_value = $args['default'];
   
   $field .= '<div class="custom-field field-' . $args['id'] . ' field-textarea ' . $args['class'] . '">';
   $field .= '<div class="label">';
   $field .= '<label for="' . $field_id . '">' . $args['name'] . '</label>';
   $field .= '</div><!-- /.label -->';

   $field .= '<div class="value">';
   $field .= '<textarea type="text" id="' . $field_id . '" name="' . $args['id_parent'] . '[' . $args['id'] . ']">' . $option_value . '</textarea>';
   $field .= '</div><!-- /.value -->';
   $field .= '</div><!--/.custom-field -->'; 
   
   return $field;
}

/**
 *  Nonce
 */
function echo_nonce () {
    static $nonce_flag;
	echo sprintf( '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />', 'nonce_name', wp_create_nonce( plugin_basename(__FILE__) ) );
	$nonce_flag = true;
}

/**
 * Save data from form
 */
function save_postdata($post_id, $post) {
	global $boxes;
	
	if ( ! wp_verify_nonce( $_POST['nonce_name'], plugin_basename(__FILE__) ) ) return $post->ID;

	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post->ID )) return $post->ID;
	}
	else {
		if ( ! current_user_can( 'edit_post', $post->ID )) return $post->ID;
	}
	
	foreach ( $boxes as $parent => $box ) {
		foreach ( $box as $key => $fields ) {
		    if ($key != 'options') 
			    $my_data[$parent . '_' . $key] = $_POST[$parent][$key];
		}    
	}
    
	foreach ($my_data as $key => $value) {
		if ( 'revision' == $post->post_type  ) return;

		$value = implode(',', (array)$value);

		if ( get_post_meta($post->ID, $key, FALSE) ) 
            update_post_meta($post->ID, $key, $value);
		else 
			add_post_meta($post->ID, $key, $value);
			
		if (!$value) delete_post_meta($post->ID, $key);
	}
}
add_action( 'save_post', 'save_postdata', 1, 2 );
