var jQ = jQuery.noConflict();

jQ(document).ready(function()
{   
    var currentFile;
    var thisImg;
    
    jQ('.sort_grid').panelGroup('images');

    jQ(".imgSwap").dblclick(function()
	{
	    jQ.blockUI({ message: jQ('#upload_blockUI') });
	    thisImg = jQ(this);
	    var imgNamePath = thisImg.attr("src");
	    var nameNodes =  imgNamePath.split("/");
	    var end = nameNodes.length;
	    currentFile = nameNodes[end-1];
    });
    
    jQ('#imageSwap').uploadify({
        'uploader'       : JS_PATH+'uploadify/uploadify.swf',
        'script'         : JS_PATH+'uploadify/uploadify.php',
        'cancelImg'      : JS_PATH+'uploadify/cancel.png',
        'folder'         : '../database/imagesPage',
        'queueID'        : 'imageSwapHolder',
        'auto'           : true,
        'multi'          : false,
        onComplete: function(event, queueID, file) {
		    // get the current file name
		    // get the new file name via file.name
		    // post this to a script that will post this to the database
		    // the script must also remove the old file from the database folder.
		    // on success, show a sucess message.
		    //console.log(file);
		    //console.log("replace "+currentFile+" with "+file.name);
		    
		    jQ.post(URI_PATH+"system/lib/update_jQ.php", {action: 'updateImages', file_path: '../database/imagesPage', table: 'images', oldFile : currentFile, newFile : file.name}, function(response) {
		        if (response == "success") {
                     // replace the old image with the new image (file.name)
                     thisImg.attr("src",URI_PATH+'database/imagesPage/'+file.name);
                 }
		    })
		    
		    jQ.unblockUI(); 
		}
    });
    
    
});

function swapImage() {
    
}
