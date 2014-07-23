<?php

$tinymce_extensions = array(
	array(
		'row' => 3,
		'dir' => 'uds-dropcap'
	),
	array(
		'row' => 3,
		'dir' => 'uds-code'
	),
	array(
		'row' => 3,
		'dir' => 'uds-generic'
	),
	array(
		'row' => 3,
		'dir' => 'uds-highlight'
	),
	array(
		'row' => 3,
		'dir' => 'uds-pullquote'
	),
	array(
		'row' => 3,
		'dir' => 'uds-layout'
	),
	array(
		'row' => 3,
		'dir' => 'divider'
	),
	array(
		'row' => 3,
		'dir' => 'uds-box'
	),
	array(
		'row' => 3,
		'dir' => 'uds-contact-info'
	),
	array(
		'row' => 3,
		'dir' => 'uds-button'
	),
	array(
		'row' => 3,
		'dir' => 'uds-icon'
	),
	array(
		'row' => 3,
		'dir' => 'uds-list'
	),
	array(
		'row' => 4,
		'dir' => 'uds-lightbox'
	),
	array(
		'row' => 4,
		'dir' => 'uds-accordion'
	),
	array(
		'row' => 4,
		'dir' => 'uds-tab'
	),
	array(
		'row' => 4,
		'dir' => 'uds-tabs'
	),
	array(
		'row' => 4,
		'dir' => 'uds-tour'
	),
	array(
		'row' => 4,
		'dir' => 'uds-tourpage'
	),
	array(
		'row' => 4,
		'dir' => 'uds-toggle'
	),
	array(
		'row' => 4,
		'dir' => 'divider'
	),
	array(
		'row' => 4,
		'dir' => 'uds-posts'
	),
	array(
		'row' => 4,
		'dir' => 'uds-recent-posts'
	),
	array(
		'row' => 4,
		'dir' => 'uds-popular-posts'
	),
	array(
		'row' => 4,
		'dir' => 'uds-time-popular-posts'
	),
	array(
		'row' => 4,
		'dir' => 'divider'
	),
	array(
		'row' => 4,
		'dir' => 'uds-gchart'
	),
	array(
		'row' => 4,
		'dir' => 'uds-gmap'
	),
	array(
		'row' => 4,
		'dir' => 'uds-social'
	),
	array(
		'row' => 4,
		'dir' => 'uds-flickr'
	),
	array(
		'row' => 4,
		'dir' => 'uds-twitter'
	),
	array(
		'row' => 4,
		'dir' => 'divider'
	)
);

class uds_tinymce_extensions {
	
	var $plugin_name = "udsExtensions";
	
	function uds_tinymce_extensions()  {
		// Modify the version when tinyMCE plugins are changed.
		add_filter('tiny_mce_version', array (&$this, 'change_tinymce_version') );
		
		// init process for button control
		add_action('init', array (&$this, 'add_button') );
	}

	function add_button() {
	
		// Don't bother doing this stuff if the current user lacks permissions
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
		
		// Add only in Rich Editor mode
		if ( get_user_option('rich_editing') == 'true') {
		 
			// add the button for wp2.5 in a new way
			add_filter("mce_external_plugins", array (&$this, "add_tinymce_plugin" ), 5);
			add_filter('mce_buttons_3', array (&$this, 'register_button' ), 5);
			add_filter('mce_buttons_4', array (&$this, 'register_button_2' ), 5);
		}
	}
	
	// used to insert button in wordpress 2.5x editor
	function register_button($buttons) {
		global $tinymce_extensions;
		
		array_push(
			$buttons,
			'udsDivider'			
		);
		
		foreach($tinymce_extensions as $ext) {
			if($ext['row'] == 3 && $ext['dir'] == 'divider'){
				$buttons[] = '|';
				continue;
			}
			if($ext['row'] == 3) {
				$buttons[] = $this->dash_to_camel($ext['dir']);
			}
		}
		
		return $buttons;
	}	
	
	function register_button_2($buttons) {
		global $tinymce_extensions;
	
		foreach($tinymce_extensions as $ext) {
			if($ext['row'] == 4 && $ext['dir'] == 'divider'){
				$buttons[] = '|';
				continue;
			}
			if($ext['row'] == 4) {
				$buttons[] = $this->dash_to_camel($ext['dir']);
			}
		}
	
		return $buttons;
	}	

	
	
	// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
	function add_tinymce_plugin($plugin_array) {    
		global $tinymce_extensions;
		
		//$plugin_array[$this->plugin_name] =  get_template_directory_uri().'/tinymce/editor_plugin.js';
		
		foreach($tinymce_extensions as $ext) {
			if($ext['dir'] == 'divider') continue;
			$plugin_array[$this->dash_to_camel($ext['dir'])] =  get_template_directory_uri().'/tinymce/'.$ext['dir'].'/editor_plugin.js';
		}
		
		return $plugin_array;
	}
	
	function change_tinymce_version($version) {
		return ++$version;
	}
	
	function dash_to_camel($name) {
		$elements = explode('-', $name);
		return array_shift($elements) . implode('', array_map('ucfirst', $elements));
	}
	
}

// Call it now
new uds_tinymce_extensions();

?>