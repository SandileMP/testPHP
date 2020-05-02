/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'editing', groups: ['spellchecker', 'editing' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		//{ name: 'document', groups: [ 'mode', 'document', 'doctools', 'source' ] },
	];

	config.removeButtons = 'Save,NewPage,Preview,Print,Form,Radio,Checkbox,TextField,Textarea,Button,Select,ImageButton,HiddenField,Superscript,Subscript,RemoveFormat,CreateDiv,Blockquote,Language,BidiRtl,BidiLtr,Anchor,Flash,Smiley,SpecialChar,Iframe,PageBreak,Font,About,Styles';
	//config.extraPlugins = 'imageuploader';
	/*config.filebrowserBrowseUrl = '/browser/browse.php';
	config.filebrowserImageBrowseLinkUrl = '/browser/browse.php';
	config.filebrowserImageBrowseUrl = '/browser/browse.php?type=Images';
	config.filebrowserImageUploadUrl = '/uploader/upload.php?type=Images';
	config.filebrowserUploadUrl = '/uploader/upload.php';*/
};


/*config.toolbar_custom = [
            ['Cut','Copy','Paste','PasteFromWord','-','Undo','Redo','Find','Replace','-','SelectAll'],
        '/',['Table', 'TextColor', 'BGColor', 'Link','Unlink','Anchor', 'Image','SpecialChar','HorizontalRule', 'PageBreak','RemoveFormat','ShowBlocks', 'Source'],
        '/',[ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ],
        '/',['Bold', 'Italic', 'Underline','-','Strike','Subscript','Superscript','-','NumberedList', 'BulletedList', '-','Indent','Outdent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Blockquote','CreateDiv' ],
        '/',['Styles','Format','Font','FontSize','Preview','Templates','SpellChecker','Scayt','slimbox','about']
    ];*/
	/*
	toolbar: [
            { name: 'basicstyles', items : ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'RemoveFormat'] },
            { name: 'paragraph', groups: [ 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
            { name: 'lists', items : ['NumberedList', 'BulletedList'] },
            { name: 'dents', items : ['Outdent', 'Indent'] },
            { name: 'links', items : ['Link','Unlink', 'Anchor'] },
            { name: 'insert', items : ['Image', 'Table', 'SpecialChar'] },
            { name: 'clipboard', items : ['SelectAll', 'Cut', 'Copy', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
            { name: 'editing', items : [] },
            { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
            { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
            { name: 'document', items : ['Source'] }
        ],*/