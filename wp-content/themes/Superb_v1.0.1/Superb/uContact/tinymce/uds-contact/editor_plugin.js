// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('udsExtensions');
	
	tinymce.create('tinymce.plugins.udsContact', {
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
			//console.log(url);
			// box
			ed.addCommand('mceContact', function() {
				ed.windowManager.open({
					file: url + '/contact.html',
					width: 400,
					height: 220,
					inline: 1
				}, {
					plugin_url: url
				});
			});

			ed.addButton('udsContact', {
				title : 'Create a styled Contact',
				cmd : 'mceContact',
				image : url + '/images/contact.gif'
			});
			
			// Add a node change handler, selects the Contact in the UI when a image is selected
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
					longname  : 'uDesignStudios Contact Plugin',
					author 	  : 'Miroslav Zoricak',
					authorurl : 'http://udesignstudios.net',
					infourl   : 'http://udesignstudios.net',
					version   : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('udsContact', tinymce.plugins.udsContact);
})();