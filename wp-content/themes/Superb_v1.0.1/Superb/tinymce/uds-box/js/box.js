var udsBox = {
	init : function(ed) {
		var dom = ed.dom, f = document.forms[0], n = ed.selection.getNode(), w;
		
		f.text.value = ed.selection.getContent();
	},

	update : function() {
		var ed = tinyMCEPopup.editor, box, f = document.forms[0], st = '';

		var content = ed.selection.getContent();

		if(f.type.value == '') {
			box = '[box]' + content + '[/box]';
		} else {
			box = '[box type="'+ f.type.value +'"]' + content + '[/box]';
		}

		ed.execCommand("mceInsertContent", false, box);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.requireLangPack();
tinyMCEPopup.onInit.add(udsBox.init, udsBox);
