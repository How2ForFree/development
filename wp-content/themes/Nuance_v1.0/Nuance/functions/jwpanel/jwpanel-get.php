<?php
global $options;
foreach ($options as $value) {
	if($value['type'] != 'open' && $value['type'] != 'close'){
		if (get_option( $value['id'] ) === FALSE) { 
			$$value['id'] = $value['std']; 
		}else{ 
			$$value['id'] = get_option( $value['id'] ); 
		}
	}
}
?>