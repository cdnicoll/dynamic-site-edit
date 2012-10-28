/*
@author:    cNicoll
@name:	    jquery.editText.js
@date:      03-04-10_09-21

RELEASE NOTES:
==========================================================================================
@version 1.0 | 03-04-10_09-21
    *   This script allows for text to be edited on the spot by double click on a text
        area. Doing so will drown down CKEDITOR and in which will allow for the text
        to be modified.
    *   External Scripts needed:
            - jquery.metadata.js
            - ckeditor/ckeditor.js
    *   This takes advantage in meta data. This is important because the update script
        needs to know the table, id, and column to update. To impliment:
            <div class="mod {table: 'the_table', id: 1, column: 'the_content'}">the content that is editable when double clicking</div>
*/


//You need an anonymous function to wrap around your function to avoid conflict  
(function($){  

          //This is where you write your plugin's name  
          $.fn.editText = function(options) {
            
              // This allows the user to override options.
              // $.fn.editText.defaults.placeHolder = '#newHolder';
              // calling the function can now be called without paramerters
              //      $('.mod').editText();
              var opts = $.extend({}, $.fn.editText.defaults, options);
                                                
            //Iterate over the current set of matched elements  
            return this.each(function() {  
                
                var obj = $(this);
                
                // if there is metadata
                // table | id | column
                //var opt = $.metadata ? $.extend({}, opts, obj.metadata()) : opts;
                var opt = $.extend({}, opts, obj.metadata());
                
                var table = opt.table;
                var id = opt.id;
                var column = opt.column;
                
               // var editor = $('#cke_myeditor');
                 
                
                obj.dblclick(function()
              	{   
              	    var mod = $(this).html();
                    
                      // Theres a bug in IE that wont allow the use of .html() to fix this, I used .text()
              	    $('textarea').attr('name', function() {
              	        $(this).text(mod);
              	    });
                    
                    
              	   // remove it first
                     var editor = $('#cke_myeditor');
                     //console.log(editor.length);
                     if (editor.length >= 1) {
                         $(opt.placeHolder).slideUp(500);           // slide up
                         var theEditor = CKEDITOR.instances.myeditor;  // get editor instance
                         CKEDITOR.remove(theEditor);                   // remove the editor instance
                         $("#cke_myeditor").remove();               // remove it from DOM
                         $("#updateText").remove();
                     }
                     
                     //$(opt.placeHolder).slideDown(500);

                     CKEDITOR.replace('myeditor',
                     {
                         toolbar : 
                         [
                              ['Source','-','NewPage'],
                              ['Styles', 'Format'],
                              ['Cut','Copy','Paste','PasteText','PasteFromWord','-', 'SpellChecker'],
                              ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                              ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link']
                         ],  
                         width	:	                600,
                         height	:	                200,
                         forcePasteAsPlainText:	    true,
                         startupFocus	: 	        true,
                         resize_enabled	:	        true,
                         resize_maxHeight:	        450,
                         resize_maxWidth	:	    650,
                         resize_minHeight:	        300,
                         resize_minWidth	:	    500
                     });
                     
                     $(opt.placeHolder).append('<span id="updateText" class="'+opt.updateButton+'"><a href="javascript:void(0)">Update</a></span>');
                     //<span id="updateText"><a href="javascript:void(0)" class="update_text_btn">Update</a></span>
                     
                     if (CKEDITOR.status == 'basic_ready') {
                         $(opt.placeHolder).slideDown(500);
                     }
                     
                     //$.fn.editText.update(table, id, column);
                     
                    $('.'+opt.updateButton).click(function() {
                        var editor = CKEDITOR.instances.myeditor;
                        var text =  editor.getData();

                        // console.log(this);
                        // console.log("table: " + table);
                        // console.log("id: " + id);
                        // console.log("column: " + column);
                        // console.log(text);
                        // console.log("--");
                        // console.log("--");

                           $.post(opt.updateScript, {action: 'updateModText', table: table, id: id, column: column, text: text}, function(response) {
                              if (response == "success") {
                                growlAlert();
                                $(opt.placeHolder).slideUp(500);
                                obj.html(text);
                               }
                           });
                        return false;
                      });
                      
                 });
                 
                 
            }); // close the return
        }  // close the panelGroup function
     
     
    
    // Default settings that can be overridden
    $.fn.editText.defaults = {
      //textArea:       '.mod',
      placeHolder:    '#slider',
      updateButton:   'update_text_btn',
      updateScript:   URI_PATH+'system/lib/update_jQ.php'
    }
    
//pass jquery to the function,   
//So that we will able to use any valid Javascript variable name   
//to replace "$" SIGN. But, we'll stick to $ (I like dollar sign: ) )         
})(jQuery); // close the function wrapper