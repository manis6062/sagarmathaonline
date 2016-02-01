/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        if(location.hostname == 'localhost'){
	       config.filebrowserBrowseUrl = '/shantimarga/js/admin/kcfinder/browse.php?opener=ckeditor&type=files';
		   config.filebrowserImageBrowseUrl = '/shantimarga/js/admin/kcfinder/browse.php?opener=ckeditor&type=images';
		   config.filebrowserFlashBrowseUrl = '/shantimarga/js/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
		   config.filebrowserUploadUrl = '/shantimarga/js/admin/kcfinder/upload.php?opener=ckeditor&type=files';
		   config.filebrowserImageUploadUrl = '/shantimarga/js/admin/kcfinder/upload.php?opener=ckeditor&type=images';
		   config.filebrowserFlashUploadUrl = '/shantimarga/js/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
	   }else{
	   		config.filebrowserBrowseUrl = '/js/admin/kcfinder/browse.php?opener=ckeditor&type=files';
			config.filebrowserImageBrowseUrl = '/js/admin/kcfinder/browse.php?opener=ckeditor&type=images';
			config.filebrowserFlashBrowseUrl = '/js/admin/kcfinder/browse.php?opener=ckeditor&type=flash';
			config.filebrowserUploadUrl = '/js/admin/kcfinder/upload.php?opener=ckeditor&type=files';
			config.filebrowserImageUploadUrl = '/js/admin/kcfinder/upload.php?opener=ckeditor&type=images';
			config.filebrowserFlashUploadUrl = '/js/admin/kcfinder/upload.php?opener=ckeditor&type=flash';
	   }
};
