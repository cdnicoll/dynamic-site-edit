function growlAlert() {
    jQ.blockUI({ 
        message: jQ('div.growlUI'), 
        fadeIn: 700, 
        fadeOut: 700, 
        timeout: 2000, 
        showOverlay: false, 
        centerY: false, 
        css: { 
            width: '350px', 
            top: '10px', 
            left: '', 
            right: '10px', 
            border: 'none', 
            padding: '5px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .6, 
            color: '#fff' 
        } 
    }); 
}

var jQ = jQuery.noConflict();

jQ(document).ready(function()
{
    // ====================================================================================================
    // GROWL ALERT
    // ====================================================================================================
        

    // ====================================================================================================
    // PRELOAD IMAGES
    // ====================================================================================================
    jQ('img').preload({
            placeholder:URI_PATH+'public/images/placeholder.jpg',
            notFound:URI_PATH+'public/images/notfound.jpg',
            onFinish: function() {
                //
            }
        });
    
    jQ('.crop').imageCrop();

    jQ('.box_crop').imageCrop({
           cropWidth: '200',
           cropHeight: '165',
           borderWidth: '0'
       });
    
    // ====================================================================================================
    // BLOCK UI
    // ====================================================================================================
    if (jQ('#error_blockUI').length == 1) {
        jQ.blockUI({ 
            message:    jQ('#error_blockUI'),
            fadeIn:     1000, 
            //timeout:    2000, 
            onBlock: function() { 
                //alert('Page is now blocked; fadeIn complete');
            } 
        });
    }
    
	jQ('.login_btn').click(function() { 
        jQ.blockUI({ message: jQ('#login_blockUI') });
    });

    jQ('.close').click(function() { 
        jQ.unblockUI(); 
        return false; 
    });
    
    
// ====================================================================================================
// END
// ====================================================================================================
});
