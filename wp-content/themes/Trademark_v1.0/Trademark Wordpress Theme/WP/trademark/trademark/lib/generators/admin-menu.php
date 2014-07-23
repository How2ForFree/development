<?php
/**
 * Hook admin_menu() 
 */
add_action('admin_menu', 'theme_admin_menu');    
function theme_admin_menu() {
	    $options = get_yaml_options( 'admin-form.yml' );
        if ( $_GET['page'] ) {
            if ( 'save' == $_REQUEST['action'] ) {
                if ( is_array( $options[$_GET['slug']] )) {
                    foreach ( $options[$_GET['slug']] as $key => $value ) {
                        update_option( $key, $_REQUEST[$key] );
                    }
                }
                
                if ( is_array( $options[$_GET['slug']] ) ) {
                    foreach ( $options[$_GET['slug']] as $value)  {
                        if( isset( $_REQUEST[$key] ) )
                            update_option( $key, $_REQUEST[$key] );
                        else
                            delete_option( $key );
                    }
                }
                
                header("Location: admin.php?page=" . $_GET['page'] . "&saved=true");
                die;
            }
        }
        // add_object_page( $page_title, $menu_title, $access_level, $file, $function = '', $icon_url = '')
        add_object_page('Trademark Options', 'Trademark', 'administrator', 'theme', 'theme_admin_general', get_template_directory_uri() . '/files/images/admin-menu.png');
}

function theme_admin_general () { 
    ?>
	<div class="wrap">
		<div class="icon32">
			<img src="<?php echo get_template_directory_uri() . "/files/images/admin-logo.png"; ?>" alt="logo" />		
		</div>
		<h2>Trademark Options</h2>
		<br /><br />
		
		<?php echo get_admin_form('general'); ?>
	
	</div><!-- /.wrap -->
	<?php
}