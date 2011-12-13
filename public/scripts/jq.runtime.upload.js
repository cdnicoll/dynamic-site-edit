var jQ = jQuery.noConflict();
var JS_PATH2 = "http://localhost/DynamicSiteEdit/www/public/scripts/";
jQ(document).ready(function()
{
    // ====================================================================================================
    // UPLOADIFY
    // ====================================================================================================
    
    jQ("#single_upload").uploadify({
        'uploader'       : JS_PATH2+'uploadify/uploadify.swf',
        'script'         : JS_PATH2+'uploadify/uploadify.php',
        'cancelImg'      : JS_PATH2+'uploadify/cancel.png',
        'folder'         : '../../uploads',
        'queueID'        : 'singleQueue',
        'auto'           : true,
        'multi'          : true
    });
    
	jQ("#multiple_upload").uploadify({
        'uploader'       : JS_PATH2+'uploadify/uploadify.swf',
        'script'         : JS_PATH2+'uploadify/uploadify.php',
        'cancelImg'      : JS_PATH2+'uploadify/cancel.png',
		'buttonImg'		: JS_PATH2+'uploadify/upload.jpg',
		'height' 		: '45',
		'width' 		: '45',
        'folder'         : '../../uploads',
        'queueID'        : 'multipleQueue',
        'multi'          : true,
		onAllComplete: function() {
		    alert("upload complete! This alert is triggered when onAllComplete() is invoked");
		}
    });
    
// ====================================================================================================
// END
// ====================================================================================================
});
