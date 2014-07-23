// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('udsExtensions');
	
	tinymce.create('tinymce.plugins.udsPosts', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			
			// box
			ed.addCommand('mcePosts', function() {
				ed.windowManager.open({
					file: url + '/dialog.html',
					width: 400,
					height: 650,
					inline: 1
				}, {
					plugin_url: url
				});
			});

			ed.addButton('udsPosts', {
				title : 'Show posts with custom filtering',
				cmd : 'mcePosts',
				image : url + '/images/icon.gif'
			});

			
			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, e, collapsed) {
				//cm.setDisabled('udsBox', collapsed);
			});
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'uDesignStudios Posts Plugin',
					author 	  : 'Miroslav Zoricak',
					authorurl : 'http://udesignstudios.net',
					infourl   : 'http://udesignstudios.net',
					version   : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('udsPosts', tinymce.plugins.udsPosts);
})();