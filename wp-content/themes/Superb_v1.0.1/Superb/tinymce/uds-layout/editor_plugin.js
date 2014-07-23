// Docu : http://wiki.moxiecode.com/index.php/TinyMCE:Create_plugin/3.x#Creating_your_own_plugins

(function() {
	// Load plugin specific language pack
	//tinymce.PluginManager.requireLangPack('udsExtensions');
	
	tinymce.create('tinymce.plugins.udsLayout', {
		/**
		 * Initializes the plugin, this will be executed after the plugin has been created.
		 * This call is done before the editor instance has finished it's initialization so use the onInit event
		 * of the editor instance to intercept that event.
		 *
		 * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
		 * @param {string} url Absolute URL to where the plugin is located.
		 */
		init : function(ed, url) {
			var t = this;
			
			t.editor = ed;
			t.url = url;
			
			// Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mceExample');
			
			// Thirds
			ed.addCommand('mceThirds', function() {
				var sel = ed.selection.getContent();
				sel = '[third]' + sel + '[/third]';
				ed.selection.setContent(sel);
			});
			
			// Two thirds
			ed.addCommand('mceTwoThirds', function() {
				var sel = ed.selection.getContent();
				sel = '[two-thirds]' + sel + '[/two-thirds]';
				ed.selection.setContent(sel);
			});
			
			// halves
			ed.addCommand('mceHalves', function() {
				var sel = ed.selection.getContent();
				sel = '[half]' + sel + '[/half]';
				ed.selection.setContent(sel);
			});
			
			// fourths
			ed.addCommand('mceFourths', function() {
				var sel = ed.selection.getContent();
				sel = '[fourth]' + sel + '[/fourth]';
				ed.selection.setContent(sel);
			});			
			
			// three fourths
			ed.addCommand('mceThreeFourths', function() {
				var sel = ed.selection.getContent();
				sel = '[three-fourths]' + sel + '[/three-fourths]';
				ed.selection.setContent(sel);
			});
			
			// three fifths
			ed.addCommand('mceThreeFifths', function() {
				var sel = ed.selection.getContent();
				sel = '[three-fifths]' + sel + '[/three-fifths]';
				ed.selection.setContent(sel);
			});
			
			// two fifths
			ed.addCommand('mceTwoFifths', function() {
				var sel = ed.selection.getContent();
				sel = '[two-fifths]' + sel + '[/two-fifths]';
				ed.selection.setContent(sel);
			});
			
			// four fifths
			ed.addCommand('mceFourFifths', function() {
				var sel = ed.selection.getContent();
				sel = '[four-fifths]' + sel + '[/four-fifths]';
				ed.selection.setContent(sel);
			});
			
			// fifths
			ed.addCommand('mceFifths', function() {
				var sel = ed.selection.getContent();
				sel = '[fifth]' + sel + '[/fifth]';
				ed.selection.setContent(sel);
			});
			
			// sixths
			ed.addCommand('mceSixths', function() {
				var sel = ed.selection.getContent();
				sel = '[sixth]' + sel + '[/sixth]';
				ed.selection.setContent(sel);
			});
			
			// Five sixths
			ed.addCommand('mceFiveSixths', function() {
				var sel = ed.selection.getContent();
				sel = '[five-sixths]' + sel + '[/five-sixths]';
				ed.selection.setContent(sel);
			});
		},

		createControl : function(n, cm) {
			var t = this, c, ed = t.editor;

			if (n == 'udsLayout') {
				c = cm.createSplitButton(n, {
					title : 'Content Layout',
					cmd: '',
					scope : t, 
					image: t.url + '/images/56.gif'
				});
				
				c.onRenderMenu.add(function(c, m) {
					m.add({
						title : 'Layouts',
						cmd: ''
					}).setDisabled(1);
					
					m.add({
						title : '1/2',
						cmd: 'mceHalves'
					});
					
					m.add({
						title : '1/3',
						cmd: 'mceThirds'
					});
					
					m.add({
						title : '1/4',
						cmd: 'mceFourths'
					});
					
					m.add({
						title : '1/5',
						cmd: 'mceFifths'
					});
					
					m.add({
						title : '1/6',
						cmd: 'mceSixths'
					});
					
					m.add({
						title : '2/3',
						cmd: 'mceTwoThirds'
					});
					
					m.add({
						title : '2/5',
						cmd: 'mceTwoFifths'
					});
					
					m.add({
						title : '3/4',
						cmd: 'mceThreeFourths'
					});
					
					m.add({
						title : '3/5',
						cmd: 'mceThreeFifths'
					});
					
					m.add({
						title : '4/5',
						cmd: 'mceFourFifths'
					});
					
					m.add({
						title : '5/6',
						cmd: 'mceFiveSixths'
					});
				});

				return c;
			}
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
					longname  : 'uDesignStudios Layout Plugin',
					author 	  : 'Miroslav Zoricak',
					authorurl : 'http://udesignstudios.net',
					infourl   : 'http://udesignstudios.net',
					version   : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('udsLayout', tinymce.plugins.udsLayout);
})();