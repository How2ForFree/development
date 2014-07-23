<?php
/**
 * Generates admin form
 */
function get_admin_form( $menu_slug = null ) {
	$options = get_yaml_options( 'admin-form.yml' );
	$form = '';

    if ($_REQUEST['saved']) {
    	$form .= '<div class="updated settings-error" id="setting-error-settings_updated">'; 
        $form .= '<p><strong>Settings saved.</strong></p>';
        $form .= '</div>';
    }
	// If menu_slug is empty return empty form
	if (!$menu_slug)
		return 'Empty form';

	
	// Start the form	
	$form .= '<form method="post" action="?page=' . $_GET['page'] . '&slug=' . $menu_slug . '">';
	
	// Open table
	$form .= '<div class="theme-admin">';
	
	if ( !is_array ( $options[$menu_slug] ) ) return;
	
	// Cycle over the all form options
	foreach ($options[$menu_slug] as $key => $value) {	    
			if ( get_option($key,'optionNotSet') != 'optionNotSet' )
				$option_value = get_option($key); 
			elseif ( !empty( $value['default'] ) )
			    $option_value = $value['default'];
			else 
			    $option_value = '';
			
			$option_value = stripslashes($option_value);
			
			switch ($value['type']) {
        case 'box_start':
          $form .= '<div class="theme-admin-box">';
          $form .= '<div class="theme-admin-head">';
          $form .= '<div class="expander"><div class="expander-wrap">Open</div></div>';
          $form .= '<h3>' . $value['name'] . '</h3>';
        
        	// Submit form
        	$form .= '<p class="submit">';
        	$form .= '<input type="hidden" name="action" value="save" />';
        	$form .= '<input name="save" type="submit" value="Save changes" class="button-primary"/>';	
        	$form .= '</p>';
        	
          $form .= '</div>';
          $form .= '<div class="theme-admin-content">';
          $has_box = true;
          break;
        case 'box_end':
          $form .= '</div>';
          $form .= '</div>';                    
          break;                       
        case 'header':
          $form .= '<h4>' . $value['name'] . '</h4>';
          break;
        // Textfield				
        case 'textfield':	
        	$form .= '<div class="theme-admin-row theme-admin-textfield clearfix">';			
        	$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';		
        	$form .= '    <div class="theme-admin-row-input">';						
        	$form .= '        <input type="text" class="regular-text ' . $value['class'] . '" value="' . $option_value . '" id="' . $key . '" name="' . $key . '" />';
        	$form .= '        <span class="description">&nbsp;&nbsp;' . $value['desc'] . '</span>';
        	$form .= '    </div><!-- /.theme-admin-row-input -->';						
        	$form .= '</div><!-- /.theme-admin-row -->';						
        break;
        // Textarea
        case 'textarea':		
        	$form .= '<div class="theme-admin-row theme-admin-textarea clearfix">';						
        	$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';		
        	$form .= '    <div class="theme-admin-row-input">';											
        	$form .= '        <textarea cols="40" rows="4" class="large-text ' . $value['class'] . '" id="' . $key . '" name="' . $key . '">' . $option_value . '</textarea>';
        	$form .= '        <span class="description">' . $value['desc'] . '</span>';
        	$form .= '    </div><!-- /.theme-admin-row-input -->';	
        	$form .= '</div><!-- /.theme-admin-row -->';						
        break;
        // Checkbox
        case 'checkbox':
        	$form .= '<div class="theme-admin-row theme-admin-checkbox clearfix">';						
        	$form .= '    <div class="theme-admin-row-title">' . $value['name']. '</div>';		
        	$form .= '    <div class="theme-admin-row-input"><fieldset><label for="' . $key . '">';
        
        	if ($option_value == 1) 
                  $form .= '<input type="checkbox" name="' . $key . '" id="' . $key. '" value="1" checked="checked" />';											
        	else
                  $form .= '<input type="checkbox" name="' . $key . '" id="' . $key. '" value="1" />';											
                  
        	$form .= '<span class="description">' . $value['desc'] . '</span>';
        	$form .= '</label></fieldset></div>';	
        	$form .= '</div><!-- /.theme-admin-row -->';						
        break;
        // Select
        case 'select':
        	$form .= '<div class="theme-admin-row clearfix">';						
        	$form .= '    <div class="theme-admin-row-title"><label for="' . $key . '">' . $value['name']. '</label></div>';		
        	$form .= '    <div class="theme-admin-row-input">';											
        	$form .= '        <select name="' . $key . '">';
        		foreach ($value['options'] as $option_key => $name) {
        			if ($option_value == $option_key)
        				$form .= '<option value="' . $option_key . '" selected="selected">' . $name . '</option>';
        			else
        				$form .= '<option value="' . $option_key . '">' . $name . '</option>';
        		}
        	$form .= '</select>';
        	$form .= '<span class="description">' . $value['desc'] . '</span>';
        	$form .= '    </div><!-- /.theme-admin-row-input -->';
        	$form .= '</div><!-- /.theme-admin-row -->';						
        break;
			}
	}
	$form .= '</div>';
	
	return $form;
}
